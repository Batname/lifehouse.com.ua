/**
 * AvertaRangeControl v1.1.2
 * An jQuery polyfill for range input, based on jQuery UI
 * Depends : jQuery UI Slider
 * Copyright (c) averta | http://averta.net | 2011
 * licensed under the MIT license
 **/

/**
 * USAGE : 
 * -----------------------------------------------------------------------------------------------------
 * HTML:
 * <input type="range" max="100" min="0" step="1" value="50" name="elementName" id="elementName" />
 * 
 * JS:
 * $('[type="range"]').avertaRangeControl({
 *		value:50,				// Default value, if it is not set
 *		min:0,					// Default min attribute, if it is not set
 *		max:100,				// Default max attribute, if it is not set
 *		step:1,					// Default step attribute, if it is not set
 *		displayTextbox:'true',	// Display textbox or not. Default is "true"
 *		textboxWidth: 50		// A Number that indicates the textbox width in pixel. Default is 50
 * });
 * 
 * Output:
 * <div class="clearfix">
 * 		<input type="text" id="slider_width" name="slider_width" min="0" max="100" style="width: 50px; height: 26px; text-align: center; float: left;">
 * 		<div style="margin-top: 8px; margin-left: 60px;" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
 * 			<div class="ui-slider-range ui-widget-header ui-slider-range-min" style="width: 50%;"></div>
 * 			<a href="#" class="ui-slider-handle ui-state-default ui-corner-all" style="left: 50%;"></a>
 * 		</div>
 *</div>
 * ---------------------------------------------------------------------------------------------------------
 **/

if(typeof Object.create !== 'function' ){ Object.create = function (obj){ function F(){}; F.prototype = obj; return new F();} };
;(function($){
	
	var Range = {
		
        init : function(el, options){
        	//cache this
        	var self 		= this;
        	self.options 	= $.extend({},$.fn.avertaRangeControl.defaultOptions, options || {} );
        	
	        // Access to jQuery and DOM versions of element
	        self.$el 		= $(el);
	        self.el  		= el;
	        
            self.setup();
        },
        
        setup: function(){
        	var self    = this;
        	
        	// get values
        	var o_value = (self.el.value         )?( self.el.value      ):self.options.value;
			var o_min   = (self.$el.attr('min'  ))?self.$el.attr('min'  ):self.options.min  ;
			var o_max   = (self.$el.attr('max'  ))?self.$el.attr('max'  ):self.options.max  ;
			var o_step  = (self.$el.attr('step' ))?self.$el.attr('step' ):self.options.step ;
			
			var _name   = self.$el.attr('name');
			var _id     = self.$el.attr('id');
			
			// create container & textbox 
			var $container = $('<div/>').addClass('clearfix');
			var $textbox   = $('<input/>', { 'id':_id, 'name':_name, 'type':'text', 'class':self.$el.attr('class'), 
											 'min': self.$el.attr('min'), 'max':self.$el.attr('max'),'step':o_step })
											.css({ 
													'width':self.options.textboxWidth +'px', 'height': '26px', 
													'text-align':'center', 'float':'left'
											})
											.val(o_value)
											.on('keyup', self.onTextbox_change)
											.appendTo( $container );
			
			// create and replace range element with div
			var newElement = $('<div/>').val(o_value);
			self.$el.replaceWith( newElement );
			self.$el = newElement;
			
			// style elements if displayTextbox is true or false
			if(self.options.displayTextbox == 'true')
				self.$el.css({ 'margin-top': '8px', 'margin-left':(self.options.textboxWidth+10)+'px'});
			else
				$textbox.css({ 'display':'none' });
			
			// append slider element and container
			$container.prependTo(self.$el.parent()).append(self.$el);
			
			// Init Jquery UI Slider
			self.$el.slider({
				range: "min",
				value: ~~o_value,
				min:   ~~o_min,
				max:   ~~o_max,
				step:  ~~o_step,
				slide: function(event, ui){
					// get slider dom
					input = event.target.parentNode;
					
					// get previous element (input element)
				    do { input = input.previousSibling;
				    } while (input && input.nodeType != 1);
					
					// update input value
					if(input) input.value = ui.value;
				}
			});
			
			// set textbox value 
			self.onSlider_update(self.$el, self.$el.val());
        },
        
        // updates textbox value
        onSlider_update:function($slider, value){
			$slider.siblings('input').val(value); 
        },
        
        // validates textbox values
        onTextbox_change: function(event){
        	var $this   = $(event.currentTarget);
        	var $slider = $this.siblings('.ui-slider');
        	
        	var min = parseInt($this.attr('min'));
        	var max = parseInt($this.attr('max'));
        	var val = parseInt($this.val());
        	
        	if(val > max) val = max;
        	if(val < min || isNaN(val) ) val = min;
        	
        	$this.val(val);
        	$slider.slider( "option", "value", val );
        }
        
	};
	
	
	
	 $.fn.avertaRangeControl = function(options){
        return this.each(function(){
            var range = Object.create(Range);
            range.init(this, options);
        });
    };
	
	$.fn.avertaRangeControl.defaultOptions = {
        value:50,
        min:0,
        max:100,
        step:1,
        displayTextbox:'true',
        textboxWidth: 50
    };
	
})(jQuery);
