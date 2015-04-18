<?php

/*-----------------------------------------------------------------------------------*/
/*  Get FlexSlider
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'the_flexslider', 'axiom_shortcode_the_flexslider' );


function axiom_shortcode_the_flexslider( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'id'       => '',
            )
            , $atts ) 
          ); 
    
    if(!is_numeric($id)) return "invalid slider id";
    
    $attrs = ""; // stores slider attrs
    $slide_shortcodes = ""; // stores slides shortcode
    
    $args = array(
      'page_id' => $id,
      'post_type' => 'slider'
    );
    
    // -----------------------------------------------------------------
    
    $th_query = null;
    $th_query = new WP_Query($args);  

    // We need a process to check if there is just one image available. so no slider is needed
    $live_img_url = ""; // stores one available image url
    $imageNums    = 0 ; // stores the number of available images
    
    if( $th_query->have_posts() ):  while ($th_query->have_posts()) : $th_query->the_post();
        
        $data    = get_post_meta($th_query->post->ID, 'slider-data', true); 
        // slider general options
        $general = $data["general"];
        //flex slider options
        $flex    = $data["flex"];
        // get all slide objects
        $slides  = json_decode($data["slides"]);
        
        // write shortcode attrs
        $attrs .= ' maxheight="'.$general["height"].'" ';
        $attrs .= ' margin="'.$general["spacing"].'" ';
        $attrs .= ' random="'.$general["random" ].'" ';
        
        $attrs .= ' arrows="'.$flex["showArrows" ].'" ';
        $attrs .= ' nav_type="'.$flex["controlType" ].'" ';
        $attrs .= ' pause_on_hover="'.$flex["pauseOnHover" ].'" ';
        $attrs .= ' loop="'.$flex["loop" ].'" ';
        $attrs .= ' smooth_height="'.$flex["smoothHeight" ].'" ';
        $attrs .= ' slideshow="'.$flex["slideshow" ].'" ';
        $attrs .= ' animation_speed="'.$flex["tranSpeed" ].'" ';
        $attrs .= ' show_time="'.$flex["showTime" ].'" ';
        $attrs .= ' effect="'.$flex["effect" ].'" ';
        $attrs .= ' easing="'.$flex["easing" ].'" ';
        
        // generate all slides shortcode
        foreach ($slides as $slide) {
            
            if(!empty($slide->imageURL)) {
                $imageNums++;
                $live_img_url      = $slide->imageURL;
                $slide_shortcodes .= '[simple_slide src="'.$slide->imageURL.'" link="'.$slide->link.'" target="'.$slide->target.'" ]'.$slide->caption.'[/simple_slide]';
            }
            
        }
        
    endwhile; endif;
    wp_reset_query();
    
    // if there is just one image available. so no slider is needed
    if($imageNums == 1) { echo '<div class="imgHolder" ><img src="'.$live_img_url.'" alt="" />'; return ; }
    
    return do_shortcode('[flexslider '.$attrs.' ]'.$slide_shortcodes.'[/flexslider]');
}


?>