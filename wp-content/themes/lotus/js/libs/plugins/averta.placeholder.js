/**
 * AvertaPlaceholder v1.0
 * An jQuery polyfill that enables input placeholder
 * Copyright (c) averta | http://averta.net | 2011
 * licensed under the MIT license
 **/

if(typeof Object.create !== 'function' ){ Object.create = function (obj){ function F(){}; F.prototype = obj; return new F();} };
;(function($){
	
	var Placeholder = {
		
        init : function(el, options){
        	//cache this
        	var self 		= this;
        	self.options 	= $.extend({},$.fn.avertaPlaceholder.defaultOptions, options || {} );
        	
	        // Access to jQuery and DOM versions of element
	        self.$el 		= $(el);
	        self.el  		= el;
	        
            self.setup();
        },
        
        setup: function(){
        	var self = this;
        	
        	self.$el.focus(function() {
				var input = $(this);
			  	if (input.val() == input.attr('placeholder')) {
			    	input.val('');
			    	input.removeClass('placeholder');
			  	}
			}).blur(function() {
				var input = $(this);
				if (input.val() == '' || input.val() == input.attr('placeholder')) {
				    input.addClass('placeholder');
				    input.val(input.attr('placeholder'));
				}
			}).blur().parents('form').submit(function() {
				$(this).find('[placeholder]').each(function() {
					var input = $(this);
					if (input.val() == input.attr('placeholder')) {
						input.val('');
					}
				})
			});
        }
	};
	
	
	
	 $.fn.avertaPlaceholder = function(options){
        var placeholder = Object.create(Placeholder);
        placeholder.init(this, options);
        return this;
    };
	
	$.fn.avertaPlaceholder.defaultOptions = {
        
    };
	
})(jQuery);
