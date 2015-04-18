<?php

/*-----------------------------------------------------------------------------------*/
/*  Services
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'services', 'axiom_shortcode_services' );
add_shortcode( 'axi_services', 'axiom_shortcode_services' );

function axiom_shortcode_services( $atts, $content = null ) {
   // extract attrs to vars
   extract( shortcode_atts( 
            array( 
                'size'        =>  100, // section size
                'title'       => '', // widget header title
                'col'         => '33', // one .. six-column
                'link_to_single' => 'no', // link to single page?
                'excerpt_len' => '120',
                'cat_id'      => '', // cat id to display. '' gets all cats
                'display_type'=> 'column' // tab , column
            )
            , $atts ) 
          );
    $col_num = floor(100 / (int)$col );
    // just view custom taxonomies if tax id is set
    $tax_args = array('taxonomy' => 'service-category', 'terms' => $cat_id );
    if(empty($cat_id) || $cat_id == "all" ) $tax_args = "";
    
    // create wp_query to get latest items
    $args = array(
      'post_type' => 'service',
      'orderby' => "menu_order date",
      'post_status' => 'publish',
      'posts_per_page' => -1,
      'ignore_sticky_posts'=> 1,
      'tax_query' => array($tax_args)
    );
    
    $th_query = null;
    $th_query = new WP_Query($args);      
    
    ob_start();
?>

<?php // Grid view output --------------------------- 
    if($display_type == "column") { 
?>

        <section class="widget-services widget-container <?php echo axiom_get_grid_name($size); ?>">
           
           
           <?php if(!empty($title)) echo get_widget_title($title, ""); ?>
           
           <div class="widget-inner">
               
               <div class="motion-wrapper <?php echo axiom_get_grid_column_name($col); ?>">
                   
<?php if( $th_query->have_posts() ):  while ($th_query->have_posts()) : $th_query->the_post(); ?>    
                   
                   <article class="col">
                    <?php
                    $icon       = get_post_meta($th_query->post->ID, 'service_icon'       , TRUE);
                    //$icon_color = get_post_meta($th_query->post->ID, 'service_icon_color' , TRUE);
                    
                    $attrs  = ' size ="0" ';
                    $attrs .= ' title="'.get_the_title().'" ';
                    $attrs .= ' image_position="left" ';
                    $attrs .= ($link_to_single == "yes")?' title_link="'.get_permalink().'" ':'';
                    $attrs .= (!empty($icon))?' icon="'.$icon.'" ':'';
                    //$attrs .= (!empty($icon_color))?' icon_color="'.$icon_color.'" ':'';
                    unset($icon);
                    
                    echo do_shortcode('[column '.$attrs.' ]'.axiom_get_trimmed_string(get_the_content(),$excerpt_len).'[/column]');
                    ?>
                   </article>    
                   
                   <?php if(((int)$th_query->current_post % $col_num) == ($col_num-1)) echo '<div class="clear"></div>'; ?>                             
                   
<?php   endwhile; endif;
    wp_reset_query();
?>             
               </div><!-- motion-wrapper -->
               
            </div><!-- widget-inner -->
            
        </section><!-- widget-services -->
        
        
<?php // Tab view output --------------------------- 
    }else { 

        $attrs  = ' size="'.$size.'" ';
        $attrs .= ' title="'.$title.'" ';
        $content= "";
        
        if( $th_query->have_posts() ):  while ($th_query->have_posts()) : $th_query->the_post();
        
        $tab_content = get_the_content(). '[smartpagebuilder id="'. $th_query->post->ID .'" ]';
        
        // create all tab shortcodes
        $content .= '[tab_element title="'.get_the_title().'" ]'.$tab_content.'[/tab_element]';
        
        endwhile; endif;
        wp_reset_query();
        
        echo do_shortcode('[tabs '.$attrs.' ]'.$content.'[/tabs]'); 

    } ?>


<?php    
    return ob_get_clean();
}


?>