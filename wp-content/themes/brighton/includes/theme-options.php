<?php
/**
 * Initialize the custom Theme Options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 *
 * @return    void
 * @since     2.0
 */
function custom_theme_options() {
  
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( ot_settings_id(), array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'content'       => array( 
        array(
          'id'        => 'option_types_help',
          'title'     => __( 'Option Types', 'theme-text-domain' ),
          'content'   => '<p>' . __( 'Help content goes here!', 'theme-text-domain' ) . '</p>'
        )
      ),
      'sidebar'       => '<p>' . __( 'Sidebar content goes here!', 'theme-text-domain' ) . '</p>'
    ),
    'sections'        => array(
	  array(
        'title'       => 'Social Links & Phone & Email Number ',
        'id'          => 'social_links'
      ), 	 
        array(
        'title'       => 'Home Page',
        'id'          => 'featured_img'
      ),       
	  array(
        'title'       => 'Membership Page',
        'id'          => 'membership_page'
      ), 
	  array(
        'title'       => 'Clubrooms Page',
        'id'          => 'clubrooms_page'
      ), 	  
	  array(
        'title'       => 'News Page',
        'id'          => 'news_page'
      ), 
	  array(
        'title'       => 'About Us Page',
        'id'          => 'about_us_page'
      ),	 
	  array(
        'title'       => 'Contact Us Page',
        'id'          => 'contact_us_page'
      ),

    

    ),
    'settings'        => array(
		array(
        'label'       => 'Phone Number',
        'id'          => 'phone_hot',
        'type'        => 'text',
        'desc'        => 'Enter your Phone Number.',
        'std'        => '+000 000 1234',
        'section'     => 'social_links'
      ),		
	  array(
        'label'       => 'Email Address',
        'id'          => 'email_address',
        'type'        => 'text',
        'desc'        => 'Enter your Phone Number.',
        'std'        => 'help@2f-design.fr',
        'section'     => 'social_links'
      ),	 
	  array(
        'label'       => 'Member Login URL',
        'id'          => 'member_login',
        'type'        => 'text',
        'desc'        => 'Enter your Member Login Page URL.',
        'section'     => 'social_links'
      ),	 
	  array(
        'label'       => 'Footer Address Contact Us',
        'id'          => 'company_address',
        'type'        => 'textarea',
        'section'     => 'social_links'
      ),
      array(
        'label'       => 'Facebook Link',
        'id'          => 'facebook',
        'type'        => 'text',
        'desc'        => 'Enter your facebook URL.',
        'std'        => 'http://www.facebook.com',
        'section'     => 'social_links'
      ),
      array(
        'label'       => 'Twitter Link',
        'id'          => 'twitter',
        'type'        => 'text',
        'desc'        => 'Enter your twitter URL.',
        'std'        => 'http://www.twitter.com',
        'section'     => 'social_links'
      ),
	  array(
        'label'       => 'Google Plus Link',
        'id'          => 'google_plus',
        'type'        => 'text',
        'desc'        => 'Enter your Google plus URL.',
        'std'        => 'https://plus.google.com/',
        'section'     => 'social_links'
      ),	 
	  array(
        'label'       => 'Flickr Link',
        'id'          => 'flicker',
        'type'        => 'text',
        'desc'        => 'Enter your Flicker URL.',
        'std'        => 'https://www.flickr.com/',
        'section'     => 'social_links'
      ),	 
	  array(
        'label'       => 'RSS Link',
        'id'          => 'rss',
        'type'        => 'text',
        'desc'        => 'Enter your RSS URL.',
        'section'     => 'social_links'
      ),	 
	 	  array(
        'label'       => 'Upload Your Home Page Featured Image',
        'id'          => 'fetured_img_home',
        'type'        => 'upload',
        'desc'        => 'Upload You Featured Image',
        'section'     => 'featured_img'
      ),
	  array(
        'label'       => 'Book Now Link',
        'id'          => 'book_a_tee_link',
        'type'        => 'text',
        'desc'        => 'Enter your Book Now Page URL.',
        'section'     => 'featured_img'
      ),	
	  array(
        'label'       => 'Brighton Golf Club special Find Out More Link',
        'id'          => 'golf_special_link',
        'type'        => 'text',
        'desc'        => 'Enter your Golf Club special Find Out More Link.',
        'section'     => 'featured_img'
      ),	
	  array(
        'label'       => 'Upload Your Membership Page Featured Image',
        'id'          => 'fetured_img_membership',
        'type'        => 'upload',
        'desc'        => 'Enter your Golf Club special Find Out More Link.',
        'section'     => 'membership_page'
      ),	 
	  array(
        'label'       => 'Click To apply Link Every Membership Options',
        'id'          => 'membership_options_apply_link',
        'type'        => 'text',
        'desc'        => 'Put The Link.',
        'section'     => 'membership_page'
      ),
	 	array(
        'label'       => 'Upload Your Clubrooms Page Featured Image',
        'id'          => 'fetured_img_clubrooms',
        'type'        => 'upload',
        'desc'        => 'Upload Your Featured Image',
        'section'     => 'clubrooms_page'
      ),	 	
	  array(
        'label'       => 'Corporate Events Text',
        'id'          => 'clubrooms_book_page_member_login',
        'type'        => 'textarea',
        'desc'        => 'Put the Corporate Events Text',
        'section'     => 'clubrooms_page'
      ),	  
	  array(
        'label'       => 'Clubrooms Page Member Login Area Click to book button URL',
        'id'          => 'clubrooms_book_page',
        'type'        => 'text',
        'desc'        => 'Put the click to book URL',
        'section'     => 'clubrooms_page'
      ),
	  array(
        'label'       => 'Upload Your News Page Featured Image',
        'id'          => 'fetured_img_news',
        'type'        => 'upload',
        'desc'        => 'Upload Your Featured Image',
        'section'     => 'news_page'
      ),	  
	  array(
        'label'       => 'Put Booking Link',
        'id'          => 'news_upcomming_click',
        'type'        => 'text',
        'desc'        => 'Put Booking Link',
        'section'     => 'news_page'
      ),
	  array(
        'label'       => 'Upload Your About Us Page Featured Image',
        'id'          => 'fetured_img_about_us',
        'type'        => 'upload',
        'desc'        => 'Upload Your Featured Image',
        'section'     => 'about_us_page'
      ),	 
	  array(
        'label'       => 'Upload Your contact us Page Featured Image',
        'id'          => 'fetured_img_contact_page',
        'type'        => 'upload',
        'desc'        => 'Upload Your Featured Image',
        'section'     => 'contact_us_page'
      ),
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings ); 
  }
  
}