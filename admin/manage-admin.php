<?php include('partial/menu.php')  ?>

<div class="maincontent">
    <div class="wrapper">
        <h1><strong>Manage Admin</strong></h1>
        <br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];//display the session message
            unset($_SESSION['add']);//removing the Session message
        }
   
  
        ?>
        <br><br><br>
        <!-- button in add admin -->
        <a href="add-admin.php" class="btn-primary">Add admin </a></button>
        <br></br>
        <table class="tbl">
            <tr>
                <th>S.N.</th>
                <th>full name</th>
                <th>User Name</th>
                <th>Action</th>

            </tr>
            <?php 
            //query to get all admin
$sql = "SELECT * FROM tbl_admin";
//execute the query
$res = mysqli_query($conn, $sql);
//check whether the query is executed or not
if ($res==TRUE) {
    //count rows to check whether we have data in database or not
    $count = mysqli_num_rows($res); //function to get all the rows

    //check the num of rows
    if($count>0);
    {
        //we have data in database
        while ($rows=mysqli_fetch_assoc($res))
        {
            //using while loop to get all the data from database
            //and while loop will run as long as we have data in database
            //get individual data
            $id=$rows['id'];
            $full_name=$rows['full_name']; 
            $user_name=$rows['user_name'];

            //display the values in table
?>
                    <tr>
                     <td>1.</td>
                     <td><?php echo $full_name;?></td>
                    <td><?php echo $user_name;?></td>
                   <td>
                      <a href="#" class="btn-secondary"> update admin </a>
                    <a href="#" class="btn-danger"> delete admin </a>
                </td>
            </tr>
<?php

        }
    }
    // else
    // {
    //     // we do not have data in database
    // }
}
      ?>

          
        </table>
    </div>
</div>
<?php include('partial/footer.php')  ?>