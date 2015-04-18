<?php

/*-----------------------------------------------------------------------------------*/
/*  List Item
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'list', 'axiom_shortcode_list' );

function axiom_shortcode_list( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'size'      =>  25, // section size
                'title'     => '', // section title
                'style'     => '', // icon style
                'border'    => '' // section title
            )
            , $atts ) 
          );  
      
    if($border == 'dotted' || $border == 'dashed' ) {
        $border = "bordered ".$border;
    }else { $border = ""; }
    
    $listtype = ($style == "decimal")?"ol":"ul";
    
    $style = ($style == "none")?"":$style;
    
    ob_start();
?>
        
        <section class="widget-container widget-list <?php echo axiom_get_grid_name($size); ?>">
            
            <?php if(!empty($title))  echo get_widget_title($title, ""); ?>

            <<?php echo $listtype; ?> class="<?php echo $style.' '.$border; ?>">
                <?php echo do_shortcode($content); // accepts <li><li>?>
            </<?php echo $listtype; ?>>
            
        </section><!-- widget-container -->
        
<?php    
    return ob_get_clean();
}


/* list item -------------------------*/

add_shortcode( 'list_item', 'axiom_shortcode_list_item' );

function axiom_shortcode_list_item( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'link'     => '' // link on list child element
            )
            , $atts ) 
          );    
    $output = (empty($link))?'<li>'.do_shortcode($content).'</li>':'<li><a href="'.$link.'" target="_blank" >'.do_shortcode($content).'</a></li>';
         
    return $output;
}



?>