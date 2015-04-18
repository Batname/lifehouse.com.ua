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

 *  Recent Tweets widget

 * --------------------------------------------*/



class AxiRecentTweetsWidget extends Axiom_Widget {

    public $fields   = array(
                            
                            array(
                                'name'    => 'Title',
                                'id'      => 'title',
                                'type'    => 'textbox',
                                'value'   => ''
                            ),
                            array(
                                'name'    => 'Twitter Username',
                                'id'      => 'username',
                                'type'    => 'textbox',
                                'value'   => ''
                            ),
                            array(
                                'name'    => 'Display Avatar?',
                                'id'      => 'show_avatar',
                                'type'    => 'select',
                                'value'   => 'yes',
                                'options' => array( "yes" => "Yes" , "no" => "No")
                            ),
                            array(
                                'name'    => 'Number of Tweets to show',
                                'id'      => 'num',
                                'type'    => 'select',
                                'value'   => '4',
                                'options' => array( "1" => "1" , "2" => "2", "3" => "3" , "4"  => "4" , "5" => "5"  , "6" => "6",
                                                    "7" => "7" , "8" => "8", "9" => "9" , "10" => "10","11" => "11" , "12" => "12" )
                            )
                            
                        );
    

    /** constructor */

    function __construct() {
            
        parent::__construct();

        parent::WP_Widget( "recent_tweets" , $name = '[axiom] Recent Tweets' /* Name */     , 

                           array( 'description' => 'Most Recent Tweets' ) );
    }



    // outputs the content of the widget

    function widget( $args, $instance ) {

        extract( $args );
        
        $title = apply_filters( 'widget_title', $instance['title'] );
        
        
        
        $user = $instance["username"];
        
        if(empty($user)) return __("Twitter username not found", "default");
        
    
        // splite usernames and store in a string for passing to minitwitter
        $user   = explode(',', $user);
        $users  = '[ ';
        foreach ($user as $value) {
            $users .= '"'.trim($value).'", ';
        }
        $users .= ']'; 
        
        
              
        $avatar = $instance["show_avatar"];
        $avatar = ($avatar == 'yes' || $avatar === true)?1:0;
        
        
        // create an unique id for tweets wrapper
        if(empty($uid)) { $uid = uniqid();$uid = substr($uid, -3); }
        
        wp_enqueue_script ('minitwitter');  
        

        echo    $before_widget;

        if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }
        
        ?>    
                    
        
        <div class="axi_tweets<?php echo $uid; ?>"><?php _e('Loading Tweets ...', 'default') ?></div>
        
        
        <script>
            jQuery(function($){
                $('.axi_tweets<?php echo $uid; ?>').miniTwitter( { 
                    username:<?php echo $users; ?>, 
                    avatar:<?php echo $avatar ?>,
                    limit:<?php echo $instance['num']; ?> 
                });
            });
        </script>
           
<?php   
        
        echo    $after_widget;
    }
    


} // end widget class



// register Widget

add_action( 'widgets_init', create_function( '', 'register_widget("AxiRecentTweetsWidget");' ) );

?>