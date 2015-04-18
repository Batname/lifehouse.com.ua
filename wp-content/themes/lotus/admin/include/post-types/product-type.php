<?php
/**
 * Product post-type setup here
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
 
/*-------------------------------------------------------------------------------------------------
 *	Register Product post type
 *-------------------------------------------------------------------------------------------------*/

// Adds new post type for Products
function axiom_product_init() 
{
	$labels = array(
	    'name' 				=> __('Products'		, 'default'),
	    'singular_name' 	=> __('Product'			, 'default'),
	    'add_new' 			=> _x('Add New', 'Product labels', 'default'),
	    'all_items' 		=> __('All Products'	, 'default'),
	    'add_new_item' 		=> __('Add New Product'	, 'default'),
	    'edit_item' 		=> __('Edit Product'	, 'default'),
	    'new_item' 			=> __('New Product'		, 'default'),
	    'view_item' 		=> __('View Product'	, 'default'),
	    'search_items' 		=> __('Search Products'	, 'default'),
	    'not_found' 		=> __('No Products found','default'),
	    'not_found_in_trash'=> __('No Products found in Trash', 'default'), 
	    'parent_item_colon' => ''
	);
	  
	$args = array(
		'labels' 			=> $labels,
		'public' 			=> true,
		'publicly_queryable'=> true,
		'show_ui' 			=> true, 
		'query_var' 		=> true,
		'rewrite'           => array("slug" => "archive/products",'with_front'=>false),
		'capability_type' 	=> 'post',
		'hierarchical' 		=> false,
		'menu_position' 	=> 31,
		'supports' 			=> array('title','editor','thumbnail','excerpt','page-attributes'),
		'has_archive' 		=> 'archive-product'
	); 
	register_post_type( 'axi_product',$args);
}

// Add new post type for Products
add_action('init', 'axiom_product_init');


/*-------------------------------------------------------------------------------------------------
 *	Create Product taxonomies
 *-------------------------------------------------------------------------------------------------*/

function axiom_create_product_taxonomies() 
{	
	//labels for Product Category custom post type:
	$product_category_labels = array(
		'name' 				=> _x( 'Product category', 'product category general name' , 'default' ),
		'singular_name' 	=> _x( 'Product category', 'product category singular name', 'default' ),
		'search_items' 		=> __( 'Search in Product categories', 'default'),
		'all_items' 		=> __( 'All Product categories' 	, 'default'),
		'most_used_items' 	=> null,
		'parent_item' 		=> null,
		'parent_item_colon' => null,
		'edit_item' 		=> __( 'Edit Product category' 		, 'default'), 
		'update_item' 		=> __( 'Update Product category' 	, 'default'),
		'add_new_item' 		=> __( 'Add new Product category' 	, 'default'),
		'new_item_name' 	=> __( 'New Product category' 		, 'default'),
		'menu_name' 		=> __( 'Categories'			        , 'default'),
	);
	
	register_taxonomy('product-category', array('axi_product'), array(
		'hierarchical' 		=> true,
		'labels' 			=> $product_category_labels,
		'singular_name' 	=> 'Product Category',
		'show_ui' 			=> true,
		'query_var' 		=> true,
		'rewrite' 			=> array('slug' => 'product-category' )
	));
	
	//labels for Product Tag custom post type
	$product_tag_labels = array(
		'name' 						=> _x( 'Product tags/filters', 'product tags general name'	, 'default' ),
		'singular_name' 			=> _x( 'Product tags', 'product tags singular name'	, 'default' ),
		'search_items' 				=> __( 'Search in Product tags/filters'	, 'default' ),
		'popular_items' 			=> __( 'Popular Product tags/filters'	, 'default' ),
		'all_items' 				=> __( 'All Product tags/filters'		, 'default' ),
		'most_used_items' 			=> null,
		'parent_item' 				=> null,
		'parent_item_colon' 		=> null,
		'edit_item' 				=> __( 'Edit Product tag/filter'	, 'default' ), 
		'update_item' 				=> __( 'Update Product tag/filter'	, 'default' ),
		'add_new_item' 				=> __( 'Add new Product tag/filter', 'default' ),
		'new_item_name' 			=> __( 'New Product tag/filter'	, 'default' ),
		'separate_items_with_commas'=> __( 'Separate "Product tags" with commas', 'default' ),
	    'add_or_remove_items' 		=> __( 'Add or remove Product tag'			, 'default' ),
	    'choose_from_most_used' 	=> __( 'Choose from the most used Product tags/filters', 'default' ),
		'menu_name' 				=> _x( 'Tags (filters)' , 'product-tag admin menu name', 'default' ),
	);
	register_taxonomy('product-tag',array('axi_product'),array(
		'hierarchical' 			=> false,
		'labels' 				=> $product_tag_labels,
		'show_ui' 				=> true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' 			=> true,
		'rewrite' 				=> array('slug' => 'product-tag' )
	));
}

// Add taxonomies
add_action( 'init', 'axiom_create_product_taxonomies', 0 );
	

/*-------------------------------------------------------------------------------------------------
 *	Add Product admin icons
 *-------------------------------------------------------------------------------------------------*/
	
// Adds new Custom Post Type icons
function axiom_product_admin_icons() 
{
?>
	<style type="text/css" media="screen">
		#menu-posts-axi_product div.wp-menu-image {
			background: url(<?php echo ADMIN_URL; ?>images/icons/product.png) no-repeat 4px -30px !important;
		}
		#menu-posts-axi_product.menu-icon-post:hover div.wp-menu-image {
			background: url(<?php echo ADMIN_URL; ?>images/icons/product.png) no-repeat 4px   0px !important;
		}
		#menu-posts-axi_product.menu-icon-post.wp-menu-open div.wp-menu-image {
			background: url(<?php echo ADMIN_URL; ?>images/icons/product.png) no-repeat 4px -60px !important;
		}
		#icon-edit.icon32.icon32-posts-axi_product{
			background: url(<?php echo ADMIN_URL; ?>images/icons/icons-34.png) no-repeat scroll -40px 0px !important;
		}
    </style>
<?php 
} 
	
// Add new Product Type icons
add_action( 'admin_head', 'axiom_product_admin_icons' );


/*-------------------------------------------------------------------------------------------------
 *	Customizing Product Edit Columns
 *-------------------------------------------------------------------------------------------------*/

function axiom_product_edit_columns($columns){
    
    unset($columns['title'], $columns['date']);
      
    $new_columns = array(  
        "cb" 			=> "<input type=\"checkbox\" />",  
        "product_image" => _x('Image', 'Image column at product edit columns'			, 'default'),
        "title" 		=> _x('Product Title', 'Title column at product edit columns'	, 'default'),  
        "category" 		=> _x("Product Categories", 'Category column at product edit columns', 'default'), 
        "tag" 			=> __('Tags', 'default'), 
        "price" 		=> _x('Price', 'Price column at product edit columns'			, 'default'),
        "in_stock"      => __('In Stock' , 'default')
    );    
    return array_merge($new_columns, $columns);  
}    

add_filter("manage_edit-axi_product_columns", "axiom_product_edit_columns");  



function axiom_product_custom_columns($column){  
    global $post;
    switch ($column)  
    {  
        case "description":  
            the_excerpt();  
            break;  
        case "category":  
            echo get_the_term_list($post->ID, 'product-category', '', ', ','');  
            break;  
		case "tag":  
            echo get_the_term_list($post->ID, 'product-tag', '', ', ',''); 
            break;  
		case "product_image":  
            echo axiom_the_post_thumbnail(null, 80, 100, false, 90);
            break;  
        case "price":  
            echo  get_post_meta($post->ID, 'product-price', TRUE);
            break;  
        case "in_stock":  
            $inStock  = get_post_meta($post->ID, 'product-in-stock', TRUE);
            $checked  = (empty($inStock) || $inStock == 'yes')?'checked':'';
            echo '<input type="checkbox" '.$checked.' disabled />' ;
            break;  
    }  
}
add_action("manage_axi_product_posts_custom_column",  "axiom_product_custom_columns");  


/*-------------------------------------------------------------------------------------------------*/

add_filter( 'admin_post_thumbnail_html', 'axi_add_product_featured_image_instruction');

function axi_add_product_featured_image_instruction( $content ) {
    if(isset($GLOBALS['post_type']) && $GLOBALS['post_type'] == 'axi_product'){
        return $content .= '<p>This is an image that is chosen as the representative/cover image for your product.</p>';
    }
    return $content;
}

?>