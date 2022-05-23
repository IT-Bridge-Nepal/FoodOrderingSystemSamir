<?php include('partial/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br />
        <br />

        <?php

        // check whether the id is set or not
        if (isset($_GET['id'])) {
            // get id and all the data
            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_food WHERE id=$id";

            $res = mysqli_query($conn, $sql);

            // count the rows
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $current_image = $row['image_name'];
                $current_category = $row['category_id'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                // redirect to manage category page with session msg
                $_SESSION['no-category-found'] = "<div class='error'>Food not found</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            }
        } else {
            // redirect to manage category page
            header('location:' . SITEURL . 'admin/manage-food.php');
        }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
               <td>Description :</td>
               <td>
                   <textarea  name="description" cols="30" rows="5"  ><?php echo $description; ?></textarea>
                </td>
               
           </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
                </tr>
                <tr>
                    <td>Current Image</td>
                    <td>
                        <?php
                        if ($current_image != '') {
                            // display image 
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="100px">
                        <?php
                        } else {
                            // display msg
                            echo 'Image not added for this food.';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
               <td> Category :</td>
               <td>
                   <select name="category">
                       <?php
                        // php code to display categories from db

                        // create sql to get all active categories from db
                        $sql3 = "SELECT * FROM tbl_category WHERE active='Yes'";
                        
                        // execute query
                        $res3 = mysqli_query($conn , $sql3);

                        // count rows to check whether we have catogory or not
                        $count = mysqli_num_rows($res3);

                        // if count > 0 we have  categories
                        if($count>0)
                        {
                            //we have categories
                            while($row=mysqli_fetch_assoc($res3))
                            {
                                // get details of categories
                                $category_title = $row['title'];
                                $category_id = $row['id'];
                                

                                ?>
                                <option <?php if ($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id ;?>"><?php echo $category_title ;?></option>

                                <?php
                            }
                        }
                    
                        else
                        {
                            
                               echo "<option value='0'>No category found</option>";
                            

                        }
                        // display on dropdown


                        ?>
                       
                       

                   </select>
                <tr>
                    <td>Featured:</td>
                    <td><input <?php if ($featured == 'Yes') {
                                    echo 'checked';
                                } ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if ($featured == 'No') {
                                    echo 'checked';
                                } ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td><input <?php if ($active == 'Yes') {
                                    echo 'checked';
                                } ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if ($active == 'No') {
                                    echo 'checked';
                                } ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?> ">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php

if (isset($_POST['submit'])) {
    // get all the values from the form
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $current_image = $_POST['current_image'];
    $category = $_POST['category'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];


    // updating new image if selected
    // check whether the image is selected or not
    if(isset($_FILES['image']['name'])) {
        // get the image details
        $image_name = $_FILES['image']['name'];

        // check whether the image is available or not
        if ($image_name != "") {
            // image is available
            // upload the new image

            // auto rename image
            // get extension if the image(.jpg, .png, .gif etc)
            $ext = end(explode('.', $image_name));

            // rename the image
            $image_name = "Food_Category_".rand(0000, 9999).'.'.$ext;

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/food/" . $image_name;

            // var_dump($destination_path);
            // die;
            // finally upload the file
            $upload = move_uploaded_file($source_path, $destination_path);


            // check whether the image is uploaded or not
            // if not uploaded we will stop the process and redirect with error msg
            if ($upload == FALSE) {
                // set session msg
                $_SESSION['upload'] = "Failed to upload image";
                header('location:' . SITEURL . 'admin/manage-food.php');
                die();
            }
            // if (array_key_exists('current_image', $_POST)) {
            //     $filename = $_POST['current_image'];
            //     // var_dump($filename);
            //     // die;
            //     if (file_exists($filename)) {
            //     unlink($filename);
            //     }
            // }
    // remove the current image if available    
    if ($current_image!= "") 
            
    {
        // image is available and remove it
        

        // remove the image
        $path = '../images/food/'.$current_image;
        

        // remove the image
        $remove = unlink(realpath($path));


        // var_dump($remove);
        // die;

        // if failed to remove image then display error msg and stop the process
        if ($remove == false) 
        {
            // set the session msg
            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove food image</div>";
            // redirect to manage category page
            header('location:' . SITEURL . 'admin/manage-food.php');
            // stop the process
            die;
        }
    }
            
        } 
        else 
        {
            $image_name = $current_image; //default image when image is not selected
        }
    }
     else
      {
        $image_name = $current_image; //default image when button is not clicked
    }

    // update the database
    $sql2 = "UPDATE tbl_food SET
    title = '$title',
    description = '$description',
    price = $price,
    image_name = '$image_name',
    category_id = '$category',
    featured = '$featured',
    active = '$active'
    WHERE id=$id 
    ";

    // execute the query
    $res2 = mysqli_query($conn, $sql2);

    // redirect to manage category with msg
    // check whether query executed or not
    if ($res2 == true) {
        // category updated
        $_SESSION['update'] = "<div class='success'>Food updated succesfully.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    } else {
        // failed to update category
        $_SESSION['update'] = "<div class='error'>Failed to update food.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    }
}
?>
    </div>
</div>
<?php include('partial/footer.php'); ?>