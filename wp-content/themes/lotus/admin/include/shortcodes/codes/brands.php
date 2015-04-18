<?php

/*-----------------------------------------------------------------------------------*/
/*  Brands
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'brands', 'axiom_shortcode_brands' );

function axiom_shortcode_brands( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'size'         =>  50, // section size
                'title'        =>  '', // section title
                'display_type' =>  '',  // default is side by side images
                'auto_play'    =>  'no'
            )
            , $atts ) 
          );   
     
    // if type is slider use carousel shortcode
    // the "$content" is [carouset_item]
    if($display_type == 'slider'){
        return do_shortcode('[carousel size="'.$size.'" title="'.$title.'"  wrapper_class="wrapper_brands" auto_play="'.$auto_play.'" ]'.$content.'[/carousel]'); 
    }
    
    // else display images side by side
    ob_start();
?>
        
        <section class="widget-container widget-brands <?php echo axiom_get_grid_name($size); ?>">
            
        <?php if(!empty($title))  echo get_widget_title($title, ""); ?>
            
            <div class="wrapper_brands" >
                <ul >
                    <?php echo do_shortcode($content); ?>
                </ul>
            </div>
            
       </section><!-- widget-container -->
        
<?php    
    return ob_get_clean();
}

?>