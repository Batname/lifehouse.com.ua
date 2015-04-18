
;(function($){

/*--------------------------------------------
 *  Load high resolution images on retina screens
 *--------------------------------------------*/

   if( window.devicePixelRatio && window.devicePixelRatio == 2.0 ){
       
        var $retina_ready_imgs = $("img[data-image2x]");
        
        if(!$retina_ready_imgs.length) return;
        
        $retina_ready_imgs.each( function( index, element ){
            var $this = $(this);
            var image2x_src = $this.data("image2x");
            if(image2x_src) 
                $this.attr('src', image2x_src );
        });
   }
   
})(jQuery);