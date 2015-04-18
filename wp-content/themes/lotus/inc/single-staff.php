                    <div class="wrapper">
                        <div class="container">
                            <?php while ( have_posts() ) : the_post();
                            
                                include 'entry/single-staff.php';
                            
                                endwhile; // end of the loop. ?>
                            
                            <?php echo do_shortcode('[smartpagebuilder]'); ?>
                            
                        </div><!-- container -->
                    </div><!-- wrapper -->