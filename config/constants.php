<?php
//start  session
session_start();


//create constant to non repeating value
define('SITEURL', 'http://localhost/foodorder/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME','food-order');


//execute query and save data in database
	$conn = mysqli_connect('LOCALHOST','root','')or die(mysqli_error());
	$db_select = mysqli_select_db($conn,'food-order')or die(mysqli_error());
	


?>