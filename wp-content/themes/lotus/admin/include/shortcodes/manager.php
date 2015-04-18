<?php

function axion_init_shortcode_manager(){
    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;
    
     add_filter('mce_external_plugins'  , 'axiom_edit_mce_plugins');     // for registering tinyMCE plugin
     // note: mce_buttons_x , x is the row number for displaying buttons
     add_filter('mce_buttons_3'         , 'axiom_register_mce_buttons'); // for adding a tinyMCE button
}

add_action("init", "axion_init_shortcode_manager");

// register axiom shortcode buttons
function axiom_register_mce_buttons($buttons){
    array_push($buttons, "dropcap", "quote", "button", "column", "divider", "highlight", "msgbox", "tabs", "testimonial", "vimeo", "utube", "video");
    return $buttons;
}

// get script of axiom shortcode buttons
function axiom_edit_mce_plugins($plugins){
    $plugins["axiom"] = ADMIN_INC_URL."shortcodes/assets/js/tinymce/plugins/axiom-btns.js";
    return $plugins;
}

/*-----------------------------------------------------------------------------------*/
/*  Add Editor styles
/*-----------------------------------------------------------------------------------*/

function axiom_register_mce_buttons_style(){
    wp_register_style('axiom_mce_buttons'  , ADMIN_INC_URL. 'shortcodes/assets/css/editor.css', NULL, '1.1');
    wp_enqueue_style('axiom_mce_buttons');
}
add_action('admin_enqueue_scripts', 'axiom_register_mce_buttons_style');

?>