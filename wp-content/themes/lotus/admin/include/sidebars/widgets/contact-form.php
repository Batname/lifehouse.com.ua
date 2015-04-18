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

 *  Contact Form widget

 * --------------------------------------------*/



class AxiContactWidget extends Axiom_Widget {

    public $fields   = array(
                            array(
                                'name'    => 'Title',
                                'id'      => 'title',
                                'type'    => 'textbox',
                                'value'   => ''
                            ),
                            array(
                                'name'    => 'Email Address',
                                'id'      => 'email',
                                'type'    => 'textbox',
                                'value'   => ''
                            )
                        );

    

    /** constructor */

    function __construct() {
        
        parent::__construct();
        
        parent::WP_Widget( "contact_form" , $name = '[axiom] Contact Form' /* Name */     , 

                           array( 'description' => 'Add contact Form too sidebar' ) );
    }
    


    // outputs the content of the widget

    function widget( $args, $instance ) {

        extract( $args );
        
        $title = apply_filters( 'widget_title', $instance['title'] );
        $email = $instance['email'];
        
        
        
        
        if(isset($_POST['formSubmitted'])) {
        
        if(trim($_POST['cName']) === '' ) {
            $nameError = __('Please enter your name.', 'default');
            $hasError = true;
        } else {
            $name = trim($_POST['cName']);
        }

        if( trim($_POST['cEmail']) === '' )  {
                $emailError = __('Please enter your email address.', 'default');
                $hasError = true;
            } else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['cEmail']))) {
                $emailError = __('You entered an invalid email address.', 'default');
                $hasError = true;
            } else {
                $cEmail = trim($_POST['cEmail']);
            }
            
            
            $url = trim($_POST['cURL']);
            
        
            if(trim($_POST['cComment']) === '' ) {
                $commentError = __('Please enter a message.', 'default');
                $hasError = true;
            } else {
                if(function_exists('stripslashes')) {
                    $comment = stripslashes(trim($_POST['cComment']));
                } else {
                    $comment = trim($_POST['cComment']);
                }
            }
        
            if(!isset($hasError)) {
                $emailTo = $email;
                if (!isset($emailTo) || empty($emailTo) ){
                    $emailTo = get_option('admin_email');
                }
                $subject = 'From '.$name.' ['.$cEmail.'] ';
                $body    = "Name: $name \n\nEmail: $cEmail \n\nWebsite: $url \n\nMessage: $comment";
                $headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
        
                wp_mail($emailTo, $subject, $body, $headers);
                $emailSent = true;
            }
        } 
        
        

        echo    $before_widget;

        if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }

        echo    '<div class="widget-inner c_form ">';
        
        
        
        if(isset($hasError) ) { ?>
            
        <p style="color:#B2950E" >
            <span id="info">sorry, some problems occured with your form submission:
            <?php 
            if(isset($nameError ))   echo '<br/>- '.$nameError; 
            if(isset($emailError))   echo '<br/>- '.$emailError; 
            if(isset($commentError)) echo '<br/>- '.$commentError; 
            ?>
            
            </span>
        </p>
            
        <?php } ?>
        
        <form action="<?php the_permalink(); ?>" id="contactForm" method="post" > 
            <input type="text"  name="cName"    id="cName"    placeholder="<?php _e('name*'    , 'default'); ?>"  required >
            <input type="email" name="cEmail"   id="cEmail"   placeholder="<?php _e('email*'   , 'default'); ?>" required >
            <input type="url"   name="cURL"     id="cURL"     placeholder="<?php _e('website'  , 'default'); ?>" >
            <textarea           name="cComment" id="cComment" placeholder="<?php _e('message*' , 'default'); ?>" required></textarea>
            <input type="submit" class="night left flat"  value="<?php esc_attr_e('Send', 'default'); ?>" >
            
            <?php if(isset($emailSent) && $emailSent == true) { ?>
            <p style="color:#598527;"><i class="icon-ok"></i><span id="info"><?php _e("Thanks for your Message. Your message sent successfully.", "default"); ?></span></p>
            <?php } ?>
            
            <input type="hidden" name="formSubmitted" id="formSubmitted" value="true" />
        </form>     
        
        
        <?php
        echo    '</div>', $after_widget;
    }
    


} // end widget class



// register Widget

add_action( 'widgets_init', create_function( '', 'register_widget("AxiContactWidget");' ) );

?>