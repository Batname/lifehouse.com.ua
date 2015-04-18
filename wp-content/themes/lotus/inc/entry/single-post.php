<?php global $axiom_options, $axi_img_size; 

    $post_format = get_post_format($post->ID); 
    $has_attach  = FALSE;
    $the_attach  = "";
    $show_title  = true;
    $axi_layout  = isset($axiom_options["blog_sidebar_position"])?$axiom_options["blog_sidebar_position"]:"right-sidebar";
    
    switch ($post_format) {
        case 'aside':
            
            break;
            
        case 'gallery':
            $size  = ($axi_layout != "no-sidebar")?$axi_img_size["side"]:$axi_img_size["full"];
            
            $slider  = '[flexslider slideshow="no" effect="slide" easing="easeInOutQuad" ]';
            for ($i=1; $i <= 5; $i++) {
                $has_attach = true; 
                $img_url = get_post_meta($post->ID, "axi_gallery_image".$i, true);
                if(!empty($img_url)){
                    $slider .= '[simple_slide src="'.axiom_get_the_resized_image_src($img_url, $size[0], $size[1], true ).'"  ]';
                }
            }
            $slider .= '[/flexslider]';
            
            if(!$has_attach) break;
            
            $the_media = do_shortcode($slider).'<div class="sep hbar"> </div>';
            
            break;
        case 'image':
            $has_attach = has_post_thumbnail();
            if(!$has_attach) break;
            $size  = ($axi_layout != "no-sidebar")?$axi_img_size["side"]:$axi_img_size["full"];
            $the_attach = axiom_get_the_post_thumbnail($post->ID, $size[0], $size[1], true);
            
                         
            $the_media = '<div class="imgHolder lightbox">'.
                            '<a href="'.av3_get_the_attachment_url($post->ID, "full").'" data-rel="prettyPhoto">'.
                                $the_attach.
                                '<span></span>'.
                            '</a>'.
                            '<ul><li class="hover-plus"><a href="'.av3_get_the_attachment_url($post->ID, "full").'" ></a></li></ul>'.
                         '</div><div class="sep hbar"> </div>';
                                 
            break;
            
        case 'link':
            $the_link = get_post_meta($post->ID, "the_link", true);
            $show_title = TRUE;
            $has_attach = false;
            if(!$has_attach) break;
            break;
            
        case 'video':
            $video_link = get_post_meta($post->ID, "youtube", true);
            $mp4        = get_post_meta($post->ID, "mp4" , true);
            $ogg        = get_post_meta($post->ID, "ogg" , true);
            $webm       = get_post_meta($post->ID, "webm", true);
            $flv        = get_post_meta($post->ID, "flv" , true);
            $poster     = get_post_meta($post->ID, "poster", true);
            $skin       = get_post_meta($post->ID, "skin"  , true);
            $has_attach = (!empty($video_link) || !empty($mp4) || !empty($ogg) || !empty($webm) || !empty($flv));
            if(!$has_attach) break;
            $the_attach = do_shortcode('[video fit="yes" url="'.$video_link.'" mp4="'.$mp4.'" ogg="'.$ogg.'" webm="'.$webm.'" flv="'.$flv.'" poster="'.$poster.'" skin="'.$skin.'" uid="axi_vid'.$post->ID.'" size="0" ]');
            $the_media = $the_attach;
            unset($video_link, $mp4,$ogg,$webm,$flv,$poster);
            break;
            
        case 'audio':
            $mp3        = get_post_meta($post->ID, "mp3" , true);
            $oga        = get_post_meta($post->ID, "oga" , true);
            $skin       = get_post_meta($post->ID, "audio_skin"  , true);
            $soundcloud = get_post_meta($post->ID, "soundcloud"  , true);
            $has_attach = (!empty($mp3) || !empty($oga) || !empty($soundcloud));
            if(!$has_attach) break;
            if(!empty($mp3) || !empty($oga))
                $the_attach = do_shortcode('[audio mp3="'.$mp3.'" ogg="'.$oga.'" skin="'.$skin.'" uid="axi_au'.$post->ID.'" size="0" ]');
            else
                $the_attach = do_shortcode($soundcloud);
            $the_media = $the_attach;
            
            unset($mp3,$oga,$skin, $soundcloud);
            break;
            
        case 'quote':
            $quote  = get_the_content( __( 'Continue reading', 'default' ) );
            $author = get_post_meta($post->ID, "the_author", true);
            $show_title = false;
            $has_attach = false;
            if(!empty($author)) $quote .= "<br/>- <cite>".$author."</cite>";
            $the_attach = do_shortcode('[column text_style="blockquote" size="0" ]'.$quote.'[/column]');
            unset($quote);
            break;
            
        default:
            $has_attach = has_post_thumbnail();
            if(!$has_attach) break;
            $size  = ($axi_layout != "no-sidebar")?$axi_img_size["side"]:$axi_img_size["full"];
            $the_attach = axiom_get_the_post_thumbnail($post->ID, $size[0], $size[1], true);
            
            $the_media = '<div class="imgHolder">'.
                            '<a href="'.get_permalink().'">'.
                                $the_attach.
                            '</a>'.
                         '</div><div class="sep hbar"> </div>';
            unset($size);
            break;
    }

?>                                 
                                    <article <?php post_class("single-post list-post"); ?> >
                                        
                                            <?php if ( $has_attach ) : ?>
                                            <div class="entry-media">
                                                <?php echo $the_media; ?>
                                            </div>
                                            <?php endif; ?>
                                            
                                            <div class="entry-main">
                                                
                                                <div class="entry-header">
                                                    <?php if($show_title) { ?>
                                                    <h3 class="entry-title">
                                                        <?php the_title(); if($post_format == "link"){ echo '<br/><cite>- '.$the_link.'</cite>'; } ?>
                                                    </h3>
                                                    <?php } ?>
                                                    <div class="entry-format">
                                                        <div class="post-format"> </div>
                                                    </div>
                                                </div>
                                                
                                             <!--   <div class="entry-info">
                                                    <span><?php _e("Posted on", "default"); ?></span>
                                                    <div class="entry-date"><time datetime="<?php the_time('Y-m-d')?>" ><?php the_date();?></time></div>
                                                    <span class="meta-sep"><?php _e("by","default"); ?></span>
                                                    <span class="author vcard">
                                                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" title="<?php printf( __( 'View all posts by %s', 'default' ), get_the_author() ); ?>" >
                                                            <?php the_author(); ?>
                                                        </a>
                                                    </span>
                                                    <?php edit_post_link("Edit", '<i> | </i>', ''); ?>
                                                </div> -->
                                                
                                                <div class="entry-content">
                                                    <?php if($post_format == "quote") {
                                                        echo $the_attach;;
                                                    }else{
                                                        the_content( __( 'Continue reading', 'default' ) );
                                                        // clear the floated elements at the end of content
                                                        echo '<div class="clear"></div>'; 
                                                        // create pagination for page content
                                                        wp_link_pages( array( 'before' => '<div class="page-links"><span>' . __( 'Pages:', 'default' ) .'</span>', 'after' => '</div>' ) );
                                                    } ?>
                                                </div>
                                                
                                                <footer class="entry-meta">
                                                    <div class="entry-tax" role="category tag">
                                                        <?php // the_category(' '); we can use this template tag, but customizable way is needed! ?>
                                                        <?php $tax_name = 'category';
                                                              $cat_terms = wp_get_post_terms($post->ID, $tax_name); 
                                                              if($cat_terms){
                                                                  foreach($cat_terms as $term){
                                                                      echo '<a href="'. get_term_link($term->slug, $tax_name) .'" title="'.__("View all posts in ","default").$term->name.'" rel="category" >'.$term->name.'</a>';
                                                                  }
                                                              }
                                                        ?>
                                                        <?php the_tags('<span>'. __(": ", "default"). '</span>', '<i> / </i>', ''); ?>
                                                    </div>
                                                    
                                                    <ul class="entry-share socials small">
                                                        <li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" title="<?php _e("Share on facebook", "default"); ?>" class="icon-facebook-sign" target="_blank" > </a>
                                                        <li><a href="http://www.twitter.com/share?url=<?php the_permalink(); ?>" title="<?php _e("Share on twitter", "default"); ?>"  class="icon-twitter" target="_blank" > </a>
                                                    </ul>
                                                </footer>
                                                
                                            </div>
                                            
                                            
                                            <?php // get related posts
                                            if(isset($axiom_options["show_blog_related_posts"])){
                                                $related_posts_title = $axiom_options["blog_related_posts_title"];
                                                $related_posts_size  = $axiom_options["blog_related_posts_size" ];
                                                do_shortcode('[related_items title="'.$related_posts_title.'" mode="none" posttype="post" tax="tag" num="6" col="'.$related_posts_size.'" ]'); 
                                            }
                                            ?>
                                            
                                            <?php if(isset($axiom_options["show_blog_author_section"])) { ?>
                                            <div id="entry-author-info">
                                                    <div id="author-avatar">
                                                        <?php echo get_avatar(get_the_author_meta("user_email"),60); ?>                       
                                                    </div><!-- #author-avatar -->
                                                    <div id="author-description">
                                                        <dl>
                                                            <dt>
                                                                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" title="<?php printf( __( 'View all posts by %s', 'default' ), get_the_author() ); ?>" >
                                                                    <?php the_author(); ?>
                                                                </a>
                                                            </dt>
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