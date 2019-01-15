<?php
/**
 * The template for displaying a "No posts found" message.
 */
?>

<!-- START POST -->
<div class="post row animate_left_right">
	<div class="col-md-12">
		<h3 class="post-title"><?php _e( 'Nothing Found', 'tee' ); ?></h3>
		<div class="post-content">
			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
				<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'tee' ), admin_url( 'post-new.php' ) ); ?></p>
			<?php elseif ( is_search() ) : ?>
				<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'tee' ); ?></p>
				<div class="center"><?php get_search_form(); ?></div>
			<?php else : ?>
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'tee' ); ?></p>
				<div class="center"><?php get_search_form(); ?></div>
			<?php endif; ?>
		</div>
	</div>
</div>
<!-- END POST -->
