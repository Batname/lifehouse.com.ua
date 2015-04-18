<?php

/*-----------------------------------------------------------------------------------*/
/*  Flex or Nivo Slider Shortcode for Page builder 
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'the_slider', 'axiom_shortcode_the_slider' );
add_shortcode( 'axi_slider', 'axiom_shortcode_the_slider' );

function axiom_shortcode_the_slider( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'size'    => '100', 
                'id'      => '',
                'title'   => '' 
            )
            , $atts ) 
          );
    
    if(!is_numeric($id)) return __("Invalid slider id", "default");
    
    $opts = get_post_meta($id, 'slider-data', true); 
    if(!is_array($opts))  return;
    
    $type = $opts["type"]; 

    ob_start();
?>
      
        <section class="widget-slider  <?php echo axiom_get_grid_name($size); ?>">
            
            <?php if(!empty($title))  echo get_widget_title($title, ""); 
            
                if($type == "flex"){
                    echo do_shortcode('[the_flexslider id="'.$id.'" ]');
                }elseif($type == "nivo"){
                    echo do_shortcode('[the_nivoslider id="'.$id.'" ]');
                }
            
            ?>
            
        </section><!-- end widget-audio -->
        
<?php    
    return ob_get_clean();
}


?>