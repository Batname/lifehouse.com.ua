<?php
/**
 * Include custom post types here
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
 
/*-----------------------------------------------------------------------------------*/
/*	Register Post-Types
/*-----------------------------------------------------------------------------------*/

require_once( ADMIN_INC.'post-types/axiom_metabox.php');
require_once( ADMIN_INC.'post-types/portfolio-type.php');
require_once( ADMIN_INC.'post-types/product-type.php');
require_once( ADMIN_INC.'post-types/news-type.php');
require_once( ADMIN_INC.'post-types/staff-type.php');
require_once( ADMIN_INC.'post-types/faq-type.php');
require_once( ADMIN_INC.'post-types/testimonial-type.php');
require_once( ADMIN_INC.'post-types/service-type.php');
require_once( ADMIN_INC.'post-types/slider-type.php');
require_once( ADMIN_INC.'post-types/pricetable-type.php');
require_once( ADMIN_INC.'price/index.php');

require_once( ADMIN_INC.'modules/slider/index.php');


if(is_admin()){
    require_once( ADMIN_INC.'post-types/portfolio-image-fields.php');
    require_once( ADMIN_INC.'post-types/portfolio-option-fields.php');
    require_once( ADMIN_INC.'post-types/product-image-fields.php');
    require_once( ADMIN_INC.'post-types/product-option-fields.php');
    require_once( ADMIN_INC.'post-types/news-option-fields.php');
    
    require_once( ADMIN_INC.'post-types/staff-custom-fields.php');
    
    require_once( ADMIN_INC.'post-types/testimonial-option-fields.php');
    
    require_once( ADMIN_INC.'post-types/service-option-fields.php');
    
    require_once( ADMIN_INC.'post-types/general-custom-fields.php');
    require_once( ADMIN_INC.'post-types/general-option-fields.php');
    require_once( ADMIN_INC.'post-types/general.php');
    
    require_once( ADMIN_INC.'post-types/page-option-fields.php');
    
    require_once( ADMIN_INC.'post-types/post-option-fields.php');
}



?>