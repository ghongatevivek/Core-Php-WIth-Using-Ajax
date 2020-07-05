<?php 

$cn = mysqli_connect("localhost","root","","php_practise");

if(!$cn) echo "Database Not Connect Yet....";

extract($_POST);

	if(isset($_POST['allRecords'])){

		$data = '<table class="table table-bordered table-striped">
					<tr>
						<th>No</th>
						<th>Username</th>
						<th>City</th>
						<th>Email Id</th>
						<th>Password</th>
						<th>Action</th>
					</tr>';

		$getAllData = mysqli_query($cn,"SELECT * FROM `tbl_crud`");

			if(mysqli_num_rows($getAllData)>0){
				$i=1;
				while($row = mysqli_fetch_assoc($getAllData)){
					$data .= '<tr>
								<td>'.$i++.'</td>
								<td>'.$row['u_name'].'</td>
								<td>'.$row['u_city'].'</td>
								<td>'.$row['u_email'].'</td>
								<td>'.$row['u_password'].'</td>
								<td>
									<button class="btn btn-success" onclick="editDetails('.$row['u_id'].')">Edit</button>
									<button class="btn btn-danger" onclick="deleteDetails('.$row['u_id'].')">Delete</button>
									
								</td>
							</tr>';
				}
			}

			$data .= '</table>';
			echo $data;
	}

	if(isset($_POST['u_name']) && isset($_POST['u_city']) && isset($_POST['u_email']) && isset($_POST['u_password'])){

		$addData = mysqli_query($cn,"INSERT INTO `tbl_crud`(`u_name`,`u_city`,`u_email`,`u_password`) VALUES('$u_name','$u_city','$u_email','$u_password')");
	}


	if(isset($_POST['deleteid'])){

		$u_id = $_POST['deleteid'];

		$deleteData = mysqli_query($cn,"delete from tbl_crud where u_id = '$u_id'");

	}

	if(isset($_POST['hidden_id'])){

		$hidden_id = $_POST['hidden_id'];
		$uname = $_POST['uname'];
		$ucity = $_POST['ucity'];
		$uemail = $_POST['uemail'];
		$upassword = $_POST['upassword'];

		$updateDetails = mysqli_query($cn,"UPDATE `tbl_crud` SET `u_name`='$uname' `u_city`='$ucity',`u_email`='$uemail',`u_password`='$upassword' WHERE u_id='$hidden_id' ");
	}
 ?>