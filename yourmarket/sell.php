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
						echo "<a href='sell.php'><li class='selected'>Sell</li></a>";
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
		<center><h1>SELL</h1></center>
		
		<div class='sellform' border='solid' style='margin-left:20%'>			
			<form action='sell.php' method='POST' enctype='multipart/form-data' style='margin-left:20px; margin-top:20px;' >				
				<table>
					<tr>
						<td>
							<label for='brand'>Tell us about your item (brand, model, orther details...)</label><br><br>
							<input type='text' name='brand'><br><br>
							
							<label for='name'>Name :</label><br><br>
							<input type='text' name='name'><br><br>
							
							<label for='description'>Description :</label><br><br>
							<textarea name='description'></textarea><br><br>
							
							<label for='category'>Category :</label><br><br>
							
								<SELECT name='category' size='1' style='width:150px;'>
									<option selected>Vinyl</option>
									<option>Guitar</option>
									<option>Light</option>
								</SELECT>
							<br><br>							
							
						</td>
						
						<td>
							<br>Add a photo :<br><br>
							<input type='file' name='image' accept='image/png, image/jpeg'></input>
							<br><br>
							<label for='price'>Price :</label><br><br>
							<input type='text' name='price'><br><br>
							
							Type of selling :<br><br>
							<input type='radio' name='selltype' value='Buy'> Buy it now <br>
							<input type='radio' name='selltype' value='Auction'> Auction <br>
							<input type='radio' name='selltype' value='Best'> Best offer
							
						</td>
					</tr>
				</table>
				<script>
					function add(){
						alert("Item Added");
					}
						
				</script>
					<center><input type='submit' name='submit' onclick='add()'></center>
				<br>			
				
			</form><br><br><br><br><br><br>
		</div>
		
		<br><br>
		<div style="float:bottom"><br></div>
			
		</div>
		
	</div>
	<div class="footer">
		&copy; yourmarket.com | Designed by Richard Lhuissier & Etienne Correge
	</div>
</body>	
	
</html>

<?php
			
		if(isset($_POST['submit'])){
			
			
		
				if($_POST['brand'] != "" && $_POST['name'] != "" && $_POST['description'] != "" && $_POST['category'] != ""){
					echo "COOL";
					/*
		* Change the value of $password if you have set a password on the root userid
		* Change NULL to port number to use DBMS other than the default using port 3306
		*
		*/
		$test = true;
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
					
					
				$sql = $mysqli->prepare("INSERT INTO item(brand,category,model,description,startingprice,sellerid,type) VALUES (?,?,?,?,?,?,?)"); 
				$sql->bind_param("sssssss", $_POST['brand'], $_POST['category'], $_POST['name'], $_POST['description'], $_POST['price'],$_SESSION['id'],$_POST['selltype']);
				$sql->execute();
				echo "AJOUT EFFECTUE";	
				$itemid=$mysqli->insert_id;			
					
					
					
	
					// Get image name
			$image = $_FILES['image']['name'];
			// Get text
			

			// image file directory
			$target = "images/".basename($image);
			
			$sql = "INSERT INTO images (image,itemid) VALUES ('$image','$itemid')";
			// execute query
			mysqli_query($mysqli, $sql);
			

			if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
				$msg = "Image uploaded successfully";
			}else{
				$msg = "Failed to upload image";
			}
		  
		  $result = mysqli_query($mysqli, "SELECT * FROM images");
		  $mysqli->close();
		  header("Location:youraccount.php");
		  
		}
	}
	?>