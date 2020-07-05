<?php 
	$cn = mysqli_connect("localhost","root");
	
	 mysqli_select_db($cn,'formdb');
	

	if(!$cn) echo "Database Not Connected Yrt";
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Select Data To Database</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row justify-content-center mt-5 ">
			<div class="col-md-8 col-sm-6">
				<form method="post" class="shadow-lg p-3 bg-dark">
					<h3 class="text-center text-warning">Select Data From Database Using Ajax</h3>
					<div class="form-group">
						<label class="text-white ">Username</label>
						<input type="text" name="fname" placeholder="Enter Username" class="form-control">
					</div>

					<div class="form-group">
						<label class="text-white ">Password</label>
						<input type="password" name="pass" placeholder="Enter Password" class="form-control">
					</div>

					<div class="form-group">
						<label class="text-white ">Couses</label>
						<select class="form-control">
							<option value="">Select Course</option>
							
							<?php 
								$q = "select * from tbl_degree";
								$rows = mysqli_query($q);
								while($result = mysqli_fetch_assoc($rows)){ ?>
									<option><?php echo $result['degree_name']; ?></option>
							<?php	}?>
						</select>
					</div>

					<div class="form-group">
						<label class="text-white ">Select Year</label>
						<select class="form-control">
							<option value="">Select Year</option>
						</select>
					</div>
					<div class="form-group">
						<input type="submit" name="" class="btn btn-lg btn-info">
					</div>
				</form>
			</div>

		</div>
	</div>

</body>
</html>