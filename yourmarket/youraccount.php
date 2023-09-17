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
						echo "<a href='youraccount.php'><li class='selected'>Your Account</li></a>";
					}else{
						echo "<a href='youraccount_log_sig.php'><li>Sell</li></a>";
						echo "<a href='youraccount_log_sig.php'><li class='selected'>Log/sign</li></a>";
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
	
	<div class="container_account">
	
		<div class="account">	
		
			<h2>Contact Information</h2>
			
			
			<form action='youraccount.php' method='POST' style="margin-left:20px; margin-top:10px;" >
				
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
					$sql = "SELECT * FROM user WHERE id='".$_SESSION['id']."'";
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
							
							echo "<div> 
							
							<img src='".$newpath."' alt='no profil img' width='100' height='100' style='border-radius:5px 5px 5px 5px;'>
							<input type='radio' name='gender' value='Mme'>Mme
							<input type='radio' name='gender' value='Mr' style='margin: 20px;'>M.<br>
							
				<label for='firtsname'>First name:</label>
				<label for='lastname' style='margin: 0px 100px;'>Last name:</label><br>
				<input type='text' name='firtsname' value='".$row['fname']."'>	
				<input type='text' name='lastname' value='".$row['lname']."'><br>
				
				<label for='email'>E-mail:</label><br>
				<input type='text' name='email' value='".$row['email']."' size='46'>
				<br><br>
				<label for='phone'>Phone number:</label><br>
				<input type='text' name='phone' placeholder='Ptit 06 des familles' value='".$row['tel']."' size='46'>
				<br><br>
				<label for='adress'>Adress:</label><br>
				<input type='text' name='adress' placeholder='13, Avenue des champs' value='".$row['adress']."' size=46><br><br>
				
				";
						}
					}
				$mysqli->close();	
				
				
				
		?>
		<input type='submit' name='submit' >
	
				</div>
			</form>

		</div>
		
		
		<h1> YOUR LAST COMMANDS </h1>
		<table class="table-content">
			<thead>
				<tr>
					<th>id</th>
					<th>Price</th>
					<th>Date</th>
					<th>Shipping date</th>
				</tr>
			</thead>
			
			<tbody>
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
			$sql = "SELECT * FROM command WHERE histuser='".$_SESSION['id']."'";
			$result = $mysqli->query($sql);
		
		if ($result->num_rows > 0) {
						// output data of each row
						
						while($row = $result->fetch_assoc()) {
							
							
							echo "<tr>
							
								<td><a href='order.php?orderid=".$row['id']."'>".$row['id']."</a></td>
							
								<td>".$row['price']."€</td>
								<td>".$row['date']."</td>
								<td>".$row['shipped']."</td>
								</tr>";
								
						}
					}
				$mysqli->close();	
		?>
			</tbody>
			
		</table>
		
		<form action="youraccount.php" method="POST">
			<input type='submit' name="disconect" value="DISCONNECT" style="float:right;margin-right:100px">
		</form>
		
		
		<?php 
		if(isset($_POST['disconect'])){
			echo "TEST";
			$_SESSION['id']=0;
			$_SESSION['name']='';
			$_SESSION['panier'] = array();
			header("Location:youraccount_log_sig.php");
		}
		
		?>
		
		<h1> YOUR ITEMS LEFT TO SELL </h1>
		<table class="table-content">
			<thead>
				<tr>
					<th>Item</th>
					<th>Category</th>
					<th>Price</th>
					<th>Sold</th>
				</tr>
			</thead>
			
			<tbody>
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
			$sql = "SELECT * FROM item WHERE sellerid='".$_SESSION['id']."'";
			$result = $mysqli->query($sql);
		
		if ($result->num_rows > 0) {
						// output data of each row
						
						while($row = $result->fetch_assoc()) {
							
							
							echo "<tr>
								<td>".$row['model']."</td>
								<td>".$row['category']."</td>
								<td>".$row['startingprice']."€</td>";
								
								echo $row['commandid'];
								
								
								if($row['commandid']==''){
								echo "<td style='color:red'> Not yet </td>";
								}else{
									echo "<td style='color:green'> Sold </td>";
								}
								
								echo "</tr>";
								
						}
					}
				$mysqli->close();	
		?>
			</tbody>
			
		</table>	

		
		
	</div>
	<br>
	<div class="footer">
		&copy; yourmarket.com | Designed by Richard Lhuissier & Etienne Correge
	</div>
</body>	
	
</html>


<?php
			
		if(isset($_POST['submit'])){

			
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
		
		$fn=$_POST['firtsname'];
		$ln=$_POST['lastname'];
		$email=$_POST['email'];
		$tel=$_POST['phone'];
		$adress=$_POST['adress'];
		$id=$_SESSION['id'];
			echo $fn.$ln.$email.$tel.$adress.$id;


				$sql = $mysqli->prepare("UPDATE user SET fname=?,lname=?,email=?,tel=?,adress=? WHERE id=?"); 
				$sql->bind_param("ssssss", $_POST['firtsname'], $_POST['lastname'], $_POST['email'], $_POST['phone'], $_POST['adress'],$_SESSION['id']);
				$sql->execute();
				echo "MODIF EFFECTUE";		

		  $mysqli->close();
		  
		}
	
	?>