<?php
/* The template for displaying the footer.
 * Contains the closing of the body div and all content
 * after.  Calls sidebar-footer.php for bottom widgets. */ 

 global $axiom_options;
 ?>
		 
    <footer id="sitefooter" class="wrapper" role="contentinfo" >
        <div class="container fold">
           
            <?php if( isset($axiom_options["show_socials_in_footer"]) ) echo axiom_the_socials(); ?>

<?php language_selector_flags(); ?>
            
            <div id="copyright">
                <?php if(!empty($axiom_options["copyright"])) { ?>
                <small><?php echo $axiom_options["copyright"]; ?></small>
                <?php } ?>
            </div>
            
            <?php wp_nav_menu( array( 
                
                'container'      => 'nav',
                'container_id'   => 'footer_nav',
                'menu_id'        => '',
                'menu_class'     => 'footer-menu',
                'theme_location' => 'footer' ,
                'fallback_cb'    =>  FALSE  // do not display default menu if nothing is set in menu location
                )); 
            ?>
            <!-- end navigation -->
            
             
        </div><!-- end of container -->
    </footer><!-- end sitefooter -->
    
    <div class="scroll2top"></div>

    <script>
        <?php if(isset($axiom_options["axiom_user_custom_js"])) echo stripslashes($axiom_options["axiom_user_custom_js"]); ?>
    </script><!-- user custom js -->
    
    <!--[if (lte IE 8)]>
    <script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/libs/polyfills/selectivizr-min.js"></script>
    <![endif]-->
     
    <!-- outputs by wp_footer -->
    <?php wp_footer(); ?>
    <!-- end wp_footer -->
    
    <script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
    
</div><!--! end of #inner-body -->
</body>
</html>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-41438614-1', 'lifehouse.com.ua');
  ga('send', 'pageview');

</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter21474271 = new Ya.Metrika({id:21474271,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/21474271" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->