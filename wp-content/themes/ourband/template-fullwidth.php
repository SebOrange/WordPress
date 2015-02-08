<?php
/*
Template Name: Fullwidth
*/
?>
<?php 
$options = get_option('basic');
?>
<?php 
get_header();  
?>
			
			<!--BEGIN #primary -->
			<div class="span12" >
      <?php if (isset($options['breadcrumb_display']) && $options['breadcrumb_display']=='1'){ ?>
      <div id="breadcrumb"><?php echo the_breadcrumb(); ?></div>
      <?php } ?>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<h1 class="page-title">
				<?php	the_title(); ?>
      </h1>	
      <div style="float:left;width:100%;height:15px;"></div>  
      <?php //get_template_part('includes/meta','page'); //Get meta ?>
      
       <!--BEGIN .hentry -->
				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
                
         	<!--BEGIN .entry-content -->
					<div class="entry-content">
                    
						<?php the_content(); ?>
						
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
      
      <?php endwhile; ?>
      <?php 
      wp_reset_query();
      endif; ?>
			
      
      
      
      
      <!--END #primary -->
			</div>

<?php get_footer(); ?>