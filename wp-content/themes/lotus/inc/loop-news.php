                    <div class="wrapper">
                        <div class="container block">
                            
                            <?php $axi_layout = axiom_get_page_sidebar_pos($post->ID); ?>
                            
                            <?php while ( have_posts() ) : the_post(); ?>

	                           <?php include 'entry/news.php'; ?>
	                                               
                            <?php endwhile; // end of the loop. ?>
                            
                            <?php axiom_the_paginate_nav(); ?>
                            
                        </div><!-- container -->
                    </div><!-- wrapper -->