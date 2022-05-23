<?php include('partial/menu.php')
?>

<div class="maincontent">
    <div class="wrapper">
        <h1><strong>DASHBOARD</strong></h1>
        <br>
          <?php 
if (isset($_SESSION['login'])) {
    echo $_SESSION['login'];
    unset($_SESSION['login']);
    
}
      ?>
      <br><br>
        <div class="col-4 text-center">
            <?php
            //sql query
$sql ="SELECT * FROM tbl_category";

//execute query
$res = mysqli_query($conn,$sql);
//Count rows
$count =mysqli_num_rows($res);
            ?>

            <h1><?php echo $count;?></h1>
            <br>
            Categories
        </div>

        <div class="col-4 text-center">
            <?php
            //sql query
            $sql2 ="SELECT * FROM tbl_food";

//execute query
$res2 = mysqli_query($conn,$sql2);
//Count rows
$count2 =mysqli_num_rows($res2);
            ?>
            <h1><?php echo $count2; ?></h1>
            <br>
            Foods
        </div>

        <div class="col-4 text-center">
             <?php
            //sql query
$sql3 ="SELECT * FROM tbl_order";

//execute query
$res3 = mysqli_query($conn,$sql3);
//Count rows
$count3 =mysqli_num_rows($res3);
            ?>
            <h1><?php echo $count3   ?></h1>
            <br>
            Total orders
        </div>

        <div class="col-4 text-center">
            <?php
//create sql query to get total revenue generated
            //aggregate function in sql
            $sql4 ="SELECT SUM(total)AS total FROM tbl_order WHERE status ='Delivered' ";

            //execute query
            $res4=mysqli_query($conn,$sql4);

            //get the value
            $row4=mysqli_fetch_assoc($res4);

            //get the total revenue
            $total_revenue =$row4['total'];
            ?> 
            
            <h1>RS:<?php echo $total_revenue;?></h1>
            <br>
            Revenue Generated
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<di <div class="clearfix">
    </div>
    </div>


    <?php include('partial/footer.php')    ?>