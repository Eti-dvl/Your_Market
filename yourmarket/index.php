<?php session_start(); 

?>


<html>
	<head>
		<title>YOURMARKET-Home</title>
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="index.js"></script>
	</head>
	<body>
	
	<header>
			
		<div class="inner_header">
			<div class="logo">	
				<a href="index.php"><img src="logo.png" alt="logo" width="200" height="50"></a>
			</div>			

			<div class="searchbar">
				<input type="search" id="search" value="">
				<input type="button" value="Search">
			</div>
				
			
			<ul class="navigation">
				<a href="categories.php"><li>Categories</li></a>
				<?php
					if($_SESSION['id']!=0){
						echo "<a href='sell.php'><li>Sell</li></a>";
						echo "<a href='youraccount.php'><li>Your Account</li></a>";
					}else{
						echo "<a href='youraccount_log_sig.php'><li>Sell</li></a>";
						echo "<a href='youraccount_log_sig.php'><li>Log/sign</li></a>";
						
					}
					echo "<a href='cart.php'><li>Cart</li></a>";
					if($_SESSION['admin']!=0){	
						echo "<a href='admin.php'><li>Admin</li></a>";
					}else{
						echo "<a href='youraccount_log_sig.php'><li>Admin</li></a>";
					}
				?>		
				
				
				
			</ul>				
			
		</div>

	</header>

	
	<div class="container">		
	
		<!-- Slideshow container -->
		<div class="slideshow-container">
			
			
			<?php
		$user = 'root';
		$password = ''; //To be completed if you have set a password to root
		$database = 'yourmarket'; //To be completed to connect to a database. The database must exist.
		$port = NULL; //Default must be NULL to use default port
		$mysqli = new mysqli('127.0.0.1', $user, $password, $database, $port);
		
		if ($mysqli->connect_error) {
			die('Connect Error (' . $mysqli->connect_errno . ') '
					. $mysqli->connect_error);
		}
		
		
		$connected=$_SESSION['id'];
		if($connected!=0){
			$sql = "SELECT * FROM item WHERE sellerid <>'".$connected."' AND commandid IS NULL LIMIT 3";
			
		}else{
			$sql = "SELECT * FROM item WHERE commandid IS NULL LIMIT 3";
			
		}
		
		$result = $mysqli->query($sql);
		
		if ($result->num_rows > 0) {
						// output data of each row
						$i=0;
						while($row = $result->fetch_assoc()) {
							$itemid=$row['id'];
							$i++;
							
							$sql2 = "SELECT image FROM images WHERE itemid='".$itemid."'";
							$result2 = $mysqli->query($sql2);
							
							if ($result2->num_rows > 0){
							
								while($img=$result2->fetch_assoc()){
									$newpath = "images\\".$img['image'];
								}
							}else{
								$newpath = '';
							}
							
							echo "<a href='buynow.php?id=".$row['id']."''>
							
							<div> 
							
							<div class='mySlides fade'>
									<div class='numbertext'>".$i." / 3</div>
										<center><img src='".$newpath."' style='height:400px'></center>
									<div class='text'>".$row['model']."</div>
							</div>
							</a>";
						}
						echo "</div>";
					}
				$mysqli->close();	
		?>

			<!-- Next and previous buttons -->
			<a class="prev" onclick="plusSlides(-1)"><h1>&#10094;</h1></a>
			<a class="next" onclick="plusSlides(1)"><h1>&#10095;</h1></a>
		</div>
		<br>

		<!-- The dots/circles -->
		<div style="text-align:center">
			<span class="dot" onclick="currentSlide(1)"></span>
			<span class="dot" onclick="currentSlide(2)"></span>
			<span class="dot" onclick="currentSlide(3)"></span>
		</div>
		<script>
			showSlides(1);
		</script>
		
		<div class="articles">
		
		<?php
		$user = 'root';
		$password = ''; //To be completed if you have set a password to root
		$database = 'yourmarket'; //To be completed to connect to a database. The database must exist.
		$port = NULL; //Default must be NULL to use default port
		$mysqli = new mysqli('127.0.0.1', $user, $password, $database, $port);
		
		if ($mysqli->connect_error) {
			die('Connect Error (' . $mysqli->connect_errno . ') '
					. $mysqli->connect_error);
		}
		
		$connected=$_SESSION['id'];
		if($connected!=0){
			$sql = "SELECT * FROM item WHERE sellerid <>'".$connected."' AND commandid IS NULL LIMIT 6";
			
		}else{
			$sql = "SELECT * FROM item WHERE commandid IS NULL LIMIT 6";
			
		}
		
					$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
						// output data of each row
						echo '<div class="layout">';
						while($row = $result->fetch_assoc()) {
							$itemid=$row['id'];
							
							$sql2 = "SELECT image FROM images WHERE itemid='".$itemid."'";
							$result2 = $mysqli->query($sql2);
							
							if ($result2->num_rows > 0){
							
								while($img=$result2->fetch_assoc()){
									$newpath = "images\\".$img['image'];
								}
							}else{
								$newpath = '';
							}
							
							echo "<a href='buynow.php?id=".$row['id']."''>
							<div> 
								<img src='".$newpath."' alt='No img for this item' width='250' style='margin-top:20px;margin-bottom:20px'>
								<br>".$row['category']."<br>
								<br>".$row['brand']."<br>
								<br>".$row['model']."<br>
								<br>".$row['startingprice']." €<br>";
								if($row['type']=='Buy'){
									echo "<br><div class='buyit'>Buy it now</div>";
								}if($row['type']=='Auction'){
									echo "<br><div class='auction'>Auction</div>";
								}if($row['type']=='Best'){
									echo "<br><div class='best'>Best offer</div>";
								}
								
								
							echo "</div>
							</a>";
						}
						echo "</div>";
					}
				$mysqli->close();	
		?>
		
		</div>
		<br><div style='float:bottom'></div>
	
	<br>
	
	</div>
	</div>
	</div>
	<div class="footer">
		&copy; yourmarket.com | Designed by Richard Lhuissier & Etienne Correge
	</div>
	
	</body>
</html>