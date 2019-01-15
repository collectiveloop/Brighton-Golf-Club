<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 */
?>
<!-- START POST -->
<?php
$classes = array(
	'row',
	'animate_left_right'
);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
	<div class="col-md-3">
		<?php tee_entry_meta(); ?>
	</div>
	<div class="col-md-9">
		<?php if ( has_post_thumbnail() && ! post_password_required() ){?>
			<?php if ( is_single() ) { ?>
	    		<span class="post-image-wrapper">
					<?php the_post_thumbnail(); ?>
				</span>
				<hr>
			<?php } else { ?>
			    <a href="<?php the_permalink(); ?>" class="post-image-wrapper">
					<?php the_post_thumbnail(); ?>
			    </a>
			<?php } ?>
		<?php } ?>
		<?php if ( !is_single() ) { ?>
			<h3 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
		<?php } ?>
		<?php if ( is_single() ) { ?>
			<div class="post-content">
	    		<?php the_content(); ?>
	    		
	    		<div class="entry-meta">
					<?php edit_post_link( __( 'Edit', 'tee' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry-meta -->
			</div>
		<?php } else { ?>
			<div class="post-content">
	    		<?php the_excerpt(); ?>
			</div>
			<a href="<?php the_permalink(); ?>" class="btn btn-default pull-right"><?php _e('Read More', 'tee'); ?></a>
		<?php } ?>
	</div>
</article>
<!-- END POST -->
