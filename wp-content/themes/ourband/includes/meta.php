<?php
 $options = get_option('basic'); 
?>

<?php 
//If is set display meta
if(isset($options['display_post_meta'])){ 
//If is display meta set on
if($options['display_post_meta']=='2'){ ?>
    
  <!-- Entry meta -->
  <div class="entry-meta entry-header">
	
  <?php 
  //Display author meta if is on
  if($options['display_author_meta']=='2'){ ?>
  <span class="author"><?php _e('Autor:', 'simple') ?> <?php the_author_posts_link(); ?></span>
  <?php }
  
  
  //Display category meta if is on
  if($options['display_categories_meta']=='2'){ ?>
  <span class="categories-meta"><?php _e('Category:','simple') ?> 
  <?php 
  $categories = get_the_category();
  $seperator = ', ';
  $output = '';
    if($categories){
	     foreach($categories as $category) {
		
          $output .= '<a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$seperator;
	}
        echo trim($output, $seperator);
  } ?>
  </span>
  <?php } ?>
       
  
  <?php 
  //Display date meta if is on 
  if($options['display_date_meta']=='2'){ ?>
	<span class="published"><?php the_time( get_option('date_format') ); ?></span>
  <?php } 
  
  
  //Display comments meta if is on
  if($options['display_comments_meta']=='2'){ ?>
	<span class="comment-count"><?php comments_popup_link(__('No Comments', 'simple'), __('1 Comment', 'simple'), __('% Comments', 'simple')); ?></span>
  <?php } 
	
  
  //If is logged display edit link
  edit_post_link( __('edit', 'simple'), '<span class="edit-post">[', ']</span>' ); ?>
	
  <!-- End Entry meta -->
  </div>
          
          
          
<?php
}//end display meta on 
}else{ //if is not set display meta (Theme options is not update) display default meta 
?>

  <!-- Entry meta -->
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
  } ?>
  </span>
  
  
  <span class="published"><?php the_time( get_option('date_format') ); ?></span>
	
  
  <span class="comment-count"><?php comments_popup_link(__('No Comments', 'simple'), __('1 Comment', 'simple'), __('% Comments', 'simple')); ?></span>
	
  
  <?php edit_post_link( __('edit', 'simple'), '<span class="edit-post">[', ']</span>' ); ?>
  
  
  <!-- End Entry meta -->
  </div>
  <?php }?>
