<?php
/**
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
global $post;
 
// get all fleslider and nivo slider ids ------------------
$slider_ids = array("none" => __("Choose ..", "default") );

$args = array(
  'post_type' => 'slider',
  'orderby' => "date",
  'post_status' => 'publish',
  'posts_per_page' => -1
);

$th_query = null;
$th_query = new WP_Query($args);  
if( $th_query->have_posts() ):  while ($th_query->have_posts()) : $th_query->the_post();
    $opts = get_post_meta($th_query->post->ID, 'slider-data', true); 
    if(!isset($opts) || !is_array($opts)) continue;
    $type = $opts["type"];
    $slider_ids[$th_query->post->ID] = '['.$type.' ] '. get_the_title();
    unset($args, $opts, $type);
endwhile; endif; 
wp_reset_query();


// get all revslider aliases-------------------------------
if (class_exists('RevSlider')) { // if revSlider is active
    
    $slider = new RevSlider();
    $arrSliders = $slider->getArrSliders();
    
    foreach ($arrSliders as $slider) {
        $slider_ids[$slider->getAlias()] = '[revo ] '.$slider->getTitle();
    }
    
    unset($slider, $arrSliders);
}

// get all layeslider items -------------------------------

// Check if the file is available to prevent warnings
if(file_exists(ADMIN_INC . 'modules/LayerSlider/layerslider.php')) {
        
    // Get WPDB Object
    global $wpdb;
 
    // Table name
    $table_name = $wpdb->prefix . "layerslider";
 
    // Get sliders
    $sliders = $wpdb->get_results( "SELECT * FROM $table_name
                                    WHERE flag_hidden = '0' AND flag_deleted = '0'
                                    ORDER BY date_c ASC LIMIT 100" );
 
    // Iterate over the sliders
    foreach($sliders as $key => $item) {
        $slider_ids['ls_'.$item->id] = '[layer] '. $item->name;
    }
    
}

// get all cute slider items ------------------------------

// Check if the file is available to prevent warnings
if(file_exists(ADMIN_INC . 'modules/CuteSlider/cuteslider.php')) {
    
    // Get WPDB Object
    global $wpdb;
 
    // Table name
    $table_name = $wpdb->prefix . "cuteslider";
 
    // Get sliders
    $sliders = $wpdb->get_results( "SELECT * FROM $table_name
                                    WHERE flag_hidden = '0' AND flag_deleted = '0'
                                    ORDER BY date_c ASC LIMIT 100" );
 
    // Iterate over the sliders
    foreach($sliders as $key => $item) {
        $slider_ids['cs_'.$item->id] = '[cute ] '. $item->name;
    }
    
}

/*==================================================================================================
  
    Add Page Option meta box
 
 *=================================================================================================*/

$axi_page_ops_metabox        = new AxiomMetabox();
$axi_page_ops_metabox->id    = "axi_page_option_meta_box";
$axi_page_ops_metabox->title = __('Display Options', 'default');
$axi_page_ops_metabox->type  = array('page');
$axi_page_ops_metabox->fields= array(
                                    array(
                                        'name' => __('Layout', 'default'),
                                        'desc' => __('Specifies page layout', 'default'),
                                        'id' => 'page_layout',
                                        'type' => 'dropdown',
                                        'options' => array( "no-sidebar" => __("No Sidebar", "default"), "right-sidebar" => __("Right Sidebar", "default"), "left-sidebar" => __("Left Sidebar", "default") )
                                    ),
                                    
                                    array(
                                        'name' => __('Slider Options', 'default'),
                                        'desc' => '',
                                        'type' => 'sep',
                                    ),
                                    array(
                                        'name' => __('Page Slider?', 'default'),
                                        'desc' => __('Please select the slider you want to display at top of the page<br/>Revolution Slider Items are marked by [revo], Cuteslider by [cute], Layer slider by [layer]. Others are Items from Nivo & Flex slider."', 'default'),
                                        'id' => 'top_slider_id',
                                        'type' => 'dropdown',
                                        'options' => $slider_ids
                                    ),
                                    array(
                                        'name' => __('Slider Width', 'default'),
                                        'desc' => __('If you choose "Full", the slider fits to the page width<br/>Please note that this option is only for FlexSlider, NivoSlider & LayerSlider ( [flex], [nivo] ). For other slider types, you can set this option directly in slider\'s panel.', 'default'),
                                        'id' => 'top_slider_width',
                                        'type' => 'dropdown',
                                        'options' => array( "full" => __("Full", "default"), "boxed" => __("Boxed", "default") )
                                    ),
                                    array(
                                        'name' => __('Slider Divider', 'default'),
                                        'desc' => __('You can select a divider to be displaied at the bottom of slider', 'default'),
                                        'id' => 'top_slider_divider',
                                        'type' => 'dropdown',
                                        'options' => array( "pattern" => __("Pattern", "default"), "none" => __("None", "default") )
                                    )
                                    
                                );
$axi_page_ops_metabox->init();

unset($slider_ids);

?>