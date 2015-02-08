<?php

/*-----------------------------------------------------------------------------------

 	Plugin Name: Recent and Popular post Widget
 	Plugin URI: 
 	Description: A widget that displays your latest video
 	Version: 1.0
 	Author: 
 	Author URI:
 
-----------------------------------------------------------------------------------*/


// Add function to widgets_init that'll load our widget
add_action( 'widgets_init', 'mm_recent_popular_widgets' );

// Register widget
function mm_recent_popular_widgets() {
	register_widget( 'mm_Recent_Popular_Widget' );
}

// Widget class
class mm_recent_popular_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
function mm_Recent_Popular_Widget() {

	// Widget settings
	$widget_ops = array(
		'classname' => 'mm_recent_popular_widget',
		'description' => __('A widget that displays Recent post, Popular post, Comments and tags.', 'single')
	);

	// Widget control settings
	$control_ops = array(
		'width' => 300,
		'height' => 350,
		'id_base' => 'mm_recent_popular_widget'
	);

	/* Create the widget. */
	$this->WP_Widget( 'mm_recent_popular_widget', __('Theme4all Recent and Popular Post', 'single'), $widget_ops, $control_ops );
	
}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	extract( $args );

	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );
	$embed = $instance['embed'];
	$desc = $instance['desc'];

	// Before widget (defined by theme functions file)
	//echo $before_widget;

	// Display the widget title if one was input
  ?>
  
  
  
  
  
  <!-- RECENT Comments/Articles/tags -->
            <div id="recent-widget">
              <ul class="taby">
                <li><a class="active" id="id-tab-posts">Recent</a></li>
                <li><a id="id-tab-comments">Comments</a></li>
                <li><a id="id-tab-tags">Tags</a></li>
              </ul>
 
              <ul id="tab-posts">
              <?php 
                $posts = get_posts("numberposts=5&orderby=post_date&order=DESC&post_type=post"); 
                foreach($posts as $post) : ?>	
                <li>
                <?php
                if (is_page() || is_single() || is_archive() || is_category() || is_tag() || is_athor() || is_day() || is_month() || is_year() || is_date() || is_time() ):
                $permalink = get_permalink( $post->ID );
                 ?>
						    <a class="tab-img-thumb" title="<?php _e('Link to ', 'simple'); ?>" href="<?php echo $permalink; ?>"><?php echo get_the_post_thumbnail( $post->ID, 'sidebar'); ?></a>
					      <?php
                
					elseif ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : 
                
                ?>
						    <a class="tab-img-thumb" title="<?php _e('Link to ', 'simple'); ?>" href="<?php echo $permalink; ?>"><?php echo get_the_post_thumbnail( $post->ID, 'sidebar'); ?></a>
					      <?php endif; ?>
                
                <div class="right-recent">
                  <a class="tab-link" href="<?php echo $permalink; ?>"><?php echo $post->post_title; ?></a>
                  <p>
                    <?php echo mysql2date('M j Y', $post->post_date); ?>/
                    <span>
                      <?php $commentcount = $post->comment_count;
	                    $fulltitle = $commentcount . ' Comments';
	                    echo $fulltitle;  ?>
                    </span>
                </p>
                </div>
                </li>
              <?php endforeach; 
              wp_reset_query();
              ?>
            </ul>
            
              
            
            <ul id="tab-comments">
                <?php dp_recent_comments(5); ?>
              </ul> 
 
            <div id="tab-tags">
              <?php wp_tag_cloud(''); ?>
            </div>
        </div>
  
  
  
  
  
  
  
  
  
  
  <?php

	// After widget (defined by theme functions file)
	//echo $after_widget;
  ?>
  
  
<?php	
}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML (important for text inputs)
	$instance['title'] = strip_tags( $new_instance['title'] );
	
	// Stripslashes for html inputs
	$instance['desc'] = stripslashes( $new_instance['desc']);
	$instance['embed'] = stripslashes( $new_instance['embed']);

	// No need to strip tags

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {
	}
}
?>