
<!DOCTYPE html>
<html>
<head>
	<title>Faculty Registration Page</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row  mt-5">
			<div class="col-md-6 col-sm-4">
				<form id="myForm" class="shadow-lg p-5 bg-light" method="post" action="faculty_backend.php">
					<h2 class="text-info text-center">Faculty Registration</h2>
					<div class="form-group">
						<label>Enter Faculty Name</label>
						<input type="text" name="f_name" id="f_name" class="form-control">
						<span class="text-danger"><?php isset($err['f_name'])?  $err['f_name']:""; ?></span>
					</div>

					<div class="form-group">
						<label>Enter Faculty Email</label>
						<input type="text" name="f_email" id="f_email" class="form-control">
					</div>

					<div class="form-group">
						<label>Enter Faculty Password</label>
						<input type="text" name="f_pass" id="f_pass" class="form-control">
					</div>

					<div class="form-group">
						
						<input type="submit" name="btn" id="btn" class="btn btn-block btn-dark">
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<script>
		$(document).ready(function(){
			var form = $("#myForm");

			$("#btn").click(function(){

				$.ajax({
					url : form.attr("action"),
					type : "post",
					data : $("#myForm input").serialize(),

					success:function(data,sataus){
						console.log(data);
					}
				});
			})
		})
	</script>
</body>
</html>