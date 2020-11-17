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
			console.log($(this));
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
    });