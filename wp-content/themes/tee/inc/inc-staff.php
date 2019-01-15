<?php
/**
 * The template for displaying staff members
 */
?>
<div id="staff">
	<?php
	/*VERSION 1.6.4 */
	$html_row = '<div class="row">'."\n";
	$html_end_row = '</div>'."\n";
	?>
		<?php  query_posts(array('post_type' => 'staff', 'order' => 'DESC' , 'posts_per_page'=>-1)); ?>
		<?php 
		/*VERSION 1.6.4 */
		$h = 0;
		?>
	  	<?php if ( have_posts() ) : ?>
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php 
				/*VERSION 1.6.4 */
				if ($h > 0 && !is_float($h/4)) print $html_row;
				if (!is_float($h/4)) print $html_end_row;
				?>
				<?php
				print '<!-- STAFF MEMBER -->';
			  	print '<div class="col-md-3 staff animate_bottom_top">';
				    print the_post_thumbnail();
				  	print '<h4>'. get_the_title() .'</h4>';
				  	print '<span>'. get_post_meta( get_the_ID(), 'tee_staff_job', true ) .'</span>';
				  	print '<p>'. the_content() .'</p>';
				  	print '<a href="mailto:'. get_post_meta( get_the_ID(), 'tee_staff_email', true ) .'" class="btn btn-default"><i class="icon-mail"></i> ';
				  	print get_post_meta( get_the_ID(), 'tee_staff_email', true ).'</a>';
			  	print '</div>';
			  	print '<!-- END -->';
			  	?>
			  	<?php
			  	/*VERSION 1.6.4 */
			  	$h++;
			  	?>
			<?php endwhile; ?>
		<?php endif; ?>
		<?php
		/*VERSION 1.6.4 */
		if ($h > 0) echo $html_end_row;
		?>
  	<?php wp_reset_query(); ?>
</div>