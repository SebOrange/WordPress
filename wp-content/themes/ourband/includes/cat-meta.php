<?php
 $options = get_option('basic'); 
?>


<?php if(isset($options['display_category_meta'])){ ?>
          <?php if($options['display_category_meta']=='2'){ ?>
          <div class="cat-meta entry-header">
						<?php if($options['display_cat_author_meta']=='2'){ ?>
            <span class="author"><?php _e('Autor:', 'simple') ?> <?php the_author_posts_link(); ?></span>
            <?php } ?>
            <?php if($options['display_cat_categories_meta']=='2'){ ?>
            <span class="categories-meta"><?php _e('Category:','simple') ?> <?php 
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
						<span class="published"><?php the_time( get_option('date_format') ); ?></span>
            <?php } ?>
            <?php if($options['display_cat_comments_meta']=='2'){ ?>
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
						
            <span class="categories-meta"><?php _e('Category:','simple') ?> <?php $categories = get_the_category();
$seperator = ', ';
$output = '';
if($categories){
	foreach($categories as $category) {
		$output .= '<a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$seperator;
	}
echo trim($output, $seperator);
}
             ?></span>
             
						<span class="comment-count"><?php comments_popup_link(__('No Comments', 'simple'), __('1 Comment', 'simple'), __('% Comments', 'simple')); ?></span>
						<?php edit_post_link( __('edit', 'simple'), '<span class="edit-post">[', ']</span>' ); ?>
					</div>
          <?php }?>