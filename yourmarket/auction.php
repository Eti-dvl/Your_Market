<?php 
session_start(); 
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

			<div class="item_to_sell">
				<?php
			
			if (isset($_GET['id'])){
				$itemid = $_GET['id'];
				$rel = 13;
			}
			
			$itemid=33;
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
									<h2>Caracteristics</h2>
									<ul title='Caracteristics'>
										<li><p>".$row['description']."</p></li>
									</ul>												
								</td>
								<td>
									<form>
										<label for='amount'> Enter BID</label><br>
										<input type='number' name='amount' min='".$row['startingprice']."'>

										<input type='submit'>
									</form>
								</td>
							</tr>
							
							<tr>
								<td>Begining price : ".$row['startingprice']."€ <br> Current best offer : ".$row['actualprice']."€</td>
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