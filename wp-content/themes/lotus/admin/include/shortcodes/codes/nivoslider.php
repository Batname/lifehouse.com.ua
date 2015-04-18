<?php

/*-----------------------------------------------------------------------------------*/
/*  NivoSlider
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'nivoslider', 'axiom_shortcode_nivoslider' );

function axiom_shortcode_nivoslider( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'class'     => 'circle-style',  // a class that adds to wrapper for styling slider
                'margin'    => '0',  
                'maxheight' => '',
                'arrows'    => 'yes',
                'random'    =>  'no',
                'nav_type'  => 'bullet',
                'pause_on_hover' => 'yes',
                'loop'      => 'yes',
                'animation_speed'=> '600',
                'show_time' => '6000',
                'effect'    => 'random',
                'box_cols'  => 8,
                'box_rows'  => 4,
                'slices'    => 15
            )
            , $atts ) 
          );  
          
    if(empty($content)) return;
    
    // create an unique id for slider
    $uid            = uniqid("axi");
    //$margin         = ($margin > 0)?'style="margin:'.$margin.'px"':"";
    $maxheight      = (!empty($maxheight) && $maxheight > 0 )?'style="max-height:'.$maxheight.'px"':"none";
    $nav_type       = ($nav_type == "bullet")?"true":"false";
    $pause_on_hover = ($pause_on_hover == "yes")?"true":"false";
    $loop           = ($loop == "yes")?"true":"false";
    $slideshow      = (isset($slideshow) && $slideshow == "yes")?"true":"false";
    $arrows         = ($arrows == "yes")?"true":"false";
    $random         = ($random == "yes")?"true":"false";
    
    // load nivoslider script
    wp_enqueue_script("nivoslider");
    wp_enqueue_style ('nivoslider');
    
    ob_start();
?>
            
            
            <section class="nivo-container <?php echo $class; ?>" >
                <div id="<?php echo $uid; ?>" class="nivoSlider" <?php echo $maxheight; ?> >
                    
                    <?php // store all slides captions
                        $GLOBALS["ax_nivo_captions"] = array(); 
                        
                        // generate all nivoslide shortcodes
                        echo axiom_do_cleanup_shortcode($content); 
                    ?>
                    
                </div><!-- nivoslider -->
                
                <?php 
                // generate all nivo slider captions
                    if( is_array( $GLOBALS['ax_nivo_captions'] ) ){
                        foreach ($GLOBALS["ax_nivo_captions"] as $id => $slide) {
                            if(empty($slide)) continue;
                            echo  '<div id="'.$id.'" class="nivo-html-caption">',
                                  $slide,
                                  '</div>';
                        }
                    }
                ?>
                
            </section><!-- slider wrapper -->
            
            <script>
                jQuery(function(){
                    
                    jQuery('#<?php echo $uid; ?>').nivoSlider({
        
                        effect: "<?php echo $effect; ?>", 
                        slices:  <?php echo $slices; ?>,
                        boxCols: <?php echo $box_cols; ?>,
                        boxRows: <?php echo $box_rows; ?>,
                        animSpeed:    <?php echo $animation_speed; ?>,
                        pauseTime:    <?php echo $show_time; ?>, 
                        directionNav: <?php echo $arrows; ?>,
                        controlNav:   <?php echo $nav_type; ?>,
                        pauseOnHover: <?php echo $pause_on_hover; ?>,
                        randomStart : <?php echo $random; ?>
                    });
                
                });
            </script>

        
<?php    
    return ob_get_clean();
}





/*-----------------------------------------------------------------------------------*/
/*  Nivo Slide
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'nivo_slide', 'axiom_shortcode_nivo_slide' );


function axiom_shortcode_nivo_slide( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'src'       => '',
                'link'      => '',
                'target'    => '_blank',
                'transition'=> ''
            )
            , $atts ) 
          ); 
          
    $cap_id  = uniqid("axi");
    $GLOBALS['ax_nivo_captions'][$cap_id] = do_shortcode($content);
    $title   = empty($content)?"":'#'.$cap_id;
    
    $output  = '';
    $trans_attr = (!empty($transition) )?' data-transition="'.$transition.'" ':' ';
    
    $output .= (!empty($link))?'<a href="'.$link.'" target="'.$target.'" >':'';
    $output .= '<img src="'.$src.'" alt="" title="'.$title.'" '.$trans_attr.' />';
    $output .= (!empty($link))?'</a>':'';
    
    return $output;
}


?>