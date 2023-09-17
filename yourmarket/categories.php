<?php session_start(); 
	

?>
<html>
	<head>
	<title>YOURMARKET-Categories</title>
		<link rel="stylesheet" href="style.css">
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
					<a href="categories.php"><li class="selected">Categories</li></a>
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
			<div class="sidebar">
				<a href="categories.php">All</a>
				<a href="categories_vinyls.php">Vinyls</a>
				<a href="categories_guitars.php">Guitars</a>
				<a href="categories_lights.php">Lights</a>
			</div>
			
			<div class="articlesb">
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
			$sql = "SELECT * FROM item WHERE commandid IS NULL AND sellerid <>'".$connected."'";
		}else{
			$sql = "SELECT * FROM item WHERE commandid IS NULL";
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

		</div>
	
		<div class="footer">
			&copy; yourmarket.com | Designed by Richard Lhuissier & Etienne Correge
		</div>
	
	</body>
</html>