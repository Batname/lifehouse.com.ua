<?php

/*-----------------------------------------------------------------------------------*/
/*  Button 
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'button', 'axiom_shortcode_button' );
add_shortcode( 'btn'   , 'axiom_shortcode_button' );

function axiom_shortcode_button( $atts, $content = null ) {
    extract( shortcode_atts( 
            array( 
                'round'             => 'yes',
                'size'              => 'normal',
                'color'             => 'white',
                'flat'              => 'no',
                'link'              => '',
                'target'            => '_self'
                 )
            , $atts ) 
          );
    
    $flat = strtolower($flat);
    $flat = ($flat == 'yes' || $flat === true)?'flat':'';
    $size = ($size == 'big') ?'large':$size;
    $size = ($size == 'gray')?'grey' :$size;
    
    $color = strtolower($color);
    if(!($color == 'white' || $color == 'grey' || $color == 'yellow' || $color == 'orange' || 
         $color == 'green' || $color == 'red'  || $color == 'blue'   || $color == 'black'  || $color == 'night'))
    {
        $color = 'white';
    }
    
    $size = strtolower($size);
    if(!($size == 'normal' || $size == 'small' || $size == 'tiny' || $size == 'large' ))
    {
        $size = 'normal';
    }
   
   return '<a href="'.esc_attr($link).'" target="'.esc_attr($target).'" class="button '.esc_attr($size).' '.esc_attr($color).' '.esc_attr($flat).' ">' . axiom_do_cleanup_shortcode($content) . '</a>';
}

?>