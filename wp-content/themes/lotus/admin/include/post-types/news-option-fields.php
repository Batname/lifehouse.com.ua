<?php
/**
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
/*==================================================================================================
  
    Add News Option meta box
 
 *=================================================================================================*/

$axi_gen_ops_metabox        = new AxiomMetabox();
$axi_gen_ops_metabox->id    = "axi_news_option_meta_box";
$axi_gen_ops_metabox->title = __('News Options', 'default');
$axi_gen_ops_metabox->type  = array('news');
$axi_gen_ops_metabox->fields= array(/*
                                    array(
                                        'name' => __('Display Page Title?', 'default'),
                                        'desc' => __('Specifies whether the page title is visible or not', 'default'),
                                        'id' => 'show_title',
                                        'type' => 'select',
                                        'options' => array( "yes" , "no")
                                    ),
                                    array(
                                        'name' => __('Subtitle', 'default'),
                                        'desc' => __('Second Title (optional)', 'default'),
                                        'id'   => 'page_subtitle',
                                        'type' => 'textbox',
                                        'std' => ''
                                    ),*/
                                    array(
                                        'name' => __('Custom Date', 'default'),
                                        'desc' => __('If you need to display a date instead of news publish date, add the custom date here. for example 2013-05-05', 'default'),
                                        'id'   => 'custom_news_date',
                                        'type' => 'textbox',
                                        'std'  => ''
                                    ),
                                );
$axi_gen_ops_metabox->init();

?>