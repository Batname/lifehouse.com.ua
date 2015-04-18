<?php
/**
 * Includes all theme shortcodes
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
  
/*-----------------------------------------------------------------------------------*/
/*  Caption 
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'caption', 'caption_shortcode' );

function caption_shortcode( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 'class' => 'caption' )
            , $atts ) 
          );
   return '<h2 class="' . esc_attr($class) . '">' . do_shortcode($content) . '</h2>';
}



include "codes/carousel.php";
include "codes/faq.php";
include "codes/pricetable.php";
include "codes/services.php";
include "codes/latest-news.php";
include "codes/latest-blog.php";
include "codes/latest-products.php";
include "codes/staffs.php";
include "codes/smartpagebuilder.php";
include "codes/video.php";
include "codes/audio.php";
include "codes/column.php";
include "codes/blockquote.php";
include "codes/link.php";
include "codes/divider.php";
include "codes/msgbox.php";
include "codes/tabs.php";
include "codes/list.php";
include "codes/accordion.php";
include "codes/callout.php";
include "codes/related-posts.php";
include "codes/latest-items.php";
include "codes/brands.php"; // clients, partners
include "codes/gmap.php";
include "codes/testimonial.php";
include "codes/testimonial-item.php";
include "codes/testimonial-slider.php";
include "codes/get-testimonials.php";
include "codes/contact.php";
include "codes/twitter.php";
include "codes/soundcloud.php";
include "codes/dropcap.php";
include "codes/button.php";
include "codes/image.php";
include "codes/flexslider.php";
include "codes/get-flexslider.php";
include "codes/nivoslider.php";
include "codes/get-nivoslider.php";
include "codes/get-slider.php";
include "codes/chart.php";
include "codes/highlight.php";
include "codes/code.php";
include "codes/get-pages.php";
include "codes/col.php";
include "codes/gallery.php";

?>