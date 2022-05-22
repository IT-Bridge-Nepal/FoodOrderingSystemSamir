<?php
//include constant  file
include('../config/constants.php');
//echo "delete page";
//check whether the id and image_name is set or not
if (isset($_GET['id'])AND isset($_GET['image_name']))
 {

	//process to delete
 	//Get id and image name
 	$id =$_GET['id'];
	$image_name= $_GET['image_name'];


 	//remove the image if available
 	//.check image is available or not and delete only if available
 	if ($image_name !="")
 {
	// image is available so remove it
	//get image path
 		$path ="../images/food/".$image_name;
 		//remove the image
 		$remove =unlink($path);

 		//if failed to remove image then add error msg and stop the process
 		if ($remove==false) {
	//set the session message
 			$_SESSION['upload']="<div class='error'>failed to remove image file</div>";
 			//redirect to manage food.php
 			header('location:'.SITEURL.'admin/manage-food.php');
 				//stop the process
 				die();
	 		}
}


 	//delete food from database
$sql="DELETE FROM tbl_food where id=$id";
//execute the query
$res=mysqli_query($conn,$sql);

//check whether the data is deleted or not from database and set the session meesage respectively
if ($res==true) {
	// set success message and redirect
	$_SESSION['delete']="<div class='success'>food deleted successfully</div>";
	header('location:'.SITEURL.'admin/manage-food.php');
}else{
	//set failed message and redirect
	$_SESSION['delete']="<div class='error'>food deleted failed</div>";
	header('location:'.SITEURL.'admin/manage-food.php');

}


 	
 }else{
 	$_SESSION['unauthorized']="<div class='error'>unauthorized Access</div>";
 			//redirect to manage category.php
 			header('location:'.SITEURL.'admin/manage-food.php');
 }
	


 ?>