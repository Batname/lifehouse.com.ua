<?php
/**
 * The main template file.
 */
$sidebar = "right";
get_header(); ?>
	    
    <div id="main" class="list-post <?php echo $sidebar; ?>-sidebar">
        <div class="wrapper fold clearfix">
            
            <section id="primary" >
                <div class="content" role="main" data-target="index" >
                    
                    <?php if (have_posts()) : ?>

                        <?php get_template_part('inc/loop', get_post_type() ); ?>
                        
                    <?php else : ?>
                    
                        <?php get_template_part('inc/content', 'none' ); ?>
                    
                    <?php endif; ?>
                      
                </div><!-- end content -->
            </section><!-- end primary -->
            
            
            <?php get_sidebar(); ?>
            
            
        </div>
    </div><!-- end main -->

<?php get_sidebar("footer"); ?>
<?php get_footer(); ?>
