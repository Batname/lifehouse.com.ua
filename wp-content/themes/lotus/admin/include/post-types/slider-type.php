<?php
/**
 * Slider post-type setup here
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
 
/*-------------------------------------------------------------------------------------------------
 *	Register Slider post type
 *-------------------------------------------------------------------------------------------------*/

// Adds new post type for Sliders
function axiom_slider_type_init() 
{
	$labels = array(
	    'name' 				=> __('Sliders'			, 'default'),
	    'singular_name' 	=> __('Slider'			, 'default'),
	    'add_new' 			=> _x('Add New'			, 'add new Slider', 'default'),
	    'all_items' 		=> __('All Sliders'		, 'default'),
	    'add_new_item' 		=> __('Add New Slider'	, 'default'),
	    'edit_item' 		=> __('Edit Slider'		, 'default'),
	    'new_item' 			=> __('New Slider'		, 'default'),
	    'view_item' 		=> __('View Slider'		, 'default'),
	    'search_items' 		=> __('Search Sliders'	, 'default'),
	    'not_found' 		=> __('No Sliders found', 'default'),
	    'not_found_in_trash'=> __('No Slider found in trash', 'default'), 
	    'parent_item_colon' => ''
	);
	  
	$args = array(
		'labels' 			=> $labels,
		'public' 			=> true,
		'publicly_queryable'=> true,
		'show_ui' 			=> true, 
		'query_var' 		=> true,
		'rewrite' 			=> true,
		'capability_type' 	=> 'post',
		'hierarchical' 		=> false,
		'menu_position' 	=> 37,
		'supports' 			=> array('title'),
		'has_archive' 		=> 'archive-slider'
	); 
	register_post_type( 'slider',$args);
}

// Add new post type for Sliders
add_action('init', 'axiom_slider_type_init');


/*-------------------------------------------------------------------------------------------------
 *	Add Slider admin icons
 *-------------------------------------------------------------------------------------------------*/
	
// Adds new Custom Post Type icons
function axiom_slider_admin_icons() 
{
?>
	<style type="text/css" media="screen">
		#menu-posts-slider div.wp-menu-image {
			background: url(<?php echo ADMIN_URL; ?>images/icons/slider.png) no-repeat 4px -30px !important;
		}
		#menu-posts-slider.menu-icon-post:hover div.wp-menu-image {
			background: url(<?php echo ADMIN_URL; ?>images/icons/slider.png) no-repeat 4px   0px !important;
		}
		#menu-posts-slider.menu-icon-post.wp-menu-open div.wp-menu-image {
			background: url(<?php echo ADMIN_URL; ?>images/icons/slider.png) no-repeat 4px -60px !important;
		}
		#icon-edit.icon32.icon32-posts-slider{
			background: url(<?php echo ADMIN_URL; ?>images/icons/icons-34.png) no-repeat scroll -122px 0px !important;
		}
    </style>
<?php 
} 
	
// Add new Slider Type icons
add_action( 'admin_head', 'axiom_slider_admin_icons' );


/*-------------------------------------------------------------------------------------------------
 *  Customizing Slider Edit Columns
 *-------------------------------------------------------------------------------------------------*/

function axiom_slider_edit_columns($columns){
    
    
    $new_columns = array(  
        "cb"            => "<input type=\"checkbox\" />",  
        "title"         => _x('Customer Name' , 'Customer Name column at testimonial edit columns'   , 'default'),  
        "shortcode"     => _x('Shortcode'     , 'Shortcode at slider edit columns'                   , 'default')
    );    
    return array_merge($new_columns, $columns);  
}    
add_filter("manage_edit-slider_columns", "axiom_slider_edit_columns");  


function axiom_slider_custom_columns($column){  
    global $post;
    switch ($column)  
    {  
        case "category":  
            echo get_the_term_list($post->ID , 'testimonial-category', '', ', ','');  
            break;    
        case "shortcode":  
            echo '[axi_slider id="'.$post->ID.'"]';
            unset($opts, $type);
            break;  
    }  
}
add_action("manage_slider_posts_custom_column",  "axiom_slider_custom_columns");  


/*-------------------------------------------------------------------------------------------------*/
?>