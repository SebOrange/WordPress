<?php
/**
 * Crangasi functions and definitions
 *
 * @package Crangasi
 */

if ( ! function_exists( 'crangasi_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function crangasi_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Crangasi, use a find and replace
	 * to change 'crangasi' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'crangasi', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'home-thumb', 700, 350, true );
	add_image_size( 'single-thumb', 700, 9999 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'crangasi' ),
		'social' => __( 'Social', 'crangasi' )
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'crangasi_custom_background_args', array(
		'default-color' => '394146',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );
	
	// Set the content width based on the theme's design and stylesheet.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 640; /* pixels */
	}
}
endif; // crangasi_setup
add_action( 'after_setup_theme', 'crangasi_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function crangasi_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'crangasi' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer A', 'soup' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );	
	register_sidebar( array(
		'name'          => __( 'Footer B', 'soup' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );	
	register_sidebar( array(
		'name'          => __( 'Footer C', 'soup' ),
		'id'            => 'sidebar-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );	
}
add_action( 'widgets_init', 'crangasi_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function crangasi_scripts() {
	wp_enqueue_style( 'crangasi-style', get_stylesheet_uri() );
	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/fonts/font-awesome.min.css' );
	
	wp_enqueue_style( 'crangasi-open-sans', '//fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600,800');
	
	wp_enqueue_style( 'crangasi-open-sans-condensed', '//fonts.googleapis.com/css?family=Open+Sans+Condensed:700');

	wp_enqueue_script( 'crangasi-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	
	wp_enqueue_script( 'crangasi-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), true );
	
	wp_enqueue_script( 'crangasi-htmlshiv', get_template_directory_uri() . '/js/html5shiv.min.js', array(), true );
	
	wp_enqueue_script( 'crangasi-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array(), true );

	wp_enqueue_script( 'crangasi-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'crangasi_scripts' );

/**
 * Set custom classes for the 1st level menu items.
 */
function crangasi_nav_menu_css_class( $classes = array(), $item, $args ) {
	static $item_count = -1;

    if($args->theme_location == 'primary'){

        if ( ( $locations = get_nav_menu_locations() ) && $item->menu_item_parent == 0 && isset( $locations[ 'primary' ] ) ) {
            $main_nav = wp_get_nav_menu_object( $locations[ 'primary' ] );
			$item_count++;

            if ($item->menu_order >= 0) {
                $classes[] = 'top-menu-item-'.$item_count % 6; // Six classes, then restart.
            }
        }
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'crangasi_nav_menu_css_class', 10, 3 );

/**
 * Adds more contact methods in the User profile screen (links used for the author bio).
 */
function crangasi_contactmethods( $contactmethods ) {
	
	$contactmethods['crangasi_facebook'] = __( 'Author Bio: Facebook', 'crangasi' );
	$contactmethods['crangasi_twitter'] = __( 'Author Bio: Twitter', 'crangasi' );	
	$contactmethods['crangasi_googleplus'] = __( 'Author Bio: Google Plus', 'crangasi' );
	$contactmethods['crangasi_linkedin'] = __( 'Author Bio: Linkedin', 'crangasi' );
	
	return $contactmethods;
}
add_filter( 'user_contactmethods', 'crangasi_contactmethods', 10, 1);

/**
 * Adds icons to posts with a specific post format
 */
function crangasi_post_symbols() {
	
	if( true == get_post_format() && !is_sticky() ) {
		echo '<span class="corner">';
			if ( has_post_format('gallery') ) {
				echo '<i class="fa fa-camera"></i>';
			} elseif ( has_post_format('image') ) {
				echo '<i class="fa fa-camera"></i>';
			} elseif ( has_post_format('status') ) {
				echo '<i class="fa fa-asterisk"></i>';				
			} elseif ( has_post_format('quote') ) {
				echo '<i class="fa fa-quote-left"></i>';
			} elseif ( has_post_format('chat') ) {
				echo '<i class="fa fa-comments"></i>';				
			} elseif ( has_post_format('link') ) {
				echo '<i class="fa fa-link"></i>';
			} elseif ( has_post_format('video') ) {
				echo '<i class="fa fa-video-camera"></i>';
			} elseif ( has_post_format('audio') ) {
				echo '<i class="fa fa-headphones"></i>';				
			}
		echo '</span>';
	} elseif ( is_sticky() ) {
		echo '<span class="corner"><i class="fa fa-bullhorn"></i></span>';
	}
}
/**
 * Password form for excerpt of protected posts.
 */
function crangasi_password_form( $passform ) {
	if ( post_password_required() )
		$passform = get_the_password_form();

	return $passform;
}
add_filter( 'the_excerpt', 'crangasi_password_form' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Custom styles
 */
require get_template_directory() . '/styles.php';

