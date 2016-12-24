<?php
if( $scd_option['scd_twitter_acc'] ) {
$scd_option['scd_twitter_acc'] = preg_replace('/\@/', '', $scd_option['scd_twitter_acc']);
}
?>

<a href="https://twitter.com/<?php echo $scd_option['scd_twitter_acc'] ?>" class="twitter-follow-button" data-show-count="<?php if ( $scd_option['scd_twitter_sc'] == '1' ) { echo 'true'; } else { echo 'false'; } ?>">Follow @<?php echo $scd_option['scd_twitter_acc'] ?></a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>