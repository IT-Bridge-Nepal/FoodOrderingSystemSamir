<?php include('partial/menu.php');
?>
<div class="main-category">
    <div class="wrapper">
        <h1>Manage Food </h1>
        <br><br>
        <!-- button in add admin -->
        <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add food </a></button>
        <br></br><br>
        <?php  
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        ?>
        <table class="tbl">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>

            </tr>

            <?php
//create sql query to get all the food
            $sql="SELECT * FROM tbl_food";

            //execyte the query
            $res=mysqli_query($conn,$sql);


            //count row to check whether we have food or not
            $count=mysqli_num_rows($res);

            //create serial number variable and set default value as 1
            $sn=1;

            if ($count>0) {
                //we have food in database
                //get the food from database
                while($row=mysqli_fetch_assoc($res)){
                    //get the value from individual columns
                    $id =$row['id'];
                    $title =$row['title'];
                     $price=$row['price'];
                      $image_name =$row['image_name'];
                       $featured =$row['featured'];
                        $active =$row['active'];

                        // var_dump($image_name);
                        // die();
                        ?>

                    <tr>
                    <td><?php echo $sn++;?></td>
                    <td> <?php echo $title ;?></td>
                    <td><?php echo $price ;?></td>
                     <td><?php 
//check we have image or not
                     if ($image_name=="") 
                     {
                         // we donot have image,display error message
                        echo "<div class='error'>image not added</div>";
                     }else{
                        //we have image display image
                        ?>
                         <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;?>" width="100px">

                        <?php
                     }
                     ?>
                     </td>
                      <td><?php echo $featured ;?></td> 
                       <td><?php echo $active ;?></td> 
                    <td>
                        
                        <a href="#" class="btn-secondary"> Update Food </a>
                        <a href="#" class="btn-danger"> Delete Food </a>
                    </td>
                </tr>


                        <?php



                }
            }
            else{
                //food not added in database
                echo "<tr> <td colspan='7' class='error'>Food not added</tr></td>";
            }


            ?>
          
        </table>
    </div>

</div>


<?php include('partial/footer.php');
?>