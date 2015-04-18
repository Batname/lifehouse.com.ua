;(function($){
    
/*--------------------------------------------
 *   superfish menu init
 *--------------------------------------------*/
    
    function init_superfish(speed, delay, fade){
        
        var animEff = { opacity:'show', height:'show' };
        if(fade) animEff.opacity = 'show';
        
        $('ul.sf-menu').superfish({ 
            delay:       delay,    // one second delay on mouseout 
            animation:   animEff,  // fade-in and slide-down animation 
            speed:       speed,    // faster animation speed 
            autoArrows:  true,     // disable generation of arrow mark-up 
            dropShadows: false     // disable drop shadows 
        });
    }
    init_superfish('fast', 100, true);
    
})(jQuery);