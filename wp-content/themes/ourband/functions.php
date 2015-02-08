<?php

/*-----------------------------------------------------------------------------------

	Here we have all the custom functions for the theme
	Please be extremely cautious editing this file,
	When things go wrong, they tend to go wrong in a big way.
	You have been warned!

-----------------------------------------------------------------------------------*/

include 'includes/gallery-admin.php';

/*-----------------------------------------------------------------------------------*/
/*	Register WP3.0+ Menus
/*-----------------------------------------------------------------------------------*/

function register_menu() {
	register_nav_menu('primary-menu', __('Primary Menu'));
}
add_action('init', 'register_menu');

/*-----------------------------------------------------------------------------------*/
/*	Register jquery
/*-----------------------------------------------------------------------------------*/

function jquery_scripts_method() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://code.jquery.com/jquery-1.8.0.min.js');
    wp_enqueue_script( 'jquery' );    
}
 
add_action('wp_enqueue_scripts', 'jquery_scripts_method');

/*-----------------------------------------------------------------------------------*/
/*	Load Translation Text Domain
/*-----------------------------------------------------------------------------------*/

add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup(){
    load_theme_textdomain('simple', get_template_directory() . '/languages');
}


/*-----------------------------------------------------------------------------------*/
/*	Load google webfonts list
/*-----------------------------------------------------------------------------------*/

include 'includes/webfonts.php';

/*-----------------------------------------------------------------------------------*/
/*	Register Sidebars
/*-----------------------------------------------------------------------------------*/
          
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Main Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
  register_sidebar(array(
		'name' => 'First featured area',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 class="featured-title">',
		'after_title' => '</h3>',
	));
  register_sidebar(array(
		'name' => 'Second featured area',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 class="featured-title">',
		'after_title' => '</h3>',
	));
  register_sidebar(array(
		'name' => 'Third featured area',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 class="featured-title">',
		'after_title' => '</h3>',
	));
  register_sidebar( array(
		'name' => __( ('Slider Widget' )),
		'id' => ('slideshow-widget'),
		'description' => __( ('Slider Widget' ))
	) );
  
	register_sidebar( array(
		'name' => __( ('Slider Widget FullWidth' )),
		'id' => ('slideshow-full-widget'),
		'description' => __( ('Slider Widget FullWidth' ))
	) );
}


/*-----------------------------------------------------------------------------------*/
/*	Configure WP2.9+ Thumbnails
/*-----------------------------------------------------------------------------------*/

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 56, 56, true ); // Normal post thumbnails
	add_image_size( 'sidebar', 50, 50, true ); // Sidebar thumbnail
  add_image_size( 'blog', 190, 150, true ); // Blog thumbnail
  add_image_size( 'blog-full', 288, 227, true ); 
  add_image_size( 'homepage-blog', 300, 160, true ); // Homepage Blog thumbnail
  add_image_size( 'blog-posts', 181, 172, true ); // Blog posts thumbnail
  add_image_size( 'homepage', 79, 56, true ); // Homepage thumbnail
  add_image_size( 'slider', 486, 270, true ); // Slider thumbnail
  add_image_size( 'homepage-gallery', 140, 93, true ); // Homepage gallery thumbnail
  add_image_size( 'gallery-thumb', 214, 128, true ); // Gallery thumbnail
  add_image_size( 'gallery-two-thumb', 454, 272, true ); // Gallery two coloumns thumbnail
  add_image_size( 'our-works', 220, 180, true ); // Homepage works thumbnail
  
  
}


/*-----------------------------------------------------------------------------------*/
/*	Custom Gravatar Support
/*-----------------------------------------------------------------------------------*/

function mm_custom_gravatar( $avatar_defaults ) {
    $mm_avatar = get_template_directory_uri() . '/images/gravatar.png';
    $avatar_defaults[$mm_avatar] = 'Custom Gravatar (/images/gravatar.png)';
    return $avatar_defaults;
}
add_filter( 'avatar_defaults', 'mm_custom_gravatar' );


/*-----------------------------------------------------------------------------------*/
/*	Change Default Excerpt Length
/*-----------------------------------------------------------------------------------*/

function mm_excerpt_length($length) {
return 14; }
add_filter('excerpt_length', 'mm_excerpt_length');


/*-----------------------------------------------------------------------------------*/
/*	Configure Excerpt String
/*-----------------------------------------------------------------------------------*/

function mm_excerpt_more($excerpt) {
return str_replace('[...]', '...', $excerpt); }
add_filter('wp_trim_excerpt', 'mm_excerpt_more');


/*-----------------------------------------------------------------------------------*/
/*	Register and load common JS
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*	Comment Styling
/*-----------------------------------------------------------------------------------*/

function mm_comment($comment, $args, $depth) {

    $isAuth = false;

    if($comment->comment_author_email == get_the_author_meta('email')) {
        $isAuth = true;
    }

    $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     
    <div id="comment-<?php comment_ID(); ?>">
    <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      <div class="line"></div>
      <div class="avatar-wrap"><?php echo get_avatar($comment,$size='66'); ?></div>
      <div class="comment-author">
         
         <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?><?php if($isAuth) { ?><span class="author-tag"><?php _e('(Author)','framework') ?></span><?php } ?>
         
         <span class="comment-meta"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></span>
      
      </div>

      <?php if ($comment->comment_approved == '0') : ?>
         <em class="moderation"><?php _e('Your comment is awaiting moderation.','simple') ?></em>
         <br />
      <?php endif; ?>
	  
       <div class="comment-body">
        <?php comment_text() ?>
	     </div>
    </div>

<?php
}


/*-----------------------------------------------------------------------------------*/
/*	Seperated Pings Styling
/*-----------------------------------------------------------------------------------*/

function tz_list_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment; ?>
<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
<?php }

/*-----------------------------------------------------------------------------------*/
/*	Recent articles/comments in sidebar
/*-----------------------------------------------------------------------------------*/
function dp_recent_comments($no_comments = 5, $comment_len = 200) { 
    global $wpdb; 
	
	$request = "SELECT * FROM $wpdb->comments";
	$request .= " JOIN $wpdb->posts ON ID = comment_post_ID";
	$request .= " WHERE comment_approved = '1' AND post_status = 'publish' AND post_password =''"; 
	$request .= " ORDER BY comment_date DESC LIMIT $no_comments"; 
		
	$comments = $wpdb->get_results($request);
	$i=1;	
	if ($comments) { 
		foreach ($comments as $comment) { 
			ob_start();
			?>
				<li class="dp-comments-<?php echo $i; ?>">
					<a href="<?php echo get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment->comment_ID; ?>"><?php echo dp_get_author($comment); ?>:</a>
					<p><?php echo strip_tags(substr(apply_filters('get_comment_text', $comment->comment_content), 0, $comment_len)); ?></p>
				</li>
			<?php
			ob_end_flush();
      $i++;
		} 
	} else { 
		echo "<li>No comments</li>";
	}
}

function dp_get_author($comment) {
	$author = "";

	if ( empty($comment->comment_author) )
		$author = __('Anonymous');
	else
		$author = $comment->comment_author;
		
	return $author;
}

/*-----------------------------------------------------------------------------------*/
/*	Breadcrumbs
/*-----------------------------------------------------------------------------------*/

function the_breadcrumb() {
	if (!is_home()) {
		echo '<a href="';
		echo get_option('home');
		echo '">';
		bloginfo('name');
		echo "</a><span>></span>";
		if (is_category() || is_single()) {
if (is_category()) {
$category = get_the_category(); 

echo $category[0]->cat_name;
}elseif(is_single()) {    
$category = get_the_category(); 
if($category[0]){
echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
}

}   
//			the_category(' ');
			if (is_single()) {
				echo "<span>></span>";
				the_title();
			}
		} elseif (is_page()) {
			echo the_title();
		}
	}
 }


/*-----------------------------------------------------------------------------------*/
/*	Load Shortcodes
/*-----------------------------------------------------------------------------------*/

include("includes/shortcodes/shortcodes.php");

/*-----------------------------------------------------------------------------------*/
/*	Load Widgets
/*-----------------------------------------------------------------------------------*/

// Add the 125x125 Ad Block Custom Widget
include("includes/widgets/widget-ad259x200.php");
// Add the Custom Video Widget
include("includes/widgets/widget-video.php");
// Add the Featured Video Widget
include("includes/widgets/widget-featured-video.php");
// Add the Custom Tabbed Widget
include("includes/widgets/widget-recent-popular.php");

/*-----------------------------------------------------------------------------------*/
/*	Load Theme Options
/*-----------------------------------------------------------------------------------*/

require_once ('nhpoption/nhp-options.php');

/*-----------------------------------------------------------------------------------*/
/*  Custom font styles	
/*-----------------------------------------------------------------------------------*/
//Body font
add_action( 'wp_head', 'custom_font_styles' );
function custom_font_styles(){

  $options = get_option('basic');
  
  if ($options['google_webfonts'] && $options['google_webfonts']!='None'){
  
  $font_style = '';
  $font_style .= "<link href='".$GLOBALS['gfonts'][$options['google_webfonts']]['url']."' rel='stylesheet' type='text/css'>
  ";
  $font_style .= "<style type='text/css'>
      body { font-family:".$GLOBALS['gfonts'][$options['google_webfonts']]['family'].",".$GLOBALS['gfonts'][$options['google_webfonts']]['type'].";  }
      </style>
      ";
  echo $font_style;
  }
}
//Titles font
add_action( 'wp_head', 'custom_titles_fonts' );
function custom_titles_fonts(){

  $options = get_option('basic');
  
  if ($options['titles_webfonts'] && $options['titles_webfonts']!='None'){
  
  $font_style = '';
  $font_style .= "<link href='".$GLOBALS['gfonts'][$options['titles_webfonts']]['url']."' rel='stylesheet' type='text/css'>
  ";
  $font_style .= "<style type='text/css'>
      h1,h2,h3,h4,h5,h6,.page-title,.entry-title { font-family:".$GLOBALS['gfonts'][$options['titles_webfonts']]['family'].",".$GLOBALS['gfonts'][$options['titles_webfonts']]['type'].";  }
      </style>
      ";
  echo $font_style;
  }
 } 
//Body text color
add_action( 'wp_head', 'body_text_color' );
function body_text_color(){
  $options = get_option('basic');
  
  if ($options['body_text_color']){
  $color_style = '';
  $color_style .= "<style type='text/css'>
      body { color:#".$options['body_text_color'].";  }
      </style>
      ";
  echo $color_style;
  }
}
//Titles text color
add_action( 'wp_head', 'titles_color' );
function titles_color(){
  $options = get_option('basic');
  
  if ($options['titles_color']){
  $color_style = '';
  $color_style .= "<style type='text/css'>
      h1,h2,h3,h4,h5,h6,.page-title,.entry-title {color:#".$options['titles_color'].";  }
      </style>
      ";
  echo $color_style;
  }
}  
//Anchor text color
add_action( 'wp_head', 'anchors_color' );
function anchors_color(){
  $options = get_option('basic');
  
  if ($options['anchors_color']){
  $color_style = '';
  $color_style .= "<style type='text/css'>
      a {color:#".$options['anchors_color'].";  }
      </style>
      ";
  echo $color_style;
  } 
}  
//Body background color
add_action( 'wp_head', 'body_background_color' );
function body_background_color(){
  $options = get_option('basic');
  
  if ($options['background_color']){
  $color_style = '';
  $color_style .= "<style type='text/css'>
      body {background-color:#".$options['background_color'].";  }
      </style>
      ";
  echo $color_style;
  }    
}


/*-----------------------------------------------------------------------------------*/
/*	Admin jquery
/*-----------------------------------------------------------------------------------*/
/*add_action( 'admin_enqueue_scripts', 'mm_query_script' );
function mm_query_script() {
		wp_register_script(
        'mm_query', 
        get_template_directory_uri().'/js/jquery-1.8.2.min.js', 
        array('jquery'));
		wp_enqueue_script('mm_query');
}

/*-----------------------------------------------------------------------------------*/
/*	Admin custom-quicktags 
/*-----------------------------------------------------------------------------------*/
add_action('admin_print_scripts', 'my_custom_quicktags');
function my_custom_quicktags() {
	wp_enqueue_script(
		'my_custom_quicktags',
		get_template_directory_uri() . '/js/my-custom-quicktags.js',
		array('quicktags')
	);
}


/*-----------------------------------------------------------------------------------*/
/*	Admin colorpicker
/*-----------------------------------------------------------------------------------*/
add_action( 'admin_enqueue_scripts', 'mm_colorpicker_style' );
function mm_colorpicker_style(){  
    wp_register_style( 'colorpicker', get_template_directory_uri() . '/includes/colorpicker/css/colorpicker.css' );  
    wp_enqueue_style( 'colorpicker' );  
}  
add_action( 'wp_enqueue_scripts', 'my_style_load' ); 


function mm_colorpicker_script() {
		wp_register_script('my_colorpicker', get_template_directory_uri().'/includes/colorpicker/js/my_colorpicker.js', array('jquery'));
		wp_enqueue_script('my_colorpicker');
}
add_action( 'admin_enqueue_scripts', 'mm_colorpicker_script' );
function mm_eye_script() {
		wp_register_script('eye', get_template_directory_uri().'/includes/colorpicker/js/eye.js', array('jquery'));
		wp_enqueue_script('eye');
}
add_action( 'admin_enqueue_scripts', 'mm_eye_script' );

/*-----------------------------------------------------------------------------------*/
/*	Tinymce shortcode
/*-----------------------------------------------------------------------------------*/
add_action('init', 'mytiny_button');
function mytiny_button() {
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
     return;
   }
   if ( get_user_option('rich_editing') == 'true' ) {
     add_filter( 'mce_external_plugins', 'add_plugin' );
     add_filter( 'mce_buttons', 'register_button' );
   }
}


function register_button( $buttons ) {
 array_push( $buttons, "|", "mm_bigbutton" );
 array_push( $buttons, "", "mm_smallbutton" );
 array_push( $buttons, "", "mm_icobutton" );
 array_push( $buttons, "|", "mm_smallbox_third" );
 array_push( $buttons, "", "mm_smallbox_half" );
 array_push( $buttons, "", "mm_smallbox_full" );
 return $buttons;
}
function add_plugin( $plugin_array ) {
   $plugin_array['mm_bigbutton'] = get_bloginfo( 'template_url' ) . '/js/my-custom-tags.js';
   $plugin_array['mm_smallbutton'] = get_bloginfo( 'template_url' ) . '/js/my-custom-tags.js';
   $plugin_array['mm_icobutton'] = get_bloginfo( 'template_url' ) . '/js/my-custom-tags.js';
   $plugin_array['mm_smallbox_third'] = get_bloginfo( 'template_url' ) . '/js/my-custom-tags.js';
   $plugin_array['mm_smallbox_half'] = get_bloginfo( 'template_url' ) . '/js/my-custom-tags.js';
   $plugin_array['mm_smallbox_full'] = get_bloginfo( 'template_url' ) . '/js/my-custom-tags.js';
   return $plugin_array;
}

/*-----------------------------------------------------------------------------------*/
/*	Pagination
/*-----------------------------------------------------------------------------------*/
function pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}


/*-----------------------------------------------------------------------------------*/
/*	Page Gallery/Blog pagination
/*-----------------------------------------------------------------------------------*/

function mm_pagination($cats, $perpage, $range = 2)
{  
     
     $showitems = ($range * 2)+1;
    
    $args = array(
      'cat' => $cats,
      'showposts' => '-1'
      );
    
    global $wp_query;
    $temp = $wp_query;
    $wp_query= null;
    $wp_query = new WP_Query();
    $wp_query->query($args);
    $pages = $wp_query->post_count;
     global $paged;
    if(empty($paged)) $paged = 1;

    $pages = ceil($pages / $perpage);
     if(1 != $pages)
     {
         echo "<div class='mm-pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
          if (1 != $pages &&( !($i >= $paged+$range || $i <= $paged-$range) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
     
}
  



?>
