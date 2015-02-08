<?php $options = get_option('basic'); ?>

<div class="clear"></div>
<!-- END .container -->
	</div>
  <!-- END .row -->
</div>


<!--BEGIN #foot-gallery-->
<div class="row-fluid foot-gallery">
  <div class="container">
  
  <div class="foot-title-wrap">
  <div class="foot-title-w">
  <div class="foot-title">
    <h3>GALLERY</h3>
    <a class="foot-gallery-link" href="<?php echo $options['bottom_gallery_link']; ?>" >show all</a>
    
    <div id="top-socials">
        <?php if($options['basic_facebooklink']){ ?>
          <a id="ico-facebook" href="<?php echo $options['basic_facebooklink']; ?>"></a>
        <?php } ?>
        <?php if($options['basic_googlelink']){ ?>
          <a id="ico-google" href="<?php echo $options['basic_googlelink']; ?>"></a>
        <?php } ?>
        <?php if($options['basic_twitterlink']){ ?>
          <a id="ico-twitter" href="<?php echo $options['basic_twitterlink']; ?>"></a>
        <?php } ?>
        <?php if($options['basic_rsslink']){ ?>
          <a id="ico-rss" href="<?php echo $options['basic_rsslink']; ?>"></a>
        <?php } ?>
    </div>
  </div>
  </div>
  </div>
  
  <div class="row-fluid">
  <div class="foot-gallery-wrap">
    <div class="row-fluid">
    
    <?php
      if ($options['bottom_gallery_display']==2){
        $query = new WP_Query();
        $query->query('posts_per_page=6&cat='.$options['bottom_gallery'].'');
      
        if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
          <div class="span2">   
            <?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
					   <?php $image_id = get_post_thumbnail_id();
              $image_url = wp_get_attachment_image_src($image_id,'large', true);
              if ($i==1 || $i==4){}
              ?>
          
                  <div class="page-gallery-thumb">
						          <?php the_post_thumbnail('homepage-gallery'); ?>
                        <?php if(isset($options['link_fancybox'])){ ?>
                        <?php if($options['link_fancybox']=='2'){ ?>
                            <a class="page-thumb-img fancybox" href="<?php echo $image_url[0]; ?>" title="<?php  the_title(); ?>" ></a>
                            <a class="page-thumb-link" href="<?php the_permalink(); ?>" title="<?php  the_title(); ?>" ></a>
                        <?php }else{ ?> 
                            <a class="page-thumb-link-one fancybox" href="<?php echo $image_url[0]; ?>" title="<?php  the_title(); ?>" ></a>
                        <?php } 
                        } ?>  
		              </div>
            <?php endif; ?> 	
	         </div>
    <?php endwhile; 
          endif; 
      }else{ ?>
      <div class="span2">
        <div class="page-gallery-thumb">
          <img src="<?php echo get_template_directory_uri(); ?>/images/foot-gall.png" width="300" alt="Default">
        </div>
       </div> 
       <div class="span2"> 
        <div class="page-gallery-thumb">
          <img src="<?php echo get_template_directory_uri(); ?>/images/foot-gall.png" alt="Default">
        </div>
      </div> 
       <div class="span2">
        <div class="page-gallery-thumb">
          <img src="<?php echo get_template_directory_uri(); ?>/images/foot-gall.png" alt="Default">
        </div>
      </div> 
       <div class="span2">
        <div class="page-gallery-thumb">
          <img src="<?php echo get_template_directory_uri(); ?>/images/foot-gall.png" alt="Default">
        </div>
      </div> 
       <div class="span2">
        <div class="page-gallery-thumb">
          <img src="<?php echo get_template_directory_uri(); ?>/images/foot-gall.png" alt="Default">
        </div>
      </div> 
       <div class="span2">
        <div class="page-gallery-thumb">
          <img src="<?php echo get_template_directory_uri(); ?>/images/foot-gall.png" alt="Default">
        </div>
      </div>
      <?php } ?>
   
      </div>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span12">
      <p class="copyright">Theme designed and created by <a href="http://www.themes4all.com/" title="Premium Wordpress templates Themes4all">Themes4all</a>. | Powered by <a href="http://wordpress.org/" title="Wordpress">Wordpress</a>.</p>
    </div>
  </div>  
  </div>
</div>		
	<!-- Theme Hook -->
	<?php wp_footer(); ?>
			
<!--END body-->
</body>
<!--END html-->
</html>