/**
 * AvertaLiveTabs v1.0
 * An jQuery for enabling tabs
 * Copyright (c) averta | http://averta.net | 2011
 * licensed under the MIT license
 **/

/**
 * USAGE : 
 * -----------------------------------------------------------------------------------------------------
 * HTML:
   <div id="container">
  		<ul class="tabs">
   			<li class="active"><a href="#s1">Tab1</a></li>
   			<li><a href="#s2">Tab2</a></li>
   			<li><a href="#s3">Tab3</a></li>
   		</ul>
   
   		<ul class="tabs-content">
   			<li id="s1">Contnt1</li>
   			<li id="s2">Contnt2</li>
   			<li id="s3">Contnt3</li>
   		</ul> 	
   </div>
 * 
 * JS:
   $('#container').avertaLiveTabs({
  	 	tabs:	   		 'ul.tabs > li',		   	// Tabs selector
  	 	tabsActiveClass: 'active',         			// A Class that indicates active tab
  		contents: 		 'ul.tabs-content > li',  	// Tabs content selector	
  		contentsActiveClass: 'active',     			// A Class that indicates active tab-content	
  		transition: 	 'fade',				   	// Animation type white swiching tabs
  		duration : 		 '500'                   	// Animation duration in mili seconds
   });
 * 
 * ---------------------------------------------------------------------------------------------------------
 **/
if(typeof Object.create !== 'function' ){ Object.create = function (obj){ function F(){}; F.prototype = obj; return new F();} };

;(function($){
	
	var Container = {
		
        init : function(el, options){
        	//cache this
        	var self 		= this;
        	self.options 	= $.extend({} ,$.fn.avertaLiveTabs.defaultOptions, options || {} );
        	
	        // Access to jQuery and DOM versions of element
	        self.$el 		= $(el);
	        self.el  		= el;
	        
	        self.$tabs		= self.$el.find(self.options.tabs);
	        self.$contents	= self.$el.find(self.options.contents);
	        
            self.setup();
        },
        
        setup: function(){
        	var self = this;
        	self.$tabs.on('click', {self:self}, self.onTab_clicked);
        	var $active_content = (self.$tabs.filter('.active').length)?self.$tabs.filter('.active'):self.$tabs.first();
        	$active_content.trigger('click');
        },
        
        onTab_clicked:function(event){
        	event.preventDefault();
        	var self   = event.data.self;
			var $this  = $(this);
			
			self.$tabs.removeClass(self.options.tabsActiveClass);
			$this.addClass(self.options.tabsActiveClass);
			
			self.$contents.hide();
			self.$contents.eq($this.index()).fadeIn(self.options.duration);
        }
	};
	
	
	
	 $.fn.avertaLiveTabs = function(options){
        return this.each(function(){
            var container = Object.create(Container);
            container.init(this, options);
        });
    };
	
	$.fn.avertaLiveTabs.defaultOptions = {          
		tabs:	   		 'ul.tabs > li',		   	// Tabs selector
		tabsActiveClass: 'active',         			// A Class that indicates active tab
		contents: 		 'ul.tabs-content > li',  	// Tabs content selector	
		contentsActiveClass: 'active',     			// A Class that indicates active tab-content	
		transition: 	 'fade',				   	// Animation type white swiching tabs
		duration : 		 '500'                   	// Animation duration in mili seconds
    };
	
})(jQuery);
