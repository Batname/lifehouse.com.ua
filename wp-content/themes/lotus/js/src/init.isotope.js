;(function($){
/*--------------------------------------------
 *  Isotope Filterable Widgets
 *--------------------------------------------*/
    
    function init_isotope_filter(widget, container, btns){
        
        var $btns      = $(btns);
        var $container = $(container);
        
        //get active filter
        var filterType = $btns.filter('.active').attr('data-filter');
        
        // provide selector
        var selector   = (filterType === 'all')?'' : '[data-filter="' + filterType + '"]';
        
        /* initialize isotope */
        $container.isotope({ 
            animationEngine : 'best-available',
            filter : selector
        });
        
        // filter items when filter link is clicked
        $btns.click(function(event) {
            var $this = $(this);
            event.preventDefault();
            
            // reset the active class on all the buttons
            $this.siblings().removeClass('active');
            $this.addClass('active');
            
            filterType = $this.data('filter');
            selector   = (filterType === 'all')? '': '[data-filter*="' + filterType + '"]';
            //console.log(selector);
            $container.isotope({ 
                filter :  selector ,
                animationEngine : 'best-available' ,
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false
                }
            });
        });
    }
    
    function init_filterable_sections(){
        
        for(var j=0,l = $widgets.length; j<l; ++j){
            var $widget    = $widgets.eq(j);
            var widget_selector = '#' + $widget.attr('id') + ' ';
            var container  = widget_selector + '.motion-wrapper';
            var btns       = widget_selector + '.filterable a';
            if(!$(btns).length) continue; 
            init_isotope_filter(widget_selector, container, btns);
        }
    }
    
    function update_filterable_sections(){
        
        for(var j=0,l = $widgets.length; j<l; ++j){
            var $widget    = $widgets.eq(j);
            var $btns      = $widget.find('.filterable a');
            if(!$btns.length) continue; 
            $btns.filter('.active').trigger("click");
        }
    }
    
    // get all portfolio and product widgets on page
    var $widgets = $('.widget-folio, .widget-product');
    
    // init isotope when widget images are loaded
    $widgets.imagesLoaded(init_filterable_sections);
    // update layout on page resize
    $(window).bind("debouncedresize", update_filterable_sections );
    
    
})(jQuery);


;(function($){
/*--------------------------------------------
 *  Isotope Masonry Widgets
 *--------------------------------------------*/
    
    function init_isotope_masonry_grid(container){
        
        var $container = $(container);
        
        /* initialize isotope */
        $container.isotope({ 
            animationEngine : 'best-available',
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false
            }
        });
        
    }
    
    function init_masonry_sections(){
        
        for(var j=0,l = $widgets.length; j<l; ++j){
            var $widget    = $widgets.eq(j);
            var widget_selector = '#' + $widget.attr('id') + ' ';
            var container  = widget_selector + '.motion-wrapper';
            
            var is_filterable       = widget_selector + '.filterable a';
            var is_slideable        = widget_selector + '.widget-nav';
            if( $(is_filterable).length || $(is_slideable).length) continue; 
            init_isotope_masonry_grid(container);
        }
    }
    
    // get all portfolio widgets 
    var $widgets = $('.widget-folio, .widget-gallery');
    
    // init isotope when widget images are loaded
    $widgets.imagesLoaded(init_masonry_sections);
    // update layout on page resize
    $(window).bind("debouncedresize", init_masonry_sections );
    
})(jQuery);