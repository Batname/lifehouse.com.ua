<?php

/*-----------------------------------------------------------------------------------*/
/*  Latest from Products 
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'axi_get_pages', 'axiom_shortcode_get_pages' );

function axiom_shortcode_get_pages( $atts, $content = null ) {
   global $axi_img_size;
    
   // extract attrs to vars
   extract( shortcode_atts( 
            array( 
                'size'      =>  100, // section size
                'col'       => '33', // one .. six-column
                'nav'       => 'pagination', // pagination , filterable
                'title'     => '', // widget header title
                'ids'       => "",
                'view_excerpt' => 'yes',
                'view_title'   => 'yes',
                'excerpt_len'  => '100',
                'section_index'=> ''
            )
            , $atts ) 
          );
          
    
    if(empty($ids)) return;
    $ids = explode(",", $ids);
    
    
    if(!is_array($ids) || !count($ids)) return;
    
    
    // create an id for this section 
    $uid = "axi_pbei".$section_index;
    if(empty($section_index)) $uid = uniqid("axi_pbei");
    
    // get number of grid column ---------------------------------
    // actual col size
    // get number of grid column
    $col_actual = ($size / 100) * (int)$col;
    $col_num = floor(100 / $col_actual); 
    $col_num = $col_num > 5?5:$col_num; // max column num is 5
    // get thumbnsil size name
    $image_size_name = "i".$col_num;
    
    // get suite thumb size
    $thumb_size = $image_size_name;
    $dimentions = $axi_img_size[$thumb_size.'_1'];
    
    // retinafy thumbnail
    $dimentions[0] =  1.5 * $dimentions[0];
    $dimentions[1] =  1.5 * ($dimentions[1] - 10);
    
    
    // create wp_query to get pages
    $args = array(
      'post_type' => 'page',
      //'orderby' => "date",
      'post_status' => 'publish',
      'posts_per_page' => -1,
      'post__in' => $ids,
      'ignore_sticky_posts'=> 1
    );
    
    $th_query = null;
    $th_query = new WP_Query($args);      
    
    ob_start();
?>
    
        <section id="<?php echo $uid; ?>" class="widget-pages widget-container <?php echo axiom_get_grid_name($size)." "; if($view_excerpt == "no") { echo "no-excerpt"; } ?>">
           
           <?php 
               
               if($nav == "pagination"){
                   $nav = ((int)$th_query->post_count > floor(100 / $col) )?$nav:"";
               }elseif ($nav == "regular"){
                   $nav = "";
               }
               
           ?>
           
           <?php if(!empty($title) || !empty($nav)) echo get_widget_title($title, $nav); ?>
           
           <div class="widget-inner">
               
               <div class="motion-wrapper <?php echo axiom_get_grid_column_name($col); ?>">
                   
<?php if( $th_query->have_posts() ):  while ($th_query->have_posts()) : $th_query->the_post(); ?>    
                    
                   
                   <article  class="col" d>
                       <figure>
                            <?php if(has_post_thumbnail()) { ?>
                            <div class="imgHolder height1">
                                <a href="<?php the_permalink(); ?>" >
                                    <?php // get retina ready image
                                    axiom_the_post_thumbnail($th_query->post->ID, $dimentions[0], $dimentions[1], true, 75); ?>
                                </a>
                                
                            </div>
                            <?php } ?>
                            <?php if($view_title != "no" || $view_excerpt != "no") { ?>
                            <figcaption>
                                <?php if($view_title != "no") { ?>
                                <h4 class="item-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
                                <?php } ?>
                                
                                <?php if($view_excerpt != "no") echo '<p>'. axiom_get_trimmed_string(get_the_excerpt(),$excerpt_len) .'</p>'; ?>
                            </figcaption>
                            <?php } ?>
                       </figure>
                    </article>                                       
                   
<?php   endwhile; endif;
    wp_reset_query();
?>
                   
               </div><!-- motion-wrapper -->
               
            </div><!-- widget-inner -->
        </section><!-- widget-pages -->
    
<?php    
    return ob_get_clean();
}


?>