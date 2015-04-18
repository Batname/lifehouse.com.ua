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



class AxiRecentPostsWidget extends Axiom_Widget {

    public $fields   = array(
                            
                            array(
                                'name'    => 'Title',
                                'id'      => 'title',
                                'type'    => 'textbox',
                                'value'   => ''
                            ),
                            array(
                                'name'    => 'Display Post Format?',
                                'id'      => 'show_format',
                                'type'    => 'select',
                                'value'   => 'yes',
                                'options' => array( "yes" => "Yes" , "no" => "No")
                            ),
                            array(
                                'name'    => 'Number of posts to show',
                                'id'      => 'num',
                                'type'    => 'select',
                                'value'   => '4',
                                'options' => array( "1" => "1" , "2" => "2", "3" => "3" , "4"  => "4" , "5" => "5"  , "6" => "6",
                                                    "7" => "7" , "8" => "8", "9" => "9" , "10" => "10","11" => "11" , "12" => "12" )
                            ),
                            array(
                                'name'    => 'Display Date?',
                                'id'      => 'show_date',
                                'type'    => 'select',
                                'value'   => 'yes',
                                'options' => array( "yes" => "Yes" , "no" => "No")
                            ),
                            array(
                                'name'    => 'Display Excerpt?',
                                'id'      => 'show_excerpt',
                                'type'    => 'select',
                                'value'   => 'yes',
                                'options' => array( "yes" => "Yes" , "no" => "No")
                            ),
                            array(
                                'name'    => 'Max Excerpt Length',
                                'id'      => 'excerpt_len',
                                'type'    => 'textbox',
                                'value'   => '60'
                            )
                            
                        );

    

    /** constructor */

    function __construct() {
            
        parent::__construct();

        parent::WP_Widget( "recent_blog" , $name = '[axiom] Recent Posts' /* Name */     , 

                           array( 'description' => 'Most Recent Post From Blog' ) );
    }



    // outputs the content of the widget

    function widget( $args, $instance ) {

        extract( $args );
        
        $title = apply_filters( 'widget_title', $instance['title'] );
        
        
        
        
        // create wp_query to get latest items -----------
        $args = array(
          'post_type' => 'post',
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
                    
                    
                    <article class="mini ">
                       <figure>
                            <?php if($instance["show_format"] == "yes" ) { ?>
                            <div class="entry-format">
                                <a href="<?php the_permalink(); ?>" class="post-format format-<?php echo get_post_format(); ?>"> </a>
                            </div>
                            <?php } ?>
                            <figcaption>
                                <div class="entry-header">
                                    <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                </div>
                                
                                <div class="entry-content">
                                    <?php if($instance['show_date'] != "no" ) { ?>
                                    <time datetime="<?php the_time('Y-m-d')?>" title="<?php the_time('Y-m-d')?>" ><?php the_time('F j, Y'); ?></time>
                                    <?php } if($instance['show_excerpt'] != "no" ) { ?>
                                    <p><?php axiom_the_trimmed_string(get_the_excerpt(),$instance["excerpt_len"]); ?></p>
                                    <?php } ?>
                                </div>
                            </figcaption>
                       </figure>
                   </article> 
                                                 
                   
<?php   endwhile; endif;
    wp_reset_query();
        
        
        echo    '</div>', $after_widget;
    }
    


} // end widget class



// register Widget

add_action( 'widgets_init', create_function( '', 'register_widget("AxiRecentPostsWidget");' ) );

?>