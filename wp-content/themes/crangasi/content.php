<?php
/**
 * @package Crangasi
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-info">
	
		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-time">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" >
					<?php if (get_theme_mod('crangasi_date_format')=='js-m') : ?>
						<?php the_time('jS M') ?>
					<?php else: ?>
						<?php the_time('M jS') ?>
					<?php endif; ?>
				</a>
				
			</div><!-- .entry-time -->
		<?php endif; ?>	
		
		<div class="tooltip-author">
			<i class="fa fa-user"></i>
			<span class="author-link">
			<?php printf( __( 'View all posts by %1$s', 'crangasi' ),
					sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
						esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
						esc_html( get_the_author() )
					)
			); ?>
			</span>
		</div>

		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'crangasi' ) );
				if ( $categories_list && crangasi_categorized_blog() ) :
			?>
			<div class="tooltip-cats">
				<i class="fa fa-folder"></i>
				<span class="cat-links">
					<?php printf( __( 'Posted in %1$s', 'crangasi' ), $categories_list ); ?>
				</span>
			</div>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'crangasi' ) );
				if ( $tags_list ) :
			?>
			<div class="tooltip-tags">
				<i class="fa fa-tag"></i>
				<span class="tags-links">
					<?php printf( __( 'Tagged %1$s', 'crangasi' ), $tags_list ); ?>
				</span>
			</div>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<div class="tooltip-comments">
			<i class="fa fa-comment"></i>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'crangasi' ), __( '1 Comment', 'crangasi' ), __( '% Comments', 'crangasi' ) ); ?></span>
		</div>	
		<?php endif; ?>
		
		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		</header><!-- .entry-header -->		
	
	</div>

	<div class="post-content">			
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="thumb-wrapper">
				<div class="entry-thumb">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" >
						<?php the_post_thumbnail( 'home-thumb' ); ?>
					</a>
				</div>	
			</div>
		<?php endif; ?>			

		<?php if( false == get_post_format() ) : ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div>
		<?php else : ?>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		<?php endif; ?>

		<footer class="entry-footer">
			<?php edit_post_link( __( 'Edit', 'crangasi' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-footer -->
	</div>

	<?php echo crangasi_post_symbols(); ?>
	
</article><!-- #post-## -->	