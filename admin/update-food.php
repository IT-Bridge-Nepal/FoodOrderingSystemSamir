<?php include('partial/menu.php'); ?>



<div class="main-category">
    <div class="wrapper">
        <h1>Update Food</h1>
      <br><br>
      <?php
// check whether the id is set or not
		if (isset($_GET['id'])) {
			// get the id and all other details
			//echo "getting the data";
			$id= $_GET['id'];
			//create sql query to get all other details
			$sql2 = "SELECT * FROM tbl_food WHERE id=$id";

			//execute the query
			$res2 =mysqli_query($conn,$sql2);

			
				// get all the data.
				$row2 =mysqli_fetch_assoc($res2);
				$title=$row2['title'];
				$description=$row2['description'];
				$price=$row2['price'];
				$current_image=$row2['image_name'];
				$current_category=$row2['category_id'];
				$featured=$row2['featured'];
				$active=$row2['active'];
				// var_dump($title);
				// die;

			
			}
		else{
			//redirect to manage-category

			header('location:'.SITEURL.'admin/manage-food.php');
		}

?>

       <form action="" method="POST" enctype="multipart/form-data">

        	<table class="tbl-30">
        		
        			<tr>
               <td>Title :</td>
               <td>
                  <input type="text" name="title" value="<?php echo $title;?>">
                </td>
            </tr>
				<tr>
                <td>Description</td>
                <td>
                	<textarea name="description" cols="25" rows="5"><?php echo $description;?></textarea>
                </td>
            </tr>
            <tr>
            <td>Price:</td>
            <td>
            	<input type="number" name="price" value="<?php echo $price ; ?>">
            </td>               
           </tr>

 			<tr>
               <td>Current Image :</td>
               <td>
<?php
if ($current_image == "") {
	// image not available
	echo "<div class='error'>image not available</div>";
}else{
//image available
}
?>
<img src="<?php  echo SITEURL;?>images/food/<?php echo $current_image;?>"width="150px">

<?php

?>


                  
                </td>
               
           </tr>

           <tr>
               <td>Select New Image :</td>
               <td>
                   <input type="file" name="image" >
                </td>
               
           </tr>
<tr>
           <td>Category:</td>
           <td>
           	<select name="category">
           		<?php
                        // php code to display categories from db

                        // create sql to get all active categories from db
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                        
                        // execute query
                        $res = mysqli_query($conn , $sql);

                        // count rows to check whether we have catogory or not
                        $count = mysqli_num_rows($res);

                        // if count > 0 we have  categories
                        if($count>0)
                        {
                            //we have categories
                            while($row=mysqli_fetch_assoc($res))
                            {
                                // get details of categories
                                $category_title = $row['title'];
                                $category_id = $row['id'];
                            }
				// echo " <option value='$category_id'>$category_title</option>";
                            ?>

<option <?php if($current_category==$category_id){echo "selected";}?> value="<php echo $category_id;?>"><?php echo $category_title;?></option>
                            <?php
                                                            
                        }
                        else
                        {
                           //category not available
                       echo " <option value='0'>No category found</option>";
                            
                        }
                    
                       


                        ?>

           		
           		 	</select>
           </td>
    </tr>      
           <tr>
               <td>Featured :</td>
               <td>
                   <input <?php if ($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                   <input <?php if ($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No


                </td>
               
           </tr>
           <tr>
               <td>Active :</td>
               <td>
                   <input <?php if ($active=="Yes"){echo "checked";} ?>  type="radio" name="active" value="Yes">Yes
                   <input <?php if ($active=="No"){echo "checked";} ?>   type="radio" name="active" value="No">No
                </td>      
           </tr>
           <tr>
           	<td colspan="2">
           		<input type="hidden" name="id" value="<?php echo $id;?>">
           		<input type="hidden" name="current_image" value="<?php echo $current_image;?>">
					
           		<input type="submit" name="submit" value="Update Food" class="btn-secondary">
           	</td>
           </tr>	
			</table>
       </form>

       <?php
  if (isset($_POST['submit'])) {
	//echo "clicked";
	//gett all the values from form
	$id =$_POST['id'];
	$title=$_POST['title'];
	$description=$_POST['description'];
	$price=$_POST['price'];
	$current_image=$_POST['current_image'];
	$category=$_POST['category'];
	$featured=$_POST['featured'];
	$active=$_POST['active'];

	// upload the image if selected
	//check whether the image is selected or not
	if (isset($_FILES['image']['name'])) 
	{
		//upload button clicked
		$image_name=$_FILES['image']['name']; //new image name

		//check whether the file  is available or not
	if ($image_name !="") {
		//image available
		//upload new image

				//Auto rename image 
				
				//get the extension of our image(jpg,png,gif,etc)eg "foof.jpg"
				$e = explode('.', $image_name);
        			$ext = end($e);


				

				//rename the image
				$image_name = "food_name_".rand(000,999).'.'.$ext; //eg food_category_834.jpg
				

				$source_path = $_FILES['image']['tmp_name'];//source path

				$destination_path="../images/food/".$image_name; // destination path

				//finally upload the image
				$upload = move_uploaded_file($source_path, $destination_path);

				//check whether the image is uploaded or not
				//and if the image is not uploaded then the process are stop and redirect with error message
				if ($upload==false) {
					// set message
					$_SESSION['upload']="<div class='error'>failed to upload new image</div>";
					//redirect to add category page
					header('location:'.SITEURL.'admin/manage-food.php');
					//stop the process
					die();
				}

		//remove current image if available
				if ($current_image!="") {
				$remove_path="../images/food/".$current_image;
				$remove =unlink($remove_path);

				//check whether the image is removed or not
				//if failed to remove then stop the process and send message
				if ($remove==false) 
				{
					
					// failed to remove image
					$_SESSION['failed-remove']="<div class='error'>failed to remove current image</div>";
					header('location:'.SITEURL.'admin/manage-food.php');
					die(); //stop the process

					
				}
				
				}
	}else{
		$image_name = $current_image;
	}

	

	//update the data base
	$sql3 = "UPDATE tbl_food SET
	title='$title',
	description='$description',
	price='$price',
	image_name='$image_name',
	category_id='$category',
	featured='$featured',
	active='$active'
	WHERE id=$id
	";
	//execute the query
	$res3= mysqli_query($conn, $sql3);

	//redirect to manage category
	//Check whether executed or not
	if ($res3==true) {


		// category updated
		$_SESSION['update'] = "<div class='success'>Food updated sucessfully.</div>";
		header('location:'.SITEURL.'admin/manage-food.php');
	}

else{
	//failed to update Category
	$_SESSION['update'] = "<div class='error'>Food updated failed.</div>";
		header('location:'.SITEURL.'admin/manage-category.php'); 
}

}
}


       ?>
</div>
</div>

<?php include('partial/footer.php');?>