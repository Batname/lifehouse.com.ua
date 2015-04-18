<?php
/**
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */

/*----------------------------------------------

 *  Axiiom Widget Class

 * --------------------------------------------*/



class Axiom_Widget extends WP_Widget {

    private $defaults = array();
    public $fields    = array();

    
    /** constructor */

    function __construct() {
        
        $this->set_defaults();
    }
    
    
    function set_fields($fields){
        $this->fields = $fields;
    }
    
    
    private function set_defaults(){
        foreach ($this->fields as $field) {
            $this->defaults[$field["id"]] = $field["value"];
        }
    }

    
    // outputs the content of the widget

    function widget( $args, $instance ) {
        
    }



    // processes widget options to be saved

    function update( $new_instance, $old_instance ) {
        
        $instance = $old_instance;
        $new_instance = wp_parse_args( (array) $new_instance, $this->defaults );
        
        foreach ($this->fields as $field) {
            $id = $field["id"];
            $instance[$id] = strip_tags($new_instance[$id]);
        }
        
        return $instance;
    }

    

    // outputs the options form on admin

    function form( $instance ) {
        
        $instance = wp_parse_args( (array) $instance, $this->defaults );
        
        // get_field_id (string $field_name) 
        // creates id attributes for fields to be saved by update()
        foreach ($this->fields as $field) {
            
            $id   = $field['id']; 
            
            switch ($field['type']) {
                
                case 'textbox':
                    
                    echo '<p>',
                        '<label for="'.$this->get_field_id($id).'" >'.$field["name"].'</label>',
                        '<input class="widefat" id="'.$this->get_field_id($id).'" name="'.$this->get_field_name($id).'" type="text" value="'.$instance[$id].'" />',
                    '</p>';
                    
                    break;
                    
                case 'select':
                    echo '<p>', 
                        '<label for="'.$this->get_field_id($id).'" >'. $field['name']. '</label>',
                        '<select name="'.$this->get_field_name($id).'" id="'.$this->get_field_id($id).'" value="'.$instance[$id].'" style="width:97%;"  />';
                foreach ($field['options'] as $key => $value) {
                    echo    '<option value="'.$key.'" '.(($instance[$id] == $key)?'selected="selected"':'' ).' >'. __($value, "default"). '</option>';
                }
                    
                    echo '</select>',
                    '</p>';
                    break;
                
                
                default:
                    
                    break;
            }

        } 

    }


} // end widget class


?>