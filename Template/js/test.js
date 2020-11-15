$(document).ready(function() {
	
				//-------Добавить потом отображение что файл добавлен-----//
		// 	$('#pictures').change(function(){
		// 		$('label.text').text($('label.text').val()+" (Выбран)");
		// 	});

	//----Изменить основную информацию-----//
	$('#test').submit(function(event) {
		console.log($('#test #mycolor').val());
		return false;
	})
	
})