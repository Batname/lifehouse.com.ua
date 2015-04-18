<?php
/**
 * Theme Asset manager
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
 
/*-----------------------------------------------------------------------------------*/
/*	Add Admin styles
/*-----------------------------------------------------------------------------------*/

function axiom_register_admin_custom_styles(){
	wp_register_style('axiom_base_style' 	   , ADMIN_CSS_URL. 'base.css');
	wp_register_style('axiom_admin_style'      , ADMIN_CSS_URL. 'admin.css');
	wp_register_style('axiom_elements_style'   , ADMIN_CSS_URL. 'elements.css');
    wp_register_style('axiom_option_panel_style',ADMIN_INC_URL. 'options/assets/css/option-panel.css');
	wp_register_style('axiom_pricetable_style' , ADMIN_INC_URL. 'price/assets/css/price.css');
    wp_register_style('axiom_pagebuilder_style', ADMIN_INC_URL. 'modules/builder/assets/css/style.css');
    wp_register_style('axiom_slidermgr_style'  , ADMIN_INC_URL. 'modules/slider/assets/css/style.css');
    
	wp_register_style('noty'                   , ADMIN_CSS_URL. 'other/noty.css');
}
add_action('admin_enqueue_scripts', 'axiom_register_admin_custom_styles');


function axiom_print_admin_meta_box_style(){
	wp_enqueue_style('axiom_base_style');
	wp_enqueue_style('axiom_admin_style');
	wp_enqueue_style('thickbox');
	wp_enqueue_style('axiom_elements_style');
	wp_enqueue_style('noty');
    wp_enqueue_style('axiom_pagebuilder_style');
    
    // It will be called only on option panel page
    if(is_currentpage_id('toplevel_page_axiom'))
        wp_enqueue_style( 'axiom_option_panel_style' );
    
    // just load on pricetable screen
    if(is_currentpage_id('pricetable'))
       wp_enqueue_style('axiom_pricetable_style');
       
    if(is_currentpage_id('slider'))
       wp_enqueue_style('axiom_slidermgr_style');
    
    // turn off auto save on edit page
    if(is_currentpage_id('page'))
       wp_dequeue_script('autosave');
    
    // turn off auto save for custom post types edit page 
    $post_types = get_post_types( array( '_builtin' => false ), 'objects' ); 
    if (count($post_types) > 0)
        foreach( $post_types as $pt => $args )
            if(is_currentpage_id($pt))
                wp_dequeue_script('autosave');
        
    
}
add_action('admin_enqueue_scripts', 'axiom_print_admin_meta_box_style');


/*-----------------------------------------------------------------------------------*/
/*	Add Admin Scripts
/*-----------------------------------------------------------------------------------*/

function axiom_register_admin_scripts() {
    
    wp_register_script  ('jquery-ui-c'          , ADMIN_JS_URL . 'libs/jquery-ui-1.10.2.custom.min.js' ,array('jquery'));
    
	// Contains all essential plugins
	wp_register_script('axiom_plugins'			, ADMIN_JS_URL . 'plugins.js'      , array('jquery', 'jquery-ui-slider' ,'jquery-ui-sortable'));
    
    // Contains knockout 2.1
    wp_register_script('knockout'               , ADMIN_JS_URL . 'libs/knockout-2.1.0.js');
    
    // Contains tipsy 1.0
    wp_register_script('tipsy'                  , ADMIN_JS_URL . 'libs/jquery.tipsy.js');
    
    // Contains iphone-style-checkboxes
    wp_register_script('iphone_checkbox'        , ADMIN_JS_URL . 'libs/iphone-style-checkboxes.js');
    
    // Contains jquery easing functions
    wp_register_script('jquery_easing'          , ADMIN_JS_URL . 'libs/jquery.easing.min.js');
    
	// Contains all general scripts
	wp_register_script('axiom_script'			, ADMIN_JS_URL . 'script.js'       , array('jquery', 'jquery-ui-slider' ,'jquery-ui-sortable', 'axiom_plugins') );
	
	// Contains all blog post format options
    wp_register_script('axiom_custom'           , ADMIN_JS_URL . 'custom.js'       , array('jquery'), 1.0 ,TRUE );
    
	// Contains scripts for saving option panel data to database
	wp_register_script('axiom_options'			, ADMIN_INC_URL. 'options/assets/js/options.js', 
																					 array('jquery', 'json2', 'axiom_plugins'), "1.2" );
	// Contains script for uploading file in option panel
	wp_register_script('axiom_uploader'	        , ADMIN_JS_URL.  'upload.js', array('jquery' , 'media-upload' ,'thickbox') );		
	
    
	wp_register_script('axiom_slider_manager'	, ADMIN_INC_URL. 'slider/assets/js/slider-manager.js', array('jquery' , 'media-upload' ,'thickbox','jquery-ui-sortable', 'axiom_plugins') );														 
    
    // Contains script for pricetable edit page
    wp_register_script('axiom_pricetable'       , ADMIN_INC_URL. 'price/assets/js/pt.js', array('jquery', 'knockout'), "1.1", TRUE );    
    
    // Contains script for slider manager
    wp_register_script('ckeditor'               , ADMIN_JS_URL . 'libs/ckeditor/ckeditor.js', null, "4.0.1");
    
    // Contains script for page builder
    wp_register_script('axiom_pagebuilder'      , ADMIN_INC_URL. 'modules/builder/assets/js/builder.js', array('jquery','jquery-ui-c','axiom_plugins', 'knockout', 'tipsy','iphone_checkbox', 'ckeditor'), "1.0.2", TRUE );   
    
    // Contains script for slider manager
    wp_register_script('axiom_slidermgr'        , ADMIN_INC_URL. 'modules/slider/assets/js/slidermgr.js', array('jquery','jquery-ui-c','axiom_plugins', 'knockout', 'tipsy'), "1.4.0", TRUE );    
    
      
    
    $screen = get_current_screen();

}
add_action('admin_enqueue_scripts', 'axiom_register_admin_scripts');



function axiom_print_admin_scripts(){
	wp_enqueue_script('jquery');
	wp_enqueue_script('json2' );
    
    // create essential js global vars
    $axi_upload_dir = wp_upload_dir();
    wp_localize_script( 'jquery', 'axiom', array(   'themeurl'  => THEME_URL ,
                                                    'adminurl'  => admin_url(),
                                                    'ajaxurl'   => admin_url( 'admin-ajax.php' ),
                                                    'uploadbaseurl' => $axi_upload_dir['baseurl'] ) );
                                                    
    if( is_currentpage_id('page')        || 
        is_currentpage_id('post')        || 
        is_currentpage_id('axi_product') ||
        is_currentpage_id('portfolio')   ||
        is_currentpage_id('staff')       || 
        is_currentpage_id('slider')      || 
        is_currentpage_id('pricetable')  ||
        is_currentpage_id('toplevel_page_axiom') ||
        is_currentpage_id('pricetable')  ||
        is_currentpage_id('service')     ||
        is_currentpage_id('testimonial') ||
        is_currentpage_id('news')        ||
        is_currentpage_id('faq')          
      ){
          wp_enqueue_script('axiom_plugins');
          wp_enqueue_script('axiom_script');
          wp_enqueue_script('axiom_uploader');
    }
    
    // just load on option panel screen
    if(is_currentpage_id('toplevel_page_axiom')){
        wp_enqueue_script('axiom_options');
    }
    
    // just load on slider screen
    if(is_currentpage_id('slider'))
	   wp_enqueue_script('axiom_slidermgr');
       
    // on pricetable screen
    if(is_currentpage_id('pricetable')){
       wp_enqueue_script('axiom_pricetable');
       wp_dequeue_script('autosave' );
    }
    
    if(is_currentpage_id('page') || is_currentpage_id('axi_product')
                                 || is_currentpage_id('portfolio')
                                 || is_currentpage_id('service')
                                 || is_currentpage_id('staff')  )
        wp_enqueue_script('axiom_pagebuilder');
    
    if(is_currentpage_id('post'))
        wp_enqueue_script('axiom_custom');
    
}
add_action('admin_enqueue_scripts', 'axiom_print_admin_scripts');


/*-----------------------------------------------------------------------------------*/
/*  Add Theme styles
/*-----------------------------------------------------------------------------------*/

// Add styles in header
function av3_register_theme_styles(){
    wp_register_style('prettyPhoto'   , THEME_URL . 'css/other/prettyPhoto.css'      , NULL, '3.2');
    wp_register_style('jplayer'       , THEME_URL . 'css/other/jplayer/jplayer.css'  , NULL, '3.2');
    wp_register_style('flexslider'    , THEME_URL . 'css/other/flexslider.css'       , NULL, '1.0');
    wp_register_style('nivoslider'    , THEME_URL . 'css/other/nivoslider.css'       , NULL, '3.1');
    wp_register_style('highlightjs'   , THEME_URL . 'css/other/highlightjs/googlecode.css'  , NULL, '7.2');
    wp_register_style('userdefined'   , THEME_URL . 'css/other/custom.css'           , NULL, '1.0');
    
    wp_enqueue_style ('prettyPhoto');
    wp_enqueue_style ('jplayer');
    
    // load custom.css if the directory is writable. else use inline css fallback
    $inline_css = get_option( 'axiom_'.THEME_ID.'_custom_CSS_options');
    if(empty($inline_css))
        wp_enqueue_style ('userdefined');
    
    // load custom google fonts
    wp_enqueue_style ('custom_typography');
}
add_action('wp_enqueue_scripts', 'av3_register_theme_styles');


/*-----------------------------------------------------------------------------------*/
/*  Add Theme Scripts
/*-----------------------------------------------------------------------------------*/

// Add theme scripts
function av3_register_theme_scripts(){
    wp_deregister_script("jquery");
    //wp_register_script('jquery'       , 'http' . ($_SERVER['SERVER_PORT'] == 443 ? 's' : '') . '://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js');
    wp_register_script('jquery'       , THEME_URL . 'js/libs/jquery-1.8.1.min.js');
    
    wp_register_script('axi_essentials',THEME_URL . 'js/plugins.js' , array('jquery'), '1.0', TRUE);
    
    
    wp_register_script('debouncedresize',THEME_URL . 'js/libs/plugins/jquery.debouncedresize.js' , array('jquery'), '1.0', TRUE);
    
    wp_register_script('hoverIntent'  , THEME_URL . 'js/libs/hoverIntent.js' , array('jquery'), NULL, TRUE);
    wp_register_script('superfish'    , THEME_URL . 'js/libs/superfish.js'   , array('jquery','hoverIntent'), '1.4.8', TRUE);
    
    wp_register_script('flexslider_dc', THEME_URL . 'js/libs/modules/jquery.flexslider.manualDirectionControls.js' , array('jquery', 'flexslider'), NULL, TRUE);
    wp_register_script('flexslider'   , THEME_URL . 'js/libs/modules/jquery.flexslider-min.js'   , array('jquery', 'jquery_easing'), '2.1', TRUE);
    
    wp_register_script('flexslider'   , THEME_URL . 'js/libs/modules/jquery.flexslider-min.js'   , array('jquery', 'jquery_easing'), '2.1', TRUE);
    
    wp_register_script('nivoslider'   , THEME_URL . 'js/libs/modules/jquery.nivo.slider.pack.js' , array('jquery'), '3.1', TRUE);
    
    wp_register_script('jquery_easing', THEME_URL . 'js/libs/plugins/jquery.easing.min.js'  , array('jquery'), '1.3');
    
    wp_register_script('prettyPhoto'  , THEME_URL . 'js/libs/plugins/jquery.prettyPhoto.js' , array('jquery'), '3.2', TRUE);
    
    wp_register_script('jplayer'      , THEME_URL . 'js/libs/plugins/jquery.jplayer/jquery.jplayer.js' , array('jquery'), '2.2');
    wp_register_script('fitvids'      , THEME_URL . 'js/libs/plugins/jquery.fitvids.js'     , array('jquery'), '1.0', TRUE);
    
    wp_register_script('isotope'      , THEME_URL . 'js/libs/plugins/jquery.isotope.min.js' , array('jquery', 'axi_essentials'), '1.5.19', TRUE);
    
    wp_register_script('touchswipe'   , THEME_URL . 'js/libs/plugins/jquery.touchSwipe.min.js' , array('jquery'), '1.3.3', TRUE);
    wp_register_script('mousewheel'   , THEME_URL . 'js/libs/plugins/jquery.mousewheel.min.js' , array('jquery'), '3.0.6', TRUE);
    
    wp_register_script('caroufredsel' , THEME_URL . 'js/libs/plugins/jquery.carouFredSel-6.1.0-packed.js' , array('jquery', 'touchswipe', 'mousewheel', 'jquery_easing'), '6.1.0', TRUE);
    
    wp_register_script('mapapi'       , 'http://maps.google.com/maps/api/js?sensor=false', null, null, TRUE);
    wp_register_script('gomap'        , THEME_URL . 'js/libs/plugins/jquery.gomap-1.3.2.min.js', array('jquery', 'mapapi'), '1.3.2', TRUE);
    
    wp_register_script('minitwitter'  , THEME_URL . 'js/libs/plugins/jquery.minitwitter.js', array('jquery'), '1.0', TRUE);
    
    wp_register_script('highlightjs'  , THEME_URL . 'js/libs/modules/highlight.pack.js', null, '7.2', TRUE);
    
    wp_register_script('axi.src'      , THEME_URL . 'js/script.js' , array('jquery', 'axi_essentials'), '1.22', TRUE);
    
    
    
    // register axi plugins
    wp_register_script('axi.accordion'       , THEME_URL . 'js/libs/plugins/averta.accordion.js' , array('jquery'), '1.2', TRUE);
    
    
    
    // register custom scripts
    wp_register_script('init.faq.accordion'  , THEME_URL . 'js/src/init.faq.js' , array('jquery','axi.accordion' ), null, TRUE);
    
    
    
    wp_enqueue_script ('jquery');
    wp_enqueue_script ('axi_essentials');
    wp_enqueue_script ('superfish');
    wp_enqueue_script ('prettyPhoto');
    wp_enqueue_script ('fitvids');
    
    wp_enqueue_script ('isotope');
    wp_enqueue_script ('caroufredsel');
    wp_enqueue_script ('axi.src');
}
add_action('wp_enqueue_scripts', 'av3_register_theme_scripts');




/*-----------------------------------------------------------------------------------*/
/*  load custom google fonts
/*-----------------------------------------------------------------------------------*/

// register google fonts
function axi_register_google_fonts_styles(){
    global $axiom_options;
    
    // get stored css query
    $css_query = get_option( THEME_ID. '_cssquery');
    
    $protocol = is_ssl() ? 'https' : 'http';
    $query_args = array(
        'family' => $css_query
    );
    
    if(!empty($css_query) && isset($axiom_options["enable_custom_typography"]) ){
        wp_register_style( 'custom_typography', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ), array(), null );
    }elseif(axi_is_script_registered('custom_typography')){
        wp_deregister_style('custom_typography');
    }
}

add_action('wp_enqueue_scripts', 'axi_register_google_fonts_styles', 1 );



?>