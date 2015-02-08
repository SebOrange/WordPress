<?php
/**
 * @package Crangasi
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php crangasi_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->
	
	<?php if ( (has_post_thumbnail()) && ( get_theme_mod( 'crangasi_post_img' ) == 1) ) : ?>
		<div class="entry-thumb">
			<?php the_post_thumbnail( 'single-thumb' ); ?>
		</div>	
	<?php endif; ?>
		
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'crangasi' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'crangasi' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'crangasi' ) );

			if ( ! crangasi_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( '<i class="fa fa-tag"></i> %2$s <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>', 'crangasi' );
				} else {
					$meta_text = __( '<i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>', 'crangasi' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( '<i class="fa fa-folder"></i> %1$s <i class="fa fa-tag"></i> %2$s <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>', 'crangasi' );
				} else {
					$meta_text = __( '<i class="fa fa-folder"></i> %1$s <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>', 'crangasi' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink()
			);
		?>

		<?php edit_post_link( __( 'Edit', 'crangasi' ), '<span class="edit-link"><i class="fa fa-edit"></i>', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
