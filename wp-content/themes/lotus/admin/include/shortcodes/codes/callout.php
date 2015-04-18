<?php

/*-----------------------------------------------------------------------------------*/
/*  Callout & Stunning
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'callout', 'axiom_shortcode_callout' );

function axiom_shortcode_callout( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'size'      =>  100, // section size
                'caption'   => '', 
                'type'      => 'callout', // callout, stunning
                'bgcolor'   => 'default', // #ffcc00
                'btn_label' => '',  
                'btn_link'  => '', 
                'title'     => 'Sample Title', // section title
                'target'    => 'self', // button link target
            )
            , $atts ) 
          );    
    
    ob_start();
?>
    <?php if($type == 'callout'): ?>
        
        <div class="dark callout <?php echo axiom_get_grid_name($size); if(!empty($btn_label)) echo " has_btn"; ?>">
           <?php if(!empty($btn_label)){ ?>
           <a href="<?php echo $btn_link; ?>" target="<?php echo '_'.$target; ?>" class="featured_btn"><span><?php echo $btn_label; ?></span></a>
           <?php } if(!empty($title)) { ?>
           <h3 class="widget-title"><?php echo $title; ?></h3>
           <?php } if(!empty($caption)) { ?>
           <p><?php echo $caption; ?></p>
           <?php } ?>
        </div>
        
    <?php elseif($type == 'stunning'): ?>
        
        <div class="stunning <?php echo axiom_get_grid_name($size); if(!empty($btn_label)) echo " has_btn" ?>">
           <?php if(!empty($btn_label)){ ?>
           <a href="<?php echo $btn_link; ?>" target="<?php echo '_'.$target; ?>" class="featured_btn button blue"><span><?php echo $btn_label; ?></span></a>
           <?php } if(!empty($title)) { ?>
           <h3 class="widget-title"><?php echo $title; ?></h3>
           <?php } if(!empty($caption)) { ?>
           <p><?php echo $caption; ?></p>
           <?php } ?>
        </div>
        
    <?php endif; ?>
<?php    
    return ob_get_clean();
}

?>