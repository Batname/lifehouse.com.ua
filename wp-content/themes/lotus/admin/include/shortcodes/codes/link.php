<?php

/*-----------------------------------------------------------------------------------*/
/*  Link 
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'link', 'axiom_shortcode_link' );

function axiom_shortcode_link( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'url'     => '', 
                'target'  => '_self',
                'title'   => '' 
            )
            , $atts ) 
          );  
   return '<a href="'.esc_attr($url).'" title="'.esc_attr($title).'" target="'.esc_attr($target).'" >' . do_shortcode($content) . '</a>';
}

?>