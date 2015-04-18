<?php
/**
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
 
/*=================================================================================================

	Add Portfolio custom fields
 
 *================================================================================================*/

$prefix = 'axi_';
$fields = array();
$field_nums = 12;

$fields[] = array(
                'name' => __('Inserting Video (Youtube/Vimeo)', 'default').'<br/>',
                'desc' => __('If you want to add video to your portfolio, add your vimeo/youtube links here. else leave them blank.', 'default') ,
                'type' => 'sep',
            );

// Define vimeo upload fields
for ($i=1; $i <= 4; $i++) { 
    $fields[] = array(
        'name' => __('Video', 'default').' ('.$i.')',
        'desc' => '',
        'id' => $prefix.'vimeo_link'.$i,
        'type' => 'textbox',
        'std' => ''
    );
}


$fields[] = array(
                'name' => __('Upload your images and then click "insert into post"', 'default').'<br/>',
                'desc' => __('For adding image from url , click browse, "from URL" tab. Fill "URL" and "Link Image To" and then click "insert into post"', 'default'),
                'type' => 'sep',
            );

// Define image upload fields
for ($i=1; $i <= $field_nums; $i++) { 
    $fields[] = array(
        'name' => __('Image', 'default').' ('.$i.')',
        'desc' => '',
        'id' => $prefix.'custom_image'.$i,
        'type' => 'media',
        'class' => 'media_upload_field',
        'upload_std' => __('Browse', 'default'),
        'remove_std' => __('Remove', 'default'),
        'std' => ''
    );
}
unset($prefix, $field_nums);


/* Define Portfolio Image Metabox Fields -----------------
 * -----------------------------------------------------*/
 
$axi_gen_bg_metabox        = new AxiomMetabox();
$axi_gen_bg_metabox->id    = "axi_portfolio_image_meta_box";
$axi_gen_bg_metabox->title = __('Portfolio Previews', 'default');
$axi_gen_bg_metabox->type  = array( 'portfolio');
$axi_gen_bg_metabox->fields= $fields;
$axi_gen_bg_metabox->init();

?>