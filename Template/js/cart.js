$(document).ready(function() {
    $(".color").colorpicker();
    $(".color").colorpicker({
		 strings: "Цвета покраски,Популярные цвета,,Назад,Назад,,Pas encore d'historique."
	});
	$(".color").colorpicker({
	})
	
	$('[calss="facade"]').change(function(event) {
		var formData = new FormData();
		formData.append('productID',$(this)[0][1].value);
		formData.append('facade',1);
		formData.append('color',$(this)[0][0].value);
		$.ajax({
				type:'POST',
				cache:false,
				processData:false,
				contentType:false,
				data:formData,
				url:`/api/productAddcolor`
		});
		return false;
	});
	
	$('[calss="corpus"]').change(function(event) {
		var formData = new FormData();
		formData.append('productID',$(this)[0][1].value);
		formData.append('facade',0);
		formData.append('color',$(this)[0][0].value);
		$.ajax({
				type:'POST',
				cache:false,
				processData:false,
				contentType:false,
				data:formData,
				url:`/api/productAddcolor`,
				success: function(data){ 
				    console.log(data);
				  }
		});
		return false;
	});
	
	$('[class="cart_quantity_delete"]').click(function(event) {
		var formData = new FormData();
		id = $(this)[0].id;
		formData.append('productID',id);
		$.ajax({
				type:'POST',
				cache:false,
				processData:false,
				contentType:false,
				data:formData,
				url:`/api/productDel`,
				success: function(data){
				    console.log($(`tr[id='${id}']`).remove());
				  }
		});
		return false;
	});
});