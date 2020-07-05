<!DOCTYPE html>
<html>
<head>
	<title>Ajax Crud OPration</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>

	<div class="container">
		<h1 class="text-center text-uppercase text-info">Ajax Crud Operation</h1>

		<div class="d-flex justify-content-end">
			<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

		</div>

		<h2 class="text-success">All Records</h2>

		<div id="record_content">
			
		</div>

		<!-- Insert Model -->
		<div id="myModal" class="modal fade mt-5" role="dialog">
  			<div class="modal-dialog">

    		<!-- Modal content-->
    			<div class="modal-content">
      				<div class="modal-header">
      					<h4 class="modal-title text-dark">Ajax Crud Operation</h4>
       				 	<button type="button" class="close" data-dismiss="modal">&times;</button>
       				 	
      				</div>
      				
      				<div class="modal-body">
        				<form method="post">
        					<div class="form-group">
        						<label>Username</label>
        						<input type="text" name="u_name" id="u_name" class="form-control">
        					</div>

        					<div class="form-group">
        						<label>City</label>
        						<select class="form-control" name="u_city" id="u_city">
        							<option value="">Select City</option>
        							<option value="Surat">Surat</option>
        							<option value="Vapi">Vapi</option>
        							<option value="Navsari">Navsari</option>
        							<option value="Bardoli">Bardoli</option>
        						</select>
        					</div>

        					<div class="form-group">
        						<label>Email Id</label>
        						<input type="text" name="u_email" id="u_email" class="form-control">
        					</div>

        					<div class="form-group">
        						<label>Password</label>
        						<input type="text" name="u_password" id="u_password" class="form-control">
        					</div>
        				</form>
      				</div>
     				
     				<div class="modal-footer">
       					 <button type="button" class="btn btn-success" data-dismiss="modal" onclick="addRecord()">Save</button>
       					 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      				</div>
    			</div>

  			</div>
		</div>
		<!-- End Insert Model -->

		<!-- Update Model -->
		<div id="update_user" class="modal fade mt-5" role="dialog">
  			<div class="modal-dialog">

    		<!-- Modal content-->
    			<div class="modal-content">
      				<div class="modal-header">
      					<h4 class="modal-title text-dark">Ajax Crud Operation</h4>
       				 	<button type="button" class="close" data-dismiss="modal">&times;</button>
       				 	
      				</div>
      				
      				<div class="modal-body">
        				<form method="post">
        					<div class="form-group">
        						<label>Update Username</label>
        						<input type="text" name="update_name" id="update_name" class="form-control">
        					</div>

        					<div class="form-group">
        						<label>Update City</label>
        						<select class="form-control" name="update_city" id="update_city">
        							<option value="">Select City</option>
        							<option value="Surat">Surat</option>
        							<option value="Vapi">Vapi</option>
        							<option value="Navsari">Navsari</option>
        							<option value="Bardoli">Bardoli</option>
        						</select>
        					</div>

        					<div class="form-group">
        						<label>Update Email Id</label>
        						<input type="text" name="update_email" id="update_email" class="form-control">
        					</div>

        					<div class="form-group">
        						<label>Update Password</label>
        						<input type="text" name="update_password" id="update_password" class="form-control">
        					</div>
        				</form>
      				</div>
     				
     				<div class="modal-footer">
       					 <button type="button" class="btn btn-success" data-dismiss="modal" onclick="editDetails()">Update Details</button>
       					 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
       					 <input type="hidden" name="" id="user_id">
      				</div>
    			</div>

  			</div>
		</div>
		<!-- End Update Model -->
	</div>

	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>


	<script>
		$(document).ready(function(){
			readRecords();
		})

		function readRecords(){
			var allRecords = "allRecords";

			$.ajax({
				url : "backend.php",
				type : "post",
				data:{ allRecords : allRecords },

				success:function(data,status){
					$("#record_content").html(data);
				} 
			})
		}


		function addRecord() {
			var u_name = $("#u_name").val();
			var u_city = $("#u_city").val();
			var u_email = $("#u_email").val();
			var u_password = $("#u_password").val();

			$.ajax({
				url : "backend.php",
				type : "post",
				data : {
					u_name : u_name ,
					u_city : u_city ,
					u_email : u_email ,
					u_password : u_password
				},

				success:function(data,status){
					readRecords();
				}
			})
		}

		function deleteDetails(deleteid){
			var conf = confirm("Are You Sure For Delete This Record");

			if(conf == true){
				$.ajax({
					url : "backend.php",
					type: "post",
					data :{ deleteid : deleteid },

					success:function(data,status){
						readRecords();
					}
				});
			}
		}

		function editDetails(id){

			$("#user_id").val(id);

			$.post("backend.php",{
					id:id
				},

				function(data,status){
					// var user = JSON.parse(data);
					var user =$.parseJSON(data);

					$("#update_name").val(user.u_name);
					$("#update_city").val(user.u_city);
					$("#update_email").val(user.u_email);
					$("#update_password").val(user.u_password);
				}
			);

			$("#update_user").modal("show");
		}

		function updateUerDetails(){
			var uname = $("update_name").val();
			var ucity = $("update_city").val();
			var uemail = $("update_email").val();
			var upassword = $("update_password").val();

			var hidden_id = $("#user_id").val();

			$.post( "backend.php",{
				uname : uname ,
				ucity : ucity ,
				uemail : uemail ,
				upassword : upassword ,
				hidden_id : hidden_id,

			},function(data,status){
				$("#update_user").modal("hide");
				readRecords();
			}

			)
		}
	</script>
</body>
</html>