<?php

/*-----------------------------------------------------------------------------------*/
/*  Get NivoSlider
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'the_nivoslider', 'axiom_shortcode_the_nivoslider' );


function axiom_shortcode_the_nivoslider( $atts, $content = null ) {
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
        $nivo    = $data["nivo"];
        // get all slide objects
        $slides  = json_decode($data["slides"]);
        
        // write shortcode attrs
        $attrs .= ' maxheight="'.$general["height"].'" ';
        $attrs .= ' margin="'.$general["spacing"].'" ';
        $attrs .= ' random="'.$general["random" ].'" ';
        
        $attrs .= ' arrows="'.$nivo["showArrows" ].'" ';
        $attrs .= ' nav_type="'.$nivo["controlType" ].'" ';
        $attrs .= ' pause_on_hover="'.$nivo["pauseOnHover" ].'" ';
        //$attrs .= ' loop="'.$nivo["loop" ].'" ';
        $attrs .= ' slideshow="'.$nivo["slideshow" ].'" ';
        $attrs .= ' animation_speed="'.$nivo["tranSpeed" ].'" ';
        $attrs .= ' show_time="'.$nivo["showTime" ].'" ';
        $attrs .= ' effect="'.$nivo["effect" ].'" ';
        $attrs .= ' box_cols="'.$nivo["boxCols" ].'" ';
        $attrs .= ' box_rows="'.$nivo["boxRows" ].'" ';
        $attrs .= ' slices="'.$nivo["slices" ].'" ';
        
        // generate all slides shortcode
        foreach ($slides as $slide) {
            if(!empty($slide->imageURL)) {
                $imageNums++;
                $live_img_url      = $slide->imageURL; 
                $slide_shortcodes .= '[nivo_slide src="'.$slide->imageURL.'" link="'.$slide->link.'" target="'.$slide->target.'"  transition="'.$slide->effect.'" ]'.$slide->caption.'[/nivo_slide]';
            }
        }
        
        
    endwhile; endif;
    wp_reset_query();
    
    // if there is just one image available. so no slider is needed
    if($imageNums == 1) { echo '<div class="imgHolder" ><img src="'.$live_img_url.'" alt="" />'; return ; }
    
    return do_shortcode('[nivoslider '.$attrs.' ]'.$slide_shortcodes.'[/nivoslider]');
}


?>