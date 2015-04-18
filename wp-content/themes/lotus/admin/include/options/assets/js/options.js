
/*=======================================================================================
 * 	On Document Ready
 *======================================================================================*/

jQuery(document).ready(function($) { 
	
	axiom_save_options();
	
	axiom_init_sidebar_manager();
	
	axiom_float_save_control();
	
});

function axiom_float_save_control(){
    var $ = jQuery.noConflict();
    $float_ctrls = $('div.av3_option_panel .op_float_save ');
    
    
    $(window).scroll(function(){ 
        if(this.scrollY > 170){
            $float_ctrls.addClass('ctr_floating');
        } else 
            $float_ctrls.removeClass('ctr_floating');
    });
}

////// save option panel //////////////////////////////////////////////

// adds click listener to save buttons, to save options via ajax
function axiom_save_options(){
	var $ = jQuery.noConflict();
	
	// get options form element
	$form = $('div.av3_option_panel form.axiom_options_form');
	if(!$form.length) return;
	
	
	// get and store SAVE buttons
	$save_btns = $form.find('.axiom_opt_panel_save_all_btn');
	
	// get and store RESET button
	$reset_btn = $form.find('.axiom_opt_panel_reset_all');
	
	// get and store I button
    $import_btn = $form.find('#axiom_import_options_btn');
    
    
	// add click listener to save buttons
	$save_btns.on('click', function(event){
		event.preventDefault();
		$this= $(this);
		
		// Show loading image
		$loading = $this.siblings('img');
		$loading.removeClass('ajax-loading');
		
		// get all serialized data on option page
		var formData    = $form.serializeArray();
		
		// remove export string from array options
		for(var i=0,j=formData.length; i<j; i++){
		  if(formData[i]["name"] == "axiom_export_options"){
		      formData.splice(i, 1);
		      break;
		  }
		};
		
		// get sortable section's data
		var sort_fields = axiom_get_sortable_data();
		// merge form and sortable datas
		var formData = formData.concat(sort_fields);
		
		// collect fields data in an object to post
		data = {
			nonce:   $form.data('nonce'),
			action:  'axiom_options',
			options: formData,
			type:   'save',
			sidebar: axiom_get_sidebars_name()
		}
		
		// send data to wp_ajax 
		axiom_send_panel_data_2wp(data, $loading);
			
	});
	
	
	// add click listener to reset buttons
	$reset_btn.on('click', function(event){
		event.preventDefault();
		$this= $(this);
		
		// Show loading image
		$loading = $this.siblings('img');
		$loading.removeClass('ajax-loading');
		
		// collect fields data in an object to post
		data = {
			nonce:   $form.data('nonce'),
			action:  'axiom_options',
			options: new Array(),
			type: 'reset'
		}
		
		// send data to wp_ajax 
		axiom_send_panel_data_2wp(data, $loading);
		
	});
	
	
	// add click listener to import button
    $import_btn.on('click', function(event){
        event.preventDefault();
        $this= $(this);
        
        // Show loading image
        $loading = $this.siblings('img');
        $loading.removeClass('ajax-loading');
        
        // get import data
        var importData    = $this.siblings('textarea').val();
        
        // collect fields data in an object to post
        data = {
            nonce:   $form.data('nonce'),
            action:  'axiom_import_ops',
            options: importData
        }
        
        // send data to wp_ajax 
        axiom_send_panel_data_2wp(data, $loading);
            
    });
}

// sends data to wp_ajax to save options in database
function axiom_send_panel_data_2wp( data_object, $loading) {
	
	jQuery.post(
		axiom.ajaxurl, 
		data_object  , 
		function(res){ 
		   	 // if data sent successfuly
		     if(res.success == true){
			   		noty({	"text": res.message,"layout":"center", "animateOpen" : {"height" :"toggle" , "opacity":"toggle"}, "animateClose": {"opacity":"toggle"},"closeButton":false, "closeOnSelfClick":true, "closeOnSelfOver":false,
							"speed":700,
							"timeout":2000,
							"type":"success"});
							
					// reload the page if options are reseted
                    if(res.type == "reset"){ window.location.reload(); }
					
			  }else{
				  	noty({	"text": res.message,"layout":"center", "animateOpen" : {"height" :"toggle" , "opacity":"toggle"}, "animateClose": {"opacity":"toggle"},"closeButton":false, "closeOnSelfClick":true, "closeOnSelfOver":false,
							"speed":700,
							"timeout":8000,
							"type":"error"});
			  }
			  
			  
			  
			  // hide loading image
			  $loading.addClass('ajax-loading');
			  return; 
		});
}

////// get sortable section's data /////////////////////////////////////////////////

function axiom_get_sortable_data(){
	var $ = jQuery.noConflict();
	
	// An Array that holds all sortable sections data
	var all_sort_sections = new Array();
	
	$('.draggable-area').each(function(index) {
		// An Object that holds one sortable section's data
		var sort_section = new Object();
		
		// cache this section
		$this = $(this);
		// get this section id
		_id = $this.attr("id");
		
		// get all sortable boxes in this section [sortable boxes in one section are connected with each other]
		$sortboxes = $this.find('.sortbox');
		
		// stores each box data
		var boxData   = new Object();
		// loop through all sortable boxes
		$sortboxes.each(function(index) {
			// An object to store sort items's data
			var itemsData = new Object();
			// cache sortbox
			$box   = $(this);
			$items = $box.find("> *");
			// get sortbox title
			var title = $box.prev('h4').text();
			// loops through all sortbox items and stores data 
			$items.each(function(index){ 
				var $this = $(this);
				itemsData[$(this).attr("id")] = $this.text();
			});
			
			boxData[title] = itemsData;
		});
		
		sort_section["name"]  = _id;
		sort_section["value"] = boxData;
		
		all_sort_sections.push(sort_section);
	});
	
	return all_sort_sections;
}

////// get sortable section's data /////////////////////////////////////////////////

function axiom_init_sidebar_manager(){
    var $ = jQuery.noConflict();
    
    // get options form element
    $form = $('div.av3_option_panel form.axiom_options_form');
    // get all add fields
    $form.find('fieldset.addField a.button').on('click', function(e){ e.preventDefault(); });
    
    
    // get sidebar manager section
    $sidebar_section = $form.find('#siderbar-manager-section');
    
    
    // get sidebars wrapper
    $sidebar_wrap = $sidebar_section.find('.panel_field ul.area');
    
    // get all available sidebars
    $sidebars     = $sidebar_wrap.children('li:not( .hidden )');
    
    // get name of all sidebars
    var names = axiom_get_sidebars_name();
    
    // on remove sidebar clicked
    $sidebar_wrap.find('.close').on('click', function(){
        $parent = $(this).parent();
        // remove from sidebar list
        names.splice(names.indexOf( $parent.data('name') ), 1);
        
        $parent.slideUp(300, function(){
            $parent.remove();
        });
    });
    
    
    
    // get "add new" field
    $addField = $sidebar_section.find('.addField');
    // on "add new" clicked
    $addField.children('a.button').on('click',function() {
        var $this = $(this);
        var $input= $this.siblings('input');
        var val   = $input.val();
        if(val != '' && val != ' '){
            
            if( !axiom_is_in_list(val, names) ){
                names.push(val);
                $input.val('');
                var bar   = $sidebar_wrap.children('.sidebartemp').clone(true);
                $bar      = $(bar).removeClass('sidebartemp hidden')
                                  .data('name', val)
                                  .children('span.label')
                                    .text(val).end()
                                  .appendTo($sidebar_wrap);
            }else{
                // sidebar name already exist.
                noty({  "text": 'sidebar name already exist.',"layout":"center", "animateOpen" : {"height" :"toggle" , "opacity":"toggle"}, "animateClose": {"opacity":"toggle"},"closeButton":false, "closeOnSelfClick":true, "closeOnSelfOver":false,
                        "speed":700,
                        "timeout":3000,
                        "type":"warn"});
            }
            
        }else{
            // invalid sidebar name
            noty({  "text": 'invalid sidebar name',"layout":"center", "animateOpen" : {"height" :"toggle" , "opacity":"toggle"}, "animateClose": {"opacity":"toggle"},"closeButton":false, "closeOnSelfClick":true, "closeOnSelfOver":false,
                    "speed":700,
                    "timeout":3000,
                    "type":"warn"});
        }
    });
    
    // on hit "enter" in input field
    $addField.children('input').on('keypress', function(e){
        if(e.keyCode == '13'){
            var $this = $(this);
            var $btn  = $this.siblings('a.button');
            $btn.trigger('click');
        }
    })
    
    
}

// checks whether a value is in list or not
function axiom_is_in_list(name, list){
    if(!name || !list)  return false;
    
    for(var i = 0, len = list.length; i < len ; ++i )
        if(list[i] == name)
            return true;
    
    return false;
}

// return names of registered sidebars in array
function axiom_get_sidebars_name(){
    // get all available sidebars
    $sidebars = jQuery('div.av3_option_panel form.axiom_options_form #siderbar-manager-section ul.area li:not( .hidden )');
    var names  = new Array();
    $sidebars.each(function(index) {
        names.push($sidebars.eq(index).data('name'));
    });
    return names;
}





