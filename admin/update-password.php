<?php 
include('partial/menu.php');?>
 
<div class="main-content">
	<div class="wrapper">
		<h1>Change Password</h1>
		<br><br>
		<?php 
			if (isset($_GET['id'])) {
				$id=$_GET['id'];
			}
		  ?>

		  <form action=""method="POST">
		  	 <table class="tbl-30">
		  	 	<tr>
		  	 		<td>Current Password:</td>
		  	 		<td>
		  	 			<input type="Password" name="current_password" placeholder="Current Password">
		  	 		</td>
		  	 	</tr>
		  	 	<tr>
		  	 		<td>New Password:</td>
		  	 		<td>
		  	 			<input type="Password" name="new_password" placeholder="New password">
		  	 		</td>
		  	 		<tr>
		  	 		<td>Confirm password: </td>
		  	 		<td>
		  	 			<input type="Password" name="confirm_password" placeholder="confirm Password">
		  	 			
		  	 		</td>
		  	 		</tr>
		  	 		<tr>
		  	 			<td colspan="2">
		  	 				<input type="hidden" name="id" value="<?php echo $id; ?>">
		  	 				<input type="submit" name="submit" value="change password" class="btn-secondary">
		  	 			</td>
		  	 		</tr>

		  	 	</tr>
		  	 	
		  	 </table>


		  </form>
		
	</div>
</div>
<?php
//check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
	//echo 'button clicked';
	//get data from form
	$id=$_POST['id'];
	$current_password=md5 ($_POST['current_password']);
	$new_password=md5 ($_POST['new_password']);
	$confirm_password=md5 ($_POST['confirm_password']);

	//check whether the user current password exist or not
	$sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

	//execute the query
	$res=mysqli_query($conn,$sql);

	if ($res==true) {
		//check whether data is available or not
		$count=mysqli_num_rows($res);

		if ($count==1) {
			
			//user exist and password can be changed
			
			//echo "user found";
			
			//check whether the new password and confirm password match or not
			if ($new_password==$confirm_password) {
				
				// confirm the password
				
				//echo "password matched";
				$sql2="UPDATE tbl_admin SET password='new_password'
				WHERE id=$id 
				";

				//execute the query
				$res2 = mysqli_query($conn,$sql2);
				
				//check whether the query is executed or not
				if ($res2==true) {
				
					// we will display message 
					$_SESSION['password-changed'] = "<div class='success'>password change success.</div>";
				header('location:'.SITEURL.'admin/manage-admin.php');
				}else{
				
					//dispaly error message 
					$_SESSION['password-changed'] = "<div class='error'>password not matched.</div>";

					header('location:'.SITEURL.'admin/manage-admin.php');
				}
			}else{
				
				//redirect to manage admin page with error message
				$_SESSION['psw-not-matched'] = "<div class='error'>password did not matched.</div>";
			//redirect the user
				header('location:'.SITEURL.'admin/manage-admin.php');
			}
		}else{
			

			//user not exist and sent message and redirect 
			$_SESSION['user-not-found'] = "<div class='error'>user not found.</div>";
			

			//redirect the user
			header('location:'.SITEURL.'admin/manage-admin.php');
		}
	}
	//check whether the new password and confirm password match or not
	//change password if all above is true
}

?>

 <?php include('partial/footer.php')  ?>