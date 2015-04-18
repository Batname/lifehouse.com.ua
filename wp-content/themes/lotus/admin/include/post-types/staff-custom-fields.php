<?php
/**
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */

/*=================================================================================================

	Add Staff custom fields
 
 *================================================================================================*/
 
$axi_service_metabox        = new AxiomMetabox();
$axi_service_metabox->id    = "axi_staff_info_meta_box";
$axi_service_metabox->title = __('Staff Information', 'default');
$axi_service_metabox->type  = array('staff');
$axi_service_metabox->fields= array(
                                    array(
                                        'name'   => __('Position', 'default'),
                                        'desc'   => '',
                                        'id'     => 'axi_staff_position',
                                        'type'   => 'textbox',
                                        'std'    => ''
                                    ),
                                    array(
                                        'name'   => __('Occupation', 'default'),
                                        'desc'   => '',
                                        'id'     => 'axi_staff_occupation',
                                        'type'   => 'textbox',
                                        'std'    => ''
                                    ),
                                    array(
                                        'name'   => __('Email', 'default'),
                                        'desc'   => 'for example user@gmail.com',
                                        'id'     => 'axi_staff_email',
                                        'type'   => 'textbox',
                                        'std'    => ''
                                    ),
                                    array(
                                        'name'   => __('Website', 'default'),
                                        'desc'   => 'for example http://www.domain.com',
                                        'id'     => 'axi_staff_website',
                                        'type'   => 'textbox',
                                        'std'    => ''
                                    ),
                                     array(
                                        'name'   => __('Facebook', 'default'),
                                        'desc'   => 'for example http://www.facebook.com/username',
                                        'id'     => 'axi_staff_facebook',
                                        'type'   => 'textbox',
                                        'std'    => ''
                                    ),
                                    array(
                                        'name'   => __('Twitter', 'default'),
                                        'desc'   => 'for example http://www.twitter.com/username',
                                        'id'     => 'axi_staff_twitter',
                                        'type'   => 'textbox',
                                        'std'    => ''
                                    ),
                                    array(
                                        'name'   => __('Google plus', 'default'),
                                        'desc'   => 'for example http://plus.google.com/username',
                                        'id'     => 'axi_staff_gplus',
                                        'type'   => 'textbox',
                                        'std'    => ''
                                    ),
                                    array(
                                        'name'   => __('Linkedin', 'default'),
                                        'desc'   => 'for example http://www.linkedin.com/username',
                                        'id'     => 'axi_staff_linkedin',
                                        'type'   => 'textbox',
                                        'std'    => ''
                                    )
                                );
$axi_service_metabox->init();


?>