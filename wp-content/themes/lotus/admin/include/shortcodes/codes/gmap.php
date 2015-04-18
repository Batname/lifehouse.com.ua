<?php

/*-----------------------------------------------------------------------------------*/
/*  Google Map
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'gmaps', 'axiom_shortcode_gmaps' );
add_shortcode( 'googlemaps', 'axiom_shortcode_gmaps' );

function axiom_shortcode_gmaps( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'size'      => 50, // section size
                'title'     => '', // section title
                'height'    => 400,
                'latitude'  => 52,
                'longitude' => 14,
                'type'      => 'ROADMAP',
                'zoom'      => 4,
                'info'      => ''
            )
            , $atts ) 
          );    
    
    // enqueue google map scripts
    wp_enqueue_script ('gomap');
    
    $mapid     = uniqid("axi_map");
    $latitude  = empty($latitude) ?52:$latitude;
    $longitude = empty($longitude)?14:$longitude;
    
    $marker  = "";
    $marker .= ' latitude :'.$latitude .','; 
    $marker .= ' longitude:'.$longitude.','; 
    if(!empty($info))     { $marker .= ' html:{ content:"'.$info.'", popup:true },'; }

    if(strlen($marker)) $marker = substr($marker, 0, -1);
    
    ob_start();
?>
        
        <section class="widget-map widget-container <?php echo axiom_get_grid_name($size); ?>">
            
        <?php if(!empty($title))  echo get_widget_title($title, ""); ?>
            
            <div id="<?php echo $mapid; ?>" class="axi_map_wrapper" style="height:<?php echo $height; ?>px" >
                
            </div>
            
       </section><!-- widget-container -->
       
       <script>
           jQuery(document).ready(function(){
               
                jQuery('#<?php echo $mapid; ?>').goMap({
                    scrollwheel: false, 
                    maptype: '<?php echo $type; ?>' ,
                    zoom : <?php echo $zoom; ?> ,
                    markers: [{
                        <?php echo $marker; ?>
                    }]
                });
                
           });
       </script>
<?php 
    return ob_get_clean();
}


?>