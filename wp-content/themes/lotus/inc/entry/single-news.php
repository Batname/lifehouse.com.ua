<?php 
    global $axiom_options, $axi_img_size;  
    $axi_layout = isset($axiom_options["news_sidebar_position"])?$axiom_options["news_sidebar_position"]:"right-sidebar";
?>

                                    <article <?php post_class(""); ?>>

                                            <?php if ( has_post_thumbnail()) : ?>
                                            <div class="entry-media">
                                                <div class="imgHolder">
                                                    <?php $size  = ($axi_layout != "no-sidebar")?$axi_img_size["side"]:$axi_img_size["full"];
                                                      axiom_the_post_thumbnail($post->ID, $size[0], $size[1], true); ?>
                                                </div>
                                                <div class="sep hbar"> </div>
                                            </div>
                                            <?php endif; ?>
                                            
                                            <div class="entry-main">
                                                
                                                <div class="entry-header">
                                                    <h3 class="entry-title"><?php the_title();?></h3>
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
                                                
                                                <div class="entry-info">
                                                    <span><?php _e("Posted on11", "default"); ?></span>
                                                    <span class="meta-sep"><?php _e("by","default"); ?></span>
                                                    <span class="author vcard">
                                                        <?php the_author();?>
                                                    </span>
                                                    <?php edit_post_link("Edit", '<i> | </i>', ''); ?>
                                                </div> 
                                                
                                                <div class="entry-content">
                                                    <?php the_content(); ?>
                                                </div>
                                                
                                                <footer class="entry-meta">
                                                    <div class="entry-tax" role="category tag">
                                                        <?php $tax_name = 'news-category';
                                                              $cat_terms = wp_get_post_terms($post->ID, $tax_name); 
                                                              if($cat_terms){
                                                                  foreach($cat_terms as $term){
                                                                      echo '<a href="'. get_term_link($term->slug, $tax_name) .'" rel="category" >'.$term->name.'</a>';
                                                                  }
                                                              }
                                                        ?>
                                                        <?php the_terms($post->ID, 'news-tag' ,'<span>'. __("tags: ", "default"). '</span>', '<i> / </i>', ''); ?>
                                                    </div>
                                                    
                                                    <ul class="entry-share socials small">
                                                        <li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" title="<?php _e("Share on facebook", "default"); ?>" class="icon-facebook-sign" target="_blank" > </a>
                                                        <li><a href="http://www.twitter.com/share?url=<?php the_permalink(); ?>" title="<?php _e("Share on twitter", "default"); ?>"  class="icon-twitter" target="_blank" > </a>
                                                    </ul>
                                                    
                                                </footer>
                                                
                                            </div>
                                            
                                            
                                            <?php // get related news posts
                                            if(isset($axiom_options["show_news_related_posts"])){
                                                $related_posts_title = $axiom_options["news_related_posts_title"];
                                                $related_posts_size  = $axiom_options["news_related_posts_size" ];
                                                do_shortcode('[related_items title="'.$related_posts_title.'" mode="none" posttype="news" tax="news-tag" num="6" col="'.$related_posts_size.'" ]'); 
                                            }
                                            ?>
                                            
                                            <?php if(isset($axiom_options["show_news_author_section"])) { ?>
                                            <div id="entry-author-info">
                                                    <div id="author-avatar">
                                                        <?php echo get_avatar(get_the_author_meta("user_email"),60); ?>                    
                                                    </div><!-- #author-avatar -->
                                                    <div id="author-description">
                                                        <dl>
                                                            <dt><?php the_author();?></dt>
                                                            <dd>
                                                                <span><?php the_author_meta("skills");?></span>
                                                                <p><?php the_author_meta("user_description");?>.</p>
                                                                <div id="author-link"></div><!-- #author-link -->
                                                            </dd>
                                                        </dl>
                                                        
                                                        <ul class="socials small sort">
                                                            <li><a href="<?php the_author_meta("facebook");?>" class="icon-facebook-sign" title="<?php _e("Visit Facebook Profile", "default"); ?>" ></a></li>
                                                            <li><a href="<?php the_author_meta("twitter"); ?>" class="icon-twitter" title="<?php _e("Visit Twitter Profile", "default"); ?>" ></a></li>
                                                        </ul>
                                                    </div><!-- #author-description -->
                                            </div>
                                            <?php } ?>

                                       </article>