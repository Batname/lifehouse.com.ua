<?php
/**
 * General post-types configs here
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
 
/*-------------------------------------------------------------------------------------------------
 *  Change title promp text
 *-------------------------------------------------------------------------------------------------*/
 
function axiom_editpage_custom_title( $title ){

    $screen = get_current_screen();
    
    switch ($screen->post_type) {
        case 'staff':
            $title = __('Enter Staff Name Here'     , 'default');
            break;
        case 'faq':
            $title = __('Enter Question Here'       , 'default');
            break;
        case 'testimonial':
            $title = __('Enter Customer Name Here'  , 'default');
            break;
        case 'service':
            $title = __('Enter Service Name Here'   , 'default');
            break;
        case 'product':
            $title = __('Enter Product Name Here'   , 'default');
            break;
    }

    return $title;
}

add_filter( 'enter_title_here', 'axiom_editpage_custom_title' );


/*
 * portfolio    30
 * product      31
 * event        32
 * service      33
 * faq          34
 * staff        35
 * testimonial  36
 * slider       37
 * pricetable   38
 * */
?>