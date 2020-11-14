url = "admin";

$(document).ready(function() {
	
				//-------Добавить потом отображение что файл добавлен-----//
		// 	$('#pictures').change(function(){
		// 		$('label.text').text($('label.text').val()+" (Выбран)");
		// 	});

	//----Изменить основную информацию-----//
	$('#change_info').submit(function(event) {
		var formData = new FormData();
		formData.append('telephone',$('#change_info #telephone').val());
	    formData.append('email',$('#change_info #email').val());
	    $.ajax({
			type:'POST',
			cache:false,
			processData:false,
			contentType:false,
			data:formData,
			url:`/${url}/info.update`,
			success:function(data){
				console.log(data);
			}
		});
		alert("Изменено");
		return false;
	})
	
	
	//-----Добавить товар----//
	
  $('#new_product').submit(function(event) {
  	
	  	category = ( $('#new_product #new_category').val() !== "") ? $('#new_product #new_category').val() : $('#new_product #old_category').val();
	  	name = $('#new_product #name').val();
	  	description	= $('#new_product #description').val();
	  	price =$('#new_product #price').val();
	  	facade = (!isNaN($('#new_product #facade').val())) ? $('#new_product #facade').val():"";
	  	if(category=="Выберите из списка" || name==="" || description==="" || price==="" || facade==="") return false;
		var formData = new FormData();
	    formData.append('pictures',$('#new_product #pictures').prop('files')[0]);
	    formData.append('category',category);
	    formData.append('name',name);
	    formData.append('description',description);
	    formData.append('price',price);
	    formData.append('facade',facade);
		$.ajax({
			type:'POST',
			cache:false,
			processData:false,
			contentType:false,
			data:formData,
			url:`/${url}/product.add`,
			success:function(data){
				console.log(data);
			}
		});
		alert("Добавленно");
		$('#new_product #new_category').val("");
		$('#new_product #name').val("");
		$('#new_product #description').val("");
	  	$('#new_product #price').val("");
	  	$('#new_product #pictures')[0].value = "";
	  	$('#new_product #old_category option:selected').prop("selected", false);
		$('#new_product #facade option:selected').prop("selected", false);
	  	return false;
	})

		//----Изменить товар-----//

	$('#change_product #product').on('change',function(event) {
		if(!isNaN($('#change_product #product').val())){
			$.get(`/api/product.info?id=${$('#change_product #product').val()}`).done(function(json){
				data = JSON.parse(json)["data"];
				console.log(data['facade']);
				$(`#change_product #category :contains(${data['category']})`).prop("selected", true);
				$(`#change_product #facade option[value="${data['facade']}"]`).prop("selected", true);
				$('#change_product #name').val(data['name']);
				$('#change_product #price').val(data['price']);
				$('#change_product #description').val(data['description']);
				
			})
		}
		else
		{
			$('#change_product #name').val("");
			$('#change_product #price').val("");
			$('#change_product #description').val("");
			$('#change_product #pictures')[0].value = "";
			$('#change_product #category option:selected').prop('selected', false);
			$('#change_product #facade option').prop('selected', false);
			data='undefined';
		}
	})
	
	  $('#change_product').submit(function(event) {
	  	if (typeof data !== 'undefined') {
	  		console.log($('#change_product #facade').val());
			var formData = new FormData();
			formData.append("id",data["id"]);
			name = $('#change_product #name').val();
			price = $('#change_product #price').val();
			description = $('#change_product #description').val();
			category = $('#change_product #category').val();
			pictures = $('#change_product #pictures').prop('files')[0];
			facade =  $('#change_product #facade').val();
			if(name!=data["name"] && name!=="") formData.append('name',name);
			if(price!=data["price"] && price!=="") formData.append('price',price);
			if(description!=data["description"] && description!=="") formData.append('description',description);
			if(category!=data["category"] && category!=="") formData.append('category',category);
			if(facade!=data["facade"] && facade!=="") formData.append('facade',facade);
			if(typeof pictures !== 'undefined') {formData.append('pictures',pictures);formData.append('OLDpictures',data['img']);}
			$.ajax({
				type:'POST',
				cache:false,
				processData:false,
				contentType:false,
				data:formData,
				url:`/${url}/product.update`
			});
			alert("Обновленно");
		}
	  	return false;
	})
	
				//----Удаоить товар-----//
	$('#delete_product').submit(function(event) {
		if(!isNaN($('#delete_product #product').val())){
			var formData = new FormData();
			formData.append('id',$('#delete_product #product').val());
			$.ajax({
				type:'POST',
				cache:false,
				processData:false,
				contentType:false,
				data:formData,
				url:`/${url}/product.delete`
			});
			alert("Удалено");
		}
		return false;
	})
})
