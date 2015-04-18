
/*=======================================================================================
 * 	On Document Ready
 *======================================================================================*/

jQuery(document).ready(function($) { 
	
	init_plugins();
	
	// select default option, on select dom
	$('select.meta-select').each(function(index) { var $this = $(this); $this.val( $this.attr('data') ); });
	
	//tinyMCE.init({ autosave_ask_before_unload:false })
	
});



////// init plugins //////////////////////////////////////////////////

function init_plugins() { 
	var $ = jQuery.noConflict();
	
	dir = axiom.themeurl + '/admin/css/images/elements/empty.png';
	$('.av3_container input[type="checkbox"]:not([safari][data-src])').checkbox({ empty: dir});
	
	jQuery('.mini-color-wrapper input[type="text"]').miniColors();
	jQuery('[type="range"]').avertaRangeControl();
	jQuery('input, textarea' ).placeholder();
	jQuery('.selection-list-wrap').avertaPrettySelector({ multiSelection:'false'});
	jQuery('.av3_option_panel').avertaLiveTabs();
	
	$('.sortbox').sortable({
		connectWith:'.draggable-area ul',
		helper:'clone',
		placeholder:'sort-item-heighlight',
		opacity:1,
		revert: true
	});
};


    





