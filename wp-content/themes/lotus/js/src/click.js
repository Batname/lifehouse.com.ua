;(function($){
    
    $('.nav-toggle').unbind('click')
                    .bind('click', function(event){
        event.preventDefault();
        $(this).toggleClass('active');
        $('nav#access .sf-menu').animate({ height:'toggle' });
    });
    
})(jQuery);