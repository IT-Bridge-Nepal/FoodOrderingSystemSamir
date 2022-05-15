<?php
	//include constant.php file
	include('../config/constants.php');
?>
  
<?php
  //get the id of admin to be deleted
    $id = $_GET['id'];


// create sql query to delete admin
   $sql ="DELETE FROM tbl_admin WHERE id=$id"; 


//redirect to manage admin page with message (sucess /error) 
$res = mysqli_query($conn,$sql);


//check whether the query is esecuted sucessfully or not
if ($res==true) 
{


	//query executed and sucessfully deleted
	//echo 'admin deleted';
	//create session variable to display message
	$_SESSION['delete']="<div class='success'>admin deleted sucessfully.</div>";
	//redirect to manage-admin.php
	header('location:'.SITEURL.'admin/manage-admin.php');


}else{
//failed to delete admin
	//echo "failed to delete admin";
$_SESSION['delete']="<div class = 'error'>failed to deleted try again.</div>";
header('location:'.SITEURL.'admin/manage-admin.php');



}
  ?>
