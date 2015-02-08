<?php get_header(); ?>
<?php
 $options = get_option('basic'); 
?>
<div class="row-fluid">
  <div class="span8">
       
      <?php if (isset($options['breadcrumb_display']) && $options['breadcrumb_display']=='1'){ ?>
      <div id="breadcrumb"><?php echo the_breadcrumb(); ?></div>
      <?php } ?>
      
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<!--BEGIN .hentry -->
				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					
					
          <?php get_template_part('includes/meta','single'); //Get meta ?>
					
					
					<!--BEGIN .entry-content -->
					<div class="entry-content">
						<?php the_content(__('Read more...', 'simple')); ?>
      
      
          <?php get_template_part('includes/tags','single'); //Get tags ?>
          
          
          <?php get_template_part('includes/author-info','single'); //Get author info ?>
          
          <?php get_template_part('includes/navigation','single'); //Get navigation ?>
      
        	
					<!--END .entry-content -->
					</div>
                    
        <!--END .hentry-->  
				</div>

			
      	<?php 
        if (isset($options['comment_display'])){
          if ($options['comment_display']=='1'){
          comments_template('', true);
          }
        }else{
          comments_template('', true); 
        }
        ?>

			
      
      	<?php endwhile; else: ?>

				<!--BEGIN #post-0-->
				<div id="post-0" <?php post_class() ?>>
				
					<h1 class="entry-title"><?php _e('Error 404 - Not Found', 'simple') ?></h1>
				
					<!--BEGIN .entry-content-->
					<div class="entry-content">
						<p><?php _e("Sorry, but you are looking for something that isn't here.", "simple") ?></p>
					<!--END .entry-content-->
					</div>
				
				<!--END #post-0-->
				</div>

			<?php endif; 
      wp_reset_query();?>
			</div>
      <div class="span4">
        <?php get_sidebar(); ?>
      </div>
    </div>

<?php get_footer(); ?>