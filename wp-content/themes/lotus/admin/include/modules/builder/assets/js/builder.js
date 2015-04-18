/**
 * Page Builder v1.0.2
 * Author : averta | http://averta.net | 2012
 **/

/*----------------------------------------------------
 *  Page Builder
 *--------------------------------------------------*/
    
  ////////////////////
 // builder toolbar //////////////////////////
////////////////////

;(function($, win) { 
    var $builder = $('#axiom_builder');
    var $toolbar = $builder.find('.pb_toolbar');
    
    // add tooltip on toolbar buttons
    $toolbar.find(".cmd.button").tipsy({   
                                    title: function() { return '<p style="font-size:12px;">' + this.getAttribute('data-title') + '</p><p style="color:#808080;">' + this.getAttribute('data-desc') + '</p>'; },
                                    offset: 8,
                                    html: true,
                                    delayIn:100,
                                    delayOut: 70,
                                    fade:true
                                });
    // decorate toolbar checkbox          
    $toolbar.find('.ios_style').iphoneStyle({   
                                    checkedLabel: '', 
                                    uncheckedLabel: '',
                                    handleMargin: 34,
                                    handleRadius: 5,
                                    containerRadius: 5,
                                    resizeHandle: false,
                                    resizeContainer: true,
                                    onChange: function(elem, value) { showExtraBtns(value, $(elem) ) },
                                });
                                
    function onToolbarResized($toolbar){
        var _w       = $toolbar.width();
        var $logo    = $toolbar.find('.pb-logo');
        var $switch  = $toolbar.find('.switcher');
        var $btns    = $toolbar.find('.cmd-btns');
        
        if(_w > 1130) {     // all btns are visible
            $logo.show();
            $switch.hide();
            $btns.show();
        }else if(_w > 810) {// checkbox in toolbar
            $logo.show();
            $switch.show().removeClass('hangup');
            $btns.show().eq(1).hide();
        }else if(_w > 610) {// checkbox on second row
            $logo.show();
            $switch.show().addClass('hangup');
            $btns.show().eq(1).hide();
        }else{ // hide logo
            $logo.hide();
            $switch.show().addClass('hangup');
            $btns.show().eq(1).hide();
        }
    }
    
    function showExtraBtns(val, $elem){
        $btns = $elem.parents(".switcher").siblings(".cmd-btns");
        if(val)
            $btns.show().eq(0).hide();
        else
            $btns.show().eq(1).hide();
    }
    
    $(window).on('resize', function(){ onToolbarResized($toolbar); });
    onToolbarResized($toolbar);
    
})(jQuery);


;(function($){
    //>>>>>>>>>> builder workspace <<<<<<<<<<<<<<<<<
    
     /////////////////
    // Buider Data //////////////////////////
    ////////////////
    
    // elements options
    
    var blocksDictionary =  
    { 
        slider      : { name: "slider"      , sizes:[25, 50, 75, 100]             },
        column      : { name: "column"      , sizes:[25, 33, 50, 66, 75, 100] },
        callout     : { name: "callout"     , sizes:[50, 100]             },
        toggle      : { name: "toggle"      , sizes:[25, 33, 50, 66, 75, 100] },
        listitem    : { name: "listitem"    , sizes:[25, 33, 50, 66, 75, 100] },
        gallery     : { name: "gallery"     , sizes:[25, 33, 50, 66, 75, 100] },
        image       : { name: "image"       , sizes:[25, 33, 50, 66, 75, 100] },
        video       : { name: "video"       , sizes:[25, 33, 50, 66, 75, 100] },
        tab         : { name: "tab"         , sizes:[25, 33, 50, 66, 75, 100] },
        msgbox      : { name: "msgbox"      , sizes:[25, 33, 50, 66, 75, 100] },
        blog        : { name: "blog"        , sizes:[25, 33, 50, 66, 75, 100] },
        portfolio   : { name: "portfolio"   , sizes:[25, 33, 50, 66, 75, 100] },
        divider     : { name: "divider"     , sizes:[100] },
        
        product     : { name: "product"     , sizes:[25, 33, 50, 66, 75, 100] },
        faq         : { name: "faq"         , sizes:[25, 33, 50, 66, 75, 100] },
        staff       : { name: "staff"       , sizes:[25, 33, 50, 66, 75, 100] },
        news        : { name: "news"        , sizes:[25, 33, 50, 66, 75, 100] },
        testimonial : { name: "testimonial" , sizes:[25, 33, 50, 66, 75, 100] },
        price       : { name: "price"       , sizes:[25, 33, 50, 66, 75, 100] },
        client      : { name: "client"      , sizes:[25, 33, 50, 66, 75, 100] },
        map         : { name: "map"         , sizes:[25, 33, 50, 66, 75, 100] },
        contact     : { name: "contact"     , sizes:[25, 33, 50, 66, 75, 100] },
        twitter     : { name: "twitter"     , sizes:[25, 33, 50, 66, 75, 100] },
        service     : { name: "service"     , sizes:[25, 33, 50, 66, 75, 100] },
        chart       : { name: "chart"       , sizes:[25, 33, 50, 66, 75, 100] },
        pages       : { name: "pages"      , sizes:[25, 33, 50, 66, 75, 100] }
    };
    
    var blocksSettingDictionary = 
    {
        slider      : { uid:'', title:'' , id   :'none' },
        column      : { uid:'', title:'' , content: ''   , textStyle:'paragraph', image:'',icon:'none',iconColor:'#4A9BDC', imagePosition:'bottom' },
        callout     : { uid:'', title:'' , type:'callout', caption:'', bgcolor:'default', buttonLabel:'', buttonLink:'', target:'self'},
        toggle      : { uid:'', title:'' , type:'toggle' , tabs:[]  },
        listitem    : { uid:'', title:'' , icon:'none'   , bordered:'no', tabs:[]  },
        gallery     : { uid:'', title:'' , id :'none'    , iSize:25  , type:'lightbox' },
        image       : { uid:'', title:'' , id :''        , src:''    , lightbox:'no', alt:''  , link:'' , icon:'plus'  },
        video       : { uid:'', title:'' , url:''        , fit: 'yes', ogg:'', mp4:'', webm:'',flv:'', poster:'', skin:'dark' },
        tab         : { uid:'', title:'' , position:'top', tabs: [] },
        msgbox      : { uid:'', title:'' , content:''    , type:'none', showIcon:'yes' },
        blog        : { uid:'', title:'' , iSize:50      , viewThumb:'yes' , thumbPos:'top', dateType:'big', viewAll:'no',viewAllLabel:'Read More', fetchedNum:6, type:'slide', id:'all', excerpt:'120', order:'' },
        portfolio   : { uid:'', title:'' , iSize:33      , viewTitle:'yes',viewExcerpt:'yes', type:'regular', fetchedNum:'6', perPage:3, id:'all', excerpt:'120', effect:'darken', displayMode :'under' },
        divider     : { uid:'', text :'' , type:'solid'  , height:'' },
        
        product     : { uid:'', title:'' , iSize:25      , viewPrice :'yes' , viewThumb:'yes'  , type:'slide', fetchedNum:6 , id:'all' , order:'' , displayMode:'grid', viewAllLabel:'See More' },
        staff       : { uid:'', title:'' , iSize:25      , viewExcerpt:'yes', viewSocial:'yes' , id:'all'       , linkToSingle:'no' },
        news        : { uid:'', title:'' , iSize:33      , viewThumb:'yes'  , thumbPos:'top'   , dateType:'big',  viewAll:'no',viewAllLabel:'Read More', fetchedNum:6, type:'slide', id:'all', excerpt:'120', order:'' },
        service     : { uid:'', title:'' , iSize:25      , type:'column'    , id:'all'         , excerpt:'120' },
        testimonial : { uid:'', title:'' , type:'blockquote'  , idType:'specific', singleId:'none'  , catId:'none', order:'', displayThumb:''  },
        client      : { uid:'', title:'' , height:''     , tabs: [] , displayType: 'slider' },
        map         : { uid:'', title:'' , height:400    , key :''          , type:'ROADMAP'   ,zoom:4,  lat:52, lon:14, info:''  },
        contact     : { uid:'', title:'' , email:''      , type:'built-in' , wcf7:''  },
        price       : { uid:'', title:'' , id   :'none' },
        twitter     : { uid:'', title:'' , user :''      , num:4 , avatar:'yes', time:'yes', len:50 },
        faq         : { uid:'', title:'' , viewOne:'no'  , id:'all', order:''  },
        chart       : { uid:'', title:'' , tabs: [] },
        pages       : { uid:'', title:'' , iSize:33  , tabs: [] , viewTitle:'yes',viewExcerpt:'yes', type:'regular', excerpt:'90' }
        
    };
    
    // restore array model [ { name:"slider" , size:"25", setting:{ size: 25, id:'none' }  } ];
    restoreData = [];
    try{ if(axiom_pb_data != undefined) restoreData = axiom_pb_data }
    catch(e){  }
    
    // temporary vars
    
    var unsavedSetting , unSavedTabs, activeId, removeQueue, $confirmBtns;
    $confirmBtns = $("#axiom_builder .pb_confirm .pb_s_m a");
    
     ////////////////////
    // Custome Binder //////////////////////
    ///////////////////
    
    // adds new block template to workspace
    ko.bindingHandlers.addBlock = {
        init: function(ele, val) {
            var $btn        = $(ele); // get clicked cmd button
            var blockName   = val();  // get block name
            
            $btn.on("click", function(event) {
                event.preventDefault();
                var newBlock = new elementModel(blocksDictionary[blockName]);
                newBlock.settingModel = blocksSettingDictionary[blockName];
                builderViewModel.blockObjects.push(newBlock);
            });
        }
    };
    
    // close setting page on double & middle click
    ko.bindingHandlers.mclick = {
        init: function(ele, val) {
            var $bar        = $(ele); // get clicked cmd button
            
            $bar.on(" mouseup dblclick", function(event) {
                if(event.type == 'dblclick' || event.which == 2){
                    event.preventDefault();
                    builderViewModel.closeSetting();
                    return false;
                }
            });
        }
    };
    
    ko.bindingHandlers.settingVisible = {
        init: function(ele, val) {
            var $setting    = $(ele); // get setting block
            var visible     = val();  // get visibility status
            visible ? $setting.show(0):$setting.hide(0);
        }, 
        update: function(ele , val){
            var $setting    = $(ele); // get setting block
            var $popup      = $setting.children('.pb_popup');
            var $builderWrap= $('div#axiom_builder');
            var visible     = val();  // get visibility status
            
            if(visible){
                $setting.css( {display:'block', opacity:0} );
                $popup.css( {top:'20px'} );
                var _height = $('div.pb_setting').height();
                $builderWrap.css({height:_height});
                $setting.animate(
                    {opacity:1},
                    {
                        duration:200, 
                        easing:'easeOutQuint'
                    });
                $popup.animate(
                    {top:0},
                    {
                        duration:400,
                        easing:'easeOutQuint'
                    });
            }else{
                $setting.animate(
                    {opacity:0},
                    {
                        duration:300, 
                        easing:'easeOutQuint',
                        complete:function(){ $setting.css({display:'none'}); }
                    });
                    
                $builderWrap.css({height:''});
            }
        }
    };
    
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
                    //$(ui.placeholder).width($(ui.item).innerWidth());
                    console.log($(element).sortable( "option", "cursorAt" ));
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
                placeholder: "element_block_placeholder",
                forcePlaceholderSize: true, 
                handle: '.symbol_block, .divider-bar',
                revert: true
            };
            
            // bind
            $(element).sortable( sortableSetup ).disableSelection();  
        }
    };
    
    ko.bindingHandlers.ckeditor = {

        init: function (element, valueAccessor, allBindingsAccessor, viewModel) {
            
            var $textarea = $(element);
            
            if (!$textarea.length) return;
            
            var textareaID  = $textarea.attr("id");
            var textareaVal = ko.utils.unwrapObservable(valueAccessor());
            
            
            setTimeout(function(){
                
                var editor = CKEDITOR.instances[textareaID];
                CKEDITOR.replace(textareaID);
                
                editor = CKEDITOR.instances[textareaID];
                
                var $textarea = $("#"+ textareaID);
                
                $textarea.closest(".pb_s_m")
                         .siblings(".pb_s_b")
                         .find(".button").on("click", function(){
                    $textarea.val(editor.getData()).trigger("change");
                });
                
                
                editor.on("instanceReady", function(){    
                    
                     this.document.on("keyup", function(){
                        $textarea.val(editor.getData()).trigger("change");
                    });
                    
                    editor.on('blur', function(e) {
                        if (e.editor.checkDirty()) {
                            $textarea.val(editor.getData()).trigger("change");
                        }
                    });
                });
                
            }, 100);
            
        },
    
        update: function (element, valueAccessor, allBindingsAccessor, viewModel) {
    
            var val = ko.utils.unwrapObservable(valueAccessor());
            $(element).val(val);
        }
    
    }
    
      ////////////
     // Model //////////////////////////////////
    ////////////
    
    //// symbols model ////
    
    // a model for symbol elements
    function elementModel(obj){
        var self          = this;
        
        this.name         = obj.name;
        
        this.size         = ko.observable(obj.sizes[0]);
        this.sizes        = obj.sizes; 
        this.options      = ""; 
        this.templateName = "temp-" + obj.name;
        this.settingModel ;
        this.index        ;
        
        // model commands
        
        this.remove     = function(){ 
            removeQueue = this;
            // it will called from confirm
            // builderViewModel.blockObjects.remove(this); 
            $confirmBtns.closest(".pb_confirm").css({ display:"block" });
        };
        this.increase   = function(){
            for(var i = 0, len = this.sizes.length; i<len; ++i){
                if( (this.sizes[i] == this.size() )  &&  (i + 1 < len) ){
                        this.size(this.sizes[i+1]);
                        break;
                }
            }
        };
        this.decrease   = function(){
            for(var i = 0, len = this.sizes.length; i<len; ++i){
                if( (this.sizes[i] == this.size() )  &&  (i > 0) ){
                        this.size(this.sizes[i-1]);
                        break;
                }
            }
        };
        this.edit = function(){
            activeId = self.index;
            builderViewModel.activeName(this.name);
        };
        this.sizeClass = ko.computed(function(){
            var size = this.size();
            return { 'g1_1':size == 100, 'g3_4':size == 75,
                     'g2_3':size == 66 , 'g1_2':size == 50,
                     'g1_3':size == 33 , 'g1_4':size == 25 };
        }, this);
        this.blockSizeLabel = ko.computed(function(){
            switch(this.size()){
                case 100: return '1/1';
                case 75 : return '3/4';
                case 66 : return '2/3';
                case 50 : return '1/2';
                case 33 : return '1/3';
                case 25 : return '1/4';
            }
        }, this);
        
    };
    
    //// setting model ////
    
    // a temp object that clones each setting data
    function instanceSetting(obj){
        var self = this;
        
        // clone propeties like original
        for(prop in obj){
            this[prop] = obj[prop]; }
        
        // if setting has tab area
        if(this.tabs != undefined){
            // get and clone tabs then put in a tempVar
            unSavedTabs  = new tempTabs(this.tabs);
            // make tempTabs observable
            builderViewModel.settingTabs(unSavedTabs);
            this.addTab  = function(){ builderViewModel.settingTabs.push(new tabModel());
                                       var _height = $('div.pb_setting').height();
                                       $('div#axiom_builder').css({height:_height}); 
            }
        }
    }
    
    // model for 'setting tab' behaviors
    function tabModel(obj){
        // init essentials 
        this.title   = '';
        this.content = '';
        this.image   = '';
        this.link    = '';
        
        this.removeTab = function(){ builderViewModel.settingTabs.remove(this); };
        // fill data if it is set before
        for(prop in obj){ this[prop] = obj[prop]; }
    }
    
    // clones setting tabs and returns array
    function tempTabs(tabs){
        for(var i = 0, arr = [], len = tabs.length; i < len; ++i ){
            arr.push( new tabModel(tabs[i]) );
        }
        return arr;
    }
    
      /////////////////
     // View Model ////////////////////////////
    /////////////////
    
    builderViewModel =  { 
        self : this,
                
        // this object holds all element blocks in build area
        blockObjects    : ko.observableArray([]),
        // temporary holds setting page model
        settingObject   : ko.observable(''),
        // holds current setting page name
        activeName      : ko.observable(''),
        
        settingTabs     : ko.observableArray([]),
        
        blockTemplate   : function(item){ return item.templateName; }
    };
    
    /////////////////////////////////////////////
    
    
    builderViewModel.jsonData = ko.computed(function(){
        //console.log(getStorableObject());
    }, builderViewModel);
    
    builderViewModel.closeSetting = function(){
        builderViewModel.activeName('');
    };
    
    // slides up and then removes element block
    builderViewModel.hideBlock = function(elem) { 
        if (elem.nodeType === 1) {
            $elem = $(elem);
            $elem.slideUp(function() { $elem.remove(); });
        } 
    };
    
    builderViewModel.updateModelsIndex = ko.computed(function(){
        // get active models
        var models = this.blockObjects();
        
        for(var i = 0, len = models.length; i < len ; ++i )
            models[i].index = i;
        
    }, builderViewModel);
    
    // invokes when setting page visibility changed
    builderViewModel.getTempID = ko.computed(function(){
        // get active element name
        var name = this.activeName();
        
        if(name != ''){
            // create new setting model
            unsavedSetting = new instanceSetting(getElementBlockSetting(name));
            this.settingObject(unsavedSetting); // make unsavedSetting observable
        }
        
        return (name == '')?'setting-blank':'setting-' + name;
    }, builderViewModel);
    
    
    
    builderViewModel.saveSettingToObject = function(){
        // get active element name
        var name = builderViewModel.activeName();
        
        // if tabs property is available, save it too
        if(unsavedSetting['tabs'] != undefined){
            unsavedSetting['tabs'] = unSavedTabs;
        }
        // store settings on element model
        setElementBlockSetting(name, unsavedSetting);
        builderViewModel.closeSetting();
    };
    
    
    ko.applyBindings(builderViewModel);
    
    
    ////////////// functions //////////////////////
    
    function setElementBlockSetting (name, settingObj){
        var model = builderViewModel.blockObjects()[activeId];
        model.settingModel = settingObj;
    };
    
    function getElementBlockSetting(name){
        return builderViewModel.blockObjects()[activeId].settingModel;
    };
    
    function restoreElements(){
        var elem;
        for(var i = 0, len = restoreData.length; i < len; ++i){
            elem = restoreData[i];
            
            var newBlock = new elementModel(blocksDictionary[elem.name]);
            newBlock.size(elem.size);
            newBlock.settingModel = elem.setting;
            builderViewModel.blockObjects.push(newBlock);
        }
    };
    
    restoreElements();
    
    
    function getStorableObject(){
        var elems = [];
        var blocks = builderViewModel.blockObjects();
        
        for(var i=0, len = blocks.length; i < len; ++i){
            var obj = {};
            obj["name"]    = blocks[i].name;
            obj["size"]    = blocks[i].size();
            obj["setting"] = blocks[i].settingModel;
            elems.push(obj);
        }
        return ko.toJSON(elems);
    }
    
    $confirmBtns.on("click", function(event){
        event.preventDefault();
        if(event.target.getAttribute("data-name") == "yes"){
            builderViewModel.blockObjects.remove(removeQueue); 
        }
        $confirmBtns.closest(".pb_confirm").css({ display:"none" });
    });
    
    // when save button clicked save page buider data in hidden field
    $('div#submitdiv #publish, div#submitdiv #save-post').on('click', function(){
        $('input#axiom_pb_draft_data').val(getStorableObject());
    });
    
    
})(jQuery, window);


