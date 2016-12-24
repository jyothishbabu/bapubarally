<?php
if( $twitteracc ) {
$twitteracc = preg_replace('/\@/', '', $twitteracc);
}
?>

<a href="https://twitter.com/<?php echo $twitteracc ?>" class="twitter-follow-button" data-show-count="<?php if ( $twittersc == '1' ) { echo 'true'; } else { echo 'false'; } ?>">Follow @<?php echo $twitteracc ?></a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>