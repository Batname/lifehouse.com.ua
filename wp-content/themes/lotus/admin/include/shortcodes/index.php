<?php

add_filter('widget_text', 'do_shortcode');

add_filter( 'the_excerpt', 'do_shortcode');


/*-----------------------------------------------------------------------------------*/
/*  Add Shortcodes
/*-----------------------------------------------------------------------------------*/
include_once( ADMIN_INC.'shortcodes/shortcodes.php');

/*-----------------------------------------------------------------------------------*/
/*  Init shortcode manager
/*-----------------------------------------------------------------------------------*/
include_once( ADMIN_INC.'shortcodes/manager.php');

?>