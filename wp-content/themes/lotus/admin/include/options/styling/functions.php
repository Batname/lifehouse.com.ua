<?php
/**
 * Functions for enaplaing styling options
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
 
 
//// Update site custom styles  //////////////////////////////////////////////////////////////////////


/*-----------------------------------------------------------------------------------*/
/*  gets current style options and stores in css file
 *  this function will be called by option panel save handler
/*-----------------------------------------------------------------------------------*/

function axi_save_custom_styles(){
    global $axiom_options;
    $styles = $axiom_options;
    
    $css_file  = get_template_directory() . '/css/other/custom.css';
    
    ob_start();
    require(ADMIN_INC.'options/styling/terms.php');
    // if custom typography is enabled, output custom typography styles
    if(isset($axiom_options["enable_custom_typography"]))
        require(ADMIN_INC.'options/styling/typography.php');
    require(ADMIN_INC.'options/styling/general.php');
    require(ADMIN_INC.'options/styling/layout.php');
    require(ADMIN_INC.'options/styling/styles.php');
    require(ADMIN_INC.'options/styling/user-css.php');
    $css = ob_get_clean();
    
    // write to custom.css file
    WP_Filesystem();
    global $wp_filesystem;
    
    if ( ! $wp_filesystem->put_contents( $css_file, $css, 0644) ) {
        // if the directory is not writable, try inline css fallback
        update_option( 'axiom_'.THEME_ID.'_custom_CSS_options' , $css); // save css rules as option to print as inline css
    }else {
        update_option( 'axiom_'.THEME_ID.'_custom_CSS_options' , ""); // disable inline css output
    }
    
    // creates css query for loading google fonts, and registers css to enqueue by wp
    axi_register_custom_gfonts();
}

/*-----------------------------------------------------------------------------------*/
/*  gets google fonts in json format and converts them to an array
 *  this function does not call by theme , it is a manual parser
/*-----------------------------------------------------------------------------------*/

function axi_filter_json_google_fonts(){
    
    // get all fonts from json files
    $g_font_list = file_get_contents( ADMIN_INC_URL .'options/styling/cache/allfonts.json');
    $g_font_list = json_decode($g_font_list);
    $g_font_list = $g_font_list->items;
    
    // an array to store font lists from json data
    $list = array();
    // how many font you want to return
    $get_num = 280;
    
    foreach ($g_font_list as $item) {
        if($get_num < 0) break;
        $font = array();
        $font['css']    = str_replace(" ", "+", $item->family );
        $font['styles'] = $item->variants;
        
        $list[$item->family] = $font;
        --$get_num;
    }
    
    return $list;
}

/*-----------------------------------------------------------------------------------*/
/*  check the font name if it is google font
/*-----------------------------------------------------------------------------------*/

function axi_is_googlefont($fontname){
    return preg_match('/[A-Z]/', $fontname);
}

/*-----------------------------------------------------------------------------------*/
/*  get google fonts name for use in dropdown element 
/*-----------------------------------------------------------------------------------*/

function axi_get_google_font_names(){
    // get all fonts in array
    include(ADMIN_INC.'options/styling/cache/allfonts.php');
    $g_fonts = unserialize($g_fonts);
    return $g_fonts;
}

/*-----------------------------------------------------------------------------------*/
/*  get fontface name in correct format
/*-----------------------------------------------------------------------------------*/
// get font face option by id
function axi_get_fontface($id){
    global $axiom_options;
    
    $face = $axiom_options[$id];
    // if font name contains upper case, wrap the name in col
    if(axi_is_googlefont($face)){ $face = "'".$face."'"; }
    
    return $face;
}

// print font face option by id
function axi_the_fontface($id){
    echo axi_get_fontface($id);
}


/*-----------------------------------------------------------------------------------*/
/*  returns a string containing the name of special charecters
 *  this method will be called during saving options 
 *  @return e.g: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext
/*-----------------------------------------------------------------------------------*/

function axi_get_name_of_special_charecters(){
    global $axiom_options;
    
    $subsets = "";
    
    if ( isset($axiom_options["include_latin_chars"]) )
        $subsets .= 'latin,latin-ext';
    
    return $subsets;
}

/*-----------------------------------------------------------------------------------*/
/*  creates css query for loading selected google fonts, and registers css to enqueue by wp
 *  this function will be called by axi_save_custom_styles
/*-----------------------------------------------------------------------------------*/

function axi_register_custom_gfonts(){
    global $axiom_options;
    
    $enq_fonts = array();
    $css_query = '';
    $fonts     = axi_get_google_font_names();
    
    // get special charecter sets
    $ext_chars = axi_get_name_of_special_charecters();
    update_option( THEME_ID. '_font_subsets', $ext_chars);
    
    
    // Includes all defined options
    include ADMIN_INC.'options/axiom-options.php';
    
    // loop through all options and get typography elements
    // then store google fonts in an array ($enq_fonts)
    foreach ($options as $option) {
        if($option['type'] == 'typography'){
            // get stored font name
            $face = isset($axiom_options[$option['id'].'[face]'])?$axiom_options[$option['id'].'[face]']:"";
            
            if(axi_is_googlefont($face)){ $enq_fonts[] = $face; }
        }
    }
    
    // remove duplicated fonts from list
    $enq_fonts = array_unique($enq_fonts);
    
    foreach ($enq_fonts as $face) {
        if(!empty($css_query)){ $css_query .= '|'; }
        $css_query .= str_replace(" ", "+", $face). ':';
        
        // current font object
        $font = $fonts[$face];
        // add font styles to css query
        foreach ($font['styles'] as $style) {
            $css_query .= $style . ',';
        }
        
        substr_replace($css_query, "", -1);
        
    }
    
    // add special charecter sets to google css query
    if(!empty($ext_chars))
        $css_query .= '&subset=' .$ext_chars;
    
    // store css query as an option
    update_option( THEME_ID. '_cssquery', $css_query);
}



?>