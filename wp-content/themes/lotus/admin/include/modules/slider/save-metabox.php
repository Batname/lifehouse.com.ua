<?php
/**
 * Adds slider save button meta box
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */

 /* Add slider's save meta box. -----------------------
 * --------------------------------------------------- */

function axiom_slider_save_meta_box() {
	
	remove_meta_box( 'submitdiv' , 'slider' , 'core' );
	
	add_meta_box("av3_slider_save_meta", 
				__("Save", 'default'), 
				"axiom_slider_display_save_meta", 
				"Slider", 
				"normal", 
				"core");		
}  

/* Display the slider save meta box. -----------------
 * --------------------------------------------------- */

function axiom_slider_display_save_meta(){
	global $post;
?>
	<div id="save_box" class="av3_container clearfix">
	    <div class="misc-pub-section" style="padding:0 1.5em 0 0;">
          <a class="button save_slides blue"><?php _e('Save' ,'default' ); ?></a>
          <img alt="" id="ajax-loading" class="ajax-loading" src="http://127.0.0.1/www/wordpress/en/wp-admin/images/wpspin_light.gif">
          <span id="update_status" class="inuse" >Do not forget to save changes</span>
        </div>
		<div class="misc-pub-section" style="padding:0;">
			<a class="button preview_post blue" href="<?php echo get_permalink($post->ID); ?>" target="_blank"><?php _e('Preview' ,'default' ); ?></a>
			<span class="msg_text">Save, to see latest changes</span>
		</div>
	</div>
<?php
} 

// Add slider save meta boxe
add_action("admin_init", "axiom_slider_save_meta_box"); 
?>