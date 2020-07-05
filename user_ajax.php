<?php 
	$cn = mysqli_connect("localhost","root","","php_practise");

	if(!$cn) echo "Database not connected Yet....";

	if(isset($_POST['btn'])){
		if(empty($_POST['uid'])){
			// print_r($_POST);

			$u_name = $_POST['u_name'];
			$u_city = $_POST['u_city'];
			$u_email = $_POST['u_email'];
			$u_password= $_POST['u_password'];

			$addData = mysqli_query($cn,"INSERT INTO `tbl_user_regi`(`u_name`,`u_city`,`u_email`,`u_password`) VALUES('$u_name','$u_city','$u_email','$u_password')");

			if($addData){
				$ar = array("status"=>200,"message"=>"Record Has Been Inserted Successfully...");
			}else{
				$ar = array("status"=>500,"message"=>mysqli_error($cn));
			}

			echo json_encode($ar);
		}else{
			// print_r($_POST);

			$u_name = $_POST['u_name'];
			$u_city = $_POST['u_city'];
			$u_email = $_POST['u_email'];
			$u_id = $_POST['uid'];

			$updateData = mysqli_query($cn,"update tbl_user_regi set u_name='$u_name',u_city='$u_city',u_email='$u_email' where u_id='$u_id' ");

			if($updateData){
				$ar = array("status"=>200,"message"=>"Record Has Been Updated Successfully...");
			}else{
				$ar = array("status"=>500,"message"=>mysqli_error($cn));
			}

			echo json_encode($ar);
		}
	}

	if(isset($_GET['getAll'])){
		$row = [];
		$select = mysqli_query($cn,"select * from tbl_user_regi");
		while ($data = mysqli_fetch_assoc($select)) {
			$row[] = $data;
		}

		echo json_encode(array("data"=>$row));
	}

	if(isset($_GET['del'])){
		$id = $_GET['del'];

		$deleteData = mysqli_query($cn,"delete from tbl_user_regi where u_id='$id' ");
		if($deleteData){
			$ar = array("status"=>200,"message"=>"Record Has Been Deleted");
		}else{
			$ar = array("status"=>500,"message"=>mysqli_error($cn));
		}
		echo json_encode($ar);
	}

	if(isset($_GET['edit'])){

		$id = $_GET['edit'];

		$getSingleRecord = mysqli_query($cn,"select * from tbl_user_regi where u_id='$id'");
		$edit = mysqli_fetch_assoc($getSingleRecord);
		echo json_encode(array("data"=>$edit));
	}


 ?>