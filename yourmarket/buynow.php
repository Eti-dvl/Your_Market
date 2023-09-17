<?php session_start(); 
	


?>


<html>
	<head>
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
	
	<div class="container_item">
		
		<center><h1>Buy it now</h1></center>
		
		
		<div class="item_to_sell">
			
			
			<?php
			
			if (isset($_GET['id'])){
				$itemid = $_GET['id'];
				$rel = 13;
			}
			
			
			$user = 'root';
			$password = ''; //To be completed if you have set a password to root
			$database = 'yourmarket'; //To be completed to connect to a database. The database must exist.
			$port = NULL; //Default must be NULL to use default port
			$mysqli = new mysqli('127.0.0.1', $user, $password, $database, $port);
			
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') '
						. $mysqli->connect_error);
			}
			$sql = "SELECT * FROM item WHERE id='".$itemid."'";
			$result = $mysqli->query($sql);
		
			if ($result->num_rows > 0) {
				// output data of each row
				echo '<div>';
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
							
					echo " <center>
						<table class='table-buyitnow'>				
							<tr>
								<td><img src='".$newpath."' width='300' height='300'></td>
								<td > 
								<h1>".$row['model']."</h1>
								<h4>Brand: ".$row['brand']."</h4>
								<h4>Category: ".$row['category']."</h4>
								
								<h2>Caracteristics</h2>
									<ul title='Caracteristics'>
										<li><p>".$row['description']."</p></li>
									</ul>
												
									<div class='buy'>
										<p><b> Price : ".$row['startingprice']."€</b></p>
										<form action='buynow.php?id=".$itemid."' method='POST'>
											<input type='hidden' name='prix' value='".$row['startingprice']."'>
											<input type='hidden' name='id' value='".$itemid."'>";
											
											
											if($_SESSION['id']!=0){
												echo	"<input type='submit' name='submit' value='Buy it now'>";
											}else{
												echo "<a href='youraccount_log_sig.php'>
												<input type='button' value='Connect to buy it now'>
												</a>";
											}	
											echo "</form><br><br>
											
											
											<form action='buynow.php' method='POST'>
											<input type='hidden' name='prix' value='".$row['startingprice']."'>
											<input type='hidden' name='id' value='".$itemid."'>
											<script>
											function add(){
												alert('Item Added to Cart');
											}	
											</script>";
											
											if($_SESSION['id']!=0){
												echo	"<input type='submit' onclick='add()'name='addcart' value='Add to cart'>";
											}else{
												echo "<a href='youraccount_log_sig.php'>
												<input type='button' value='Connect to add to cart'>
												</a>";
											}echo "</form><br><br>											
											
											
									</div>					
								</td>
							</tr>					
								
						</table></center>";
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

<?php
			
		if(isset($_POST['submit'])){
			echo "COOL";
		$user = 'root';
		$password = ''; //To be completed if you have set a password to root
		$database = 'yourmarket'; //To be completed to connect to a database. The database must exist.
		$port = NULL; //Default must be NULL to use default port
		$mysqli = new mysqli('127.0.0.1', $user, $password, $database, $port);

		if ($mysqli->connect_error) {
			die('Connect Error (' . $mysqli->connect_errno . ') '
					. $mysqli->connect_error);
		}
		echo '<p>Connection OK '. $mysqli->host_info.'</p>';
		echo '<p>Server '.$mysqli->server_info.'</p>';
		echo '<p>Initial charset: '.$mysqli->character_set_name().'</p>';
		
		$date=date("Y-m-d");
		$shipped = date('Y-m-d', strtotime($date. ' + 3 days'));
		echo $date;
		echo $shipped;
		
				$sql = $mysqli->prepare("INSERT INTO command(price,date,shipped,histuser) VALUES (?,?,?,?)"); 
				$sql->bind_param("ssss",$_POST['prix'], $date, $shipped, $_SESSION['id']);
				$sql->execute();
				echo "AJOUT EFFECTUE";	
				
				$commandid=$mysqli->insert_id;
				
				echo $commandid;
				echo "item id:".$_POST['id'];
				
				$sql = $mysqli->prepare("UPDATE item SET commandid=? WHERE id=?"); 
				$sql->bind_param("ss",$commandid, $_POST['id']);
				$sql->execute();
				echo "AJOUT EFFECTUE";	
				header("Location:merci.php");
				
		  $mysqli->close();
		  
		}
		
		
		
	if(isset($_POST['addcart'])){
		
		if(!isset($_SESSION['panier'])){
			$_SESSION['panier'] = array($_POST['id']);
		}else{
			$_SESSION['panier'][] = $_POST['id'];
		}
		
		header("Location:categories.php");
		echo "AJOUTE AU PANIER";
	}	
	
	?>