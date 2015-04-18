<?php
/**
 * Creates and outputs slider setting block
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
 
/* Add Slider's setting meta box. -----------------------
 * --------------------------------------------------- */
 
function axiom_slider_init_setting_meta_box(){
	add_meta_box("axiom_slider_setting_meta", 
				__("Slider's Setting", 'default'), 
				"axiom_Slider_display_setting_meta", 
				"slider", 
				"normal", 
				"low");		
}  

/* Display the Slider SETTING meta box. -----------------
 * --------------------------------------------------- */

function axiom_Slider_display_setting_meta(){
	global $post;
    
    $slider_data = get_post_meta( $post->ID, 'slider-data', true ) ;
    $nonce       = wp_create_nonce("slider-data-nonce");

    include 'templates-slider.php';
?>
<script type="text/javascript">
    var slider_nonce = "<?php echo $nonce; ?>";
    var slider_id    = "<?php echo $post->ID; ?>";
    var sliderData   =  <?php echo json_encode($slider_data); ?>;
    console.log(sliderData);
</script>          
				<div class="av3_container">
                            
                    <div id="axiom_slidermgr">
                        <div class="slidermgr_inner">
                            
                            <div class="settingWrapper" data-bind="template:{name:'temp_general', data:general}">
                            </div>
                            
                            <div class="settingWrapper">
                                <strong class="s_type"><?php _e('Slider Type', 'default'). ':'; ?></strong>
                                <select class="s_type_selector" data-bind="value:type">
                                    <option value="none"><?php _e('Select ..', 'default'). ':'; ?></option>
                                    <option value="nivo"><?php _e('Nivo Slider', 'default'). ':'; ?></option>
                                    <option value="flex"><?php _e('Flex Slider', 'default'). ':'; ?></option>
                                </select>
                            </div>
                            
                            <div class="settingWrapper" data-bind="template:{name:tempName(), data:slider, 'if':slider, afterRender:addTooltip }" >
                            </div>
                            
                            <hr class="both" />

                            <div class="slidesWrapper" data-bind="template:{name:'temp_slide', foreach:slides, afterAdd:onNewSlideAdded, beforeRemove:onSlideRemove}, sortable:slides, visible:slidesVisibilty" >
                            </div><!-- end of slides wrapper -->
                            
                            <input type="button" data-bind="click:addNewSlide, visible:slidesVisibilty" class="button blue addnew" value="<?php _e('+ Add new Slide', 'default'); ?>" />
                        </div>
                    </div>
                    
                </div>
	
<?php
	unset($slider_data);
} 

// Add Slider setting meta boxe
add_action("admin_init", "axiom_slider_init_setting_meta_box"); 

?>