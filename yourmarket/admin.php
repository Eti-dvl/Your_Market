<?php session_start(); 
	

?>



<?php
if (isset($_POST["userid"]))
	   {		   
			$user = 'root';
			$password = ''; //To be completed if you have set a password to root
			$database = 'yourmarket'; //To be completed to connect to a database. The database must exist.
			$port = NULL; //Default must be NULL to use default port
			$mysqli = new mysqli('127.0.0.1', $user, $password, $database, $port);
			
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') '
						. $mysqli->connect_error);
			}
				$sql = "DELETE FROM user WHERE id=".$_POST['userid']."";
				$result = $mysqli->query($sql);
					$mysqli->close();
	   }



if (isset($_POST["itemid"]))
	   {		   
			$user = 'root';
			$password = ''; //To be completed if you have set a password to root
			$database = 'yourmarket'; //To be completed to connect to a database. The database must exist.
			$port = NULL; //Default must be NULL to use default port
			$mysqli = new mysqli('127.0.0.1', $user, $password, $database, $port);
			
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') '
						. $mysqli->connect_error);
			}
				$sql = "DELETE FROM item WHERE id=".$_POST['itemid']."";
				$result = $mysqli->query($sql);
					$mysqli->close();
	   }

?>	




<html>
	<head>
		<title>YOURMARKET-Home</title>
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="admin.js"></script>
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
						echo "<a href='youraccount_log_sig.php'><li >Log/sign</li></a>";
					}
					echo "<a href='cart.php'><li>Cart</li></a>";
					if($_SESSION['admin']!=0){	
						echo "<a href='admin.php'><li class='selected'>Admin</li></a>";
					}else{
						echo "<a href='youraccount_log_sig.php'><li class='selected'>Admin</li></a>";
					}
				?>	
			</ul>				
			
		</div>

	</header>
	
	<div class="list" style="margin-left:50px">
		<h1 style="margin-left:300px"> LIST OF ITEMS </h1>
		<table class="table-content">
		
		<form name="myformitem" action="admin.php" method="POST">
				
				<div>
					<input type="hidden" name="itemid" id="itemid" value="">
				</div>
		
			<thead>
				<tr>
					<th>Id num</th>
					<th>Item</th>
					<th>Category</th>
					<th>Price</th>
					<th>Description</th>
					<th>Remove item</th>
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
			$sql = "SELECT * FROM item";
			$result = $mysqli->query($sql);
		
		if ($result->num_rows > 0) {
						// output data of each row
						
						while($row = $result->fetch_assoc()) {
							
							
							echo "<tr>
					
								<td>".$row['id']."</td>
								<td>".$row['model']."</td>
								<td>".$row['category']."</td>
								<td>".$row['startingprice']."</td>
								<td>".$row['description']."</td>
								<td><button name='remove' value='".$row['id']."' onclick='removeitem(this.value)' style='background-color:red; color:white'>Remove</button></td>
								</tr>";
								
						}
					}
				$mysqli->close();	
		?>		
			</tbody>
			</form>
		</table>

		
		<a href="sell.php">
			<button style="background-color:green; color:white;margin-left:600px">Add new item</button><br><br>
		</a>
		
		<form action="admin.php" method="POST">
			<input type='submit' name="dcadmin" value="DISCONNECT" style="margin-left:800px">
		</form>
		
		
		<?php 
		if(isset($_POST['dcadmin'])){
			
			$_SESSION['admin']=0;
			header("Location:youraccount_log_sig.php");
		}
		
		?>
		
		
		</div>
		
		<hr>
		
		<div class="list" style="margin-left:50px">
		<h1 style="margin-left:300px"> SELLERS </h1>
		<table class="table-content">
			<form name="myform" action="admin.php" method="POST">
				
				<div>
					<input type="hidden" name="userid" id="userid" value="">
				</div>
				
				
					<thead>
						<tr>
							<th>id</th>
							<th>Name</th>
							<th>Last name</th>
							<th>Email</th>
							<th>Remove seller</th>
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
					$sql = "SELECT * FROM user";
					$result = $mysqli->query($sql);
				
				if ($result->num_rows > 0) {
								// output data of each row
								echo '<div class="layout">';
								while($row = $result->fetch_assoc()) {
									
									
									echo "<tr>
										<td>".$row['id']."</td>
										<td>".$row['fname']."</td>
										<td>".$row['lname']."</td>
										<td>".$row['email']."</td>
										<td><button name='remove' value='".$row['id']."' onclick='removeseller(this.value)' style='background-color:red; color:white'>Remove</button></td>
										</tr>";
								}
							}
						$mysqli->close();	
				?>		
					</tbody>
			</form>
			</table>

			
		
		</div>
	<div class="footer">
		&copy; yourmarket.com | Designed by Richard Lhuissier & Etienne Correge
	</div>
	
	</body>
</html>

	