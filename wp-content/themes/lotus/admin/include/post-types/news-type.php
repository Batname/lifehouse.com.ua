<?php
/**
 * News post-type setup here
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
 
 
/*-------------------------------------------------------------------------------------------------
 *	Register News post type
 *-------------------------------------------------------------------------------------------------*/

// Adds new post type for News
function axiom_news_type_init() 
{
	$labels = array(
	    'name' 				=> __('News'			, 'default'),
	    'singular_name' 	=> __('News'			, 'default'),
	    'add_new' 			=> __('Add News'	    , 'default'),
	    'all_items' 		=> __('All News'		, 'default'),
	    'add_new_item' 		=> __('Add News'	    , 'default'),
	    'edit_item' 		=> __('Edit News'		, 'default'),
	    'new_item' 			=> __('New News'		, 'default'),
	    'view_item' 		=> __('View News'		, 'default'),
	    'search_items' 		=> __('Search News'	    , 'default'),
	    'not_found' 		=> __('No news found'	, 'default'),
	    'not_found_in_trash'=> __('No news found in trash', 'default'), 
	    'parent_item_colon' => ''
	);
	  
	$args = array(
		'labels' 			=> $labels,
		'public' 			=> true,
		'publicly_queryable'=> true,
		'show_ui' 			=> true, 
		'query_var' 		=> true,
		'rewrite' 			=> array("slug" => "archive/news",'with_front'=>false),
		'capability_type' 	=> 'post',
		'hierarchical' 		=> false,
		'menu_position' 	=> 32,
		'supports' 			=> array('title','editor','thumbnail','excerpt','comments','page-attributes'),
		'has_archive' 		=> 'archive-news'
	); 
	register_post_type( 'news',$args);
}

// Add new post type for news
add_action('init', 'axiom_news_type_init');


/*-------------------------------------------------------------------------------------------------
 *	Create news taxonomies
 *-------------------------------------------------------------------------------------------------*/

function axiom_create_news_taxonomies() 
{	
	//labels for news Category custom post type:
	$news_category_labels = array(
		'name' 				=> _x( 'News Category', 'news category general name' , 'default' ),
		'singular_name' 	=> _x( 'News Category', 'news category singular name', 'default' ),
		'search_items' 		=> __( 'Search in news categories'  , 'default'),
		'all_items' 		=> __( 'All news categories' 		, 'default'),
		'most_used_items' 	=> null,
		'parent_item' 		=> null,
		'parent_item_colon' => null,
		'edit_item' 		=> __( 'Edit news category' 		, 'default'), 
		'update_item' 		=> __( 'Update news category' 		, 'default'),
		'add_new_item' 		=> __( 'Add new "News Category"' 	, 'default'),
		'new_item_name' 	=> __( 'New news category' 		    , 'default'),
		'menu_name' 		=> __( 'Categories'			        , 'default'),
	);
	
	register_taxonomy('news-category', array('news'), array(
		'hierarchical' 	=> true,
		'labels' 		=> $news_category_labels,
		'singular_name' => 'news Category',
		'show_ui' 		=> true,
		'query_var' 	=> true,
		'rewrite' 		=> array('slug' => 'news-cats' )
	));
	
	//labels for news Tag custom post type
	$news_tag_labels = array(
		'name' 				=> _x( 'News Tags', 'News tags general name' , 'default' ),
		'singular_name' 	=> _x( 'News Tags', 'News tags singular name', 'default' ),
		'search_items' 		=> __( 'Search in "News Tags"'	, 'default' ),
		'popular_items' 	=> __( 'Popular "News Tags"'  	, 'default' ),
		'all_items' 		=> __( 'All News Tags'		   	, 'default' ),
		'most_used_items' 	=> null,
		'parent_item' 		=> null,
		'parent_item_colon' => null,
		'edit_item' 		=> __( 'Edit "News tag"'		, 'default' ), 
		'update_item' 		=> __( 'Update "News tag"'		, 'default' ),
		'add_new_item' 		=> __( 'Add new "News tag"'	    , 'default' ),
		'new_item_name' 	=> __( 'New "News tag"'		    , 'default' ),
		'separate_items_with_commas' 	=> __( 'Separate "News Tags" with commas'		, 'default' ),
	    'add_or_remove_items' 			=> __( 'Add or remove "News tag"'				, 'default' ),
	    'choose_from_most_used' 		=> __( 'Choose from the most used "News tags"'	, 'default' ),
		'menu_name' 		=> _x( 'Tags' , 'News-tag admin menu name'			, 'default' ),
	);
	register_taxonomy('news-tag',array('news'),array(
		'hierarchical' 		=> false,
		'labels' 			=> $news_tag_labels,
		'show_ui' 			=> true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' 		=> true,
		'rewrite' 			=> array('slug' => 'news-tags' )
	));
}

// Add taxonomies
add_action( 'init', 'axiom_create_news_taxonomies', 0 );
	

/*-------------------------------------------------------------------------------------------------
 *	Add news admin icons
 *-------------------------------------------------------------------------------------------------*/
	
// Adds new Custom Post Type icons
function axiom_news_admin_icons() 
{
?>
	<style type="text/css" media="screen">
		#menu-posts-news div.wp-menu-image {
			background: url(<?php echo ADMIN_URL; ?>images/icons/news.png) no-repeat 4px -30px !important;
		}
		#menu-posts-news.menu-icon-post:hover div.wp-menu-image {
			background: url(<?php echo ADMIN_URL; ?>images/icons/news.png) no-repeat 4px   0px !important;
		}
		#menu-posts-news.menu-icon-post.wp-menu-open div.wp-menu-image {
			background: url(<?php echo ADMIN_URL; ?>images/icons/news.png) no-repeat 4px -60px !important;
		}
		#icon-edit.icon32.icon32-posts-news{
			background: url(<?php echo ADMIN_URL; ?>images/icons/icons-34.png) no-repeat scroll -82px -2px !important;
		}
    </style>
<?php 
} 
	
// Add new news Type icons
add_action( 'admin_head', 'axiom_news_admin_icons' );


/*-------------------------------------------------------------------------------------------------
 *	Customizing news Edit Columns
 *-------------------------------------------------------------------------------------------------*/

function axiom_news_edit_columns($columns){  
    $columns = array(  
        "cb" 		=> "<input type=\"checkbox\" />",  
        "title" 	=> _x('News Title'	, 'Title column at News  edit columns'	  , 'default'),  
        "category" 	=> _x("Categories"	, 'Category column at News edit columns' , 'default'), 
        "tag" 		=> __('Tags'		, 'default'), 
        "date" 		=> __('Date'		, 'default'), 
        "comments" 	=> __('Comments'	, 'default')
    );    
	$columns['comments'] = '<div class="vers"><img alt="Comments" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>';
    return $columns;  
}    

add_filter("manage_edit-_news_columns", "axiom_news_edit_columns");  


function axiom_news_custom_columns($column){  
    global $post;
    switch ($column)  
    {  
        case "description":  
            the_excerpt();  
            break;  
        case "category":  
            echo get_the_term_list($post->ID, 'news-category', '', ', ','');  
            break;  
		case "tag":  
            echo get_the_term_list($post->ID, 'news-tag'	, '', ', ',''); 
            break;  
    }  
}  

add_action("manage_news_posts_custom_column",  "axiom_news_custom_columns");  


/*-------------------------------------------------------------------------------------------------*/


?>