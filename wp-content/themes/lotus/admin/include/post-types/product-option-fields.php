<?php global $axiom_options;
/**
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
 
 
/*==================================================================================================
  
    Add Product data meta box
 
 *=================================================================================================*/

$reg_p_price = isset($axiom_options['product_regular_price_label'])?$axiom_options['product_regular_price_label']:"Regular Price";

$axi_product_data_metabox        = new AxiomMetabox();
$axi_product_data_metabox->id    = "axi_product_data_meta_box";
$axi_product_data_metabox->title = __('Product Data', 'default');
$axi_product_data_metabox->type  = array('axi_product');
$axi_product_data_metabox->fields= array(
                                    
                                    array(
                                        'name' => __('Overview', 'default'),
                                        'desc' => __('Small overview that displays on top of price (optional)', 'default'),
                                        'id'   => 'axi-product-overview',
                                        'type' => 'textarea',
                                        'std'  => ''
                                    ),
                                    array(
                                        'name' => __('Current Price', 'default'),
                                        'desc' => __('This is the current or sale price', 'default'),
                                        'id'   => 'product-price',
                                        'type' => 'textbox',
                                        'std'  => ''
                                    ),
                                    array(
                                        'name' => __( $reg_p_price, 'default'),
                                        'desc' => __('Pervoius price (optional)', 'default'),
                                        'id'   => 'product-reg-price',
                                        'type' => 'textbox',
                                        'std'  => ''
                                    ),
                                    array(
                                        'name' => __('In Stock?', 'default'),
                                        'desc' => __('determines if the product is in stock or not', 'default'),
                                        'id'   => 'product-in-stock',
                                        'type' => 'dropdown',
                                        'options' => array( "yes" => __("Yes", "default"), "no" => __("No", "default") )
                                    ),
                                    array(
                                        'name' => __('Purchase page (url)', 'default'),
                                        'desc' => __('A link for redirecting users to a page for buying this product.', 'default'). '<br/>'.
                                                  __('If you insert a link in this field, a purchase link appears under product info section.', 'default'). '<br />'.
                                                  __('info : you can change the link label from option panel > product setting (default label is "Buy Now")', 'default'),
                                        'id'   => 'product-buy-link',
                                        'type' => 'textbox',
                                        'std'  => ''
                                    )
                                );
                                
// display product custom data field if they already set in option panel                             
for ($i=1; $i <= 10; $i++) {
    if(!isset($axiom_options['product_custom_meta_label_0_'.$i])) continue;
    $label = $axiom_options['product_custom_meta_label_0_'.$i] ;
    if(empty($label)) continue;
    $axi_product_data_metabox->fields[] = array(
                                            'name' => __($label, 'default'),
                                            'desc' => "",
                                            'id'   => 'axi_product_custom_data'.$i,
                                            'type' => 'textbox',
                                            'std' => ''
                                          );
}
 
$axi_product_data_metabox->init();

unset($reg_p_price);
    
    
/*==================================================================================================
  
    Add Product options meta box
 
 *=================================================================================================*/
 
$axi_product_opts_metabox        = new AxiomMetabox();
$axi_product_opts_metabox->id    = "axi_product_option_meta_box";
$axi_product_opts_metabox->title = __('Display Options', 'default');
$axi_product_opts_metabox->type  = array('axi_product');
$axi_product_opts_metabox->fields= array(
                                    array(
                                        'name' => __('Display Options', 'default'),
                                        'desc' => '',
                                        'type' => 'sep',
                                    ),
                                    array(
                                        'name' => __('Layout', 'default'),
                                        'desc' => __('Specifies Product Images Position', 'default'),
                                        'id'   => 'page_layout',
                                        'type' => 'dropdown',
                                        'options' => array( "right-sidebar" => __("Image On Left", "default"), "left-sidebar" => __("Image On Right", "default") )
                                    ),
                                    array(
                                        'name' => __('Display Images as', 'default'),
                                        'desc' => __('You can display images in a "Slider", or on top of each other "No Slider"', 'default'),
                                        'id'   => 'display_type',
                                        'type' => 'dropdown',
                                        'options' => array( "flexslider1" => __("Slider1 (fade)", "default"), "flexslider2" => __("Slider2 (slide)", "default"), "none" => __("No slider", "default") )
                                    ),
                                );
$axi_product_opts_metabox->init();
 
?>