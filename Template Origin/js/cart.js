function number_format(number, decimals, dec_point, separator ) {
  number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof separator === 'undefined') ? ',' : separator ,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + (Math.round(n * k) / k)
        .toFixed(prec);
    };
  // Фиксим баг в IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
    .split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '')
    .length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1)
      .join('0');
  }
  return s.join(dec);
}

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
		$.get(`/api/product.info?id=${id}`).done(function(json){
				try{
				price = Number(json["data"]["price"].replace(' ','').replace(' ','').replace('р.',''));
				totalPrice = Number($('#totalPrice')[0].innerText.replace(' ','').replace(' р.',''));
				itogPrice = number_format(totalPrice-price, 0, ',', ' ') + " р.";
				$('#totalPrice')[0].innerText = itogPrice;
				}
				catch{}
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
		});
		return false;
	});
	$('#cart-form').click(function(event) {
		var formData = new FormData();
		name = $("#name").val();
		phone = $("#phone").val();
		email = $("#email").val();
		adress = $("#address").val();
		comment = $("#comment").val();
		if(name==="" || phone==="" || email==="" || adress==="") return false;
		formData.append('name',name);
		formData.append('phone',phone);
		formData.append('email',email);
		formData.append('address',adress);
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
