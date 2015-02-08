<?php
 $options = get_option('basic'); 

if(isset($options['display_author_info'])){ ?>
      <?php if($options['display_author_info']=='2'){ ?>
      <!-- Autor bio -->
      <div class="row-fluid">
      <div class="span12 author-bio">
      <div class="row-fluid">
        <div class="span3">
        <div class="author-avat">
          <?php echo get_avatar( get_the_author_meta('ID'), 80 ); ?>
        </div>
        </div>
        <div class="span9">
        <div class="author-info">
          <h3><?php the_author_meta('nickname'); ?></h3>
          <p><?php the_author_meta('description'); ?></p>
        </div>
        </div>
      </div>
      </div>
      </div>
      <?php 
      }      
      }
      ?>