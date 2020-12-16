$(document).ready(function() {
	$('#push').click(function(event) {
		var formData = new FormData();
		formData.append('login',$("#login").val());
		formData.append('password',$("#password").val());
		 $.ajax({
				type:'POST',
				cache:false,
				processData:false,
				contentType:false,
				data:formData,
				url:`/admin/admin.login`,
				success:function(json){
					if(json["code"]==200)
					{
						window.location.replace("/admin");
					}
					else
					{
						$("#password").val("");
					}
				}
			});
		return false;
	});
});