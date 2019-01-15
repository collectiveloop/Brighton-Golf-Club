<?php
/*
Template Name: Clubrooms
*/
 get_header();?>
  <?php
  $fetured_img_clubrooms = get_option_tree( 'fetured_img_clubrooms', '', false );
  $clubrooms_book_page = get_option_tree( 'clubrooms_book_page', '', false );
  $clubrooms_book_page_member_login = get_option_tree( 'clubrooms_book_page_member_login', '', false );
  
  ?>
		<section class="banner_area" id="banner_area" style="background:url(<?php echo $fetured_img_clubrooms;?>) no-repeat scroll center center;background-size:cover;">
			<?php get_template_part('banner');?>
		</section>
<?php get_template_part('navigation');?>
		<section id="sologan_section" class="sologan_section">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="sologan text-center clubrooms_text">
							<img src="<?php echo get_template_directory_uri();?>/img/fetured_img.png">
							<h2>Book our clubrooms for your next event</h2>
							<p>Our function room is available outside of golf competition hours, which is ideal for small to medium<br>sized adult parties, work groups or milestone events.  </p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section id="fetures_clubrooms_area" class="fetures_clubrooms_area">
			<div class="fetures_clubrooms">
				<h2 class="text-center">Discover our clubrooms</h2>
	<?php

    global $post;

    $args = array( 'posts_per_page' => 6, 'post_type'=> 'clubroom-features','meta_key' => 'clubroom_features','orderby' => 'meta_value','order' => 'ASC');

    $myposts = get_posts( $args );

    foreach( $myposts as $post ) : setup_postdata($post); ?>
				<div class="single_fetures_clubrooms">
					<?php the_post_thumbnail('clubroom-thumb'); ?>
				</div>	
<?php endforeach; ?>				
		
			</div>
		</section>
		<section class="member_login_area_club" id="member_login_area_club">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="memmber_title text-center">
							<h2>Corporate Events</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-9 col-sm-offset-3">
						<div class="member_text_right member_text_right_c">
							<?php echo $clubrooms_book_page_member_login;?>

							
						</div>
					</div>
					<div class="go_to_login book_club_ar">
							<a href="<?php echo $clubrooms_book_page;?>" class="btn btn-default">Click to book</a>
					</div>
				</div>
			</div>
		</section>
		<section class="club_specilty_area_club" id="club_specilty_area_club">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="club_specilty_title text-center">
							<h2>Benfits of our clubrooms</h2>
						</div>
					</div>
				</div>
				<div class="row">
	<?php

    global $post;

    $args = array( 'posts_per_page' => 6, 'post_type'=> 'clubroom-benfits','meta_key' => 'clubroom_benfits','orderby' => 'meta_value','order' => 'ASC');

    $myposts = get_posts( $args );

    foreach( $myposts as $post ) : setup_postdata($post); ?>
					<div class="col-sm-4">
						<div class="single_club_specilty nes_rahmath text-center">
							<?php the_post_thumbnail('clubroom-benifts-thum'); ?>
							<h2><?php the_title();?></h2>
							<?php the_content();?>
						</div>
					</div>	
<?php endforeach; ?>						
				</div>
			</div>
		</section>
<section class="member_login_area_club_book" id="member_login_area_club_book">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="memmber_title text-center">
							<h2>How to Book</h2>
						</div>
					</div>
				</div>
							<div class="row">
		<?php

    global $post;

    $args = array( 'posts_per_page' => 3, 'post_type'=> 'clubroom-book','meta_key' => 'clubroom_book','orderby' => 'meta_value','order' => 'ASC');

    $myposts = get_posts( $args );

    foreach( $myposts as $post ) : setup_postdata($post); ?>						
					<div class="col-sm-4">
						<div class="single_club_specilty text-center membership_club">
							<?php 
						$clubrooms_book_number= get_post_meta($post->ID, 'clubrooms_book_number', true);
						
						?>
							<h3><?php echo $clubrooms_book_number;?></h3>
							<h2><?php the_title();?></h2>
							<?php the_content();?>
						</div>
					</div>	
<?php endforeach; ?>					
								
				<div style="clear:both"></div>
					<div class="go_to_login text-center clicl_n">
								<a href="<?php echo $clubrooms_book_page;?>" class="btn btn-default">Click to book</a>
					</div>

				</div>
			</div>
		</section>

<script type="text/javascript">
         jQuery(document).ready(function(){
             //execute code when document is ready
             jQuery('.note1').hide();
             jQuery(document).on("change", "#game", function () {
                 jQuery('.note1').hide();
                 var neededId = jQuery(this).val();
                 var divToShow = jQuery(".note1").filter("[id='" + neededId + "']");
                 divToShow.show();
             });          
        });       
		jQuery(document).ready(function(){
             //execute code when document is ready
             jQuery('.note2').hide();
             jQuery(document).on("change", "#game", function () {
                 jQuery('.note2').hide();
                 var neededId = jQuery(this).val();
                 var divToShow = jQuery(".note2").filter("[id='" + neededId + "']");
                 divToShow.show();
             });          
        });
</script>


		<section class="contact_us_clubrooms_area_new" id="contact_us_clubrooms_area_new">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="contact_us">
							<h2 class="text-center" style="color:#fff;">Book Clubrooms</h2>
						<?php echo do_shortcode('[contact-form-7 id="471" title="club-rooms"]');?>
							
						</div>
					</div>
				</div>
			</div>
			
		</section>
<?php get_footer();?>