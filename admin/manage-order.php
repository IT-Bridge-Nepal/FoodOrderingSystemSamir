<?php include('partial/menu.php');
?>
<div class="main-category">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br><br><br>
         <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add']; //Display session
            unset($_SESSION['add']); //Remove session
        }
        if(isset($_SESSION['update'])){
            echo $_SESSION['update']; //Display session
            unset($_SESSION['update']); //Remove session
        }
        if(isset($_SESSION['no-category-found'])){
            echo $_SESSION['no-category-found']; //Display session
            unset($_SESSION['no-category-found']); //Remove session
        }
    ?>

        <table class="tbl">
            <tr>
                 <th>S.N</th>
               <th>Food</th>
               <th>Price</th>
               <th>Quantity</th>
               <th>Total</th>
               <th>OrderDate</th>
               <th>Status</th>
               <th>Customer Name</th>
               <th>Contact</th>
               <th>Email</th>
               <th>Address</th>
               <th>Actions</th>

            </tr>
             <?php
            // get all data from database
            $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
            // execute query
            $res = mysqli_query($conn,$sql);
            // count the rows
            $count = mysqli_num_rows($res);

            $sn =1 ; //serial

            if($count>0)
            {
                // order available
                while($row=mysqli_fetch_assoc($res))
                {
                    // get all data
                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];

                    ?>
                    <tr>
                        <td><?php echo $sn++ ;?></td>
                        <td><?php echo $food ;?></td>
                        <td><?php echo $price ;?></td>
                        <td><?php echo $qty ;?></td>
                        <td><?php echo $total ;?></td>
                        <td><?php echo $order_date ;?></td>
                        <td>
                            <?php
                            // ordered delivered on delivery cancelled
                            if($status=="Ordered")
                            {
                                echo "<label>$status</label>";
                            }
                            elseif($status=="On Delivery")
                            {
                                echo "<label style='color:orange;'>$status</label>";
                            }
                            elseif($status=="Delivered")
                            {
                                echo "<label style='color:green;'>$status</label>";
                            }
                            elseif($status=="Cancelled")
                            {
                                echo "<label style='color:red;'>$status</label>";
                            }
                            ?>
                        </td>
                        <td><?php echo $customer_name ;?>r</td>
                        <td><?php echo $customer_contact ;?></td>
                        <td><?php echo $customer_email ;?>r</td>
                        <td><?php echo $customer_address ;?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary"> Update</a>
                            
                        </td>

                    </tr>


                    <?php
                }
            }
            else
            {
                // not available
               echo "<tr><td colspan='12' class='error'>Order not Available</td></tr>";
            }
           ?>
           

           
                   
                  </table>
                   <div class="clearfix"></div> 
    </div>

</div>


<?php include('partial/footer.php');
?>