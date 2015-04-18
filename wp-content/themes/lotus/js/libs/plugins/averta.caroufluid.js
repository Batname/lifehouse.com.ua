/**
 * Caroufluid v1.0
 * A jQuery plugin for scrolling elements
 * Copyright (c) averta | http://averta.net | 2011
 * licensed under the MIT license
 **/

/**
 * USAGE : 
 * -----------------------------------------------------------------------------------------------------
 * HTML:
   <a id="scrollBtn"></a>
 * 
 * JS:
   $('#container').caroufluid({
        
   });
 * 
 * ---------------------------------------------------------------------------------------------------------
 **/
if(typeof Object.create !== 'function' ){ Object.create = function (obj){ function F(){}; F.prototype = obj; return new F();} };

;(function($){
    
    var Carousel = {
        
        init : function(el, options){
            //cache this
            var self        = this;
            self.options    = $.extend({}, $.fn.caroufluid.defaultOptions, options || {});
            
            // Access to jQuery and DOM versions of element
            self.$el        = $(el);
            self.el         = el;
            self.$items     = self.$el.children();
            self.containerOriginalWidth = self.$el.height();
            
            self.setup();
        },
        
        setup: function(){
            var self = this;
            
            self.updateContainerDimentions();
            
            var $wrapper = $('<div/>', {'class': 'caroufluid' });
            self.$el.wrap($wrapper);
            
        },
        
        updateContainerDimentions: function(){
            var self = this;
            self.$el.height(self.getContainerHeight());
            self.$el.width (self.getContainerWidth() );
        },
        
        // calculate and return container height
        getContainerHeight: function(){
            var self   = this;
            var height = 0;
            
            $.each(self.$items, function(i){
                $this = $(this);
                height = Math.max(height, $this.height());
            });
            
            return height; 
        },
        
        // calculate and return container height
        getContainerWidth: function(){
            var self   = this;
            var width  = 0;
            
            $.each(self.$items, function(i){
                width += $(this).outerWidth(true);
            });
            
            return width; 
        },
    };
    
    
    $.fn.caroufluid = function(options){
        return this.each(function(){
            var carousel = Object.create(Carousel);
            carousel.init(this, options);
        });
    };
    
    $.fn.caroufluid.defaultOptions = {
        speed:200,                   // scroll duration in millisecond
        height:"variable",
        items: {
            visible: 3,
            min:1, 
            max:3,
            marginRight:6
        }
    };
    
})(jQuery);