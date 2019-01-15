<?php
/**
 * The Template for displaying all single blog posts.
 */
get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	
	<!-- BACKGROUND HEADER-->
	<?php $imageUrl1 = get_template_directory_uri(). '/images/backgrounds/default.jpg'; ?>
	<div id="background" class="small" style="background-image: url('<?php echo get_theme_mod( 'tee_bg_default', $imageUrl1); ?>');"></div>

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
  			<!-- CONTENT -->
  			<div class="row">
	  			<?php if ( is_active_sidebar( 'sidebar-1' ) ) :  ?>
	  				<div class="col-md-9">
	  			<?php else : ?>
	  				<div class="col-md-12">
	  			<?php endif; ?>
						<?php get_template_part( 'content', get_post_format() ); ?>
						<?php tee_paging_nav(); ?>
						<?php wp_link_pages(array('echo'=> 0)); ?>
					</div>
	  			<?php get_sidebar(); ?>
				<?php if ( comments_open()) { ?>
					<!-- START COMMENTS -->
					<div class="center col-md-12">
						<h2><?php comments_number( 'No comment on this post', 'One comment on this post', '% comments on this post' ); ?></h2>
					</div>
				<?php } ?>
  			</div>
	  	</section>
  		<?php if ( comments_open() && is_single() ){ ?>
			<?php comments_template( '', true ); ?>
		<?php } ?>
  	</div>
  	<!-- END MAIN CONTAINER -->

<?php endwhile; ?>
	
<?php get_footer(); ?>