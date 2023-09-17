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
				<center>
				<table class='table-buyitnow'>
					<tr>
						<td>
							<center><h1>MERCI POUR VOTRE ACHAT !</h1></center>
							<br>
							<center><h1>&#x2713;</h1></center>
							<br>
							<center><h1>A BIENTOT !</h1></center>

						</td>
					</tr>
				</table>
				</center>
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
				
		  $mysqli->close();
		  
		}
	
	?>