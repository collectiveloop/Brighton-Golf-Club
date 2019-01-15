<?php

/**

 * Initialize the meta boxes. 

 */

add_action( 'admin_init', '_custom_meta_boxes' );



/**

 * Meta Boxes demo code.

 *

 * You can find all the available option types

 * in demo-theme-options.php.

 *

 * @return    void

 *

 * @access    private

 * @since     2.0

 */

function _custom_meta_boxes() {

  $slider_meta_box = array(
    'id'          => 'slider_meta_box',
    'title'       => 'Sider Button Link/Text',
    'desc'        => '',
    'pages'       => array( 'slider' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
	  array(
        'label'       => 'Upload slider image for Mobile and Tablet',
        'id'          => 'tablate_mobile',
        'type'        => 'upload',
        'desc'        => 'Upload Image.'
      ),
	  array(
        'label'       => 'Button Text',
        'id'          => 'button_text',
        'type'        => 'text',
        'desc'        => 'Write the button text.'
      ),
	  array(
        'label'       => 'Button Link',
        'id'          => 'button_link',
        'type'        => 'text',
        'desc'        => 'Put the Button Link.'
      ),
	  array(
        'label'       => 'Button border and text color',
        'id'          => 'border_color',
        'type'        => 'Colorpicker',
        'std'        => '#ffffff',
        'desc'        => 'Choose the background color.'
      )
    )
  );
  ot_register_meta_box( $slider_meta_box ); 

  $promotion_meta_box = array(

    'id'          => 'promotion_meta_box',

    'title'       => 'Another Options',

    'desc'        => '',

    'pages'       => array( 'benefits-items' ),

    'context'     => 'normal',

    'priority'    => 'high',

    'fields'      => array(

	  array(

        'label'       => 'Give Numaric value order',

        'id'          => 'benefits_order',

        'type'        => 'text',

        'desc'        => 'Which Position it Will Be stay.'

      ),	
	  array(

        'label'       => 'Put the Target Link',

        'id'          => 'find_out_home_more',

        'type'        => 'text',

        'desc'        => 'Which Page Will be go please put the URL.'

      ),

	  array(

        'label'       => 'Upload Your Small Images',

        'id'          => 'small_images_banefit',

        'type'        => 'upload'

      )

    )

  );

  ot_register_meta_box( $promotion_meta_box ); 

  

  

  $special_meta_box = array(

    'id'          => 'special_meta_box',

    'title'       => 'special Custom Fileds',

    'desc'        => '',

    'pages'       => array( 'special-items' ),

    'context'     => 'normal',

    'priority'    => 'high',

    'fields'      => array(

	  array(

        'label'       => 'Give Numaric value order',

        'id'          => 'special_order',

        'type'        => 'text',

        'desc'        => 'Which Position it Will Be stay.'

      )

    )

  );

  ot_register_meta_box( $special_meta_box );  

  



  

  $membership_meta_box = array(

    'id'          => 'membership_meta_box',

    'title'       => 'Single Portfolio Position',

    'desc'        => '',

    'pages'       => array( 'benefits-membership' ),

    'context'     => 'normal',

    'priority'    => 'high',

    'fields'      => array(

	  array(

        'label'       => 'Give Numaric value order',

        'id'          => 'benefits_membership',

        'type'        => 'text',

        'desc'        => 'Which Position it Will Be stay.'

      ),
	  array(

        'label'       => 'Membership Title',

        'id'          => 'membership_title',

        'type'        => 'textarea',

        'desc'        => 'Every Membership title.'

      ),	 
	  array(

        'label'       => 'Membership Small Image',

        'id'          => 'small_images_membership',

        'type'        => 'upload',

        'desc'        => 'Membership Small Image.'

      ),	
	  array(

        'label'       => 'Membership Pro Date',

        'id'          => 'membership_date',

        'type'        => 'text',

        'desc'        => 'Membership Pro Date.'

      ),	
	  array(

        'label'       => 'Membership Join Fees',

        'id'          => 'membership_join_fees',

        'type'        => 'text',

        'desc'        => 'Membership Join fee.'

      ),	 
	  array(

        'label'       => 'Annual Fees',

        'id'          => 'membership_join_subs',

        'type'        => 'text',

        'desc'        => 'Membership Annual Fees.'

      ),	 
	  array(

        'label'       => 'Membership Bar Levy',

        'id'          => 'membership_join_Bar',

        'type'        => 'text',

        'desc'        => 'Membership Bar Levy.'

      ),	
	  array(

        'label'       => 'Membership Total',

        'id'          => 'membership_join_total',

        'type'        => 'text',

        'desc'        => 'Membership total.'

      ),

    )

  );   

  ot_register_meta_box( $membership_meta_box );  



  $benefits_membership_meta_box = array(

    'id'          => 'benefits_membership_meta_box',

    'title'       => 'Benefits Options',

    'desc'        => '',

    'pages'       => array( 'benefits-joining' ),

    'context'     => 'normal',

    'priority'    => 'high',

    'fields'      => array(

	  array(

        'label'       => 'Give Numaric value order',

        'id'          => 'benefits_joining',

        'type'        => 'text',

        'desc'        => 'Which Position it Will Be stay.'

      )

    )

  );   

  ot_register_meta_box( $benefits_membership_meta_box );  

    

    

  $membership_offers_meta_box = array(

    'id'          => 'membership_offers_meta_box',

    'title'       => 'Membership Offers',

    'desc'        => '',

    'pages'       => array( 'latest-offer' ),

    'context'     => 'normal',

    'priority'    => 'high',

    'fields'      => array(

	  array(

        'label'       => 'Give Numaric value order',

        'id'          => 'latest_offers',

        'type'        => 'text',

        'desc'        => 'Which Position it Will Be stay.'

      ),

     array(

        'label'       => 'Upload Small Image',
        'id'          => 'small_img_mem',
        'type'        => 'upload',
		'desc'        => 'Upload Small Image.'

      ),

     array(

        'label'       => 'Put the Target Link',
        'id'          => 'offers_terget_link',
        'type'        => 'text',
		'desc'        => 'Which Page Will be go please Put the URL.'

      )

    )

  );

  ot_register_meta_box( $membership_offers_meta_box );  

 

  

  
    $how_to_join_meta_box = array(

    'id'          => 'how_to_join_meta_box',

    'title'       => 'Solution Custom Fileds',

    'desc'        => '',

    'pages'       => array( 'member-joining-h' ),

    'context'     => 'normal',

    'priority'    => 'high',

    'fields'      => array(

	  array(

        'label'       => 'Give Numaric value order',

        'id'          => 'member_joining_h',

        'type'        => 'text',

        'desc'        => 'Which Position it Will Be stay.'

      ),	 

	  array(

        'label'       => 'Write 1,2,3,4 etc',

        'id'          => 'number_join',

        'type'        => 'text',

        'desc'        => 'Put Numaric text'

      )

    )

  );

  ot_register_meta_box( $how_to_join_meta_box );      
  
  $clubroom_features_meta_box = array(

    'id'          => 'clubroom_features_meta_box',

    'title'       => 'Solution Custom Fileds',

    'desc'        => '',

    'pages'       => array( 'clubroom-features' ),

    'context'     => 'normal',

    'priority'    => 'high',

    'fields'      => array(	 

	  array(

        'label'       => 'Give Numaric value order',

        'id'          => 'clubroom_features',

        'type'        => 'text',

        'desc'        => 'Which Position it Will Be stay.'

      )

    )

  );

  ot_register_meta_box( $clubroom_features_meta_box );    
  
  
  $clubroom_benfits_meta_box = array(

    'id'          => 'clubroom_benfits_meta_box',

    'title'       => 'Custom Fileds',

    'desc'        => '',

    'pages'       => array( 'clubroom-benfits' ),

    'context'     => 'normal',

    'priority'    => 'high',

    'fields'      => array(	 

	  array(

        'label'       => 'Give Numaric value order',

        'id'          => 'clubroom_benfits',

        'type'        => 'text',

        'desc'        => 'Which Position it Will Be stay.'

      )

    )

  );

  ot_register_meta_box( $clubroom_benfits_meta_box );   
  $clubroom_book_meta_box = array(

    'id'          => 'clubroom_book_meta_box',

    'title'       => 'Custom Fileds',

    'desc'        => '',

    'pages'       => array( 'clubroom-book' ),

    'context'     => 'normal',

    'priority'    => 'high',

    'fields'      => array(	 

	  array(

        'label'       => 'Give Numaric value order',

        'id'          => 'clubroom_book',

        'type'        => 'text',

        'desc'        => 'Which Position it Will Be stay.'

      ),
	  array(

        'label'       => 'Write 1,2,3,4 etc',

        'id'          => 'clubrooms_book_number',

        'type'        => 'text',

        'desc'        => 'Put Number.'

      )

    )

  );

  ot_register_meta_box( $clubroom_book_meta_box );   


  $news_page_meta_box = array(

    'id'          => 'news_page_meta_box',

    'title'       => 'Custom Fileds',

    'desc'        => '',

    'pages'       => array( 'post' ),

    'context'     => 'normal',

    'priority'    => 'high',

    'fields'      => array(	 
	
	

	  array(

        'label'       => 'Upload post small image',

        'id'          => 'latest_news_small_thum',

        'type'        => 'upload',

        'desc'        => 'Upload post small image.'

      ),
	  array(

        'label'       => 'Write the title',

        'id'          => 'latest_news_title',

        'type'        => 'textarea',

        'desc'        => 'Write the title.'

      ),
	  array(

        'label'       => 'Write the Button text',

        'id'          => 'click_to_read',

        'type'        => 'text',
        'std'        => 'Click to red',

        'desc'        => 'Write the button text.'
      ),
	  array(

        'label'       => 'Write the Button Link',

        'id'          => 'click_to_link',

        'type'        => 'text',

        'desc'        => 'Write the button Link.'
      )

    )

  );

  ot_register_meta_box( $news_page_meta_box );   



  ot_register_meta_box( $news_page_upcomming_event_meta_box );  
  
    $charity_page_meta_box = array(

    'id'          => 'charity_page_meta_box',

    'title'       => 'Custom Fileds',

    'desc'        => '',

    'pages'       => array( 'charity-support' ),

    'context'     => 'normal',

    'priority'    => 'high',

    'fields'      => array(	 
	
	  array(

        'label'       => 'Put the Donate URL',

        'id'          => 'donate_link',

        'type'        => 'text',

        'desc'        => 'Put the donate URL.'

      )

    )

  );

  ot_register_meta_box( $charity_page_meta_box );     


  $syllbus_page_meta_box = array(

    'id'          => 'syllbus_page_meta_box',

    'title'       => 'Custom Fileds',

    'desc'        => '',

    'pages'       => array( 'about-syllbus' ),

    'context'     => 'normal',

    'priority'    => 'high',

    'fields'      => array(	 
	
	  array(

        'label'       => 'Upload Small Image',

        'id'          => 'small_img_upload',

        'type'        => 'upload',

        'desc'        => 'Upload Small Image.'

      ),
	  array(

        'label'       => 'Year background Color',

        'id'          => 'year_color_picker',

        'type'        => 'ColorPicker',

        'desc'        => 'Background Color.'

      ),
	  array(

        'label'       => 'Put the Download URL',

        'id'          => 'download_link',

        'type'        => 'text',

        'desc'        => 'Put the download URL.'

      )

    )

  );

  ot_register_meta_box( $syllbus_page_meta_box );    
  
  
  $committee_page_meta_box = array(

    'id'          => 'committee_page_meta_box',

    'title'       => 'Custom Fileds',

    'desc'        => '',

    'pages'       => array( 'about-committee' ),

    'context'     => 'normal',

    'priority'    => 'high',

    'fields'      => array(	 
	
	 array(

        'label'       => 'Give Numaric value order',

        'id'          => 'about_committee',

        'type'        => 'text',

        'desc'        => 'Which Position it Will Be stay.'

      ),
	
	  array(

        'label'       => 'Write committe member name',

        'id'          => 'committe_name',

        'type'        => 'textarea',

        'desc'        => 'Write committe Member Name.'

      ),
	  array(

        'label'       => 'Write Contact Number',

        'id'          => 'contact_number',

        'type'        => 'text',

        'desc'        => 'Write Contact Number'

      ),
	  array(

        'label'       => 'Write Email Address',

        'id'          => 'email_address',

        'type'        => 'text',

        'desc'        => 'Write Email Address.'

      )

    )

  );

  ot_register_meta_box( $committee_page_meta_box );    
  
  
  $women_committee_page_meta_box = array(

    'id'          => 'women_committee_page_meta_box',

    'title'       => 'Custom Fileds',

    'desc'        => '',

    'pages'       => array( 'women-committee' ),

    'context'     => 'normal',

    'priority'    => 'high',

    'fields'      => array(	 
	
	 array(

        'label'       => 'Give Numaric value order',

        'id'          => 'women_committee',

        'type'        => 'text',

        'desc'        => 'Which Position it Will Be stay.'

      ),
	
	  array(

        'label'       => 'Write committe member name',

        'id'          => 'womens_name',

        'type'        => 'textarea',

        'desc'        => 'Write committe Member Name.'

      )

    )

  );

  ot_register_meta_box( $women_committee_page_meta_box );    
  
  
  $generous_partners_page_meta_box = array(

    'id'          => 'generous_partners_page_meta_box',

    'title'       => 'Custom Fileds',

    'desc'        => '',

    'pages'       => array( 'generous-partners' ),

    'context'     => 'normal',

    'priority'    => 'high',

    'fields'      => array(	 
	
	 array(

        'label'       => 'Give Numaric value order',

        'id'          => 'generous_partners',

        'type'        => 'text',

        'desc'        => 'Which Position it Will Be stay.'

      ),
	
	  array(

        'label'       => 'Write website link',

        'id'          => 'go_website_link',

        'type'        => 'text',

        'desc'        => 'Write website link.'

      )

    )

  );

  ot_register_meta_box( $generous_partners_page_meta_box );    
  
  
  $home_partners_page_meta_box = array(

    'id'          => 'home_partners_page_meta_box',

    'title'       => 'Custom Fileds',

    'desc'        => '',

    'pages'       => array( 'partners-area' ),

    'context'     => 'normal',

    'priority'    => 'high',

    'fields'      => array(	 
	
	  array(

        'label'       => 'Write website link',

        'id'          => 'partner_thum_link',

        'type'        => 'text',

        'desc'        => 'Write website link.'

      )

    )

  );

  ot_register_meta_box( $home_partners_page_meta_box );  
    

  
 $news_event_again_page_meta_box = array(

    'id'          => 'news_event_again_page_meta_box',

    'title'       => 'Custom Fileds',

    'desc'        => '',

    'pages'       => array( 'news-events' ),

    'context'     => 'normal',

    'priority'    => 'high',

    'fields'      => array(	 
	
	  array(

        'label'       => 'Event Small Image',

        'id'          => 'event_small_image_new',

        'type'        => 'upload',

        'desc'        => 'Write Event Small Image.'

      ),	 
	  array(

        'label'       => 'Event Date',

        'id'          => 'event_date',

        'type'        => 'text',

        'desc'        => 'Write Event Date.'

      ),	  
	  array(

        'label'       => 'Event Location',

        'id'          => 'event_loctaion',

        'type'        => 'text',

        'desc'        => 'Write Event Location.'

      ),	 
	  array(

        'label'       => 'Event Cost',

        'id'          => 'event_cost',

        'type'        => 'text',

        'desc'        => 'Write Event Cost.'

      ),	  
	  array(

        'label'       => 'Event Target Link',

        'id'          => 'event_to_link',

        'type'        => 'text',

        'desc'        => 'Write Target Link.'

      )

    )

  );

  ot_register_meta_box( $news_event_again_page_meta_box );  
  
    $latest_news_home_page_meta_box = array(

    'id'          => 'latest_news_home_page_meta_box',

    'title'       => 'Custom Fileds',

    'desc'        => '',

    'pages'       => array( 'home-latest-news' ),

    'context'     => 'normal',

    'priority'    => 'high',

    'fields'      => array(	 
	
	

	  array(

        'label'       => 'Upload post small image',

        'id'          => 'latest_news_small_thum',

        'type'        => 'upload',

        'desc'        => 'Upload post small image.'

      ),
	  array(

        'label'       => 'Write the Button text',

        'id'          => 'click_to_read',

        'type'        => 'text',
        'std'        => 'Click to red',

        'desc'        => 'Write the button text.'
      ),
	  array(

        'label'       => 'Write the Button Link',

        'id'          => 'click_to_link',

        'type'        => 'text',

        'desc'        => 'Write the button Link.'
      )

    )

  );

  ot_register_meta_box( $latest_news_home_page_meta_box );   

 $home_news_event_again_page_meta_box = array(

    'id'          => 'home_news_event_again_page_meta_box',

    'title'       => 'Custom Fileds',

    'desc'        => '',

    'pages'       => array( 'home-news-events' ),

    'context'     => 'normal',

    'priority'    => 'high',

    'fields'      => array(	 
	
	  array(

        'label'       => 'Event Small Image',

        'id'          => 'event_small_image_new',

        'type'        => 'upload',

        'desc'        => 'Write Event Small Image.'

      ),	 
	  array(

        'label'       => 'Event Date',

        'id'          => 'event_date',

        'type'        => 'text',

        'desc'        => 'Write Event Date.'

      ),	  
	  array(

        'label'       => 'Event Location',

        'id'          => 'event_loctaion',

        'type'        => 'text',

        'desc'        => 'Write Event Location.'

      ),	 
	  array(

        'label'       => 'Event Cost',

        'id'          => 'event_cost',

        'type'        => 'text',

        'desc'        => 'Write Event Cost.'

      ),	  
	  array(

        'label'       => 'Event Target Link',

        'id'          => 'event_to_link',

        'type'        => 'text',

        'desc'        => 'Write Target Link.'

      )

    )

  );

  ot_register_meta_box( $home_news_event_again_page_meta_box ); 
  

  



}