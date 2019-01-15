<?php
/**
 * METABOXES
*/
// Re-define meta box path and URL
define( 'RWMB_URL', trailingslashit( get_stylesheet_directory_uri() . '/inc/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/inc/meta-box' ) );
// Include the meta box script
require_once RWMB_DIR . 'meta-box.php';

add_action( 'admin_init', 'tee_register_meta_boxes' );
function tee_register_meta_boxes()
{
    if ( !class_exists( 'RW_Meta_Box' ) )
    return;
    $prefix = 'tee_';
    $meta_boxes = array();
    //EVENT PAGE CUSTOM FIELDS
    $meta_boxes[] = array(
        'title'    => 'Event Options',
        'pages'    => array('events'),
        'fields' => array(
            array(
                'name' => 'Event Date',
                'desc' => 'Select the event date & time.',
                'id'   => $prefix . 'event_datetime',
                'type' => 'Datetime',
            ),
            array(
                'name' => 'Event Date end (optional)',
                'desc' => 'Select the end of your event.',
                'id'   => $prefix . 'event_datetime_end',
                'type' => 'Datetime',
            ),
            array(
                'name' => "Event Address",
                'id'   => $prefix . 'event_address',
                'desc' => 'i.e : 2301 Alton Road, Miami Beach, FL 33140 ',
                'type' => 'text',
            ),
            array(
                'name' => "Event Location",
                'id'   => $prefix . 'event_location',
                'desc' => 'i.e: Golf Club ',
                'type' => 'text',
            ),
            array(
                'name' => "Event GPS coordinates",
                'id'   => $prefix . 'event_gps',
                'desc' => 'Used for the map, i.e : -86.670021,133.593750 -> <a href="http://itouchmap.com/latlong.html">Find them here</a>.',
                'type' => 'text',
            ),
            array(
                'name' => "Sign Up, external link",
                'id'   => $prefix . 'event_external',
                'desc' => 'If there is another page about this event.',
                'type' => 'text',
            ),
            array(
                'name' => "Enable subscriptions on the website ?",
                'id'   => $prefix . 'event_subscribe',
                'desc' => 'User will be allowed to register to the event via a form in the website, and you will receive the data on the email set below.',
                'type' => 'checkbox',
            ),
            array(
                'name' => "Email for the subscribe form, external link",
                'id'   => $prefix . 'event_subscribe_email',
                'desc' => 'All the data from the form will be received on this email.',
                'type' => 'text',
            ),
            array(
                'name' => "Is the event private ?",
                'id'   => $prefix . 'event_private',
                'desc' => 'Will be displayed only for logged users.',
                'type' => 'checkbox',
            ),
            array(
                'name' => "Hide the event when the date is gone ?",
                'id'   => $prefix . 'event_hide',
                'desc' => 'Single page will be still present nothing will be deleted.',
                'type' => 'checkbox',
                'std' => 'true'
            )
        )
    );
    //COURSES PAGE CUSTOM FIELDS
    $meta_boxes[] = array(
        'title'    => 'Course Options',
        'pages'    => array('courses'),
        'fields' => array(
            array(
                'name' => 'Course Date (IF it is NOT recurrent)',
                'desc' => 'Select the course date & time.',
                'id'   => $prefix . 'course_date',
                'type' => 'Datetime',
            ),
            array(
                'name' => "Course Date (IF IT IS RECURRENT)",
                'id'   => $prefix . 'course_reccurent',
                'desc' => 'i.e : Every wednesday at 4 p.m ',
                'type' => 'text',
            ),
            array(
                'name' => "Course Rendezvous",
                'id'   => $prefix . 'course_rendezvous',
                'desc' => 'i.e : Clubhouse',
                'type' => 'text',
            ),
            array(
                'name' => "Course Professor",
                'id'   => $prefix . 'course_professor',
                'desc' => 'i.e: John Doe ',
                'type' => 'text',
            ),
            array(
                'name' => "Course contact link",
                'id'   => $prefix . 'course_contact',
                'desc' => 'An URL or something like "mailto:professor-email@something.com".',
                'type' => 'text',
            ),
            array(
                'name' => "Course price",
                'id'   => $prefix . 'course_price',
                'desc' => 'i.e: 25$',
                'type' => 'text',
            ),
            array(
                'name' => "Per hour ?",
                'id'   => $prefix . 'course_per',
                'desc' => 'Is the price per hour ?',
                'type' => 'checkbox',
            ),
            array(
                'name' => "Places available",
                'id'   => $prefix . 'course_places',
                'desc' => 'i.e: 45 Places',
                'type' => 'text',
            ),
            array(
                'name' => "Enable subscriptions on the website ?",
                'id'   => $prefix . 'course_subscribe',
                'desc' => 'User will be allowed to register to the event via a form in the website, and you will receive the data on the email set below.',
                'type' => 'checkbox',
            ),
            array(
                'name' => "Email for the subscribe form",
                'id'   => $prefix . 'course_subscribe_email',
                'desc' => 'All the data from the form will be received on this email.',
                'type' => 'text',
            )
        )
    );
    //STAFF CUSTOM FIELDS
    $meta_boxes[] = array(
        'title'    => 'Staff Member Options',
        'pages'    => array('staff'),
        'fields' => array(
            array(
                'name' => "Job",
                'id'   => $prefix . 'staff_job',
                'desc' => 'i.e : Manager ',
                'type' => 'text',
            ),
            array(
                'name' => "Email",
                'id'   => $prefix . 'staff_email',
                'desc' => 'i.e : email@email.com ',
                'type' => 'text',
            ),
        )
    );
    $meta_boxes[] = array(
        'title'    => 'Sponsor Options',
        'pages'    => array('sponsor'),
        'fields' => array(
            array(
                'name' => "Sponsor link URL",
                'id'   => $prefix . 'sponsor_url',
                'desc' => 'i.e : http://www.yourwebsite.com ',
                'type' => 'text',
            ),
        )
    );
    //GALLERY FIELDS
    $meta_boxes[] = array(
        'title'    => 'Video Thumbnail',
        'pages'    => array('gallery'),
        'context'  => 'side',
        'fields' => array(
            array(
                'name' => "Enter the video embed url :",
                'id'   => $prefix . 'gallery_video',
                'desc' => 'Something like : http://www.youtube.com/embed/L9szn1QQfas',
                'type' => 'textarea',
            )
        )
    );
    //PAGE CUSTOM FIELDS
    $meta_boxes[] = array(
        'title'    => 'Page Options',
        'pages'    => array('page'),
        'context'  => 'side',
        'fields' => array(
            array(
                'name' => "Sidebar ?",
                'id'   => $prefix . 'page_sidebar',
                'desc' => 'Using the blog sidebar ',
                'type' => 'checkbox',
            )
        )
    );

    foreach ( $meta_boxes as $meta_box )
    {
        new RW_Meta_Box( $meta_box );
    }
}
add_filter('postbox_classes_post_postexcerpt','tee_add_metabox_classes');

function tee_add_metabox_classes($classes) {
    array_push($classes,'another_class');
    return $classes;
}