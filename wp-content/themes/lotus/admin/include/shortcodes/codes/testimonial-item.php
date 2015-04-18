<?php

/*-----------------------------------------------------------------------------------*/
/*  Testimonial item - this shortcode outputs speech div for using in testimonial and testimonial_slider
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'testimonial_item', 'axiom_shortcode_testimonial_item' );

function axiom_shortcode_testimonial_item( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
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

                <div class="testimonial-speech">
                    <blockquote>
                        <?php if(!empty($avatar) && ($type == 'blockquote')){ ?>
                        <img src="<?php echo $avatar; ?>" />
                        <?php } ?>
                        <i></i>
                        <p><?php echo do_shortcode($content); ?></p>
                    </blockquote>
                    <div class="testimonial-author"><div> </div>
                        <?php if(!empty($author)) { echo '<em>'.$author.'</em>'; } 
                        if(!empty($role)) { echo '<a href="'.$link.'">'.$role.'</a>'; }
                        ?>
                    </div>
                </div>
        
<?php    
    return ob_get_clean();
}


?>