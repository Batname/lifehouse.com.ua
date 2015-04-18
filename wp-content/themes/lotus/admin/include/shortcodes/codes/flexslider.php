<?php

/*-----------------------------------------------------------------------------------*/
/*  FlexSlider
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'flexslider', 'axiom_shortcode_flexslider' );

function axiom_shortcode_flexslider( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'uid'       => '',
                'class'     => 'side-circle-slider',  // a class that adds to flexslider for styling slider
                'margin'    => '0',  
                'maxheight' => '',
                'arrows'    => 'yes',
                'nav_type'  => 'bullet',
                'pause_on_hover' => 'yes',
                'loop'      => 'yes',
                'smooth_height'  => 'no',
                'slideshow' => 'yes',
                'animation_speed'=> '600',
                'show_time' => '6000',
                'effect'    => 'slide',
                'easing'    => 'easeOutQuad',
                'mousewheel'=> 'no',
                'sync'      => ''
            )
            , $atts ) 
          );  
          
    if(empty($content)) return;
    
    // create an unique id for slider
    $uid            = empty($uid)?uniqid("axi"):$uid;
    $margin         = ($margin > 0)?'style="margin:'.$margin.'px"':"";
    $maxheight      = (!empty($maxheight) && $maxheight > 0 )?$maxheight.'px':"none";
    $effect         = ($effect == "slide")?"slide":"fade";
    $nav_type       = ($nav_type == "bullet")?"true":"false";
    $pause_on_hover = ($pause_on_hover == "yes")?"true":"false";
    $loop           = ($loop == "yes")?"true":"false";
    $smooth_height  = ($smooth_height == "yes")?"true":"false";
    $slideshow      = ($slideshow == "yes")?"true":"false";
    
    if($mousewheel == "yes") {
        $mousewheel = "true";
        wp_enqueue_style ('mousewheel');
    }else{
        $mousewheel = "false";
    }
    
    // load flexslider script
    wp_enqueue_script("flexslider_dc");
    wp_enqueue_style ('flexslider');
    
    ob_start();
 ?>
            <section class="flex-container clearfix">
                <div id="<?php echo $uid; ?>" class="flexslider <?php echo $class; ?>" <?php echo $margin; ?> >
                    <ul class="slides" >
                        <?php // generate all simple slide shortcodes ?>
                        <?php echo do_shortcode($content); ?>
                    </ul><!-- slides -->
                <?php if($arrows == "yes") { ?>
                    <div class="flex-dir-nav side-arrows">
                       <a href="" class="w_next"><?php _e('next'    , 'default'); ?></a>
                       <a href="" class="w_prev"><?php _e('pervious', 'default'); ?></a>
                   </div><!-- widget-nav -->
                <?php } ?>
                </div><!-- flexslider -->
            </section><!-- slider wrapper -->
            
            <style>
                #<?php echo $uid; ?> .slides li { max-height: <?php echo $maxheight; ?>;  }
            </style>
            
            <script>
            
                ;jQuery(document).ready(function($){
                    var $ = jQuery.noConflict();
                    
                    $slider = $('#<?php echo $uid; ?>');
                    
                    $slider.imagesLoaded( function (){ 
                            var $this = $(this);
                            
                            $this.css({ 'display':'block' });
                            $this.flexslider({
                                animation: "<?php echo $effect; ?>",
                                controlNav: <?php echo $nav_type; ?>,
                                directionNav: false, 
                                animationLoop: <?php echo $loop; ?>,
                                slideshow:     <?php echo $slideshow; ?>,
                                smoothHeight:  <?php echo $smooth_height; ?>, 
                                pauseOnHover:  <?php echo $pause_on_hover; ?>, 
                                easing:       "<?php echo $easing; ?>", 
                                slideshowSpeed:<?php echo $show_time; ?>, 
                                animationSpeed:<?php echo $animation_speed; ?>,
                                mousewheel    :<?php echo $mousewheel; ?>,
                                sync :        "<?php echo $sync; ?>",
                                before: function(slider){
                                    console.log(slider.currentSlide,slider.slides.eq(slider.currentSlide).find('iframe'))
                                    if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0){
                                          $f( slider.slides.eq(slider.currentSlide).find('iframe').attr('id') ).api('pause');
                                      }
                                }
                            }).flexsliderManualDirectionControls({
                                previousElementSelector: ".w_prev",
                                nextElementSelector: ".w_next",
                                disabledStateClassName: "disabled"
                            });
                        }
                   );
                   
                });
                
                jQuery(window).load(function() {
 
                    var vimeoPlayers = jQuery('.flexslider').find('iframe'), player;
                 
                    for (var i = 0, length = vimeoPlayers.length; i < length; i++) {
                            player = vimeoPlayers[i];
                            $f(player).addEvent('ready', ready);
                    }
                 
                    function addEvent(element, eventName, callback) {
                        if (element.addEventListener) {
                            element.addEventListener(eventName, callback, false)
                        } else {
                            element.attachEvent(eventName, callback, false);
                        }
                    }
                 
                    function ready(player_id) {
                        var froogaloop = $f(player_id);
                        froogaloop.addEvent('play', function(data) {
                            jQuery('.flexslider').flexslider("pause");
                        });
                        froogaloop.addEvent('pause', function(data) {
                            jQuery('.flexslider').flexslider("play");
                        });
                    }
                 
                    jQuery(".flexslider")
                    .fitVids()
                    .flexslider({
                        animation: "slide",
                        animationLoop: false,
                        smoothHeight: true,
                        useCSS: false,
                        before: function(slider){
                            if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0)
                                  $f( slider.slides.eq(slider.currentSlide).find('iframe').attr('id') ).api('pause');
                        }
                    });
                 
                });
                
            </script>  
<?php    
    return ob_get_clean();
}



/*-----------------------------------------------------------------------------------*/
/*  Simple Slider Slide
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'simple_slide', 'axiom_shortcode_simple_slide' );


function axiom_shortcode_simple_slide( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'src'       => '',
                'link'      => '',
                'target'    => '_blank',
                'video'     => ''
            )
            , $atts ) 
          ); 
    
    $output  = '<li>';
    
    if(!empty($src)) {
    
        $output .= (!empty($link))?'<a href="'.$link.'" target="'.$target.'" >':'';
        $output .= '<img src="'.$src.'" />';
        $output .= (!empty($content))?'<p>'.do_shortcode($content).'</p>':'';
        $output .= (!empty($link))?'</a>':'';
    
    }elseif(strpos($video, 'vimeo.com') !== FALSE) {
        if(strpos($video, 'vimeo.com/video') === FALSE){
            $linkparts = explode('vimeo.com/', $video);
            $video = 'http://player.vimeo.com/video/'.$linkparts[1];
        }
        
        $uid = uniqid("vid_");
        $output .= '<iframe id="'.$uid.'" src="'.$video.'?title=0&amp;byline=0&amp;portrait=0&amp;badge=0"  width="500" height="281" frameborder="0" data-fit="yes" webkitAllowFullScreen mozallowfullscreen allowFullScreen ></iframe>';
    
    }elseif(strpos($video, 'watch?v=') !== FALSE){
        $linkparts = explode('watch?v=', $video);
        $linkparts = explode('&', $linkparts[1]);
        $video       = 'http://www.youtube.com/embed/'.$linkparts[0];
        
        $uid = uniqid("vid_");
        $output .= '<iframe id="'.$uid.'" src="'.$video.'?title=0&amp;byline=0&amp;portrait=0&amp;badge=0"  width="500" height="281" frameborder="0" data-fit="yes" webkitAllowFullScreen mozallowfullscreen allowFullScreen ></iframe>';
    }
    
    $output .= '</li>';
    
    return $output;
    
} ?>