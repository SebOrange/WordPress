<?php
 $options = get_option('basic'); 
?>


<div class="navigation page-navigation">
  <div class="nav-previous">
    <?php previous_post_link('%link',__('Old entries','simple')); ?>
  </div>
  <div class="nav-next"> 
    <?php next_post_link('%link', __('New entries','simple')); ?> 
  </div>
</div>