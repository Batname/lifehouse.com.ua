;(function($){

/*--------------------------------------------
 *  Init Flexslider
 *--------------------------------------------*/
    function init_flexslider($holder){
        
        var navfor     = $holder.data("navfor")     || "";
        var sync       = $holder.data("sync")       || "";
        
        var itemwidth  = $holder.data("itemwidth")  || "";
        var itemmargin = $holder.data("itemmargin") || "";
        
        var min        = $holder.data("minitems")   || "";
        var max        = $holder.data("maxitems")   || "";
        
        console.log(navfor, sync, itemwidth, itemmargin, min, max);
        
        $holder.flexslider({
            selector: ".slides > li",       //{NEW} Selector: Must match a simple pattern. '{container} > {slide}' -- Ignore pattern at your own peril
            animation: "fade",              //String: Select your animation type, "fade" or "slide"
            easing: "swing",                //{NEW} String: Determines the easing method used in jQuery transitions. jQuery easing plugin is supported!
            animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
            smoothHeight: false,            //{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode
            startAt: 0,                     //Integer: The slide that the slider should start on. Array notation (0 = first slide)
            slideshow: true,                //Boolean: Animate slider automatically
            slideshowSpeed: 4000,          //Integer: Set the speed of the slideshow cycling, in milliseconds
            animationSpeed: 500,          //Integer: Set the speed of animations, in milliseconds
             
            // Usability features
            pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
            pauseOnHover: true,           //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
            useCSS: true,                   //{NEW} Boolean: Slider will use CSS3 transitions if available
            touch: true,                    //{NEW} Boolean: Allow touch swipe navigation of the slider on touch-enabled devices
            video: false,                   //{NEW} Boolean: If using video in the slider, will prevent CSS3 3D Transforms to avoid graphical glitches
             
            // Primary Controls
            controlNav: false,              //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
            directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
            prevText: "Previous",           //String: Set the text for the "previous" directionNav item
            nextText: "Next",               //String: Set the text for the "next" directionNav item
             
            // Secondary Navigation
            keyboard: true,                 //Boolean: Allow slider navigating via keyboard left/right keys
            multipleKeyboard: false,        //{NEW} Boolean: Allow keyboard navigation to affect multiple sliders. Default behavior cuts out keyboard navigation with more than one slider present.
            mousewheel: false,              //{UPDATED} Boolean: Requires jquery.mousewheel.js (https://github.com/brandonaaron/jquery-mousewheel) - Allows slider navigating via mousewheel
            pausePlay: false,               //Boolean: Create pause/play dynamic element
            pauseText: 'Pause',             //String: Set the text for the "pause" pausePlay item
            playText: 'Play',               //String: Set the text for the "play" pausePlay item
             
            // Special properties
            controlsContainer: "",          //{UPDATED} Selector: USE CLASS SELECTOR. Declare which container the navigation elements should be appended too. Default container is the FlexSlider element. Example use would be ".flexslider-container". Property is ignored if given element is not found.
            manualControls: "",             //Selector: Declare custom control navigation. Examples would be ".flex-control-nav li" or "#tabs-nav li img", etc. The number of elements in your controlNav should match the number of slides/tabs.
            sync: sync,                     //{NEW} Selector: Mirror the actions performed on this slider with another slider. Use with care.
            asNavFor: navfor,               //{NEW} Selector: Internal property exposed for turning the slider into a thumbnail navigation for another slider
             
            // Carousel Options
            itemWidth: itemwidth,           //{NEW} Integer: Box-model width of individual carousel items, including horizontal borders and padding.
            itemMargin: itemmargin,         //{NEW} Integer: Margin between carousel items.
            minItems: min,                  //{NEW} Integer: Minimum number of carousel items that should be visible. Items will resize fluidly when below this.
            maxItems: max,                  //{NEW} Integer: Maxmimum number of carousel items that should be visible. Items will resize fluidly when above this limit.
            move: 0                         //{NEW} Integer: Number of carousel items that should move on animation. If 0, slider will move all visible items.
        });
    }
    
    function init_flexsliders(){
        
        $containers = $('.flex-container');
        $containers.each(function(index){
            var $this = $(this).children('.flexslider');
            
            init_flexslider($this);
        });
    }
    
    //init_flexsliders();
    
    //init_flexslider($("#single-product-carousel"));
    //init_flexslider($("#single-product-slider"));
    
    $('#single-product-carousel').flexslider({
        animation: "slide",
        controlNav: false,
        directionNav: false, 
        animationLoop: false,
        slideshow: false,
        itemWidth: 60,
        minItems:5,
        maxItems:5,
        itemMargin: 2,
        asNavFor: '#single-product-slider'
      }).flexsliderManualDirectionControls({
          previousElementSelector: ".w_prev",
          nextElementSelector: ".w_next",
          disabledStateClassName: "disabled"
      });
       
      $('#single-product-slider').flexslider({
        animation: "fade",
        controlNav: false,
        directionNav: false, 
        animationLoop: true,
        slideshow: false,
        sync: "#single-product-carousel"
      }).flexsliderManualDirectionControls({
          previousElementSelector: ".w_prev",
          nextElementSelector: ".w_next",
          disabledStateClassName: "disabled"
      });
      
      
      $('#top-slider').flexslider({
        animation: "fade",
        controlNav: true,
        directionNav: false, 
        animationLoop: false,
        slideshow: true
      }).flexsliderManualDirectionControls({
          previousElementSelector: ".w_prev",
          nextElementSelector: ".w_next",
          disabledStateClassName: "disabled"
      });
      
      
      $('#top-slider').flexslider({
        
      });
      
})(jQuery);