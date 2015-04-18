<?php /* Loops through all posts, for displaying posts in blog templates. */ 


    if ( get_query_var('paged') ) {
        $paged = get_query_var('paged');
    } else if ( get_query_var('page') ) {
        $paged = get_query_var('page');
    } else { $paged = 1; }
    
    $q_args  = 'paged='. $paged;
    $q_args .= '&s='. get_search_query() .'&post_status=published&posts_per_page=8';
    
    $bu_wp_query = $wp_query; 
    $wp_query = null; 
    $wp_query = new WP_Query(); 
    $wp_query->query($q_args); 
    
    if (have_posts()) :
    
        include 'entry/search.php';
        
        axiom_the_search_paginate_nav(); 
        
    else :
        
        get_template_part('inc/content', 'no-resaults' );
        
    endif; 
    
    $wp_query = $bu_wp_query; 
    
?>                  