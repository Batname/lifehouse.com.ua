<?php
/* Template Name: Blog */

get_header(); 
?>
    <div id="main" class="list-post <?php axiom_the_page_sidebar_pos($post->ID); ?>">
        <div class="wrapper fold clearfix">
            
            <section id="primary" >
                <div class="content" role="main"  >
                    
                            
                    <?php get_template_part('inc/loop', "post-custom" ); ?>
                            
                    
                </div><!-- end content -->
            </section><!-- end primary -->
            
            
            <?php get_sidebar(); ?>
            
        </div>
    </div><!-- end main -->

<?php get_sidebar('footer'); ?>
<?php get_footer(); ?>