<?php 

/*-----------------------------------------------------------------------------------*/
/*  Add Page Builder
/*-----------------------------------------------------------------------------------*/
include( ADMIN_INC.'modules/builder/index.php');

/*-----------------------------------------------------------------------------------*/
/*  Add Image Resize
/*-----------------------------------------------------------------------------------*/
require_once( ADMIN_INC.'modules/lib/aq_resizer.php');

/*-----------------------------------------------------------------------------------*/
/*  Include update notifier
/*-----------------------------------------------------------------------------------*/
require_once( ADMIN_INC.'modules/lib/update-notifier.php');

/*-----------------------------------------------------------------------------------*/
/*  Add Layer Slider
/*-----------------------------------------------------------------------------------*/

// Path for LayerSlider WP main PHP file
$layerslider = ADMIN_INC . 'modules/LayerSlider/layerslider.php';
 
// Check if the file is available to prevent warnings
if(file_exists($layerslider)) {
 
    // Include the file
    include $layerslider;
 
    // Activate the plugin if necessary
    if(get_option(THEME_ID . '_layerslider_activated', '0') == '0') {
 
        // Run activation script
        layerslider_activation_scripts();
 
        // Save a flag that it is activated, so this won't run again
        update_option(THEME_ID . '_layerslider_activated', '1');
    }
}

$GLOBALS['lsPluginPath']    = ADMIN_INC_URL . 'modules/LayerSlider/';
$GLOBALS['lsAutoUpdateBox'] = false;
 
// Activation hook for creating the initial DB table
register_activation_hook(__FILE__, 'layerslider_activation_scripts');
 
    // Run activation scripts when adding new sites to a multisite installation
add_action('wpmu_new_blog', 'layerslider_new_site');


/*-----------------------------------------------------------------------------------*/
/*  Add Cute Slider
/*-----------------------------------------------------------------------------------*/


// Path for Cute Slider WP main PHP file
$cuteslider = ADMIN_INC . 'modules/CuteSlider/cuteslider.php';
 
// Check if the file is available to prevent warnings
if(file_exists($cuteslider)) {
 
    // Include the file
    include $cuteslider;
 
    // Activate the plugin if necessary
    if(get_option(THEME_ID . '_cuteslider_activated', '0') == '0') {
 
        // Run activation script
        cuteslider_activation_scripts();
 
        // Save a flag that it is activated, so this won't run again
        update_option(THEME_ID . '_cuteslider_activated', '1');
    }
}

$GLOBALS['csPluginVersion'] = '1.1.0';
$GLOBALS['csPluginPath'] = ADMIN_INC_URL . 'modules/CuteSlider';
 
// Activation hook for creating the initial DB table
register_activation_hook(__FILE__, 'cuteslider_activation_scripts');

?>
