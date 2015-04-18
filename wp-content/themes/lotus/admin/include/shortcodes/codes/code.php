<?php

/*-----------------------------------------------------------------------------------*/
/*  Button 
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'code'         , 'axiom_shortcode_highlight_code' );
add_shortcode( 'axiom_code'   , 'axiom_shortcode_highlight_code' );

function axiom_shortcode_highlight_code( $atts, $content = null ) {
   
   wp_enqueue_script('highlightjs');
   wp_enqueue_style ('highlightjs');
   
   return '<code>' . do_shortcode($content) . '</code>';
}

?>