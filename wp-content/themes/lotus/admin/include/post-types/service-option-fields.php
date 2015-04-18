<?php
/**
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
 
   
/*==================================================================================================
  
    Add Sevice Option meta box
 
 *=================================================================================================*/

$axi_service_metabox        = new AxiomMetabox();
$axi_service_metabox->id    = "axi_service_option_meta_box";
$axi_service_metabox->title = __('Display Setting', 'default');
$axi_service_metabox->type  = array('service');
$axi_service_metabox->fields= array(
                                    array(
                                        'name' => __('Layout', 'default'),
                                        'desc' => __('Specifies page layout', 'default'),
                                        'id' => 'page_layout',
                                        'type' => 'dropdown',
                                        'options' => array( "no-sidebar" => __("No Sidebar", "default"), "right-sidebar" => __("Right Sidebar", "default"), "left-sidebar" => __("Left Sidebar", "default") )
                                    ),
                                    array(
                                        'name' => __('Custom Icon', 'default'),
                                        'desc' => 'you can set an icon to service. so when you want to preview several services in grid view this icon will appear beside text column.(this icon only displays in services grid views)',
                                        'id'   => 'service_icon',
                                        'type' => 'icon',
                                    )
                                );
$axi_service_metabox->init();

?>