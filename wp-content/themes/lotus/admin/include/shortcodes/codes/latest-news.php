<?php

/*-----------------------------------------------------------------------------------*/
/*  Latest from News 
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'latest_news', 'axiom_shortcode_latest_news' );

function axiom_shortcode_latest_news( $atts, $content = null ) {
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
                'nav'       => 'pagination', // pagination , regular
                'excerpt_len' => '120',
                'cat_id'    => '', // cat id to display. '' gets all cats
                'view_thumb'=> 'yes', // display thumbnail or not
                'thumb_mode'=> 'top', // 'top': normal thumb on top , 'left': normal thumb on left, 'mini': icon size thumb
                'date_type' => 'big',
                'auto_play' => 'no'
            )
            , $atts ) 
          );
    
    // validate number fetched items
    $num = is_numeric($num)?$num:-1;
    
    // get thumbnail diemntion --------------------------------------
    
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
            $dimentions[1] =  1.5 * ($dimentions[1] - 30);
        }else{ // if the image is on left
            $dimentions[1] -= 10;
        }
    }
    
    
    // just view custom taxonomies if tax id is set
    $tax_args = array('taxonomy' => 'news-category', 'terms' => $cat_id );
    if(empty($cat_id) || $cat_id == "all" ) $tax_args = "";
    
    // create wp_query to get latest items
    $args = array(
      'post_type' => 'news',
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
    
        <section class="widget-blog widget-news widget-container <?php echo axiom_get_grid_name($size); ?>" data-autoplay="<?php echo $auto_play; ?>">
           
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
                    
                    
                    <article class="col <?php echo "date-type-".$date_type." "; echo ($thumb_mode != "top")?$thumb_mode:"thumb_top"; ?>">
                       <figure>
                            <?php if(has_post_thumbnail() && ($view_thumb == "yes") ) { ?>
                            <div class="imgHolder">
                                <a href="<?php the_permalink(); ?>">
                                    <?php // get retina ready image
                                    axiom_the_post_thumbnail($th_query->post->ID, $dimentions[0], $dimentions[1], true, 75); ?>
                                </a>
                            </div>
                            <?php } ?>
                            <figcaption>
                                <div class="entry-header">
                                    <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    
                                    <div class="entry-format">
                                        <?php if($date_type == "big" ) { ?>
                                        <div class="cell-date">
                                            <em> </em><em> </em>
                                            <?php $custom_date = get_post_meta( $th_query->post->ID, 'custom_news_date', true ); 
                                                  $news_date   = empty($custom_date)?get_the_time('Y-m-d'): date( 'Y-m-d' , strtotime($custom_date));
                                                  $news_day    = empty($custom_date)?get_the_time('d')    : date( 'd'     , strtotime($custom_date));
                                                  $news_mth    = empty($custom_date)?get_the_time('M')    : date( 'M'     , strtotime($custom_date));
                                            ?>
                                            <time datetime="<?php echo $news_date; ?>" title="<?php echo $news_date; ?>" >
                                                <strong><?php echo $news_day; ?></strong>
                                                <span><?php echo $news_mth; ?></span>
                                            </time>
                                            <?php unset($custom_date,$news_date,$news_day,$news_mth ); ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <div class="entry-content">
                                    <?php if($date_type == "inline") { ?>
                                    <?php $custom_date   = get_post_meta( $th_query->post->ID, 'custom_news_date', true ); 
                                          $news_date     = empty($custom_date)?get_the_time('Y-m-d')  : date( 'Y-m-d' , strtotime($custom_date));
                                          $news_date_txt = empty($custom_date)?get_the_time('F j, Y') : date( 'F j, Y', strtotime($custom_date));
                                    ?>
                                    <time datetime="<?php echo $news_date; ?>" title="<?php echo $news_date; ?>" ><?php echo $news_date_txt; ?></time>
                                    <?php } ?>
                                    <?php if($excerpt_len > 0) { ?>
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
                $view_all_link = !empty($axiom_options['news_view_all_btn_link'])?$axiom_options['news_view_all_btn_link']:home_url();
                $view_all_link = esc_url($view_all_link);    
            ?>
            <a href="<?php echo $view_all_link; ?>" class="more right" ><?php _e($more_label, 'default'); ?></a>
            <?php } unset($view_all_link); ?>
            
        </section><!-- widget-news -->
    
<?php    
    return ob_get_clean();
}


?>