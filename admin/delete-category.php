<?php
//include constant  file
include('../config/constants.php');
//echo "delete page";
//check whether the id and image_name is set or not
if (isset($_GET['id'])AND isset($_GET['image_name']))
 {
	//get the value and delete
	//echo "get value and delete";
	$id =$_GET['id'];
	$image_name= $_GET['image_name'];

	//remove the physical image file if available
if ($image_name !="")
 {
	// image is available so remove it

 		$path ="../images/category/".$image_name;
 		//remove the image
 		$remove =unlink($path);

 		//if failed to remove image then add error msg and stop the process
 		if ($remove==false) {
	//set the session message
 			$_SESSION['remove']="<div class='error'>Failed to Remove Category Image</div>";
 			//redirect to manage category.php
 			header('location:'.SITEURL.'admin/manage-category.php');
 				//stop the process
 				die();
	 		}
}

	//Delete data from database
//sql query delete data from database

$sql="DELETE FROM tbl_category where id=$id";
//execute the query
$res=mysqli_query($conn,$sql);

//check whether the data is deleted or not from database
if ($res==true) {
	// set success message and redirect
	$_SESSION['delete']="<div class='success'>category deleted successfully</div>";
	header('location:'.SITEURL.'admin/manage-category.php');
}else{
	//set failed message and redirect
	$_SESSION['delete']="<div class='error'>category deleted failed</div>";
	header('location:'.SITEURL.'admin/manage-category.php');

}


	//Redirect to manage Category page with message

}else{
	//redirect to manage-catogery page
	header('location:'.SITEURL.'admin/mmanage-category.php');


}


 ?>