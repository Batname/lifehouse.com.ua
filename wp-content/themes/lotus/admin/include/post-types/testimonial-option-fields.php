<?php
    
/*==================================================================================================
  
    Add Testimonial Customer info meta box
 
 *=================================================================================================*/

$testi_customer_metabox         = new AxiomMetabox();
$testi_customer_metabox->id     = "axi_testi_customer_meta_box";
$testi_customer_metabox->title  = __('Customer Info', 'default');
$testi_customer_metabox->type   = array('testimonial');
$testi_customer_metabox->fields = array(
                                    array(
                                        'name' => __('Customer Job', 'default'),
                                        'desc' => ' ',
                                        'id'   => 'customer_job',
                                        'type' => 'textbox',
                                        'std'  => ''
                                    ),
                                    array(
                                        'name' => __('Customer Link'  , 'default'),
                                        'desc' => __('a link to customer web page', 'default'),
                                        'id'   => 'customer_url',
                                        'type' => 'textbox',
                                        'std'  => ''
                                    )
                                );
$testi_customer_metabox->init();

?>