<?php
/**
 * The template for displaying 404 pages (Not Found)
 */
get_header(); ?>
	
	<!-- BACKGROUND HEADER-->
	<?php $imageUrl1 = get_template_directory_uri(). '/images/backgrounds/default.jpg'; ?>
	<div id="background" class="small" style="background-image: url('<?php echo get_theme_mod( 'tee_bg_default', $imageUrl1); ?>');"></div>

  	</header>
  	<!-- END HEADER -->
  	
  	<!-- START MAIN CONTAINER -->
  	<div id="main-container">
  		<!-- START CONTAINER -->
	  	<section id="container" class="container center">
		  	<!-- TITLE -->
			<div class="heading page-title animate_right_left">
		  		<h1 class="page-title"><?php _e( '404 error: Not found...', 'tee' ); ?></h1>
		  		<hr>
			</div>
			<!-- CONTENT -->
			<p><?php _e( 'It seems we can\'t find what you\'re looking for. Perhaps searching, or one of the links below, can help.', 'tee' ); ?></p>
		  	<?php get_search_form(); ?>	
	  	</section>
  		<!-- END CONTAINER -->
  	</div>
  	<!-- END MAIN CONTAINER -->
	
<?php get_footer(); ?>