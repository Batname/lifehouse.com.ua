<?php

/*-----------------------------------------------------------------------------------*/
/*  message box
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'msgbox', 'axiom_shortcode_msgbox' );

function axiom_shortcode_msgbox( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'size'      => '', // section size
                'title'     => '', // section title
                'type'      => '', // box type
                'show_icon' => 'no' // section title
            )
            , $atts ) 
          );  
    
    $icon = "";
    switch ($type) {
        case 'success':
            $icon = "icon-ok-sign";
            break;
        case 'warn':
            $icon = "icon-exclamation-sign";
            break;
        case 'error':
            $icon = "icon-remove-sign";
            break;
        case 'info':
            $icon = "icon-info-sign";
            break;
        case 'help':
            $icon = "icon-info-sign";
            break;
        case 'notice':
            $icon = "icon-bell";
            break;
        default:
            $icon ="";
            break;
    } 
    
    if($show_icon != "yes") $type   .= " no-icon";
    if(empty($content))     $content = __("No Message", "default"); 
    
    ob_start();
?>
        <?php if(!empty($size)) { ?>
        <section class="widget-container <?php echo axiom_get_grid_name($size); ?>">
        <?php } ?>
            
            <p class="msgbox <?php echo $type; ?>">
                <?php if($show_icon == "yes") { ?>
                <i class="<?php echo $icon; ?>"></i>
                <?php } ?>
                <a href="" class="close icon-remove"></a>
                <?php echo do_shortcode($content); ?>
            </p>
        
        <?php if(!empty($size)) { ?>
        </section><!-- widget-container -->
        <?php } ?>
<?php    
    return ob_get_clean();
}


?>