<?php

/*-----------------------------------------------------------------------------------*/
/*  Smart Page Builder
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'smartpagebuilder' , 'axiom_shortcode_smartpagebuilder' );
add_shortcode( 'spagebuilder'     , 'axiom_shortcode_smartpagebuilder' );

function axiom_shortcode_smartpagebuilder( $atts, $content = null ) {
    extract( shortcode_atts( 
            array( 
                'id'  => null  // page id , null means current page
            )
            , $atts ) 
          );   
    
    return get_the_smartpagebuilder_content($id);
}

?>