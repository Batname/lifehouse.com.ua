;(function($){

/*--------------------------------------------
 *  prettyPhoto init
 *--------------------------------------------*/
    
    var viewportWidth = $('body').innerWidth();
    
    $("a[rel^='prettyPhoto'], a[data-rel^='prettyPhoto']").prettyPhoto({
        hook: 'data-rel',
        counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
        theme: 'light_square', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
        horizontal_padding: 0, /* The padding on each side of the picture */ 
        autoplay: true, /* Automatically start videos: True/False */
        
        markup: '<div class="pp_pic_holder"> \
                    <div class="pp_content_container"> \
                        <div class="pp_left"> \
                        <div class="pp_right"> \
                            <div class="pp_content"> \
                                <a class="pp_close" href="#">Close</a> \
                                <div class="pp_loaderIcon"></div> \
                                <div class="pp_fade"> \
                                    <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
                                    <div class="pp_hoverContainer"> \
                                        <a class="pp_next" href="#">next</a> \
                                        <a class="pp_previous" href="#">previous</a> \
                                    </div> \
                                    <div id="pp_full_res"></div> \
                                    <div class="pp_details"> \
                                        <div class="pp_nav"> \
                                            <a href="#" class="pp_arrow_previous">Previous</a> \
                                            <a href="#" class="pp_arrow_next">Next</a> \
                                        </div> \
                                        <div class="ppt">&nbsp;</div> \
                                        <p class="pp_description"></p> \
                                        <div class="pp_social">{pp_social}</div> \
                                    </div> \
                                </div> \
                            </div> \
                        </div> \
                        </div> \
                    </div> \
                </div> \
                <div class="pp_overlay"></div>',
        gallery_markup: '<div class="pp_gallery"> \
                            <a href="#" class="pp_arrow_previous">Previous</a> \
                            <div> \
                                <ul> \
                                    {gallery} \
                                </ul> \
                            </div> \
                            <a href="#" class="pp_arrow_next">Next</a> \
                        </div>',
        image_markup: '<img id="fullResImage" src="{path}" />',
        flash_markup: '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="{width}" height="{height}"><param name="wmode" value="{wmode}" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{path}" /><embed src="{path}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="{width}" height="{height}" wmode="{wmode}"></embed></object>',
        quicktime_markup: '<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" height="{height}" width="{width}"><param name="src" value="{path}"><param name="autoplay" value="{autoplay}"><param name="type" value="video/quicktime"><embed src="{path}" height="{height}" width="{width}" autoplay="{autoplay}" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/"></embed></object>',
        iframe_markup: '<iframe src ="{path}" width="{width}" height="{height}" frameborder="no"></iframe>',
        inline_markup: '<div class="pp_inline">{content}</div>',
        custom_markup: '',
        social_tools: '<ul class="socials"><li><a href="http://www.facebook.com/plugins/like.php?locale=en_US&href='+ location.href +'" class="icon-facebook-sign"></a></li><li><a href="http://twitter.com/share" class="icon-twitter"></a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></li></ul>',
        changepicturecallback: function(){
                                    if (viewportWidth < 1000) {
                                        $(".pp_pic_holder.pp_default").css("top",window.pageYOffset+"px");
                                    }
                                }
    });
    
})(jQuery);