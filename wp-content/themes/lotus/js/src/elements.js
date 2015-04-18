;jQuery(function($){
    
    // messagebox script
    $('.msgbox').each(function(i){
        
        $(this).find("a.close").on("click", function(event){
            event.preventDefault();
            var $block = $(this).closest('.msgbox');
            
            $block.slideUp(300, function(){
                $block.remove();
            });
        });
    
    });
    
});


// position callout button in safari
;(function($) {
    if (!(navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1)) return;
    
    var $callout = $('div.callout');
    var $btn     = $callout.find('.featured_btn');
    var $label   = $btn.find('span');
    
    function updateCalloutBtnPosition(){
        var topPos   = ($btn.height() - $label.height()) * 0.5;
        $label.css('top', topPos);
    }
    updateCalloutBtnPosition();
    $(window).bind("resize", updateCalloutBtnPosition );
})(jQuery);



