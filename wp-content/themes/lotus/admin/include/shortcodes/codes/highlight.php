<?php

/*-----------------------------------------------------------------------------------*/
/*  Highlight 
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'highlight', 'axiom_shortcode_highlight' );

function axiom_shortcode_highlight( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'color'             => '',
                'background_color'  => '',
                'style'             => 'yellow'
                 )
            , $atts ) 
          );
   
   if(empty($color) && empty($background_color)){
       switch ($style) {
           case 'yellow':
               $color = '#665B42';
               $background_color = '#FFF7A8';
               break;
           case 'blue':
               $color = '#5096B9';
               $background_color = '#E7F6FD';
               break;
           case 'green':
               $color = '#5D8F22';
               $background_color = '#EDFAE1';
               break;
           case 'red':
               $color = '#FFF4F4';
               $background_color = '#EC6A6A';
               break;
           case 'pink':
               $color = '#E46161';
               $background_color = '#FDEAEA';
               break;
           default:
               $color = '#665B42';
               $background_color = '#FFF7A8';
               break;
       }
   }
   
   return '<span class="" style="color:'.esc_attr($color).'; background-color:'.esc_attr($background_color).'" >' . do_shortcode($content) . '</span>';
}

?>