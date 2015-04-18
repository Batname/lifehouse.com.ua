<?php
/*-----------------------------------------------------------------------------------*/
/*  Related posts
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'related_items', 'axiom_shortcode_related_items' );

function axiom_shortcode_related_items( $atts, $content = null ) {
   global $axi_img_size;
   
   extract( shortcode_atts( 
            array( 
                'col'  => 'three-column', // one .. six-column
                'mode' => 'none', // caption-over, none
                'grid' =>  '', // custome grid
                'num'  =>  3,  // fetch num
                'nav'  => 'pagination', // pagination , filterable
                'title'=> '', // widget header title
                'h2Num'=>  0, // number of double size images
                'posttype' => 'post', // posttype
                'tax'  => 'tag' ,
                'excerpt'=> false
            )
            , $atts ) 
          );
    
    // get number of grid column -----------------------------------
    $col_size = axiom_get_grid_column_number($col); // convert col name to col num
    $col_num  = floor(100 / (int) $col_size); 
    
    // get thumbnsil size name
    $image_size_name = "i".$col_num;
    
    // get suite thumb size
    $thumb_size = $image_size_name;
    $dimentions = $axi_img_size[$thumb_size.'_1'];
    
    
    
    
    // create wp_query to get latest items
    global $post;
    
    $tax_terms = get_the_terms( $post->ID, $tax); 
    $tax_slugs = array();
    
    if (is_array($tax_terms) && count($tax_terms) ) {
          // loop through current item terms and get all tax slugs
          foreach ($tax_terms  as $tax_term) {
            $tax_slugs[] = $tax_term->slug;
          }
          
          $args = array(
              'post_type'    => $posttype,
              'posts_per_page' => $num, 
              'post__not_in' => array($post->ID),
              'tax_query'    => array(
                                     array(
                                            'taxonomy' => $tax,
                                            'field'    => 'slug',
                                            'terms'    => $tax_slugs
                                          )
                                  )
          );
          
    }else{
        return '<p>'.__("No Related Item Available", "Default").'</p>';
    }

    $th_query = null;
    $th_query = new WP_Query($args);      
    
    ob_start();
?>
    
    
        <section class="entry-related widget-container <?php echo $mode; ?>">
            
           <?php echo get_widget_title($title, $nav); ?>
           
           <div class="widget-inner">
               
               <div class="motion-wrapper <?php echo $grid; ?> <?php echo $col; ?>">
                   
<?php if( $th_query->have_posts() ):  while ($th_query->have_posts()) : $th_query->the_post(); ?>    
    
                   <section class="col"  >
                       <figure>
                            <div class="imgHolder">
                                <a href="<?php the_permalink(); ?>">
                                    <?php axiom_the_post_thumbnail($th_query->post->ID, 1.5 * $dimentions[0], 1.5 * $dimentions[1] , true, 80); ?>
                                    <?php if ($mode == "caption-over"): ?>
                                    <span>
                                        <em>
                                            <h4><?php the_title(); ?></h4>
                                        </em>
                                    </span>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <?php if ($mode != "caption-over") { ?>
                                
                            <figcaption>
                                <h4 class="fig-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <?php if($excerpt) the_excerpt(); ?>
                            </figcaption>
                            
                            <?php } ?>
                       </figure>
                   </section>                                          
                   
<?php   endwhile; endif;
    wp_reset_query();
?>
                   
               </div><!-- motion-wrapper -->
               
            </div><!-- related-inner -->
        </section><!-- entry-related -->
    
<?php    
    echo ob_get_clean();
}
?>