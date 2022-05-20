<?php
include("../config/constants.php");?>
<?php   
//check whether the submit button is clicked or not
		if (isset($_POST['submit'])) {
			//echo "button clicked";
		//Get the value from category form
			$title = $_POST['title'];
			//for Radio input we need to check whether the button is selected or not
			if (isset($_POST['featured']))
			 {
				//get the value from form
				$featured = $_POST['featured'];
			}

		}else{
			//set the default value
			$featured = "No";
		}

			if (isset($_POST['active']))
			 {
				//get the value from form
				$active = $_POST['active'];
			}else{
				$active="No";
			}

		//check whether the image is selected or not and set the value for image name accordingly
			// print_r($_FILES['image']);
			// die();//break the code

			if (isset($_FILES['image']['name'])) {
				

				// upload image
				//to upload image we need image name and source path and destination
				$image_name = $_FILES['image']['name'];

				//upload the image only if image is selected
				if ($image_name!="") {
				 	// code...
				 

				
				//Auto rename image 
				
				//get the extension of our image(jpg,png,gif,etc)eg "foof.jpg"
				$ext=end(explode('.',$image_name));
				

				//rename the image
				$image_name = "food_category_".rand(000,999).'.'.$ext; //eg food_category_834.jpg
				

				$source_path = $_FILES['image']['tmp_name'];

				$destination_path="../images/category/".$image_name;

				//finally upload the image
				$upload = move_uploaded_file($source_path, $destination_path);

				//check whether the image is uploaded or not
				//and if the image is not uploaded then the process are stop and redirect with error message
				if ($upload==false) {
					// set message
					$_SESSION['upload']="<div class='error'>failed to upload image</div>";
					//redirect to add category page
					header('location:'.SITEURL.'admin/add-category.php');
					//stop the process
					die();
				}
				}
			}else{

				//dont upload image and set image_name values as blank
				$image_name="";
			}

//create sql query to insert category into database
			$sql = "INSERT INTO tbl_category SET
			title='$title',
			image_name='$image_name',
			featured='$featured',
			active='$active'
			";

			//execute the query and save the database
			$res=mysqli_query($conn,$sql);
			
			//Check whether the data is executed or not and data is added or not
			if ($res==true) 
			{
				
				//Query executed and category added
				$_SESSION['add']="<div class='success'>Category added successfully</div>";
				//redirect to manage-category page
				header('location:'.SITEURL.'admin/manage-category.php');

			}else{
				//failed to add category
				$_SESSION['add']="<div class='error'>failed to add Category  </div>";
				//redirect to manage-category page
				header('location:'.SITEURL.'admin/add-category.php');

			}
  ?>

