<?php
require(__DIR__ . DIRECTORY_SEPARATOR."header.php");
?>
	 <div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row">    		
	    		<div class="col-sm-12">    			   			
					<h2 class="title text-center">Монтаж</h2>    			    				    				
					<div id="gmap" class="contact-map" style="word-wrap: break-word; font-size: 30px;">
					<?=$data["info"]["montage"]?>	
					</div>
				</div>			 		
			</div>    	
    	</div>	
    </div><!--/#contact-page-->
<?php
require(__DIR__ .DIRECTORY_SEPARATOR. "footer.php");
?>