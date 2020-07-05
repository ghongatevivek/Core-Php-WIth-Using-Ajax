<?php 
	$cn = mysqli_connect("localhost","root","","php_practise");

	if(isset($_POST['btn'])){
		if(empty($_POST['sid'])){

			$s_name = $_POST['s_name'];
			$s_lname = $_POST['s_lname'];
			$s_address = $_POST['s_address'];
			$s_gender = $_POST['s_gender'];
			$s_mno = $_POST['s_mno'];
			$s_email = $_POST['s_email'];
			$s_city = $_POST['s_city'];
			$s_pass = $_POST['s_pass'];

			$hobbies = isset($_POST['s_hobbies'])?implode(",",$_POST['s_hobbies']):"";

			$addData = mysqli_query($cn,"INSERT INTO `tbl_stud_ajax` (`s_name`,`s_lname`,`s_address`,`s_gender`,`s_mno`,`s_email`,`s_city`,`s_hobbies`,`s_pass`) VALUES('$s_name','$s_lname','$s_address','$s_gender','$s_mno','$s_email','$s_city','$hobbies','$s_pass');");

			if($addData){
				$ar = array("status"=>200,"message"=>"Data Is Added");
			}else{
				$ar = array("status"=>500,"message"=>mysqli_error($cn));
			}

			echo json_encode($ar);
		}else{

			$s_name = $_POST['s_name'];
			$s_lname = $_POST['s_lname'];
			$s_address = $_POST['s_address'];
			$s_gender = $_POST['s_gender'];
			$s_mno = $_POST['s_mno'];
			$s_email = $_POST['s_email'];
			$s_city = $_POST['s_city'];
			$stud_id = $_POST['sid'];

			$hobbies = isset($_POST['s_hobbies'])?implode(",",$_POST['s_hobbies']):"";

			$updateData = mysqli_query($cn,"update tbl_stud_ajax set s_name='$s_name',s_lname='$s_lname',s_address='$s_address',s_mno='$s_mno',s_hobbies='$hobbies',s_email='$s_email',s_city='$s_city' where s_id='$stud_id' ");

			if($updateData){
				$ar = array("status"=>200,"message"=>"Data Is Updated");
			}else{
				$ar = array("status"=>500,"message"=>mysqli_error($cn));
			}

			echo json_encode($ar);
		}
	}

	if(isset($_GET['getAll'])){
		$row = [];
		$getData = mysqli_query($cn,"select * from tbl_stud_ajax");
		while($data = mysqli_fetch_assoc($getData)){
			$row [] = $data ; 
		}

		echo json_encode(array("data"=>$row));
	}

	if(isset($_GET['dlt'])){
		$id = $_GET['dlt'];
		$deleteData = mysqli_query($cn,"delete from tbl_stud_ajax where s_id='$id'");
		if($deleteData){
			$ar = array("status"=>200,"message"=>"Data Is Deleted");
		}else{
			$ar = array("status"=>500,"message"=>mysqli_error($cn));
		}
		echo json_encode($ar);
	}

	if(isset($_GET['edit'])){
		$id = $_GET['edit'];
		$getSingleData = mysqli_query($cn,"select * from tbl_stud_ajax where s_id='$id'");
		$edit = mysqli_fetch_assoc($getSingleData);
		echo json_encode(array("data"=>$edit));
	}
 ?>