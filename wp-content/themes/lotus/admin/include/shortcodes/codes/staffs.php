<?php

/*-----------------------------------------------------------------------------------*/
/*  Display Staffs 
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'latest_staffs', 'axiom_shortcode_latest_staffs' );

function axiom_shortcode_latest_staffs( $atts, $content = null ) {
   global $axi_img_size;
   
   extract( shortcode_atts( 
            array( 
                'size'      =>  100, // section size
                'col'       =>  33, // one .. six-column
                'num'       =>  -1,  // fetch num
                'title'     => '', // widget header title
                'cat_id'    => '', 
                'view_excerpt'   => 'yes',
                'view_socials'   => 'yes',
                'link_to_single' => 'no'
            )
            , $atts ) 
          );
    
    // get thumbnail diemntion --------------------------------------
    
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
    $dimentions[1] =  null;
    
    $tax_args = array('taxonomy' => 'departman', 'terms' => $cat_id );
    
    if(empty($cat_id) || $cat_id == "all" ) $tax_args = "";
    
    
    // create wp_query to get latest items
    $args = array(
      'post_type' => 'staff',
      'post_status' => 'publish',
      'posts_per_page' => $num,
      'ignore_sticky_posts'=> 1,
      'orderby' => 'menu_order date',
      'order' => 'ASC',
      'tax_query' => array($tax_args)
    );
    
    $th_query = null;
    $th_query = new WP_Query($args);      
    
    ob_start();
?>
    
        <section class="widget-staff widget-container <?php echo axiom_get_grid_name($size); ?>">
           
           <?php if(!empty($title)) echo get_widget_title($title, ""); ?>
           
           <div class="widget-inner">
               
               <div class="motion-wrapper <?php echo axiom_get_grid_column_name($col); ?>">
                   
<?php if( $th_query->have_posts() ):  while ($th_query->have_posts()) : $th_query->the_post(); ?>        
                   
                   <section  class="col">
                       <figure>
                           <?php if(has_post_thumbnail()) { ?>
                            <div class="imgHolder">
                                <?php if ($link_to_single == "yes") { ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php // get retina ready image
                                    axiom_the_post_thumbnail($th_query->post->ID, $dimentions[0], $dimentions[1], false, 80); ?>
                                </a>
                                <?php 
                                } else { 
                                    axiom_the_post_thumbnail($th_query->post->ID, $dimentions[0], $dimentions[1], false, 80); 
                                } ?>
                            </div>
                            <?php } ?>
                            <figcaption>
                                <h4 class="item-title">
                                    <?php if ($link_to_single == "yes") { ?>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    <?php } else { ?>
                                    <a><?php the_title(); ?></a>
                                    <?php } ?>
                                </h4>
                                <p class="staff-spes"><?php echo get_post_meta($th_query->post->ID, 'axi_staff_position', true).get_post_meta($th_query->post->ID, 'axi_staff_occupation', true); ?></p>
                                
                                <?php if($view_excerpt == "yes") { ?>
                                <p class="staff-bio"><?php the_excerpt(); ?></p>
                                <?php } if($view_socials == "yes") { ?>
                                
                                <ul class="socials">
                                    <?php $sc_btn = get_post_meta($th_query->post->ID, 'axi_staff_facebook'  , true);  if(!empty($sc_btn)) { ?>
                                    <li><a href="<?php echo $sc_btn; ?>" class="icon-facebook-sign"> </a>
                                    <?php } $sc_btn = get_post_meta($th_query->post->ID, 'axi_staff_twitter' , true); if(!empty($sc_btn)) { ?>
                                    <li><a href="<?php echo $sc_btn; ?>" class="icon-twitter"> </a>
                                    <?php } $sc_btn = get_post_meta($th_query->post->ID, 'axi_staff_gplus'   , true);   if(!empty($sc_btn)) { ?>
                                    <li><a href="<?php echo $sc_btn; ?>" class="icon-google-plus-sign"> </a>
                                    <?php } $sc_btn = get_post_meta($th_query->post->ID, 'axi_staff_linkedin', true);   if(!empty($sc_btn)) { ?>
                                    <li><a href="<?php echo $sc_btn; ?>" class="icon-linkedin"> </a>
                                    <?php } $sc_btn = get_post_meta($th_query->post->ID, 'axi_staff_website' , true);   if(!empty($sc_btn)) { ?>
                                    <li><a href="<?php echo $sc_btn; ?>" class="icon-link"> </a>
                                    <?php } $sc_btn = get_post_meta($th_query->post->ID, 'axi_staff_email'   , true);   if(!empty($sc_btn)) { ?>
                                    <li><a href="<?php echo "mailto:".$sc_btn; ?>" class="icon-envelope"> </a>
                                    <?php } ?>
                                </ul>
                                <?php } ?>
                                
                            </figcaption>
                       </figure>
                    </section><!-- End staff -->                                    
                   
<?php   endwhile; endif;
    unset($sc_btn);
    wp_reset_query();
?>  
               </div><!-- motion-wrapper -->
               
            </div><!-- widget-inner -->
        </section><!-- widget-container -->
    
<?php    
    return ob_get_clean();
}


?>