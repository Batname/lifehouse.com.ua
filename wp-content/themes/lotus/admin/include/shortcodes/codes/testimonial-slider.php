<?php

/*-----------------------------------------------------------------------------------*/
/*  Testimonial Slider - a shortcode for sliding several testimonials
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'testimonial_slider', 'axiom_shortcode_testimonial_slider' );

function axiom_shortcode_testimonial_slider( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'size'      => '33',  // section size
                'title'     => '',    // section title
                'type'      => 'blockquote'
            )
            , $atts ) 
          );  
    
    ob_start();
?>
        
        <section class="widget-testimonial widget-container <?php if($type != 'blockquote') { echo 'max'; } ?> <?php echo axiom_get_grid_name($size); ?>">
            
            <?php if(!empty($title) || $type == 'blockquote') echo get_widget_title($title, "pagination"); ?>
            
            <div class="widget-inner testimonial_slider ">
                
                <?php echo do_shortcode($content); ?>
                
            </div>
            <?php if($type != 'blockquote'){ ?>
            <a class="arr_small_prev" href="#">&lt;</a>
            <a class="arr_small_next" href="#">&gt;</a>
            <?php } ?>
        </section>
        
<?php    
    return ob_get_clean();
}


?>