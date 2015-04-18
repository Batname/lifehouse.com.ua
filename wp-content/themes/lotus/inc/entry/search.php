<?php /* Finds and displays search resaults. */ 
?>
                 <div class="wrapper">
                     
                    <div class="container block">
                        
                        <?php while (have_posts()) : the_post(); ?>
                        
                        <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" >
                            
                            <?php if ( has_post_thumbnail()) : ?>
                            <div class="entry-media">
                                <div class="imgHolder">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php $size = (axiom_get_page_sidebar_pos($post->ID) != "no-sidebar")?"635":"960";
                                              the_post_thumbnail($size); ?>
                                    </a>
                                </div>
                                <div class="sep hbar"> </div>
                            </div>
                            <?php endif; ?>
                            
                            <div class="entry-main">
                                                
                                <div class="entry-header">
                                    <h3 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                </div>
                                
                                <div class="entry-content">
                                    <?php the_excerpt(); ?>    
                                </div>
                                
                                <footer class="entry-meta">
                                    <div class="entry-meta-wrapper clearfix">
                                        
                                        <div class="readmore right">
                                            <a href="<?php the_permalink(); ?>" class="linkbutton"><?php _e("Read More", "default"); ?></a>
                                            <a href="<?php the_permalink(); ?>" class="linkblock">...</a>
                                        </div>
                                        
                                    </div>
                                </footer>
                                
                            </div><!-- end entry-main -->
                        
                        </article> <!-- end article -->
                        
                        
                        <?php endwhile; ?>

                    </div>
                    
                </div>
                               