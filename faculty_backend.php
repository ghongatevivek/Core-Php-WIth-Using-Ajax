<?php 
	$cn = mysqli_connect("localhost","root","","php_practise");
	if(!$cn) echo "Database Not Connected Yet..";

	extract($_POST);

	if(isset($_POST['btn'])){

		

		$insert = mysqli_query($cn,"INSERT INTO `tbl_faculty`(`f_name`,`f_email`,`f_pass`)VALUES('$f_name','$f_email','$f_pass')");

		header("Location:faculty.php");

	}
 ?>