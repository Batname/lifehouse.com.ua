<?php
/**
 * Options for theme option panel
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
 
/* ---------------------------------------------------------------------------------------------------
    Declare vars
--------------------------------------------------------------------------------------------------- */
 
$options = array();

/*
$options[] = array( 'title' => 'Radio Field',
                    'desc'  => 'Here goes the description for this field.',
                    'id'    => 'radio_field1',
                    'opts'  => array(   'Option Title 3' => 'option_value_3' , 
                                        'Option Title 4' => 'option_value_4' ),
                    'std'   => 'option_value_3',
                    'type'  => 'radio' );

$options[] = array( 'title' => 'Image Background',
                    'desc'  => 'Here you can select one of these patterns as site image background',
                    'id'    => 'site_body_background_pattern',

                     
                    'opts'  => array(   'id'  =>   array( 'Title'  => ADMIN_INC_URL.'options/assets/images/layouts/layout-left-sidebar.jpg') ,
                                        'id'  =>   array( 'Title'  => ADMIN_INC_URL.'options/assets/images/layouts/layout-fullwidth.jpg') 
                                    ),
                    'std'   => '',
                    'type'  => 'selector' );
*/

/* ---------------------------------------------------------------------------------------------------
    Style Section
--------------------------------------------------------------------------------------------------- */

 
/* ---------------------------------------------------------------------------------------------------
    General Section
--------------------------------------------------------------------------------------------------- */
 
$options[] = array( 'title' => __('General Setting', 'default'),
                    'type'  => 'start',
                    'id'    => 'general-options-section',
                    'desc'  => __('description for General section', 'default') );
                    
$options[] = array( 'title' => __('Website Layout', 'default'),
                    'desc'  => 'If you choose "Boxed", site content will wrap in a box',
                    'id'    => 'site_layout_style',
                    'opts'  => array(   'full' => 'Full', 
                                        'boxed'  => 'Boxed' ),
                    'std'   => 'full',
                    'type'  => 'select' );
                    
$options[] = array( 'title' => __('Enable Responsiveness?', 'default'),
                    'desc'  => __('This option allow you to enable or disable website reponsiveness', 'default'),
                    'id'    => 'enable_site_reponsiveness',
                    'std'   => 'checked',
                    'type'  => 'checkbox' );
                    
$options[] = array( 'title' => __('Website Background Setting', 'default'),
                    'desc'  => __('Note : you need to set "Website Layout" to "Box" in order to see website Background.', 'default'),
                    'id'    => '',
                    'std'   => '',
                    'type'  => 'sep' );
                    
$options[] = array( 'title' => __('Background Color', 'default'),
                    'desc'  => __('Specifies the color of website background', 'default'),
                    'id'    => 'site_body_background_color',
                    'std'   => '#eeeeee',
                    'type'  => 'colorpicker' );
                    
$options[] = array( 'title' => __('Image Background', 'default'),
                    'desc'  => __('Here you can select one of these patterns as site image background', 'default'),
                    'id'    => 'site_body_background_pattern',
                    'opts'  => array(   ''   => __('Choose ..', 'default'), 
                                        'cross-1.png'  => __('cross-1', 'default'), 
                                        'cross-2.png'  => __('cross-2', 'default') ,
                                        'cross-3.png'  => __('cross-3', 'default') ,
                                        'cross-grid-1.png'  => __('cross-grid-1', 'default'), 
                                        'cross-grid-2.png'  => __('cross-grid-2', 'default'), 
                                        'cross-grid-3.png'  => __('cross-grid-3', 'default'), 
                                        'cross-grid-4.png'  => __('cross-grid-4', 'default'), 
                                        'cross-grid-5.png'  => __('cross-grid-5', 'default'), 
                                        'cross-grid-6.png'  => __('cross-grid-6', 'default'), 
                                        'dot-1.png'  => __('dot-1', 'default'), 
                                        'dot-2.png'  => __('dot-2', 'default'), 
                                        'dot-3.png'  => __('dot-3', 'default'), 
                                        'dot-4.png'  => __('dot-4', 'default'), 
                                        'dot-5.png'  => __('dot-5', 'default'), 
                                        'grid-1.png'  => __('grid-1', 'default'), 
                                        'horizontal-1.png'  => __('horizontal-1', 'default'), 
                                        'horizontal-2.png'  => __('horizontal-2', 'default'), 
                                        'line-1.png'  => __('line-1', 'default'), 
                                        'line-2.png'  => __('line-2', 'default'), 
                                        'misc-1.png'  => __('misc-1', 'default'),
                                        'misc-1.png'  => __('misc-1', 'default'),
                                        'misc-2.png'  => __('misc-2', 'default'),
                                        'misc-3.png'  => __('misc-3', 'default'),
                                        'misc-4.png'  => __('misc-4', 'default'),
                                        'misc-5.png'  => __('misc-5', 'default'),
                                        'plus.png'    => __('plus', 'default'),
                                        'rect-1.png'    => __('rectangle', 'default'),
                                        'noise-1.png'    => __('Noise 1', 'default'),
                                    ),
                    'std'   => '',
                    'type'  => 'select' );
                              
$options[] = array( 'title' => __('Custom Image Background', 'default'),
                    'desc'  => __('You can upload custom image for site background', 'default').'<br/>'.__('Note: if you set custom image, default image backgrounds will be ignored', 'default'),
                    'id'    => 'site_body_background_custom_image',
                    'std'   => '',
                    'type'  => 'upload' );    

$options[] = array( 'title' => __('Background repeat', 'default'),
                    'desc'  => __('Specifies how background image repeats', 'default'),
                    'id'    => 'site_body_background_repeat',
                    'opts'  => array(   'no-repeat' => __('No Repeat', 'default'), 
                                        'repeat'    => __('Horizontal & Vertical', 'default') ,
                                        'repeat-x'  => __('Just Horizontal', 'default'), 
                                        'repeat-y'  => __('Just Vertical', 'default') ),
                    'std'   => 'repeat',
                    'type'  => 'select' );
                    
$options[] = array( 'title' => __('Background attachment', 'default'),
                    'desc'  => __('Specifies the background is fixed or scrollable as user scrolls the document', 'default'),
                    'id'    => 'site_body_background_attachment',
                    'opts'  => array(   'fixed'     => __('Fixed' , 'default'), 
                                        'scroll'    => __('Scroll', 'default') ),
                    'std'   => 'fixed',
                    'type'  => 'select' );
                    
$options[] = array( 'title' => __('Background position', 'default'),
                    'desc'  => __('specifies background image alignment', 'default'),
                    'id'    => 'site_body_background_position',
                    'opts'  => array(   'left top'       => __('left top'     , 'default'), 
                                        'left center'    => __('left center'  , 'default'),
                                        'left bottom'    => __('left bottom'  , 'default'), 
                                        'right top'      => __('right top'    , 'default'),
                                        'right center'   => __('right center' , 'default'), 
                                        'right bottom'   => __('right bottom' , 'default'),
                                        'center top'     => __('center top'   , 'default'), 
                                        'center center'  => __('center center', 'default'),
                                        'center bottom'  => __('center bottom', 'default') ),
                    'std'   => 'left top',
                    'type'  => 'select' );
                    
// --- logo options ----------------------------------------------
              
$options[] = array( 'title' => __('Logo & Favicon', 'default'),
                    'desc'  => '',
                    'id'    => '',
                    'std'   => '',
                    'type'  => 'sep' );

$options[] = array( 'title' => __('Logo Image', 'default'),
                    'desc'  => __('This image appears as site logo on site header section.', 'default'),
                    'id'    => 'site_header_logo',
                    'std'   => '',
                    'type'  => 'upload' );
                    
$options[] = array( 'title' => __('Logo Image (Retina)', 'default'),
                    'desc'  => __('This is the logo image that appears on high resolution screens (retina devices like iPad, iPhone, ..). <br/> you need to attach an image with double size in dimensions. <br /> Leave this field blank if you do not need this feature.', 'default'),
                    'id'    => 'site_header_logo_2x',
                    'std'   => '',
                    'type'  => 'upload' );
                    
$options[] = array( 'title' => __('Logo Width', 'default'),
                    'desc'  => __('Set the width of site logo image in pixel.', 'default'),
                    'id'    => 'site_header_logo_width',
                    'std'   => '200',
                    'type'  => 'text' );

// --- favicon  --------------------------------------------------
                           
$options[] = array( 'title' => __('Upload Favicon', 'default'),
                    'desc'  => '',
                    'id'    => 'site_favicon_16',
                    'std'   => '',
                    'type'  => 'upload' );
                    
$options[] = array( 'title' => __('Custom CSS Code', 'default'),
                    'desc'  => __('You can add your custom css code here. <br/>No need to use <code>style</code> tag"', 'default'),
                    'id'    => 'axiom_user_custom_css',
                    'std'   => '',
                    'type'  => 'code' );
                    
                    
$options[] = array( 'title' => __('Custom Javascript Code', 'default'),
                    'desc'  => __('You can add your custom javascript code here. also you can use this field to place your google analytics tracking code.<br/>No need to use <code>script</code> tag"', 'default'),
                    'id'    => 'axiom_user_custom_js',
                    'std'   => '',
                    'type'  => 'code' );
 
$options[] = array( 'type'  => 'end' );


/* ---------------------------------------------------------------------------------------------------
    General Colors
--------------------------------------------------------------------------------------------------- */

$options[] = array( 'title' => __('General Colors', 'default' ),
                    'type'  => 'start',
                    'id'    => 'general-colors-section',
                    'desc'  => '');
                 
$options[] = array( 'title' => __('Enable Custom General Colors?', 'default'),
                    'desc'  => __('Do you want to modify general colors? If you <strong>check this field</strong>, the following options will be applied, esle default colors will be used', 'default'),
                    'id'    => 'enable_custom_general_colors',
                    'std'   => 'checked',
                    'type'  => 'checkbox' );

$options[] = array( 'title' => __('Body Color', 'default'),
                    'desc'  => __('Specifies the color of site body', 'default'),
                    'id'    => 'site_body_color',
                    'std'   => '#ffffff',
                    'type'  => 'colorpicker' );
                                        
$options[] = array( 'title' => __('Links Color', 'default'),
                    'desc'  => __('Specifies the color of general links', 'default'),
                    'id'    => 'site_general_link_color',
                    'std'   => '#94BDCF',
                    'type'  => 'colorpicker' );

$options[] = array( 'title' => __('Links Hover Color', 'default'),
                    'desc'  => __('Specifies the color of general links when mouse in over', 'default'),
                    'id'    => 'site_general_link_hover_color',
                    'std'   => '#6C92A3',
                    'type'  => 'colorpicker' );
                    
$options[] = array( 'title' => __('Feature Color', 'default'),
                    'desc'  => __('This is the most effective color. this color applies to main featured elements, such as stunning button, post format bg, font icons, ..', 'default'),
                    'id'    => 'feature_color',
                    'std'   => '#78acc2',
                    'type'  => 'colorpicker' );
                    
$options[] = array( 'title' => __('Divider Color', 'default'),
                    'desc'  => __('Specifies the color of dividers', 'default'),
                    'id'    => 'divider_color',
                    'std'   => '#b9b9b9',
                    'type'  => 'colorpicker' );

$options[] = array( 'title' => __('Font Icons Color', 'default'),
                    'desc'  => __('Specifies the color of font icons', 'default'),
                    'id'    => 'font_icon_color',
                    'std'   => '#78acc2',
                    'type'  => 'colorpicker' );

$options[] = array( 'title' => __('Callout Button Color', 'default'),
                    'desc'  => __('Specifies the color of callout/stunning button', 'default'),
                    'id'    => 'callout_btn_bgcolor',
                    'std'   => '#78acc2',
                    'type'  => 'colorpicker' );
                    
                                                        
$options[] = array( 'type'  => 'end' );


/* ---------------------------------------------------------------------------------------------------
    Typography Section
--------------------------------------------------------------------------------------------------- */

$options[] = array( 'title' => __('Typography Setting', 'default' ),
                    'type'  => 'start',
                    'id'    => 'style-setting-section',
                    'desc'  => '');
                    
$options[] = array( 'title' => __('Enable Typography?', 'default'),
                    'desc'  => __('Do you want to modify the typography? If you check this field, the following options will be applied', 'default'),
                    'id'    => 'enable_custom_typography',
                    'std'   => 'checked',
                    'type'  => 'checkbox' );
                    
$options[] = array( 'title' => __('Main Typography', 'default'),
                    'desc'  => __('You can modify content typography here.', 'default'),
                    'id'    => 'content_typography',
                    'std'   => array('face' => 'arial', 'color'=>'3D3D3D'),
                    'type'  => 'typography' );
                    
$options[] = array( 'title' => __('Main Heading', 'default'),
                    'desc'  => __('Main Heading containes section and widget titles. here you can modify the typography.', 'default'),
                    'id'    => 'main_title_typography',
                    'std'   => array('face' => 'arial', 'color'=>'6D6D6D'),
                    'type'  => 'typography' );  

$options[] = array( 'title' => __('Page Heading', 'default'),
                    'desc'  => __('You can modify page main title typography here.', 'default'),
                    'id'    => 'page_title_typography',
                    'std'   => array('face' => 'arial', 'color'=>'3D3D3D'),
                    'type'  => 'typography' );  

$options[] = array( 'title' => __('Stunning Heading', 'default'),
                    'desc'  => __('You can modify "stunning" and "callout" typography here.', 'default'),
                    'id'    => 'stunning_typography',
                    'std'   => array('face' => 'verdana', 'color'=>'3D3D3D'),
                    'type'  => 'typography' );    
                    
$options[] = array( 'title' => __('Navigation Typography', 'default'),
                    'desc'  => __('You can modify header menu typography here', 'default'),
                    'id'    => 'header_menu_typography',
                    'std'   => array('face' => 'arial'),
                    'type'  => 'typography' );   
                    
$options[] = array( 'title' => __('Include Special Font Charecters', 'default'),
                    'desc'  => __('If there are characters in your language that are not supported in fonts, use following options to load them', 'default'),
                    'id'    => '',
                    'std'   => '',
                    'type'  => 'sep' );  
                    
$options[] = array( 'title' => __('Include Latin Charecters', 'default'),
                    'desc'  => '',
                    'id'    => 'include_latin_chars',
                    'std'   => '',
                    'type'  => 'checkbox' );

$options[] = array( 'type'  => 'end' );


/* ---------------------------------------------------------------------------------------------------
    Socials Section
--------------------------------------------------------------------------------------------------- */
 
$options[] = array( 'title' => __('Socials Setting', 'default' ),
                    'type'  => 'start',
                    'id'    => 'social_setting-section',
                    'desc'  => '');
                    
$options[] = array( 'title' => __('Facebook', 'default'),
                    'desc'  => '',
                    'id'    => 'facebook',
                    'std'   => '',
                    'type'  => 'text' );

$options[] = array( 'title' => __('Twitter', 'default'),
                    'desc'  => '',
                    'id'    => 'twitter',
                    'std'   => '',
                    'type'  => 'text' );
                    
$options[] = array( 'title' => __('Google +', 'default'),
                    'desc'  => '',
                    'id'    => 'gplus',
                    'std'   => '',
                    'type'  => 'text' );

$options[] = array( 'title' => __('Dribble', 'default'),
                    'desc'  => '',
                    'id'    => 'dribble',
                    'std'   => '',
                    'type'  => 'text' );

$options[] = array( 'title' => __('YouTube', 'default'),
                    'desc'  => '',
                    'id'    => 'youtube',
                    'std'   => '',
                    'type'  => 'text' );

$options[] = array( 'title' => __('Vimeo 1', 'default'),
                    'desc'  => '',
                    'id'    => 'vimeo',
                    'std'   => '',
                    'type'  => 'text' );

$options[] = array( 'title' => __('Vimeo 2', 'default'),
                    'desc'  => '',
                    'id'    => 'vimeo2',
                    'std'   => '',
                    'type'  => 'text' );

$options[] = array( 'title' => __('Flicker', 'default'),
                    'desc'  => '',
                    'id'    => 'flicker',
                    'std'   => '',
                    'type'  => 'text' );

$options[] = array( 'title' => __('Digg', 'default'),
                    'desc'  => '',
                    'id'    => 'digg',
                    'std'   => '',
                    'type'  => 'text' );

$options[] = array( 'title' => __('Stuble', 'default'),
                    'desc'  => '',
                    'id'    => 'stuble',
                    'std'   => '',
                    'type'  => 'text' );

$options[] = array( 'title' => __('LastFM', 'default'),
                    'desc'  => '',
                    'id'    => 'lastfm',
                    'std'   => '',
                    'type'  => 'text' );

$options[] = array( 'title' => __('Delicious', 'default'),
                    'desc'  => '',
                    'id'    => 'delicious',
                    'std'   => '',
                    'type'  => 'text' );

$options[] = array( 'title' => __('Skype', 'default'),
                    'desc'  => '',
                    'id'    => 'skype',
                    'std'   => '',
                    'type'  => 'text' );

$options[] = array( 'title' => __('LinkedIn', 'default'),
                    'desc'  => '',
                    'id'    => 'linkedin',
                    'std'   => '',
                    'type'  => 'text' );

$options[] = array( 'title' => __('Tumbler', 'default'),
                    'desc'  => '',
                    'id'    => 'tumbler',
                    'std'   => '',
                    'type'  => 'text' );

$options[] = array( 'title' => __('Rss', 'default'),
                    'desc'  => '',
                    'id'    => 'rss',
                    'std'   => '',
                    'type'  => 'text' );


/* ---------------------------------------------------------------------------------------------------
    Header Section
--------------------------------------------------------------------------------------------------- */
                    
$options[] = array( 'title' => __('Header Setting', 'default' ),
                    'type'  => 'start',
                    'id'    => 'header-setting-section',
                    'desc'  => '');

$options[] = array( 'title' => __('Top Header Info Bar', 'default'),
                    'desc'  => '',
                    'id'    => '',
                    'std'   => '',
                    'type'  => 'sep' );
                   
$options[] = array( 'title' => __('Display Top Header bar?', 'default'),
                    'desc'  => __('Do you want to display top header bar on top of website? you can display social or call info in thsi bar', 'default'),
                    'id'    => 'show_topheader',
                    'std'   => 'checked',
                    'type'  => 'checkbox' );
                    
$options[] = array( 'title' => __('Socials in Top Header?', 'default'),
                    'desc'  => __('If you check this option socials appear in top header bar (you can edit socials via social setting section)', 'default'),
                    'id'    => 'show_socials_in_header',
                    'std'   => 'checked',
                    'type'  => 'checkbox' );

$options[] = array( 'title' => __('Search in Top Header?', 'default'),
                    'desc'  => __('If you check this option search box appear in top header bar ', 'default'),
                    'id'    => 'show_search_in_header',
                    'std'   => 'checked',
                    'type'  => 'checkbox' );
                    
$options[] = array( 'title' => __('Message on Top Header', 'default'),
                    'desc'  => __('Add a message you want to display on top header.', 'default'),
                    'id'    => 'topheader_message',
                    'std'   => '',
                    'type'  => 'textarea' );
                    
// --- header options --------------------------------------------

$options[] = array( 'title' => __('Main Header Options', 'default'),
                    'desc'  => '',
                    'id'    => '',
                    'std'   => '',
                    'type'  => 'sep' );

$options[] = array( 'title' => __('Enable Custom Header Style?', 'default'),
                    'desc'  => __('Do you want to modify the colors of header and header navigation? If you check this field, the following options will be applied', 'default'),
                    'id'    => 'enable_header_custom_style',
                    'std'   => 'checked',
                    'type'  => 'checkbox' );
                    
$options[] = array( 'title' => __('Header height', 'default'),
                    'desc'  => __('Set the height of header in pixel.', 'default'),
                    'id'    => 'site_header_container_height',
                    'std'   => '85',
                    'type'  => 'text' );
                      
$options[] = array( 'title' => __('Header Background Color', 'default'),
                    'desc'  => __('Specifies the color of header background', 'default'),
                    'id'    => 'site_header_background_color1',
                    'std'   => '#4A9BDC',
                    'type'  => 'colorpicker' );

$options[] = array( 'title' => __('Header Bottom Border Color', 'default'),
                    'desc'  => __('Specifies the color of line under header section', 'default'),
                    'id'    => 'site_header_border_bottom_color',
                    'std'   => '#358FD8',
                    'type'  => 'colorpicker' );

// --- navigation options -----------------------------------------
 
$options[] = array( 'title' => __('Header Navigation Options', 'default'),
                    'desc'  => '',
                    'id'    => '',
                    'std'   => '',
                    'type'  => 'sep' );

$options[] = array( 'title' => __('Main Menu Text Color', 'default'),
                    'desc'  => __('Specifies the text color of top level menu items', 'default'),
                    'id'    => 'site_header_nav_main_text_color',
                    'std'   => '#FFFFFF',
                    'type'  => 'colorpicker' );

$options[] = array( 'title' => __('Main Hover Back Color', 'default'),
                    'desc'  => __('The background color of top level menu items when mouse is over', 'default'),
                    'id'    => 'site_header_nav_main_hover_bg_color',
                    'std'   => '#5fa7e0',
                    'type'  => 'colorpicker' );
                    
$options[] = array( 'title' => __('Main Menu hover Text Color', 'default'),
                    'desc'  => __('Specifies the text color of top level menu items when mouse is over', 'default'),
                    'id'    => 'site_header_nav_main_hover_text_color',
                    'std'   => '#FFFFFF',
                    'type'  => 'colorpicker' );
                    
$options[] = array( 'title' => __('Submenu Text Color', 'default'),
                    'desc'  => __('Specifies the text color of sub menu items', 'default'),
                    'id'    => 'site_header_nav_submenu_text_color',
                    'std'   => '#FFFFFF',
                    'type'  => 'colorpicker' );
                    
$options[] = array( 'title' => __('Submenu Hover Text Color', 'default'),
                    'desc'  => __('Specifies the text color of sub menu items when mouse is over', 'default'),
                    'id'    => 'site_header_nav_submenu_hover_text_color',
                    'std'   => '#999999',
                    'type'  => 'colorpicker' );

$options[] = array( 'title' => __('Active Menu Back Color', 'default'),
                    'desc'  => __('The background color of current page menu', 'default'),
                    'id'    => 'site_header_nav_current_bg_color',
                    'std'   => '#5fa7e0',
                    'type'  => 'colorpicker' );
                    
$options[] = array( 'title' => __('Active Menu Text Color', 'default'),
                    'desc'  => __('The text color of current page menu', 'default'),
                    'id'    => 'site_header_nav_current_text_color',
                    'std'   => '#FFFFFF',
                    'type'  => 'colorpicker' );
                    
$options[] = array( 'title' => __('Active Menu Border Color', 'default'),
                    'desc'  => __('This is color of the line under current page menu', 'default'),
                    'id'    => 'site_header_nav_current_border_color',
                    'std'   => '#333333',
                    'type'  => 'colorpicker' );
                    
// --- mobile navigation options -----------------------------------------
 
$options[] = array( 'title' => __('Mobile Navigation', 'default'),
                    'desc'  => __('Options for vertical navigation (This Navigation is visible on mobile and Tablet screens)', 'default'),
                    'id'    => '',
                    'std'   => '',
                    'type'  => 'sep' );
                    
$options[] = array( 'title' => __('Header Background Color2', 'default'),
                    'desc'  => __('Specifies the color of second header background. This background is visible only on tablet screen sizes.', 'default'),
                    'id'    => 'site_header_background_color2',
                    'std'   => '#4A9BDC',
                    'type'  => 'colorpicker' );
                    
$options[] = array( 'title' => __('Submenu Top Border Color', 'default'),
                    'desc'  => __('Specifies the top border color of sub menu items in vertival mode', 'default'),
                    'id'    => 'site_header_nav_submenu_top_border_color',
                    'std'   => '#4A9BDC',
                    'type'  => 'colorpicker' );
                    
$options[] = array( 'title' => __('Submenu Bottom Border Color', 'default'),
                    'desc'  => __('Specifies the bottom border color of sub menu items in vertival mode', 'default'),
                    'id'    => 'site_header_nav_submenu_bottom_border_color',
                    'std'   => '#4A9BDC',
                    'type'  => 'colorpicker' );
                                   
$options[] = array( 'type'  => 'end' );


/* ---------------------------------------------------------------------------------------------------
    Blog Section
--------------------------------------------------------------------------------------------------- */

$options[] = array( 'title' => __('Blog Setting', 'default' ),
                    'type'  => 'start',
                    'id'    => 'blog-setting-section',
                    'desc'  => '');
                    
$options[] = array( 'title' => __('Single Sidebar Position', 'default'),
                    'desc'  => __('Specifies the position of sidebar on blog single page', 'default'),
                    'id'    => 'blog_sidebar_position',
                    'opts'  => array(   'right-sidebar'=> 'Right Siderbar', 
                                        'left-sidebar' => 'Left Sidebar' ,
                                        'no-sidebar'   => 'No Sidebar' ),
                    'std'   => 'right-sidebar',
                    'type'  => 'select' );
                    
$options[] = array( 'title' => __('Display Related Posts?', 'default'),
                    'desc'  => __('Do you want to display related post at the bottom of each blog post? ', 'default'),
                    'id'    => 'show_blog_related_posts',
                    'std'   => 'checked',
                    'type'  => 'checkbox' );
                    
$options[] = array( 'title' => __('Related Posts Title', 'default'),
                    'desc'  => '',
                    'id'    => 'blog_related_posts_title',
                    'std'   => 'Related Posts',
                    'type'  => 'text' );
                    
$options[] = array( 'title' => __('Related Post Size', 'default'),
                    'desc'  => __('If You choose 1/3 , 3 Related posts are visible.', 'default'),
                    'id'    => 'blog_related_posts_size',
                    'opts'  => array(   'three-column' => '1/3', 
                                        'four-column'  => '1/4' ),
                    'std'   => 'three-column',
                    'type'  => 'select' );
                    
$options[] = array( 'title' => __('Display Author Section?', 'default'),
                    'desc'  => __('Do you want to display author information after each blog post? ', 'default'),
                    'id'    => 'show_blog_author_section',
                    'std'   => 'checked',
                    'type'  => 'checkbox' );
                    
$options[] = array( 'title' => __('View All button link', 'default'),
                    'desc'  => __('Specifies a link for "view all" button to blog listing page (the button that comes at the end of latest from blog element ) ', 'default'),
                    'id'    => 'blog_view_all_btn_link',
                    'std'   => home_url(),
                    'type'  => 'text' );

$options[] = array( 'type'  => 'end' );


/* ---------------------------------------------------------------------------------------------------
    News Section
--------------------------------------------------------------------------------------------------- */

$options[] = array( 'title' => __('News Setting', 'default' ),
                    'type'  => 'start',
                    'id'    => 'news-setting-section',
                    'desc'  => '');
                    
$options[] = array( 'title' => __('Single Sidebar Position', 'default'),
                    'desc'  => __('Specifies the position of sidebar on news single page', 'default'),
                    'id'    => 'news_sidebar_position',
                    'opts'  => array(   'right-sidebar'=> 'Right Siderbar', 
                                        'left-sidebar' => 'Left Sidebar' ,
                                        'no-sidebar'   => 'No Sidebar' ),
                    'std'   => 'right-sidebar',
                    'type'  => 'select' );
                    
$options[] = array( 'title' => __('Display Related News?', 'default'),
                    'desc'  => __('Do you want to display related news at the bottom of each news post? ', 'default'),
                    'id'    => 'show_news_related_posts',
                    'std'   => 'checked',
                    'type'  => 'checkbox' );
                    
$options[] = array( 'title' => __('Related News Title', 'default'),
                    'desc'  => '',
                    'id'    => 'news_related_posts_title',
                    'std'   => 'Related News',
                    'type'  => 'text' );
                    
$options[] = array( 'title' => __('Related News Posts Size', 'default'),
                    'desc'  => __('If You choose 1/3 , 3 Related items are visible.', 'default'),
                    'id'    => 'news_related_posts_size',
                    'opts'  => array(   'three-column' => '1/3', 
                                        'four-column'  => '1/4' ),
                    'std'   => 'three-column',
                    'type'  => 'select' );
                    
$options[] = array( 'title' => __('Display Author Section?', 'default'),
                    'desc'  => __('Do you want to display author information after each single news? ', 'default'),
                    'id'    => 'show_news_author_section',
                    'std'   => 'checked',
                    'type'  => 'checkbox' );
                    
$options[] = array( 'title' => __('View All button link', 'default'),
                    'desc'  => __('Specifies a link for "view all" button to news listing page (the button that comes at the end of latest news element ) ', 'default'),
                    'id'    => 'news_view_all_btn_link',
                    'std'   => home_url(),
                    'type'  => 'text' );

$options[] = array( 'type'  => 'end' );


/* ---------------------------------------------------------------------------------------------------
    Portfolio Section
--------------------------------------------------------------------------------------------------- */

$options[] = array( 'title' => __('Portfolio Setting', 'default' ),
                    'type'  => 'start',
                    'id'    => 'portfolio-setting-section',
                    'desc'  => '');
                    
$options[] = array( 'title' => __('Display Related Projects?', 'default'),
                    'desc'  => __('Do you want to display related projects at bottom of the page? ', 'default'),
                    'id'    => 'show_portfolio_related_items',
                    'std'   => 'checked',
                    'type'  => 'checkbox' );
                    
$options[] = array( 'title' => __('Related Projects Title', 'default'),
                    'desc'  => '',
                    'id'    => 'portfolio_related_items_title',
                    'std'   => 'Related Projects',
                    'type'  => 'text' );
                    
$options[] = array( 'title' => __('Related Project Thumb Size', 'default'),
                    'desc'  => 'If You choose 1/3 , 3 Related items are visible.',
                    'id'    => 'portfolio_related_items_size',
                    'opts'  => array(   'three-column' => '1/3', 
                                        'four-column'  => '1/4' ),
                    'std'   => 'three-column',
                    'type'  => 'select' );
                    
$options[] = array( 'title' => __('Navigation Type', 'default'),
                    'desc'  => 'What kind of navigation you need to display on portfolio single pages?',
                    'id'    => 'portfolio_single_nav_type',
                    'opts'  => array(   'breadcrumb' => 'Breadcrumb', 
                                        'next_prev'  => 'Next / Previous',
                                        'none'       => 'None' ),
                    'std'   => 'breadcrumb',
                    'type'  => 'select' );
                    
$options[] = array( 'title' => __('Display Socials', 'default'),
                    'desc'  => 'Do you want to display share links on portfolio single pages?',
                    'id'    => 'portfolio_show_share_btns',
                    'std'   => 'checked',
                    'type'  => 'checkbox' );
                    
$options[] = array( 'title' => __('Portfolio Data Labels', 'default'),
                    'desc'  => __('Here you can change or translate the label of metas in portfolio page.', 'default'),
                    'id'    => '',
                    'std'   => '',
                    'type'  => 'sep' );
                    
$options[] = array( 'title' => __('Custom Meta Label 1', 'default'),
                    'desc'  => '',
                    'id'    => 'portfolio_custom_meta_label1',
                    'std'   => __('Skills', 'default'),
                    'type'  => 'text' );    
                    
$options[] = array( 'title' => __('Custom Meta Label 2', 'default'),
                    'desc'  => '',
                    'id'    => 'portfolio_custom_meta_label2',
                    'std'   => __('Release Date', 'default'),
                    'type'  => 'text' );
                    
$options[] = array( 'title' => __('Custom Meta Label 3', 'default'),
                    'desc'  => '',
                    'id'    => 'portfolio_custom_meta_label3',
                    'std'   => 'Client',
                    'type'  => 'text' );

$options[] = array( 'title' => __('Custom Meta Label 4', 'default'),
                    'desc'  => '',
                    'id'    => 'portfolio_custom_meta_label4',
                    'std'   => 'Copyright',
                    'type'  => 'text' );
                    
$options[] = array( 'title' => __('Custom Meta Label 5', 'default'),
                    'desc'  => '',
                    'id'    => 'portfolio_custom_meta_label5',
                    'std'   => '',
                    'type'  => 'text' );

$options[] = array( 'title' => __('Custom Meta Label 6', 'default'),
                    'desc'  => '',
                    'id'    => 'portfolio_custom_meta_label6',
                    'std'   => '',
                    'type'  => 'text' );
                    
$options[] = array( 'title' => __('Custom Meta Label 7', 'default'),
                    'desc'  => '',
                    'id'    => 'portfolio_custom_meta_label7',
                    'std'   => '',
                    'type'  => 'text' );

$options[] = array( 'title' => __('Custom Meta Label 8', 'default'),
                    'desc'  => '',
                    'id'    => 'portfolio_custom_meta_label8',
                    'std'   => '',
                    'type'  => 'text' );

$options[] = array( 'title' => __('Custom Meta Label 9', 'default'),
                    'desc'  => '',
                    'id'    => 'portfolio_custom_meta_label9',
                    'std'   => '',
                    'type'  => 'text' );

$options[] = array( 'type'  => 'end' );


/* ---------------------------------------------------------------------------------------------------
    Product Section
--------------------------------------------------------------------------------------------------- */

$options[] = array( 'title' => __('Product Setting', 'default' ),
                    'type'  => 'start',
                    'id'    => 'product-setting-section',
                    'desc'  => '');
                                      
$options[] = array( 'title' => __('Display Related Products?', 'default'),
                    'desc'  => __('Do you want to display related products at bottom of the page? ', 'default'),
                    'id'    => 'show_product_related_items',
                    'std'   => 'checked',
                    'type'  => 'checkbox' );
                    
$options[] = array( 'title' => __('Related Products Title', 'default'),
                    'desc'  => '',
                    'id'    => 'product_related_items_title',
                    'std'   => 'Related Products',
                    'type'  => 'text' );
                    
$options[] = array( 'title' => __('Related Product Thumb Size', 'default'),
                    'desc'  => __('If You choose 1/3 , 3 Related items are visible.', 'default'),
                    'id'    => 'product_related_items_size',
                    'opts'  => array(   'three-column' => '1/3', 
                                        'four-column'  => '1/4' ),
                    'std'   => 'three-column',
                    'type'  => 'select' );
                    
$options[] = array( 'title' => __('Navigation Type', 'default'),
                    'desc'  => 'What kind of navigation you need to display on product single pages?',
                    'id'    => 'product_single_nav_type',
                    'opts'  => array(   'breadcrumb' => 'Breadcrumb', 
                                        'next_prev'  => 'Next / Previous',
                                        'none'       => 'None' ),
                    'std'   => 'breadcrumb',
                    'type'  => 'select' );
                    
$options[] = array( 'title' => __('Display Socials', 'default'),
                    'desc'  => 'Do you want to display share links on product single pages?',
                    'id'    => 'product_show_share_btns',
                    'std'   => 'checked',
                    'type'  => 'checkbox' );
                    
$options[] = array( 'title' => __('Product Data Labels', 'default'),
                    'desc'  => __('Here you can change or translate the label of metas in product page.', 'default'),
                    'id'    => '',
                    'std'   => '',
                    'type'  => 'sep' );
                    
$options[] = array( 'title' => __('Regular Price Label', 'default'),
                    'desc'  => '',
                    'id'    => 'product_regular_price_label',
                    'std'   => 'Regular Price',
                    'type'  => 'text' );    
                    
$options[] = array( 'title' => __('"Buy" button Label', 'default'),
                    'desc'  => '',
                    'id'    => 'product_buy_btn_label',
                    'std'   => 'Buy Now',
                    'type'  => 'text' );    
                    
$options[] = array( 'title' => __('Custom Meta Label 1', 'default'),
                    'desc'  => '',
                    'id'    => 'product_custom_meta_label_0_1',
                    'std'   => 'Manufacturer',
                    'type'  => 'text' );    
                    
$options[] = array( 'title' => __('Custom Meta Label 2', 'default'),
                    'desc'  => '',
                    'id'    => 'product_custom_meta_label_0_2',
                    'std'   => 'Release Date',
                    'type'  => 'text' );
                    
$options[] = array( 'title' => __('Custom Meta Label 3', 'default'),
                    'desc'  => '',
                    'id'    => 'product_custom_meta_label_0_3',
                    'std'   => 'Part Number',
                    'type'  => 'text' );
                    
$options[] = array( 'title' => __('Custom Meta Label 4', 'default'),
                    'desc'  => '',
                    'id'    => 'product_custom_meta_label_0_4',
                    'std'   => 'Dimensions',
                    'type'  => 'text' );
                    
$options[] = array( 'title' => __('Custom Meta Label 5', 'default'),
                    'desc'  => '',
                    'id'    => 'product_custom_meta_label_0_5',
                    'std'   => '',
                    'type'  => 'text' );
                    
$options[] = array( 'title' => __('Custom Meta Label 6', 'default'),
                    'desc'  => '',
                    'id'    => 'product_custom_meta_label_0_6',
                    'std'   => '',
                    'type'  => 'text' );
                    
$options[] = array( 'title' => __('Custom Meta Label 7', 'default'),
                    'desc'  => '',
                    'id'    => 'product_custom_meta_label_0_7',
                    'std'   => '',
                    'type'  => 'text' );
                    
$options[] = array( 'title' => __('Custom Meta Label 8', 'default'),
                    'desc'  => '',
                    'id'    => 'product_custom_meta_label_0_8',
                    'std'   => '',
                    'type'  => 'text' );
                    
$options[] = array( 'title' => __('Custom Meta Label 9', 'default'),
                    'desc'  => '',
                    'id'    => 'product_custom_meta_label_0_9',
                    'std'   => '',
                    'type'  => 'text' );

$options[] = array( 'title' => __('Custom Meta Label 10', 'default'),
                    'desc'  => '',
                    'id'    => 'product_custom_meta_label_0_10',
                    'std'   => '',
                    'type'  => 'text' );
                                
$options[] = array( 'type'  => 'end' );

/* ---------------------------------------------------------------------------------------------------
    Elements Section
--------------------------------------------------------------------------------------------------- */

/*
$options[] = array( 'title' => __('Elements Setting', 'default' ),
                    'type'  => 'start',
                    'id'    => 'elements-setting',
                    'desc'  => '');
                    
$options[] = array( 'title' => __('Element 1', 'default'),
                    'desc'  => '',
                    'id'    => '',
                    'std'   => '',
                    'type'  => 'sep' );
 
$options[] = array( 'title' => 'Range Field',
                    'desc'  => 'Here goes the description for this field.',
                    'id'    => 'range_element1',
                    'opts'  => array( 	'min' => '20'  , 
                    					'max' => '70',
                    					'step'=> '1' ),
                    'std'   => '30',
                    'type'  => 'range' );
 
$options[] = array( 'title' => 'Radio Field',
                    'desc'  => 'Here goes the description for this field.',
                    'id'    => 'radio_field2',
                    'opts'  => array( 	'Option Title 5' => 'option_value_5' , 
                    					'Option Title 6' => 'option_value_6' ),
                    'std'   => 'option_value_5',
                    'type'  => 'radio' );
 
$options[] = array( 'title' => 'Sortable List',
                    'desc'  => 'Here goes the description for this field.',
                    'id'    => 'draggable_area1',
                    'opts'  => array( 	'Active'   => array(
															'item_1' => 'section 1',
															'item_2' => 'section 2',
															'item_3' => 'section_3'	
														 ) , 
                    					'Deactive' => array(
															'item_4' => 'section 4',
															'item_5' => 'section 5',
															'item_6' => 'section_6'	
														 )
									),
                    'type'  => 'sortable' );
					
$options[] = array( 'title' => 'Sortable List',
                    'desc'  => 'Here goes the description for this field.',
                    'id'    => 'draggable_area2',
                    'opts'  => array( 	'Active'   => array(
															'item_1' => 'Block 1',
															'item_2' => 'Block 2',
															'item_3' => 'Block_3'	
														 ) , 
                    					'Deactive' => array(
															'item_4' => 'Block 4',
															'item_5' => 'Block 5',
															'item_6' => 'Block_6'	
														 )
									),
                    'type'  => 'sortable' );
					
 
$options[] = array( 'type'  => 'end' );
*/

/* ---------------------------------------------------------------------------------------------------
    Footer Section
--------------------------------------------------------------------------------------------------- */

$options[] = array( 'title' => __('Footer Setting', 'default' ),
                    'type'  => 'start',
                    'id'    => 'footer-setting-section',
                    'desc'  => '');
                    
$options[] = array( 'title' => __('Display Subfooter?', 'default'),
                    'desc'  => __('Do you want to display subfooter (footer widgets container) on all pages?', 'default'),
                    'id'    => 'show_subfooter',
                    'std'   => 'checked',
                    'type'  => 'checkbox' );
                    
$options[] = array( 'title' => __('Subfooter Layout :', 'default'),
                    'desc'  => __('Select layout for subfooter widget columns', 'default'),
                    'id'    => 'subfooter_layout',
                    'opts'  => array(   'layout-2_50-50'   => 
                                                    array( '2 Columns- 1/2  1/2'       => ADMIN_INC_URL.'options/assets/images/layouts/2-11.jpg'),
                                        'layout-2_66-33'   => 
                                                    array( '2 Columns- 2/3  1/3'       => ADMIN_INC_URL.'options/assets/images/layouts/2-21.jpg'),
                                        'layout-2_33-66'   => 
                                                    array( '2 Columns- 1/3  2/3'       => ADMIN_INC_URL.'options/assets/images/layouts/2-12.jpg'),
                                        'layout-2_75-25'   => 
                                                    array( '2 Columns- 3/4  1/4'       => ADMIN_INC_URL.'options/assets/images/layouts/2-31.jpg'),
                                        'layout-2_25-75'   => 
                                                    array( '2 Columns- 1/4  3/4'       => ADMIN_INC_URL.'options/assets/images/layouts/2-13.jpg'),
                                        'layout-3_33-33-33'  => 
                                                    array( '3 Columns- 1/3  1/3  1/3'  => ADMIN_INC_URL.'options/assets/images/layouts/3-111.jpg') ,
                                        'layout-3_50-25-25'  => 
                                                    array( '3 Columns- 1/2  1/4  1/4'  => ADMIN_INC_URL.'options/assets/images/layouts/3-211.jpg') ,
                                        'layout-3_25-25-50'  => 
                                                    array( '3 Columns- 1/4  1/4  1/2'  => ADMIN_INC_URL.'options/assets/images/layouts/3-112.jpg'), 
                                        'layout-4_25-25-25-25' => 
                                                    array( '4 Columns- 1/4  1/4  1/4  1/4'=> ADMIN_INC_URL.'options/assets/images/layouts/4-1111.jpg'),
                                    ),
                                    
                    'std'   => 'layout-3_33-33-33',
                    'type'  => 'selector' );    
                    
$options[] = array( 'title' => __('Display Socials in Footer?', 'default'),
                    'desc'  => __('If you check this option socials appear in footer (you can edit socials via social setting section)', 'default'),
                    'id'    => 'show_socials_in_footer',
                    'std'   => 'checked',
                    'type'  => 'checkbox' );     
                    
$options[] = array( 'title' => __('Footer Background Color', 'default'),
                    'desc'  => __('Specifies the background color for footer', 'default'),
                    'id'    => 'site_footer_bg_color',
                    'std'   => '#1A1A1A',
                    'type'  => 'colorpicker' );          

$options[] = array( 'title' => __('Footer Text Color', 'default'),
                    'desc'  => __('Specifies the text and link colors in footer', 'default'),
                    'id'    => 'site_footer_text_color',
                    'std'   => '#6D6D6D',
                    'type'  => 'colorpicker' );   
                    
$options[] = array( 'title' => __('Footer Separator Color', 'default'),
                    'desc'  => __('Specifies the color of separator line between links', 'default'),
                    'id'    => 'site_footer_sep_color',
                    'std'   => '#292929',
                    'type'  => 'colorpicker' );   
                    
$options[] = array( 'title' => __('Footer Copyright Text', 'default'),
                    'desc'  => '',
                    'id'    => 'copyright',
                    'std'   => '© 2011 Company. All rights reserved',
                    'type'  => 'textarea' );
                    

$options[] = array( 'type'  => 'end' );

/* ---------------------------------------------------------------------------------------------------
    Sidebar Generator Section
--------------------------------------------------------------------------------------------------- */

$options[] = array( 'title' => __('Sidebar Generator', 'default'),
                    'type'  => 'start',
                    'id'    => 'siderbar-manager-section',
                    'desc'  => 'description for style section');
                    
$options[] = array( 'title' => __('Enter New Sidebar Name', 'default'),
                    'desc'  => __('Here goes the description for this field.', 'default'),
                    'id'    => 'sidebar_add_field',
                    'type'  => 'sidebar' );
                    
$options[] = array( 'type'  => 'end' );

/* ---------------------------------------------------------------------------------------------------
    Import / Export Section
--------------------------------------------------------------------------------------------------- */

$options[] = array( 'title' => __('Import / Export', 'default'),
                    'type'  => 'start',
                    'id'    => 'import-export-section',
                    'desc'  => '');
                    
$options[] = array( 'title' => __('Import', 'default'),
                    'desc'  => '',
                    'id'    => 'axiom_import_options',
                    'std'   => '',
                    'type'  => 'import' );
                    
$options[] = array( 'title' => __('Export', 'default'),
                    'desc'  => __('Place this export code into the import text field in your new site and press "Import".', 'default'),
                    'id'    => 'axiom_export_options',
                    'std'   => '',
                    'type'  => 'export' );
                    
$options[] = array( 'type'  => 'end' );


/* ---------------------------------------------------------------------------------------------------
    
--------------------------------------------------------------------------------------------------- */

?>