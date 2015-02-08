<?php
/**
 * Author bio
 *
 */
?>

<div class="author-bio">
	<div class="author-info clear">		
		<?php
			$author_name = get_the_author_meta('display_name');	
			$author_facebook = get_the_author_meta('crangasi_facebook');
			$author_twitter = get_the_author_meta('crangasi_twitter');
			$author_googleplus = get_the_author_meta('crangasi_googleplus');
			$author_linkedin = get_the_author_meta('crangasi_linkedin');
		?>
		
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), 80 ); ?>
		
		<span class="author-name">
			<?php printf(__('About %s', 'crangasi'), esc_html($author_name) ); ?>				
		</span></br>
		
		<div class="author-social">
			<?php if ( $author_facebook != '' ) : ?>
				<a href="<?php echo esc_url($author_facebook); ?>" title="Facebook"><i class="fa fa-facebook-square"></i></a>
			<?php endif; ?>
			<?php if ( $author_twitter != '' ) : ?>
				<a href="<?php echo esc_url($author_twitter); ?>" title="Twitter"><i class="fa fa-twitter-square"></i></a>
			<?php endif; ?>
			<?php if ( $author_googleplus != '' ) : ?>
				<a href="<?php echo esc_url($author_googleplus); ?>" title="Google Plus"><i class="fa fa-google-plus-square"></i></a>
			<?php endif; ?>
			<?php if ( $author_linkedin != '' ) : ?>
				<a href="<?php echo esc_url($author_linkedin); ?>" title="Linkedin"><i class="fa fa-linkedin-square"></i></a>
			<?php endif; ?>
		</div>
	</div>
	
	<div class="author-desc">
		<?php esc_html(the_author_meta( 'description' )); ?>
	</div>
	<span class="view-all"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php printf(__('View all posts by %s', 'crangasi'), esc_html($author_name) ); ?></a>&nbsp;<i class="fa fa-long-arrow-right"></i></span>

</div> 


