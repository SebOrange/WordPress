<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Crangasi
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">
	
		<div class="site-branding">
			<?php if ( get_theme_mod('crangasi_logo') != '' ) : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo get_theme_mod('crangasi_logo'); ?>" alt="<?php bloginfo('name'); ?>" /></a>
			<?php else : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			<?php endif; ?>
		</div>	

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<h1 class="menu-toggle"><i class="fa fa-bars"></i></h1>
			<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'crangasi' ); ?></a>	

			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>		
		</nav><!-- #site-navigation -->
		<?php if ( has_nav_menu( 'social' ) ) : ?>
				<?php wp_nav_menu( array( 'theme_location' => 'social', 'link_before' => '<span class="screen-reader-text">', 'link_after' => '</span>', 'fallback_cb' => false ) ); ?>
				<h3 class="social-toggle"><?php _e( 'Get social', 'crangasi' ); ?></h3>
		<?php endif; ?>			
	</header><!-- #masthead -->

	<div id="content" class="site-content">
