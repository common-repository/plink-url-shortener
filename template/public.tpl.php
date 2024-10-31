<div style="margin-top:2em;">
  <?php if ($opt['Display'] != 'N'): ?>
    <?php echo __('Shortlink' , 'plink') ?>
    <a href="<?php echo $shortUrl ?>"><?php echo $shortUrl ?></a>
  <?php endif ?>
</div>

<div style="margin-top:1em;">
  <?php if ($opt['TwitterLink'] != 'N'): ?>
    <?php echo __('') ?>
    <a href="http://twitter.com/?status=<?php echo $shortUrlEncoded ?>"><img src="<?php echo plink_plugin_url.'/icons/twitter_letter-32.png' ?>" title="<?php echo __('Tweet this link' , 'plink') ?>" alt="" /></a>     <a href="https://plus.google.com/share?url=<?php echo $shortUrlEncoded ?>"><img src="<?php echo plink_plugin_url.'/icons/google-plus-32.png' ?>" title="<?php echo __('Share on Google Plus' , 'plink') ?>" alt="" /></a>        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $shortUrlEncoded ?>"><img src="<?php echo plink_plugin_url.'/icons/facebook-32.png' ?>" title="<?php echo __('Share on Facebook' , 'plink') ?>" alt="" /></a>        <a href="https://delicious.com/save?v=5&noui&jump=close&url=<?php echo $shortUrlEncoded ?>&title=<?php echo get_the_title()?>"><img src="<?php echo plink_plugin_url.'/icons/delicious-32.png' ?>" title="<?php echo __('Share on Delicious' , 'plink') ?>" alt="" /></a>    <a href="http://digg.com/submit?url=<?php echo $shortUrlEncoded ?>&title=<?php echo get_the_title() ?>"><img src="<?php echo plink_plugin_url.'/icons/digg-32.png' ?>" title="<?php echo __('Stumble Upon' , 'plink') ?>" alt="" /></a>    <a href="http://www.linkedin.com/shareArticle?url=<?php echo $shortUrlEncoded ?>&title=<?php echo get_the_title() ?>"><img src="<?php echo plink_plugin_url.'/icons/linkedin-32.png' ?>" title="<?php echo __('Stumble Upon' , 'plink') ?>" alt="" /></a>
    
   
  <?php endif ?>
</div>