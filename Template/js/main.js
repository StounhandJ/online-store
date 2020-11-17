/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	

function getUrlVar(){
    var urlVar = window.location.search;
    var arrayVar = [];
    var valueAndKey = [];
    var resultArray = [];
    arrayVar = (urlVar.substr(1)).split('&');
    if(arrayVar[0]=="") return false;
    for (i = 0; i < arrayVar.length; i ++) {
        valueAndKey = arrayVar[i].split('=');
        resultArray[valueAndKey[0]] = valueAndKey[1];
    }
    return resultArray;
}
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
	
	$('#material [class="btn btn-default add-to-cart"]').click(function(event) {
			var formData = new FormData();
			_GET=getUrlVar();
			formData.append('productID',_GET["productID"]);
			formData.append('facade',_GET["facade"]);
			formData.append('materialID',$(this)[0].id);
			$.ajax({
					type:'POST',
					cache:false,
					processData:false,
					contentType:false,
					data:formData,
					url:`/api/productAddmaterial`,
					success: function(){ 
					    $(location).attr('href',"/cart"); 
					  }
			});
			return false
		});
		
	$('#product [class="btn btn-default add-to-cart"]').click(function(event) {
			var formData = new FormData();
			formData.append('productID',$(this)[0].id);
			$.ajax({
					type:'POST',
					cache:false,
					processData:false,
					contentType:false,
					data:formData,
					url:`/api/productAdd`,
					success: function(){ 
					    alert("Добавленно в корзину");
					  }
			});
			return false
		});
	
});
