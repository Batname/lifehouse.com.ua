<?php

/*-----------------------------------------------------------------------------------*/
/*  FAQ
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'faq', 'axiom_shortcode_faq' );

function axiom_shortcode_faq( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'size'       =>  100, // section size
                'title'      => '', // section title
                'one_visible'=> 'no',
                'cat_id'     => 'all'
            )
            , $atts ) 
          );    
    
    // load accordion js script
    wp_enqueue_script('init.faq.accordion');
    
    // just view custom taxonomies if tax id is set
    $tax_args = array('taxonomy' => 'faq-category', 'terms' => $cat_id );
    if(empty($cat_id) || $cat_id == "all" ) $tax_args = "";
    
    // create wp_query to get latest items
    $args = array(
      'post_type' => 'faq',
      'orderby' => "date",
      'posts_per_page' => -1,
      'post_status' => 'publish',
      'tax_query' => array($tax_args)
    );
    
    $th_query = null;
    $th_query = new WP_Query($args);  
    
    // stores title bar datas
    $cats = "";
    $nav  = ($cat_id == "all" )?"filterable":""; // specifies to show filter in title bar or not
    
    // if specific id is not set, add all category filters to $cats array to use in title bar 
    if($cat_id == "all") {
        $cats = array( );
        $axi_cat_ids = get_categories( array('type' => 'faq', 'taxonomy' => 'faq-category') ); 
        foreach ($axi_cat_ids as $tax) 
            $cats[$tax->term_id] = $tax->name;
    }
    
    ob_start();
?>
        
        <section class="widget-faq widget-container <?php echo axiom_get_grid_name($size); ?>">
            
            <?php if(!empty($title))  echo get_widget_title($title, $nav, $cats); ?>

            <div class="widget-inner">
                
                <dl>
                    
<?php // loop through all faqs ?>                  
<?php if( $th_query->have_posts() ):  while ($th_query->have_posts()) : $th_query->the_post(); ?>  
                    
                    <?php // get all category ids assigned to current faq, and store in a string
                        $post_cats = wp_get_post_terms($th_query->post->ID, "faq-category"); 
                        $output = '';
                        if($post_cats){
                            foreach($post_cats as $post_cat) {
                                $output .= $post_cat->term_id .' ';
                            }
                        }
                        unset($post_cats);
                    ?>
                    
                    <section class="active" data-filter="<?php echo $output; unset($output); ?>">
                        <dt><i>-</i><?php the_title(); ?></dt>
                        <dd><?php echo do_shortcode(get_the_content()); ?></dd>
                    </section>
                    
<?php   endwhile; endif;
    wp_reset_query();
?>
                </dl>
               
            </div><!-- widget-inner -->
            
        </section><!-- widget-container -->
        
        
<?php    
    
    return ob_get_clean();
}



?>