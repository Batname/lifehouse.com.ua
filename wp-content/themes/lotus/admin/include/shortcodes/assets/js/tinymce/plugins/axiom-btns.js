// axiom shortcode buttons
;(function() {

        tinymce.create('tinymce.plugins.axiom', {
                /* This call is done before the editor instance has finished it's initialization */
                init : function(ed, url) {

                        // Register axiom shortcode buttons
                        ed.addButton('quote', {
                                title : 'Add a Blockquote', 
                                onclick : function() {  
                                     ed.selection.setContent('[blockquote indent="yes" ]' + ed.selection.getContent() + '[/blockquote]');  
                                } 
                        });
                        
                        ed.addButton('dropcap', {
                                title : 'Dropcap',  
                                onclick : function() {  
                                     ed.selection.setContent('[dropcap type="square" round="yes" color="#f5f5f5" background_color="#4583b3" ]' + ed.selection.getContent() + '[/dropcap]');  
                                } 
                        });
                        
                        ed.addButton('button', {
                                title : 'Insert Button',  
                                onclick : function() {  
                                     ed.selection.setContent('[button link="#" round="yes" size="normal" color="white" flat="no" ]BUTTON LABEL[/button]');  
                                } 
                        });
                        
                        ed.addButton('column', {
                                title : 'Insert Column',  
                                onclick : function() {  
                                     ed.selection.setContent('[col size="1/2" ]COLUMN 1 CONTENT[/col][col size="1/2" ]COLUMN 2 CONTENT[/col]');  
                                } 
                        });
                        
                        ed.addButton('divider', {
                                title : 'Divider',  
                                onclick : function() {  
                                     ed.selection.setContent('[divider style="dotted" height="40px" ]');  
                                } 
                        });
                        
                        ed.addButton('highlight', {
                                title : 'Highlight',  
                                onclick : function() {  
                                     ed.selection.setContent('[highlight style="yellow" ]' + ed.selection.getContent() + '[/highlight]');
                                } 
                        });
                        
                        ed.addButton('msgbox', {
                                title : 'Message Box',  
                                onclick : function() {  
                                     ed.selection.setContent('[msgbox type="notice" show_icon="yes" ]' + ed.selection.getContent() + '[/msgbox]');
                                } 
                        });
                        
                        ed.addButton('tabs', {
                                title : 'Insert Tab',  
                                onclick : function() {  
                                     ed.selection.setContent('[tabs ][tab_element title="TAB 1 TITLE"]TAB 1 CONTENT[/tab_element][tab_element title="TAB 2 TITLE"]TAB 2 CONTENT[/tab_element][/tabs]');  
                                } 
                        });
                        
                        ed.addButton('testimonial', {
                                title : 'Testimonial',  
                                onclick : function() {  
                                     ed.selection.setContent('[testimonial author="AUTHOR NAME" avatar="AUTHOR IMAGE" role="CEO" link="#" ]' + ed.selection.getContent() + '[/testimonial]');
                                } 
                        });
                        
                        ed.addButton('vimeo', {
                                title : 'Vimeo',  
                                onclick : function() {  
                                     ed.selection.setContent('[vimeo url="VIMEO LINK" width="500" height="200" full="no"  ]');
                                } 
                        });
                        
                        ed.addButton('utube', {
                                title : 'Youtube',  
                                onclick : function() {  
                                     ed.selection.setContent('[youtube url="VIMEO LINK" width="500" height="200" full="no"  ]');
                                } 
                        });
                        
                        ed.addButton('video', {
                                title : 'Self Hosted Video',  
                                onclick : function() {  
                                     ed.selection.setContent('[video mp4="MP4 VIDEO LINK" webm="WEBM VIDEO LINK" width="500" height="200" full="no" skin="dark"  ]');
                                } 
                        });
                },

                createControl : function(n, cm) {
                        return null;
                },


                getInfo : function() {
                        return {
                                longname  : 'Axiom plugin',
                                author    : 'averta',
                                authorurl : 'http://averta.net',
                                infourl   : 'http://averta.net',
                                version   :  tinymce.majorVersion + "." + tinymce.minorVersion
                        };
                }
        });

        // Register plugin
        tinymce.PluginManager.add('axiom', tinymce.plugins.axiom);  
})();
