<?php

/*-----------------------------------------------------------------------------------*/
/*  Dropcap 
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'dropcap', 'axiom_shortcode_dropcap' );

function axiom_shortcode_dropcap( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'round'             => 'yes',
                'type'              => 'square',
                'color'             => '#f5f5f5',
                'background_color'  => '#4583b3'
                 )
            , $atts ) 
          );
   $round = ($round == 'yes' || $round === true)?'round':'';
   
   return '<div class="dropcap '.esc_attr($type).' '.esc_attr($round).' " style="color:'.$color.';background-color:'.$background_color.';" >' . do_shortcode($content) . '</div>';
}

?>