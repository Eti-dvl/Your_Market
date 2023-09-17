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
	
	<div class="container_item">
		<div class="signinform" border="solid" style="height: 300px;width: 300px; position:absolute;margin-left:600px">
			<center>
			<form action="youraccount_log_sig.php" method="POST">
                
				
				<h1>Admin access</h1>
                
                <label><b>E-mail</b></label><br><br>
                <input type="text" placeholder="Enter E-mail" name="adminmail" required>
				<br><br>
                <label><b>Password</b></label><br><br>
                <input type="password" placeholder="Enter Password" name="adminpassword" required>
				<br><br>
                <input type="submit" name='admin'>
				<br><br>

            
			
			</form>
			<?php 
							if(isset($_POST['admin'])){
					if (isset($_POST["adminmail"]))
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

							$sql = "SELECT * FROM admin WHERE email='".$_POST['adminmail']."' AND password='".$_POST['adminpassword']."'";
							$result = $mysqli->query($sql);
								
							if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										$_SESSION['admin']=$row['id'];
										
										header("Location:admin.php");
									}
								}	else{
									echo "Identifiants incorrects";
								}
								
								
								$mysqli->close();
				   }
				}
			?>
			</center>
		</div>
	
		<!-- zone de connexion -->
        <div class="signinform" border="solid" style="height: 400px">
			<center>
            <form action="youraccount_log_sig.php" method="POST">
                
				
				<h1>Connexion</h1>
                
                <label><b>E-mail</b></label><br><br>
                <input type="text" placeholder="Enter E-mail" name="email" required>
				<br><br>
                <label><b>Password</b></label><br><br>
                <input type="password" placeholder="Enter Password" name="password" required>
				<br><br>
                <input type="submit" name='submit'>
				<br><br>
			
                <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                }
                ?>
            
			
			</form><br><br>
			<?php 
							if(isset($_POST['submit'])){
					if (isset($_POST["email"]))
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

							$sql = "SELECT * FROM user WHERE email='".$_POST['email']."' AND password='".$_POST['password']."'";
							$result = $mysqli->query($sql);
								
							if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										$_SESSION['id']=$row['id'];
										$_SESSION['name']=$row['fname'];
										
										header("Location:youraccount.php");
										
										echo $_SESSION['id'].$_SESSION['name'];
									}
								}	else{
									echo "Identifiants incorrects";
								}
								
								
								$mysqli->close();
				   }
				}
			?>
			
			

				<a href="youraccount_signin.php">Create new account</a>
				</center>
		</div>
		
		
		
		
		
		
	</div>
	<div class="footer">
		&copy; yourmarket.com | Designed by Richard Lhuissier & Etienne Correge
	</div>
</body>	
	
</html>

