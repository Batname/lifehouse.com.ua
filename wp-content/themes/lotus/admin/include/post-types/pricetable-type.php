<?php
/**
 * Price Table post-type setup here
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
 
/*-------------------------------------------------------------------------------------------------
 *	Register Price Table post type
 *-------------------------------------------------------------------------------------------------*/

// Adds new post type for Price Table
function axiom_pricetable_type_init() 
{
	$labels = array(
	    'name' 				=> __('Price Table'		   , 'default'),
	    'singular_name' 	=> __('price-table'		   , 'default'),
	    'add_new' 			=> _x('Add New'			   , 'add new Slider', 'default'),
	    'all_items' 		=> __('All Tables'		   , 'default'),
	    'add_new_item' 		=> __('Add New Table'	   , 'default'),
	    'edit_item' 		=> __('Edit Table'		   , 'default'),
	    'new_item' 			=> __('New Price Table'	   , 'default'),
	    'view_item' 		=> __('View Price Tables'  , 'default'),
	    'search_items' 		=> __('Search Tables'	   , 'default'),
	    'not_found' 		=> __('No PriceTable found', 'default'),
	    'not_found_in_trash'=> __('No PriceTable found in trash', 'default'), 
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
		'menu_position' 	=> 38,
		'supports' 			=> array('title')
	); 
	register_post_type( 'pricetable',$args);
}

// Add new post type for Sliders
add_action('init', 'axiom_pricetable_type_init');


/*-------------------------------------------------------------------------------------------------
 *	Add Slider admin icons
 *-------------------------------------------------------------------------------------------------*/
	
// Adds new Custom Post Type icons
function axiom_pricetable_admin_icons() 
{
?>
	<style type="text/css" media="screen">
		#menu-posts-pricetable div.wp-menu-image {
			background: url(<?php echo ADMIN_URL; ?>images/icons/pricetable.png) no-repeat 4px -30px !important;
		}
		#menu-posts-pricetable.menu-icon-post:hover div.wp-menu-image {
			background: url(<?php echo ADMIN_URL; ?>images/icons/pricetable.png) no-repeat 4px   0px !important;
		}
		#menu-posts-pricetable.menu-icon-post.wp-menu-open div.wp-menu-image {
			background: url(<?php echo ADMIN_URL; ?>images/icons/pricetable.png) no-repeat 4px -60px !important;
		}
		#icon-edit.icon32.icon32-posts-pricetable{
			background: url(<?php echo ADMIN_URL; ?>images/icons/icons-34.png) no-repeat scroll -280px 0px !important;
		}
    </style>
<?php 
} 
	
// Add new PriceTable Type icons
add_action( 'admin_head', 'axiom_pricetable_admin_icons' );


/*-------------------------------------------------------------------------------------------------
 *  Customizing Pricetable Edit Columns
 *-------------------------------------------------------------------------------------------------*/

function axiom_pricetable_edit_columns($columns){  
    $new_columns = array(   
        "shortcode"         => _x('Shortcode'    , 'shortcode column at pricetable edit columns', 'default')
    );    
    
    return array_merge($columns, $new_columns);  
}    

add_filter("manage_edit-pricetable_columns", "axiom_pricetable_edit_columns");  


function axiom_pricetable_custom_columns($column){  
    global $post;
    
    switch ($column)  
    {   
        case "shortcode":  
            echo '[pricetable table_id="'.$post->ID.'" ]';
            break;  
    }  
}  

add_action("manage_pricetable_posts_custom_column",  "axiom_pricetable_custom_columns");  
?>