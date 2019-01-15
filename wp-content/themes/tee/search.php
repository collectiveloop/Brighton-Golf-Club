<?php
/**
 * The template for displaying Search Results pages.
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
		  		<h1><?php printf( __( 'Search Results for: %s', 'tee' ), get_search_query() ); ?></h1>
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
							<?php if ( 'page' == get_post_type() ):  ?>
								<?php
								$classes = array(
									'row',
									'animate_left_right'
								);
								?>
								<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
									<div class="col-md-12">
										<?php if ( has_post_thumbnail() && ! post_password_required() ){?>
											<?php if ( is_single() ) { ?>
									    		<span class="post-image-wrapper">
													<?php the_post_thumbnail(); ?>
												</span>
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
											</div>
										<?php } else { ?>
											<div class="post-content">
									    		<?php the_excerpt(); ?>
											</div>
											<a href="<?php the_permalink(); ?>" class="btn btn-default pull-right"><?php _e('Read More', 'tee'); ?></a>
										<?php } ?>
									</div>
								</article>
							<?php else : ?>
								<?php get_template_part( 'content', get_post_format() ); ?>
							<?php endif; ?>
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