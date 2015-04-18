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

 *  Contact info widget

 * --------------------------------------------*/



class ContactInfoWidget extends Axiom_Widget {

    

    public $fields = array(
                            array(
                                'name'    => 'Title',
                                'id'      => 'title',
                                'type'    => 'textbox',
                                'value'   => ''
                            ),
                            array(
                                'name'    => 'Address',
                                'id'      => 'address',
                                'type'    => 'textbox',
                                'value'   => ''
                            ),
                            array(
                                'name'    => 'City',
                                'id'      => 'city',
                                'type'    => 'textbox',
                                'value'   => ''
                            ),
                            array(
                                'name'    => 'Country',
                                'id'      => 'country',
                                'type'    => 'textbox',
                                'value'   => ''
                            ),
                            array(
                                'name'    => 'Phone Number',
                                'id'      => 'phone1',
                                'type'    => 'textbox',
                                'value'   => ''
                            ),
                            array(
                                'name'    => 'Phone Number',
                                'id'      => 'phone2',
                                'type'    => 'textbox',
                                'value'   => ''
                            ),
                            array(
                                'name'    => 'Fax',
                                'id'      => 'fax',
                                'type'    => 'textbox',
                                'value'   => ''
                            ),
                            array(
                                'name'    => 'Email',
                                'id'      => 'email1',
                                'type'    => 'textbox',
                                'value'   => ''
                            ),
                            array(
                                'name'    => 'Email',
                                'id'      => 'email2',
                                'type'    => 'textbox',
                                'value'   => ''
                            ),
                            array(
                                'name'    => 'Support',
                                'id'      => 'support1',
                                'type'    => 'textbox',
                                'value'   => ''
                            ),
                            array(
                                'name'    => 'Support',
                                'id'      => 'support2',
                                'type'    => 'textbox',
                                'value'   => ''
                            ),
                            array(
                                'name'    => 'Map Link',
                                'id'      => 'maplink',
                                'type'    => 'textbox',
                                'value'   => ''
                            ),
                            array(
                                'name'    => '"Link to map" Label',
                                'id'      => 'maptext',
                                'type'    => 'textbox',
                                'value'   => ''
                            )
                            
                            ); 
                            
    private $icons = array(          
                            'address' => 'icon-home'        ,
                            'city'    => 'icon-road'        ,
                            'country' => 'icon-globe'       ,
                            'phone1'  => 'icon-phone'       ,
                            'phone2'  => 'icon-phone'       ,
                            'fax'     => 'icon-phone-sign'  ,
                            'email1'  => 'icon-envelope'    ,
                            'email2'  => 'icon-envelope-alt',
                            'support1'=> 'icon-comment'     ,
                            'support2'=> 'icon-comments'    ,
                            'maplink' => 'icon-map-marker'  ,
                            'maptext' => 'Link to Map Text'
                            ); 
    

    /** constructor */

    function __construct() {
        
        parent::__construct();
        
        parent::WP_Widget( "contact_info" , $name = '[axiom] Contact Info' /* Name */     , 

                           array( 'description' => 'Your Contact informations' ) );

    }



    // outputs the content of the widget

    function widget( $args, $instance ) {

        extract( $args );

        
        
        $title = apply_filters( 'widget_title', $instance['title'] );
        echo    $before_widget;
        if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }
        
        
        echo    '<ul class="contact-detail" >';
        
        foreach ($this->fields as $value):
            
            $key = $value["id"];
            
            if ( $key != "title" && $key != "maptext" && !empty( $instance[$key] ) ) {

                echo '<li>';
                
                if($key != "maplink"){
                    //echo '<h4>'.$value.'</h4>';
                    echo '<span><i class="'.$this->icons[$key].'"></i>'.$instance[$key].'</span>';
                }else{
                    $map = empty( $instance['maptext'])?$value:$instance['maptext'];
                    echo '<span><i class="'.$this->icons[$key].'"></i><a href="',$instance[$key],'" style="text-decoration:underline;" >'.$map.'</a></span>';
                }
                
            }
        endforeach;
        
        echo    '</ul>',$after_widget;
    }


} // end widget class



// register Widget

add_action( 'widgets_init', create_function( '', 'register_widget("ContactInfoWidget");' ) );

?>