<?php
/**
 * FAG post-type setup here
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
 
/*-------------------------------------------------------------------------------------------------
 *  Register FAQ post type
 *-------------------------------------------------------------------------------------------------*/

// Adds new post type for FAQ
function axiom_faq_type_init() 
{
    $labels = array(
        'name'              => __('FAQs'            , 'default'),
        'singular_name'     => __('FAQ'             , 'default'),
        'add_new'           => _x('Add New', 'FAQs labels', 'default'),
        'all_items'         => __('All FAQs'      , 'default'),
        'add_new_item'      => __('Add New FAQ'   , 'default'),
        'edit_item'         => __('Edit FAQ'      , 'default'),
        'new_item'          => __('New FAQ'       , 'default'),
        'view_item'         => __('View FAQs'     , 'default'),
        'search_items'      => __('Search FAQs'   , 'default'),
        'not_found'         => __('No FAQs found' , 'default'),
        'not_found_in_trash'=> __('No FAQs found in Trash', 'default'), 
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
        'menu_position'     => 34,
        'supports'          => array('title','editor','thumbnail')
    ); 
    register_post_type( 'faq',$args);
}

// Add new post type for FAQ
add_action('init', 'axiom_faq_type_init');


/*-------------------------------------------------------------------------------------------------
 *  Create FAQ taxonomies
 *-------------------------------------------------------------------------------------------------*/

function axiom_create_faq_taxonomies() 
{   
    //labels for FAQ Category custom post type:
    $FAQ_category_labels = array(
        'name'              => _x( 'FAQ Categories', "FAQ Categories general name" , 'default' ),
        'singular_name'     => _x( "FAQ Category'  , 'FAQ Category singular name"  , 'default' ),
        'search_items'      => __( 'Search in FAQ Categories'   , 'default'),
        'all_items'         => __( 'All FAQ Categories'         , 'default'),
        'most_used_items'   => null,
        'parent_item'       => null,
        'parent_item_colon' => null,
        'edit_item'         => __( 'Edit FAQ Category'          , 'default'), 
        'update_item'       => __( 'Update FAQ Category'        , 'default'),
        'add_new_item'      => __( 'Add new FAQ Category'       , 'default'),
        'new_item_name'     => __( 'New FAQ Category'           , 'default'),
        'menu_name'         => __( 'Categories'             , 'default'),
    );
    
    register_taxonomy('faq-category', array('faq'), array(
        'hierarchical'      => true,
        'labels'            => $FAQ_category_labels,
        'singular_name'     => 'FAQ Category',
        'show_ui'           => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'faq-category' )
    ));
}

// Add taxonomies
add_action( 'init', 'axiom_create_faq_taxonomies', 0 );
    

/*-------------------------------------------------------------------------------------------------
 *  Add FAQ admin icons
 *-------------------------------------------------------------------------------------------------*/
    
// Adds new Custom Post Type icons
function axiom_FAQ_admin_icons() 
{
?>
    <style type="text/css" media="screen">
        #menu-posts-faq div.wp-menu-image {
            background: url(<?php echo ADMIN_URL; ?>images/icons/faq.png) no-repeat 4px -30px !important;
        }
        #menu-posts-faq.menu-icon-post:hover div.wp-menu-image {
            background: url(<?php echo ADMIN_URL; ?>images/icons/faq.png) no-repeat 4px   0px !important;
        }
        #menu-posts-faq.menu-icon-post.wp-menu-open div.wp-menu-image {
            background: url(<?php echo ADMIN_URL; ?>images/icons/faq.png) no-repeat 4px -60px !important;
        }
        #icon-edit.icon32.icon32-posts-faq{
            background: url(<?php echo ADMIN_URL; ?>images/icons/icons-34.png) no-repeat scroll -200px 0px !important;
        }
    </style>
<?php 
} 
    
// Add new FAQ Type icons
add_action( 'admin_head', 'axiom_FAQ_admin_icons' );


/*-------------------------------------------------------------------------------------------------
 *  Customizing FAQ Edit Columns
 *-------------------------------------------------------------------------------------------------*/

function axiom_faq_edit_columns($columns){
    unset($columns['date']);
      
    $new_columns = array(  
        "cb"            => "<input type=\"checkbox\" />",  
        "title"         => _x('Question' , 'Question column at FAQ edit columns'   , 'default'),  
        "category"      => _x("Category" , 'Category column at FAQ edit columns'   , 'default')
    );    
    return array_merge($columns, $new_columns );
}    

add_filter("manage_edit-faq_columns", "axiom_faq_edit_columns");  



function axiom_faq_custom_columns($column){  
    global $post;  
    switch ($column)  
    {  
        case "category":  
            echo get_the_term_list($post->ID, 'faq-category', '', ', ','');  
            break;  
    }  
}
add_action("manage_faq_posts_custom_column",  "axiom_faq_custom_columns");  


/*-------------------------------------------------------------------------------------------------*/

?>