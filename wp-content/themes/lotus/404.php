<?php
/* The template for displaying 404 pages (Not Found). */
?>

<?php get_header(); ?>
<?php //include 'slider.php'; ?>
            
    <div id="main" class="no-sidebar" >
        <div class="wrapper fold clearfix">
            
            <div class="sep space"> </div>
            
            <section id="primary" >
                <div class="content" role="main"  >
                    
                                                        
                    <article class="post error404 not-found" >
                        
                        <div class="entry-main">
                            
                            <div class="entry-header">
                                <h1>404</h1>
                                <h2 class="entry-title"><?php _e( 'OOPS! Page Not Found ...', 'default' ); ?></h2>
                            </div>
                            
                            <p class="message404" ><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'default' ); ?></p>

                            <?php get_search_form(); ?>
                            
                        </div>

                   </article>
                    
                </div><!-- end content -->
            </section><!-- end primary -->
            

            <?php get_sidebar(); ?>

            
        </div>
    </div><!-- end main -->
    
<?php get_sidebar('footer'); ?>
<?php get_footer(); ?>