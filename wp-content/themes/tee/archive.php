<?php
/**
 * The template for displaying Archive pages.
 */
 get_header(); ?>
	
	<?php if ( is_front_page() && shortcode_exists('rev_slider') ) { ?>
		<div id="background">
			<?php putRevSlider("home"); ?>
		</div>
	<?php } else { ?>
		<!-- BACKGROUND HEADER-->
		<?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
			<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		  	<div id="background" class="small" style="background-image: url('<?php echo $url; ?>');"></div>
		<?php } else { ?>
			<?php $imageUrl1 = get_template_directory_uri(). '/images/backgrounds/default.jpg'; ?>
			<div id="background" class="small" style="background-image: url('<?php echo get_theme_mod( 'tee_bg_default', $imageUrl1); ?>');"></div>
		<?php } ?>
	<?php } ?>
	
  	</header>
  	<!-- END HEADER -->
  	
  	<!-- START MAIN CONTAINER -->
  	<div id="main-container">
  		<!-- START CONTAINER -->
	  	<section id="container" class="container">
	  		<!-- TITLE -->
  			<div class="heading page-title animate_right_left">
		  		<h1>
			  		<?php if ( is_day() ) : ?>
	                    <?php printf( __( 'Daily Archives: %s', 'tee' ), '<span>' . get_the_date() . '</span>' ); ?>
	                <?php elseif ( is_month() ) : ?>
	                    <?php printf( __( 'Monthly Archives: %s', 'tee' ), '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?>
	                <?php elseif ( is_year() ) : ?>
	                    <?php printf( __( 'Yearly Archives: %s', 'tee' ), '<span>' . get_the_date( 'Y' ) . '</span>' ); ?>
	                <?php elseif ( is_category() ) : ?>
	                    <?php printf( __( 'Category Archives: %s', 'tee' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
	                <?php elseif ( is_tag() ) : ?>
	                    <?php printf( __( 'Tag Archives: %s', 'tee' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?>
	                <?php else : ?>
	                    <?php _e( 'Archives', 'tee' ); ?>
	                <?php endif; ?>
		  		</h1>
		  		<hr>
  			</div>
  			<!-- CONTENT -->
  			<div class="row">
	  			<?php if ( is_active_sidebar( 'sidebar-1' )) : ?>
	  				<div class="col-md-9">
	  			<?php else : ?>
	  				<div class="col-md-12">
	  			<?php endif; ?>
		  			<?php if ( have_posts() ) : ?>
						<?php /* The loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content', get_post_format() ); ?>
						<?php endwhile; ?>
					<?php else : ?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif; ?>
						<?php tee_paging_nav(); ?>
					</div>
	  			<?php get_sidebar(); ?>
  			</div>
	  	</section>
  		<!-- END CONTAINER -->
  	</div>
  	<!-- END MAIN CONTAINER -->
	
<?php get_footer(); ?>