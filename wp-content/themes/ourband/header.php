<!DOCTYPE html>
<?php $options = get_option('basic'); ?>
<!-- BEGIN html -->
<html <?php language_attributes(); ?>>

<!-- BEGIN head -->
<head>

	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="description" content="<?php bloginfo('description'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <!-- Title -->
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
  
  <!-- Favicon -->
  <?php if($options['basic_favicon']){  ?>
  <link rel="shortcut icon" href="<?php echo $options['basic_favicon']; ?>" />
	<?php } ?>
  
    <!-- Bootstrap -->
  <link href="<?php echo get_template_directory_uri(); ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo get_template_directory_uri(); ?>/bootstrap/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
	
  <!-- Google font -->
  <link href='http://fonts.googleapis.com/css?family=Strait' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Telex' rel='stylesheet' type='text/css'>
  <!-- Google font for shortcodes -->
  <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
  
  
	<!-- Stylesheets -->
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
  <link rel="stylesheet" href="public/css/main.css" type="text/css" media="screen" />
  
  <!--[if IE 8]>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie8.css" type="text/css" media="screen" />
<![endif]-->
  
	<!-- RSS & Pingbacks -->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php bloginfo( 'rss2_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    
        
	<?php wp_head(); ?>  
  
    <!-- Jquery and Jquery UI include -->
  <script src="<?php echo get_template_directory_uri(); ?>/js/jquery-ui-1.8.20.custom.min.js"></script>
  
  <!-- Fancybox -->
 <script src="<?php echo get_template_directory_uri(); ?>/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" /> 
                   
  
  <!-- Javascript files -->
  <script src="<?php echo get_template_directory_uri(); ?>/js/page.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/menu.js"></script>
  
  
  <!-- Bootstrap -->
  <script src="<?php echo get_template_directory_uri(); ?>/bootstrap/js/bootstrap.min.js"></script>
  
 
  <?php if(is_front_page()){ ?>
  <style>
  #wp-admin-bar-edit{ display:none!important; }
  </style>
  <?php } ?>
 
<?php if($options['background_pattern']){ 
  if($options['background_pattern']=='none') { ?>
  <style>
  body{
  background-image:none;
  }
  </style> 
  
  <?php }else{
  echo '<style>
  body{
  background-image:url(\''.get_template_directory_uri().'/images/patterns/'.$options['background_pattern'].'.png\');
  background-color:transparent;
  }     
  </style>';        
 } 
 } else { ?>
  <style>
  body{
  background-image:none;
  }
  </style> 
<?php } 
?>
  <!-- END head -->
</head>

<!-- BEGIN body -->
<body <?php body_class(); ?>>

 <div <?php if(is_front_page()){ echo 'id="home-wrapper"';}else{ echo 'id="wrapper"';} ?>>

<?php if(is_front_page()){ ?>
<div class="header-home">
<?php }else{ ?>
<div class="header">
<?php } ?>
  
  <div class="row-fluid">
    <div class="container">
      <div class="row-fluid">
        <div class="span12">
          <!-- BEGIN #primary-nav -->
          <div id="primary-nav" class="hidden-phone">
            <?php if ( has_nav_menu( 'primary-menu' ) ) { ?>
              <?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'sf-menu', 'container' => '' ) ); ?>
                <?php } else { /* else use wp_list_pages */?>
                  <ul class="sf-menu">
                    <li><a href="/">Home</a></li>
                    <li><a href="/?page_id=2">Sample Page</a></li>
                    <li><a href="/?p=1">Sample post</a></li>
                  </ul>
                <?php } ?>
          <!-- END #primary-nav -->
          </div>
          <div id="p-n" class="dropdown">
            <a class="navig dropdown-toggle" id="drop4" role="button" data-toggle="dropdown">Navigation</a>
            <?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'dropdown-menu', 'container' => '','items_wrap'      => '<ul id="%1$s" aria-labelledby="drop4" class="%2$s">%3$s</ul>', ) ); ?>
          </div>
        </div>
      </div>
      <div class="row-fluid">
        <div class="span12">
          <!-- BEGIN #logo -->
          <div class="logo3">
          <div id="logo" class="responziveLogo">
            <?php if ($options['basic_logo']) { ?>
              <a href="<?php echo home_url(); ?>"><img src="<?php echo $options['basic_logo']; ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
            <?php } else { ?>
              <a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
            <?php } ?>
          <!-- END #logo -->
          </div>
          </div>
        </div>
      </div>
    </div>  
  </div>
  
<?php if(is_front_page()){ ?>



<div class="row-fluid slid-d">
<?php if ( !is_active_sidebar( 'slideshow-widget' ) && !is_active_sidebar( 'slideshow-full-widget' )) : ?>
  <div class="container">   
  <div class="slider-default">
    <img class="slider-shadow" src="<?php echo get_template_directory_uri(); ?>/images/slider-shadow.png" alt="slider">
    <img src="<?php echo get_template_directory_uri(); ?>/images/slider.png" alt="slider">
  </div>  
  </div>
<?php else: ?>

<?php if ( is_active_sidebar( 'slideshow-widget' ) ) : ?>
  <div class="container">   
    <div class="slider-content-wrap">
      <?php dynamic_sidebar('slideshow-widget');  ?>
    </div>
  </div>
<?php endif; ?>  

<?php if ( is_active_sidebar( 'left-sidebar' ) ) : ?>    
  <?php dynamic_sidebar('slideshow-full-widget');?>
<?php endif; ?>

<?php endif; ?>      
    
</div>  
  
<div class="row-fluid">
  <div class="container">
    <img class="slider-shadow-bottom" src="<?php echo get_template_directory_uri(); ?>/images/slider-shadow-bottom.png" alt="slider-shadov">  
  </div>
</div>  

<div class="row-fluid player-wrap">
  <div class="container">
    <div class="player">
    <?php  
if(isset($options['player_page']) && $options['player_page'] != 2 ){ 
$args = array(
'page_id' =>$options['player_page'], 
);
$temp = $wp_query;
$wp_query= null;
$wp_query = new WP_Query();
$wp_query->query($args);
?>
			<?php if (have_posts()) : ?>   
      <?php while (have_posts()) : the_post(); ?>
      <?php the_content(); ?>
				<?php endwhile; ?>
        <?php 
        endif;
        } ?>	  
    </div>      
  </div>
</div>  
  
<?php } ?>

  </div>

<div class="clear"></div>
  
<?php if(is_front_page()){ ?>
<div class="row-fluid content-home">
<?php }else{ ?>
<div class="row-fluid content">
<?php } ?>
<div class="container"> 