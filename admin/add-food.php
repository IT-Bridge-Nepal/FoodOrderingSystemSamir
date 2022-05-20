<?php include('partial/menu.php');?>


<div class="main-category">
    <div class="wrapper">
        <h1>Add Food</h1>


        <br><br>
        <?php  
if (isset($_SESSION['upload'])) {
	echo $_SESSION ['upload'];
	unset ( $_SESSION['upload']);
}


        ?>
        <form action="" method="POST" enctype="multipart/form-data">

        	<table class="tbl-30">
        		<tr>
        			<tr>
               <td>Title :</td>
               <td>
                   <input type="text" name="title" placeholder="Category Title">
                </td>
            </tr>
				<tr>
                <td>Description</td>
                <td>
                	<textarea name="description" cols="30" rows="10"></textarea>
                </td>
            </tr>
            <tr>
            <td>Price:</td>
            <td>
            	<input type="number" name="price">
            </td>               
           </tr>



           <tr>
               <td>Select Image :</td>
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
                                $id = $row['id'];
                                $title = $row['title'];

                                ?>
                                <option value="<?php echo $id ;?>"><?php echo $title ;?></option>

                                <?php
                            }
                        }
                        else
                        {
                            ?>
                                <option value="0">No category found</option>
                            <?php

                        }
                        // display on dropdown


                        ?>


           		
           	</select>
           </td>
    </tr>      
           <tr>
               <td>Featured :</td>
               <td>
                   <input type="radio" name="featured" value="Yes">Yes
                   <input type="radio" name="featured" value="No">No

                </td>
               
           </tr>
           <tr>
               <td>Active :</td>
               <td>
                   <input type="radio" name="active" value="Yes">Yes
                   <input type="radio" name="active" value="No">No

                </td>      
           </tr>
           <tr>
           	<td colspan="2">
           		<input type="submit" name="submit" value="Add Food" class="btn-secondary">
           	</td>
           </tr>
        		






        	</table>
        		

        	
        	



        </form>
        <?php 
        //check whether the button is clicked or not
        if (isset($_POST['submit'])) {
        	//add the food in database
        	// button clicked


        	//1. get the data from form
        	$title =$_POST['title'];
        	$description=$_POST['description'];
        	$price=$_POST['price'];
        	$category=$_POST['category'];

        	//check whether radio button featured and active are checked or not
        	if(isset($_POST['featured'])){
        		$featured=$_POST['featured'];
        	}else{
        		$featured="No";  //setting the default values
        	}
        	if(isset($_POST['active'])){
        		$active=$_POST['active'];
        	}else{
        		$active="No";  //setting the default values
        	}


        	//2. upload the image if selected
        	

        	//check whether the select image is clicked or not and upload the image only if the image is selected
        	if (isset($_FILES['image']['name'])) {
        		

        		//get the details of the selected image
        		$image_name=$_FILES['image']['name'];
        		

        		//check whether the image is selected or not if selected
        		if ($image_name !="") {
        			//image is selected


        			//rename the image
        			//get the extension of selected image (jpg,png etc)
        			$e = explode('.', $image_name);
        			$ext = end($e);


        			//create name for image
        			$image_name="food-name".rand(000,999).".".$ext; //new image name 

        			//upload the image
        			//get the source path and destination path
        			//source path is the current location of the iamge 
        			$src=$_FILES['image']['tmp_name'];
        			//destination path for the image to be uploaded
        			$dst="../images/food/".$image_name;

        			//finally upload image 
        			$upload = move_uploaded_file($src,$dst);

        			//check image uploaded or not
        			if ($upload==false) {
        				//failed to upload image
        				//redirect to add food page with error message
        				$_SESSION['upload']="<div class='error'>Failed to upload image</div";
        				header('location:'.SITEURL.'admin/add-food.php');
        				//stop the process
        				die();
        			}



        		}
        	}else{
        		$image_name=""; //setting default value on blank
        	}

        	//3.insert into database
        	//create a sql query to insert data in database
        	$sql2="INSERT INTO tbl_food SET
        	title='$title',
        	description='$description',
        	price=$price,
        	image_name='$image_name',
        	category_id='$category',
        	featured='$featured',
        	active='$active'
        	";

        	//execute the query 
        	$res2=mysqli_query($conn,$sql2);
        	//check data inserted or not
        	//4.redirect to message to manage food.php
        	if ($res2==true) {
        		
        		// data inserted successfully
        		$_SESSION['add']="<div class='success'>food added successfully</div>";
        				header('location:'.SITEURL.'admin/manage-food.php');
        				

        	}else{
        		//failed to insert data
        		$_SESSION['add']="<div class='error'>Failed to add food</div";
        				header('location:'.SITEURL.'admin/manage-food.php');
        				
        	}



        	
        }
          ?>
    </div>
</div>







<?php  include ('partial/footer.php');?>