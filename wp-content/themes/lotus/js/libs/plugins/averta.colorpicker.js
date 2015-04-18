/**
 * AvertaColorpicker v1.0
 * An jQuery polyfill for color input, based on "Color picker" plugin (Author: Stefan Petre www.eyecon.ro)
 * Copyright (c) averta | http://averta.net | 2011
 * licensed under the MIT license
 **/

if(typeof Object.create !== 'function' ){ Object.create = function (obj){ function F(){}; F.prototype = obj; return new F();} };
;(function($){
	
	var Colorpicker = {
		
        init : function(el, options){
        	//cache this
        	var self 		= this;
        	self.options 	= $.extend({},$.fn.avertaColorpicker.defaultOptions, options || {} );
        	
	        // Access to jQuery and DOM versions of element
	        self.$el 		= $(el);
	        self.el  		= el;
	        
            self.setup();
        },
        
        setup: function(){
        	var self = this;
        	
        	var $input = $('<input/>', {'id': self.$el.attr('id'), 'name': self.$el.attr('name'), 'class': self.$el.attr('class'),
											'type':'text','width':'55px', 'height':'25px' })
											.val(self.$el.val())
											.on('change', self.onColorpicker_update)
											.on('keyup' , self.onColorpicker_update);
			self.$el.replaceWith( $input );
			$input.wrap('<div class="colorpicker_section" />');
			var $parent = $input.parent();
			
			var $selector = $('<span/>', {'class':'colorSelector'});
			
			$selector.prependTo($parent)
					  			.css({ 'background-color': '#'+ $input.val() })
								.ColorPicker({
										onBeforeShow: function () {
											$(this).ColorPickerSetColor($input.val());
										},
										onSubmit: function(hsb, hex, rgb, el) {
											var $el = $(el);
											var $input = $el.siblings('input');
											$input.val(hex).change();
										}
								});
        },
        
        onColorpicker_update:function(){
			var $this   = $(this);
			var $picker = $this.siblings('span');
			if($picker.length){
				var hex = $this.val();
				
				if( hex.toString().indexOf('#') !== -1 ){
					hex = hex.toString().replace("#", "");
					$this.val(hex);
				}
				if( hex.toString().length < 6 )  return;
				$picker.css( 'background-color', '#' + $this.val() );
			}
        }
	};
	
	
	
	 $.fn.avertaColorpicker = function(options){
        return this.each(function(){
            var cp = Object.create(Colorpicker);
            cp.init(this, options);
        });
    };
	
	$.fn.avertaColorpicker.defaultOptions = {
        addSelector: 'true'
    };
	
})(jQuery);
