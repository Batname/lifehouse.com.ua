;(function($){

/*--------------------------------------------
 *  enable contact form 7 placeholder
 *--------------------------------------------*/
   
   var $cf7_fields = $("form.wpcf7-form").find("input, textarea");
   
   $cf7_fields.each(function() {
       var $this = $(this);
        $this.attr("placeholder", $this.attr("title") );       
    }); 
   
})(jQuery);