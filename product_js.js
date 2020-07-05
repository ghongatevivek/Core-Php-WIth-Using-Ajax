$(document).ready(function(){
	$(".alert-success").hide();

	$("#prdForm").submit(function(e){
		e.preventDefault();
		
		$.ajax({
			url : "product_ajax.php",
			type : "post",
			data : $("#prdForm").serialize(),
			success : function(r){
				// console.log(r);
				var data = $.parseJSON(r);
				if(data.status == 200){
					$("#prdForm")[0].reset();
					$("#msg").text(data.message);
					$(".modal-title").text("Add Product");
					$("#myModal").modal("hide");
					$(".alert-success").show();
					getAllData();
				}else if(data.status == 500){
					console.error(data.message);
				}
			},
		});
	});

	function getAllData(){

		$.ajax({
			url : "product_ajax.php?getAll",
			success : function(r){
				// console.log(r);
				var data = $.parseJSON(r);
				var no = 1;
				var tbody = "";
				for(var i = 0 ; i < data.data.length; i++){
					tbody += `
						<tr>
							<td>${no++}</td>
							<td>${data.data[i].p_name}</td>
							<td>${data.data[i].p_price}</td>
							<td>${data.data[i].p_cate}</td>
							<td>${data.data[i].p_qty}</td>
							<td>${data.data[i].p_desc}</td>
							<td><a class="btn btn-success" href="javascript:void(0)" data-prd_id="${data.data[i].p_id}">Edit</a>
							<a class="btn btn-danger" href="javascript:void(0)" data-prd_id="${data.data[i].p_id}">Delete</a></td>
						</tr>
					`;
				}
				$("#tbody").html(tbody);
			},

		});
		
	}
	getAllData();

	$(document).on("click",".btn-danger",function(){
		var pid = $(this).data("prd_id");
		$.ajax({
			url : "product_ajax.php?del="+pid,
			success : function(r){
				var data = $.parseJSON(r);
				if(data.status == 200){
					$("#msg").text("Record Has Been Deleted..");
					getAllData();
				}else if(data.status == 500){
					console.error(data.message);
				}
			},
		});
	});

	$(document).on("click",".btn-success",function(){
		var pid = $(this).data("prd_id");
		$.ajax({
			url : "product_ajax.php?edit="+pid,
			success :function(r){
				var data = $.parseJSON(r);
				console.log(data);
				$(".modal-title").text("Update Product");
				$("#myModal").modal("show");
				$("#pnameTxt").val(data.data.p_name);
				$("#priceTxt").val(data.data.p_price);
				$("#pqtyTxt").val(data.data.p_qty);
				$("#pdescTxt").val(data.data.p_desc);
				$("#pid").val(data.data.p_id);
				
				$(".cat").each( function() {
					var cate=data.data.p_cate.split(",");
					alert(cate);
					if(cate.indexOf($(this).val()) != -1) {
						$(this).attr("checked","checked");
					}
				});
			},
		});
	});

	$("#myModal").on("hide.bs.modal",function(){
		$("#prdForm")[0].reset();
		$(".cat").each(function(){
			$(this).removeAttr("checked");
		})
	});

	
});