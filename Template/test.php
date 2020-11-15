<script src="https://code.jquery.com/jquery-3.5.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/Template/colorpicker/js/evol-colorpicker.min.js"type="text/javascript"charset="utf-8"> ></script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css">
<link href="/Template/colorpicker/css/evol-colorpicker.min.css" rel="stylesheet" type="text/css">
<script src="/Template/js/test.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#mycolor").colorpicker();
        $("#mycolor").colorpicker({
			 strings: "Цвета покраски,Популярные цвета,,Назад,Назад,,Pas encore d'historique."
		});
		$("#mycolor").colorpicker({
    color: "#ffffff"
});
    });
    
</script>

<form action="" id="test" method="post">
	<input type="hidden" style="width:100px;" id="mycolor" />
    <div>
      <input type="submit" value="Submit" />
    </div>
</form>
