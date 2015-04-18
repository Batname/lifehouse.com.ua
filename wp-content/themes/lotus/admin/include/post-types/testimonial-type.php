<?php
/**
 * testimonial post-type setup here
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
 
/*-------------------------------------------------------------------------------------------------
 *  Register testimonial post type
 *-------------------------------------------------------------------------------------------------*/

// Adds new post type for testimonial
function axiom_testimonial_init() 
{
    $labels = array(
        'name'              => __('Testimonials'          , 'default'),
        'singular_name'     => __('Testimonial'           , 'default'),
        'add_new'           => _x('Add New', 'Testimonials labels', 'default'),
        'all_items'         => __('All Testimonials'      , 'default'),
        'add_new_item'      => __('Add New Testimonial'   , 'default'),
        'edit_item'         => __('Edit Testimonial'      , 'default'),
        'new_item'          => __('New Testimonial'       , 'default'),
        'view_item'         => __('View Testimonial'      , 'default'),
        'search_items'      => __('Search Testimonials'   , 'default'),
        'not_found'         => __('No Testimonials found' , 'default'),
        'not_found_in_trash'=> __('No Testimonials found in Trash', 'default'), 
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
        'menu_position'     => 36,
        'supports'          => array('title','editor','excerpt','thumbnail')
    ); 
    register_post_type( 'testimonial',$args);
}

// Add new post type for testimonial
add_action('init', 'axiom_testimonial_init');


/*-------------------------------------------------------------------------------------------------
 *  Create Testionial taxonomies
 *-------------------------------------------------------------------------------------------------*/

function axiom_create_testimonial_taxonomies() 
{   
    //labels for Testimonial Category:
    $testi_category_labels  = array(
        'name'              => _x( 'Testimonial Category' , "Staff's Departmans general name" , 'default' ),
        'singular_name'     => _x( "Testimonial Category' , 'Staff's Departmans singular name", 'default' ),
        'search_items'      => __( 'Search in Testimonial Categories'       , 'default'),
        'all_items'         => __( 'All Testimonial Categories'             , 'default'),
        'most_used_items'   => null,
        'parent_item'       => null,
        'parent_item_colon' => null,
        'edit_item'         => __( 'Edit Testimonial Category'             , 'default'), 
        'update_item'       => __( 'Update Testimonial Category'           , 'default'),
        'add_new_item'      => __( 'Add new Category'          , 'default'),
        'new_item_name'     => __( 'New Testimonial Category'              , 'default'),
        'menu_name'         => __( 'Categories'           , 'default'),
    );
    
    register_taxonomy('testimonial-category', array('testimonial'), array(
        'hierarchical'      => true,
        'labels'            => $testi_category_labels,
        'singular_name'     => 'testimonial-category',
        'show_ui'           => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'testimonial-category' )
    ));
}

// Add taxonomy
add_action( 'init', 'axiom_create_testimonial_taxonomies', 0 );
    

    
/*-------------------------------------------------------------------------------------------------
 *  Add testimonial admin icons
 *-------------------------------------------------------------------------------------------------*/
    
// Adds new Custom Post Type icons
function axiom_testimonial_admin_icons() 
{
?>
    <style type="text/css" media="screen">
        #menu-posts-testimonial div.wp-menu-image {
            background: url(<?php echo ADMIN_URL; ?>images/icons/testi.png) no-repeat 4px -30px !important;
        }
        #menu-posts-testimonial.menu-icon-post:hover div.wp-menu-image {
            background: url(<?php echo ADMIN_URL; ?>images/icons/testi.png) no-repeat 4px   0px !important;
        }
        #menu-posts-testimonial.menu-icon-post.wp-menu-open div.wp-menu-image {
            background: url(<?php echo ADMIN_URL; ?>images/icons/testi.png) no-repeat 4px -60px !important;
        }
        #icon-edit.icon32.icon32-posts-testimonial{
            background: url(<?php echo ADMIN_URL; ?>images/icons/icons-34.png) no-repeat scroll -240px 0px !important;
        }
    </style>
<?php 
} 
    
// Add new testimonial Type icons
add_action( 'admin_head', 'axiom_testimonial_admin_icons' );


/*-------------------------------------------------------------------------------------------------
 *  Customizing testimonial Edit Columns
 *-------------------------------------------------------------------------------------------------*/

function axiom_testimonial_edit_columns($columns){
    
    unset($columns['title']);
      
    $new_columns = array(  
        "cb"            => "<input type=\"checkbox\" />",  
        "user_image"    => _x('Image'         , 'Image column at testimonial edit columns'           , 'default'),
        "title"         => _x('Customer Name' , 'Customer Name column at testimonial edit columns'   , 'default'),  
        "category"      => _x('Category'      , 'Category at testimonial edit columns'               , 'default')
    );    
    return array_merge($new_columns, $columns);  
}    
add_filter("manage_edit-testimonial_columns", "axiom_testimonial_edit_columns");  


function axiom_testimonial_custom_columns($column){  
    global $post;
    switch ($column)  
    {  
        case "category":  
            echo get_the_term_list($post->ID , 'testimonial-category', '', ', ','');  
            break;    
        case "user_image":  
            echo axiom_the_post_thumbnail(null, 60, 60, true, 90);
            break;  
    }  
}
add_action("manage_testimonial_posts_custom_column",  "axiom_testimonial_custom_columns");  


/*-------------------------------------------------------------------------------------------------*/

?>