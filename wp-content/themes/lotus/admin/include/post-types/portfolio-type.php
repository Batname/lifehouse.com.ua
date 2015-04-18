<?php
/**
 * Portfolio post-type setup here
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
 
/*-------------------------------------------------------------------------------------------------
 *	Register Portfolio post type
 *-------------------------------------------------------------------------------------------------*/

// Adds new post type for Portfolios
function axiom_portfolio_init() 
{
	$labels = array(
	    'name' =>          __('Portfolios', 'default' ),
	    'singular_name' => __('Portfolio' , 'default' ),
	    'add_new' =>       __('Add New'   , 'default' ),
	    'all_items' =>     __('All'       , 'default' ).' '.__('Portfolios', 'default' ),
	    'add_new_item' =>  __('Add New'   , 'default' ).' '.__('Portfolio' , 'default' ),
	    'edit_item' =>     __('Edit Portfolio', 'default'),
	    'new_item' =>      __('New Portfolio' , 'default'),
	    'view_item' =>     __('View Portfolio', 'default'),
	    'search_items' =>  __('Search Portfolios'  , 'default'),
	    'not_found' =>     __('No Portfolios found', 'default'),
	    'not_found_in_trash' => __('No Portfolios found in Trash', 'default'), 
	    'parent_item_colon' => ''
	);
	  
	$args = array(
		'labels' =>   $labels,
		'public' =>   true,
		'show_ui' =>  true, 
		'query_var'=> true,
		'rewrite' =>  true,
		'publicly_queryable' => true,
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'menu_position'      => 30,
		'supports' => array('title','editor','thumbnail','excerpt'/*,'custom-fields'*/,'page-attributes'),
		'has_archive' => 'archive-portfolio'
	); 
	register_post_type( 'portfolio' ,$args);
}

// Add new post type for Portfolios
add_action('init', 'axiom_portfolio_init');


/*-------------------------------------------------------------------------------------------------
 *	Create portfolio taxonomies
 *-------------------------------------------------------------------------------------------------*/

function axiom_create_portfolio_taxonomies() 
{	
	//labels for Project Type custom post type:
	$project_labels = array(
		'name' 				=> _x( 'Portfolio Category', 'portfolio category general name' , 'default' ),
		'singular_name' 	=> _x( 'Portfolio Categories', 'portfolio-category singular name', 'default' ),
		'search_items' 		=> __( 'Search in Portfolio Categories', 'default' ),
		'all_items' 		=> __( 'All Portfolio Categories'	   , 'default' ),
		'most_used_items' 	=> null,
		'parent_item' 		=> null,
		'parent_item_colon' => null,
		'edit_item' 		=> __( 'Edit portfolio category'   , 'default' ), 
		'update_item' 		=> __( 'Update portfolio category' , 'default' ),
		'add_new_item' 		=> __( 'Add new portfolio category', 'default' ),
		'new_item_name' 	=> __( 'New portfolio category'	   , 'default' ),
		'menu_name' 		=> _x( 'Categories', 'portfolio-category admin menu name', 'default' ),
	);
	
	register_taxonomy('project-type', array( 'portfolio'), array(
		'hierarchical' 	=> true,
		'labels' 		=> $project_labels,
		'singular_name' => 'Portfolio category',
		'show_ui' 		=> true,
		'query_var' 	=> true,
		'rewrite' 		=> array('slug' => 'project-type' )
	));
	
	//labels for Portfolio Tag/Filter taxonomy
	$skill_labels = array(
		'name' 				=> _x( 'Portfolio Tags/Filters', 'portfolio-tag general name'	, 'default' ),
		'singular_name' 	=> _x( 'Tags/Filters', 'portfolio-tag singular name'	, 'default' ),
		'search_items' 		=> __( 'Search in Tag/filter'	    , 'default' ),
		'popular_items' 	=> __( 'Popular Tags/filter'		, 'default' ),
		'all_items' 		=> __( 'All Tags/filters'			, 'default' ),
		'most_used_items' 	=> null,
		'parent_item' 		=> null,
		'parent_item_colon' => null,
		'edit_item' 		=> __( 'Edit Tag/Filter'        , 'default' ), 
		'update_item' 		=> __( 'Update Tag/Filter'		, 'default' ),
		'add_new_item' 		=> __( 'Add new Tag/Filter'		, 'default' ),
		'new_item_name' 	=> __( 'New Tag/Filter'		    , 'default' ),
		'separate_items_with_commas' 	=> __( 'Separate "Tag/Filter" with commas'	 , 'default' ),
	    'add_or_remove_items' 			=> __( 'Add or remove Tag/Filter'			 , 'default' ),
	    'choose_from_most_used' 		=> __( 'Choose from the most used tags'      , 'default' ),
		'menu_name' 		=> _x( 'Tags (Filters)', 'portfolio-tag admin menu name'     , 'default' ),
	);
	register_taxonomy('portfolio-tag',array( 'portfolio'),array(
		'hierarchical' 			=> false,
		'labels' 				=> $skill_labels,
		'show_ui' 				=> true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' 			=> true,
		'rewrite' 				=> array('slug' => 'portfolio-tag' )
	));
}

// Add portfolio taxonomies
add_action( 'init', 'axiom_create_portfolio_taxonomies', 0 );
	

/*-------------------------------------------------------------------------------------------------
 *	Add Portfolio admin icons
 *-------------------------------------------------------------------------------------------------*/
	
// Adds new Custom Post Type icons
function axiom_portfolio_admin_icons() 
{
?>
	<style type="text/css" media="screen">
		#menu-posts-portfolio div.wp-menu-image {
			background: url(<?php echo ADMIN_URL; ?>images/icons/portfolio.png) no-repeat 4px -30px !important;
		}
		#menu-posts-portfolio.menu-icon-post:hover div.wp-menu-image {
			background: url(<?php echo ADMIN_URL; ?>images/icons/portfolio.png) no-repeat 4px   0px !important;
		}
		#menu-posts-portfolio.menu-icon-post.wp-menu-open div.wp-menu-image {
			background: url(<?php echo ADMIN_URL; ?>images/icons/portfolio.png) no-repeat 4px -60px !important;
		}
		#icon-edit.icon32.icon32-posts-portfolio{
			background: url(<?php echo ADMIN_URL; ?>images/icons/icons-34.png) no-repeat scroll 0px -2px !important;
		}
    </style>
<?php 
} 
	
// Add new Portfolio Type icons
add_action( 'admin_head', 'axiom_portfolio_admin_icons' );


/*-------------------------------------------------------------------------------------------------
 *	Customizing Portfolio Edit Columns
 *-------------------------------------------------------------------------------------------------*/

function axiom_portfolio_edit_columns($columns){
    
    unset($columns['title'], $columns['date']);
      
    $new_columns = array(  
        "cb" 				=> "<input type=\"checkbox\" />",  
        "portfolio_image" 	=> _x('Image'			, 'Image column at portfolio edit columns', 'default'),
        "title" 			=> _x('Portfolio Title'	, 'Title column at portfolio edit columns', 'default'),  
        "type" 				=> _x('Project Type'	, 'Type  column at portfolio edit columns', 'default'), 
        "link" 				=> _x("Project's Link"	, 'Link  column at portfolio edit columns', 'default'),  
        "tag" 			    => _x('Tag / Filter'    , 'Tag/Filter column at portfolio edit columns', 'default'), 
        "r_date" 			=> _x('Release Date'	, 'Date  column at portfolio edit columns', 'default')
    );    
	
	return array_merge($new_columns, $columns);  
}    

add_filter("manage_edit-portfolio_columns", "axiom_portfolio_edit_columns");  


function axiom_project_custom_columns($column){  
    global $post;
    
    switch ($column)  
    {  
        case "description":  
            the_excerpt();  
            break;  
        case "link":  
            echo get_post_meta($post->ID, "project-link", TRUE);
            break;  
        case "type":  
            echo get_the_term_list($post->ID, 'project-type', '', ', ','');  
            break;  
		case "tag":  
            echo get_the_term_list($post->ID, 'portfolio-tag', '', ', ','');  
            break;  
		case "portfolio_image":  
            echo axiom_the_post_thumbnail(null, 80, 100, false, 90);
            break;  
		case "r_date":  
			echo get_post_meta($post->ID, "project-date", true);
			break;
    }  
}  

add_action("manage_portfolio_posts_custom_column",  "axiom_project_custom_columns");  

/*-------------------------------------------------------------------------------------------------*/


add_filter( 'admin_post_thumbnail_html', 'axi_add_portfolio_featured_image_instruction');

function axi_add_portfolio_featured_image_instruction( $content ) {
    if(isset($GLOBALS['post_type']) && $GLOBALS['post_type'] == 'portfolio'){
        return $content .= '<p>This is an image that is chosen as the representative/cover image for your project.</p>';
    }
    return $content;
}

?>