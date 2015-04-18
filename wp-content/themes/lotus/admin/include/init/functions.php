<?php
/**
 * General functions here
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */

global $axiom_options;
$axiom_options = get_option( THEME_ID.'_formatted_options');

//// Remove generatore meta tag - refuse to show wordpress version installed //////////////////////

remove_action('wp_head', 'wp_generator'); 

//// get all options and convert to usable format /////////////////////////////////////////////////


function get_axiom_options( $option_id ){
	$raw_options = get_option( $option_id);
    
	return format_axiom_options($raw_options);
}

function format_axiom_options($raw_options){
    $output_options = array();
    
    if( is_array($raw_options) && (count($raw_options) > 0)){
        foreach ($raw_options as $key => $value) 
            $output_options[$value["name"]] = $value["value"];
    }
    
    return $output_options;
}

//// generates option keys for wpml xml file (calling manually)  ///////////////////////////////////

function create_wpml_option_keys(){
    $raw_options = get_option( THEME_ID.'_options');
    
    foreach ($raw_options as $key => $value) {
        echo '&lt;key name="' .$value['name']. '" /&gt;<br />';
    }
}


//// enable gzip compresstion if is available //////////////////////////////////////////////////////

/* ini_set(‘session.use_trans_sid’, false);
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start(); 
*/

//// verfiy current page id ////////////////////////////////////////////////////////////////////////

function is_currentpage_id($id){
    if(!function_exists("get_current_screen"))    return true;
    
    $screen = get_current_screen();
    $res = (is_object($screen) && $screen->id == $id)?TRUE:FALSE;
    return $res;
}


//// is absolute url ////////////////////////////////////////////////////////////////////////////////

function axiom_is_absolute_url($url){
    return preg_match("~^(?:f|ht)tps?://~i", $url);
}

//// create and return absolute url if the url is relative //////////////////////////////////////////

function axiom_get_the_absolute_image_url($url){
    if(axiom_is_absolute_url($url)) return $url;
    
    $uploads = wp_upload_dir();
    return $uploads['baseurl']. '/' .$url;
}

//// create and echo absolute url if the url is relative ////////////////////////////////////////////

function axiom_the_absolute_image_url($url){
    echo axiom_get_the_absolute_image_url($url);
}

//// check if a value is in array or not ////////////////////////////////////////////////////////////

function axiom_is_in_array($value, $array){
    if(!is_array($array) || !isset($value) )    return false;
    
    foreach ($array as $key => $val) 
        if($value == $val)
            return true;
    
    return false;
}

//// get all registerd siderbar ids /////////////////////////////////////////////////////////////////

function axiom_get_all_sidebar_ids(){
    $sidebars = get_option( THEME_ID.'_sidebars');
    $output   = array();
    
    if(isset($axiom_sidebars)  && !empty($axiom_sidebars)){
        foreach($sidebars as $key => $value) {
            $output[] = THEME_ID .'-'. strtolower(str_replace(' ', '-', $value));
        }
    }
    return $output;
}

//// Modify Admin menu //////////////////////////////////////////////////////////////////////////////

function remove_menus () {
global $menu;
    $restricted = array(__('Posts'), __('Comments'));
    end ($menu);
    while (prev($menu)){
        $value = explode(' ',$menu[key($menu)][0]);
        if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
    }
}
//add_action('admin_menu', 'remove_menus');


//// add menu seprator //////////////////////////////////////////////////////////////////////////////

add_action('admin_init','axi_on_admin_init');

function axi_on_admin_init() {
    
    //add menu seprator
    add_admin_menu_separator(28);
    flush_rewrite_rules();
} 

function add_admin_menu_separator($index) {
  global $menu;
  $menu[$index] = array( '', 'read', 'av3_separator', '', 'wp-menu-separator' );
  ksort($menu);
}

//// remove all p tags from  string /////////////////////////////////////////////////////////////////

function axiom_cleanup_content( $content ) { 
 
    /* Remove any instances of '<p>' '</p>'. */ 
    $content = str_replace( array( '<p>'  ), '', $content ); 
    $content = str_replace( array( '</p>' ), '', $content ); 
    
    return $content; 
} 


//// remove all auto generated p tags from shortcode content ////////////////////////////////////////

function axiom_do_cleanup_shortcode( $content ) { 
 
    /* Parse nested shortcodes and add formatting. */ 
    $content = trim( wpautop( do_shortcode( $content ) ) ); 
 
    /* Remove any instances of '<p>' '</p>'. */ 
    $content = axiom_cleanup_content( $content );
    
    return $content; 
} 

//// remove all auto generated p tags & line breaks beside shortcode content ///////////////////////

function axiom_cleanup_beside_shortcodes($content){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );
    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'axiom_cleanup_beside_shortcodes');


//// Get page layouts //////////////////////////////////////////////////////////////////////////////

// returns page layout option
function axiom_get_page_sidebar_pos($id){
    $layout = get_post_meta($id, "page_layout", true);
    return (($layout != "right-sidebar") && ($layout != "left-sidebar")) ? "no-sidebar": $layout;
}
// prints page layout option
function axiom_the_page_sidebar_pos($id){
    echo axiom_get_page_sidebar_pos($id);
}


function axiom_get_page_layout($id){
    return str_replace("sidebar", "layout", axiom_get_page_sidebar_pos($id));
}
function axiom_the_page_layout($id){
    echo axiom_get_page_layout($id);
}


//// specifies whether the page is full or has sidebar  /////////////////////////////////////////////

// specifies whether page is full or not (by name)
function axiom_is_full( $layout ) { 
 
    return ( ($layout == "right-sidebar") || ($layout == "left-sidebar") )?false:true;
} 
// gets page id and specifies whether page is full or not (by id)
function axiom_is_fullwidth( $id ) {
     
    $layout = axiom_get_page_sidebar_pos($id);
    return axiom_is_full($layout);
} 


//// get grid class names by percent size ////////////////////////////////////////////////////////////

function axiom_get_column_num_name($num){
    switch ($num) {
        case 5:
            return "five-column";
            break;
        case 4:
            return "four-column";
            break;
        case 3:
            return "three-column";
            break;
        case 2:
            return "two-column";
            break;
        case 1:
            return "one-column";
            break;
        default:
            return "three-column";
            break;
    }
}

function axiom_get_grid_column_name($size){
    switch ($size) {
        case 20:
            return "five-column";
            break;
        case 25:
            return "four-column";
            break;
        case 33:
            return "three-column";
            break;
        case 50:
            return "two-column";
            break;
        case 100:
            return "one-column";
            break;
        default:
            return "three-column";
            break;
    }
}

function axiom_get_grid_column_number($name){
    switch ($name) {
        case "five-column":
            return 20;
            break;
        case "four-column":
            return 25;
            break;
        case "three-column":
            return 33;
            break;
        case "two-column":
            return 50;
            break;
        case "one-column":
            return 100;
            break;
        default:
            return 33;
            break;
    }
}

function axiom_get_grid_name($size){
    switch ($size) {
        case 20:
            return "one_fifth";
            break;
        case 25:
            return "one_fourth";
            break;
        case 33:
            return "one_third";
            break;
        case 50:
            return "one_half";
            break;
        case 66:
            return "two_third";
            break;
        case 75:
            return "three_fourth";
            break;
        case 100:
            return "one_one";
            break;
        case "1/5":
            return "one_fifth";
            break;
        case "1/4":
            return "one_fourth";
            break;
        case "1/3":
            return "one_third";
            break;
        case "1/2":
            return "one_half";
            break;
        case "2/3":
            return "two_third";
            break;
        case "3/4":
            return "three_fourth";
            break;
        case "1/1":
            return "one_one";
            break;
        default:
            return "";
            break;
    }
}


function axiom_get_image_size_by_col_percent($size){
    global $axi_img_size;
    switch ($size) {
        case 20:
            return $axi_img_size["i5"];
            break;
        case 25:
            return $axi_img_size["i4"];
            break;
        case 33:
            return $axi_img_size["i3"];
            break;
        case 50:
            return $axi_img_size["i2"];
            break;
        case 100:
            return $axi_img_size["i1"];
            break;
        default:
            return $axi_img_size["i1"];
            break;
    }
}

/*-----------------------------------------------------------------------------------*/
/*  get featured image url
/*-----------------------------------------------------------------------------------*/

function av3_featured_img_url($featured_img_size) {
     $image_id  = get_post_thumbnail_id();
     $image_url = wp_get_attachment_image_src($image_id, $featured_img_size);
     $image_url = $image_url[0];
     
     return empty($image_url)?'':'<img alt="featured image" height="50px" src="' . $image_url . '" />';
}

// get featured image url by attachment id
function av3_get_attachment_url($image_id, $featured_img_size = "medium") {
    
    if(is_numeric($image_id)){
        $image_url = wp_get_attachment_image_src($image_id, $featured_img_size);
        return $image_url[0];
    }else{
        return $image_id;
    }
}

// get featured image url by post id
function av3_get_the_attachment_url($post_id, $img_size = "medium") {
    if(is_numeric($post_id)){
        $image_url = wp_get_attachment_image_src(get_post_thumbnail_id( $post_id ), $img_size);
        return $image_url[0];
    }else{
        return $post_id;
    }
}

/*-----------------------------------------------------------------------------------*/
/*  Custom functions for resizing images 
/*-----------------------------------------------------------------------------------*/


// get resized image by image src  ------------------------------------------

function axiom_get_the_resized_image_src( $img_url = "", $width = null , $height = null, $crop = null , $quality = 100 ) {
    return aq_resize( $img_url, $width, $height, $crop, $quality );
}


function axiom_get_the_resized_image( $img_url = "", $width = null , $height = null, $crop = null , $quality = 100 ) {
    return '<img src="'.aq_resize( $img_url, $width, $height, $crop, $quality ).'" />';
}


function axiom_the_resized_image( $img_url = "", $width = null , $height = null, $crop = null , $quality = 100 ) {
    echo axiom_get_the_resized_image( $img_url , $width , $height , $crop , $quality );
}


// get resized image by post id ---------------------------------------------

function axiom_get_the_post_thumbnail_src( $post_id = null, $width = null , $height = null, $crop = null , $quality = 100 ) {
    $post_id = ( null === $post_id ) ? get_the_ID() : $post_id;
    $post_thumbnail_id = get_post_thumbnail_id( $post_id );
    
    $img_url = wp_get_attachment_url( $post_thumbnail_id ,'full'); //get img URL
                               
    if ( $post_thumbnail_id ) {
        return aq_resize( $img_url, $width, $height, $crop, $quality );
    } 
    
    return false;
}

// return resized image tag
function axiom_get_the_post_thumbnail( $post_id = null, $width = null , $height = null, $crop = null , $quality = 100 ) {
    $image_src = axiom_get_the_post_thumbnail_src( $post_id, $width , $height, $crop, $quality);
    if($image_src) return '<img src="'.$image_src.'" />';
    
    return "";
}

// echo resized image tag
function axiom_the_post_thumbnail( $post_id = null, $width = null , $height = null, $crop = null , $quality = 100 ) {
    echo axiom_get_the_post_thumbnail( $post_id, $width , $height, $crop, $quality);
}


// get resized image by attachment id ---------------------------------------------

function axiom_get_the_resized_attachment_src( $attach_id = null, $width = null , $height = null, $crop = null , $quality = 100 ) {
    if( null === $attach_id ) return;
    
    $img_url = wp_get_attachment_url( $attach_id ,'full'); //get img URL
                               
    if ( !empty($img_url) ) 
        return aq_resize( $img_url, $width, $height, $crop, $quality );
    
    return false;
}

// return resized image tag
function axiom_get_the_resized_attachment( $attach_id = null, $width = null , $height = null, $crop = null , $quality = 100 ) {
    $image_src = axiom_get_the_resized_attachment_src( $attach_id, $width , $height, $crop, $quality);
    if($image_src) return '<img src="'.$image_src.'" />';
    
    return "";
}

// echo resized image tag
function axiom_the_resized_attachment( $attach_id = null, $width = null , $height = null, $crop = null , $quality = 100 ) {
    echo axiom_get_the_resized_attachment( $attach_id, $width , $height, $crop, $quality);
}


//// returns the number of active columns in subfooter  /////////////////////////////////////////////

function axiom_get_active_footer_columns (){
    
    global $axiom_options;
    // default number of columns in footer
    $col_nums = 3;
    
    $layout   = axiom_get_footer_layout();
    $col_nums = substr($layout, 7, 1);
    
    return $col_nums;
}


//// returns subfooter layout  ////////////////////////////////////////////////////////////////////

function axiom_get_footer_layout(){
    global $axiom_options;
    $layout = 'layout-3_33-33-33';
    
    if(!is_array($axiom_options)) return $layout;
    
    // posibble layout values that user can set in option panel
    $footer_layouts = array( "layout-2_50-50" ,'layout-2_66-33' ,'layout-2_33-66' ,'layout-2_75-25' ,'layout-2_25-75' ,'layout-3_33-33-33','layout-3_50-25-25','layout-3_25-25-50','layout-4_25-25-25-25');
    // search to find out what value is checked
    foreach ($footer_layouts as $value) {
        if(array_key_exists($value, $axiom_options) && ($axiom_options[$value] == "checked") ){
            $layout = $value;
            break;
        }
    }
    
    return $layout;
}


//// returns the width of nth column in subfooter  //////////////////////////////////////////////////

function axiom_get_nth_footer_column_width($layout, $num){
    
    $size   = substr($layout, (6 + 3 * $num), 2);
    $output = axiom_get_grid_name($size);
    
    return $output;
}

//// prints site socials   //////////////////////////////////////////////////////////////////////////

// get site socials /// 
function axiom_get_the_socials() {
    global $axiom_options;
    
    $output = "";
              
    $output .= '<ul class="socials">';
        
        $socials = array("facebook", "twitter", "gplus", "dribble", "youtube","vimeo", "vimeo2", "flicker", "digg", "stuble", 
                          "lastfm", "delicious", "skype", "linkedin", "tumbler" , "rss" );
        
        // get all socials links from site options and print if is set
        foreach ($socials as $value) {
            if(isset($axiom_options[$value]) && !empty($axiom_options[$value]))
            $output .= '<li ><a class="'.$value.'" href="'.$axiom_options[$value].'" target="_blank" ></a></li>';
        }

    $output .= '</ul><!-- end socials -->';
    
    return $output;
}


// print site socials /// 
function axiom_the_socials() {
    
    echo axiom_get_the_socials();
}

//// Prints pagination nav   //////////////////////////////////////////////////////////////////////////

function axiom_the_paginate_nav(){
    global $wp_query;
    
    $format      = (get_option('permalink_structure'))?'page/%#%/':'&page=%#%';
    $page_link   = get_pagenum_link(1);
    
    // if the format is not structured, remove previous 'page' query string 
    if(!get_option('permalink_structure')){
        
        list($urlpart, $qspart) = array_pad(explode('?', $page_link), 2, '');
        parse_str($qspart, $qsvars);
        unset($qsvars['#038;page']);
        
        $page_link =  $urlpart .'?'. http_build_query($qsvars);
    }
    
    $total_pages = $wp_query->max_num_pages;
    if ($total_pages > 1){
      $current_page = max(1, get_query_var('paged'), get_query_var('page'));
      
      echo '<nav class="axi_paginate_nav">';
      echo paginate_links(array(
          'base' => $page_link . '%_%',
          'format' => $format,
          'current' => $current_page,
          'total' => $total_pages,
          'prev_text' => 'Prev',
          'next_text' => 'Next'
        ));
      echo '</nav>';
    }
}


function axiom_the_search_paginate_nav(){
    global $wp_query;
    
    $format      = (get_option('permalink_structure'))?'page/%#%/':'&page=%#%';
    $page_link   = get_pagenum_link(1);
    $search      = "";
    
    list($urlpart, $qspart) = array_pad(explode('?', $page_link), 2, '');
    parse_str($qspart, $qsvars);
    $search = $qsvars['s'];
    
    unset($qsvars['#038;page']);
    unset($qsvars['#038;submit']);
    unset($qsvars['#038;s']);
    
    if(!get_option('permalink_structure')){
        $page_link =  $urlpart . '?' . http_build_query($qsvars) . '&submit=Search' . '%_%';
    } else {
        $page_link =  $urlpart . '%_%' . '?' . http_build_query($qsvars) . '&submit=Search';
    }
    
    $total_pages = $wp_query->max_num_pages;
    if ($total_pages > 1){
      $current_page = max(1, get_query_var('paged'));
      
      echo '<nav class="axi_paginate_nav">';
      echo paginate_links(array(
          'base' => $page_link ,
          'format' => $format,
          'current' => $current_page,
          'total' => $total_pages,
          'prev_text' => 'Prev',
          'next_text' => 'Next'
        ));
      echo '</nav>';
    }
    
}


//// Prints Page Titles  ///////////////////////////////////////////////////////////////////////////


function axiom_the_main_title($custom_title = NULL, $custom_subtitle = NULL){
    global $post;
    
    if(is_404()) return;
    
    $title    = "";
    $subtitle = "";
    
    
    if(isset($custom_title) || isset($custom_subtitle)){
        
        $title    = $custom_title;
        $subtitle = $custom_subtitle; 
    
    }elseif( is_home() || is_search() ){
        
        if(is_home()  ) $title = __("Blog", "default");
        if(is_search()) $title = __( 'Results for: ', 'default' ) . get_search_query(); 
    
        /* If this is a category archive */ 
    }elseif (is_archive()) { 
            
        if(is_category()){
            $title = __('Posts in category', 'default') . ': '. single_cat_title( '', false);
            $subtitle = category_description();
        /* If this is a tag archive */
        }elseif( is_tag() )
            $title = __('Posts tagged', 'default') . ': '. single_tag_title('', false);
        /* If this is a daily archive */ 
        elseif (is_day()) 
            $title = __("Daily Archives","default") .': '. get_the_date();
        /* If this is a monthly archive */ 
        elseif (is_month()) 
            $title = __("Monthly Archives","default") .': '. get_the_date('F Y');
        /* If this is a yearly archive */ 
        elseif (is_year())  
            $title = __("Yearly Archives","default") .': '. get_the_date('Y');
        /* If this is an author archive */ 
        elseif (is_author())
            $title = _x("All posts by : ", "Title of all posts by author","default") . get_the_author();
        /* If this is an author archive */  
        elseif (is_tax()) {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
            $title = $term->name;
            /* If this is a paged archive */
        }
    
    }elseif(is_singular()) {
        
        $type = isset($post)?get_post_type($post->ID):"";
        
        $title    = isset($post)?get_the_title():""; 
        

        if(is_single() && ($type == "testimonial") ) 
            $subtitle   = isset($post)?get_post_meta($post->ID, "customer_job" , true):"";
        else
            $subtitle   = isset($post)?get_post_meta($post->ID, "page_subtitle", true):"";
    }
    
    
    $show_title = isset($post)?get_post_meta($post->ID, "show_title"   , true):"";
    $show_title = ($show_title == "no")?false:true;
    
    // is title section full or boxed?
    $widthClass = (isset($post) && get_post_meta($post->ID, 'axi_show_title_section_background', true) == "yes")?"":"container";
    
     
    if(!empty($title) && $show_title) { ?>
    <header id="page-title-section" >
        
        <div class="page-header <?php echo $widthClass. ' '; if(!empty($subtitle)) echo 'has-subtitle'; ?>">
            
            <div class="container fold" >
                
                <hgroup>
                    <h1 class="page-title" itemprop="headline"><?php echo $title; ?></h1>
                    <?php if(!empty($subtitle) ) { ?>
                    <h4 class="page-subtitle" ><?php echo $subtitle; ?></h4>
                    <?php } unset($subtitle); ?>
                </hgroup>
                
            <?php // ------------- breadcrumb ---------------
                axiom_the_breadcrumbs();
            ?>  
            
            </div>
       
        </div><!--- end page header --->
        
    </header> <!-- end page header -->
    <?php } unset($title); 
}


//// Prints Content Top margin  ///////////////////////////////////////////////////////////////////////////


function axiom_the_content_top_margin(){
    global $post;
    if(!isset($post) || is_404())    return;
    
    if(!($post->post_type == "page" || $post->post_type == "portfolio" || $post->post_type == "axi_product") ) return;
    
    if(get_post_meta($post->ID, 'axi_show_content_top_margin', true) != "no"){
        echo '<div class="top_content"></div>';
    }
    
}



//// Prints Page Titles  ///////////////////////////////////////////////////////////////////////////

function axiom_the_header_slider($slider){
    if(is_object($slider))
        $slider_id = get_post_meta( $slider->ID, 'top_slider_id', true ) ;
    if(!isset($slider_id) || $slider_id == "none" || empty($slider_id) ) return;
    
    // get slider layout
    $slider_width   = get_post_meta( $slider->ID, 'top_slider_width'  , true ) ;
    $slider_divider = get_post_meta( $slider->ID, 'top_slider_divider', true ) ;
    $foldClass    = ($slider_width == "boxed")?"container":"";
    
    // the slider is flex or nivo slider
    if(is_numeric($slider_id)){
        // echo slider wrapper
        echo '<div id="site_topslider" class="'.$foldClass.'" >';
            
        $slider_options = get_post_meta($slider_id, 'slider-data', true); 
        
        if($slider_options["type"] == "flex"){
            echo do_shortcode('[the_flexslider id="'.$slider_id.'" ]');
            
        }else if($slider_options["type"] == "nivo"){
            
            echo do_shortcode('[the_nivoslider id="'.$slider_id.'" ]');
        }
        
    // if the slider is layer slider   
    }elseif(substr($slider_id, 0, 3) == "ls_"){
        echo '<div id="site_topslider" class="'.$foldClass.'" >';
        
        $ls_id = substr($slider_id, 3);
        echo do_shortcode('[layerslider id="'.$ls_id.'" ]');
    
    
    // if the slider is cute slider  
    }elseif(substr($slider_id, 0, 3) == "cs_"){
        echo '<div id="site_topslider" class="'.$foldClass.'" >';
        
        $cs_id = substr($slider_id, 3);
        echo do_shortcode('[cuteslider id="'.$cs_id.'" ]');
     
     
    // the slider is revolution slider
    }elseif (class_exists('RevSlider')){
        echo '<div id="site_topslider" >';
        
        putRevSlider($slider_id);
    }
    
    
    if(empty($slider_divider) || ($slider_divider == "pattern") )
        echo '<div class="sep hbar"></div>';
    
    echo '</div>';
}

//// Check whether script has been registered  /////////////////////////////////////////////////////

function axi_is_script_registered($handle){
    return wp_script_is( $handle, "registered" );
}


//// print custom background styles  ///////////////////////////////////////////////////////////////

function axi_print_custom_background_style(){
    global $post;
    if(!isset($post) || is_404())    return;
    
    $p_id    =  $post->ID;
    if(!is_numeric($p_id))  return;
    
    $output = "";
    
    if(get_post_meta($p_id, 'axi_show_custom_background', true) == "yes"){
        
        $color  = get_post_meta($p_id, 'axi_custom_background_color', true);
        $repeat = get_post_meta($p_id, 'axi_custom_background_repeat', true);
        $attach = get_post_meta($p_id, 'axi_custom_background_attachment', true);
        $position = get_post_meta($p_id, 'axi_custom_background_position', true);
        $image  = get_post_meta($p_id, 'axi_custom_background_image', true);
        
        $output .= "\tbody {";
        $output .= "\t";
        $output .= 'background:'.$color.' url('.$image.') '.$repeat. ' '.$attach.' '.$position. "; } \n";
        
        $output .= "\t#inner-body { max-width: 1050px; margin: 0 auto; } \n" ;
        $output .= "\t@media only screen and (min-width: 1024px) { #inner-body { max-width: 1050px; } } \n" ;
    }
    
    if(get_post_meta($p_id, 'axi_show_title_section_background', true) == "yes"){
        
        $color  = get_post_meta($p_id, 'axi_title_section_background_color', true);
        $repeat = get_post_meta($p_id, 'axi_title_section_background_repeat', true);
        $attach = get_post_meta($p_id, 'axi_title_section_background_attachment', true);
        $position = get_post_meta($p_id, 'axi_title_section_background_position', true);
        $image  = get_post_meta($p_id, 'axi_title_section_background_image', true);
        
        $output .= "\t#page-title-section .page-header {";
        $output .= "\t";
        $output .= 'background:'.$color.' url('.$image.') '.$repeat. ' '.$attach.' '.$position. "; } \n";
    }
    
    if(!empty($output)){
        $style  = "<!-- Custom Background Style -->\n";
        $style .= "<style type=\"text/css\" >\n";
        $style .= stripslashes($output);
        $style .= "</style>\n";
        
        echo $style;
    }
    
}

////  //////////////////////////////////////////////////////////////////////////////

add_action('admin_init','axi_update_product_type');

function axi_update_product_type() {
    global $wpdb;
    
    $wpdb->query("
        SELECT post_type
        FROM wp_posts
        WHERE post_type = 'product'
    ");
    
    if($wpdb->num_rows > 0){
        $wpdb->query("
            UPDATE wp_posts
            SET post_type = 'axi_product'
            WHERE post_type = 'product'
        ");
        
    }
    
}


//// add some menu to admin bar menu  ///////////////////////////////////////////////////////////////

add_action( 'admin_bar_menu', 'axiom_modify_admin_bar_menu', 999);

function axiom_modify_admin_bar_menu( $wp_admin_bar ) {
    global $wp_admin_bar;
    
    $args = array(
      'id' => 'axiom-theme-options', // id of the existing child node
      'title' => __('Theme Options', 'default'), // alter the title of existing node
      'parent' => "site-name", // set parent node
      'href' => admin_url( 'admin.php?page=axiom' ) // attribute for the link
    );

    $wp_admin_bar->add_node($args);
}

//// check if the directory is writable  /////////////////////////////////////////////////////////////

function axiom_is_dir_writable($the_dir){
    if(!function_exists('get_filesystem_method')) false;
    
    return (get_filesystem_method(array(), $the_dir) == "direct");
}


//// inline css output fallback  /////////////////////////////////////////////////////////////////////

function axi_print_option_panel_styles_fallback(){
    
    $style = "";
    $css = get_option( 'axiom_'.THEME_ID.'_custom_CSS_options');
    
    if(!empty($css)){
        $style  = "<!-- Custom Options Style -->\n";
        $style .= "<style type=\"text/css\" >\n";
        $style .= stripslashes($css);
        $style .= "</style>\n";
        
        echo $style;
    }
}


//// Color Manipulation  /////////////////////////////////////////////////////////////////////////////

function ColorShader($color, $dif=20){
 
  $color = str_replace('#', '', $color);
  if (strlen($color) != 6){ return '000000'; }
  $rgb = '';
  
  for ($x=0;$x<3;$x++){
    $c = hexdec(substr($color,(2*$x),2)) - $dif;
    $c = ($c < 0) ? 0 : dechex($c);
    $rgb .= (strlen($c) < 2) ? '0'.$c : $c;
  }
  
  return '#'.$rgb;
}


////   /////////////////////////////////////////////////////

//breadcrumb function
function axiom_the_breadcrumbs() {
    global $post, $axiom_options;
     
    if( is_home() ||  is_front_page() || is_404() || is_search() ){ return; }
    
    $this_temp_name = get_post_meta( $post->ID, '_wp_page_template', TRUE );
    $this_page_type = $post->post_type;
    
    $crumbs  =    '';
    $crumbs .=    '<p id="axi_breadcrumbs"><span><a href="'.get_option('home').'">'._x("Home","Home in breadcrumb" ,"default").'</a></span>';
    
    //if it is page
    if(is_page()) {
        
        $branch = array(' / <span> '.get_the_title($post->ID). '</span>');
        
        // loops thtough branch if has parent
        $p_post = $post;
        
        while ($p_post->post_parent) {
            $branch[] = ' / <span><a href="'.get_permalink($p_post->post_parent).'">'.get_the_title($p_post->post_parent).'</a></span>';
            $p_post   = get_post($p_post->post_parent);
        }
        
        $branch = array_reverse($branch);
        
        $crumbs .= implode("", $branch);
        
        $crumbs .=    '</p>'."\n";
    }
    
    //if it's a single news/blog post --------------------------
    
    if(is_single()) {
        
        $count_limit = 1;
        
        if($this_page_type == "news") {
            
            $cat_terms = wp_get_post_terms($post->ID, 'news-category'); 
            
            if($cat_terms){
                foreach($cat_terms as $term){
                    if($count_limit < 1) break;
                    $crumbs .= ' / <span><a href="'. get_term_link($term->slug, 'news-category') .'"  >'.$term->name.'</a></span>';
                    --$count_limit;
                }
            }
            
            $crumbs .=    '</p>'."\n";
        }
        
        elseif($this_page_type == "post") {
            
            $cat_terms = wp_get_post_terms($post->ID, 'category'); 
            
            if($cat_terms){
                foreach($cat_terms as $term){
                    if($count_limit < 1) break;
                    $crumbs .= ' / <span><a href="'. get_term_link($term->slug, 'category') .'"  >'.$term->name.'</a></span>';
                    --$count_limit;
                }
            }
            
            $crumbs .=    '</p>'."\n";
        }
        
        
        elseif($this_page_type == "portfolio") {
                
            $nav_type = !isset($axiom_options["portfolio_single_nav_type"])?"breadcrumb":$axiom_options["portfolio_single_nav_type"];
            
            if($nav_type == "breadcrumb"){
                
                $crumbs .= ' / <span> '._x("Portfolio", "in single portfolio page breadcrumb", "default"). '</span>';
                
                $cat_terms = wp_get_post_terms($post->ID, 'project-type'); 
                
                if($cat_terms){
                    foreach($cat_terms as $term){
                        if($count_limit < 1) break;
                        $crumbs .= ' / <span>'.$term->name.'</span>';
                        --$count_limit;
                    }
                }
                
                $crumbs .= ' / <span> '.get_the_title($post->ID). '</span>';
                $crumbs .=    '</p>'."\n";
            
            }elseif($nav_type == "next_prev") {
                    
                echo        '<p id="axi_breadcrumbs"><span>';
                previous_post_link( '%link', _x('previous', 'navigate to previous page', 'default') );
                echo        '</span> / <span>';
                next_post_link( '%link', _x('next', 'navigate to next page', 'default') );
                echo        '</span>';
                
                $crumbs  =    '';
                
            }else {
                $crumbs = "";
            }
        
        }

        
        elseif($this_page_type == "axi_product") {
            
            $nav_type = !isset($axiom_options["product_single_nav_type"])?"breadcrumb":$axiom_options["product_single_nav_type"];
            
            $crumbs .= ' / <span> '._x("Products", "in single product page breadcrumb", "default"). '</span>';
            
            if($nav_type == "breadcrumb"){
                
                $cat_terms = wp_get_post_terms($post->ID, 'product-category'); 
                
                if($cat_terms){
                    foreach($cat_terms as $term){
                        if($count_limit < 1) break;
                        $crumbs .= ' / <span>'.$term->name.'</span>';
                        --$count_limit;
                    }
                }
                
                $crumbs .= ' / <span> '.get_the_title($post->ID). '</span>';
                $crumbs .=    '</p>'."\n";
                
            }elseif($nav_type == "next_prev") {
                    
                echo        '<p id="axi_breadcrumbs"><span>';
                previous_post_link( '%link', _x('previous', 'navigate to previous page', 'default') );
                echo        '</span> / <span>';
                next_post_link( '%link', _x('next', 'navigate to next page', 'default') );
                echo        '</span>';
                
                $crumbs  =    '';
                
            }else {
                $crumbs = "";
            }
        
        }

        elseif($this_page_type == "staff") {
            
            $crumbs .= ' / <span> '._x("Staff", "in single staff page breadcrumb", "default"). '</span>';
            
            $crumbs .= ' / <span> '.get_the_title($post->ID). '</span>';
            $crumbs .=    '</p>'."\n";
        
        }
        
        else{
            
            $crumbs .= ' / <span> '.get_the_title($post->ID). '</span>';
            $crumbs .=    '</p>'."\n";
        }
        
    }
    
    //if it's the news/blog home page or any type of archive
    elseif( is_archive() ) {
        $crumbs = "";
    }
    
    
    
    
    echo $crumbs;
}


?>