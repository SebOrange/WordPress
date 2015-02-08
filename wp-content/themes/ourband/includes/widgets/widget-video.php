<?php

/*-----------------------------------------------------------------------------------

 	Plugin Name: Video Widget
 	Plugin URI: 
 	Description: A widget that displays your latest video
 	Version: 1.0
 	Author: 
 	Author URI:
 
-----------------------------------------------------------------------------------*/


// Add function to widgets_init that'll load our widget
add_action( 'widgets_init', 'mm_video_widgets' );

// Register widget
function mm_video_widgets() {
	register_widget( 'mm_Video_Widget' );
}

// Widget class
class mm_video_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
function mm_Video_Widget() {

	// Widget settings
	$widget_ops = array(
		'classname' => 'mm_video_widget',
		'description' => __('A widget that displays your YouTube or Vimeo Video.', 'framework')
	);

	// Widget control settings
	$control_ops = array(
		'width' => 300,
		'height' => 350,
		'id_base' => 'mm_video_widget'
	);

	/* Create the widget. */
	$this->WP_Widget( 'mm_video_widget', __('Theme4all Video Widget', 'framework'), $widget_ops, $control_ops );
	
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
  echo '<div class="vid-widget">';

	// Display the widget title if one was input
  ?>
  <div style="float:left;width:100%;">
  
  <?php
	if ( $title )
		echo $before_title . $title . $after_title;

	// Display video widget
	?>
		
		<div class="tz_video">
		<?php echo $embed ?>
		</div>
		
		<p class="tz_video_desc"><?php echo $desc ?></p>
	
	<?php

	// After widget (defined by theme functions file)
	echo '</div>';
  //echo $after_widget;
  ?>
  </div>
  
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

	// Set up some default widget settings
	$defaults = array(
		'title' => 'My Video',
		'embed' => stripslashes( '<iframe width="259" height="220" src="http://www.youtube.com/embed/wkmqDiDTcBY" style="border: none;"></iframe>'),
		'desc' => 'This is my latest video.',
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'simple') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<!-- Embed Code: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'embed' ); ?>"><?php _e('Embed Code, width 259px x 220px:', 'simple') ?></label>
		<textarea style="height:200px;" class="widefat" id="<?php echo $this->get_field_id( 'embed' ); ?>" name="<?php echo $this->get_field_name( 'embed' ); ?>"><?php echo stripslashes(htmlspecialchars(( $instance['embed'] ), ENT_QUOTES)); ?></textarea>
	</p>
	
	<!-- Description: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e('Short Description:', 'simple') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['desc'] ), ENT_QUOTES)); ?>" />
	</p>
		
	<?php
	}
}
?>