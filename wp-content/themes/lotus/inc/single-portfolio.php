                    <div class="wrapper">
                        <div class="container">
                            <?php while ( have_posts() ) : the_post(); 
                                
                                include 'entry/single-portfolio.php';
                            
                                endwhile; // end of the loop. 
                            ?>
                            
                            <?php echo do_shortcode('[smartpagebuilder]'); ?>
                            
                            <?php // get related portfolio items
                                if(isset($axiom_options["show_portfolio_related_items"])){
                                    $related_posts_title = $axiom_options["portfolio_related_items_title"];
                                    $related_posts_size  = $axiom_options["portfolio_related_items_size" ];
                                    echo do_shortcode('[related_items title="'.$related_posts_title.'" mode="none" posttype="portfolio" tax="portfolio-tag" num="6" col="'.$related_posts_size.'" ]'); 
                                }
                            ?>
                            
                        </div><!-- container -->
                    </div><!-- wrapper -->