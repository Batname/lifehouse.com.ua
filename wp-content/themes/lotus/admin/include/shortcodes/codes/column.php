<?php

/*-----------------------------------------------------------------------------------*/
/*  Column
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'column', 'axiom_shortcode_column' );

function axiom_shortcode_column( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'size'      => '33', // section size
                'title'     => '', // section title
                'title_link'=> '', // the link on title
                'text_style'=> 'paragraph', // paragraph, blockquote
                'icon'      => '', // icon on column side
                'icon_color'=> '#4A9BDC',
                'image'     => '', // image on column side
                'image_position' => 'top' // top,left,right
            )
            , $atts ) 
          );  
    
    $icon = ($icon == "none")?"":$icon;
    
    ob_start();
?>
      
        <section class="widget-column  <?php echo axiom_get_grid_name($size); ?>">
            
            <section class="img-<?php echo $image_position; ?>">
                <?php if(!empty($icon) &&  empty($image)) { ?>
                <span class="<?php echo $icon; ?>" > </span>
                <?php }elseif(!empty($image)) { ?>
                <img src="<?php echo $image; ?>" alt="" />
                <?php }if(!empty($title) && empty($title_link) ) { ?>
                <h4 class="col-title"><?php echo $title; ?></h4>
                <?php }elseif(!empty($title) && !empty($title_link)) { ?>
                <h4 class="col-title"><a href="<?php echo $title_link; ?>"><?php echo $title; ?></a></h4>
                <?php } if(!empty($content)) { ?>
                <div class="entry-content">
                    <?php if($text_style == "blockquote") { 
                        echo do_shortcode('[blockquote]'.$content.'[/blockquote]');
                    }else { ?>
                        <p><?php echo do_shortcode($content); // paragraph style?></p>
                    <?php } ?>
                </div>
                <?php } ?>
            </section>
            
        </section><!-- widget-container -->
        
<?php    
    return ob_get_clean();
}

?>