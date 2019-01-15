<?php
/**
 * The sidebar containing the secondary widget area, displays on Blog Page.
 */

if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<!-- START SIDEBAR -->
	<div id="sidebar" class="col-md-3 animate_right_left">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #tertiary -->
<?php endif; ?>