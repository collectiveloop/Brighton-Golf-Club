<?php
//CONTACT WIDGET
class tee_class_contact_widget extends WP_widget
{

	function tee_class_contact_widget()
	{
            $options = array(
                                    "classname" => "class_contact_widget",
                                    "description" => "Use the informations set in the Options panel."
                                    );
            parent::WP_Widget( false, $name='Contact Informations', $options);
        }

	function widget($arguments, $data)
	{
                $defaut = array("title" => "Contact Informations");
                $data = wp_parse_args($data, $defaut);

                global $wpdb;
                $table_prefix = $wpdb->prefix;

                extract($arguments);

                echo $before_widget;
                echo '<h3>' . $data['title'] . '</h3>';
                echo '<ul>';
			  	if (get_option('tee_address') != ""){ 
		  			echo'<li class="list-home">'. get_option('tee_address') .'</li>';
		  		}
			  	if (get_option('tee_phone') != ""){ 
		  			echo'<li class="list-phone">'. get_option('tee_phone') .'</li>';
		  		}
			  	echo '</ul>';
	  			if(get_option('tee_social_window') == "true"){
		  			$target = 'target="_blank"';
	  			}
	  			else{
		  			$target = '';
	  			}
			  	echo '<ul class="social-list list-unstyled">';
				  	if (get_option('tee_facebook') != ""){ 
			  			echo' <li><a href="'. get_option('tee_facebook') .'" '. $target .' title="Join us on Facebook" class="facebook-link"><span class="icon-facebook"></span></a></li>';
			  		}
				  	if (get_option('tee_twitter') != ""){ 
			  			echo' <li><a href="'. get_option('tee_twitter') .'" '. $target .' title="Join us on Twitter" class="twitter-link"><span class="icon-twitter"></span></a></li>';
			  		}
				  	if (get_option('tee_vimeo') != ""){ 
			  			echo' <li><a href="'. get_option('tee_vimeo') .'" '. $target .' title="Join us on Vimeo" class="vimeo-link"><span class="icon-vimeo"></span></a></li>';
			  		}
				  	if (get_option('tee_googleplus') != ""){ 
			  			echo' <li><a href="'. get_option('tee_googleplus') .'" '. $target .' title="Join us on Google Plus" class="googleplus-link"><span class="icon-googleplus"></span></a>
			  			</li>';
			  		}
			  		if (get_option('tee_flickr') != ""){ 
			  			echo' <li><a href="'. get_option('tee_flickr') .'" '. $target .' title="Join us on Flickr" class="flickr-link"><span class="icon-flickr"></span></a></li>';
			  		}
			  		if (get_option('tee_pinterest') != ""){ 
			  			echo' <li><a href="'. get_option('tee_pinterest') .'" '. $target .' title="Join us on Pinterest" class="pinterest-link"><span class="icon-pinterest"></span></a>
			  			</li>';
			  		}
			  		if (get_option('tee_tumblr') != ""){ 
			  			echo' <li><a href="'. get_option('tee_tumblr') .'" '. $target .' title="Join us on Tumblr" class="tumblr-link"><span class="icon-tumblr"></span></a></li>';
			  		}
			  		if (get_option('tee_instagram') != ""){ 
			  			echo' <li><a href="'. get_option('tee_instagram') .'" '. $target .' title="Join us on Instagram" class="instagram-link"><span class="icon-instagram"></span></a>
			  			</li>';
			  		}
			  		if (get_option('tee_linkedin') != ""){ 
			  			echo' <li><a href="'. get_option('tee_linkedin') .'" '. $target .' title="Join us on Linkedin" class="linkedin-link"><span class="icon-linkedin"></span></a></li>';
			  		}
			  		if (get_option('tee_rss') != ""){ 
			  			echo'<li><a href="'. get_option('tee_rss') .'" '. $target .' title="Subscribe to our RSS feed" class="rss-link"><span class="icon-rss"></span></a>
                    	</li>';
			  		}
                echo '</ul>';
				echo $after_widget;
        }
	

	function update($content_new, $content_old)
	{
                $content_new['title'] = esc_attr($content_new['title']);
                return $content_new;
        }

	function form($data)
        {
                $defaut = array( "title" => "Get In Touch" );
                $data = wp_parse_args($data, $defaut);

                global $wpdb;
                $table_prefix = $wpdb->prefix;
                ?>
                    <p>
                    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title :','tee'); ?></label><br />
                    <input value="<?php echo $data['title']; ?>" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" type="text" />
                    </p>
                <?php
                        
        }
} 
function tee_contact_widget()
{
	register_widget("tee_class_contact_widget");
}
add_action("widgets_init", "tee_contact_widget");


//EVENT WIDGET
class tee_class_event_widget extends WP_widget
{

	function tee_class_event_widget()
	{
            $options = array(
                                    "classname" => "class_event_widget",
                                    "description" => "Display the 4 last events."
                                    );
            parent::WP_Widget( false, $name='Events', $options);
         }

	function widget($arguments, $data)
	{
                $defaut = array("title" => "Events");
                $data = wp_parse_args($data, $defaut);

                global $wpdb;
                $table_prefix = $wpdb->prefix;

                extract($arguments);

                echo $before_widget;
                echo '<h3>' . $data['title'] . '</h3>';
                ?>
                <ul class="events">
                	<?php 
					$custom_posts = new WP_Query();
					$custom_posts->query('post_type=events&posts_per_page=-1&showposts=4');
					while ($custom_posts->have_posts()) : $custom_posts->the_post();
					?>
						<li><a href="<?php the_permalink() ?>"><?php the_title() ?></a>
						<?php if( get_post_meta( get_the_ID(), 'tee_event_datetime', true ) != ""){ ?>
							<span>(<?php echo get_post_meta( get_the_ID(), 'tee_event_datetime', true ); ?>)</span></li>
						<?php } ?>
					<?php 
					endwhile;
					wp_reset_postdata();
					?>
			  	</ul>
			  	<?php
				echo $after_widget;
        }
	

	function update($content_new, $content_old)
	{
                $content_new['title'] = esc_attr($content_new['title']);
                return $content_new;
        }

	function form($data)
        {
                $defaut = array( "title" => "Latest Events" );
                $data = wp_parse_args($data, $defaut);

                global $wpdb;
                $table_prefix = $wpdb->prefix;
                ?>
                    <p>
                    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title :','tee'); ?></label><br />
                    <input value="<?php echo $data['title']; ?>" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" type="text" />
                    </p>
                <?php
                        
        }
} 
function tee_event_widget()
{
	register_widget("tee_class_event_widget");
}
add_action("widgets_init", "tee_event_widget");