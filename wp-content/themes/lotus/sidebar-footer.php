<?php
    /* The footer sidebar widget area is triggered if any of the areas have widgets. */
    
    global $axiom_options;
    
?>

<?php if( isset($axiom_options["show_subfooter"]) ) { ?>
    
    <div class="container fold subfooter-bar"> </div>
        
    <aside class="wrapper subfooter">
        
        <div class="container fold">
            
            <div class="grid_wrapper">
                
<?php 
    $layout   = axiom_get_footer_layout();
    $col_nums = axiom_get_active_footer_columns();
    
    for ($i=1; $i <= $col_nums; $i++) { 
        if ( is_active_sidebar( 'axiom-footer'.$i.'-sidebar-widget-area' ) ) {
            $size = axiom_get_nth_footer_column_width($layout, $i);
?>
                <section class="widget-area <?php echo $size; ?>">       
                    <?php dynamic_sidebar( 'axiom-footer'.$i.'-sidebar-widget-area' ); ?>
                </section>
<?php
        }
    }
?>

            </div>
            
        </div><!-- end of container -->
    </aside><!-- end footer widget -->

<?php } ?>