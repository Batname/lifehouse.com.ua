
;(function($){
    
    // get all article type widgets and init carousel
    function init_article_carousels(){
        
        $.each($article_widgets, function(){
            $this = $(this);
            if($this.find('.widget-nav').hasClass('pagination'))
                init_article_carousel($this);
        });
    }
    
    
    function init_article_carousel($widget){
       
       var visible_items, min_num, availableW, itemW, $wrapper_width, screenWidth;
       
       screenWidth     = $(window).width();
       $widget_wrapper = $widget;
       $carou_wrapper  = $widget_wrapper.find(".motion-wrapper");
       
       $carou_wrapper.css("margin-left", 0).css("margin-right","-18px");
       $carou_items    = $carou_wrapper.children();
       
       $wrapper_width  = $widget_wrapper.width();
       
       if      ($carou_wrapper.hasClass("five-column") ){
           visible_items = 5;
       }else if($carou_wrapper.hasClass("four-column") ){
           visible_items = 4;
       }else if($carou_wrapper.hasClass("three-column")){
           visible_items = 3;
       }else if($carou_wrapper.hasClass("two-column")  ){
           visible_items = 2;
       }else if($carou_wrapper.hasClass("one-column")  ){
           visible_items = 1;
       }else{
           visible_items = 3;
       }
       
       if(screenWidth < 960){
           min_num = Math.floor($wrapper_width/ 310);
       }else{
           min_num = visible_items;
       }
       
       availableW = $wrapper_width - ((min_num - 1) * 18);
       itemW = Math.floor(availableW / min_num);
       
       $.each($carou_items, function(i){
           $this = $(this);
           $this.css("margin-right", "18px");
           $this.css("margin-left" , 0);
           $this.css("max-width"   , itemW);
       });
       
       var autoplay = ($carou_wrapper.closest(".widget-container").data("autoplay") == "yes");
       
       $carou_wrapper.carouFredSel({
            circular : autoplay,
            infinite : false,
            resonsive: true ,
            align    : "left",
            height   : "auto",
            items: {
                visible:visible_items
            },
            scroll: {
                items: 1,
                easing: "easeOutQuint"
            },
            auto: {  play  : autoplay,
                    duration : 1000, timeoutDuration:1700, pauseOnHover:true 
            },
            prev: {
                button: function() { 
                    return $(this).closest(".widget-container").find('.widget-title-bar .w_prev'); },
                easing: "easeOutCubic",
                items: 1,
                duration: 800
            },
            next: {
                button: function() { 
                    return $(this).closest(".widget-container").find('.widget-title-bar .w_next'); },
                easing: "easeOutCubic",
                items: 1,
                duration: 800
            },
            swipe: {
                items: 2,
                duration: 800,
                easing: "easeInOutCubic",
                onMouse: true,
                onTouch: true
            }
            
        });
        
        $widget_wrapper.find(".caroufredsel_wrapper").width("auto");
    }
    
    
    var $article_widgets = $(".widget-blog, .widget-news, .widget-product, .widget-folio, .widget-pages, .entry-related");
    
    // update widgets state on page resize
    $(window).on("debouncedresize", init_article_carousels);
    
    init_article_carousels();
    $article_widgets.imagesLoaded( init_article_carousels );
})(jQuery);






;(function($){
    
    function init__brand_slider() {
        $brand_slider.children('li').show();
        // init carousel for client/brand section
        $brand_slider.carouFredSel({
            
            circular    : true,
            infinite    : true,
            debug       : false,
    
            width: '100%',
            height: 'auto',
            //responsive:true,
            items: {
                visible:{
                            min: 1,
                            max: 8
                        }
            },
            scroll: { 
                easing: "quadratic",
                pauseOnHover: "resume",
                items: 1,
                duration: 500
            } ,
            swipe: {
                onMouse: true,
                onTouch: true,
                items: 4,
                duration: 500,
                easing: "easeInOutCubic"
            },
            auto: {  play  : ($(this).closest(".wrapper_brands").data("autoplay") == "yes"), 
                     duration : 800, timeoutDuration:1500, pauseOnHover:true },
            prev: {
                button: function() { return $(this).parent().siblings(".arr_small_prev"); }
            },
            next: {
                button: function() { return $(this).parent().siblings(".arr_small_next"); }
            }
        });
    
    };
    
    $brand_slider = $('.wrapper_brands > ul.carousel_list');
    $brand_slider.imagesLoaded(init__brand_slider);
    
    $(document).ready(function() {
        // init testimonial carousel
        $('div.testimonial_slider').carouFredSel({
    
            height: 'auto',
            padding:[0,0, 220,0],
            direction: 'up',
            align:false,
            
            debug:false,
            
            items: {
                visible:1,
                width:"100%",
                height:"variable"
            },
            scroll: { 
                easing: "quadratic",
                pauseOnHover: "resume",
                fx : 'crossfade'
            } ,
            swipe: {
                onMouse: true,
                onTouch: true
            },
            auto : {
                easing      : "quadratic",
                duration    : 1500,
                timeoutDuration: 6000,
                pauseOnHover: true
            },
            prev: {
                button: function() { 
                    var $this = $(this);
                    var isMax = $this.closest('.widget-testimonial').hasClass("max");
                    if(isMax){
                        return $(this).parent().siblings(".arr_small_prev"); 
                    }else{
                        return $(this).parent().siblings(".widget-title-bar").find('.w_prev'); 
                    }
                },
                easing      : "quadratic",
                duration    : 500,
                pauseOnHover: true
            },
            next: {
                button: function() { 
                    var $this = $(this);
                    var isMax = $this.closest('.widget-testimonial').hasClass("max");
                    if(isMax){
                        return $(this).parent().siblings(".arr_small_next"); 
                    }else{
                        return $(this).parent().siblings(".widget-title-bar").find('.w_next'); 
                    }
                },
                easing      : "quadratic",
                duration    : 500,
                pauseOnHover: true
            }
        });
        
        
    });
    
})(jQuery);
