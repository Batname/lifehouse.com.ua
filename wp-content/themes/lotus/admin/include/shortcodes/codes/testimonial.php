<?php

/*-----------------------------------------------------------------------------------*/
/*  Testimonial
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'testimonial', 'axiom_shortcode_testimonial' );
add_shortcode( 'axi_testimonial', 'axiom_shortcode_testimonial' );

function axiom_shortcode_testimonial( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'size'      => '100',  // section size
                'title'     => '',    // section title
                'author'    => '',
                'avatar'    => '',
                'role'      => '',
                'link'      => '',
                'type'      => 'blockquote'
            )
            , $atts ) 
          );  
    
    ob_start();
?>
        
        <section class="widget-testimonial widget-container <?php if($type != 'blockquote') { echo 'max'; } ?> <?php echo axiom_get_grid_name($size); ?>">
            
            <?php if(!empty($title))  echo get_widget_title($title, ""); ?>
            
            <?php 
                $attr  = ' author="'.$author.'" avatar="'.$avatar.'" role="'.$role.'" link="'.$link.'"  '; 
            ?>
            
            <div class="widget-inner">
                <?php echo do_shortcode('[testimonial_item '.$attr.' ]'.$content.'[/testimonial_item]'); ?>
            </div>
            
        </section>
        
<?php    
    return ob_get_clean();
}


?>