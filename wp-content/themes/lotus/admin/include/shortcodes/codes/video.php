<?php

/*-----------------------------------------------------------------------------------*/
/*  Video
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'video'  , 'axiom_shortcode_video' );
add_shortcode( 'vimeo'  , 'axiom_shortcode_video' );
add_shortcode( 'youtube', 'axiom_shortcode_video' );
add_shortcode( 'utube'  , 'axiom_shortcode_video' );

function axiom_shortcode_video( $atts, $content = null ) {
   global $axiom_options;
    
   extract( shortcode_atts( 
            array( 
                'size'      => '',  // section size
                'title'     => '',    // section title
                'width'     => '480', // default video size
                'height'    => '320', // default video height
                'fit'       => 'no',  // makes video responsive
                'full'      => '',    // makes video responsive
                'url'       => '',
                'mp4'       => '',
                'ogg'       => '',
                'webm'      => '',
                'flv'       => '',
                'poster'    => '',
                'skin'      => 'dark',
                'uid'       => ''
            )
            , $atts ) 
          );
    
    // create an unique id for video element if is not set
    if(empty($uid)) $uid = uniqid("axi");
    
    // full is equal to fit. usage : tinymce shortcode
    if(!empty($full)) $fit = $full;
    
    ob_start();
?>
      
        <section class="widget-video  <?php echo axiom_get_grid_name($size); ?>">
            
            <?php if(!empty($title))  echo get_widget_title($title, ""); 
            
            // check if vimeo or youtube is set
            if(!empty($url)) {
                // is youtube url
                if(strpos($url, 'watch?v=') !== FALSE){
                    $linkparts = explode('watch?v=', $url);
                    $linkparts = explode('&', $linkparts[1]);
                    $url       = 'http://www.youtube.com/embed/'.$linkparts[0];
                }elseif(strpos($url, 'youtu.be') !== FALSE){
                    $linkparts = explode('youtu.be/', $url);
                    $linkparts = explode('&', $linkparts[1]);
                    $url       = 'http://www.youtube.com/embed/'.$linkparts[0];
                // is vimeo url
                }elseif(strpos($url, 'vimeo.com') !== FALSE){
                    if(strpos($url, 'vimeo.com/video') === FALSE){
                        $linkparts = explode('vimeo.com/', $url);
                        $url       = 'http://player.vimeo.com/video/'.$linkparts[1];
                    }
                }
                
                $control_color = isset($axiom_options['feature_color'])?$axiom_options['feature_color']:"#00adef";
                $control_color = substr($control_color, 1);
            ?>
            <iframe src="<?php echo $url; ?>?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=<?php echo $control_color; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" data-fit="<?php echo $fit; ?>" frameborder="0" ></iframe>
            <?php 
             // if it was not youtube vimeo link
            } elseif(!empty($mp4) || !empty($ogg) || !empty($webm) || !empty($flv)) { // if any video file is set
                include ADMIN_INC.'shortcodes/entry/videoplayer.php';
            }
            ?>
            
        </section><!-- end widget-video -->
        
<?php    
    wp_enqueue_script ('jplayer');
    return ob_get_clean();
}

?>