/*=======================================================================================
 * 	On Document Ready
 *======================================================================================*/

jQuery(document).ready(function($) { 
	
	// init slide blocks section
	axiom_init_slide_blocks();
	
	// init slider setting section
	axiom_init_slider_setting();
	
	axiom_lock_slider_screen_options();
	
});

/*=======================================================================================
 * 	Slide blocks
 *======================================================================================*/

function get_slider_setting(){
	var $ = jQuery.noConflict();
	
	var $content = $('.sliders-setting .tabs-content li');

	$inputs    = $content.find('input[type=checkbox],select,:text');

	var serial = $inputs.serialize({ checkboxesAsBools: true });
	return serial;
}

/* init slide blocks
----------------------*/

function axiom_init_slide_blocks(){
	var $ = jQuery.noConflict();
	
	// get slides container
	var $container   = $('.av3_container#slides_info');
	if( !$container.length) return;
	
	// get slides blocks
	var $slideBlocks = $container.find('div.slide-block');
	
	// make slides sortable
	$container.children('.block')
				.sortable( { handle: '.dragHandle',
							opacity: 0.5 ,
							items: '.slide-block',
							placeholder: 'placeHolder-highlight',
							forcePlaceholderSize: true
						});
						
/* save button
 * on save button clicked
----------------------*/

	$('#save_box.av3_container .save_slides').on('click', function(){
		data = {
			post_id: $container.data('post_id'),
			nonce:   $container.data('nonce'),
			action:  'slides_data',
			order:   get_slides_data(),
			setting: get_slider_setting(),
			post_title : $('#titlediv #title').first().val()
		}
		$(this)
			.closest('#save_box')
			.find('.ajax-loading').css({ 'display':'inline','visibility':'visible'});
		
		send_data_2wp(data);
	});

/* preview button
 * on preview button clicked
----------------------*/
	
	$slug_box = $('#edit-slug-box');
	$slug_box.remove();

/* update slide ids 
----------------------*/

	function update_current_slide_ids($target){
		$target.closest('.block').find('.slide-block').each(function(index) {
			$(this).attr('id', 'slideItem_' + index);
		});
	}
	
/* close btn
 * on slide close button clicked
----------------------*/

	$slideBlocks.find('.tab-bar .close').live('click',bind_close);
	// remove clicked slide
	function bind_close(){
		var $this = $(this);
		$this.closest('.slide-block').slideUp( 500, function(){
			$(this).remove();	
		});
	}

/* add new btn 
 * on add new button clicked
----------------------------*/	
	$container.find('.addnewslide').on('click', add_new_Slide );
	
	function add_new_Slide(){
	    // clone slide block
		var slide  = $slideBlocks.filter('.hidden').clone(true);
		var $slide = $(slide);
		$slide
			.removeClass('hidden')
			.appendTo($container.children('.block'))
				.find('.tabs-content .slideImageUrl')
					.blur( updatePreview );
					
		axiom_enable_tabs($slide);
	}
	
/* updates image preview on slide blocks
----------------------------------*/	
	function updatePreview(){
		var $this  = $(this);
		var holder = $this.closest('.slide-block').find('.slideImage .imgHolder');
		if($(holder).children('img').length > 0 && $this.val() != $this.attr('placeholder') ){
			var $img = $(holder).children('img');
			if($this.val() != $img.attr('src')){
				$img.attr('src', $this.val())
					.load(function() {
						$(this).removeClass('hidden')
							.parent().find('a').addClass('hidden');
					})
					.error(function() {
						$(this).addClass('hidden')
							.parent().find('a').removeClass('hidden');
					});
			}
		}
	}
	$imageURL = $slideBlocks.find('.tabs-content .slideImageUrl');
	$imageURL.blur( updatePreview );
	$imageURL.each(function(index) {
		updatePreview.call(this);
	});
	
/* bind media upload on click 
-----------------------------*/
	
	$slideBlocks.find('.slideImage .imgHolder a').live('click' ,function() {
		var urlField   = $(this).closest('.slide-block').find('.tabs-content .slideImageUrl');
		tb_show('', 'media-upload.php?&amp;type=image&amp;TB_iframe=true');
		
		window.send_to_editor = function(html) {
			 url = $(html).attr('href');
			 urlField.val(url).blur();
			 tb_remove();
		}
		return false;
	});

/* enable tabs
  ---------------------*/
    axiom_enable_tabs($slideBlocks);
}

/*=======================================================================================
 * 	Slider Setting blocks
 *======================================================================================*/

function axiom_init_slider_setting() { 
	var $ = jQuery.noConflict();
	// get slide setting blocks
	var $slideBlocks = $('.av3_container .sliders-setting .settingBlock');
	
/* expand btn 
 * on expand button clicked
  ---------------------*/

	function expand_setting_block(){
		var $this = $(this);
		$this.closest('.settingBlock')
				.find('.tabs-content')
					.slideToggle(100).end()
				.find('.tab-bar .tabs').toggle();
		$this.text( ($this.text() == '-')?'+':'-' );
	}
	

	$slideBlocks.find('.tab-bar .expand').on( 'click', expand_setting_block);
	
/* enable tabs
  ---------------------*/
	axiom_enable_tabs($slideBlocks);
}

/*=======================================================================================
 * 	Functions
 *======================================================================================*/

/// enable tabs ////////////////////////////////////////

function axiom_enable_tabs($wrapper){
	$wrapper.avertaLiveTabs({
        tabs:            'ul.tabs > li',            // Tabs selector
        tabsActiveClass: 'active',                  // A Class that indicates active tab
        contents:        'ul.tabs-content > li',    // Tabs content selector    
        contentsActiveClass: 'active',              // A Class that indicates active tab-content    
        transition:      'fade',                    // Animation type white swiching tabs
        duration :       '500'                      // Animation duration in mili seconds
    });
}

/// get user defined data ///////////////////////////

function getFieldValue($field){
	return $field.val() != $field.attr('placeholder')? $field.val(): "";
}

/// save edit page data via ajax ////////////////////

function send_data_2wp( data_object ) {		
	var $ = jQuery.noConflict();
	
	jQuery.post(
        axiom.ajaxurl, 
        data_object  , 
        function(res){ 
             // if data sent successfuly
             if(res.success == true){
                    noty({  "text": res.message,"layout":"center", "animateOpen" : {"height" :"toggle" , "opacity":"toggle"}, "animateClose": {"opacity":"toggle"},"closeButton":false, "closeOnSelfClick":true, "closeOnSelfOver":false,
                            "speed":700,
                            "timeout":3000,
                            "type":"success"});
                    $('#save_box.av3_container #update_status')
                            .removeClass('inuse')
                            .siblings('.ajax-loading')
                            .css('visibility','hidden');
              }else{
                    noty({  "text": res.message,"layout":"center", "animateOpen" : {"height" :"toggle" , "opacity":"toggle"}, "animateClose": {"opacity":"toggle"},"closeButton":false, "closeOnSelfClick":true, "closeOnSelfOver":false,
                            "speed":700,
                            "timeout":8000,
                            "type":"error"});
                            console.log("Error white saving data ..");
                            console.log(xhr.responseText);
                            console.log(e);
              }
              
              return; 
        });
}
/// serialize elements data /////////////////////////////

function get_slides_data(){
	var res = "";
	var $ = jQuery.noConflict();
	var $slides = $('.block .slide-block');
	
	for(var i = 0, j = $slides.length; i < j; i++){
		$this    = $slides.eq(i).find('.tabs-content');
		
		$imgURL  = $this.find('.slideImageUrl').first();
		imgURL   = getFieldValue($imgURL);
		
		$caption = $this.find('.htmlcontent').first();
		caption  = getFieldValue($caption);
		
		$link    = $this.find('.imageLink').first();
		link     = getFieldValue($link);
		
		$target  = $this.find('.imageLinkTarget').first();
		target   = $target.val();
		
		res += imgURL + "|^|" + caption + "|^|" + link + "|^|" + target;
		res += "|~^~|";
	};
	return res;
}


/// select one column layout on page load /////////////////////////////
function axiom_lock_slider_screen_options(){
    var $ = jQuery.noConflict();
    // check if this is slide manager page
    if( !$('div#slides_info').length)  return;
    // get screen optipn panel
    var $screen_settings = $('form#adv-settings');
    
    // select one column layout on page load
    setTimeout(function(){
        $screen_settings.find('.columns-prefs input[type="radio"]').eq(0).trigger('click');
    }, 100);
}
