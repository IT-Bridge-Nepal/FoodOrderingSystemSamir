<?php include("partial/menu.php");?>

<div class="main-content">
	<div class="wrapper">
		<h1>Update Admin</h1>
		<br><br>
<?php     

//get the id of selected admin
$id=$_GET['id'];


//create sql query to get the details
$sql="SELECT *FROM tbl_admin WHERE id=$id";



//execute the query
$res=mysqli_query($conn,$sql);
 

  //check whether the query is executed or not
if($res==true)

 {
	// check whether the data is available or not
	$count=mysqli_num_rows($res);

	//check whether we have admin data or not
	if($count==1)
	{

	//get the details
	//echo "admin details available";
		$row=mysqli_fetch_assoc($res);
		$full_name=$row['full_name'];
		$user_name=$row['user_name'];


	}
	else
	{

		//redirect to manage-admin php
		header('location:'.SITEURL.'admin/manage-admin.php');

	}

}
?>

		<form action="" method="POST">
		<table class="tbl-30">
			<br>
			<tr>
				<td>Full Name:</td>
				<td><input type="text" name="full_name" value="<?php echo $full_name;?>" placeholder="Enter your Full Name"></td>

			</tr>
			<tr>
				<td>Username:</td>
				<td>
					<input type="text" name="user_name" value="<?php echo $user_name  ?>" placeholder="Enter your Name">
				</td>
			</tr>
			
			<tr>
				<td colspan="2">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<input type="submit"  name="submit" value="update admin" class="btn-secondary">
				</td>
			</tr>
		</table>
	</form>
	</div>
</div>


<?php    
if (isset($_POST['submit'])) {
//echo "button clicked"
	//get all the values from form to update
	$id =$_POST['id'];
	$full_name=$_POST['full_name'];
	$user_name=$_POST['user_name'];


	//create a sql query to update admin
	$sql="UPDATE tbl_admin SET
	full_name='$full_name',
	user_name='$user_name'
where id='$id'
	";

	//execute the query
	$res = mysqli_query($conn,$sql);

	//check whether the query executed or not
	if ($res==true) {
		//query executed and admin updated
		$_SESSION['update']="<div class='success'> Admin updated Sucessfully </div>";
		//redirect to manage-admin.page
		header('location:'.SITEURL.'admin/manage-admin.php');

	}else{
		//failed to update admin
		$_SESSION['update']="<div class='error'>failed to updated admin</div>";
		//redirect to manage-admin.page
		header('location:'.SITEURL.'admin/manage-admin.php');
	}
}

?>
<?php include("partial/footer.php")  ?>