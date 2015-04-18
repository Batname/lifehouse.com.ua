<?php

// remove default wordpress shortcode
remove_shortcode('gallery', 'gallery_shortcode');

// add modified gallery shortcode
add_shortcode('gallery', 'axiom_gallery_shortcode');
add_shortcode('axiom-gallery', 'axiom_gallery_shortcode');


/**
 * The Gallery shortcode.
 *
 * This implements the functionality of the Gallery Shortcode for displaying
 * WordPress images on a post.
 *
 * @since 2.5.0
 *
 * @param array $attr Attributes of the shortcode.
 * @return string HTML content to display gallery.
 */
function axiom_gallery_shortcode($attr) {
    global $axi_img_size;
    $post = get_post();

    static $instance = 0;
    $instance++;

    if ( ! empty( $attr['ids'] ) ) {
        // 'ids' is explicitly ordered, unless you specify otherwise.
        if ( empty( $attr['orderby'] ) )
            $attr['orderby'] = 'post__in';
        $attr['include'] = $attr['ids'];
    }

    // Allow plugins/themes to override the default gallery template.
    $output = apply_filters('post_gallery', '', $attr);
    if ( $output != '' )
        return $output;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'columns'    => 3,
        'size'       => 100,
        'hardcrop'   => "yes",
        'include'    => '',
        'exclude'    => '',
        'type'       => 'grid'
    ), $attr));
    
    
    // get the wrapper size - default is 100 (full)
    $size = is_numeric($size)?$size:100;
    
    
    // for making images retina ready - if the page is full width, get bigger low quality image
    if(!axiom_is_fullwidth($post->ID) || $post->post_type == "post" || $post->post_type == "news")
        $image_resize_ratio = 1;
    else
        $image_resize_ratio = 1.4;
    
    
    // actual col size -------------------------------------------
    // get number of grid column
    $col_actual = $size / (int)$columns;
    $col_num = floor(100 / $col_actual); 
    $col_num = $col_num > 6?6:$col_num; // max column num is 6
    // get thumbnsil size name
    $image_size_name = "i".$col_num."_1";
    
    

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }
    
    
    $columns = intval($columns);
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    $selector = "gallery-{$instance}";
    
    
    $output = "<div id='$selector' class='widget-gallery widget-container gallery galleryid-{$id} gallery-columns-{$columns} '>
                        <div class='widget-inner'>
                            <div class='motion-wrapper " .axiom_get_column_num_name($columns). "'>\n\t\t\t\t";

    $i = 0;
    
    foreach ( $attachments as $id => $attachment ) {
        
        // reset current item image size name
        $thumb_size = $image_size_name;
          
        // get suite thumb size
        $dimentions = $axi_img_size[$thumb_size];
            
        // retinafy thumbnail
        $dimentions[0] =  $image_resize_ratio * $dimentions[0];
        $dimentions[1] =  $image_resize_ratio * $dimentions[1];
        
        if($hardcrop != "yes" && $hardcrop != "true") $dimentions[1] = null; 
        
        $output .= "<section class='col' >
                                    <figure>
                                        <div class='imgHolder gallery-icon'>
                                            <a href='". axiom_get_the_resized_attachment_src($id, 1280) ."' data-rel='prettyPhoto[$selector]' >
                                                <img src='".axiom_get_the_resized_attachment_src($id, $dimentions[0], $dimentions[1], true, 80)."' title='". wptexturize($attachment->post_title) ."' alt='". wptexturize($attachment->post_excerpt) ."' />
                                            </a>
                                        </div >";
        if ( trim($attachment->post_excerpt) ) {
            $output .= "
                                        <figcaption class='gallery-caption'>
                                            <p>" . wptexturize($attachment->post_excerpt) . "</p>
                                        </figcaption>";
        }
        $output .= "
                                    </figure>
                                </section>\n\t\t\t\t";
    }

    $output .= "<br style='clear: both;' />\n
                            </div><!-- motion-wrapper -->\n
                        </div><!-- widget-inner -->
                    </div><!-- widget-gallery -->\n\n";

    return $output;
}




?>