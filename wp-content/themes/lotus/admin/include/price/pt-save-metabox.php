<?php
/**
 * Adds Save meta box
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */

 /* Add Save meta box. -------------------------------
 * --------------------------------------------------- */

function axiom_pt_save_meta_box() {
	// remove common submitbox
	remove_meta_box( 'submitdiv' , 'pricetable' , 'core' );
    // disable autosave
    wp_dequeue_script('autosave');
	
	add_meta_box("av3_privetable_save_meta", 
				__("Save", 'default'), 
				"axiom_pt_display_save_meta", 
				"pricetable", 
				"normal", 
				"core");		
}  

/* Display the save meta box. ------------------------
 * --------------------------------------------------- */

function axiom_pt_display_save_meta(){
	global $post;
?>
	<div id="save_box" class="av3_container clearfix">
	    <div class="misc-pub-section" style="padding:0 .5em 0 .5em;">
          <a class="button save_slides blue"><?php _e('Save' ,'default' ); ?></a>
          <img alt="" id="ajax-loading" class="ajax-loading" src="http://127.0.0.1/www/wordpress/en/wp-admin/images/wpspin_light.gif">
          <span id="update_status" class="inuse" ><?php _e('Do not forget to save changes', 'default'); ?></span>
        </div>
		<div class="misc-pub-section" style="padding:0 0.5em 0 .5em;">
			<a class="button preview_post blue" href="<?php echo get_permalink($post->ID); ?>" target="_blank"><?php _e('Preview' ,'default' ); ?></a>
			<span class="msg_text"><?php _e('Save, to see latest changes', 'default'); ?></span>
		</div>
	</div>
<?php
} 

// Add Save meta boxe
add_action("admin_init", "axiom_pt_save_meta_box"); 
?>