/**
 * AvertaScroll2top v1.0
 * A jQuery for scrolling page
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
   $('#container').avertaScroll2top({
        speed:200,                   // scroll duration in millisecond
        fadeDuration:400,            // btn fade duration in millisecond
        ease: 'linear',              // scroll easing
   });
 * 
 * ---------------------------------------------------------------------------------------------------------
 **/
if(typeof Object.create !== 'function' ){ Object.create = function (obj){ function F(){}; F.prototype = obj; return new F();} };

;(function($){
    
    var Scroll = {
        
        init : function(el, options){
            //cache this
            var self        = this;
            self.options    = $.extend({},$.fn.avertaScroll2top.defaultOptions, options || {});
            
            // Access to jQuery and DOM versions of element
            self.$el        = $(el);
            self.el         = el;
            
            self.setup();
        },
        
        setup: function(){
            var self = this;
            
            //hide btn on init
            if(window.scrollY < 100) { self.$el.fadeOut(0); }
            
            self.$el.on("click", function(){
                $('body,html').animate({scrollTop:0}, self.options.speed, self.options.ease);
                return false;
            });
            
            $(window).scroll(function(){
                if(this.scrollY > 100){
                    self.$el.fadeIn(self.options.fadeDuration);
                }else {
                    self.$el.fadeOut(self.options.fadeDuration);
                }
            });
        },
        
    };
    
    
    $.fn.avertaScroll2top = function(options){
        return this.each(function(){
            var scroll = Object.create(Scroll);
            scroll.init(this, options);
        });
    };
    
    $.fn.avertaScroll2top.defaultOptions = {
        speed:200,                   // scroll duration in millisecond
        fadeDuration:400,            // btn fade duration in millisecond
        ease: 'linear',              // scroll easing
    };
    
})(jQuery);