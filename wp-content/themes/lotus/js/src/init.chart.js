/*--------------------------------------------
 *  Animate Progress chart
 *--------------------------------------------*/

jQuery(function($){

    $chart = $('.widget-chart');
    if(!$chart.length) return;
    
    $bars  = $chart.find('.chart-bar');
    
    $.each($bars, function(i){
        $this = $(this);
        $slider = $this.children('div');
        percent = parseInt($slider.find('em').text());
        
        $slider.width(0);
        $slider.delay(i * 150).animate(
            { 'width': (percent+"%") },
            { duration:2000,
              easing: 'easeOutQuad'
            }
        );
    });
    
});