<?php /* Loops through all blog posts, for displaying posts in blog templates. */ 
?>
                    <div class="wrapper">
                        <div class="container block">
                                                    
                            <?php 
                                if ( get_query_var('paged') ) {
                                    $paged = get_query_var('paged');
                                } else if ( get_query_var('page') ) {
                                    $paged = get_query_var('page');
                                } else { $paged = 1; }
                                
                                $q_args  = 'paged='. $paged;
                                $per_page = get_option('posts_per_page');
                                $q_args .= '&post_type=post&orderby=date&post_status=publish&posts_per_page='. $per_page;
                                
                                $bu_wp_query = $wp_query; 
                                $wp_query = null; 
                                $wp_query = new WP_Query(); 
                                $wp_query->query($q_args); 
                                  
                                $axi_layout = axiom_get_page_sidebar_pos($post->ID);
                            ?>
                            
                            <?php while ( have_posts() ) : the_post(); ?>

                                <?php include 'entry/post.php'; ?>
                                                   
                            <?php endwhile; // end of the loop. ?>
                            
                            <?php 
                                axiom_the_paginate_nav(); 
                                $wp_query = $bu_wp_query; 
                            ?>
                            
                        </div><!-- container -->
                    </div><!-- wrapper -->