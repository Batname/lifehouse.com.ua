<?php

/*-----------------------------------------------------------------------------------*/
/*  Audio Player
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'audio', 'axiom_shortcode_audio' );

function axiom_shortcode_audio( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'size'      => '',  // section size
                'title'     => '',    // section title
                'width'     => '480', // default player width
                'height'    => '320', // default player height
                'mp3'       => '',
                'ogg'       => '',
                'skin'      => 'dark',
                'uid'       => ''
            )
            , $atts ) 
          );  
    
    wp_enqueue_script ('jplayer');
    
    // create an unique id for audio element if is not set
    if(empty($uid)) $uid = uniqid("axi_au");
    
    ob_start();
?>
      
        <section class="widget-audio  <?php echo axiom_get_grid_name($size); ?>">
            
            <?php if(!empty($title))  echo get_widget_title($title, ""); 
            
            if(!empty($mp3) || !empty($ogg)) { // if any audio file is set
                include ADMIN_INC .'shortcodes/entry/audioplayer.php';
            }
            ?>
            
        </section><!-- end widget-audio -->
        
<?php    
    return ob_get_clean();
}


?>