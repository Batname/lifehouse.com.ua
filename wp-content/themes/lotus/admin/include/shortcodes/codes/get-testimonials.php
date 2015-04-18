<?php

/*-----------------------------------------------------------------------------------*/
/*  Get Testimonials - a shortcode for fectching data by id and returning testimonial shortcode
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'get_testimonial', 'axiom_shortcode_get_testimonial' );

function axiom_shortcode_get_testimonial( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'size'      => '33',  // section size
                'title'     => '',    // section title
                'id_type'   => '',
                'single_id' => '',
                'cat_id'    => '',
                'type'      => 'blockquote'
            )
            , $atts ) 
          );  
    
    // Fetch spefic id o category? if type is not set, but one of ids is set, then specify id_type
    if(empty($id_type)) {
        if(!empty($single_id) && empty($cat_id)){
            $id_type = 'specific';
        }else if(empty($single_id) && !empty($cat_id)){
            $id_type = 'category';
        }else{
            return;
        }
    }
    
    
    // if specific testimonial is requested ---------------------------
    
    if($id_type == 'category'){
        
        $items = ''; // for storing all testimonial_item shortcodes
        
        $tax_args = array('taxonomy' => 'testimonial-category', 'terms' => $cat_id );
        
        if(empty($cat_id) || $cat_id == "all" ) $tax_args = "";
        
        // create wp_query to get latest items
        $args = array(
          'post_type' => 'testimonial',
          'post_status' => 'publish',
          'posts_per_page'=> -1,
          'orderby' => 'date',
          'tax_query' => array($tax_args)
        );
    
    // if a testimonial category is requested
    } else{
        
        $args = array(
          'page_id' => $single_id,
          'post_type' => 'testimonial'
        );
        
    }
    
    // -----------------------------------------------------------------
    
    $th_query = null;
    $th_query = new WP_Query($args);   
    
    ob_start();



    if( $th_query->have_posts() ):  while ($th_query->have_posts()) : $th_query->the_post();
        
        $cjob   = get_post_meta($th_query->post->ID, 'customer_job', true); 
        $curl   = get_post_meta($th_query->post->ID, 'customer_url' , true); 
        $avatar = axiom_get_the_post_thumbnail($th_query->post->ID, 80, 80); 
        
        
        // if cat_id is set , use testimonial_slider shortcode
        if($id_type == 'category'){
            
            $attr   = ' author="'.get_the_title().'" avatar="'.$avatar.'" role="'.$cjob.'" link="'.$curl.'" type="'.$type.'" ';
            $items .= '[testimonial_item '.$attr.' ]'.get_the_content().'[/testimonial_item]';
            
        // if single id is set , use testimonial shortcode
        } else{
            
            $attr  = ' size="'.$size.'" title="'.$title.'" type="'.$type.'" ';
            $attr .= ' author="'.get_the_title().'" avatar="'.$avatar.'" role="'.$cjob.'" link="'.$curl.'"  ';
            
            echo do_shortcode('[testimonial '.$attr.' ]'.get_the_content().'[/testimonial]', '');
        }
        
    endwhile; endif;
    wp_reset_query();
    unset($cjob, $curl, $avatar, $attr);
    
    
    if($id_type == 'category'){
        $slider_attr  = ' size="'.$size.'" title="'.$title.'" type="'.$type.'" ';
        echo do_shortcode('[testimonial_slider '.$slider_attr.' ]'.$items.'[/testimonial_slider]');
    }
    

 
    return ob_get_clean();
}

?>