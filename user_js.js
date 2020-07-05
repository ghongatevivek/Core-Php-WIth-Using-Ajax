$(document).ready(function(){
	$(".alert-success").hide();
	$("#addForm").submit(function(e){
		// console.log(e);   e define Event
		e.preventDefault();
		$.ajax({
			url : "user_ajax.php",
			type : "post",
			data : $("#addForm").serialize(),
			success:function(r){
				// console.log(r);   r define Response For Display status and Msg
				var data = $.parseJSON(r);
				if(data.status == 200){
					$("#addForm")[0].reset();
					$("#myModal").modal("hide");
					$(".alert-success").show();
					$("#msg").text(data.message);
					$(".modal-title").text("User Registration");
					getAllData();
				}else if(data.status == 500){
					console.error(data.message);   //Error Msg In Console In Red Color O
				}	
			}
		});
	});

	function getAllData(){	
		$.ajax({
			url : "user_ajax.php?getAll",
			success : function(r){
				var data = $.parseJSON(r);
				var no = 1 ;
				var tbody = "";
				for(var i = 0 ; i < data.data.length ; i++){
					tbody += `
						<tr>
							<td>${no++}</td>
							<td>${data.data[i].u_name}</td>
							<td>${data.data[i].u_city}</td>
							<td>${data.data[i].u_email}</td>
							<td>
								<a class="btn btn-success" href="javascript:void(0)" data-userid="${data.data[i].u_id}">Edit</a>
								<a class="btn btn-danger" href="javascript:void(0)" data-userid="${data.data[i].u_id}">Delete</a>				
							</td>
						</tr>
					`;
				}
				$("#userData").html(tbody);
			},
		});
	}
	getAllData();

	$(document).on("click",".btn-danger",function(){
		// alert("fill");
		var id = $(this).data("userid");
		$.ajax({
			url : "user_ajax.php?del="+id,
			success : function(r) {
				var data = $.parseJSON(r)
				if(data.status == 200){
					$("#msg").text("Record Has Been deleted...");
					getAllData();
				}else if(data.status == 500){
					console.log(data.message);
				}
			},
		});
	});

	$(document).on("click",".btn-success",function(){

		var id = $(this).data("userid");
			$.ajax({
				url : "user_ajax.php?edit="+id,
				success : function(r){
					
					var data = $.parseJSON(r);
					
					$(".modal-title").text("Edit User Information");
					$("#myModal").modal("show");
					$("#unameTxt").val(data.data.u_name);
					$("#uemailTxt").val(data.data.u_email);
					$("#uid").val(data.data.u_id);
					$("#ucityTxt option[value="+ data.data.u_city+ "]").attr("selected","selected");
					$(".dhide").hide();
				},
			});
	});

	$(document).on(".hide.bs.modal",function(){
		$("#addForm")[0].reset();
		$("#ucityTxt").removAttr("selected");
	});
});

