<?php

/*-----------------------------------------------------------------------------------*/
/*  Divider
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'divider', 'axiom_shortcode_divider' );

function axiom_shortcode_divider( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'size'     => '', // section size
                'style'    => '', // solid,dotted,dashed,bar,space
                'btn_label'=> '', // go to top button text
                'height'   => '40px'
            )
            , $atts ) 
          );  
    
    $s_height  = '';
    $margin    = '';
    
    $style = ($style == "")?"solid":$style;
    
    if(!empty($height)){
       $height = str_replace("px", "", $height);
       $height = (int)$height;
       // style for height of white space
       $s_height = ' style="height:'.$height.'px;" ';
       // style for space around line type dividers
       $margin_side = floor($height / 2);
       $margin   = ' style="margin-top:'.$margin_side.'px; margin-bottom:'.$margin_side.'px;" ';
    }
    
    $output = "";
    $size   = (!empty($size))?' '.axiom_get_grid_name($size):"";
    
    if($style == "dotted" || $style == "dashed" || $style == "solid") {
        // if goto top button is enabled
        if(!empty($btn_label)){
            $output = '<div class="divider  '.$style.$size.'" '.$margin.' ><span class="scroll2top" data-autofade="false" >'.$btn_label.'</span></div>';
        }else{
            $output = '<hr class="'.$style.$size.'" '.$margin.' >';
        }
        
    }elseif($style == "bar"){
        $output = '<div class="sep hbar'.$size.'" '.$s_height.' ></div>';
    }elseif($style == "space"){
        $output = '<div class="sep space'.$size.'" '.$s_height.' ></div>';
    }
     
    return $output;
}

?>