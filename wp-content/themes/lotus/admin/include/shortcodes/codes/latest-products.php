<?php

/*-----------------------------------------------------------------------------------*/
/*  Latest from Products 
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'latest_products', 'axiom_shortcode_latest_products' );

function axiom_shortcode_latest_products( $atts, $content = null ) {
   global $axi_img_size;
    
   // extract attrs to vars
   extract( shortcode_atts( 
            array( 
                'size'      =>  100, // section size
                'col'       => '33', // one .. six-column
                'num'       =>  3,  // fetch num
                'perpage'   =>  3,
                'nav'       => 'pagination', // pagination , filterable
                'title'     => '', // widget header title
                'cat_id'    => '',
                'view_price'=> 'yes',
                'section_index' => '',
                'mode'      => 'grid'
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
    
    // get suite thumb size
    $thumb_size = $image_size_name;
    $dimentions = $axi_img_size[$thumb_size.'_1'];
    
    // retinafy thumbnail
    $dimentions[0] =  1.5 * $dimentions[0];
    $dimentions[1] =  1.5 * ($dimentions[1] - 10);
    
    // just view custom taxonomies if tax id is set
    $tax_args = array('taxonomy' => 'product-category', 'terms' => $cat_id );
    if(empty($cat_id) || $cat_id == "all" ) $tax_args = "";
    
    // create wp_query to get latest items
    $args = array(
      'post_type' => 'axi_product',
      'orderby' => "menu_order date",
      'post_status' => 'publish',
      'posts_per_page' => $num,
      'ignore_sticky_posts'=> 1,
      'tax_query' => array($tax_args)
    );
    
    $th_query = null;
    $th_query = new WP_Query($args);      
    
    ob_start();
?>
    
        <section id="<?php echo $uid; ?>" class="widget-product widget-container <?php echo axiom_get_grid_name($size)." "; if($view_price == "no") { echo "no-price"; } ?>">
           
           <?php 
               // get all tags for filtering content           
               // stores all tax slugs in array
               $tax_list  = array(); 
               
               
               $custom_tags_query = new WP_Query(array(
                    'post_type'   => 'axi_product',
                    'posts_per_page' => -1,
                    'tax_query' => array($tax_args)
               ));
               
               if ($custom_tags_query->have_posts()) :
                    while ($custom_tags_query->have_posts()) : $custom_tags_query->the_post();
                        
                        $posttags = get_the_terms($custom_tags_query->post->ID, 'product-tag');
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
           
           <?php if(!empty($title) || !empty($nav)) echo get_widget_title($title, $nav, $tax_list); ?>
           
           <div class="widget-inner">
               
               <div class="motion-wrapper <?php echo axiom_get_grid_column_name($col); ?>">
                   
<?php if( $th_query->have_posts() ):  while ($th_query->have_posts()) : $th_query->the_post(); ?>    
                    
                   
                   <?php // get the current item tag for filtering content
                      $tax_name = 'product-tag';
                      $tax_terms = wp_get_post_terms($th_query->post->ID, $tax_name); 
                      // stores all current item tag slugs az class attrs
                      $tax_slugs = "";
                      
                      if($tax_terms){
                          foreach($tax_terms as $term)
                              $tax_slugs .= " ".$term->slug;
                      }
                  ?>
                      
<?php if($mode == "grid") { ?>  
                   
                   <article  class="col" data-filter="<?php echo $tax_slugs; ?>">
                       <figure>
                            <?php if(has_post_thumbnail()) { ?>
                            <div class="imgHolder height1">
                                <a href="<?php the_permalink(); ?>" >
                                    <?php // get retina ready image
                                    axiom_the_post_thumbnail($th_query->post->ID, $dimentions[0], $dimentions[1], true, 75); ?>
                                    <span></span>
                                </a>
                                
                                <ul>
                                    <li class="hover-link"><a href="<?php the_permalink(); ?>"></a></li>
                                    <li class="hover-plus"><a href="<?php echo axiom_get_the_post_thumbnail_src($th_query->post->ID, 1280); ?>" data-rel="prettyPhoto" ></a></li>
                                </ul>
                            </div>
                            <?php } ?>
                            <figcaption>
                                <h4 class="item-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
                                <?php $reg_price = get_post_meta( $th_query->post->ID, 'product-reg-price', true ); if(!empty($reg_price)) { ?>
                                <del><?php echo get_post_meta( $th_query->post->ID, 'product-reg-price', true ); ?></del>
                                <?php } ?>
                                
                                <?php $reg_price = get_post_meta( $th_query->post->ID, 'product-price', true ); if(!empty($reg_price)) { ?>
                                <p class="current-price" ><?php echo get_post_meta( $th_query->post->ID, 'product-price', true ); ?></p>
                                <?php } unset($reg_price); ?>
                            </figcaption>
                       </figure>
                    </article>
                    
<?php } else { ?>
    
                    <article  class="col product-list-item" data-filter="<?php echo $tax_slugs; ?>">
                        <?php if(has_post_thumbnail() && ($mode == "thumblist") ) { ?>
                            <div class="imgHolder">
                                <a href="<?php the_permalink(); ?>" >
                                    <?php // get retina ready image
                                    axiom_the_post_thumbnail($th_query->post->ID, 140, 140, true, 75); ?>
                                </a>
                            </div>
                        <?php } ?>
                        <h4 class="item-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
                        <?php the_excerpt(); ?>
                        <div class="pr-prices-wrapper">
                        
                        <?php $reg_price = get_post_meta( $th_query->post->ID, 'product-price', true ); 
                        if(!empty($reg_price)) { ?><span class="current-price" ><?php echo get_post_meta( $th_query->post->ID, 'product-price', true ); ?></span><?php } ?>
                        
                        <?php $reg_price = get_post_meta( $th_query->post->ID, 'product-reg-price', true ); 
                        if(!empty($reg_price)) { ?><del><?php echo get_post_meta( $th_query->post->ID, 'product-reg-price', true ); ?></del><?php } 
                        unset($reg_price); ?>
                        
                        </div>
                    </article>
    
    
<?php } ?>


<?php    
        endwhile; endif;
    wp_reset_query();
?>
                   
               </div><!-- motion-wrapper -->
               
            </div><!-- widget-inner -->
        </section><!-- widget-product -->
    
<?php    
    return ob_get_clean();
}


?>