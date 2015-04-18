<?php
/**
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
    
/*==================================================================================================
  
    Add Portfolio Option meta box
 
 *=================================================================================================*/

$axi_portfolio_metabox        = new AxiomMetabox();
$axi_portfolio_metabox->id    = "axi_portfolio_option_meta_box";
$axi_portfolio_metabox->title = __('Options', 'default');
$axi_portfolio_metabox->type  = array('portfolio');
$axi_portfolio_metabox->fields= array(
                                    
                                    array(
                                        'name' => __('Display Options', 'default'),
                                        'desc' => '',
                                        'type' => 'sep',
                                    ),
                                    array(
                                        'name' => __('Portfolio Layout', 'default'),
                                        'desc' => __('Specifies Images Position', 'default'),
                                        'id' => 'page_layout',
                                        'type' => 'dropdown',
                                        'options' => array( "right-sidebar" => __("Image On Left", "default"), "left-sidebar" => __("Image On Right", "default"), "no-sidebar" => __("Full Image On Top", "default") )
                                    ),
                                    array(
                                        'name' => __('Display Images as', 'default'),
                                        'desc' => __('You can display images in a "Slider", or on top of each other "No Slider"', 'default') . '<br />'.
                                                  __('Note: "Slider3" does not support videos', 'default'),
                                        'id' => 'display_type',
                                        'type' => 'dropdown',
                                        'options' => array( "flexslider1" => __("Slider1 (fade)", "default"), "flexslider2" => __("Slider2 (slide)", "default"), "nivoslider" => __("Slider3 (2d)", "default"), "none" => __("No slider", "default") )
                                    ),
                                    array(
                                        'name' => __('Highlight This Portfolio?', 'default'),
                                        'desc' => __('If you choose "Yes", in Portfolio Listing (archive) Page the cover image of this item appears 2x bigger in height.', 'default'),
                                        'id' => 'is_highlighted',
                                        'type' => 'dropdown',
                                        'options' => array( "no" => __("No", "default"), "yes" => __("Yes", "default"))
                                    ),
                                    array(
                                        'name' => __('Portfolio Info', 'default'),
                                        'desc' => '',
                                        'type' => 'sep',
                                    )
                                );
                                
// display portfolio custom data field if they already set in option panel                             
for ($i=1; $i <= 9; $i++) {
    if(!isset($axiom_options['portfolio_custom_meta_label'.$i]) ) continue;
    $label = $axiom_options['portfolio_custom_meta_label'.$i] ;
    if(empty($label)) continue;
    $axi_portfolio_metabox->fields[] = array(
                                            'name' => $label,
                                            'desc' => "",
                                            'id'   => 'axi_portfolio_custom_data'.$i,
                                            'type' => 'textbox',
                                            'std' => ''
                                          );
}

    $axi_portfolio_metabox->fields[] = array(
                                            'name' => __("Project's Link", 'default'),
                                            'desc' => "",
                                            'id'   => 'project-link',
                                            'type' => 'textbox',
                                            'std' => ''
                                          );
                                          
    $axi_portfolio_metabox->fields[] = array(
                                            'name' => __("Project's Link Label", 'default'),
                                            'desc' => __("Specifies a custom label for projects's link (optional)", "default"),
                                            'id'   => 'project-link-label',
                                            'type' => 'textbox',
                                            'std' => ''
                                          );
                                
                                
$axi_portfolio_metabox->init();
?>