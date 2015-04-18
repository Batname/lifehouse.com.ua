<?php

/*-----------------------------------------------------------------------------------*/
/*  Carousel
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'carousel', 'axiom_shortcode_carousel' );

function axiom_shortcode_carousel( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'size'      =>  '', // section size
                'title'     =>  '', // section title
                'list_class'=>  '', // a custom class for carousel list
                'wrapper_class'=>  '', // a custom class for carousel list
                'auto_play' => 'no'
            )
            , $atts ) 
          );    
    
    ob_start();
?>
        
        <section class="widget-container <?php echo axiom_get_grid_name($size); ?>">
            
        <?php if(!empty($title))  echo get_widget_title($title, ""); ?>
            
            <div class="wrapper_carousel <?php echo $wrapper_class; ?>" data-autoplay="<?php echo $auto_play; ?>" >
                <ul class="carousel_list <?php echo $list_class; ?>">
                    <?php echo do_shortcode($content); ?>
                </ul>
                <a class="arr_small_prev" href="#">&lt;</a>
                <a class="arr_small_next" href="#">&gt;</a>
            </div>
            
       </section><!-- widget-container -->
        
<?php    
    return ob_get_clean();
}

/* carousel item -------------------------*/

add_shortcode( 'carousel_item', 'axiom_shortcode_carousel_item' );

function axiom_shortcode_carousel_item( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'link'     => '' // link on carousel element
            )
            , $atts ) 
          );    
    $output = do_shortcode('[list_item link="'.$link.'" ]'.do_shortcode($content).'[/list_item]');
         
    return $output;
}


?>