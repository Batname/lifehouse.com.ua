// ---- product page ---------------------
// increase the min height for product info column if the info column was bigger than media
;(function($){
    var $singleProduct = $(".single-product");
    if(!$singleProduct.length) return;
    
    var infoHeight = $singleProduct.find(".single-info").height() + 110; // 100 is the height of product thumb carousel.
    if(infoHeight > 300)
        $singleProduct.find("#main .hentry .entry-content")
                            .css("min-height", infoHeight).end()
                      .find("#main .hentry .entry-wrapper")
                            .css("min-height", infoHeight);
    
})(jQuery);