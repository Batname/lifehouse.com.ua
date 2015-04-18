<?php global $axiom_options; ?>
                 
                    <div class="wrapper">
                        <div class="container">
                            
                            <?php while ( have_posts() ) : the_post(); 
                                
                                  include 'entry/single-product.php';
                            
                                  endwhile; // end of the loop. 
                            ?>
                            
                            
                            <?php echo do_shortcode('[smartpagebuilder]'); ?>
                            
                            
                            <?php // get related portfolio items
                                
                                if(isset($axiom_options["show_product_related_items"])){
                                    $related_posts_title = $axiom_options["product_related_items_title"];
                                    $related_posts_size  = $axiom_options["product_related_items_size" ];
                                    do_shortcode('[related_items title="'.$related_posts_title.'" mode="none" posttype="axi_product" tax="product-tag" num="6" col="'.$related_posts_size.'" ]'); 
                                }
                            ?>
                            
                        </div><!-- container -->
                        
                        
                    </div><!-- wrapper -->
                    
                    