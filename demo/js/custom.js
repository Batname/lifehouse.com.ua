/** TIMER PARAM
 *
 *  -----------------------------------------------------
 *  Format of date: MONTH DAY, YEAR HOURS:MINUTES:SECONDS 
 *  -----------------------------------------------------
 *	Warning! Month must be written in English.
 *
 */

// Don't forget to change the Date
var end = "June 01, 2013 00:00:00"; 

/** Localizations **/
var lang = {
	countdown: {
		days: 	 'Days',
		hours: 	 'Hours',
		minutes: 'Minutes',
		seconds: 'Seconds'	
	},
	comm: {
		press: 		 'Press Enter to subscribe',
		input_error: 'Enter the valid email',
		thanks: 	 'Thank you for your subscribe!'	
	} 
}

/** Hide Toolbar on iPhone **/
var ua = navigator.userAgent.toLowerCase();
if (ua.indexOf('iphone') != -1) {
	window.addEventListener('load', function(){
		setTimeout(scrollTo, 0, 0, 1);
	}, false);
}

var width;
$(function(){
	
	width = $(window).width();
	$(window).on('resize', function() { width = $(window).width() });

	/** Timer **/
	
	setTimeout(function(){
		$("#ct").countdown({
			until: new Date(end), 
			compact: true,
			onTick: updateTime
		});
	}, 100);
		
	/** Default language **/
	$('#notice').text(lang.comm['Нажмите']);
	$('#thanks').text(lang.comm['Спасибо']);
	
	/** Fix placeholder **/
	$('input[placeholder]').placeholder();
	
	/** Fix IE **/
	if($.browser.msie || $.browser.opera) {
		var ie_mt = width > 1024 ? 120 : 100;
		$('#countdown > div.n > span.lable').css({marginTop: ie_mt});
	}
	
	$('#countdown').find('.n').each(function(){
		$(this).find('.lable')
  		  .text(
			  lang.countdown[$(this).data('name')]
		  );
	}).find('span').eq(1).css('opacity', 0);
	
	/** Animtaion focus and blur **/
	$('#subscribe input').on({
		'focus': function() {
			$('#social')
				.animate({opacity: 0}, {duration: 250, queue: false})
				.animate({marginTop:-32}, {queue: false}, function() {
					$(this).hide()
				});
			
			$('#notice').show().animate({opacity:1});
		},
		'blur': function() {
			$('#social').show()
				.animate({opacity: 1}, {duration: 550, queue: false})
				.animate({marginTop:0}, {queue: false});
			$('#notice').animate({opacity:0}, function() { $(this).hide() });
		}
	});
	
	/** Check-up the e-mail **/
	var last_status = true;
	$('input[name=email]').on('keyup change', function(){
		var email = $('input[name=email]').val();
		var curr_status = (!isValidEmail(email) && email.length>0) ? false : true;
		
		$(this).data('valid', curr_status)
		
		if(last_status == curr_status) return false;
		
		if(curr_status == false) {
			last_status = false;
			$('#notice').animate({opacity:0}, 100, function() { 
				$(this).text(lang.comm['input_error'])
					.animate({opacity:1}, 100);
			});
		} else {
			last_status = true;
			$('#notice').animate({opacity:0}, 100, function() { 
				$(this).text(lang.comm['press'])
					.animate({opacity:1}, 100);
			});
		}
	});
	
	/** Sending email by AJAX **/
	$('#subscribe').submit(function(){

		var input = $('input[name=email]');
		if(!input.data('valid') || input.val().length == 0) {
			err(input);
			return false;
		}
				
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: $(this).serialize(),
			success: function(data) {
				if (data == 1) {
					input.animate({marginTop: -35}).off();
					
					$('#social').show().animate({marginTop:0, opacity: 1});
					$('#notice').animate({opacity:0}, function() { $(this).hide() });
				} else err(input);
			}
		});

		return false;
	});

});

/** Makes timer work **/
function updateTime(time) {
	var ar = [];
	$.each(time, function(k,v) {
		if(k < 3) return true;
		ar.push(v.toString());
	});
	
	var nar = [];
	$.each(ar, function(k,v) {
		switch(k) {
			case 0:
				switch (v.length) {
					case 0: v = '000'; break;								
					case 1: v = '00'+v; break;
					case 2: v = '0'+v; break;
				}
			break;
			default:
				switch (v.length) {
					case 0: v = '00'; break;								
					case 1: v = '0'+v; break;
				}
			break;
		}

		$.each(v, function(key,val) {
			nar.push(val);
		});
	});
	
	// Update time
	$('.n div').each(function(k){
		var obj = $(this).find('span');
				
		if(obj.eq(0).text() == nar[k]) return true;
		if(width <= 1024)
			obj.eq(0).text(nar[k]);
		else {
			/** Animate numbers **/
			var $span0 = obj.eq(0);
			var $span1 = obj.eq(1);
			
			$span0
				.css({position: 'absolute'})
				.animate({marginTop: 110, opacity: 0, borderSpacing: (getRandomInt(0, 1)) ? -getRandomInt(25,35) : getRandomInt(25,35)}, {
					step: function(now) {
						$(this).css({
							'-webkit-transform':'rotate('+now+'deg)',
							'-moz-transform':'rotate('+now+'deg)',
							'-ms-transform':'rotate('+now+'deg)',
							'-o-transform':'rotate('+now+'deg)',
							'transform':'rotate('+now+'deg)'
						});
					}
				});				
			
			$span1
				.text(nar[k])
				.css({marginTop: 0, opacity: 0})
				.animate({opacity: 1}, function(){
					$span0.text(nar[k]).removeAttr('style');
					$span1.removeAttr('style');
				});
		}
	});
}

function err(input) {
	input.stop(true,true).animate({opacity:0}, 300, function(){
		$(this).animate({opacity:1}, 300);
	});
}

function isValidEmail (email, strict) {
	if ( !strict ) email = email.replace(/^\s+|\s+$/g, '');
	return (/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i).test(email);
}

function getRandomInt(min, max) { return Math.floor(Math.random() * (max - min + 1)) + min }