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
						echo "<a href='youraccount_log_sig.php'><li class='selected'>Your Account</li></a>";
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
	
	<div class="containerdefault">
	
		<!-- zone de connexion -->
        <div class="signinform" border="solid" style="background-color: white">
			<center>
            <form action="youraccount_signin.php" method="POST">
                <h1>Sign in !</h1>
                
                <label><b>First name</b></label><br><br>
                <input type="text" placeholder="Enter first name" name="firstname" required>
				<br><br>
				<label><b>Last name</b></label><br><br>
                <input type="text" placeholder="Enter last name" name="lastname" required>
				<br><br>
				<label><b>E-mail</b></label><br><br>
                <input type="text" placeholder="Enter E-mail" name="email" required>
				<br><br>
				<label><b>Adress</b></label><br><br>
                <input type="text" placeholder="Enter your adress" name="adress" required>
				<br><br>
				<label><b>Phone Number</b></label><br><br>
				<input type="text" placeholder="Petit 06" name="phone" required>
				<br><br>
                <label><b>Password</b></label><br><br>
                <input type="password" placeholder="Enter Password" name="password" required>
				<br><br>
				<label><b>Confirm Password</b></label><br><br>
                <input type="password" placeholder="Confirm Password" name="confirmpassword" required>				
				<br><br>
				<br>
                <input type="submit" name='submit' value='SIGN IN' >
            </form></center>
		</div>
	</div>
	<div class="footer">
		&copy; yourmarket.com | Designed by Richard Lhuissier & Etienne Correge
	</div>
</body>	
	
</html>

<?php
			
		if(isset($_POST['submit'])){
			if($_POST['password']!=$_POST['confirmpassword']){
				echo "DIFFERENT PASSWORDS";
			}else{
				
				if($_POST['firstname'] != "" && $_POST['lastname'] != "" && $_POST['email'] != "" && $_POST['adress'] != "" && $_POST['phone'] != "" && $_POST['password'] != "" && $_POST['confirmpassword'] != ""){
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
									//$id=1;
								$sql = $mysqli->prepare("INSERT INTO user(fname,lname,email,password,tel,adress,photo,background) VALUES (?,?,?,?,?,?,?,?)"); 
								$sql->bind_param("ssssssss", $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['adress'], $_POST['phone'],$_POST['password'],$_POST['password'],$_POST['password']);
								
								$sql->execute();
								echo "AJOUT EFFECTUE";	
								$itemid=$mysqli->insert_id;			
									
									
									
					
									//Get image name
							// $image = $_FILES['image']['name'];
							//Get text
							

							//image file directory
							// $target = "images/".basename($image);
							
							// $sql = "INSERT INTO images (image,itemid) VALUES ('$image','$itemid')";
							//execute query
							// mysqli_query($mysqli, $sql);
							

							// if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
								// $msg = "Image uploaded successfully";
							// }else{
								// $msg = "Failed to upload image";
							// }
						  
						  //$result = mysqli_query($mysqli, "SELECT * FROM images");
						  $mysqli->close();
						  
						  $_SESSION['id']=$itemid;
						  $_SESSION['name']=$_POST['firstname'];
						  header("Location:youraccount.php");
						  
						}else{
							echo "MISSING INFORMATIONS";
						}
			}
	}
	?>