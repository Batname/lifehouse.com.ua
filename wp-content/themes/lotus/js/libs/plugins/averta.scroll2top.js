/**
 * AvertaScroll2top v1.02
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
        offset:100,                  // the distance in pixel to autoFade the btn 
        autoFade:true,               // specify whether fade the element when scroll offset passed
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
            
            if(self.options.autoFade && (self.$el.data("autofade") != false) ) self.autofade();
            
            self.$el.on("click", function(){
                $('body,html').animate({scrollTop:0}, self.options.speed, self.options.ease);
                return false;
            });
            
            
        },
        
        autofade: function(){
            var self = this;
            
            //hide btn on init
            if(window.scrollY < self.options.offset) { self.$el.fadeOut(0); }
            
            $(window).scroll(function(){
                
                if ('pageXOffset' in window) {  // all browsers, except IE before version 9
                    var topOffset = window.pageYOffset;
                }
                else {      // Internet Explorer before version 9
                    var topOffset = document.documentElement.scrollTop ;
                }
                
                console.log(topOffset);
                if(topOffset > self.options.offset){
                    self.$el.fadeIn(self.options.fadeDuration);
                }else {
                    self.$el.fadeOut(self.options.fadeDuration);
                }
            });
        }
        
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
        offset:100,                  // the distance in pixel to autoFade the btn 
        autoFade:true                // specify whether fade the element when scroll offset passed
    };
    
})(jQuery);