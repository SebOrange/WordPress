<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Crangasi
 */
?>

	</div><!-- #content -->
	<?php get_sidebar('footer'); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'crangasi' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'crangasi' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'crangasi' ), 'Crangasi', '<a href="http://flyfreemedia.com/themes/crangasi" rel="designer">Fly Free Media</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
