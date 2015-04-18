                    <div class="wrapper">
                        
                        <div class="container">
                           <?php while ( have_posts() ) : the_post(); ?>

	                       <?php include 'entry/single-general.php'; ?>
                        
                           <?php endwhile; // end of the loop. ?>
                        </div><!-- container -->
                        
                        <?php echo do_shortcode('[smartpagebuilder]'); ?>
                        
                            
                    </div><!-- wrapper -->