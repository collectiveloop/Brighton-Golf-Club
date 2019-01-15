<?php
add_theme_support( 'post-formats', array( 'image', 'video', 'audio', 'gallery' ) );
// Thumbanils Enable
add_theme_support( 'post-thumbnails', array('post','benefits-items','special-items','member-login','partners-area','benefits-membership','benefits-joining','latest-offer','clubroom-features','clubroom-benfits','charity-support','about-syllbus','about-committee','generous-partners','news-events','blogs-post','home-latest-news','home-news-events','slider') );
add_image_size( 'news-thumb', 325, 218, true );
add_image_size( 'benefits-thumb', 360, 240, true );
add_image_size( 'post', 360, 240, true );
add_image_size( 'post-blog-thumb', 360, 240, true );
add_image_size( 'latest-thumb', 360, 240, true );
add_image_size( 'clubroom-thumb', 400, 270, true );
add_image_size( 'syllbus-thumb', 322, 215, true );
add_image_size( 'partner-thumb', 200, 200, true );
	function create_post_type() {
		register_post_type( 'slider',
			array(
				'labels' => array(
						'name' => __( 'Slider' ),
						'singular_name' => __( 'Slide' ),
						'add_new' => __( 'Add New Slide' ),
						'add_new_item' => __( 'Add New Slide' ),
						'edit_item' => __( 'Edit Slide' ),
						'new_item' => __( 'New Slide' ),
						'view_item' => __( 'View Slide' ),
						'not_found' => __( 'Sorry, we couldn\'t find the Slide you are looking for.' )
				),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'menu_position' => 14,
			'has_archive' => true,
			'show_ui' => true,
			'hierarchical' => true,
			'capability_type' => 'post',
			'rewrite' => array( 'slug' => 'slide' ),
			'supports' => array( 'title', 'editor', 'thumbnail' )
			)
		);

		register_post_type( 'benefits-items',
			array(
				'labels' => array(
						'name' => __( 'Home Benefits' ),
						'singular_name' => __( 'Benefits' ),
						'add_new' => __( 'Add New Benefits' ),
						'add_new_item' => __( 'Add New Benefits' ),
						'edit_item' => __( 'Edit Benefits' ),
						'new_item' => __( 'New Benefits' ),
						'view_item' => __( 'View Benefits' ),
						'not_found' => __( 'Sorry, we couldn\'t find the Benefits you are looking for.' )
				),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'menu_position' => 100,
			'has_archive' => true,
			'show_ui' => true,
			'hierarchical' => true,
			'capability_type' => 'post',
			'rewrite' => array( 'slug' => 'benefits' ),
			'supports' => array( 'title','thumbnail','excerpt','editor','custom-fields' )
			)
		);
		register_post_type( 'news-events',
			array(
				'labels' => array(
						'name' => __( 'Events' ),
						'singular_name' => __( 'Event' ),
						'add_new' => __( 'Add New Event' ),
						'add_new_item' => __( 'Add New Event' ),
						'edit_item' => __( 'Edit Event' ),
						'new_item' => __( 'New Event' ),
						'view_item' => __( 'View Event' ),
						'not_found' => __( 'Sorry, we couldn\'t find the Event you are looking for.' )
				),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'menu_position' => 100,
			'has_archive' => true,
			'show_ui' => true,
			'hierarchical' => true,
			'capability_type' => 'post',
			'rewrite' => array( 'slug' => 'Event' ),
			'supports' => array( 'title','thumbnail','editor','custom-fields' )
			)
		);
			
		register_post_type( 'special-items',
			array(
				'labels' => array(
						'name' => __( 'Home Golf special' ),
						'singular_name' => __( 'Golf special' ),
						'add_new' => __( 'Add New special' ),
						'add_new_item' => __( 'Add New special' ),
						'edit_item' => __( 'Edit special' ),
						'new_item' => __( 'New special' ),
						'view_item' => __( 'View special' ),
						'not_found' => __( 'Sorry, we couldn\'t find the special you are looking for.' )
				),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'menu_position' => 100,
			'has_archive' => true,
			'show_ui' => true,
			'hierarchical' => true,
			'capability_type' => 'post',
			'rewrite' => array( 'slug' => 'special' ),
			'supports' => array( 'title','thumbnail','editor','custom-fields')
			)
		);			
		register_post_type( 'member-login',
			array(
				'labels' => array(
						'name' => __( 'Home Member Login' ),
						'singular_name' => __( 'Member Login' ),
						'add_new' => __( 'Add New Member' ),
						'add_new_item' => __( 'Add New Member' ),
						'edit_item' => __( 'Edit Member' ),
						'new_item' => __( 'New Member' ),
						'view_item' => __( 'View Member' ),
						'not_found' => __( 'Sorry, we couldn\'t find the Member you are looking for.' )
				),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'menu_position' => 100,
			'has_archive' => true,
			'show_ui' => true,
			'hierarchical' => true,
			'capability_type' => 'post',
			'rewrite' => array( 'slug' => 'Member' ),
			'supports' => array( 'title','thumbnail','editor')
			)
		);			
		
		register_post_type( 'benefits-membership',
			array(
				'labels' => array(
						'name' => __( 'Membership Options' ),
						'singular_name' => __( 'Options' ),
						'add_new' => __( 'Add New Options' ),
						'add_new_item' => __( 'Add New Options' ),
						'edit_item' => __( 'Edit Options' ),
						'new_item' => __( 'New Options' ),
						'view_item' => __( 'View Options' ),
						'not_found' => __( 'Sorry, we couldn\'t find the Options you are looking for.' )
				),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'menu_position' => 100,
			'has_archive' => true,
			'show_ui' => true,
			'hierarchical' => true,
			'capability_type' => 'post',
			'rewrite' => array( 'slug' => 'Options' ),
			'supports' => array( 'title','thumbnail','editor','custom-fields' )
			)
		);		
		register_post_type( 'benefits-joining',
			array(
				'labels' => array(
						'name' => __( 'Benfits joining' ),
						'singular_name' => __( 'joining' ),
						'add_new' => __( 'Add New joining' ),
						'add_new_item' => __( 'Add New joining' ),
						'edit_item' => __( 'Edit joining' ),
						'new_item' => __( 'New joining' ),
						'view_item' => __( 'View joining' ),
						'not_found' => __( 'Sorry, we couldn\'t find the joining you are looking for.' )
				),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'menu_position' => 100,
			'has_archive' => true,
			'show_ui' => true,
			'hierarchical' => true,
			'capability_type' => 'post',
			'rewrite' => array( 'slug' => 'joining' ),
			'supports' => array( 'title','thumbnail','editor','custom-fields' )
			)
		);		
		register_post_type( 'latest-offer',
			array(
				'labels' => array(
						'name' => __( 'membership Offers' ),
						'singular_name' => __( 'Offer' ),
						'add_new' => __( 'Add New Offer' ),
						'add_new_item' => __( 'Add New Offer' ),
						'edit_item' => __( 'Edit Offer' ),
						'new_item' => __( 'New Offer' ),
						'view_item' => __( 'View Offer' ),
						'not_found' => __( 'Sorry, we couldn\'t find the Offer you are looking for.' )
				),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'menu_position' => 100,
			'has_archive' => true,
			'show_ui' => true,
			'hierarchical' => true,
			'capability_type' => 'post',
			'rewrite' => array( 'slug' => 'offer' ),
			'supports' => array( 'title','thumbnail','excerpt','editor','custom-fields' )
			)
		);	
		register_post_type( 'member-joining-h',
			array(
				'labels' => array(
						'name' => __( 'Membership Join' ),
						'singular_name' => __( 'Join' ),
						'add_new' => __( 'Add New Join' ),
						'add_new_item' => __( 'Add New Join' ),
						'edit_item' => __( 'Edit Join' ),
						'new_item' => __( 'New Join' ),
						'view_item' => __( 'View Join' ),
						'not_found' => __( 'Sorry, we couldn\'t find the Join you are looking for.' )
				),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'menu_position' => 100,
			'has_archive' => true,
			'show_ui' => true,
			'hierarchical' => true,
			'capability_type' => 'post',
			'rewrite' => array( 'slug' => 'join' ),
			'supports' => array( 'title','editor','custom-fields' )
			)
		);		
		register_post_type( 'clubroom-features',
			array(
				'labels' => array(
						'name' => __( 'Clubroom features' ),
						'singular_name' => __( 'Features' ),
						'add_new' => __( 'Add New Features' ),
						'add_new_item' => __( 'Add New Features' ),
						'edit_item' => __( 'Edit Features' ),
						'new_item' => __( 'New Features' ),
						'view_item' => __( 'View Features' ),
						'not_found' => __( 'Sorry, we couldn\'t find the Features you are looking for.' )
				),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'menu_position' => 100,
			'has_archive' => true,
			'show_ui' => true,
			'hierarchical' => true,
			'capability_type' => 'post',
			'rewrite' => false,
			'supports' => array( 'title','editor','custom-fields','thumbnail' )
			)
		);		
		register_post_type( 'clubroom-benfits',
			array(
				'labels' => array(
						'name' => __( 'Clubroom Benfits'),
						'singular_name' => __( 'Benfits'),
						'add_new' => __( 'Add New Benfits'),
						'add_new_item' => __( 'Add New Benfits' ),
						'edit_item' => __( 'Edit Benfits'),
						'new_item' => __( 'New Benfits' ),
						'view_item' => __( 'View Benfits'),
						'not_found' => __( 'Sorry, we couldn\'t find the Benfits  you are looking for.' )
				),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'menu_position' => 100,
			'has_archive' => true,
			'show_ui' => true,
			'hierarchical' => true,
			'capability_type' => 'post',
			'rewrite' => false,
			'supports' => array( 'title','editor','thumbnail','custom-fields' )
			)
		);		
		register_post_type( 'clubroom-book',
			array(
				'labels' => array(
						'name' => __( 'Clubroom Book'),
						'singular_name' => __( 'Book'),
						'add_new' => __( 'Add New Book'),
						'add_new_item' => __( 'Add New Book' ),
						'edit_item' => __( 'Edit Book'),
						'new_item' => __( 'New Book' ),
						'view_item' => __( 'View Book'),
						'not_found' => __( 'Sorry, we couldn\'t find the Book  you are looking for.' )
				),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'menu_position' => 100,
			'has_archive' => true,
			'show_ui' => true,
			'hierarchical' => true,
			'capability_type' => 'post',
			'rewrite' => false,
			'supports' => array( 'title','editor','thumbnail','custom-fields' )
			)
		);		
	
		register_post_type( 'charity-support',
			array(
				'labels' => array(
						'name' => __( 'About Charity Support'),
						'singular_name' => __( 'Support'),
						'add_new' => __( 'Add New Support'),
						'add_new_item' => __( 'Add New Support' ),
						'edit_item' => __( 'Edit Support'),
						'new_item' => __( 'New Support' ),
						'view_item' => __( 'View Support'),
						'not_found' => __( 'Sorry, we couldn\'t find the Support  you are looking for.' )
				),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'menu_position' => 100,
			'has_archive' => true,
			'show_ui' => true,
			'hierarchical' => true,
			'capability_type' => 'post',
			'rewrite' => false,
			'supports' => array( 'title','editor','thumbnail','custom-fields' )
			)
		);		
		register_post_type( 'about-syllbus',
			array(
				'labels' => array(
						'name' => __( 'About Syllbus'),
						'singular_name' => __( 'Syllbus'),
						'add_new' => __( 'Add New Syllbus'),
						'add_new_item' => __( 'Add New Syllbus' ),
						'edit_item' => __( 'Edit Syllbus'),
						'new_item' => __( 'New Syllbus' ),
						'view_item' => __( 'View Syllbus'),
						'not_found' => __( 'Sorry, we couldn\'t find the Syllbus  you are looking for.' )
				),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'menu_position' => 100,
			'has_archive' => true,
			'show_ui' => true,
			'hierarchical' => true,
			'capability_type' => 'post',
			'rewrite' => false,
			'supports' => array( 'title','editor','thumbnail','custom-fields' )
			)
		);		
		register_post_type( 'about-committee',
			array(
				'labels' => array(
						'name' => __( 'About Committee'),
						'singular_name' => __( 'Committee'),
						'add_new' => __( 'Add New Committee'),
						'add_new_item' => __( 'Add New Committee' ),
						'edit_item' => __( 'Edit Committee'),
						'new_item' => __( 'New Committee' ),
						'view_item' => __( 'View Committee'),
						'not_found' => __( 'Sorry, we couldn\'t find the Committee  you are looking for.' )
				),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'menu_position' => 100,
			'has_archive' => true,
			'show_ui' => true,
			'hierarchical' => true,
			'capability_type' => 'post',
			'rewrite' => false,
			'supports' => array( 'title','editor','thumbnail','custom-fields' )
			)
		);		
		register_post_type( 'women-committee',
			array(
				'labels' => array(
						'name' => __( 'Committee Another'),
						'singular_name' => __( 'Committee'),
						'add_new' => __( 'Add New Committee'),
						'add_new_item' => __( 'Add New Committee' ),
						'edit_item' => __( 'Edit Committee'),
						'new_item' => __( 'New Committee' ),
						'view_item' => __( 'View Committee'),
						'not_found' => __( 'Sorry, we couldn\'t find the Committee  you are looking for.' )
				),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'menu_position' => 100,
			'has_archive' => true,
			'show_ui' => true,
			'hierarchical' => true,
			'capability_type' => 'post',
			'rewrite' => false,
			'supports' => array( 'title','editor','thumbnail','custom-fields' )
			)
		);		
		register_post_type( 'generous-partners',
			array(
				'labels' => array(
						'name' => __( 'Generous Partners'),
						'singular_name' => __( 'Partners'),
						'add_new' => __( 'Add New Partners'),
						'add_new_item' => __( 'Add New Partners' ),
						'edit_item' => __( 'Edit Partners'),
						'new_item' => __( 'New Partners' ),
						'view_item' => __( 'View Partners'),
						'not_found' => __( 'Sorry, we couldn\'t find the Partners  you are looking for.' )
				),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'menu_position' => 100,
			'has_archive' => true,
			'show_ui' => true,
			'hierarchical' => true,
			'capability_type' => 'post',
			'rewrite' => false,
			'supports' => array( 'title','editor','thumbnail','custom-fields' )
			)
		);
		register_post_type( 'blogs-post',
			array(
				'labels' => array(
						'name' => __( 'Blog Post'),
						'singular_name' => __( 'Blog Posts'),
						'add_new' => __( 'Add New Post'),
						'add_new_item' => __( 'Add New Post' ),
						'edit_item' => __( 'Edit Post'),
						'new_item' => __( 'New Post' ),
						'view_item' => __( 'View Post'),
						'not_found' => __( 'Sorry, we couldn\'t find the Post  you are looking for.' )
				),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'menu_position' => 100,
			'has_archive' => true,
			'show_ui' => true,
			'hierarchical' => true,
			'capability_type' => 'post',
			'rewrite' => false,
			'supports' => array( 'title','editor','thumbnail','custom-fields','excerpt','comments' )
			)
		);
		register_post_type( 'home-latest-news',
			array(
				'labels' => array(
						'name' => __( 'Home Latest News'),
						'singular_name' => __( 'Latest Posts'),
						'add_new' => __( 'Add New Post'),
						'add_new_item' => __( 'Add New Post' ),
						'edit_item' => __( 'Edit Post'),
						'new_item' => __( 'New Post' ),
						'view_item' => __( 'View Post'),
						'not_found' => __( 'Sorry, we couldn\'t find the Post  you are looking for.' )
				),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'menu_position' => 100,
			'has_archive' => true,
			'show_ui' => true,
			'hierarchical' => true,
			'capability_type' => 'post',
			'rewrite' => false,
			'supports' => array( 'title','editor','thumbnail','custom-fields' )
			)
		);	
		
		register_post_type( 'home-news-events',
			array(
				'labels' => array(
						'name' => __( 'Home Events' ),
						'singular_name' => __( 'Home Event' ),
						'add_new' => __( 'Add New Event' ),
						'add_new_item' => __( 'Add New Event' ),
						'edit_item' => __( 'Edit Event' ),
						'new_item' => __( 'New Event' ),
						'view_item' => __( 'View Event' ),
						'not_found' => __( 'Sorry, we couldn\'t find the Event you are looking for.' )
				),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'menu_position' => 100,
			'has_archive' => true,
			'show_ui' => true,
			'hierarchical' => true,
			'capability_type' => 'post',
			'rewrite' => array( 'slug' => 'n' ),
			'supports' => array( 'title','thumbnail','editor','custom-fields' )
			)
		);	


	
}

add_action( 'init', 'create_post_type' );



function pages_taxonomy() {  	
    register_taxonomy(
		'partner_cat',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'generous-partners',                  //post type name
		array(
			'hierarchical'          => true,
			'label'                         => 'Partners Category',  //Display name
			'query_var'             => true,
			'rewrite'                       => array(
				'slug'                  => 'Partners-category', // This controls the base slug that will display before each term
				'with_front'    => true // Don't display the category base before
				)
			)
	);    
	
	register_taxonomy(
		'Post Category',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'blogs-post',                  //post type name
		array(
			'hierarchical'          => true,
			'label'                         => 'Post Category',  //Display name
			'query_var'             => true,
			'rewrite'                       => array(
				'slug'                  => 'Post-category', // This controls the base slug that will display before each term
				'with_front'    => true // Don't display the category base before
				)
			)
	);      
}
add_action( 'init', 'pages_taxonomy'); 







?>