<?php
/**
 *  * The template for displaying Search Results pages.
 */

get_header(); ?>
	    
    <div id="main" class="right-sidebar search-resault">
        <div class="wrapper fold clearfix">
            
            
            <section id="primary" >
                <div class="content" role="main" data-target="index" >
                    
                    
                    <?php get_template_part('inc/loop', "search" ); ?>
                    

                </div><!-- end content -->
            </section><!-- end primary -->
            
            
            <?php get_sidebar(); ?>
            
            
        </div>
    </div><!-- end main -->

<?php get_sidebar("footer"); ?>
<?php get_footer(); ?>
