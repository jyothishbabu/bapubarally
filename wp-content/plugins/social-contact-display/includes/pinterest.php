<?php

echo '<script type="text/javascript" async src="//assets.pinterest.com/js/pinit.js"></script>';

echo '<a href="//www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark"' . ( $scd_option['scd_pinterest_buttonpinheight'] == 'Large' ?'data-pin-height="28"' : '' ) . '><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_' . ( $scd_option['scd_pinterest_buttonpinheight'] == 'Large' ? '28' : '20' ) .'.png" /></a>';

?>