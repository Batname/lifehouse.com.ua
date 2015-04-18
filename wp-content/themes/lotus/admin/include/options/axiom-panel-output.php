<?php

/**
 * Outputs option panel
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */

 
function axiom_init_options(){
    global $axiom_options;
    
	$tabs_output  = '';
	$fiels_output = '';
	
	// create nonce for use on ajax requests - (a security layer)
	$nonce = wp_create_nonce("axiom-optp-nonce");
	
	// Includes all defined options
	include ADMIN_INC.'options/axiom-options.php';
	
	// Loops through all options, and creates and stores fields and tabs in $fiels_output & $tabs_output
	include ADMIN_INC.'options/axiom-options-factory.php';
	
	// outputs option panel skeleton
?>
			<div class="av3_container" style="margin-top:30px;width:95%;">
				
				<div class="panel_brand">
				    <img src="<?php echo ADMIN_URL. 'images/brands/op_logo.png'; ?>" title="<?php echo 'Axiom'.' V'.AXIOM_VERSION; ?>" />
				</div>
				
				<div class="av3_option_panel clearfix">
					<form class="axiom_options_form" method="get" enctype="multipart/form-data" data-nonce="<?php echo $nonce;?>" >
						
						<div class="actions_control_bar clearfix">
							<div class="right">
               					<a href="#" class="button blue axiom_opt_panel_save_all_btn" style="float:right;margin-top:0;" ><?php _e('Save All Options', 'default'); ?></a>
               					<img class="ajax-loading" src="<?php echo ADMIN_URL ;?>images/other/wpspin_light.gif" style="padding:8px 10px;" alt />
							</div>
						</div>
						
						<div class="actions_control_bar op_float_save clearfix">
                            <div class="right">
                                <a href="#" class="button blue axiom_opt_panel_save_all_btn" style="float:right;margin-top:0;" ><?php _e('Save All Options', 'default'); ?></a>
                                <img class="ajax-loading" src="<?php echo ADMIN_URL ;?>images/other/wpspin_light.gif" style="padding:8px 10px;" alt />
                            </div>
                        </div>
						
						<ul class="tabs">
							<?php /* outputs main tab menus */ ?>
							<?php echo $tabs_output; ?>
						</ul>
						
						<ul class="tabs-content">
							<?php /* outputs sections content */ ?>
							<?php echo $fields_output; ?>
						</ul>	
						
						<div class="actions_control_bar last_bar clearfix">
               				<div class="right" style="width:200px;">
               					<a href="#" class="button blue axiom_opt_panel_save_all_btn" style="float:right;margin-top:0;" ><?php _e('Save All Options', 'default'); ?></a>
               					<img class="ajax-loading" src="<?php echo ADMIN_URL ;?>images/other/wpspin_light.gif" style="padding:8px 10px;" alt />
							</div>
               				<a href="#" class="button black axiom_opt_panel_reset_all" style="margin-top:0;"><?php _e('Reset all options', 'default'); ?></a>
						</div>
						
					</form>
				</div>
				
			</div>
<?php
}

?>