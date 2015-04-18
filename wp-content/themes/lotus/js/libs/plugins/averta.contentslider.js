/**
 * AvertaContentSlider v1.1
 * An jQuery plugin for contents
 * Copyright (c) averta | http://averta.net
 * Dual licensed under the MIT and GPL licenses
 **/
;(function($){
	
	var Slider = {
		
        init : function(el, options){
        	//cache this
        	var self 		= this;
        	self.options 	= $.extend({},$.fn.avertaContentSlider.defaultOptions, options || {});
        	
	        // Access to jQuery and DOM versions of element
	        self.$el 		= $(el);
	        self.el  		= el;
	        
	        self.$tabs  	= self.$el.find(self.options.tabs);
	        //console.log(self.$tabs);
	        self.$cc		= self.$el.find(self.options.contentsContainer);
	        //console.log(self.$cc);
	        self.$contents  = self.$cc.find(self.options.contents);
	        //console.log(self.$contents);
            
            self.total		= self.$tabs.length;
            self.current 	= self.options.slideToStart;
            
            self.setup();
        },
        
        setup: function(){
        	var self = this;
        	//set container height equal to first child
        	self.$cc.height(self.$contents.first().height());
        	self.$cc.css({ overflow:'hidden' });
        	
        	self.$contents.each(function(index) {
				var $this = $(this).hide();
				$this.css( {position:'absolute', top:'0'} );
			});
			
			self.$tabs.each(function(index) {
				var $this = $(this);
				$this.attr('data-index',index);
			});
			
			self.$tabs.parent().delegate('li', 'click', function(e){
				e.preventDefault();
				var $this = $(this);
				self.goTo($this.data('index'));
			});
			
			if(self.options.slideshow === "true"){
				self.playTimer();
				
				if(self.options.pauseOnHover === "true"){
					self.$el.on('mouseenter', function(){
								self.pauseTimer();
							})
							.on('mouseleave', function(){
								self.playTimer();
							})
					};
			}
			
			self.slideContent();
        },
        
        playTimer:function(){
        	var self = this;
        	self.interval = window.setInterval(function(){
        		self.goTo(self.current + 1);
        	}, 	self.options.slideshowSpeed)
        },
        
        pauseTimer:function(){
        	clearInterval(this.interval);
        },
        
        goTo: function(index){
        	//remove active class from thumb nav
        	this.$tabs.eq(this.current).removeClass(this.options.tabActiveClass);
        	//hide current content
        	this.$contents.eq(this.current).fadeOut(this.options.animationDuration * .4);
        	//recalculate new active index
        	this.current = (index < 0)?this.total-1:index % this.total;
        	//slideIn new content
        	this.slideContent();
        },
        
		slideContent: function(){
        	var self 	= this;
        	var tab  	= self.$tabs.eq(self.current).addClass(self.options.tabActiveClass);
        	var content = self.$contents.eq(self.current).fadeIn(self.options.animationDuration * .6);
        }
	};
	
	
	
	 $.fn.avertaContentSlider = function(options){
        return this.each(function(){
            var slider = Object.create(Slider);
            slider.init(this, options);
        });
    };
	
	$.fn.avertaContentSlider.defaultOptions = {
        tabs: "ul:first-child li",
        tabActiveClass: "active-thumb",
        contentsContainer:".thumb-content-container",
        contents: ".thumb-content",
        animation: "fade",		
        slideDirection: "",
        slideshow: "true",
        slideshowSpeed:5000,	
        animationDuration: 800,
        randomize: "",
        slideToStart: 0,
        pauseOnHover: "true"
    };
	
})(jQuery)

