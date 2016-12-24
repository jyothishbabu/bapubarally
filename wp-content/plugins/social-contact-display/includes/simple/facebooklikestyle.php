<?php
if ( $facebooklikestyle == 'Standard' ) {
	echo '<div class="fb-like" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>'; 
}
elseif ( $facebooklikestyle == 'Box Count' ) { 
	echo '<div class="fb-like" data-layout="box_count" data-action="like" data-show-faces="false" data-share="true"></div>';
	}
elseif ( $facebooklikestyle == 'Button Count' ) { 
	echo '<div class="fb-like" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>';
	}		
	
?>