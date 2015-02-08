<?php
 $options = get_option('basic'); 
 $i=1;
 
?>


	<div class="row-fluid">
      <div class="span8">
      <?php if (isset($options['breadcrumb_display']) && $options['breadcrumb_display']=='1'){ ?>
      <div id="breadcrumb"><?php echo the_breadcrumb(); ?></div>
      <?php } ?>
			
       
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<h1 class="page-title"><?php the_title(); ?></h1>
      <div class="entry-content">			
      <?php the_content(); ?>
			</div>
      <?php endwhile; ?>
      <?php 
      endif; 
      ?>
      
      
      <?php 
      global $more;
      $more = 0;
      global $paged;
      $paged = get_query_var( 'page' ) ? get_query_var( 'page' ) : get_query_var( 'paged' );
      $gall_set = array();
      $gall_set = maybe_unserialize( get_post_meta($post->ID,'gallery_page_settings',true) );
      
      
      foreach( $gall_set as $k => $l ){
      }
      
      
      if (isset($gall_set['gall_cat'])){
      $g_categories = $gall_set['gall_cat'];
      }else { $g_categories = array();}
      if (isset($gall_set['gall_per_page'])){
      $g_per_page = $gall_set['gall_per_page'];
      }else { $g_per_page = 12;}
      if ( !empty($g_categories) ) $g_query =  implode(",", $g_categories);
      
      $args = array(
      'cat' => $g_query,
      'posts_per_page' => $g_per_page, 
      'paged' => $paged,
      );

$temp = $wp_query;
$wp_query= null;
$wp_query = new WP_Query();
$wp_query->query($args);
      ?>
      
 <div class="cat-0">  
  <?php if (have_posts()) : ?>    
    <?php while (have_posts()) : the_post(); ?>
		  <div class="row-fluid">
      <div class="cat-12">
      <div class="row-fluid">
    
      <div class="span4">
        <?php 
			if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
				<div class="catpost-thumb">
          <div>  
						<a title="<?php printf(__('Permanent Link to %s', 'simple'), get_the_title()); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog'); ?></a>
					 
          </div>
        </div>
      <?php endif; ?>
      </div>
          
    <div class="span8">       
    <h2 class="cat-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'simple'), get_the_title()); ?>"> <?php the_title(); ?></a></h2>
    		
      <div class="entry-content">
			 <?php the_content(); ?>
			</div>
      
      <?php get_template_part('includes/cat-meta','category'); //Get meta ?>
      <a class="postpage-more" href="<?php the_permalink(); ?>"><?php _e('MORE INFO') ?></a>
    
    </div>
          
			                
        </div>
        </div>
        </div>
				<?php endwhile; ?>
        </div>	
      <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { 
				 
       mm_pagination($g_query, $g_per_page);
         } ?>
			<?php else : ?>

				<!--BEGIN #post-0-->
				
        <div id="post-0" <?php post_class(); ?>>
				
					<h1 class="entry-title"><?php _e('Error 404 - Not Found', 'simple') ?></h1>
				
					<!--BEGIN .entry-content-->
					<div class="entry-content">
						<p><?php _e("Sorry, but you are looking for something that isn't here.", "simple") ?></p>
					<!--END .entry-content-->
					</div>
				
				<!--END #post-0-->
				</div>

			<?php endif; 
      wp_reset_query();
      ?>    
    
      
        
      </div>
      <div class="span4">
        <?php get_sidebar(); ?>
      </div>      
</div>
