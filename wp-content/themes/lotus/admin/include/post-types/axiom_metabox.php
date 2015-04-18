<?php
/**
 * Class for creating custom metaboxes
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
 
class AxiomMetabox {
	
    public function __construct() { }
    
    // properties ////////////////////
    
    public $fields   = array();
    public $id       = "";
    public $title    = "";
    public $type     = array();
    public $context  = 'normal';
    public $priority = 'high';
    
    // functions /////////////////////
    
    public function init(){
        add_action('admin_menu', array($this, 'add_meta_box') );
    }
    
    function add_meta_box(){
        foreach ($this->type as $postype) {
            
            add_meta_box(   $this->id, 
                            $this->title, 
                            array($this, 'display_meta_box'), 
                            $postype, 
                            $this->context, 
                            $this->priority
                        );
        }
        add_action('save_post', array($this, 'save_meta_box'));
    }
    
        
    /* Show Metabox Fields in Edit Page -----------------
     * ------------------------------------------------*/
    function display_meta_box() {
        global $post;
        global $ax_post_metabox, $post;
        
        wp_nonce_field( $this->id , $this->id.'-nonce' ); 
        
        echo '<div class="av3_container" style="margin:10px 0;" >';
        
           echo '<div class="form-table meta-box">';
        
        
        
        foreach ($this->fields as $field) {
            // get current post meta data
            $meta = isset($field['id'])?get_post_meta($post->ID, $field['id'], true):"";
            
            switch ($field['type']) {
                
                //If Text box
                case 'colorpicker':
                    echo '<div class="section-row">',
                            '<label >', $field['name'], '</label>',
                            '<div class="section-row-right" >',
                            '<div class="mini-color-wrapper" >',
                              '<input type="text" class="colorpickerField" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" />',
                            '</div>',
                              '<p >'. $field['desc'].'</p>',
                            '</div>',
                         '</div>';
                    break;
                    
                //If Textbox
                case 'textbox':
                    echo '<div class="section-row">',
                            '<label >', $field['name'], '</label>',
                            '<div class="section-row-right" >',
                              '<input type="text"  name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" />',
                              '<p >'. $field['desc'].'</p>',
                            '</div>',
                         '</div>';
                    break;
                    
                //If Textarea
                case 'textarea':
                    echo '<div class="section-row">',
                            '<label >', $field['name'], '</label>',
                            '<div class="section-row-right" >',
                              '<textarea  name="', $field['id'], '" id="', $field['id'], '" >', $meta ? $meta : $field['std'], '</textarea>',
                              '<p >'. $field['desc'].'</p>',
                            '</div>',
                         '</div>';
                    break;
                    
                //If select
                case 'select':
                    echo '<div class="section-row">',
                            '<label >', $field['name'], '</label>',
                            '<div class="section-row-right" >',
                            
                                '<select name="', $field['id'], '" id="', $field['id'], '" class="meta-select" data="', $meta ,'" style="width:150px" />';
                        foreach ($field['options'] as $key => $value) {
                            echo    '<option value="', $value ,'" >', _e($value, "default"), '</option>';
                        }
                        
                        echo    '</select>',
                                '<p>'. $field['desc'].'</p>',
                           '</div></div>';
                    break;
                
                //If select
                case 'dropdown':
                    echo '<div class="section-row">',
                            '<label >', $field['name'], '</label>',
                            '<div class="section-row-right" >',
                            
                                '<select name="', $field['id'], '" id="', $field['id'], '" class="meta-select" data="', $meta ,'" style="width:150px" />';
                        foreach ($field['options'] as $key => $value) {
                            echo    '<option value="', $key ,'" >', _e($value, "default"), '</option>';
                        }
                        
                        echo    '</select>',
                                '<p>'. $field['desc'].'</p>',
                           '</div></div>';
                    break;
                
                
                case 'icon':
                    echo '<div class="section-row">',
                            '<label >', $field['name'], '</label>',
                            '<div class="section-row-right" >',
                            
                                '<select name="', $field['id'], '" id="', $field['id'], '" class="meta-select" data="', $meta ,'" style="width:150px" />',
                                '<option value="">',__('Choose ..', 'default'),'</option>';
                        include 'icons.php';
                        echo    '</select>',
                                '<p>'. $field['desc'].'</p>',
                           '</div></div>';
                    break;
                    
                //If Media upload   
                case 'media':
                    echo '<div class="section-row">',
                            '<label >', $field['name'], '</label>',
                            '<div class="section-row-right" >',
                            
                                '<fieldset class="uploader" >',
                                    
                                    '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" />',
        
                                    '<input type="button" class="white" value="', $field['upload_std'] ,'" style="margin-right:5px;" />';
                                
                        if(!empty($field['remove_std'])){ 
                               echo '<input type="button" class="white alert" value="', $field['remove_std'] ,'" />';
                        }
                        echo        '<div class="imgHolder"><strong title="'.__("Remove image", "default").'" class="close">X</strong>',
                                    '<img alt src="" /></div>',
                                    '<p >'. $field['desc'].'</p>',  
                        
                                '</fieldset>',
                            '</div>',
                        '</div>';
                           
                    break;
                    
                //If seprator
                case 'sep':
                    $desc = empty($field['desc'])?'':'<span>'.$field['desc'].'</span>';
                    echo '<div class="section-legend" ><p>', $field['name'], '</p>',$desc,'</div>';
                    break;
            }
        }
        
        echo '</div></div>';
    }
    
    
    /* Save Data From Metabox fields --------------------
     * ------------------------------------------------*/
    function save_meta_box($post_id) {
        global $post;
        global $wpdb;
        
        // Verify the nonce before proceeding. 
        if ( !isset( $_POST[$this->id.'-nonce'] ) || !wp_verify_nonce( $_POST[$this->id.'-nonce'], $this->id ) )
        return $post_id;
        
        // Get the post type object. 
        $post_type = get_post_type_object( $post->post_type );
    
        // Check if the current user has permission to edit the post. 
        if ( !current_user_can( $post_type->cap->edit_post, $post->ID ) ){
            return $post->ID;
        }
        
        // check autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post->ID;
        }
        
        foreach ($this->fields as $field) {
            if($field['type'] == "sep") continue;
            
            $old = get_post_meta($post->ID, $field['id'], true);
            $new = $_POST[$field['id']];
            
            if ($new && $new != $old) {
                update_post_meta($post->ID, $field['id'], $new);
            } elseif ('' == $new && $old) {
                delete_post_meta($post->ID, $field['id'], $old);
            }
        }
        
    }
}

?>