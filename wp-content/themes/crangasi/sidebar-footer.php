<?php
/**
 *
 * @package Crangasi
 */
?>

<?php if ( is_active_sidebar( 'sidebar-2' ) || is_active_sidebar( 'sidebar-3' ) || is_active_sidebar( 'sidebar-4' ) ) : ?>
	<div id="sidebar-footer" class="footer-widget-area clear" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
			<div class="sidebar-column"> <?php
				dynamic_sidebar( 'sidebar-2'); 
			?> </div> <?php	
		}
		if ( is_active_sidebar( 'sidebar-3' ) ) { ?>
			<div class="sidebar-column"> <?php
				dynamic_sidebar( 'sidebar-3'); 
			?> </div> <?php	
		}
		if ( is_active_sidebar( 'sidebar-4' ) ) { ?>
			<div class="sidebar-column"> <?php
				dynamic_sidebar( 'sidebar-4'); 
			?> </div> <?php	
		}		
		?>
	</div>
<?php endif; ?>