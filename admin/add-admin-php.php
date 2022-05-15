<?php
include("../config/constants.php");

?>
<?php

//process the value from form and save it in database
//check whether the submit button is clicked or not
if (isset($_POST['submit']))
{

	 $full_name = $_POST['full_name'];
	 $user_name = $_POST['user_name'];
	$password= md5($_POST['password']);
}
// sql query to save data into database
	$sql="INSERT INTO tbl_admin  SET 
	full_name ='$full_name',
	user_name ='$user_name',
	password ='$password'
	";
	
		// executing Query and saving data in data base
		$res = mysqli_query($conn,$sql) or die (mysqli_error());
		

if($res==TRUE){
	//echo "data inserted";
	//create a session variable to display message
	$_SESSION['add']= "Admin Added Sucessfully";
	//redirect page to manage Admin
	header('location:'.SITEURL.'admin/manage-admin.php');
	
}
else{
	//echo "data not inserted";
	//create a session variable to display message
	$_SESSION['add']= "FAiled to add admin";
	//redirect page to add Admin
	header('location:'.SITEURL.'admin/add-admin.php');
	
	}

 
?>