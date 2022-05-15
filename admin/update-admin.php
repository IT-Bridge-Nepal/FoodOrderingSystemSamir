<?php include("partial/menu.php");?>

<div class="main-content">
	<div class="wrapper">
		<h1>Update Admin</h1>
		<br><br>
		<form action="" method="POST">
		<table class="tbl-30">
			<br>
			<tr>
				<td>Full Name:</td>
				<td><input type="text" name="full_name" placeholder="Enter your Full Name"></td>

			</tr>
			<tr>
				<td>Username:</td>
				<td>
					<input type="text" name="user_name" placeholder="Enter your Name">
				</td>
			</tr>
			
			<tr>
				<td colspan="2">
					<input type="submit"  name="submit" value="update admin" class="btn-secondary">
				</td>
			</tr>
		</table>
	</form>
	</div>
</div>



<?php include("partial/footer.php")  ?>