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
            <h1>5</h1>
            <br>
            Category
        </div>

        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Category
        </div>

        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Category
        </div>

        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Category
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<di <div class="clearfix">
    </div>
    </div>


    <?php include('partial/footer.php')    ?>