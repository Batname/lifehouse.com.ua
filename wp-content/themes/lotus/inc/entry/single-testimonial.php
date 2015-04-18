                                    <?php 
                                        $cjob = get_post_meta($post->ID, 'customer_job', true); 
                                        $curl = get_post_meta($post->ID, 'customer_url' , true); 
                                    ?>
                                    
                                    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" >
                                        
                                        <section class="post_content clearfix" itemprop="articleBody">
                                            <?php echo do_shortcode('[blockquote]'.get_the_content().'[/blockquote]'); ?>
                                        </section> <!-- end article section -->
                                    
                                    </article> <!-- end article -->
                                    
                                    <?php unset($cjob, $curl); ?>