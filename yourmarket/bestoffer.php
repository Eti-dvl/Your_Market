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
	
		<h1 style="text-align:center"> BEST OFFER </h1>
			<center>
			<table class="table-buyitnow">
				<tr>
					<td><img src="phone.png" width="300" height="400"></td>
					<td > 
					<hX>Caracteristics</hX>
						<ul title="Caracteristics">
							<li>SIZE</li>
							<li>Storage</li>
						</ul>
									
					</td>
					<td>
						<div >
							<p style="color:red"> First price : 350€</p><br>
							<div style="font-style:italic">Number of the proposition: 1/5</div><br><br>
							Current proposition : 200€<br><br>
							<label for="proposition">New proposition</label>
							<input type="number" name="proposition"> 
							<input type="submit"><br><br>
							
							<p>Seller counter proposition : 325€</p>
							<div id="agreement" style="float:bottom;color:red; font-style:italic">(*)Since you made a proposition, you are under a <br>
legal contract for buying it if the seller accepts the offer.</div>
						</div>					
					</td>
				</tr>
				
				<!--<tr>
					<td> TIME LEFT : 3 days 2h</td>
					<td>Begining price : 100€ <br> Current best offer : 250€</td>
					<td>Your maximum offer : 0€</td>
				</tr>-->
				
			</table> <br><br><br>
			</center>
			
			
			
		
		<div class="footer">
			&copy; yourmarket.com | Designed by Richard Lhuissier & Etienne Correge
		</div>
	</body>
	
	
	
</html>