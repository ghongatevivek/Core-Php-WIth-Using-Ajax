<?php 
	$cn = mysqli_connect("localhost","root","","php_practise");

	if(isset($_POST['btn'])){
		if(empty($_POST['cid'])){
			$c_name = $_POST['c_name'];
			$c_mno = $_POST['c_mno'];
			$c_address = $_POST['c_address'];
			$c_city = $_POST['c_city'];
			$c_email = $_POST['c_email'];
			$c_pass = $_POST['c_pass'];

			$course = isset($_POST['c_course'])?implode(",",$_POST['c_course']):"";

			$addData = mysqli_query($cn,"INSERT INTO `tbl_college`(`c_name`,`c_address`,`c_city`,`c_mno`,`c_email`,`c_course`,`c_pass`)VALUES('$c_name','$c_address','$c_city','$c_mno','$c_email','$course','$c_pass')");

			if($addData){
				$ar = array("status"=>200,"message"=>"College Information Is Added...");
			}else{
				$ar = array("status"=>500,"message"=>mysqli_error($cn));
			}
			echo json_encode($ar);
		}else{
			$c_name = $_POST['c_name'];
			$c_mno = $_POST['c_mno'];
			$c_address = $_POST['c_address'];
			$c_city = $_POST['c_city'];
			$c_email = $_POST['c_email'];
			$c_id = $_POST['cid'];

			$course = isset($_POST['c_course'])?implode(",",$_POST['c_course']):"";

			$updateData = mysqli_query($cn,"update tbl_college set c_name='$c_name',c_address='$c_address',c_city='$c_city',c_course='$course',c_mno='$c_mno',c_email='$c_email' where c_id = '$c_id' ");

			if($updateData){
				$ar = array("status"=>200,"message"=>"College Information Is Updated...");
			}else{
				$ar = array("status"=>500,"message"=>mysqli_error($cn));
			}
			echo json_encode($ar);
		}
	}

	if(isset($_GET['getAll'])){
		$row = [];
		$getData = mysqli_query($cn,"select * from tbl_college");
		while($select = mysqli_fetch_assoc($getData)){
			$row[] = $select;
		}

		echo json_encode(array("data"=>$row));
	}

	if(isset($_GET['dlt'])){
		$id = $_GET['dlt'];

		$deleteData = mysqli_query($cn,"delete from tbl_college where c_id = '$id'");

		if($deleteData){
			$ar = array("status"=>200,"message"=>"College Information Is Deleted...");
		}else{
			$ar = array("status"=>500,"message"=>mysqli_error($cn));
		}
		echo json_encode($ar);
	}

	if(isset($_GET['edit'])){
		$id = $_GET['edit'];
		$getSingleData = mysqli_query($cn,"select * from tbl_college where c_id= '$id' ");
		$edit = mysqli_fetch_assoc($getSingleData);
		echo json_encode(array("data"=>$edit));
	}
 ?>