<?php

// populer Post Count

function popularPosts($num) {
    global $wpdb;
    
    $posts = $wpdb->get_results("SELECT comment_count, ID, post_title FROM $wpdb->posts ORDER BY comment_count DESC LIMIT 0 , $num");
    
    foreach ($posts as $post) {
        setup_postdata($post);
        $id = $post->ID;
        $title = $post->post_title;
        $count = $post->comment_count;
		$date = get_the_date('F j, Y');;
		$post_thumbnail= get_the_post_thumbnail( $post->ID, 'newslatter-image',array('class' => 'alignleft') ); 
        
        if ($count != 0) {
            $popular .= '<div class="single_sidebar">';
            $popular .= '<a href="' .get_permalink($id).'">'.$post_thumbnail.'</a>';
            $popular .= '<h3><a href="' . get_permalink($id) . '">' . $title . '</a></h3>';
            $popular .= '<p><span class="sidebar_post_date"><i class="fa fa-calendar"></i></span>' . $date . '</p>';
            $popular .= '</div>';
        }
    }
    return $popular;
}
//Footer popular
function footerPopularPosts($num) {
    global $wpdb;
    
    $posts = $wpdb->get_results("SELECT comment_count, ID, post_title FROM $wpdb->posts ORDER BY comment_count DESC LIMIT 0 , $num");
    
    foreach ($posts as $post) {
        setup_postdata($post);
        $id = $post->ID;
        $title = $post->post_title;
        $count = $post->comment_count;
		$post_thumbnail= get_the_post_thumbnail( $post->ID, 'post-thumbnail',array('class' => 'sidebar-sai-imgg alignleft') ); 
        
        if ($count != 0) {
            $popular .= '<div class="popular-post footer-recent solve">';
            $popular .= '<a href="' .get_permalink($id).'">'.$post_thumbnail.'</a>';
            $popular .= '<a href="' . get_permalink($id) . '"><p>' . $title . '</p></a>';
            $popular .= '</div>';
        }
    }
    return $popular;
}



?>