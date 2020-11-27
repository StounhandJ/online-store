$(document).ready(function() {
    $(".color").colorpicker();
    $(".color").colorpicker({
		 strings: "Цвета покраски,Популярные цвета,,Назад,Назад,,Pas encore d'historique."
	});
	$(".color").colorpicker({
	});
	
	$('[class="color-button-facade"]').change(function(event) {
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
	
	$('[class="color-button-corpus"]').change(function(event) {
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
				url:`/api/productAddcolor`
		});
		return false;
	});
	
	$('[class="btn btn-default add-material"]').click(function(event) {
		data = $(this)[0].id.split("|");
		url = `/materials?productID=${data[0]}&facade=${data[1]}`;
		$(location).attr('href',url);
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
				    $(`tr[id='${id}']`).remove();	
				  }
		});
		return false;
	});
	$('#cart-form').click(function(event) {
		var formData = new FormData();
		name = $("#name").val();
		phone = $("#phone").val();
		email = $("#email").val();
		adress = $("#adress").val();
		comment = $("#comment").val();
		if(name==="" || phone==="" || email==="" || adress==="" || adress==="comment") return false;
		formData.append('name',name);
		formData.append('phone',phone);
		formData.append('email',email);
		formData.append('adress',adress);
		formData.append('comment',comment);
		$.ajax({
			type:'POST',
			cache:false,
			processData:false,
			contentType:false,
			data:formData,
			url:`/api/cartPush`,
			success: function(){
				    $(location).attr('href',"/cart");
				  }
		});
	});
	
});