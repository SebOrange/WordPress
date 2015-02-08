<?php get_header(); ?>
<?php
 $options = get_option('basic'); 
?>
			<!--BEGIN #primary -->
			<div id="primary-full">
      <h1 id="search-full"><img src="<?php echo get_template_directory_uri(); ?>/images/zoom.png" alt="Zoom" />&nbsp;<?php printf( __( 'Search Results for: "%s"', 'simple' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
  <?php if (have_posts()) : ?>    
    
  
 			 
      <?php while (have_posts()) : the_post(); ?>
				
				<!--BEGIN .hentry -->
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">				
					
          
          <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'simple'), get_the_title()); ?>"> <?php the_title(); ?></a></h2>
									
					
          
         	<?php if(isset($options['display_category_meta'])){ ?>
          <?php if($options['display_category_meta']=='2'){ ?>
          <div class="entry-meta entry-header">
						<?php if($options['display_cat_author_meta']=='2'){ ?>
            <span class="author"><?php _e('Autor:', 'simple') ?> <?php the_author_posts_link(); ?></span>
            <?php } ?>
            <?php if($options['display_cat_categories_meta']=='2'){ ?>
            <span class="categories-meta"> | Category: <?php 
            $categories = get_the_category();
$seperator = ', ';
$output = '';
if($categories){
	foreach($categories as $category) {
		$output .= '<a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$seperator;
	}
echo trim($output, $seperator);
}
             ?></span>
            <?php } ?>
            <?php if($options['display_cat_date_meta']=='2'){ ?>
						<span class="published"> | <?php the_time( get_option('date_format') ); ?></span>
            <?php } ?>
            <?php if($options['display_cat_comments_meta']=='2'){ ?>
						<span class="meta-sep">|</span>
						<span class="comment-count"><?php comments_popup_link(__('No Comments', 'simple'), __('1 Comment', 'simple'), __('% Comments', 'simple')); ?></span>
            <?php } ?>
						<?php edit_post_link( __('edit', 'simple'), '<span class="edit-post">[', ']</span>' ); ?>
					</div>
          <?php 
          } 
          }else{ 
          ?>
          <div class="entry-meta entry-header">
						<span class="author"><?php _e('Author:', 'simple') ?> <?php the_author_posts_link(); ?></span>
						
            <span class="categories-meta"> | Category: <?php $categories = get_the_category();
$seperator = ', ';
$output = '';
if($categories){
	foreach($categories as $category) {
		$output .= '<a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$seperator;
	}
echo trim($output, $seperator);
}
             ?></span>
             <span class="published"> | <?php the_time( get_option('date_format') ); ?></span>
						<span class="meta-sep">|</span>
						<span class="comment-count"><?php comments_popup_link(__('No Comments', 'simple'), __('1 Comment', 'simple'), __('% Comments', 'simple')); ?></span>
						<?php edit_post_link( __('edit', 'simple'), '<span class="edit-post">[', ']</span>' ); ?>
					</div>
          <?php }?>
					
          
          
					<?php /* if the post has a WP 2.9+ Thumbnail */
					if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
					<div class="post-thumb">
						<a title="<?php printf(__('Permanent Link to %s', 'simple'), get_the_title()); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog'); /* post thumbnail settings configured in functions.php */ ?></a>
					</div>
          
					<?php endif; ?>

					
          <!--BEGIN .entry-content -->
					<div class="entry-content">
						<?php the_content(); ?>
					<!--END .entry-content -->
          <a class="search-more" href="<?php the_permalink(); ?>"></a>
					</div>
					
					
                
				<!--END .hentry-->  
				</div>
                

				<?php endwhile; ?>

			
      <!--BEGIN .navigation .page-navigation -->
			<div class="navigation page-navigation">
				<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
				<div class="nav-next"><?php next_posts_link(__('Older Entries', 'simple')) ?></div>
				<div class="nav-previous"><?php previous_posts_link(__('Newer Entries', 'simple')) ?></div>
				<?php } ?>
			<!--END .navigation .page-navigation -->
			</div>

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
			<!--END #primary .hfeed-->
			</div>
				


<?php get_footer(); ?>