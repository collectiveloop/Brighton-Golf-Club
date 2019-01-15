<?php
/**
 * The template for displaying all pages.
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
	  	<section id="container" class="buddypress-container container">
	  		<?php if ( !is_user_logged_in() && get_option('tee_buddypress_private') == "true") : ?>
	  			<div class="heading page-title animate_right_left">
			  		<h1><?php _e("This is a private area, please log in.","tee"); ?></h1>
			  		<hr>
	  			</div>
	  			<script type="text/javascript">
	  				(function($) {
	  					$(window).load(function(){
		  					$("#signin-container").fadeIn();
		  				});
		  			})(jQuery);
	  			</script>
			<?php else : ?>
				<?php if ( !is_front_page() ) { ?>
		  		<!-- TITLE -->
	  			<div class="heading page-title animate_right_left">
			  		<h1><?php the_title(); ?></h1>
			  		<hr>
	  			</div>
	  			<?php } ?>
	  			<!-- CONTENT -->
	  			<div class="row">
		  				<div class="col-md-12">
		  					<div class="post-content">
		  						<?php the_content(); ?>
		  			
					  			<footer class="entry-meta">
									<?php edit_post_link( __( 'Edit', 'tee' ), '<span class="edit-link">', '</span>' ); ?>
								</footer><!-- .entry-meta -->
		  					</div>
						</div>
						<?php wp_reset_query(); ?>
					<?php if ( is_active_sidebar( 'sidebar-1' ) && get_post_meta( get_the_ID(), 'tee_page_sidebar', true)) : ?>
		  				<?php get_sidebar(); ?>
		  			<?php endif; ?>
					
					<?php wp_link_pages(array('echo'=> 0)); ?>
		  		</div>
			<?php endif; ?>
	    		
	  	</section>
  		<!-- END CONTAINER -->
  	</div>
  	<!-- END MAIN CONTAINER -->

<?php endwhile; ?>
	
<?php get_footer(); ?>