/*--------------------------------------------------------------------------------------------------
 *	Option panel Image Uploads
 *-------------------------------------------------------------------------------------------------*/
jQuery(document).ready(function($) {
	 axiom_init_optionpanel_uploaders($, $('.av3_container .uploader'));
});

function axiom_init_optionpanel_uploaders($, $container){
	$container.each(function(index) {
		
		////////////// get elements ////////////////////////////////////////
		// cache wrapper
		var $this = $(this);
		
		var $input  = $this.find('input[type="text"]').eq(0);
		var $upload = $this.find('input[type="button"]').eq(0);
		var $remove = $this.find('input[type="button"]').eq(1);
		
		var $imgHolder = $this.find('div.imgHolder').addClass('hidden');
		var $close  = $this.find('strong.close').addClass('hidden');
		
		////////////// handlers ////////////////////////////////////////////
		
		// on click image close button
		$close.on('click', function(){
			var $this = $(this);
			var $img  = $this.next('img');
			$img.hide();
			$this.addClass('hidden');
			$imgHolder.addClass('hidden');
			$input.val('');
		});
		
		// on click remove button
		$remove.on('click', function(){
		    $input.val('');
			$close.trigger('click');
		});
		
		// on input value change
		$input.on('keyup change blur', function(e){
			if(e.type == 'click' && e.ctrlKey){
			    $upload.trigger('click');
			}else{
				updateImage($(e.target));
			}
		});
		
		// on upload btn click
		$upload.on( 'click', function() {
			var $this  = $(this);
			// get input field
			var $input = $this.siblings('input[type="text"]');
			
			// on image uploaded file sent from thickbox
			// "html" is the uploaded image tag from thickbox
			window.send_to_editor = function(html) {
				 // get uploaded image src
				 imgurl = $(html).attr('src');
				 $input.val(imgurl).trigger('change');
				 tb_remove();
			}
			// open media uploader
			 tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
			 return false;
		});
		
		updateImage($input);
	});
	
	////////////// functions /////////////////////////////////////////////
	
	// updates image preview , if link is changed
	function updateImage($input){
		var $holder = $input.siblings('.imgHolder');
		var $close  = $holder.children('.close');
		var $img    = $close.next('img')
							.load(function(e) {
								$holder.removeClass('hidden');
								$close.removeClass('hidden' );
								$img.show();
							}).error(function(e) {
								$holder.addClass('hidden');
								$close.addClass('hidden' );
								$img.hide();
							});
		
		$img.attr('src', $input.val());
	}
	
}
 