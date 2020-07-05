$(document).ready(function () {
	$(".alert-info").hide();
	$("#clgFrm").submit(function (e){
		e.preventDefault();
		$.ajax({
			url : "college_ajax.php",
			type : "post",
			data : $("#clgFrm").serialize(),
			success : function(r){
				var data = $.parseJSON(r);
				// console.log(data);
				if(data.status == 200){
					$(".alert-info").show();
					$("#c_msg").text(data.message);
					$("#clgModal").modal("hide");
					$("#clgFrm")[0].reset();
					getAllData();
				}else if(data.status == 500){
					console.error(data.message);
				}
			},

		});
	});

	function getAllData(){
		$.ajax({
			url : "college_ajax.php?getAll",
			success : function(r){
				var data = $.parseJSON(r);
				var no = 1;
				var tbody = "";
				for(var i = 0 ; i < data.data.length ; i++){
					tbody += `
						<tr>
							<td>${no++}</td>
							<td>${data.data[0].c_name}</td>
							<td>${data.data[0].c_address}</td>
							<td>${data.data[0].c_city}</td>
							<td>${data.data[0].c_mno}</td>
							<td>${data.data[0].c_email}</td>
							<td>${data.data[0].c_course}</td>
							<td>
								<a class="btn btn-success" href="javascript:void(0)" data-clg_id="${data.data[0].c_id}">Edit</a>
								<a class="btn btn-danger" href="javascript:void(0)" data-clg_id="${data.data[0].c_id}">Delete</a>
							</td>
						</tr>
					`;
				}
				$("#clg_data").html(tbody);
			},
		});
	}

	getAllData();

	$(document).on("click",".btn-danger",function(){
		var cid = $(this).data("clg_id");
		$.ajax({
			url : "college_ajax.php?dlt="+cid,
			success : function(r){
				var data = $.parseJSON(r);
				if(data.status == 200){
					$(".alert-info").show();
					$("#c_msg").text(data.message);
					getAllData();
				}else{
					console.error(data.message);
				}
			}
		});
	})

	$(document).on("click",".btn-success",function(){
		var cid = $(this).data("clg_id");
		$.ajax({
			url : "college_ajax.php?edit="+cid,
			success : function(r){
				var data = $.parseJSON(r);
				$("#clgModal").modal("show");
				$(".hide").hide();
				$("#cnameTxt").val(data.data.c_name);
				$("#cmnoTxt").val(data.data.c_mno);
				$("#caddressTxt").val(data.data.c_address);
				$("#cemailTxt").val(data.data.c_email);
				$("#cid").val(data.data.c_id);
				$("#ccityTxt option[value=" + data.data.c_city + "]").attr("selected","selected");
				$(".course").each(function(){
					var c = data.data.c_course.split(",");
					if(c.indexOf($(this).val()) != -1){
						$(this).attr("checked","checked");
					}
				})
			},
		})
	})

	$("#clgModal").on("hide.bs.modal",function(){
		$("#clgFrm")[0].reset();
		$("#ccityTxt option").removeAttr("selected");
		$(".course").each(function(){
			$(this).removeAttr("checked");
		})
	})
});