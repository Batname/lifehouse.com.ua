/**
 * AvertaPrettySelector v1.0.2
 * An jQuery for making elements selectable
 * Copyright (c) averta | http://averta.net | 2011
 * licensed under the MIT license
 **/

/**
 * USAGE : 
 * -----------------------------------------------------------------------------------------------------
 * HTML:
 * <fieldset id="options">
 *		<label for="one" >option1<input type="checkbox" id="one" name="one" data-src="ui1.jpg"/></label>
 *		<label for="two" >option2<input type="checkbox" id="two" name="two" data-src="ui2.jpg"/></label>
 * </fieldset>
 * 
 * JS:
 * $('#options').avertaPrettySelector({
 *		multiSelection:   'true',           // Enables multi item selection. Default is true 
 *		itemsWrapper:     'ul',             // A dom that will be generated and wraps all elements wrappers.Default is 'ul'
 *		itemsWrapperClass:'selection-list', // The css class that adds to items wrapper
 *		itemWrapper:      'li',             // A dom that will be generated , and waps each input element.Default is 'li'
 *		itemWrapperClass: '' 				// The css class that adds to each item wrapper
 * });
 * 
 * Output:
 * <fieldset id="options">
 * 		<ul class="selection-list">
 * 			<li class="selected" >
 * 				<input type="checkbox" id="one" name="one" style="display: none;" checked="checked">
 * 				<img alt="option1" title="option1" src="ui1.jpg">
 * 			</li>
 * 			<li>
 * 				<input type="checkbox" id="two" name="two" style="display: none;">
 * 				<img alt="option2" title="option2" src="ui2.jpg">
 * 			</li>
 * 		</ul>
 * </fieldset>
 * ---------------------------------------------------------------------------------------------------------
 **/

if(typeof Object.create !== 'function' ){ Object.create = function (obj){ function F(){}; F.prototype = obj; return new F();} };
;(function($){
	
	var SelectionList = {
		
        init : function(el, options){
        	//cache this
        	var self 		= this;
        	self.options 	= $.extend({},$.fn.avertaPrettySelector.defaultOptions, options || {} );
        	
	        // Access to jQuery and DOM versions of element
	        self.$el 		= $(el);
	        self.el  		= el;
	        
            self.setup();
        },
        
        setup: function(){
        	var self = this;
        	var $itemsWrapper, $itemWrapper;
        	
        	self.$inputs  = self.$el.find('input[type="checkbox"]');
        	
        	// create Items wrapper
        	$itemsWrapper = $('<' + self.options.itemsWrapper + ' />', { 'class': self.options.itemsWrapperClass });
        	
        	//loop trough checkboxes
        	self.$inputs.each(function(index) {
				var $this   = $(this); 
				var $label , $image, src;
				
				// get input label
				if($this.parent().get(0).tagName     === 'LABEL'){
					$label = $this.parent();
				}else if($this.next().get(0).tagName === 'LABEL'){
					$label = $this.next();
				}else if($this.prev().get(0).tagName === 'LABEL'){
					$label = $this.prev();
				}else{ console.log('FROM prettySelector PLUGIN : No Label element found.'); }
				
				//create new input
				var $input = $('<input/>', {'id': $this.attr('id'), 'class': $this.attr('class'),
											'type':'checkbox','name': $this.attr('name') })
											.css('display','none').addClass('pretty-selector');						
				
				//create a wrapper for input element, and append to it
				$itemWrapper = $('<' + self.options.itemWrapper + ' />', 
											{ 'class': self.options.itemWrapperClass })
											.append($input)
											.css('cursor','pointer')
											.on('click', {'self':self}, self.onItem_clicked);
											
				//create custom image
				if($this.data('src') && $this.data('src') !== '' ){
					$image = $('<img />' , { 'alt':$label.text() || '','title':$label.text() || '', 
											 'src':  $this.data('src') }).appendTo($itemWrapper);
				}
				
				//specify selected item
				if($this.is(':checked'))  { $input.attr('checked', 'checked').val("checked"); $itemWrapper.addClass("selected");}
				
				$itemWrapper.appendTo($itemsWrapper);
			});
			
			self.$el.empty().append($itemsWrapper);
        	
        },
        
        onItem_clicked:function(event){
        	var self = event.data.self;
			var $el    = $(this);
			var $input = $el.find('input');
			
			if(self.options.multiSelection == 'false'){
				//single selection
				var $els = $el.siblings();
				$els.removeClass('selected');
				$el.addClass('selected');
				
				$els.find('input[type="checkbox"]').removeAttr('checked').val('');
				$input.attr('checked', 'checked').val('checked');
			}else{
				//multi selection
				if($input.is(':checked')){
					$input.removeAttr('checked').val('');
					$el.removeClass('selected');
				}else{
					$input.attr('checked', 'checked').val('checked');
					$el.addClass('selected');
				}
			}
        }
	};
	
	
	
	 $.fn.avertaPrettySelector = function(options){
        return this.each(function(){
            var sl = Object.create(SelectionList);
            sl.init(this, options);
        });
    };
	
	$.fn.avertaPrettySelector.defaultOptions = {
        multiSelection:   'true',           // Enables multi item selection. Default is true 
		itemsWrapper:     'ul',             // A dom that will be generated and wraps all elements wrappers.Default is 'ul'
		itemsWrapperClass:'selection-list', // The css class that adds to items wrapper
		itemWrapper:      'li',             // A dom that will be generated , and waps each input element.Default is 'li'
		itemWrapperClass: '' 				// The css class that adds to each item wrapper
    };
	
})(jQuery);