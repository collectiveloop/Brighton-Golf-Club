<?php
/*
Template Name: Gallery
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
  			<div id="filters" class="center animate_bottom_top">
				<button data-filter="*" class="btn btn-default"><?php _e('All','tee'); ?></button>
				<?php $terms = get_terms("gallery_category"); ?>
                <?php $count = count($terms);
                if ( $count > 0 ){
                    foreach ( $terms as $term ) {
                        echo '<button class="btn btn-default" data-filter=".category-' . $term->term_taxonomy_id . '">' . $term->name . '</button>';
                    }
                } ?>
			</div>
		</section>
	  	<div class="colored-container">
  			<!-- PHOTOS CONTAINER -->
  			<div id="gallery-container" class="isotope container">
  				<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
  				<?php $gallery_displayed = get_option('tee_gallery_display'); ?>
                <?php $wp_query = new WP_Query('post_type=gallery&post_status=publish&paged='.$paged.'&showposts='.$gallery_displayed);?>
	  			<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<!-- ITEM GALLERY -->
			    		<?php if (get_post_meta( get_the_ID(), 'tee_gallery_video', true) != ""): ?>
						<?php $terms2 = get_the_terms($post->ID,'gallery_category');
                        $count2 = count($terms2); ?>
				    	<div class="gallery-item item gallery-video <?php if ( $count2 != "" ){ foreach ( $terms2 as $term2 ) { echo 'category-' . $term2->term_taxonomy_id . ' '; }} ?>">
					    		<a href="<?php echo get_post_meta( get_the_ID(), 'tee_gallery_video', true); ?>" class="fancybox fancybox.iframe"></a>
					    		<iframe src="<?php echo get_post_meta( get_the_ID(), 'tee_gallery_video', true); ?> " frameborder="0"></iframe>
				    	</div>
				    	<?php else : ?>
						<?php $terms3 = get_the_terms($post->ID,'gallery_category');
                        $count3 = count($terms3); ?>
		                	<div class="gallery-item item <?php if ( $count3 != "" ){ foreach ( $terms3 as $term3 ) { echo 'category-' . $term3->term_taxonomy_id . ' '; }} ?>">
		                		<?php
	                            $image_id = get_post_thumbnail_id();  
	                            $image_url = wp_get_attachment_image_src($image_id,'full');  
	                            $image_url = $image_url[0];
	                            ?>
					    		<a href="<?php echo $image_url; ?>" data-fancybox-group="group1" class="fancybox">
					    			<span><?php the_title(); ?></span>
						    		 <?php echo get_the_post_thumbnail($post->ID, array(300,200)); ?> 
					    		</a>
				    		</div>
						<?php endif; ?>
			    		<!-- END ITEM -->
					<?php endwhile; ?>
				<?php else : ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif; ?>
			</div>
  		</div>
  		<section class="container">
			<?php tee_paging_nav(); ?>
			<?php wp_reset_query(); ?>
	  	</section>
  		<!-- END CONTAINER -->
  	</div>
  	<!-- END MAIN CONTAINER -->
	
  	<?php endwhile; ?>
  	
<?php get_footer(); ?>