<?php
/**
 * Constant defines and $_GLOBAL settings here.
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
 
/*-----------------------------------------------------------------------------------*/
/*	Define Global Vars
/*-----------------------------------------------------------------------------------*/

// core version
if(! defined('AXIOM_VERSION') ) define( 'AXIOM_VERSION', '1.23.0'              );

// domain name for tranlation file
if(! defined('THEME_DOMAIN')  ) define('THEME_DOMAIN'  , 'default'            );



// Server path for current theme directory
if(! defined('THEME_DIR')      ) define('THEME_DIR', get_template_directory().'/'     );

// Http url of current theme directory
if(! defined('THEME_URL')      ) define('THEME_URL', get_template_directory_uri().'/' );


// Server path for theme inc directory
if(! defined('THEME_INC_DIR')  ) define('THEME_INC_DIR', THEME_DIR. 'inc/'   );

// Http url of theme inc directory
if(! defined('THEME_INC_URL')  ) define('THEME_INC_URL', THEME_URL. 'inc/'  );



// this id is used as prefix in database field names - specific for each theme
if(! defined('THEME_ID')      ) define('THEME_ID'      ,  "lotus" );

// theme name
$theme_data = wp_get_theme();
if(! defined('THEME_NAME')    ) define('THEME_NAME'    ,  $theme_data->Name );



// Server path for admin folder
if(! defined('ADMIN_DIR')     ) define('ADMIN_DIR'    , THEME_DIR. 'admin/'    );

// Http url of admin folder
if(! defined('ADMIN_URL')     ) define('ADMIN_URL'    , THEME_URL. 'admin/'    );



// Server path for admin > include folder
if(! defined('ADMIN_INC')     ) define('ADMIN_INC'    , ADMIN_DIR. 'include/'  );

// Http url of admin > include folder
if(! defined('ADMIN_INC_URL') ) define('ADMIN_INC_URL', ADMIN_URL. 'include/'  );



// Server path for admin > css folder
if(! defined('ADMIN_CSS')     ) define('ADMIN_CSS'    , ADMIN_DIR. 'css/'      );

// Http url of admin > css folder
if(! defined('ADMIN_CSS_URL') ) define('ADMIN_CSS_URL', ADMIN_URL. 'css/'      );



// Server path for admin > js folder
if(! defined('ADMIN_JS')      ) define('ADMIN_JS'     , ADMIN_DIR. 'js/'       );

// Http url of admin > js folder
if(! defined('ADMIN_JS_URL')  ) define('ADMIN_JS_URL' , ADMIN_URL. 'js/'       );



// increase the memory to64 MB
ini_set("memory_limit","64M");

// Disable Post Revisions
// define('WP_POST_REVISIONS', false    );

// Change Delays between auto-saves
// define('AUTOSAVE_INTERVAL', 60 );


/*-----------------------------------------------------------------------------------*/
/*  Image Sizes
/*-----------------------------------------------------------------------------------*/

global $axi_img_size;
$axi_img_size = array(
                    
                    "i6"    => array(150, null, null),
                    "i6_1"  => array(150,   80, true),
                    "i6_2"  => array(150,  282, true),
                    
                    "i5"    => array(190, null, null),
                    "i5_1"  => array(190,  115, true),
                    "i5_2"  => array(190,  232, true),
                    
                    "i4"    => array(238, null, null),
                    "i4_1"  => array(238,  144, true),
                    "i4_2"  => array(238,  290, true),
                    
                    "i3"    => array(318, null, null),
                    "i3_1"  => array(318,  192, true),
                    "i3_2"  => array(318,  386, true),
                    
                    "i2"    => array(479, null, null),
                    "i2_1"  => array(479,  290, true),
                    "i2_2"  => array(479,  582, true),
                    
                    "i1"    => array(960, null, null),
                    "i1_1"  => array(960,  550, null),
                    "full"  => array(960, null, null),
                    
                    "side"  => array(672, null, null),// "side" is the image contents in sidebar layouts (blog, news)
                
                    "635"   => array(635, null, null),
                    "635_1" => array(635,  635, true),
                    
                    
                );
?>