<?php

/*-----------------------------------------------------------------------------------*/
/*  Tab
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'chart', 'axiom_shortcode_chart' );

function axiom_shortcode_chart( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'size'      =>  50, // section size
                'title'     => '' // section title
            )
            , $atts ) 
          );    
    
    wp_enqueue_script ('jq_easing');
    
    ob_start();
?>
        
        <section class="widget-chart widget-container <?php echo axiom_get_grid_name($size); ?>">
            
        <?php if(!empty($title))  echo get_widget_title($title, ""); ?>
            
            <div class="widget-inner">
                
                <?php echo do_shortcode($content); ?>
                 
            </div><!-- widget-inner -->
            
       </section><!-- widget-tabs -->
        
<?php    
    return ob_get_clean();
}

/* tab element -------------------------*/

add_shortcode( 'chart_bar', 'axiom_shortcode_chart_bar' );

function axiom_shortcode_chart_bar( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'percent'     => '50' // bar width percent (0 - 100)
            )
            , $atts ) 
          );    
          
    return '<div class="chart-bar"><div style="width:'.$percent.'%"><span>'.$content.'<em>'.$percent.'</em>%</span></div></div>';
}


?>