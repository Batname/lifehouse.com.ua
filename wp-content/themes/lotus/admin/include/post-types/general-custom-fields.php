<?php


/*==================================================================================================
  
    Add General custom meta box
 
 *=================================================================================================*/
 
$axi_gen_title_metabox        = new AxiomMetabox();
$axi_gen_title_metabox->id    = "axi_general_title_options_meta_box";
$axi_gen_title_metabox->title = __('Title Setting', 'default');
$axi_gen_title_metabox->type  = array( 'page', 'portfolio', 'axi_product');
$axi_gen_title_metabox->fields= array(
                                    array(
                                        'name' => __('Display Page Title?', 'default'),
                                        'desc' => __('Specifies whether the page title is visible or not', 'default'),
                                        'id' => 'show_title',
                                        'type' => 'dropdown',
                                        'options' => array( "yes" => __("Yes", "default"), "no" => __("No", "default") )
                                    ),
                                    array(
                                        'name' => __('Subtitle', 'default'),
                                        'desc' => __('Second Title (optional)', 'default'),
                                        'id'   => 'page_subtitle',
                                        'type' => 'textbox',
                                        'std' => ''
                                    ),
                                    array(
                                        'name' => __('Display Content Top Margin?', 'default'),
                                        'desc' => __('Do You want to display the white space on top of the content (the space between title and content)? if you need to start your content from very top of the page, set it to "No"', 'default'),
                                        'id' => 'axi_show_content_top_margin',
                                        'type' => 'dropdown',
                                        'options' => array( "yes" => __("Yes", "default"), "no" => __("No", "default") )
                                    ),
                                    array(
                                        'name' => __('Background for title section', 'default'),
                                        'desc' => '',
                                        'type' => 'sep',
                                    ),
                                    array(
                                        'name' => __('Enable Title Background?', 'default'),
                                        'desc' => __('Do You want to display custom background for title section? if you select "Yes", you can add color and image background to title section by following options.', 'default'),
                                        'id' => 'axi_show_title_section_background',
                                        'type' => 'dropdown',
                                        'options' => array( "no" => __("No", "default"), "yes" => __("Yes", "default") )
                                    ),
                                    array(
                                        'name' => __('Title Background Color', 'default'),
                                        'desc' => __('Specifies background color for title section', 'default'),
                                        'id'   => 'axi_title_section_background_color',
                                        'type' => 'colorpicker',
                                        'std'  => ''
                                    ),
                                    array(
                                        'name' => __('Title Background Repeat', 'default'),
                                        'desc' => __('Specifies how background image repeats for title section', 'default'),
                                        'id'   => 'axi_title_section_background_repeat',
                                        'type' => 'select',
                                        'options' => array("no-repeat" , "repeat", "repeat-x", "repeat-y")
                                    ),
                                    array(
                                        'name' => __('Title Background attachment', 'default'),
                                        'desc' => __('Specifies the background is fixed or scrollable as user scrolls the document', 'default'),
                                        'id'   => 'axi_title_section_background_attachment',
                                        'type' => 'select',
                                        'options' => array("fixed" , "scroll")
                                        ),
                                    array(
                                        'name' => __('Title Background position', 'default'),
                                        'desc' => __('specifies background image alignment for title section', 'default'),
                                        'id'   => 'axi_title_section_background_position',
                                        'type' => 'select',
                                        'options' => array("left top", "left center", "left bottom", "right top", 
                                                        "right center", "right bottom", "center top", "center center", "center bottom")
                                        ),
                                    array(
                                        'name' => __('Title Background image', 'default'),
                                        'desc' => __('Specifies background image for title section', 'default'),
                                        'id'   => 'axi_title_section_background_image',
                                        'type' => 'media',
                                        'class'=> 'media_upload_field',
                                        'upload_std' => __('Browse', 'default'),
                                        'remove_std' => __('Remove', 'default'),
                                        'std' => ''
                                        )
                                );
$axi_gen_title_metabox->init();


/*==================================================================================================
  
 	Add General custom meta box
 
 *=================================================================================================*/
 
$axi_gen_bg_metabox        = new AxiomMetabox();
$axi_gen_bg_metabox->id    = "axi_general_bg_meta_box";
$axi_gen_bg_metabox->title = __('Background Setting', 'default');
$axi_gen_bg_metabox->type  = array( 'page', 'portfolio', 'axi_product');
$axi_gen_bg_metabox->fields= array(
                                    array(
                                        'name' => __('You can specify custom background for this page.<br/>', 'default'),
                                        'desc' => 'Please note that you need to set site layout to "Boxed" in order to see custom background. ("site layout" option is available in theme option panel)',
                                        'type' => 'sep',
                                    ),
                                    array(
                                        'name' => __('Enable Background?', 'default'),
                                        'desc' => __('Do You want to display custom background for this page?', 'default'),
                                        'id' => 'axi_show_custom_background',
                                        'type' => 'dropdown',
                                        'options' => array( "no" => __("No", "default"), "yes" => __("Yes", "default") )
                                    ),
                                    array(
                                        'name' => __('Background color', 'default'),
                                        'desc' => __('Specifies background color', 'default'),
                                        'id'   => 'axi_custom_background_color',
                                        'type' => 'colorpicker',
                                        'std'  => ''
                                    ),
                                    array(
                                        'name' => __('Background repeat', 'default'),
                                        'desc' => __('Specifies how background image repeats', 'default'),
                                        'id'   => 'axi_custom_background_repeat',
                                        'type' => 'select',
                                        'options' => array("no-repeat" , "repeat", "repeat-x", "repeat-y")
                                    ),
                                    array(
                                        'name' => __('Background attachment', 'default'),
                                        'desc' => __('Specifies the background is fixed or scrollable as user scrolls the document', 'default'),
                                        'id'   => 'axi_custom_background_attachment',
                                        'type' => 'select',
                                        'options' => array("fixed" , "scroll")
                                        ),
                                    array(
                                        'name' => __('Background position', 'default'),
                                        'desc' => __('specifies background image alignment', 'default'),
                                        'id'   => 'axi_custom_background_position',
                                        'type' => 'select',
                                        'options' => array("left top", "left center", "left bottom", "right top", 
                                                        "right center", "right bottom", "center top", "center center", "center bottom")
                                        ),
                                    array(
                                        'name' => __('Background image', 'default'),
                                        'desc' => _x('custome background image','custom background image for each page', 'default'),
                                        'id'   => 'axi_custom_background_image',
                                        'type' => 'media',
                                        'class'=> 'media_upload_field',
                                        'upload_std' => __('Browse', 'default'),
                                        'remove_std' => __('Remove', 'default'),
                                        'std' => ''
                                        )
                                );
$axi_gen_bg_metabox->init();


 
/*==================================================================================================
 * 
 *   Add custom sidebar meta box 
 * 
 *=================================================================================================*/

function axiom_init_sidebar_meta_box(){
    // add custom sidebar metabox to following types
    $types = array('page');
    
    foreach ($types as $key => $value) {
        add_meta_box("axiom_custom_sidebar_meta", 
                __("Custom sidebar", 'default'), 
                "axiom_display_custom_sidebar_meta", 
                $value, 
                "side", 
                "low");
    }
    
    // Save custom sidebar meta
    add_action('save_post', 'axiom_save_custom_sidebar_meta');  
}  

/* Display the sidebar meta box. -----------------
 * --------------------------------------------------- */

function axiom_display_custom_sidebar_meta(){
    global $post;
    
    wp_nonce_field( basename( __FILE__ ), 'sidebar-id-nonce' ); 
    $name     = esc_attr( get_post_meta( $post->ID, 'sidebar-id', true ) );
    $sidebars = get_option( THEME_ID.'_sidebars');
    
    //if( !axiom_is_in_array($name , axiom_get_all_sidebar_ids() ) )  $name = '';
    
?>
    <select class="meta-select" style="width:95%;max-width:200px;" name="sidebar-id" value="<?php echo $name; ?>" data="<?php echo $name; ?>" >
    <?php 
        echo '<option value="" >'.__('--- no sidebar ---', 'default').'</option>';
        if( isset($sidebars) && !empty($sidebars) ) {
            
            foreach($sidebars as $key => $val){
                $sidebar_id = THEME_ID .'-'. strtolower(str_replace(' ', '-', $val));
                echo '<option value="'.$sidebar_id.'">'.$val.'</option>';
            }  
        }
    ?>
    </select>
<?php
}

/* Save the sidebar meta box. --------------------
 * --------------------------------------------------- */

function axiom_save_custom_sidebar_meta($post_id){
    global $post;
    $post_id = isset($post_id)?$post_id:$post->ID;
    
    // Verify the nonce before proceeding. 
    if ( !isset( $_POST['sidebar-id-nonce'] ) || !wp_verify_nonce( $_POST['sidebar-id-nonce'], basename( __FILE__ ) ) )
    return $post_id;
    
    // Get the post type object. 
    $post_type = get_post_type_object( $post->post_type );

    // Check if the current user has permission to edit the post. 
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) ){
        return $post_id;}
    
    // check to if WordPress isn’t currently saving the post or custom fields
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
        return $post_id;  }

    update_post_meta($post->ID, "sidebar-id", $_POST["sidebar-id"] );  
    
}  


// Add sidebar meta box on admin init
add_action("admin_init", "axiom_init_sidebar_meta_box"); 

?>