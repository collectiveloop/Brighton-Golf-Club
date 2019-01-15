<?php
/*
Template Name: Sitemap
*/
get_header(); ?>
	
<?php while ( have_posts() ) : the_post(); ?>
	
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
		  		<h1><?php the_title(); ?></h1>
		  		<hr>
  			</div>
  			<div class="post-content">
	  			<?php the_content(); ?>
  			</div>
  			<!-- CONTENT -->
  			<div class="row">
	  			<?php if ( is_active_sidebar( 'sidebar-1' ) && get_post_meta( get_the_ID(), 'tee_page_sidebar', true)) : ?>
	  				<div class="col-md-9">
	  			<?php else : ?>
	  				<div class="col-md-12" id="faq-container">
	  			<?php endif; ?>
		  				<div class="row">
							<div class="col-md-4">
								<h3><?php _e('Pages', 'tee'); ?></h3>
								<ul class="icon archives">
									<?php wp_list_pages('title_li='); ?>
								</ul>
							</div>
							<div class="col-md-4">
								<h3><?php _e('Archives', 'tee'); ?></h3>
								<ul class="icon archives">
									<?php wp_get_archives('type=monthly'); ?>
								</ul>
							</div>
							<div class="col-md-4">
								<h3><?php _e('Categories', 'tee'); ?></h3>
								<ul class="icon archives">
									<?php wp_list_categories('title_li='); ?>
								</ul>
							</div>
		  				</div>
	  				</div>
				<?php if ( is_active_sidebar( 'sidebar-1' ) && get_post_meta( get_the_ID(), 'tee_page_sidebar', true)) : ?>
	  				<?php get_sidebar(); ?>
	  			<?php endif; ?>
  			</div>
	  	</section>
  		<!-- END CONTAINER -->
  	</div>
  	<!-- END MAIN CONTAINER -->
	
  	<?php endwhile; ?>
  	
<?php get_footer(); ?>