<?php
/**
 * Ajax handler for saving price table data
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */

/* Ajax handler -------------------------
 * ------------------------------------- */

function axiom_save_pt_data() {
	global $wpdb;
    
    header( "Content-Type: application/json" );
    
    // verify nonce
    if ( !wp_verify_nonce( $_POST['nonce'], "pt-data-nonce") ) {
        echo json_encode( array( 'success' => false, 'message' => "Authorization failed" ) );
        exit("No naughty business please!  ,". $_POST['nonce']);
    }
    
    // ignore the request if the current user doesn't have sufficient permissions
    if ( !current_user_can( 'edit_posts' ) ) {
        echo json_encode( array( 'success' => false, 'message' => "Insufficient permissions" ) );
        exit("insufficient permissions ");
    }
    
    // get post id
    $post_id = $_POST['post_id'];
    $columns = $_POST['columns'];
    
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
        return $post_id;
	
	update_post_meta($post_id, "pt-data"     , $columns  );  
    
	$_POST['post_title'] = preg_replace("/[^a-zA-Z0-9\s]/", "", $_POST['post_title']);
	
	$wpdb->update( $wpdb->posts, 
					array( 	'post_title'  => $_POST['post_title'], 
							'post_status' => 'publish' ,
							'post_name'   => $post_id
						),
 					array( 'ID' => $post_id ) 
				 );
    
	// create and output the response
    $response = json_encode( array( 'success' => true, 'message' => __("All data saved", "default") ) );
    echo $response;
    
    exit;// IMPORTANT
	
}
add_action('wp_ajax_pt_data', 'axiom_save_pt_data');

/* Extract 2 Array -------------------------
 * --------------------------------------- */


?>