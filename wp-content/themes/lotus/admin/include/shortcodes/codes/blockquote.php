<?php 

/*-----------------------------------------------------------------------------------*/
/*  Blockquote 
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'blockquote', 'axiom_shortcode_blockquote' );

function axiom_shortcode_blockquote( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'indent'      => 'yes',
                
            )
            , $atts ) 
          );  
   
   $indent = ($indent == "yes")?'<i></i>':'';
   return '<blockquote>'.$indent.'<p>'.axiom_do_cleanup_shortcode($content).'</p></blockquote>';
}

?>