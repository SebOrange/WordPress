<?php 
/*
Template Name: Portfolio Page
*/
?>
<?php
 $options = get_option('basic'); 
 $i=1;
?>
<?php get_header(); ?>

			<div class="row-fluid">
      <div class="span12">
      <?php if (isset($options['breadcrumb_display']) && $options['breadcrumb_display']=='1'){ ?>
      <div id="breadcrumb"><?php echo the_breadcrumb(); ?></div>
      <?php } ?>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<h1 class="page-title">
				<?php	the_title(); ?>
      </h1>	
      
       <!--BEGIN .hentry -->
				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
                
         	<!--BEGIN .entry-content -->
					<div class="entry-content">
                    
						<?php the_content(); ?>
						
					<!--END .entry-content -->
					</div>

                <!--END .hentry-->  
				</div>
      <?php endwhile; ?>
      <?php endif; 
      wp_reset_query();
      ?>
      </div>
			<div class="clear"></div>
      <?php 
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
$count_posts = $wp_query->post_count;
      ?>
      
<?php 
      if (isset($gall_set['gallery_columns'])){
          if ($gall_set['gallery_columns']==1){
            get_template_part('/includes/templates/portfolio-two-columns');
          }elseif($gall_set['gallery_columns']==2){
            get_template_part('/includes/templates/portfolio-four-columns');
          }
      }else{
          get_template_part('/includes/templates/portfolio-four-columns');
      }
      
      
?>        
      
        <!-- Pagination -->
        <?php
        
        mm_pagination($g_query, $g_per_page);
        
        wp_reset_query();
        
        ?>
        
      
      
</div>

<?php //get_sidebar(); ?>

<?php get_footer(); ?>