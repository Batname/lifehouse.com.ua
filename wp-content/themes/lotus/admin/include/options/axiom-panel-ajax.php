<?php
/**
 * Option panel ajax handler
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */

function axiom_save_panel_options_to_db() {
    global $axiom_options;
    
	header( "Content-Type: application/json" );
	
	// verify nonce
	if ( !wp_verify_nonce( $_POST['nonce'], "axiom-optp-nonce") ) {
		echo json_encode( array( 'success' => false, 'message' => __("Authorization failed", "default") ) );
		exit("No naughty business please  ,". $_POST['nonce']);
	}
	
	// ignore the request if the current user doesn't have sufficient permissions
    if ( !current_user_can( 'edit_posts' ) ) {
    	echo json_encode( array( 'success' => false, 'message' => __("Insufficient permissions", "default") ) );
    	exit("insufficient permissions ");
	}	
	
	
    if(isset($_POST['sidebar']) && ($_POST['type'] !== 'reset') )
        update_option( THEME_ID.'_sidebars', $_POST['sidebar']);
    
    
    if(isset($_POST['options'])){
        // save raw options
        update_option( THEME_ID.'_options' , $_POST['options']);
        // update current in use theme options
        $axiom_options = format_axiom_options( $_POST['options']);
        // save formatted/usable options
        update_option( THEME_ID.'_formatted_options' , $axiom_options);
    } else {
        axiom_reset_theme_options();
    }
    
    
    // update css styles
    axi_save_custom_styles();
    
	// create and output the response
	if($_POST['type'] == 'reset')
		$response = json_encode( array( 'success' => true, 'type' => 'reset', 'message' => __("All options are reseted", "default") ) );
	else 
		$response = json_encode( array( 'success' => true, 'type' => 'save' , 'message' => __("All options updated", "default")     ) );
    echo $response;
	
    exit;// IMPORTANT
}

add_action('wp_ajax_axiom_options', 'axiom_save_panel_options_to_db');







function axiom_import_options_to_db() {
    global $axiom_options;
    
    header( "Content-Type: application/json" );
    
    // verify nonce
    if ( !wp_verify_nonce( $_POST['nonce'], "axiom-optp-nonce") ) {
        echo json_encode( array( 'success' => false, 'message' => __("Authorization failed", "default") ) );
        exit("No naughty business please  ,". $_POST['nonce']);
    }
    
    // ignore the request if the current user doesn't have sufficient permissions
    if ( !current_user_can( 'edit_posts' ) ) {
        echo json_encode( array( 'success' => false, 'message' => __("Insufficient permissions", "default") ) );
        exit("insufficient permissions ");
    }   
    
    $import_data = $_POST['options'];
    
    
    if(isset($import_data) && !empty($import_data)){
        
        $import_data = base64_decode($import_data);
        $import_data = unserialize($import_data);
        
        update_option( THEME_ID.'_options' , $import_data);
        // update current in use theme options
        $axiom_options = format_axiom_options( $import_data);
    }
    
    // update css styles
    axi_save_custom_styles();
    
    // create and output the response
    $response = json_encode( array( 'success' => true, 'message' => __("All options Imported", "default")     ) );
    echo $response;
    
    exit;// IMPORTANT
}

add_action('wp_ajax_axiom_import_ops', 'axiom_import_options_to_db');



?>