<?php

/*-----------------------------------------------------------------------------------*/
/*  Column
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'col' , 'axiom_shortcode_grid'  );
add_shortcode( 'grid', 'axiom_shortcode_grid' );

function axiom_shortcode_grid( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'size'      => '33', // section size
            )
            , $atts ) 
          );
    
    ob_start();
?>
      
        <div class="  <?php echo axiom_get_grid_name($size); ?>">
            
            <?php echo do_shortcode($content); ?>
            
        </div><!-- widget-container -->
        
<?php    
    return ob_get_clean();
}

?>