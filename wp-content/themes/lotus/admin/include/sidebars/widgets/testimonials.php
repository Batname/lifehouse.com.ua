<?php
/**
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */

/*----------------------------------------------

 *  Recent Posts widget

 * --------------------------------------------*/



class AxiTestimonialWidget extends Axiom_Widget {

    public $fields   = array(
                            array(
                                'name'    => 'Title',
                                'id'      => 'title',
                                'type'    => 'textbox',
                                'value'   => ''
                            ),/*
                            array(
                                'name'    => 'Display Items From',
                                'id'      => 'id_type',
                                'type'    => 'select',
                                'value'   => 'specific',
                                'options' => array( "specific" => "Spesific Testimonial" , "category" => "Category")
                            ),*/
                            array(
                                'name'    => 'Select Item',
                                'id'      => 'single_id',
                                'type'    => 'select',
                                'value'   => 'none',
                                'options' => array( "none" => "Select ...", "563" => "c1" , "1084" => "c2", "1085" => "c3")
                            ),/*
                            array(
                                'name'    => 'Select Category',
                                'id'      => 'cat_id',
                                'type'    => 'select',
                                'value'   => 'none',
                                'options' => array( "none" => "Select ...", "104" => "web" )
                            )*/
                            
                        );

    

    /** constructor */

    function __construct() {
            
        $this->assign_single_ids();
        
        parent::__construct();
        
        parent::WP_Widget( "testimonial" , $name = '[axiom] Testimonial' /* Name */     , 

                           array( 'description' => 'Display Testimonial' ) );
    }
    
    
    
    function assign_single_ids(){
      
        //-- get all single ids ----------------------------
        $args = array(
          'post_type' => 'testimonial',
          'orderby' => "date",
          'post_status' => 'publish',
          'posts_per_page' => -1
        );
        
       $ops = array("none" => "Select ...");
        
        $th_query = null;
        $th_query = new WP_Query($args);  
        if( $th_query->have_posts() ):  while ($th_query->have_posts()) : $th_query->the_post();
            $ops[$th_query->post->ID] = get_the_title();
        endwhile; endif; 
        wp_reset_query();
        unset($args);
        
        
        
        //-- clone fields and assign single ids --------------
        
        $clone_fields = array();
        
        foreach ($this->fields as $value) {
            if($value["id"] == "single_id") $value["options"] = $ops;
            $clone_fields[] = $value;
        }
        
        $this->fields = $clone_fields;
    }



    // outputs the content of the widget

    function widget( $args, $instance ) {

        extract( $args );
        
        $title = apply_filters( 'widget_title', $instance['title'] );
        
        
        
        $id_type    = isset($instance["id_type"])?$instance["id_type"]:"";
        $cat_id     = isset($instance["cat_id"])?$instance["cat_id"]:"";
        if(!isset($instance["single_id"])) return "Please specify the testimonial item "; 
        $single_id  = $instance["single_id"];
        
        
        
        // Fetch specific id or category? if type is not set, but one of ids is set, then specify id_type
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
        
        

        echo    $before_widget;

        if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }

        echo    '<div class="widget-inner">';
        
        
        // -----------------------------------------------------------------
    
        $th_query = null;
        $th_query = new WP_Query($args);  
        $items    = "";


        if( $th_query->have_posts() ):  while ($th_query->have_posts()) : $th_query->the_post();
            
            $cjob   = get_post_meta($th_query->post->ID, 'customer_job', true); 
            $curl   = get_post_meta($th_query->post->ID, 'customer_url' , true); 
            $avatar = axiom_get_the_post_thumbnail_src($th_query->post->ID, 100, 100, true, 75); 
            
            
            // if cat_id is set , use testimonial_slider shortcode
            if($id_type == 'category'){
                
                $attr   = ' author="'.get_the_title().'" avatar="'.$avatar.'" role="'.$cjob.'" link="'.$curl.'" type="blockquote" ';
                $items .= '[testimonial_item '.$attr.' ]'.get_the_excerpt().'[/testimonial_item]';
                
            // if single id is set , use testimonial shortcode
            } else{
                $items  = "";
                $attr   = ' author="'.get_the_title().'" avatar="'.$avatar.'" role="'.$cjob.'" link="'.$curl.'" type="blockquote" ';
                $items .= '[testimonial_item '.$attr.' ]'.get_the_excerpt().'[/testimonial_item]';
                
                echo do_shortcode($items);
            }
            
        endwhile; endif;
        wp_reset_query();
        unset($cjob, $curl, $avatar, $attr);
        
        
        
        
        if($id_type == 'category'){
            $slider_attr  = ' size="'.$size.'" title="'.$title.'" type="blockquote" ';
            echo do_shortcode('[testimonial_slider '.$slider_attr.' ]'.$items.'[/testimonial_slider]');
        }
        
        
        
        echo    '</div>', $after_widget;
    }
    


} // end widget class



// register Widget

add_action( 'widgets_init', create_function( '', 'register_widget("AxiTestimonialWidget");' ) );

?>