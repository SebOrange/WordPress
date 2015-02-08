<?php
 $options = get_option('basic'); 

if(isset($options['display_tags'])){ 

if($options['display_tags']=='2'){ ?>

      <div class="tags-line">
        <?php the_tags('<div class="tag-item">','</div><div class="tag-item">','</div>'); ?>
      </div>
<?php 
}      
  }else{
  ?>
  
      <div class="tags-line">
        <?php the_tags('<div class="tag-item">','</div><div class="tag-item">','</div>'); ?>
      </div>
<?php
} 
?>