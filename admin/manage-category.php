<?php include('partial/menu.php');
?>
<div class="main-category">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br>
                <?php
if (isset($_SESSION['add'])) {
    echo $_SESSION['add'];
    unset ($_SESSION['add']);
}

        ?>
        <br>
        <!-- button in add admin -->
        <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a></button>
        <br></br>
        <table class="tbl">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Feature</th>
                <th>Active</th>
                <th>Actions</th>

            </tr>
            <?php

//query to get all categories from database
            $sql ="SELECT * FROM tbl_category";

            //execute query
            $res =mysqli_query($conn,$sql);

            //count rows
            $count =mysqli_num_rows($res);

            //check whether we have data in database or not
            if (count>0)
             {
                // we have data in database
                //get the data and display
                while ($row=mysqli_fetch_assoc($res)) {
                    $id =$row['image_name'];
                    $image_name=$row['image_name'];
                    $featured=$row['featured'];
                    $active=$row['active'];
                    ?>
                }
            }else{
                //we do not have data in database
                //we will dispaly the message inside table
                ?>


                <tr>
                    <td colspan="6"><div class='error'>No catogery added</div></td>
                </tr>

            }



            ?>
            <tr>
                <td>1</td>
                <td>samir </td>
                <td>r</td>
                <td></td>
                <td></td>
                <td>
                    <a href="#" class="btn-secondary"> update admin </a>
                    <a href="#" class="btn-danger"> delete admin </a>
                </td>
            </tr>
           
        </table>
    </div>

</div>


<?php include('partial/footer.php');
?>