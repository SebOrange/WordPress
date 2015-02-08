<?php
/*
Template Name: Sitemap
*/
?>
<?php 
$options = get_option('basic');
?>
<?php 
get_header();
wp_reset_query();  
?>
			
			<!--BEGIN #primary -->
			<div class="row-fluid">
      <?php if (isset($options['breadcrumb_display']) && $options['breadcrumb_display']=='1'){ ?>
      <div id="breadcrumb"><?php echo the_breadcrumb(); ?></div>
      <?php } ?>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<h1 class="page-title">
				<?php	the_title(); ?>
      </h1>	
      
       	<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
                
         	<!--BEGIN .entry-content -->
					<div class="entry-content">
                    
						<div class="span4 pages-sitemap">
            <h3>Pages</h3>
            <ul>
              <?php wp_list_pages('title_li='); ?>
            </ul>
           </div>
           
           <div class=" span4 pages-sitemap">
            <h3>Categories</h3>
            <ul>
              <?php wp_list_categories('orderby=name'); ?>
            </ul>
           </div>
           
            <div class="span4 pages-sitemap">
            <h3>Tags</h3>
            <ul>
              <?php 
              wp_tag_cloud('smallest=18&largest=18&unit=px&number=0&format=list');
               ?>
            </ul>
           </div>
						
						</div>

                <!--END .hentry-->  
				</div>
      
      <?php endwhile; ?>
      <?php 
      wp_reset_query();
      endif; ?>
			
      
      
      
      
      </div>

<?php get_footer(); ?>