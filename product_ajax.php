<?php 
	$cn = mysqli_connect("localhost","root","","php_practise");

	if(!$cn) echo "Database Not Connected Yet";

	if(isset($_POST['btn'])){	
		if(empty($_POST['pid'])){
			$p_name = $_POST['p_name'];
			$p_price = $_POST['p_price'];
			$p_cate = $_POST['p_cate'];
			$p_qty = $_POST['p_qty'];
			$p_desc = $_POST['p_desc'];

			$cate = isset($_POST['p_cate'])?implode(",",$_POST['p_cate']):"";

			$addData = mysqli_query($cn,"INSERT INTO `tbl_prd_ajax`(`p_name`,`p_price`,`p_cate`,`p_qty`,`p_desc`) VALUES('$p_name','$p_price','$cate','$p_qty','$p_desc')");

			if($addData){
				$arr = array("status"=>200,"message"=>"Data Is Added");
			}else{
				$arr = array("status"=>500,"message"=>mysqli_error($cn));
			}
			echo json_encode($arr);
		}else{

			$p_name = $_POST['p_name'];
			$p_price = $_POST['p_price'];
			$p_cate = $_POST['p_cate'];
			$p_qty = $_POST['p_qty'];
			$p_desc = $_POST['p_desc'];
			$p_id = $_POST['pid'];

			$cate = isset($_POST['p_cate'])?implode(",",$_POST['p_cate']):"";

			$updateData = mysqli_query($cn,"update tbl_prd_ajax set p_name='$p_name',p_price='$p_price',p_cate='$cate',p_qty='$p_qty',p_desc='$p_desc' where p_id='$p_id'");

			if($updateData){
				$arr = array("status"=>200,"message"=>"Data Is Updated Successfully..");
			}else{
				$arr = array("status"=>500,"message"=>mysqli_error($cn));
			}
			echo json_encode($arr);
		}
	}

	if(isset($_GET['getAll'])){
		$row = [];
		$getAllData = mysqli_query($cn,"select * from tbl_prd_ajax");
		while($p_data = mysqli_fetch_assoc($getAllData) ){
			$row[] = $p_data;
		}
		
		echo json_encode(array("data"=>$row));
	}

	if(isset($_GET['del'])){
		$id = $_GET['del'];
		$deleteData = mysqli_query($cn,"delete from tbl_prd_ajax where p_id='$id'");
		
		if($deleteData){
			$ar = array("status"=>200);
		}else{
			$ar = array("status"=>500,"message"=>mysql_error($cn));
		}

		echo json_encode($ar);
	}

	if(isset($_GET['edit'])){
		$id = $_GET['edit'];
		$getSingleData = mysqli_query($cn,"select * from tbl_prd_ajax where p_id='$id' ");
		$edit = mysqli_fetch_assoc($getSingleData);
		echo json_encode(array("data"=>$edit));
	}

	
 ?>