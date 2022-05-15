<?php
include('partial/menu.php');
?>
<div class="main-category">
	<div class="wrapper">
		<h1>Add admin</h1>

		<?php   
if (isset($_SESSION['add']))  //Checking whether the session is set or not
 {
            echo $_SESSION['add'];//display the session message
            unset($_SESSION['add']);//removing the Session message
        }

		   ?>
		<form action="add-admin-php.php" method="POST">
		<table class="tbl-30">
			<br><br>
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
				<td>Password:</td>
				<td>
					<input type="Password" name="password" placeholder="Enter your Password">
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit"  name="submit" value="Add admin" class="btn-secondary">
				</td>
			</tr>
		</table>
		</form>
	</div>
</div>

<?php
include('partial/footer.php');
?>
