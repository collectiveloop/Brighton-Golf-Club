<?php
/**
 * The template for displaying gallery photos
 */
?>
							</div><!-- END .wpb_wrapper -->
						</div><!-- END .vc_span12 -->
					</div><!-- END .wpb_row -->
				</div><!-- END .post-content -->
			</div><!-- END .row -->
	</div><!-- END .col-md -->
</section><!-- END #CONTAINER -->
<div id="gallery-slider" class="flexslider">
	<ul class="slides">
		<?php 
		$html_begin_slider = '<li>'."\n";
		$html_end_slider = '</li>'."\n";
		
		query_posts(array('post_type' => 'gallery', 'gallery_category' => $category_final, 'showposts' => $display_final));
		$h = 0;
		if (have_posts()):
			while (have_posts()):
				the_post();
				
				if ($h > 0 && !is_float($h/2)) print $html_end_slider;
				if (!is_float($h/2)) print $html_begin_slider;
				
				if (get_post_meta( get_the_ID(), 'tee_gallery_video', true) != ""): 
				
					$video_url = get_post_meta( get_the_ID(), 'tee_gallery_video', true);
				    print '<!-- FIRST ITEM GALLERY -->'."\n";
					print '<div class="gallery-item gallery-video ">'."\n";
					print '<a href="'. $video_url .'" class="fancybox fancybox.iframe"></a>'."\n";
					print '<iframe src="'. $video_url .'" frameborder="0"></iframe>'."\n";
					print '</div>'."\n";

				else : 
				
					$image_id = get_post_thumbnail_id();  
			        $image_url = wp_get_attachment_image_src($image_id,'full');  
			        $image_url = $image_url[0];
			       
					print '<!-- FIRST ITEM GALLERY -->'."\n";
					print '<div class="gallery-item">'."\n";
					print '<a href="'. $image_url .'" data-fancybox-group="group1" class="fancybox">'."\n";
					print '<span>'. get_the_title() .'</span>'."\n";
					the_post_thumbnail(array(300,200));
					print '</a>'."\n";
					print '</div>'."\n";
				
				endif;
				 
				$h++;
		 
		    endwhile;
		endif;
		if ($h > 0) echo $html_end_slider; ?>
		<?php wp_reset_query(); ?>
	</ul>
</div>
<div class="container button-container">
	<a href="<?php echo $button_url_final; ?>" class="btn btn-default pull-right"><i class="icon-pictures"></i> 
	<?php _e("All Photos", "tee"); ?></a>
</div>
<section class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="post-content">
				<div class="wpb_row vc_row-fluid">
					<div class="vc_span12 wpb_column column_container">
						<div class="wpb_wrapper">