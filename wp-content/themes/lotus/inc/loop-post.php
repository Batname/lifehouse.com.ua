<?php /* Loops through all posts, taxes, .. and display posts */ 
    global $query_string;
?>
                    <div class="wrapper">
                        <div class="container block">
                                                    
                            <?php $axi_layout = axiom_get_page_sidebar_pos($post->ID); 
                                
                                if ( get_query_var('paged') )
                                     $paged = get_query_var('paged');
                                elseif ( get_query_var('page') )
                                     $paged = get_query_var('page');
                                else $paged = 1; 
                                
                                $q_args  = '&paged='. $paged. '&posts_per_page='. get_option('posts_per_page');
                                
                                query_posts($query_string.$q_args);
                            ?>
                            
                            <?php while ( have_posts() ) : the_post(); ?>

                                <?php include 'entry/post.php'; ?>
                                                   
                            <?php endwhile; // end of the loop. ?>
                            
                            <?php axiom_the_paginate_nav(); ?>
                            
                        </div><!-- container -->
                    </div><!-- wrapper -->