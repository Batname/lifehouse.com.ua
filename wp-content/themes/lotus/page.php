<?php
/* The template for displaying pages. */

get_header(); 
?>
    <div id="main" class="<?php axiom_the_page_sidebar_pos($post->ID) ?>">
        <div class="wrapper fold clearfix">
            
            <section id="primary" >
                <div class="content" role="main"  >
                    
                            
                    <?php get_template_part('inc/content' ); ?>
                            
                    
                </div><!-- end content -->
            </section><!-- end primary -->
            
            
            <?php get_sidebar(); ?>
            
        </div>
    </div><!-- end main -->

<?php get_sidebar('footer'); ?>
<?php get_footer(); ?>
