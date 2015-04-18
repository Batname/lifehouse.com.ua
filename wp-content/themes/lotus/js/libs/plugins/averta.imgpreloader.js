/**
 * AvertaImagePreloader v1.0
 * An jQuery plugin for preloading images
 * Copyright (c) averta | http://averta.net | 2011
 * licensed under the MIT license
 **/

if(typeof Object.create !== 'function' ){ Object.create = function (obj){ function F(){}; F.prototype = obj; return new F();} };

;(function($){
	
	var Images = {
		
        init : function(el, options){
        	//cache this
        	var self 		= this;
        	self.options 	= $.extend({},$.fn.avertaImagePreloader.defaultOptions, options || {});
        	
	        // Access to jQuery and DOM versions of element
	        self.$el 		= $(el);
	        self.el  		= el;
	        
	        self.$images  	= self.$el.find('img');
            
            //if(self.checkLoadedImgs())
            self.setup();
        },
        
        setup: function(){
        	var self = this;
        	//set container height equal to first child
        	self.$images.css({'visibility':'hidden', 'opacity':0})
        				.parents(self.options.preload_wrapper)
        					.addClass('preload');
        	self.startTimer();
        },
        
        startTimer:function(){
        	var self = this;
        	self.interval = window.setInterval(function(){
        		if(self.$images.length){
        			self.checkLoadedImgs();
        			console.log('1')
        		}else if(self.options.tryNums){
        			--self.options.tryNums;
        			self.checkLoadedImgs();
        			console.log('2')
        		}else{
        			self.stopTimer();
        			console.log('3')
        		}
        	}, 	400)
        },
        
        stopTimer:function(){
        	clearInterval(this.interval);
        },
        
        
		checkLoadedImgs: function(){
        	var self 	= this;
        	
        	self.$images.each(function(index) {
				if(this.complete){
					self.$images = self.$images.not(this);
					self.showImage(this, index);
				}
			});
			
        	return self.$images.length;
       },
        
        showImage:function(image, index){
        	var self 	= this;
        	var $image  = $(image);
        	$image.css({visibility:'visible'})
        		  .delay(index * self.options.delay)
        		  .animate({opacity:1}, self.options.fadeDuration, function(){
    				var $this = $(this);
    				$this.removeAttr('style')
    					 .parents(self.options.preload_wrapper)
    		     				.removeClass(self.options.preloadClass)
    		     				.addClass(self.options.loadedClass || '')
        		  });
        }
	};
	
	
	
	 $.fn.avertaImagePreloader = function(options){
        var images = Object.create(Images);
        images.init(this, options);
        return this;
    };
	
	$.fn.avertaImagePreloader.defaultOptions = {
        delay:200,
        fadeDuration: 300,
        preloadClass: "preload",
        loadedClass:  "loaded",
        preload_wrapper:".imgHolder",
        tryNums:5
    };
	
})(jQuery)

