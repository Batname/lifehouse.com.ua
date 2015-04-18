<?php
/*==================================================================================================
  
    Add PageBuilder Metabox
 
 *=================================================================================================*/

/* Register PageBuilder Metabox  -----------------------
 * ----------------------------------------------------- */
 
function axiom_init_pagebuilder_meta_box(){
    // add custom sidebar metabox to following types
    $types = array('page', 'axi_product', 'portfolio', 'service', 'staff');
    
    foreach ($types as $key => $value) {
        add_meta_box("axiom_pagebuilder_metabox", 
                __("Smart Page Builder", 'default'), 
                "axiom_display_pagebuilder_meta", 
                $value, 
                "normal", 
                "high");
    }
    
    // Save custom sidebar meta
    add_action('save_post', 'axiom_save_pagebuilder_data');
    
}


/* Display PageBuilder -------------------------------
 * --------------------------------------------------- */

function axiom_display_pagebuilder_meta(){
    global $post;
    
    wp_nonce_field( basename( __FILE__ ), 'pagebuilder-nonce' ); 
    
    include 'templates.php';
    include 'builder-block.php';
?>
    
<?php
}
 
 
/* Save Data From PageBuilder Metabox ------------------
 * -----------------------------------------------------*/

function axiom_save_pagebuilder_data($post_id) {
    global $pb_meta_box;
    global $post;
    global $wpdb;
    
    // Verify the nonce before proceeding. 
    if ( !isset( $_POST['pagebuilder-nonce'] ) || !wp_verify_nonce( $_POST['pagebuilder-nonce'], basename( __FILE__ ) ) )
        return $post_id;
    
    // Get the post type object. 
    $post_type = get_post_type_object( $post->post_type );

    // Check if the current user has permission to edit the post. 
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) ){
        return $post_id;
    }
    
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    
    if ( isset( $_POST['axiom_pb_draft_data'] )){
        // save raw page builder data
        update_post_meta($post->ID, "axiom-pb-data", $_POST["axiom_pb_draft_data"] );  
        // conver page builder data to shortcodes
        $pb_shortcodes = axi_get_pagebuilder_shortcodes(json_decode($_POST["axiom_pb_draft_data"]));
        // save page builder shortcodes
        update_post_meta($post->ID, "axiom-pb-shortcode", $pb_shortcodes );
    } 
}
 
 
// Add pagebuilder meta box on init
add_action("admin_init", "axiom_init_pagebuilder_meta_box"); 

