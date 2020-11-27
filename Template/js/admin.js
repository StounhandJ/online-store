url = "admin";

function changeFile(name)
{
	$(`${name} #pictures`)[0].value = "";
	$(`${name} .fileUP .text`)[0].textContent = "выбирите файл";
}

$(document).ready(function() {
	
				//-------Добавить потом отображение что файл добавлен-----//
			$('.fileUP').change(function(){
				$(this)[0].children[0].textContent = "файл выбран";
				console.log($(this)[0].children[0]);
			});

	//----Изменить основную информацию-----//
	
	$('#change_info #socialNetwork').on('change',function(event) {
		if($('#change_info #socialNetwork').val()!=="Выберите из списка"){
			$.get(`/api/info.get`).done(function(json){
				dataSocialNetwork = JSON.parse(json)["data"];
				$('#change_info #NEWsocialNetwork').val(dataSocialNetwork[$('#change_info #socialNetwork').val()]);
				socialNetwork = $('#change_info #socialNetwork').val();
			})
		}
		else
		{
			$('#change_info #NEWsocialNetwork').val("");
			socialNetwork = "";
		}
	});
	
	$('#change_info').submit(function(event) {
		var formData = new FormData();
		$.get(`/api/info.get`).done(function(json){
				dataInfo = JSON.parse(json)["data"];
				telephone = $('#change_info #telephone').val();
				email = $('#change_info #email').val();
				officeHours = $('#change_info #officeHours').val();
				descriptionProduct = $('#change_info #descriptionProduct').val();
				descriptionMaterial = $('#change_info #descriptionMaterial').val();
				descriptionMontage = $('#change_info #descriptionMontage').val();
				descriptionMain = $('#change_info #descriptionMain').val();
				if(socialNetwork!==""){	NEWsocialNetwork=$('#change_info #NEWsocialNetwork').val()};
				if(NEWsocialNetwork!=dataInfo[socialNetwork] && NEWsocialNetwork!=="") formData.append(socialNetwork,NEWsocialNetwork);
				if(telephone!=dataInfo["telephone"] && telephone!=="") formData.append('telephone',telephone);
				if(email!=dataInfo["email"] && email!=="") formData.append("email",email);
				if(officeHours!=dataInfo["officeHours"] && officeHours!=="") formData.append("officeHours",officeHours);
				if(descriptionProduct!=dataInfo["descriptionProduct"] && descriptionProduct!=="") formData.append('descriptionProduct',descriptionProduct);
				if(descriptionMaterial!=dataInfo["descriptionMaterial"] && descriptionMaterial!=="") formData.append('descriptionMaterial',descriptionMaterial);
				if(descriptionMontage!=dataInfo["descriptionMontage"] && descriptionMontage!=="") formData.append('descriptionMontage',descriptionMontage);
				if(descriptionMain!=dataInfo["descriptionMain"] && descriptionMain!=="") formData.append('descriptionMain',descriptionMain);
			    $.ajax({
					type:'POST',
					cache:false,
					processData:false,
					contentType:false,
					data:formData,
					url:`/${url}/info.update`
				});
				alert("Изменено");
			})
		return false;
	});

	
	//-----Добавить товар----//
	
  $('#new_product').submit(function(event) {
  	
	  	category = ( $('#new_product #new_category').val() !== "") ? $('#new_product #new_category').val() : $('#new_product #old_category').val();
	  	name = $('#new_product #name').val();
	  	description	= $('#new_product #description').val();
	  	price =$('#new_product #price').val().replace(" ","");
	  	facade = (!isNaN($('#new_product #facade').val())) ? $('#new_product #facade').val():"";
	  	if(category=="Выберите из списка" || name==="" || description==="" || price==="" || facade==="" || $('#new_product #pictures').prop('files')[0]==undefined) {return false;}
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
			url:`/${url}/product.add`
		});
		alert("Добавленно");
		$('#new_product #new_category').val("");
		$('#new_product #name').val("");
		$('#new_product #description').val("");
	  	$('#new_product #price').val("");
	  	changeFile("#new_product");
	  	$('#new_product #old_category option:selected').prop("selected", false);
		$('#new_product #facade option:selected').prop("selected", false);
	  	return false;
	});

		//----Изменить товар-----//

	$('#change_product #product').on('change',function(event) {
		if(!isNaN($('#change_product #product').val())){
			$.get(`/api/product.info?id=${$('#change_product #product').val()}`).done(function(json){
				data = JSON.parse(json)["data"];
				facade = (data['facade'])?1:0;
				$(`#change_product #category :contains(${data['category']})`).prop("selected", true);
				$(`#change_product #facade option[value="${facade}"]`).prop("selected", true);
				$('#change_product #name').val(data['name']);
				$('#change_product #price').val(data['price']);
				$('#change_product #description').val(data['description']);
				changeFile('#change_product');
			})
		}
		else
		{
			$('#change_product #name').val("");
			$('#change_product #price').val("");
			$('#change_product #description').val("");
			changeFile('#change_product');
			$('#change_product #category option:selected').prop('selected', false);
			$('#change_product #facade option').prop('selected', false);
			data='undefined';
		}
	});
	
	  $('#change_product').submit(function(event) {
	  	if (typeof data !== 'undefined') {
			var formData = new FormData();
			formData.append("id",data["id"]);
			name = $('#change_product #name').val();
			price = $('#change_product #price').val().replace(" ","");
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
			changeFile('#change_product');
		}
	  	return false;
	});
	
				//----Удаоить товар-----//
	$('#delete_product').submit(function(event) {
		if(!isNaN($('#delete_product #product').val())){
			var formData = new FormData();
			product = $('#delete_product #product').val();
			formData.append('id',product);
			$.ajax({
				type:'POST',
				cache:false,
				processData:false,
				contentType:false,
				data:formData,
				url:`/${url}/product.delete`,
				success:function(){
					$(`#delete_product #product option[value='${product}']`).remove();
				}
			});
			alert("Удалено");
		}
		return false;
	});
	
		//-----Добавить материал----//
	
  $('#new_material').submit(function(event) {
	  	name = $('#new_material #name').val();
	  	description	= $('#new_material #description').val();
	  	if(name==="" || description==="" || $('#new_material #pictures').prop('files')[0]==undefined) {return false;}
		var formData = new FormData();
	    formData.append('pictures',$('#new_material #pictures').prop('files')[0]);
	    formData.append('name',name);
	    formData.append('description',description);
		$.ajax({
			type:'POST',
			cache:false,
			processData:false,
			contentType:false,
			data:formData,
			url:`/${url}/material.add`
		});
		alert("Добавленно");
		$('#new_material #name').val("");
		$('#new_material #description').val("");
	  	changeFile('#new_material');
	  	return false;
	});
	
			//----Изменить материал-----//

	$('#change_material #material').on('change',function(event) {
		if(!isNaN($('#change_material #material').val())){
			$.get(`/api/material.info?id=${$('#change_material #material').val()}`).done(function(json){
				dataMaterial = JSON.parse(json)["data"];
				$('#change_material #name').val(dataMaterial['name']);
				$('#change_material #description').val(dataMaterial['description']);
				changeFile('#change_material');
			})
		}
		else
		{
			$('#change_material #name').val("");
			$('#change_material #description').val("");
			changeFile('#change_material');
			dataMaterial='undefined';
		}
	})
	
	  $('#change_material').submit(function(event) {
	  	if (typeof dataMaterial !== 'undefined') {
			var formData = new FormData();
			formData.append("id",dataMaterial["id"]);
			name = $('#change_material #name').val();
			description = $('#change_material #description').val();
			pictures = $('#change_material #pictures').prop('files')[0];
			if(name!=dataMaterial["name"] && name!=="") formData.append('name',name);
			if(description!=dataMaterial["description"] && description!=="") formData.append('description',description);
			if(typeof pictures !== 'undefined') {formData.append('pictures',pictures);formData.append('OLDpictures',dataMaterial['img']);}
			$.ajax({
				type:'POST',
				cache:false,
				processData:false,
				contentType:false,
				data:formData,
				url:`/${url}/material.update`
			});
			changeFile('#change_material');
			alert("Обновленно");
		}
	  	return false;
	});
	
					//----Удаоить материал-----//
	$('#delete_material').submit(function(event) {
		if(!isNaN($('#delete_material #material').val())){
			var formData = new FormData();
			material = $('#delete_material #material').val();
			formData.append('id',material);
			$.ajax({
				type:'POST',
				cache:false,
				processData:false,
				contentType:false,
				data:formData,
				url:`/${url}/material.delete`,
				success:function(){
					$(`#delete_material #material option[value='${material}']`).remove();
				}
			});
			alert("Удалено");
		}
		return false;
	});
})
