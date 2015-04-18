   
/*--------------------------------------------
 *  on resize
 *--------------------------------------------*/

;(function($){
      
    backupStyles();
    resizeSections();
    
    $(window).bind("debouncedresize", resizeSections );
    
})(jQuery);

/*--------------------------------------------*/


function resizeSections(){
    $ = jQuery.noConflict();
    
    var imgRatio = 1.65;
    
    var screenWidth = $(window).width();
    
    if( screenWidth < 650 ) {
        // change blog land mode to portrait
        $('.widget-blog .land').each( function(index){
            $(this).removeClass("land");
        });
        
    } else {
        // rollback to blog land mode
        $('.widget-blog [data-class*="land"]').each( function(index){
            var $this = $(this).addClass("land");
        });
    }
    
    if( screenWidth < 768 ) { 
        // add mob class to widget title bar if filter nav exist
        $('.widget-nav.filterable').closest('.widget-title-bar').addClass('mob');
    } else {
        // remove mob class from widget title bar
        $('.widget-title-bar.mob').removeClass('mob');
    }
    
    
    if( screenWidth < 960 ) {
        // change blog land mode to portrait (sidebar)
        $('#main.land').each( function(index){
            $(this).removeClass("land");
        });
        
    } else {
        // rollback to blog land mode
        $('#main[data-class*="land"]').each( function(index){
            $(this).addClass("land");
        });
    }
    
    /*
    $(".g1 .col.height2, .g1 .col .height2").each(function(index){
        var $this = $(this);
        $this.height( 2 + Math.floor(($this.width() / imgRatio) * 2) );
    });
    
    //$(".g1 .col.height1, .g1 .col .height1").each(function(index){
    $(".col.height1, .col .height1").each(function(index){
        var $this = $(this);
        $this.height( Math.floor($this.width() / imgRatio) );
    });
    */  
}


function backupStyles() {
    $ = jQuery.noConflict();
    
    $('.land').each( function(index){
        var $this = $(this);
        $this.attr( "data-class" ,$this.attr("class"));
    });
}

