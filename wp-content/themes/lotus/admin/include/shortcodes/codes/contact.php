<?php

/*-----------------------------------------------------------------------------------*/
/*  Contact Form
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'contact_form', 'axiom_shortcode_contact_form' );

function axiom_shortcode_contact_form( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'size'      => '33',  // section size
                'title'     => '',    // section title
                'email'     => ''
            )
            , $atts ) 
          );  
    
    $wcf7 = $content;
    
    if(empty($wcf7) && isset($_POST['formSubmitted'])) {
        
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
    
    ob_start();
?>
        
        <section class="widget-contact widget-container <?php echo axiom_get_grid_name($size); ?>">
           
           <div class="widget-inner c_form">
               
                <?php if(!empty($title))  echo get_widget_title($title, ""); ?>
                
                <?php if(empty($wcf7)){ ?>
                
                <?php if(isset($hasError) ) { ?>
                    <p style="color:#B2950E" >
                        <span id="info"><?php _e("sorry, some problems occured with your form submission:", "default"); ?>
                        <?php 
                        if(isset($nameError ))   echo '<br/>- '.$nameError; 
                        if(isset($emailError))   echo '<br/>- '.$emailError; 
                        if(isset($commentError)) echo '<br/>- '.$commentError; 
                        ?>
                        
                        </span>
                    </p>
                <?php } ?>
                
                <form action="<?php the_permalink(); ?>" id="contactForm" method="post" > 
                    <input type="text"  name="cName"    id="cName"    placeholder="<?php _e('NAME*'    , 'default'); ?>"  required >
                    <input type="email" name="cEmail"   id="cEmail"   placeholder="<?php _e('EMAIL*'   , 'default'); ?>" required >
                    <input type="url"   name="cURL"     id="cURL"     placeholder="<?php _e('WEBSITE'  , 'default'); ?>" >
                    <textarea           name="cComment" id="cComment" placeholder="<?php _e('COMMENT*' , 'default'); ?>" required></textarea>
                    <input type="submit" class="night left"  value="<?php esc_attr_e('Send', 'default'); ?>" >
                    
                    <?php if(isset($emailSent) && $emailSent == true) { ?>
                    <p style="color:#598527;"><i class="icon-ok"></i><span id="info"><?php _e("Thanks for your Message. Your message sent successfully.", "default"); ?></span></p>
                    <?php } ?>
                    
                    <input type="hidden" name="formSubmitted" id="formSubmitted" value="true" />
                </form>   
                
                <?php } else {
                    echo do_shortcode($wcf7);
                } ?>                              
               
           </div><!-- widget-inner -->
            
        </section><!-- widget-contact --> 
        
<?php    
    return ob_get_clean();
}

?>