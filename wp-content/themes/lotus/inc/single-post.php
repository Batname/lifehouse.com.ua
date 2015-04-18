                    <div class="wrapper">
                        <div class="container block">
                           <?php while ( have_posts() ) : the_post(); ?>

	                       <?php include 'entry/single-post.php'; ?>
                           
                           <?php endwhile; // end of the loop. ?>
                        </div><!-- container -->
                    </div><!-- wrapper -->