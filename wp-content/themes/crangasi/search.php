<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Crangasi
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'crangasi' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php $c = 0; ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<div class="<?php echo 'post-number-'.$c % 6; ?>">

				<?php get_template_part( 'content', 'search' ); ?>
				
			</div>
			<?php $c++; ?>	

			<?php endwhile; ?>			

			<?php crangasi_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
