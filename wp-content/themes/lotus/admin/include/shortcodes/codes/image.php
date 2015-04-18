<?php 

/*-----------------------------------------------------------------------------------*/
/*  Image 
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'image'      , 'axiom_shortcode_image' );
add_shortcode( 'picture'    , 'axiom_shortcode_image' );

function axiom_shortcode_image( $atts, $content = null ) {
    
     extract( shortcode_atts( 
        array( 
            'id'        => '', // attachment id
            'src'       => '', // image url
            'link'      => '', // link on image
            'alt'       => '', // alternative text
            'width'     => '',
            'height'    => '',
            'icon'      => 'plus', // icon type. plus, zoom
            'lightbox'  => 'no' // open in lightbox or not
        )
        , $atts ) 
      ); 
    
    $rel = "";
    if($lightbox == 'yes') {
         $link = $src; $rel = 'data-rel="prettyPhoto" '; 
    }
    
    if(!empty($id) && is_numeric($id) ) {
        
        $width = (!empty($width)  && is_numeric($width) )?$width:'635';
        $height= (!empty($height) && is_numeric($height))?$height:'400';
        $src   = av3_get_attachment_url($id, array($width, $height)); 
        $link  = av3_get_attachment_url($id, 'large'); 
    }
       
    ob_start(); 
?>

<?php // if light box is needed use imgHolder ?>
<?php if($lightbox == 'yes') { ?>

<div class="imgHolder" >
    <?php if(!empty($link)) { ?>
    <a href="<?php echo esc_attr($link); ?>"  <?php echo $rel; ?> >
        <img alt="<?php echo esc_attr($alt); ?>" src="<?php echo $src; ?>" />
        <span></span>
    </a>
    <?php } else { ?>
    <img alt="<?php echo esc_attr($alt); ?>" src="<?php echo $src; ?>" />
    <?php } ?>
    
    <ul>
        <li class="hover-plus"><a href="<?php echo esc_attr($link); ?>"  <?php echo $rel; ?>  ></a></li>
    </ul>
</div>

<?php } else { ?>

    <?php if(!empty($link)) { ?>
    <a href="<?php echo esc_attr($link); ?>"  <?php echo $rel; ?> >
        <img alt="<?php echo esc_attr($alt); ?>" src="<?php echo $src; ?>" />
    </a>
    <?php } else { ?>
    <img alt="<?php echo esc_attr($alt); ?>" src="<?php echo $src; ?>" />
    <?php } ?>

<?php } ?>

<?php
    return ob_get_clean();
}


/*-----------------------------------------------------------------------------------*/
/*  Widget Image 
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'image_widget'      , 'axiom_shortcode_image_widget' );

function axiom_shortcode_image_widget( $atts, $content = null ) {
    
     extract( shortcode_atts( 
        array( 
            'size'      => '',
            'title'     => '',
            'id'        => '', // attachment id
            'src'       => '', // link on image
            'link'      => '', // link on image
            'alt'       => '', // alternative text
            'icon'      => 'plus', // icon type. plus, zoom
            'lightbox'  => 'no' // open in lightbox or not
        )
        , $atts ) 
      ); 
       
    ob_start(); 
?>

        <section class="widget-image widget-container <?php echo axiom_get_grid_name($size); ?>">
            
           <?php if(!empty($title)) echo get_widget_title($title, ""); ?>
           
           <div class="widget-inner">
               <?php 
               $attrs = ' id ="'.$id.'" src="'.$src.'" link="'.$link.'" alt="'.$alt.'" icon="'.$icon.'" lightbox="'.$lightbox.'"  ';
               echo do_shortcode( '[image '. $attrs .' ]'); 
               ?>
               
           </div>
           
       </section>

<?php
    return ob_get_clean();
}


?>