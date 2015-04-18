<?php
/**
 * STAFF post-type setup here
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
 
/*-------------------------------------------------------------------------------------------------
 *  Register STAFF post type
 *-------------------------------------------------------------------------------------------------*/

// Adds new post type for STAFF
function axiom_staff_init() 
{
    $labels = array(
        'name'              => __('Staff'           , 'default'),
        'singular_name'     => __('Staff'           , 'default'),
        'add_new'           => _x('Add New', 'Staff labels', 'default'),
        'all_items'         => __('All Staff'      , 'default'),
        'add_new_item'      => __('Add New Staff'   , 'default'),
        'edit_item'         => __('Edit Staff'      , 'default'),
        'new_item'          => __('New Staff'       , 'default'),
        'view_item'         => __('View Staff'     , 'default'),
        'search_items'      => __('Search Staff'   , 'default'),
        'not_found'         => __('No Staff found' , 'default'),
        'not_found_in_trash'=> __('No Staff found in Trash', 'default'), 
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
        'menu_position'     => 35,
        'supports'          => array('title','editor','thumbnail','excerpt','page-attributes')
    ); 
    register_post_type( 'staff',$args);
}

// Add new post type for STAFF
add_action('init', 'axiom_staff_init');


/*-------------------------------------------------------------------------------------------------
 *  Create STAFF taxonomies
 *-------------------------------------------------------------------------------------------------*/

function axiom_create_staff_taxonomies() 
{   
    //labels for STAFF Category custom post type:
    $staff_category_labels = array(
        'name'              => _x( 'Staff Departmans', "Staff's Departmans general name" , 'default' ),
        'singular_name'     => _x( "Departman' , 'Staff's Departmans singular name", 'default' ),
        'search_items'      => __( 'Search in departmans'       , 'default'),
        'all_items'         => __( 'All Departmans'             , 'default'),
        'most_used_items'   => null,
        'parent_item'       => null,
        'parent_item_colon' => null,
        'edit_item'         => __( 'Edit Departman'             , 'default'), 
        'update_item'       => __( 'Update Departman'           , 'default'),
        'add_new_item'      => __( 'Add new Departman'          , 'default'),
        'new_item_name'     => __( 'New Departman'              , 'default'),
        'menu_name'         => __( 'Staff Departmans'           , 'default'),
    );
    
    register_taxonomy('departman', array('staff'), array(
        'hierarchical'      => true,
        'labels'            => $staff_category_labels,
        'singular_name'     => 'Departman',
        'show_ui'           => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'departman' )
    ));
    
    //labels for Skills custom post type
    /*$staff_tag_labels = array(
        'name'                      => _x( 'Staff Skills', 'staff skills general name'  , 'default' ),
        'singular_name'             => _x( 'Product tags', 'staff skills singular name' , 'default' ),
        'search_items'              => __( 'Search in Staff Skills' , 'default' ),
        'popular_items'             => __( 'Popular Staff Skills'   , 'default' ),
        'all_items'                 => __( 'All Staff Skills'       , 'default' ),
        'most_used_items'           => null,
        'parent_item'               => null,
        'parent_item_colon'         => null,
        'edit_item'                 => __( 'Edit Staff Skill'       , 'default' ), 
        'update_item'               => __( 'Update Staff Skill'     , 'default' ),
        'add_new_item'              => __( 'Add new Staff Skill'    , 'default' ),
        'new_item_name'             => __( 'New Staff Skill'        , 'default' ),
        'separate_items_with_commas'=> __( 'Separate "Staff Skills" with commas', 'default' ),
        'add_or_remove_items'       => __( 'Add or remove Staff Skill'          , 'default' ),
        'choose_from_most_used'     => __( 'Choose from the most used staff skills', 'default' ),
        'menu_name'                 => _x( 'Staff Skills' , 'staff-skill admin menu name', 'default' ),
    );
    register_taxonomy('staff-skill',array('staff'),array(
        'hierarchical'          => false,
        'labels'                => $staff_tag_labels,
        'show_ui'               => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array('slug' => 'staff-skill' )
    ));*/
}

// Add taxonomies
add_action( 'init', 'axiom_create_staff_taxonomies', 0 );
    

/*-------------------------------------------------------------------------------------------------
 *  Add STAFF admin icons
 *-------------------------------------------------------------------------------------------------*/
    
// Adds new Custom Post Type icons
function axiom_staff_admin_icons() 
{
?>
    <style type="text/css" media="screen">
        #menu-posts-staff div.wp-menu-image {
            background: url(<?php echo ADMIN_URL; ?>images/icons/staff.png) no-repeat 4px -30px !important;
        }
        #menu-posts-staff.menu-icon-post:hover div.wp-menu-image {
            background: url(<?php echo ADMIN_URL; ?>images/icons/staff.png) no-repeat 4px   0px !important;
        }
        #menu-posts-staff.menu-icon-post.wp-menu-open div.wp-menu-image {
            background: url(<?php echo ADMIN_URL; ?>images/icons/staff.png) no-repeat 4px -60px !important;
        }
        #icon-edit.icon32.icon32-posts-staff{
            background: url(<?php echo ADMIN_URL; ?>images/icons/icons-34.png) no-repeat scroll -160px 0px !important;
        }
    </style>
<?php 
} 
    
// Add new STAFF Type icons
add_action( 'admin_head', 'axiom_staff_admin_icons' );


/*-------------------------------------------------------------------------------------------------
 *  Customizing STAFF Edit Columns
 *-------------------------------------------------------------------------------------------------*/

function axiom_staff_edit_columns($columns){
    
    unset($columns['title'], $columns['date']);
      
    $new_columns = array(  
        "cb"            => "<input type=\"checkbox\" />",  
        "staff_image"   => _x('Image'    , 'Image column at staff edit columns'      , 'default'),
        "title"         => _x('Staff Name', 'Name column at staff edit columns'      , 'default'),  
        "category"      => _x("Departman", 'Departman column at staff edit columns'  , 'default')
    );    
    
    return array_merge($new_columns, $columns);  
}    

add_filter("manage_edit-staff_columns", "axiom_staff_edit_columns");  



function axiom_staff_custom_columns($column ){  
    global $post;
    
    switch ($column)  
    {  
        case "description":  
            the_excerpt();  
            break;  
        case "category":  
            echo get_the_term_list($post->ID , 'departman', '', ', ','');  
            break;  
        case "staff_image":  
            echo axiom_the_post_thumbnail(null, 60, 60, true, 90);
            break;  
    }  
}
add_action("manage_staff_posts_custom_column",  "axiom_staff_custom_columns");  


/*-------------------------------------------------------------------------------------------------*/

?>