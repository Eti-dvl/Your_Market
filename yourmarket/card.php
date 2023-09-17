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
					<a href="categories.php"><li>Categories</li></a>
					<?php
					if($_SESSION['id']!=0){
						echo "<a href='sell.php'><li>Sell</li></a>";
						echo "<a href='youraccount.php'><li>Your Account</li></a>";
					}else{
						echo "<a href='youraccount_log_sig.php'><li>Sell</li></a>";
						echo "<a href='youraccount_log_sig.php'><li>Log/sign</li></a>";
					}
					echo "<a href='cart.php'><li class='selected'>Cart</li></a>";
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
			<div class="sidebar">
				<a href="cart.php">Cart</a>
				<a href="card.php">Card</a>
			</div>
			
		
			<div class="cart">
				<div class="cardform">
					<form>
					<table>
						<thead>
							<tr>
								<center><h1>CARD</h1></center>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<label>Owner</label>
								</td>
								<td>
									<label>CVV</label>
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" placeholder="Ex: Jean Michel" required>
									<br><br>
								</td>
								<td>
									<input type="password" placeholder="Ex: 333" required>
									<br><br>
								</td>
							</tr>
							<tr>
								<td>
									<label>Card Number</label>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<input type="text" placeholder="Ex: 1234 5678 9012 3456" required>
									<br><br>
								</td>
							</tr>
							<tr>
								<td>
									<label>Expiration Date</label>
								</td>
							</tr>
							<tr>
								<td>
									<SELECT name="quantity" size="1" style="width:150px;">
										<option>Jan</option>
										<option>Feb</option>
										<option>Mar</option>
										<option>Apr</option>
										<option>May</option>
										<option>Jun</option>
										<option>Jul</option>
										<option>Aug</option>
										<option>Sept</option>
										<option>Oct</option>
										<option>Nov</option>
										<option>Dec</option>
									</SELECT>
									<br><br>
								</td>
								<td>
									<SELECT name="quantity" size="1" style="width:150px;">
										<option>2021</option>
										<option>2022</option>
										<option>2023</option>
										<option>2024</option>
										<option>2025</option>
										<option>2026</option>				
									</SELECT>
									<br><br>
								</td>	
							</tr>
							<tr>
								<td colspan="2">
								<center>
									<input type="radio" name="card" value="big" id="carteblueue">
									<img src="carteBleue.jpg">
									<input type="radio" name="card" value="big" id="mastercard">
									<img src="mastercard.png">
									<input type="radio" name="card" value="big" id="visa">
									<img src="visa.png">

									<br><br>
								</center>
								</td>
							</tr>
							<tr>
								<td colspan="2">
								<center>
									<input type="Submit" value="Submit">
								</center>
								</td>
							</tr>
						</tbody>				
					</table>
					</form>
				</div>
			</div>
		</div>
	
		<div class="footer">
			&copy; yourmarket.com | Designed by Richard Lhuissier & Etienne Correge
		</div>
	
	</body>
</html>