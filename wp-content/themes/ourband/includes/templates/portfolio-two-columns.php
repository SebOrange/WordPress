<?php
 $options = get_option('basic'); 
 $i=1;
 
 if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php if($i==1){ ?>
      <div class="row-fluid">
      <?php } ?>
      <div class="span6"> 
      <div class="gallery-img-wrap">  
        
        <?php /* if the post has a WP 2.9+ Thumbnail */
					if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
					
          
          <?php $image_id = get_post_thumbnail_id();
          $image_url = wp_get_attachment_image_src($image_id,'large', true);
          ?>
          
          <div id="gall-<?php echo $image_id; ?>" class="gallery-thumb two-columns-gallery g-two">
          
						<?php the_post_thumbnail('gallery-two-thumb'); ?>
            
            <?php if(isset($options['port_fancybox'])){ ?>
          <?php if($options['port_fancybox']=='2'){ ?>
            <a class="gall-thumb-img fancybox" href="<?php echo $image_url[0]; ?>" title="<?php  the_title(); ?>" ></a>
            <a class="gall-thumb-link" href="<?php the_permalink(); ?>" title="<?php  the_title(); ?>" ></a>
            <?php 
              }else{
              ?>
              <a class="gall-thumb-link-one fancybox" href="<?php echo $image_url[0]; ?>" title="<?php  the_title(); ?>" ></a>
              <?php
              }
            }
            ?>
          </div>
          <?php else : ?>
          <div class="gallery-thumb">
						<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/gall-img1.png" alt="Thumbnail" /></a>
					</div>
					<?php endif; ?>	
					
        </div>  
        <p><?php the_excerpt(); ?></p>
        </div><!-- end gallery-img-wrap -->  
        <?php if($i==2){ ?>
      </div>  
      <?php } ?>  
				<?php
        if($i==2){$i=0;}
        $i++;
        
        endwhile; 
        endif; 
?>

