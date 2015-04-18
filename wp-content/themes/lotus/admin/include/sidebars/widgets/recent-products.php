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

 *  Recent Products widget

 * --------------------------------------------*/



class AxiRecentProductsWidget extends Axiom_Widget {

    public $fields   = array(
                            
                            array(
                                'name'    => 'Title',
                                'id'      => 'title',
                                'type'    => 'textbox',
                                'value'   => ''
                            ),
                            array(
                                'name'    => 'Number of Products to show',
                                'id'      => 'num',
                                'type'    => 'select',
                                'value'   => '6',
                                'options' => array( "1" => "1" , "2" => "2", "3" => "3" , "4"  => "4" , "5" => "5"  , "6" => "6",
                                                    "7" => "7" , "8" => "8", "9" => "9" , "10" => "10","11" => "11" , "12" => "12",
                                                    "13" => "13" , "14" => "14", "15" => "15" , "16"  => "16" , "17" => "17"  , "18" => "18" )
                            )
                            
                        );
    

    /** constructor */

    function __construct() {
            
        parent::__construct();

        parent::WP_Widget( "recent_products" , $name = '[axiom] Recent Products' /* Name */     , 

                           array( 'description' => 'Most Recent Products' ) );
    }



    // outputs the content of the widget

    function widget( $args, $instance ) {

        extract( $args );
        
        $title = apply_filters( 'widget_title', $instance['title'] );
        
        
        
        
        // create wp_query to get latest items -----------
        $args = array(
          'post_type' => 'product',
          'orderby' => "date",
          'post_status' => 'publish',
          'posts_per_page' => $instance["num"],
          'ignore_sticky_posts'=> 1
        );
        
        $th_query = null;
        $th_query = new WP_Query($args);    
        

        echo    $before_widget;

        if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }

        echo    '<div class="widget-inner">';
        
        
        if( $th_query->have_posts() ):  while ($th_query->have_posts()) : $th_query->the_post(); ?>    
                    
            <?php if(has_post_thumbnail() ) { ?>
            <div class="imgHolder">
                <a href="<?php the_permalink(); ?>"><?php axiom_the_post_thumbnail(null, 120, 120, true, 70); ?></a>
            </div>
            <?php } ?>           
                   
<?php   endwhile; endif;
    wp_reset_query();
        
        
        echo    '</div>', $after_widget;
    }
    


} // end widget class



// register Widget

add_action( 'widgets_init', create_function( '', 'register_widget("AxiRecentProductsWidget");' ) );

?>