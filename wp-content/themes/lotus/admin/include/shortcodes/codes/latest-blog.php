<?php

/*-----------------------------------------------------------------------------------*/
/*  Latest from Blog 
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'latest_blog', 'axiom_shortcode_latest_blog' );

function axiom_shortcode_latest_blog( $atts, $content = null ) {
   global $axi_img_size, $axiom_options;
   
   // extract attrs to vars
   extract( shortcode_atts( 
            array( 
                'size'      =>  100, // section size
                'title'     => '', // widget header title
                'col'       => '33', // one .. six-column
                'view_more' => 'yes',
                'more_label'=> 'view all',
                'num'       =>  3,  // fetch num
                'perpage'   =>  3,
                'nav'       => 'pagination', // pagination , regular
                'excerpt_len' => '120',
                'cat_id'    => '', // cat id to display. '' gets all cats
                'view_thumb'=> 'yes', // display thumbnail or not
                'thumb_mode'=> 'top', // 'top': normal thumb on top , 'left': normal thumb on left, 'icon': icon size thumb
                'date_type' => 'big',
                'auto_play' => 'no'
            )
            , $atts ) 
          );
    
    // validate number fetched items
    $num = is_numeric($num)?$num:-1;
    
    // get thumbnail diemntion --------------------------------------
    $vimeo_height = 273;
    
    // chane thumbnail size to 60x60 if it is mini mode
    if($thumb_mode == "mini") {
        $dimentions[0] = 60;
        $dimentions[1] = 60;
    }else{
        // actual col size
        // get number of grid column
        $col_actual = ($size / 100) * (int)$col;
        $col_num = floor(100 / $col_actual); 
        $col_num = $col_num > 4?4:$col_num; // max column num is 4
        // get thumbnsil size name
        $image_size_name = "i".$col_num;
        
        // get suite thumb size
        $thumb_size = $image_size_name;
        $dimentions = $axi_img_size[$thumb_size.'_1'];
        
        // the left mode is half size of top mode, so for making image retina 
        // bigger size is not needed
        if($thumb_mode == "top"){
            // retinafy thumbnail
            $dimentions[0] =  1.5 * $dimentions[0];
            $dimentions[1] =  1.5 * ($dimentions[1] - 10);
            
        }else{ // if the image is on left
            $dimentions[1] -= 10;
        }
        
    }
    
    
    // just view custom taxonomies if tax id is set ----------------
    $tax_args = array('taxonomy' => 'category', 'terms' => $cat_id );
    if(empty($cat_id) || $cat_id == "all" ) $tax_args = "";
    
    // create wp_query to get latest items
    $args = array(
      'post_type' => 'post',
      'orderby' => "date",
      'post_status' => 'publish',
      'posts_per_page' => $num,
      'ignore_sticky_posts'=> 1,
      'tax_query' => array($tax_args)
    );
    
    $th_query = null;
    $th_query = new WP_Query($args);    
    
    
    
    ob_start();
?>
    
        <section class="widget-blog widget-container <?php echo axiom_get_grid_name($size); ?>" data-autoplay="<?php echo $auto_play; ?>" >
           
           <?php
           if($nav == "pagination"){ // if the founded articles was more than visible num , enable slide arrows
               $nav_state = ((int)$th_query->post_count > floor(100 / $col) )?"pagination":"";
           }else{
               $nav_state = "";
           }
           if(!empty($title) || !empty($nav_state)) echo get_widget_title($title, $nav_state); ?>
           
           
           <div class="widget-inner">
               
               <div class="motion-wrapper <?php echo axiom_get_grid_column_name($col); ?>">
                   
<?php if( $th_query->have_posts() ):  while ($th_query->have_posts()) : $th_query->the_post(); ?>  
    
    
    
    
<?php
    $post_format = get_post_format($th_query->post->ID); 
    $has_attach  = FALSE;
    $the_attach  = "";
    $show_title  = true;
    
    switch ($post_format) {
        case 'aside':
            
            break;
        case 'gallery':
            
            // if the mode is not mini echo slider
            if($thumb_mode != "mini") {
                $slider  = '[flexslider slideshow="no" effect="slide" nav_type="none" easing="easeInOutQuad" ]';
                for ($i=1; $i <= 5; $i++) {
                    $has_attach = true; 
                    $img_url = get_post_meta($th_query->post->ID, "axi_gallery_image".$i, true);
                    if(!empty($img_url)){
                        $slider .= '[simple_slide src="'.axiom_get_the_resized_image_src($img_url, $dimentions[0], $dimentions[1], true, 75 ).'"  ]';
                    }
                }
                $slider .= '[/flexslider]';
                
                if(!$has_attach) break;
                
                $the_media = do_shortcode($slider);
            
            // if thumb mode is mini, just echo small image intead of slider    
            }else {
                
                $the_attach = get_post_meta($th_query->post->ID, "axi_gallery_image1", true);
                $has_attach = !empty($the_attach);
                if(!$has_attach) break;
                
                $the_media = '<div class="imgHolder">'.
                                '<a href="'.av3_get_the_attachment_url($th_query->post->ID, "full").'" data-rel="prettyPhoto">'.
                                    '<img src="'.$the_attach.'" />'.
                                '</a>'.
                             '</div>';
                break;
            }
            
            break;
        case 'image':
            $has_attach = has_post_thumbnail();
            if(!$has_attach) break;
            $the_attach = axiom_get_the_post_thumbnail($th_query->post->ID, $dimentions[0], $dimentions[1], true, 75);
            
            $the_media = '<div class="imgHolder">'.
                            '<a href="'.av3_get_the_attachment_url($th_query->post->ID, "full").'" data-rel="prettyPhoto">'.
                                $the_attach.
                            '</a>'.
                         '</div>';
            break;
            
        case 'link':
            $the_link = get_post_meta($th_query->post->ID, "the_link", true);
            $show_title = TRUE;
            $has_attach = false;
            if(!$has_attach) break;
            break;
            
        case 'video':
            $video_link = get_post_meta($th_query->post->ID, "youtube", true);
            $mp4        = get_post_meta($th_query->post->ID, "mp4" , true);
            $ogg        = get_post_meta($th_query->post->ID, "ogg" , true);
            $webm       = get_post_meta($th_query->post->ID, "webm", true);
            $flv        = get_post_meta($th_query->post->ID, "flv" , true);
            $poster     = get_post_meta($th_query->post->ID, "poster", true);
            $skin       = get_post_meta($th_query->post->ID, "skin"  , true);
            
            // if it is mini size just display a thumbnail
            if($thumb_mode == "mini") {
                if(has_post_thumbnail()){
                    $the_attach = axiom_get_the_post_thumbnail($th_query->post->ID, $dimentions[0], $dimentions[1], true, 75);
                    $the_media = '<div class="imgHolder">'.
                                    '<a href="'.get_permalink().'">'.
                                        $the_attach.
                                    '</a>'.
                                 '</div>';
                }
                break;
            }
            
            // if the feature image is set, display feature image instead
            $has_attach = has_post_thumbnail();
            if($has_attach) {
                $the_attach = axiom_get_the_post_thumbnail($th_query->post->ID, $dimentions[0], $dimentions[1], true, 75);
            
                $the_media = '<div class="imgHolder">'.
                                '<a href="'.av3_get_the_attachment_url($th_query->post->ID, "full").'" >'.
                                    $the_attach.
                                '</a>'.
                             '</div>';
                break;
            }
            
            $has_attach = (!empty($video_link) || !empty($mp4) || !empty($ogg) || !empty($webm) || !empty($flv));
            if(!$has_attach) break;
            $the_attach = do_shortcode('[video fit="yes" height="'.$vimeo_height.'" url="'.$video_link.'" mp4="'.$mp4.'" ogg="'.$ogg.'" webm="'.$webm.'" flv="'.$flv.'" poster="'.$poster.'" skin="'.$skin.'" uid="axi_vid'.$th_query->post->ID.'" size="0" ]');
            $the_media = $the_attach;
            echo '<style type="text/css"> div.jp-video div.jp-jplayer { min-height: '.(($dimentions[1]/2)-75).'px; }</style>';
            unset($video_link, $mp4,$ogg,$webm,$flv,$poster);
            break;
            
        case 'audio':
            $mp3        = get_post_meta($th_query->post->ID, "mp3" , true);
            $oga        = get_post_meta($th_query->post->ID, "oga" , true);
            $skin       = get_post_meta($th_query->post->ID, "audio_skin"  , true);
            $soundcloud = get_post_meta($th_query->post->ID, "soundcloud"  , true);
            
            if($thumb_mode == "mini") {
                if(has_post_thumbnail()){
                    $the_attach = axiom_get_the_post_thumbnail($th_query->post->ID, $dimentions[0], $dimentions[1], true, 75);
                    $the_media = '<div class="imgHolder">'.
                                    '<a href="'.get_permalink().'">'.
                                        $the_attach.
                                    '</a>'.
                                 '</div>';
                }
                break;
            }
            
            $has_attach = (!empty($mp3) || !empty($oga) || !empty($soundcloud));
            if(!$has_attach) break;
            if(!empty($mp3) || !empty($oga))
                $the_attach = do_shortcode('[audio mp3="'.$mp3.'" ogg="'.$oga.'" skin="'.$skin.'" uid="axi_au'.$th_query->post->ID.'" size="0" ]');
            else
                $the_attach = do_shortcode($soundcloud);
            $the_media = $the_attach;
            unset($mp3,$oga,$skin, $soundcloud);
            break;
            
            
        case 'quote':
            $quote  = get_post_meta($th_query->post->ID, "the_quote" , true);
            $author = get_post_meta($th_query->post->ID, "the_author", true);
            $show_title = false;
            $has_attach = false;
            $quote  = axiom_get_trimmed_string($quote,$excerpt_len);
            $quote .= "<br/>- <cite>".$author."</cite>";
            $the_attach = do_shortcode('[blockquote size="0" indent="no" ]'.$quote.'[/blockquote]');
            unset($quote);
            break;
            
        default:
            $has_attach = has_post_thumbnail();
            if(!$has_attach) break;
            $the_attach = axiom_get_the_post_thumbnail($th_query->post->ID, $dimentions[0], $dimentions[1], true, 75);
            
            $the_media = '<div class="imgHolder">'.
                            '<a href="'.get_permalink().'">'.
                                $the_attach.
                            '</a>'.
                         '</div>';
            break;
    }

?>
    
    
      
                    
                    
                    <article class="col <?php echo "date-type-".$date_type." "; echo ($thumb_mode != "top")?$thumb_mode:"thumb_top"; ?>">
                       <figure>
                           <?php if ( $has_attach  && ($view_thumb == "yes") ) : ?>
                                    
                                    <?php echo $the_media; ?>
                                
                            <?php endif; ?>
                            
                            
                            <figcaption>
                                <div class="entry-header">
                                    <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <div class="entry-format">
                                        <a href="<?php the_permalink(); ?>" class="post-format format-<?php echo get_post_format(); ?>"> </a>
                                        <?php if($date_type == "big") { ?>
                                        <div class="cell-date">
                                            <em> </em><em> </em>
                                            <time datetime="<?php the_time('Y-m-d')?>" title="<?php the_time('Y-m-d')?>" >
                                                <strong><?php the_time('d')?></strong>
                                                <span><?php the_time('M')?></span>
                                            </time>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <div class="entry-content">
                                    <?php if($date_type == "inline" && $post_format != "quote") { ?>
                                    <time datetime="<?php the_time('Y-m-d')?>" title="<?php the_time('Y-m-d')?>" ><?php the_time('F j, Y'); ?></time>
                                    <?php } ?>
                                    
                                    <?php if($post_format == "quote") {
                                        echo $the_attach;
                                    } elseif($excerpt_len > 0) { ?>
                                    <p><?php axiom_the_trimmed_string(get_the_excerpt(),$excerpt_len); ?></p>
                                    <?php } ?>
                                </div>
                            </figcaption>
                       </figure>
                   </article>                                 
                   
<?php   endwhile; endif;
    wp_reset_query();
?>
                   
               </div><!-- motion-wrapper -->
               
            </div><!-- widget-inner -->
            
            <?php if($view_more == "yes" ) { 
                $view_all_link = isset($axiom_options['blog_view_all_btn_link'])?$axiom_options['blog_view_all_btn_link']:home_url();
                $view_all_link = esc_url($view_all_link);
            ?>
            <a href="<?php echo $view_all_link; ?>" class="more right" ><?php _e($more_label, 'default'); ?></a>
            <?php } unset($view_all_link); ?>
            
        </section><!-- widget-blog -->
    
<?php    
    return ob_get_clean();
}


?>