$(document).ready(function(){
	$(".alert-success").hide();
	$("#studFrm").submit(function(e){

		e.preventDefault();
		$.ajax({
			url : "stud_ajax.php",
			type : "post",
			data : $("#studFrm").serialize(),
			success : function(r){
				// console.log(r);
				var data  = $.parseJSON(r);
				if(data.status == 200){
					$(".alert-success").show();
					$("#msg").text(data.message);
					$(".dhide").show();
					$("#stud_modal").modal("hide");
					$(".modal-title").text("Student Register");
					$("#studFrm")[0].reset();
					getAllData();
				}else if(data.status == 500){
					console.error(data.message);
				}
			},
		});
	});

	function getAllData(){

		$.ajax({
			url : "stud_ajax.php?getAll",
			success : function(r){
				// console.log(r);
				var data = $.parseJSON(r);
				var no = 1;
				var tbody = "";
				for(var i = 0 ; i < data.data.length; i++){
					tbody += `
						<tr>
							<td>${no++}</td>
							<td>${data.data[i].s_name}</td>
							<td>${data.data[i].s_lname}</td>
							<td>${data.data[i].s_address}</td>
							<td>${data.data[i].s_gender}</td>
							<td>${data.data[i].s_mno}</td>
							<td>${data.data[i].s_city}</td>
							<td>${data.data[i].s_email}</td>
							<td>${data.data[i].s_hobbies}</td>
							<td>
								<a class="btn btn-success" href="javascript:void(0)" data-stud_id="${data.data[i].s_id}">Edit</a>
								<a class="btn btn-danger" href="javascript:void(0)" data-stud_id="${data.data[i].s_id}">Delete</a>
							</td>
						</tr>
					`;
				}

				$("#tbody").html(tbody);
			},
		});
	}

	getAllData();

	$(document).on("click",".btn-danger",function(){
		var sid = $(this).data("stud_id");
		$.ajax({
			url : "stud_ajax.php?dlt="+sid,
			success : function(r){
				// console.log(r);
				var data = $.parseJSON(r);
				if(data.status == 200){
					$("#msg").text("Data Is Deleted");
					getAllData();
				}else if(data.status == 500){
					console.error(data.message);
				}
			},
		});
	});

	$(document).on("click",".btn-success",function(){
		var sid = $(this).data("stud_id");
		$.ajax({
			url : "stud_ajax.php?edit="+sid,
			success : function(r){
				var data = $.parseJSON(r);
				$("#stud_modal").modal("show");
				$(".dhide").hide();
				$("#snameTxt").val(data.data.s_name);
				$("#slnameTxt").val(data.data.s_lname);
				$("#saddressTxt").val(data.data.s_address);
				$("#semailTxt").val(data.data.s_email);
				$("#smnoTxt").val(data.data.s_mno);
				$("#sid").val(data.data.s_id);
				$("#scityTxt option[value="+ data.data.s_city +"]").attr("selected","selected");
				$(".hobb").each(function(){
					var s_hobb = data.data.s_hobbies.split(",");
					if(s_hobb.indexOf($(this).val()) != -1 ){
						$(this).attr("checked","checked");
					}
				})
			},
		});
	});

	$("#stud_modal").on("hide.bs.modal",function(){
		$("#studFrm")[0].reset();
		$("#scityTxt").removeAttr("selected");
		$(".hobb").each(function(){
			$(this).removeAttr("checked");
		})
	})
})