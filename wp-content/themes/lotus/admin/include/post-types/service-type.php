<?php
/**
 * Service post-type setup here
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
 
/*-------------------------------------------------------------------------------------------------
 *  Register Service post type
 *-------------------------------------------------------------------------------------------------*/

// Adds new post type for Service
function axiom_Service_init() 
{
    $labels = array(
        'name'              => __('Services'          , 'default'),
        'singular_name'     => __('Service'           , 'default'),
        'add_new'           => _x('Add New', 'Services labels', 'default'),
        'all_items'         => __('All Services'      , 'default'),
        'add_new_item'      => __('Add New Service'   , 'default'),
        'edit_item'         => __('Edit Service'      , 'default'),
        'new_item'          => __('New Service'       , 'default'),
        'view_item'         => __('View Services'     , 'default'),
        'search_items'      => __('Search Services'   , 'default'),
        'not_found'         => __('No Services found' , 'default'),
        'not_found_in_trash'=> __('No Services found in Trash', 'default'), 
        'parent_item_colon' => ''
    );
      
    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'publicly_queryable'=> true,
        'show_ui'           => true, 
        'query_var'         => true,
        'rewrite'           => true,
        'capability_type'   => 'post',
        'hierarchical'      => false,
        'menu_position'     => 33,
        'supports'          => array('title','editor','thumbnail','excerpt')
    ); 
    register_post_type( 'service',$args);
}

// Add new post type for Service
add_action('init', 'axiom_Service_init');

/*-------------------------------------------------------------------------------------------------
 *  Create Service taxonomies
 *-------------------------------------------------------------------------------------------------*/

function axiom_create_service_taxonomies() 
{   
    //labels for service Category custom post type:
    $service_category_labels = array(
        'name'              => _x( 'Service Category', 'Service category general name' , 'default' ),
        'singular_name'     => _x( 'Service Category', 'Service category singular name', 'default' ),
        'search_items'      => __( 'Search in Service categories' , 'default'),
        'all_items'         => __( 'All Service categories'       , 'default'),
        'most_used_items'   => null,
        'parent_item'       => null,
        'parent_item_colon' => null,
        'edit_item'         => __( 'Edit Service category'        , 'default'), 
        'update_item'       => __( 'Update Service category'      , 'default'),
        'add_new_item'      => __( 'Add new "Service Category"'   , 'default'),
        'new_item_name'     => __( 'New Service category'         , 'default'),
        'menu_name'         => __( 'Categories'                   , 'default'),
    );
    
    register_taxonomy('service-category', array('service'), array(
        'hierarchical'  => true,
        'labels'        => $service_category_labels,
        'singular_name' => 'service Category',
        'show_ui'       => true,
        'query_var'     => true,
        'rewrite'       => array('slug' => 'service-category' )
    ));
    
}

// Add taxonomies
add_action( 'init', 'axiom_create_service_taxonomies', 0 );

/*-------------------------------------------------------------------------------------------------
 *  Add Service admin icons
 *-------------------------------------------------------------------------------------------------*/
    
// Adds new Custom Post Type icons
function axiom_service_admin_icons() 
{
?>
    <style type="text/css" media="screen">
        #menu-posts-service div.wp-menu-image {
            background: url(<?php echo ADMIN_URL; ?>images/icons/service.png) no-repeat 4px -30px !important;
        }
        #menu-posts-service.menu-icon-post:hover div.wp-menu-image {
            background: url(<?php echo ADMIN_URL; ?>images/icons/service.png) no-repeat 4px   0px !important;
        }
        #menu-posts-service.menu-icon-post.wp-menu-open div.wp-menu-image {
            background: url(<?php echo ADMIN_URL; ?>images/icons/service.png) no-repeat 4px -60px !important;
        }
        #icon-edit.icon32.icon32-posts-service{
            background: url(<?php echo ADMIN_URL; ?>images/icons/icons-34.png) no-repeat scroll -160px 0px !important;
        }
    </style>
<?php 
} 
    
// Add new Service Type icons
add_action( 'admin_head', 'axiom_service_admin_icons' );

/*-------------------------------------------------------------------------------------------------*/
?>