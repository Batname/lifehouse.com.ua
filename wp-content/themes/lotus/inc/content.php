                    
                    <div class="container block">
                        
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        
                        
                        <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" >
                            
                            <section class="post_content clearfix" itemprop="articleBody">
                                <?php the_content(); ?>
                            </section> <!-- end article section -->
                            
                            <div class="clear"></div>
                            
                            <footer>
                                <?php the_tags('<p class="tags"><span class="tags-title">' . __("Tags","default") . ':</span> ', ', ', '</p>'); ?>
                            </footer> <!-- end article footer -->
                        
                        </article> <!-- end article -->
                        
                        
                        <?php endwhile; ?>      
                        
                        <div class="clear"></div>
                        
                        <?php else : ?>
                        
                        <article id="post-not-found">
                            <header>
                                <h1><?php _e("Not Found", "default"); ?></h1>
                            </header>
                            <section class="post_content">
                                <p><?php _e("Sorry, but the requested resource was not found on this site.", "default"); ?></p>
                            </section>
                            <footer></footer>
                        </article>
                        
                        <?php endif; ?>
                        
                        
                        <div class="entry-builder-wrapper">
                            <div class="entry-builder container">
                                <div class="entry-builder-frame">
                                    
                                    <?php pagebuilder_elements(); ?>
                                    
                                </div>
                            </div><!-- axiom-builder container -->
                        </div><!-- axiom-builder wrapper -->
                        
                        <div class="clear"></div>
                        
                        <?php comments_template(); ?>
                    </div>
                    
                    
                    