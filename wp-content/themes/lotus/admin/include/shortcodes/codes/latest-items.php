<?php

/*-----------------------------------------------------------------------------------*/
/*  Latest from posttypes 
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'latest_items', 'axiom_shortcode_latest_items' );

function axiom_shortcode_latest_items( $atts, $content = null ) {
   global $axi_img_size;
   
   extract( shortcode_atts( 
            array( 
                'size'      =>  100, // section size
                'col'       => '33', // one .. six-column
                'mode'      => 'none', // caption-over, none
                'grid'      =>  '', // custome grid
                'num'       =>  3,  // fetch num
                'nav'       => 'pagination', // pagination , filterable
                'title'     => '', // widget header title
                'posttype'  => 'post', // posttype
                'cat_id'    => '',
                'taxonomy'  => 'category',
                'view_excerpt' => 'yes',
                'view_title'   => 'yes',
                'excerpt_len'  => '100',
                'section_index' => ''
            )
            , $atts ) 
          );
    
    // create an id for this section 
    $uid = "axi_pbei".$section_index;
    if(empty($section_index)) $uid = uniqid("axi_pbei");
    
    // validate number fetched items
    $num = is_numeric($num)?$num:-1;
    
    // get number of grid column ---------------------------------
    // actual col size
    // get number of grid column
    $col_actual = ($size / 100) * (int)$col;
    $col_num = floor(100 / $col_actual); 
    $col_num = $col_num > 5?5:$col_num; // max column num is 5
    // get thumbnsil size name
    $image_size_name = "i".$col_num;
    
    
    
    // get all taxonomy items for filtering purpose ---------------
    $tax_args = array('taxonomy' => $taxonomy, 'terms' => $cat_id );
    
    if(empty($cat_id) || $cat_id == "all" ) $tax_args = "";
    
    // create wp_query to get latest items
    $args = array(
      'post_type' => $posttype,
      'orderby'   => "menu_order date",
      'post_status' => 'publish',
      'posts_per_page' => $num,
      'tax_query' => array($tax_args)
    );
    
    
    $th_query = null;
    $th_query = new WP_Query($args);      
    
    ob_start();
?>
        
        <section id="<?php echo $uid; ?>" class="widget-folio widget-container <?php echo $mode.' '.axiom_get_grid_name($size); ?>">
           
           
           <?php 
               // get all tags for filtering content           
               // stores all tax slugs in array
               $tax_list  = array(); 
               
               
               $custom_tags_query = new WP_Query(array(
                    'post_type'   => 'portfolio',
                    'posts_per_page' => -1,
                    'tax_query' => array($tax_args)
               ));
               
               if ($custom_tags_query->have_posts()) :
                    while ($custom_tags_query->have_posts()) : $custom_tags_query->the_post();
                        
                        $posttags = get_the_terms($custom_tags_query->post->ID, 'portfolio-tag');
                        if ($posttags) {
                            foreach($posttags as $tag) {
                                $tax_list[$tag->slug] = $tag->name;
                            }
                        }
                    endwhile;
               endif;
               
               // remove duplicated tags from tags/filters list
               $tax_list = array_unique($tax_list);
               
               
               if($nav == "pagination"){
                   $nav = ((int)$th_query->post_count > floor(100 / $col) )?$nav:"";
               }elseif ($nav == "regular"){
                   $nav = "";
               }
               
           ?>
           
           <?php if(!empty($title)) echo get_widget_title($title, $nav, $tax_list); ?>
           
           <div class="widget-inner">
               
               <div class="motion-wrapper <?php echo $grid; ?> <?php echo axiom_get_grid_column_name($col); ?>">
                   
<?php if( $th_query->have_posts() ):  while ($th_query->have_posts()) : $th_query->the_post(); ?>    
                   
                   <?php // reset current item image size name
                      $thumb_size = $image_size_name;
                   
                      // is current item highlighted?
                      $is_highlight = get_post_meta($th_query->post->ID, 'is_highlighted', true);
                      
                      // this is the css class name that indicates the thumbnail size in browser
                      $classSize    = "";
                      if($is_highlight == "yes" && $mode == "caption-over"){
                           $classSize = "height2";
                           $thumb_size .= "_2"; // if the item is marked as highlited, make it 2x bigger in height
                      }else{
                           $classSize = "height1";
                           $thumb_size .= "_1"; 
                      }
                      
                      // get suite thumb size
                      $dimentions = $axi_img_size[$thumb_size];
                        
                      // retinafy thumbnail
                      $dimentions[0] =  1.8 * $dimentions[0];
                      $dimentions[1] =  1.8 * $dimentions[1];
                   ?>  
                   
                   <?php // get the current item tag for filtering content
                      $tax_name = 'portfolio-tag';
                      $tax_terms = wp_get_post_terms($th_query->post->ID, $tax_name); 
                      // stores all current item tag slugs az class attrs
                      $tax_slugs = "";
                      
                      if($tax_terms){
                          foreach($tax_terms as $term)
                              $tax_slugs .= " ".$term->slug;
                      }
                   ?>
                   
                   <article class="col" data-filter="<?php echo $tax_slugs; ?>" >
                       <figure>
                            <div class="imgHolder <?php echo $classSize; ?>">
                                <a href="<?php the_permalink(); ?>">
                                    <?php  
                                        axiom_the_post_thumbnail($th_query->post->ID, $dimentions[0], $dimentions[1], true, 70);
                                    ?>
                                    <?php if ($mode == "caption-over"): ?>
                                    
                                        <em>
                                            <?php if($view_title == 'yes'){ ?>
                                            <h4><?php the_title(); ?></h4>
                                            <?php } ?>
                                            
                                            <?php 
                                                  $cat_terms = wp_get_post_terms(get_the_ID(), 'project-type'); 
                                                  if(!empty($cat_terms)){
                                                      echo '<i>';
                                                      $cnt = 0;
                                                      foreach($cat_terms as $term){
                                                          echo $cnt == 0?'':' / ';
                                                          echo $term->name;
                                                          $cnt++;
                                                      }
                                                      echo '</i>';
                                                  }
                                            ?>
                                        </em>
                                    
                                    <?php endif; ?>
                                </a>
                            </div>
                            <?php if ($mode != "caption-over") { ?>
                                
                            <figcaption>
                                <h4 class="fig-title">
                                    <?php if($view_title == 'yes'){ ?>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    <?php } ?>
                                </h4>
                                <?php if($view_excerpt == "yes") axiom_the_trimmed_string(get_the_excerpt(),$excerpt_len); ?>
                            </figcaption>
                            
                            <?php } ?>
                       </figure>
                   </article>                                          
                   
<?php   endwhile; endif;
    wp_reset_query();
?>
                   
               </div><!-- motion-wrapper -->
               
            </div><!-- widget-inner -->
        </section><!-- widget-folio -->
    
<?php    
    return ob_get_clean();
}


?>