<?php 
/**
 * Generates and outputs theme option panel
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */

global $axiom_options;
$axiom_sidebars =  get_option( THEME_ID.'_sidebars');
$fields_output  = "";

foreach($options as $option){
 
    /* Get the value of the field (nothing for types start and end). */
    if($option['type'] != 'start' && $option['type'] != 'end'){
 
        /* holds the value of option */
        $real_value = '';
 
        /* Get default value */
        $default_value = isset($option['std'])?$option['std']:"";
 
        /* Get the value if user has set it */
        $user_defined_value = (isset($option['id']) && isset($axiom_options[$option['id']]))?$axiom_options[$option['id']]:'';
 		
        $real_value = ($user_defined_value == '')?$default_value:$user_defined_value; 
		
		/* Field container start */
		$field_container_start = '<div class="panel_field">';
		
		/* Field wrapper start */
		$field_wrapper_start = '<div class="panel_elements">';
		
		/* Field wrapper start */
		$field_wrapper_end   = '</div>';
		
		/* Field container end */
		$field_container_end = '</div><!-- end-field -->';
    }
 
    /* Populate according to option type */
    switch ($option['type']) {
 
        /* start: starts a new section */
        case 'start':
 			
            $tab_id = str_replace(' ', '-', strtolower($option['id']));
 
            /* Add the new tab for this section */
            $tabs_output .= '<li><a href="'.$tab_id.'">'.$option['title'].'</a></li>';
 
            /* start the new section */
            $fields_output .= '<li id="'.$tab_id.'">';
 
        break;
		
		
        /* end: ends the current section */
        case 'end':
 
            /* end current section */
            $fields_output .= '</li><!-- end-section -->';
 
        break;
		
 
        /* text: Textfield */
        case 'text':
 
            /* Field container start */
            $fields_output .= $field_container_start;
 
                /* title */
                $fields_output .= '<label>'.$option['title'].'</label>';
				
				/* start field wrapper */
 				$fields_output .= $field_wrapper_start;
 				
					/* The Field */
	                $fields_output .= '<input type="text" class="white" name="'.$option['id'].'" id="'.$option['id'].'" value="'.$real_value.'" placeholder="'.$default_value.'" />';
					
	                /* Description */
	                if(isset($option['desc'])){ $fields_output .= '<p>'.$option['desc'].'</p>'; }       
	 			
				/* end field wrapper */
 				$fields_output .= $field_wrapper_end;
				
            /* Field container end */
            $fields_output .= $field_container_end;
 
        break;
		
		
		/* media upload */
        case 'upload':
 
            /* Field container start */
            $fields_output .= $field_container_start;
 
                /* title */
                $fields_output .= '<label>'.$option['title'].'</label>';
				
				/* start field wrapper */
 				$fields_output .= $field_wrapper_start;
				
					$fields_output .= '<fieldset class="uploader" >';
 				
						/* The Field */
		                $fields_output .= '<input type="text" name="'.$option['id'].'" id="'.$option['id'].'" value="'.$real_value.'" />';
						/* Upload btn */
						$fields_output .= '<input type="button" class="white" value="'.__("Upload", "default").'" />';
						/* Remove btn */
						$fields_output .= '<input type="button" class="white alert" value="'.__("Remove", "default").'" />';
						
						$fields_output .= '<div class="imgHolder"><strong title="'.__("Remove image", "default").'" class="close">X</strong>';
						
						$fields_output .= '<img alt src="" /></div>';
					
					$fields_output .= '</fieldset>';
					
	                /* Description */
	                if(isset($option['desc'])){ $fields_output .= '<p>'.$option['desc'].'</p>'; }       
	 			
				/* end field wrapper */
 				$fields_output .= $field_wrapper_end;
				
            /* Field container end */
            $fields_output .= $field_container_end;
 
        break;
		
 
        /* Textarea field */
        case 'textarea':
 
            /* Field container start */
            $fields_output .= $field_container_start;
 
                /* title */
                $fields_output .= '<label>'.$option['title'].'</label>';
				
				/* start field wrapper */
 				$fields_output .= $field_wrapper_start;
 				
					/* The Field */
	                $fields_output .= '<textarea name="'.$option['id'].'" id="'.$option['id'].'" placeholder="'.$default_value.'" >'.stripslashes($user_defined_value).'</textarea>';
					
	                /* Description */
	                if(isset($option['desc'])){ $fields_output .= '<p>'.$option['desc'].'</p>'; }       
	 			
				/* end field wrapper */
 				$fields_output .= $field_wrapper_end;
				
            /* Field container end */
            $fields_output .= $field_container_end;
 
        break;
        
        
        /* Textarea field */
        case 'import':
 
            /* Field container start */
            $fields_output .= $field_container_start;
 
                /* title */
                $fields_output .= '<label>'.$option['title'].'</label>';
                
                /* start field wrapper */
                $fields_output .= $field_wrapper_start;
                
                    /* The Field */
                    $fields_output .= '<textarea name="'.$option['id'].'" id="'.$option['id'].'" style="width:100%;" ></textarea>';
                    
                    /* Upload btn */
                    $fields_output .= '<input  id="'.$option['id'].'_btn" type="button" class="white" value="'.__("Import", "default").'" />';
                        
                    /* Description */
                    if(isset($option['desc'])){ $fields_output .= '<p>'.$option['desc'].'</p>'; }       
                
                /* end field wrapper */
                $fields_output .= $field_wrapper_end;
                
            /* Field container end */
            $fields_output .= $field_container_end;
 
        break;
		
        
        /* Textarea field */
        case 'export':
 
            /* Field container start */
            $fields_output .= $field_container_start;
 
                /* title */
                $fields_output .= '<label>'.$option['title'].'</label>';
                
                /* start field wrapper */
                $fields_output .= $field_wrapper_start;
                    
                    $th_options = get_option( THEME_ID.'_options');
                    $th_options = serialize($th_options);
                    $th_options = base64_encode($th_options);
                    /* The Field */
                    $fields_output .= '<textarea name="'.$option['id'].'" id="'.$option['id'].'" style="width:100%;" >'.$th_options.'</textarea>';
                    
                    /* Description */
                    if(isset($option['desc'])){ $fields_output .= '<p>'.$option['desc'].'</p>'; }       
                
                /* end field wrapper */
                $fields_output .= $field_wrapper_end;
                
            /* Field container end */
            $fields_output .= $field_container_end;
 
        break;
        
        
        /* Textarea field */
        case 'code':
 
            /* Field container start */
            $fields_output .= $field_container_start;
 
                /* title */
                $fields_output .= '<label>'.$option['title'].'</label>';
                
                /* start field wrapper */
                $fields_output .= $field_wrapper_start;
                
                    /* The Field */
                    $fields_output .= '<textarea style="width:85%;height:200px;" name="'.$option['id'].'" id="'.$option['id'].'" placeholder="'.$default_value.'" >'.stripslashes($user_defined_value).'</textarea>';
                    
                    /* Description */
                    if(isset($option['desc'])){ $fields_output .= '<p>'.$option['desc'].'</p>'; }       
                
                /* end field wrapper */
                $fields_output .= $field_wrapper_end;
                
            /* Field container end */
            $fields_output .= $field_container_end;
 
        break;
        
        
        /* Textarea field */
        case 'info':
 
            /* Field container start */
            $fields_output .= $field_container_start;
 
                /* Description */
                if(isset($option['desc'])){ $fields_output .= '<p>'.$option['desc'].'</p>'; }       
                
            /* Field container end */
            $fields_output .= $field_container_end;
 
        break;
        
 
        /* Select field */
        case 'select':
 
            /* Field container start */
            $fields_output .= $field_container_start;
 
                /* title */
                $fields_output .= '<label>'.$option['title'].'</label>';
				
				/* start field wrapper */
 				$fields_output .= $field_wrapper_start;
 				       
	                /* The Field */
	                $fields_output .= '<select name="'.$option['id'].'" id="'.$option['id'].'">';
	 
	                    foreach($option['opts'] as $key => $value){
	                    	
	                        /* Which options should be selected */
                        	$active_attr = ($key == $real_value)?'selected':'';
	 
	                        $fields_output .= '<option value="'.$key.'" '.$active_attr.'>'.$value.'</option>';
	                    }
	 
	                $fields_output .= '</select>';
					
					/* Description */
	                if(isset($option['desc'])){ $fields_output .= '<p>'.$option['desc'].'</p>'; }  
 
				/* end field wrapper */
 				$fields_output .= $field_wrapper_end;
				
            /* Field container end */
            $fields_output .= $field_container_end;
 
        break;
		
 
        /* radio field */
        case 'radio':
 
            /* Field container start */
            $fields_output .= $field_container_start;
 
                /* title */
                $fields_output .= '<label>'.$option['title'].'</label>';
				
				/* start field wrapper */
 				$fields_output .= $field_wrapper_start;
				
				$fields_output .= '<fieldset>';
 					
                    foreach($option['opts'] as $key => $value){
                    	
                        /* Which options should be selected */
                        $active_attr = ($value == $real_value)?'checked="checked"':'';
 
                        /* Field */
                		$fields_output .= '<label>'.$key.'<input type="radio" id="'.$option['id'].'" name="'.$option['id'].'" value="'.$value.'" '.$active_attr.' ></label>';
                    }
	 
	 			$fields_output .= '</fieldset>';
					
				/* Description */
	            if(isset($option['desc'])){ $fields_output .= '<p>'.$option['desc'].'</p>'; }  
 
            	/* end field wrapper */
 				$fields_output .= $field_wrapper_end;
				
            /* Field container end */
            $fields_output .= $field_container_end;
 
        break;
		
 
        /* checkbox field */
        case 'checkbox':
 
            /* Field container start */
            $fields_output .= $field_container_start;
 
                /* title */
                $fields_output .= '<label>'.$option['title'].'</label>';
				
				/* start field wrapper */
 				$fields_output .= $field_wrapper_start;      
 
 
	                /* is element selected or not */
                    $active_attr = ($user_defined_value == 'checked')?'value="checked" checked="checked"':'';
 
                	/* Field */
                	$fields_output .= '<label><input type="checkbox" id="'.$option['id'].'" name="'.$option['id'].'" '.$active_attr.' ></label>';
 					
					/* Description */
	            	if(isset($option['desc'])){ $fields_output .= '<p>'.$option['desc'].'</p>'; }  
				
            	/* end field wrapper */
 				$fields_output .= $field_wrapper_end;
				
            /* Field container end */
            $fields_output .= $field_container_end;
 
        break;
		
		
		/* colorpicker element */
        case 'colorpicker':
 
            /* Field container start */
            $fields_output .= $field_container_start;
 
                /* title */
                $fields_output .= '<label>'.$option['title'].'</label>';
				
				/* start field wrapper */
 				$fields_output .= $field_wrapper_start;
                    
                    $fields_output .= '<div class="mini-color-wrapper" >';
                	/* Field */
                	$fields_output .= '<input type="text" id="'.$option['id'].'" name="'.$option['id'].'" value="'.$real_value.'" >';
 					
 					$fields_output .= '</div>';
                    
					/* Description */
	            	if(isset($option['desc'])){ $fields_output .= '<p>'.$option['desc'].'</p>'; }  
				
            	/* end field wrapper */
 				$fields_output .= $field_wrapper_end;
				
            /* Field container end */
            $fields_output .= $field_container_end;
 
        break;
		
		
		/* range element */
        case 'range':
 
            /* Field container start */
            $fields_output .= $field_container_start;
 
                /* title */
                $fields_output .= '<label>'.$option['title'].'</label>';
				
				/* start field wrapper */
 				$fields_output .= $field_wrapper_start;
 
                	/* Field */
                	$fields_output .= '<input type="range" min="'.$option['opts']['min'].'" max="'.$option['opts']['max'].'" step="'.$option['opts']['step'].'" id="'.$option['id'].'" name="'.$option['id'].'" value="'.$real_value.'" >';
 					
					/* Description */
	            	if(isset($option['desc'])){ $fields_output .= '<p>'.$option['desc'].'</p>'; }  
				
            	/* end field wrapper */
 				$fields_output .= $field_wrapper_end;
				
            /* Field container end */
            $fields_output .= $field_container_end;
 
        break;
		
		
		/* sortable list */
        case 'sortable':
 
            /* Field container start */
            $fields_output .= $field_container_start;
 
                /* title */
                $fields_output .= '<label>'.$option['title'].'</label>';
				
				/* start field wrapper */
 				$fields_output .= $field_wrapper_start;
				
 				// get options from db if is defined
        		$real_value = ($user_defined_value == '')?$option['opts']:$user_defined_value; 
				
				$fields_output .= '<fieldset id="'.$option['id'].'" class="draggable-area">';
 
                    foreach($real_value as $key => $value){
                    		
						$fields_output .= '<div class="one_half">';
                    		$fields_output .= '<h4 class="area-title">'.$key.'</h4>';
							
							$fields_output .= '<ul class="sortbox area">';
 							
								foreach($value as $key => $val){
									
                					$fields_output .= '<li id="'.$key.'" class="rect">'.$val.'</li>';
								}
							
							$fields_output .= '</ul>';
						$fields_output .= '</div>';
						
                    }
	 
	 			$fields_output .= '</fieldset>';
					
				/* Description */
	            if(isset($option['desc'])){ $fields_output .= '<p>'.$option['desc'].'</p>'; }  
 
            	/* end field wrapper */
 				$fields_output .= $field_wrapper_end;
				
            /* Field container end */
            $fields_output .= $field_container_end;
 
        break;
		
		
		/* selector fields */
        case 'selector':
 
            /* Field container start */
            $fields_output .= $field_container_start;
 
                /* title */
                $fields_output .= '<label>'.$option['title'].'</label>';
				
				/* start field wrapper */
 				$fields_output .= $field_wrapper_start;
				
				$fields_output .= '<fieldset id="axiom_'.$option['id'].'" class="selection-list-wrap">';
 
                    foreach($option['opts'] as $id => $value){
                    	
						foreach($value as $title => $image_url){
							/* should this field be selected */
							$active_attr = (isset($axiom_options[$id]) && $axiom_options[$id] == "checked" )?'value="checked" checked="checked"':'';
 							$fields_output.= '<label for="'.$id.'" >'.$title.'<input type="checkbox" id="'.$id.'"  name="'.$id.'" data-src="'.$image_url.'"  '.$active_attr.' /></label>';
						}
				    }
	 
	 			$fields_output .= '</fieldset>';
					
				/* Description */
	            if(isset($option['desc'])){ $fields_output .= '<p>'.$option['desc'].'</p>'; }  
 
            	/* end field wrapper */
 				$fields_output .= $field_wrapper_end;
				
            /* Field container end */
            $fields_output .= $field_container_end;
 
        break;
        
        /* add field */
        case 'sidebar':
 
            /* Field container start */
            $fields_output .= $field_container_start;
 
                /* title */
                $fields_output .= '<label>'.$option['title'].'</label>';
                
                /* start field wrapper */
                $fields_output .= $field_wrapper_start;
                
                    $fields_output .= '<fieldset class="addField" >';
                
                        /* The Field */
                        $fields_output .= '<input type="text" name="'.$option['id'].'" id="'.$option['id'].'" value="'.$real_value.'" />';
                        /* Add btn */
                        $fields_output .= '<a href="" class="white button" >'.__("Create sidebar", "default").'</a>';
                    
                    $fields_output .= '</fieldset>';
                    
                    /* Description */
                    if(isset($option['desc'])){ $fields_output .= '<p>'.$option['desc'].'</p>'; }       
                
                /* end field wrapper */
                $fields_output .= $field_wrapper_end;
                
                
                $fields_output .= '<h4 class="area-title">Created Sidebars</h4>';
                            
                $fields_output .= '<ul class="area">';
                        
                        $fields_output .= '<li class="sidebar-rect sidebartemp hidden"   title="'.__("Remove sidebar", "default").'"><span class="label">'.$val.'</span><span class="close">x</span></li>';
                   
                   if(isset($axiom_sidebars)  && !empty($axiom_sidebars)){
                       foreach($axiom_sidebars as $key => $val){
                            $fields_output .= '<li data-name="'.$val.'" class="sidebar-rect" title="'.__("Remove sidebar", "default").'"><span class="label">'.$val.'</span><span class="close">x</span></li>';
                       }
                   }
                
                $fields_output .= '</ul>';
                
            /* Field container end */
            $fields_output .= $field_container_end;
            
 
        break;
        
        
        //If seprator
        case 'sep':
 
            /* Field container start */
            $fields_output .= $field_container_start;
                
                $desc = empty($option['desc'])?'':'<span>'.$option['desc'].'</span>';
                
                /* The Field */
                $fields_output .= '<div class="section-legend" ><p>'. $option['title']. '</p>' .$desc. '</div>';
                
            /* Field container end */
            $fields_output .= $field_container_end;
            
        break;
        
        
         /* add field */
        case 'add':
 
            /* Field container start */
            $fields_output .= $field_container_start;
 
                /* title */
                $fields_output .= '<label>'.$option['title'].'</label>';
                
                /* start field wrapper */
                $fields_output .= $field_wrapper_start;
                
                    $fields_output .= '<fieldset class="addField" >';
                
                        /* The Field */
                        $fields_output .= '<input type="text" name="'.$option['id'].'" id="'.$option['id'].'" value="'.$real_value.'" />';
                        /* Add btn */
                        $fields_output .= '<a href="" class="white button" >'.__("Create sidebar", "default").'</a>';
                    
                    $fields_output .= '</fieldset>';
                    
                    /* Description */
                    if(isset($option['desc'])){ $fields_output .= '<p>'.$option['desc'].'</p>'; }       
                
                /* end field wrapper */
                $fields_output .= $field_wrapper_end;
                
            /* Field container end */
            $fields_output .= $field_container_end;
            
        break;
        
        
        //typography option 
        case 'typography':
            //axi_get_google_font_names();
            /* Get default value */
            $typography_stored['size']   = isset($axiom_options[$option['id'].'[size]'])  ?$axiom_options[$option['id'].'[size]']  :(isset($option['std']['size']  )?$option['std']['size']  :"");
            $typography_stored['height'] = isset($axiom_options[$option['id'].'[height]'])?$axiom_options[$option['id'].'[height]']:(isset($option['std']['height'])?$option['std']['height']:"");
            $typography_stored['face']   = isset($axiom_options[$option['id'].'[face]'])  ?$axiom_options[$option['id'].'[face]']  :(isset($option['std']['face']  )?$option['std']['face']  :"");
            $typography_stored['style']  = isset($axiom_options[$option['id'].'[style]']) ?$axiom_options[$option['id'].'[style]'] :(isset($option['std']['style'] )?$option['std']['style'] :"");
            $typography_stored['color']  = isset($axiom_options[$option['id'].'[color]']) ?$axiom_options[$option['id'].'[color]'] :(isset($option['std']['color'] )?$option['std']['color'] :"");
            
            /* Field container start */
            $fields_output .= $field_container_start;
 
                /* title */
                $fields_output .= '<label>'.$option['title'].'</label>';
                
                /* start field wrapper */
                $fields_output .= $field_wrapper_start;
                    
                    /* Font Size */
                    if(isset($typography_stored['size']) && isset($option['std']['size']) ) {
                        $fields_output .= '<div class="typo_fields_wrapper" ><label>Font Size : </label><br/>';
                        $fields_output .= '<select style="width:85px;" name="'.$option['id'].'[size]" id="'. $option['id'].'_size">';
                        
                        for ($i = 9; $i < 35; $i++){ 
                            $val = $i.'px';
                            $active_attr = ($val == $typography_stored['size'])?'selected':'';
                            $fields_output .= '<option value="'.$val.'" '.$active_attr. '>'. $val .'</option>'; 
                        }
        
                        $fields_output .= '</select></div>';
                    }
                    
                    /* Line Height */
                    if(isset($typography_stored['height']) && isset($option['std']['height']) ) {
                        
                        $fields_output .= '<div class="typo_fields_wrapper" ><label>Line Height : </label><br/>';
                        $fields_output .= '<select  name="'.$option['id'].'[height]" id="'. $option['id'].'_height">';
                            for ($i = 20; $i < 38; $i++){ 
                                $val = $i;
                                $active_attr = ($val == $typography_stored['height'])?'selected':'';
                                $fields_output .= '<option value="'.$val.'" '.$active_attr. '>'. $val .'</option>'; 
                            }
        
                        $fields_output .= '</select></div>';
                    }
                    
                    /* Font Face */
                    if(isset($typography_stored['face']) && isset($option['std']['face']) ) {
                        
                        $fields_output .= '<div class="typo_fields_wrapper" ><label>Font Name : </label><br/>';
                        $fields_output .= '<select name="'.$option['id'].'[face]" id="'. $option['id'].'_face">';
                        
                        // --- system onts -----
                        $fields_output .= '<optgroup label="'.__("System Fonts", "default").'" >'; 
                        
                        $os_faces = array('arial'   =>'Arial',
                                        'verdana'   =>'Verdana',
                                        'trebuchet' =>'Trebuchet',
                                        'georgia'   =>'Georgia',
                                        'times'     =>'Times New Roman',
                                        'tahoma'    =>'Tahoma',
                                        'palatino'  =>'Palatino',
                                        'helvetica' =>'Helvetica' );    
                                             
                        foreach ($os_faces as $val => $face) {
                            $active_attr = ($val == $typography_stored['face'])?'selected':'';
                            $fields_output .= '<option value="'.$val.'" '.$active_attr. '>'. $face .'</option>'; 
                        }  
                        
                        $fields_output .= '</optgroup>';  
                        
                        // --- google fonts ----
                        $fields_output .= '<optgroup label="'.__("Google Fonts", "default").'" >'; 
                        
                        $go_faces = axi_get_google_font_names();   
                                             
                        foreach ($go_faces as $val => $face) {
                            $active_attr = ($val == $typography_stored['face'])?'selected':'';
                            $fields_output .= '<option value="'.$val.'" '.$active_attr. '>'. $val .'</option>'; 
                        }  
                        
                        $fields_output .= '</optgroup>';
        
                        $fields_output .= '</select></div>';
                    }
                    
                    
                    /* Font Weight */
                    if(isset($typography_stored['style']) && isset($option['std']['style']) ) {
                        
                        $fields_output .= '<div class="typo_fields_wrapper" ><label>Font Style : </label><br/>';
                        $fields_output .= '<select name="'.$option['id'].'[style]" id="'. $option['id'].'_style">';
                        $styles = array('normal'=>'Normal',
                                        'italic'=>'Italic',
                                        'bold'=>'Bold',
                                        'bold italic'=>'Bold Italic');
        
                        foreach ($styles as $i=>$style){
                            $val = $i;
                            $active_attr = ($val == $typography_stored['style'])?'selected':'';
                            $fields_output .= '<option value="'.$val.'" '.$active_attr. '>'. $val .'</option>';      
                        }
                        $fields_output .= '</select></div>';
                    }
                    
                    /* Font Color */
                    if(isset($typography_stored['color']) && isset($option['std']['color']) ) {
                        
                        $fields_output .= '<div class="mini-color-wrapper typo_fields_wrapper" ><label>Color : </label><br/>';
                        $fields_output .= '<input type="text" id="'.$option['id'].'_color" name="'.$option['id'].'[color]" value="'.$typography_stored['color'].'" >';
                        $fields_output .= '</div>';
                    }
                    
                    
                    /* Description */
                    if(isset($option['desc'])){ $fields_output .= '<p>'.$option['desc'].'</p>'; }       
                
                /* end field wrapper */
                $fields_output .= $field_wrapper_end;
                
            /* Field container end */
            $fields_output .= $field_container_end;
            
        break;
        
        
 
    }/* end switch */
 
}/* end foreach */
 
 
?>