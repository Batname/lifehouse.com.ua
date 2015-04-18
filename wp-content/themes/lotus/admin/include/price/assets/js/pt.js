;(function($){

    /////////////////// data ///////////////////////
    
    var blankColumn,restoreData,removeIndex,$confirmDialog,removeQue; 
    $confirmDialog = $("div.pb_confirm");
    
    blankColumn = [{ name:"", price:"", period:"", desc:"", rows:[], btnLabel:"", btnLink:"", type:"regular", color:"" }];
    restoreData = blankColumn;
    
    try{
        if(pt_data.length) restoreData = pt_data;// pt_data is stored data on server
    }catch(e){ console.log(e); }
    
    
    ////////////// Custome Binder /////////////////
    
    ///////////////// Model ///////////////////////
    
    function ColumnModel(obj){
        var self, _rows;
        self            = this;
        
        self.name       = ko.observable("");
        self.price      = ko.observable("");
        self.period     = ko.observable("");
        self.desc       = ko.observable("");
        
        self.rows       = ko.observableArray([]);
        
        self.btnLabel   = ko.observable("");
        self.btnLink    = ko.observable("");
        self.type       = ko.observable("regular");
        self.color      = ko.observable("");
        
        for(prop in obj){
            if(prop != "rows")
                self[prop](obj[prop]);
            else{
                self.rows([]);PtViewModel.rows([]);
                for(var i=0,len=obj["rows"].length;i<len;++i){
                    PtViewModel.rows.push("");
                    self.rows.push({name:obj["rows"][i]});
                }
            }
        }
        
        self.remove     = function(){ 
            removeQue   = this;
            $confirmDialog.css({ display:"block" }).data("type","col");
            //PtViewModel.columns.remove(this); 
        };
        self.addRow     = function(data){
            self.rows.push({name:data});
        };
        self.onNewRowAdded = ko.computed(function(){
            //console.log(getStorableData());
            var cache = self.rows();
            // this is size of viewModel observer
            var len = this.rows().length;//console.log(len,cache.length, removeIndex);
            // if the size of observers are not the same,update it
            if(len > cache.length){
                while(self.rows().length != len)
                    self.addRow("");
            }else if(len < cache.length){
                if(removeIndex == undefined) return;
                
                cache.splice(removeIndex,1);
                self.rows(cache);
            }
            
        }, PtViewModel);
    };
    
    /////////////// View Model ////////////////////
    
    PtViewModel =  { 
        
        columns : ko.observableArray([]),
        
        rows    : ko.observableArray([])
    };
    
    PtViewModel.addNewCol = function(item){
        var newItem = new ColumnModel();
        PtViewModel.columns.push(newItem);
    }
    
    PtViewModel.addNewRow = function(item){
        PtViewModel.rows.push("");
    }
    
    PtViewModel.removeRow = function(elem, event){
        removeIndex = $(event.target.parentElement).index();
        $confirmDialog.css({ display:"block" }).data("type","row");
    }
    
    PtViewModel.removeRowNow = function(){
        PtViewModel.rows().splice(removeIndex, 1);
        PtViewModel.rows.valueHasMutated();
    }
    
    // slides up and then removes column
    PtViewModel.hideColumn = function(elem) { 
        if (elem.nodeType === 1) {
            $elem = $(elem);
            $elem.animate({width:'toggle'},500, function() { $elem.remove(); });
        } 
    };
    
    ko.applyBindings(PtViewModel);
    
    
    ////////////// functions //////////////////////
    
    function getStorableData(){
        var cols = PtViewModel.columns();
        var res  = [];
        
        for(var i=0,len=cols.length;i<len;++i){
            var obj = {};
            obj["name"]     = cols[i].name();
            obj["price"]    = cols[i].price();
            obj["period"]   = cols[i].period();
            obj["desc"]     = cols[i].desc();
            obj["btnLabel"] = cols[i].btnLabel();
            obj["btnLink"]  = cols[i].btnLink();
            obj["type"]     = cols[i].type();
            obj["color"]    = cols[i].color();
            obj["rows"]     = [];
            
            var rows        = cols[i].rows(); 
            for(var j=0,l=rows.length;j<l;++j){
                obj.rows.push(rows[j].name);
            }
            res.push(obj);
        }
        return res;
    };
    
    function restoreColumns(columnsArray){
        PtViewModel.rows([]);
        for(var i=0,len=columnsArray.length;i<len;++i){
            restoreColumn(columnsArray[i]);
        }
    };
    
    function restoreColumn (columnObj){
        var newItem = new ColumnModel(columnObj);
        PtViewModel.columns.push(newItem);
    };
    restoreColumns(restoreData);
    
    ////////////// confirm dialog //////////////////
    
    $confirmDialog.find("a").on("click", function(event){
        event.preventDefault();
        if(event.target.getAttribute("data-name") == "yes"){
            if($confirmDialog.data("type") == "col")
                PtViewModel.columns.remove(removeQue); 
            else if($confirmDialog.data("type") == "row")
                PtViewModel.removeRowNow();
            else
                console.log("no confirm data recieved.");
        }
        $confirmDialog.css({ display:"none" });
    });
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
                post_id: pt_id,
                nonce  : pt_nonce,
                action:  'pt_data',
                columns: getStorableData(),
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


