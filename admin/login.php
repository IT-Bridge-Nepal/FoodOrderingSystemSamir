 <?php include('../config/constants.php') ; 
?> 

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - Food Order System</title>
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
	 <div class="login">
        <h1 class="text-center">Login</h1>
        <br />
       <?php 
if (isset($_SESSION['login'])) {
	echo $_SESSION['login'];
	unset($_SESSION['login']);
	
}

 if (isset($_SESSION['no-login-message'])) {
 	echo $_SESSION['no-login-message'];
 	unset($_SESSION['no-login-message']);
 }
        ?>

        <br />
        <br />
        <!-- login form starts -->
        <form action="" method="POST" class="text-center">
            Username:
            <input type="text" name="username" placeholder="Enter Username"><br><br>

            Password:
            <input type="password" name="password" placeholder="Enter password"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">

        </form>
        <!-- login form ends -->
        <br />
        <br />
  
	<p class="text-center">Created by - <a href="www.samirkarkey5@gmail.com">Samir karki</a></p>

</div>
</body>
</html>
<?php
//check whether the submit button is clicked or not

if (isset($_POST['submit'])) {
	//process for login
	// get the data from login form
	$username =$_POST['username'];
	$password=md5($_POST['password']);
	 // sql to check whether the username and password exist or not
	$sql ="SELECT * from tbl_admin WHERE user_name='$username' AND password='$password'";

 //execute the query
	$res=mysqli_query($conn, $sql);

	//count rows to check whether the user exist or not
$count =mysqli_num_rows($res);

	if ($count==1) 
	{
	 	//user available and login success
	 		$_SESSION['login']="<div class='success'>login successfull</div>";
	 		 $_SESSION['user']= $username; //to check the user logged in or not and logout will unset it
		//redirect to home page/dashboard
		header('location:'.SITEURL.'admin/');
}
else{
	//user not available and login fail
		$_SESSION['login']="<div class='error text-center'>Username or Password didnot matched</div>"; 


//redirect to login.php
			header('location:'.SITEURL.'admin/login.php');

}

}


?>
