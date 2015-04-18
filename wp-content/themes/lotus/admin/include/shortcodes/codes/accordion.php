<?php

/*-----------------------------------------------------------------------------------*/
/*  Accordion & Toggle
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'accordion', 'axiom_shortcode_accordion' );

function axiom_shortcode_accordion( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'size'      =>  '', // section size
                'type'      => 'accordion', // toggle or accordion
                'title'     => '' // section title
            )
            , $atts ) 
          );    
    
    $uid = uniqid("axi_acc");
    
    // load accordion js script
    wp_enqueue_script('axi.accordion');
    
    ob_start();
?>
        
        <section id="<?php echo $uid; ?>" class="widget-toggle widget-container <?php echo axiom_get_grid_name($size); ?>">
            
            <?php if(!empty($title))  echo get_widget_title($title, ""); ?>

            <div class="widget-inner">
                
                <?php echo do_shortcode($content); // accepts [acc_element] for each tab item ?>
               
            </div><!-- widget-inner -->
            
        </section><!-- widget-container -->
        
        <script>
            jQuery(function($){
                $ = jQuery.noConflict();
                $('#<?php echo $uid; ?>')
                    .avertaAccordion({ 
                        items:'section',
                        itemHeader : '.toggle-header',
                        itemContent: '.toggle-content',
                        oneVisible : <?php echo ($type == 'accordion')?1:0; ?>, 
                        showEase   :'easeOutQuad',
                        onCollapse : function($items){ $items.find('.toggle-header i').text('+'); } ,
                        onExpand   : function($items){ $items.find('.toggle-header i').text('-'); }
                });    
            });
        </script>
        
<?php    
    return ob_get_clean();
}



/* accordion tab element ------------------------------------------------------------*/

add_shortcode( 'acc_element', 'axiom_shortcode_acc_element' );


function axiom_shortcode_acc_element( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'title'     => '' // tab label
            )
            , $atts ) 
          );    
    
    ob_start();
?>

        <section>
            <h6  class="toggle-header"><i>-</i><?php echo axiom_cleanup_content($title); ?></h6>
            <div class="toggle-content">
                <p><?php echo do_shortcode($content); ?></p>
            </div>
        </section>
        
<?php    
    return ob_get_clean();
}



?>