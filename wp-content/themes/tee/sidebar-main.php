<?php
/**
 * The sidebar containing the footer widget area.
 *
 */

if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
	<div id="widgets" class="container">
		<div class="row">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div>
	</div><!-- #widgets -->
<?php endif; ?>