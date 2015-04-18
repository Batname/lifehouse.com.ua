;(function($){
    /*
    stored data template
    var sliderData = {  "type":"nivo",
                        "general":
                            {"width":"","height":"","spacing":0,"random":"no"},
                        "nivo":
                            {"expanded":true,"showArrows":"yes","autohide":"yes","controlType":"none",
                             "pauseOnHover":"yes","slideshow":"yes","tranSpeed":500,"showTime":4000,
                             "boxCols":8,"boxRows":4,"slices":15,"effect":"random"},
                        "flex":
                            {"expanded":true,"showArrows":"yes","autohide":"yes","controlType":"none",
                            "pauseOnHover":"yes","reverse":"no","loop":"yes","smoothHeight":"no","slideshow":"yes",
                            "tranSpeed":600,"showTime":6000,"effect":"fade","easing":"easeOutQuad"},
                        "slides":
                            [{"imageURL":"","caption":"","link":"","target":"blank","effect":"random",
                              "previewState":true}]};                 
    */
    
    /////////////////// data ///////////////////////
    
    var generalOptions, nivoOptions, flexOptions, sliderType, slidesData,
        generalModel, nivoModel, flexModel, SlidesModel;
    
    sliderType     = "none"; 
    slidesData     = [];
    
    generalOptions = { width:'', height:0, spacing:0, random:'no' };
    nivoOptions    = { showArrows:'yes', autohide:'yes', controlType:'none', pauseOnHover:'yes', slideshow:'yes',
                       tranSpeed:500, showTime:4000, boxCols:8, boxRows:4, slices:15, effect:'random' };
    flexOptions    = { showArrows:'yes', autohide:'yes', controlType:'none', pauseOnHover:'yes', reverse : 'no',loop:'yes', 
                       smoothHeight:'no', slideshow:'yes', tranSpeed:600, showTime:6000, effect:'fade', easing:'easeOutQuad' };
    
    try{
        if(sliderData && sliderData != ""){
            
            sliderType     = sliderData["type"];
            slidesData     = $.parseJSON( sliderData["slides"]);
            generalOptions = sliderData["general"];
            nivoOptions    = sliderData["nivo"];
            flexOptions    = sliderData["flex"];
        }
    }
    catch(e){}
    
    nivoModel      = new NivoSettingModel();
    flexModel      = new FlexSettingModel();
    generalModel   = new GeneralSettingModel();
    
    ////////////// Custome Binder /////////////////
    
    // updates model on soting elements
    ko.bindingHandlers.sortable = {
        init: function (element, valueAccessor) {
            // cached vars for sorting events
            var startIndex = -1,
                koArray = valueAccessor();
            
            var sortableSetup = {
                // cache the item index when the dragging starts
                start: function (event, ui) {
                    startIndex = ui.item.index();
                    
                    // set the height of the placeholder when sorting
                    ui.placeholder.height(ui.item.height());
                    ui.placeholder.width(ui.item.width());
                },
                // capture the item index at end of the dragging
                // then move the item
                stop: function (event, ui) {
                    
                    // get the new location item index
                    var newIndex = ui.item.index();
                    
                    if (startIndex > -1) {
                        //  get the item to be moved
                        var item = koArray()[startIndex];
                         
                        //  remove the item
                        koArray.remove(item);
                        
                        //  insert the item back in to the list
                        koArray.splice(newIndex, 0, item);
    
                        //  ko rebinds the array so remove duplicate ui item
                        ui.item.remove();
                    }
    
                },
                placeholder: "slide_placeholder",
                forcePlaceholderSize: true, 
                handle: '.dragHandle',
                revert: true
            };
            
            // bind
            $(element).sortable( sortableSetup );
        }
    };
    
    ///////////////// Model ///////////////////////
    
    function GeneralSettingModel(){
        var self        = this;
        self.expanded   = ko.observable(true);
        
        self.width      = ko.observable();
        self.height     = ko.observable();
        self.spacing    = ko.observable(0);
        self.random     = ko.observable('no');
        
        for(prop in generalOptions){
            self[prop]( generalOptions[prop] );
        }
        
        self.toggle     = function(item, event){
            self.expanded(!self.expanded());
            var $btn   = $(event.target);
            var expand = self.expanded();
            $btn.text(expand?'-':'+');
            $btn.siblings('ul.tabs').css({ visibility:(self.expanded()?'visible':'hidden') });
            $btn.closest('.sBlock').find('.tabs-content').slideToggle();
        }
    };
    
    function NivoSettingModel(){
        var self         = this;
        self.expanded    = ko.observable(true);
        
        self.showArrows  = ko.observable('');
        self.autohide    = ko.observable('');
        self.controlType = ko.observable('');
        self.pauseOnHover= ko.observable('');
        self.slideshow   = ko.observable('');
        
        self.tranSpeed   = ko.observable('');
        self.showTime    = ko.observable('');
        self.boxCols     = ko.observable('');
        self.boxRows     = ko.observable('');
        self.slices      = ko.observable('');
        self.effect      = ko.observable('');
        
        for(prop in nivoOptions){
            self[prop]( nivoOptions[prop] );
        }
        
        self.toggle      = function(item, event){
            self.expanded(!self.expanded());
            var $btn     = $(event.target);
            var expand   = self.expanded();
            $btn.text(expand?'-':'+');
            $btn.siblings('ul.tabs').css({ visibility:(self.expanded()?'visible':'hidden') });
            $btn.closest('.sBlock').find('.tabs-content').slideToggle();
        }
    };
    
    function FlexSettingModel(){
        var self         = this;
        self.expanded    = ko.observable(true);
        
        self.showArrows  = ko.observable('');
        self.autohide    = ko.observable('');
        self.controlType = ko.observable('');
        self.pauseOnHover= ko.observable('');
        self.reverse     = ko.observable('');
        self.loop        = ko.observable('');
        self.smoothHeight= ko.observable('');
        self.slideshow   = ko.observable('');
        
        self.tranSpeed   = ko.observable('');
        self.showTime    = ko.observable('');
        self.effect      = ko.observable('');
        self.easing      = ko.observable('');
        
        for(prop in flexOptions){
            self[prop]( flexOptions[prop] );
        }
        
        self.toggle      = function(item, event){
            self.expanded(!self.expanded());
            var $btn     = $(event.target);
            var expand   = self.expanded();
            $btn.text(expand?'-':'+');
            $btn.siblings('ul.tabs').css({ visibility:(self.expanded()?'visible':'hidden') });
            $btn.closest('.sBlock').find('.tabs-content').slideToggle();
        }
        
    };
    
    function slideModel(obj){
        var self         = this;
        
        self.imageURL    = ko.observable('');
        self.caption     = ko.observable('');
        self.link        = ko.observable('');
        self.target      = ko.observable('');
        self.effect      = ko.observable('random');
        
        self.remove      = function(){
            SliderViewModel.slides.remove(self);
        }
        
        self.uploadImage = function(){
            tb_show('', 'media-upload.php?&amp;type=image&amp;TB_iframe=true');
            window.send_to_editor = function(html) {
                 url = $(html).attr('href');
                 self.imageURL(url);
                 tb_remove();
            }
            return false;
        }
        
        self.previewState = ko.computed(function(){
            return !self.imageURL().length;
        }, SliderViewModel);
        
        for(prop in obj){
            if( prop != "previewState")
                self[prop]( obj[prop] );
        }
    }
    
    /////////////// View Model ////////////////////
    
    SliderViewModel =  { 
        self : this,
        
        general : ko.observable(generalModel),
        slider  : ko.observable(0),
        
        slides  : ko.observableArray([]),
        
        type    : ko.observable(sliderType)
    };
    
    // on slider type changed - return template name
    SliderViewModel.tempName = ko.computed(function(){
        this.slider(0);
        return 'temp_' + this.type();
    }, SliderViewModel);
    
    // on slider type changed - update slider viewModel
    SliderViewModel.modelName = ko.computed(function(){
        switch(this.type()){
            case 'nivo':
            this.slider(nivoModel);break;
            case 'flex':
            this.slider(flexModel);break;
        }
    }, SliderViewModel);
    
    // returns true if slider type is not none
    SliderViewModel.slidesVisibilty = ko.computed(function(){
        return (this.type() != 'none');
    }, SliderViewModel);
    
    // on slider setting template rendered - apply tooltip to setting block
    SliderViewModel.addTooltip = function(e){
        initTooltip($('div.sBlock .tabs-content em'));
    }
    // adds new slide
    SliderViewModel.addNewSlide = function(){
        SliderViewModel.slides.push(new slideModel());
    }
    // after new slide added- make new slide's tabs clickable'
    SliderViewModel.onNewSlideAdded = function(el){
        var $icons = $(el).find('.sBlock ul.tabs-content li')
                                .hide(0).first().show()
                                .end().end()
                                .find('em');
        initTooltip($icons);
    }
    // before slide removes, animate it
    SliderViewModel.onSlideRemove = function(elem){
        if (elem.nodeType === 1) {
            $elem = $(elem);
            $elem.slideUp(function() { $elem.remove(); });
        } 
    }
    
    
    ko.applyBindings(SliderViewModel);
    
    
    ////////////// functions //////////////////////
    
    var $tabContents = $('div.sBlock .tabs-content');
    // make first tabs-contents visible
    $tabContents.each(function(i, em){
        $(em).find('>li').hide(0).first().show();
    });
    
    // enable and make tabs clickable //
    $('div.sBlock .tabs li').removeClass('active')
                                  .first().addClass('active').end()
                                  .find('a')
                                  .live('click', function(event){
                                       event.preventDefault();
                                       var $this = $(this);
                                       var index = $this.parent().index();
                                       $this.parent().addClass('active').siblings('li').removeClass('active');
                                       $this.closest('.sBlock').find('.tabs-content > li').hide(0).eq(index).fadeIn(500);
                                  });
    
    // apply tooltip to help icons //
    function initTooltip($icons){
        // add tooltip on help icons
        $icons.tipsy({   
                        title: function() { return '<p style="font-size:11px;color:#555;">' + this.getAttribute('data-desc') + '</p>'; },
                        offset: 8,
                        html: true,
                        delayIn:100,
                        delayOut: 70,
                        fade:true
                    });
    }
    initTooltip($tabContents.find("em"));
    
    /// restore saved data /////////////////////////////////////
    
    function createSlidesModel(slides){
        var list = [];
        for(var i=0,len=slides.length;i<len;++i){
            list.push(new slideModel(slides[i]));
        }
        return list;
    }
    SlidesModel = createSlidesModel(slidesData);
    SliderViewModel.slides(SlidesModel);
    
    /// create storable data section //////////////////////////
    
    function getStorableData(){
        var db = {};
        db['type']      = SliderViewModel.type();
        db['general']   = getModelData(generalModel);
        db['nivo']      = getModelData(nivoModel);
        db['flex']      = getModelData(flexModel);
        db['slides']    = ko.toJSON(SliderViewModel.slides());
        return db;         
    }
    
    function getModelData(model){
        var obj = {};
        for(pro in model){
            if(pro != 'toggle')
                obj[pro] = model[pro]();
        }
        return obj;
    }
    
    //>>>>>>>>>>>>>>>>>>>>>> End of MVVM <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<//
    //>>>>>>>>>>>>>>>>>>>>>> Edit Page modification <<<<<<<<<<<<<<<<<<<<//
    
    /// select one column layout on page load ////////
    
    function axiom_lock_slider_screen_options(){
        // get screen optipn panel
        var $screen_settings = $('form#adv-settings');
        // select one column layout on page load
        setTimeout(function(){
            $screen_settings.find('.columns-prefs input[type="radio"]').eq(0).trigger('click');
        }, 100);
    }
    
    axiom_lock_slider_screen_options();
    
    /// remove premalink slug ////////////////////////
    
    $slug_box = $('#edit-slug-box');
    $slug_box.remove();
    
    /// send data via ajax on click save btn /////////
    
    $('#save_box.av3_container .save_slides').on('click', function(event){
        event.preventDefault();
        try{
            var data = {
                post_id: slider_id,
                nonce  : slider_nonce,
                action:  'slides_data',
                slider_data: getStorableData(),
                post_title : $('#titlediv #title').first().val()
            }
           }
        catch(err){ console.log("Post ID not found"); return; }
        console.log(data);
        
        var $savebox = $(this).closest('#save_box');
        $savebox.find('.ajax-loading')
            .css({ 'display':'inline','visibility':'visible'})
            .siblings("span").text("Saving Changes ..");
        
        $.post(
            axiom.ajaxurl, 
            data  , 
            function(res){ 
                console.log(res);
                // if data sent successfuly
                if(res.success == true){
                    $savebox.find('.ajax-loading').css({ 'display':'inline','visibility':'hidden'})
                        .siblings("span").text("Data Saved");;
                }else
                    console.log("Error From server");
            },
       "json");
    });
               
})(jQuery);


