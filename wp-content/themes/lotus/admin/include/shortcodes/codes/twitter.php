<?php

/*-----------------------------------------------------------------------------------*/
/*  Twitter
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'latest_tweets', 'axiom_shortcode_latest_tweets' );

function axiom_shortcode_latest_tweets( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'size'      => '75',  // section size
                'title'     => '',    // section title
                'user'      => '',    
                'avatar'    => 'yes', // display tweet avatar or not
                'limit'     => 3, 
                'uid'       => ''
            )
            , $atts ) 
          );  
    
    if(empty($user)) return __("Twitter username not found", "default");
    
    // splite usernames and store in a string for passing to minitwitter
    $user   = explode(',', $user);
    $users  = '[ ';
    foreach ($user as $value) {
        $users .= '"'.trim($value).'", ';
    }
    $users .= ']'; 
          
    
    $avatar = ($avatar == 'yes' || $avatar === true)?1:0;
    
    
    // create an unique id for tweets wrapper
    if(empty($uid)) { $uid = uniqid();$uid = substr($uid, -3); }
    
    wp_enqueue_script ('minitwitter');
    
    ob_start();
?>
      
        <section class="widget-tweets widget-container  <?php echo axiom_get_grid_name($size); ?>">
            
            <?php if(!empty($title))  echo get_widget_title($title, ""); ?>
            
            <div class="axi_tweets<?php echo $uid; ?>"><?php _e('Loading Tweets ...', 'default') ?></div>
            
        </section><!-- end widget-tweets -->
        
        <script>
            jQuery(function($){
                $('.axi_tweets<?php echo $uid; ?>').miniTwitter( { 
                    username:<?php echo $users; ?>, 
                    avatar:<?php echo $avatar ?>,
                    limit:<?php echo $limit ?> 
                });
            });
        </script>
        
<?php    
    return ob_get_clean();
}


?>