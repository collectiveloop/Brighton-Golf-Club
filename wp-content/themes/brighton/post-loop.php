					<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
					<div class="col-sm-4">

						<div class="single_benefits">
							<?php the_post_thumbnail('post-thumb', array('class' => 'alignnone')); ?>
							<div class="befits_promo_content">
								<div class="befits_promo_content_img text-center">
									
									<h2><?php the_title();?></h2>
								</div>
								<div class="find_more">
								<?php the_excerpt();?>
								</div>
								<a href="<?php the_permalink();?>" class="btn btn-default">Find out more</a>
								
								
							</div>
						</div>
						
					</div>	
	            	<?php endwhile; ?>
					<?php else : ?>
						<h2>Post not found!</h2>
					<?php endif; ?>	
					<div style="clear:both"></div>
					 <div id="paged_s">
							<?php kriesi_pagination();?>
						</div>	