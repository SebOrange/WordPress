<?php
 $options = get_option('basic'); 
 $i=1;
?>
<?php
global $more;
$more = 0;
?>

<?php
if ($options['homepage_display']){
if ($options['homepage_display']=='1'){
$args = array(
'page_id' =>$options['homepage_page'], 
);
}elseif ($options['homepage_display']=='2'){

global $paged;
    $paged = get_query_var( 'page' ) ? get_query_var( 'page' ) : get_query_var( 'paged' );

$cat='';
foreach($options['homepage_category'] as $k => $l){
$cat.=$l.',';
}
$cat = substr($cat,0,-1); 

$args = array(
'post_type' => 'post',
'cat' => $cat,
'paged' => $paged,
);
}
}else{
$args = array(
'post_type' => 'post',
'posts_per_page' => '1',
);
}


$temp = $wp_query;
$wp_query= null;
$wp_query = new WP_Query();
$wp_query->query($args);
?>
   
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    
  <?php if ($options['homepage_display']=='2'){ ?>   
	 <h2 class="home-post-title">
    <a title="<?php	the_title(); ?>" href="<?php the_permalink(); ?>">
		  <?php	the_title(); ?>
    </a>
  </h2>	
  
  <div class="row-fluid">    
    <div class="span4">
      <?php	if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
        <div class="post-thumb">
		      <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('homepage-blog'); ?></a>
		    </div>
      <?php endif; ?>	
    </div>
    <div class="span8">  
      <div class="entry-content">
        <?php the_content(); ?>
        <a class="homepage-more" href="<?php the_permalink(); ?>"><?php _e('MORE INFO') ?></a>
      </div>
    </div>
  </div>    
      
  <?php }else{ ?>
      
    <h2 class="home-post-title"><?php	the_title(); ?></h2>
      <div class="entry-content">
        <?php the_content(); ?>
      </div>
      
  <?php } ?>
          
	<?php endwhile; 
  pagination();      
  else: ?>  

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

			<?php 
      
      endif; 
      wp_reset_query();
      ?>