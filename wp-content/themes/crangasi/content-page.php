<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Crangasi
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( (has_post_thumbnail()) && ( get_theme_mod( 'crangasi_page_img' ) == 1) ) : ?>
			<div class="entry-thumb">
				<?php the_post_thumbnail( 'single-thumb' ); ?>
			</div>	
		<?php endif; ?>	
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'crangasi' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php edit_post_link( __( 'Edit', 'crangasi' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->
