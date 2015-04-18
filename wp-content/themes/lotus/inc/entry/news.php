<?php global $axi_img_size; ?>                                    
                                    
                                    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix hentry'); ?> role="article" >
                                            
                                            <?php if ( has_post_thumbnail()) : ?>
                                            <div class="entry-media">
                                                <div class="imgHolder">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php $size = ( $axi_layout != "no-sidebar")?$axi_img_size["side"]:$axi_img_size["full"];
                                                              axiom_the_post_thumbnail($post->ID, $size[0], $size[1], true); ?>
                                                    </a>
                                                </div>
                                                <div class="sep hbar"> </div>
                                            </div>
                                            <?php endif; ?>
                                            
                                            <div class="entry-main">
                                                
                                                <div class="entry-header">
                                                    <h3 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                                    <div class="cell-date left">
                                                        <em> </em><em> </em>
                                                        <?php $custom_date = get_post_meta( $post->ID, 'custom_news_date', true ); 
                                                              $news_date   = empty($custom_date)?get_the_time('Y-m-d'): date( 'Y-m-d' , strtotime($custom_date));
                                                              $news_day    = empty($custom_date)?get_the_time('d')    : date( 'd'     , strtotime($custom_date));
                                                              $news_mth    = empty($custom_date)?get_the_time('M')    : date( 'M'     , strtotime($custom_date));
                                                        ?>
                                                        <time datetime="<?php echo $news_date; ?>" title="<?php echo $news_date; ?>" >
                                                            <strong><?php echo $news_day; ?></strong>
                                                            <span><?php echo $news_mth; ?></span>
                                                        </time>
                                                        <?php unset($custom_date,$news_date,$news_day,$news_mth ); ?>
                                                    </div>
                                                </div>
                                                
                                                <div class="entry-content">
                                                    <?php the_excerpt(); ?>    
                                                </div>
                                                
                                                <footer class="entry-meta">
                                                    <div class="entry-meta-wrapper clearfix">
                                                        
                                                        <a href="<?php the_permalink(); ?>#comments" class="cell-comment"><?php comments_number('0', '1', '%'); ?></a>
                                                        
                                                        <div class="entry-tax" role="category tag">
                                                            <?php $tax_name = 'news-category';
                                                                  $cat_terms = wp_get_post_terms($post->ID, $tax_name); 
                                                                  if($cat_terms){
                                                                      foreach($cat_terms as $term){
                                                                          echo '<a href="'. get_term_link($term->slug, $tax_name) .'" rel="category" >'.$term->name.'</a>';
                                                                      }
                                                                  }
                                                            ?>
                                                        </div>
                                                        
                                                        <div class="readmore right">
                                                            <a href="<?php the_permalink(); ?>" class="linkbutton">Read More</a>
                                                            <a href="<?php the_permalink(); ?>" class="linkblock">&#8226;&#8226;&#8226;</a>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                </footer>
                                                
                                            </div><!-- end entry-main -->

                                       </article>