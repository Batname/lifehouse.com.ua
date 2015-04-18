// toggle questions
jQuery(function($){
    $('.widget-toggle .widget-inner')
        .avertaAccordion({ 
            items:'section',
            itemHeader : '.toggle-header',
            itemContent: '.toggle-content',
            oneVisible:true, 
            showEase:'easeOutQuad',
            onCollapse : function($items){ $items.find('.toggle-header i').text('+'); } ,
            onExpand   : function($items){ $items.find('.toggle-header i').text('-'); }
    });    
});