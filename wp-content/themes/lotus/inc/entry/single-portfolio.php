<?php 
    global $axiom_options, $axi_img_size; 
    $axi_layout = axiom_get_page_sidebar_pos($post->ID);
    $size  = ($axi_layout != "no-sidebar")?$axi_img_size["side"]:$axi_img_size["full"];
?>

                            <article <?php post_class(axiom_get_page_layout($post->ID) );?> >
                                
                                
                                
                                <div class="entry-wrapper">
                                    
                                    <div class="entry-media">
                                        
                                            <?php // fetch and display images
                                            
                                            // get images display type
                                            $display_type = get_post_meta($post->ID, "display_type", true);
                                            
                                            $slider       = "";
                                            $live_img_url = ""; // stores one available image url
                                            $live_vid_url = ""; // stores one available video url
                                            $imageNums    = 0 ; // stores the number of images in slider
                                            $videoNums    = 0 ; // stores the number of videos in slider
                                            
                                            // if display type is flex slider
                                            if($display_type == "flexslider1" || $display_type == "flexslider2"){
                                                
                                                $flexslider_effect = ($display_type == "flexslider1")?"fade":"slide";
                                                
                                                // get all image links and print flexslider shortcode
                                                $slider  = '[flexslider slideshow="no" effect="'.$flexslider_effect.'" smooth_height="yes" ]';
                                                
                                                for ($i=1; $i <= 3; $i++) { 
                                                    $vid_url = get_post_meta($post->ID, "axi_vimeo_link".$i, true);
                                                    if(!empty($vid_url)){
                                                        ++$videoNums;
                                                        $live_vid_url = $vid_url;
                                                        $slider .= '[simple_slide video="'.$vid_url.'"  ]';
                                                    }
                                                }
                                                
                                                for ($i=1; $i <= 12; $i++) { 
                                                    $img_url = get_post_meta($post->ID, "axi_custom_image".$i, true);
                                                    if(!empty($img_url)){
                                                        ++$imageNums;
                                                        $img_url      = axiom_get_the_absolute_image_url($img_url);
                                                        $live_img_url = axiom_get_the_resized_image_src($img_url, $size[0], $size[1], true );
                                                        $slider .= '[simple_slide src="'.$live_img_url.'"  ]';
                                                    }
                                                }
                                                
                                                $slider .= '[/flexslider]';
                                            
                                            // if display type is nivo slider
                                            }elseif($display_type == "nivoslider"){
                                                
                                                // get all image links and print nivoslider shortcode
                                                $slider  = '[nivoslider ]';
                                                for ($i=1; $i <= 12; $i++) { 
                                                    $img_url = get_post_meta($post->ID, "axi_custom_image".$i, true);
                                                    if(!empty($img_url)){
                                                        ++$imageNums;
                                                        $img_url      = axiom_get_the_absolute_image_url($img_url);
                                                        $live_img_url = axiom_get_the_resized_image_src($img_url, $size[0], $size[1], true );
                                                        $slider .= '[nivo_slide src="'.$live_img_url.'"  ]';
                                                    }
                                                }
                                                
                                                $slider .= '[/nivoslider]';
                                            
                                            // if display type is regular
                                            }else{
                                                // output the videos 
                                                for ($i=1; $i <= 3; $i++) { 
                                                    $vid_url = get_post_meta($post->ID, "axi_vimeo_link".$i, true);
                                                    if(!empty($vid_url)){
                                                        ++$videoNums;
                                                        echo do_shortcode('[video url="'.$vid_url.'" full="yes" ]').'<div class="hbar"></div>';
                                                    }
                                                }

                                                // output the images
                                                for ($i=1; $i <= 12; $i++) { 
                                                    $img_url = get_post_meta($post->ID, "axi_custom_image".$i, true);
                                                    if(!empty($img_url)){
                                                        $img_url = axiom_get_the_absolute_image_url($img_url);
                                                        $img_url = axiom_get_the_resized_image_src($img_url, $size[0], $size[1], true );
                                                        echo '<div class="imgHolder" ><img src="'.$img_url.'" /></div><div class="hbar"></div>';
                                                    }
                                                }
                                                
                                            }
                                            
                                            
                                            if($imageNums == 1 && $videoNums == 0){ // if there is a single image, do not display slider
                                                echo '<div class="imgHolder" ><img src="'.$live_img_url.'" alt="'.get_the_title().'" /></div>';
                                            } elseif ($videoNums == 1 && $imageNums == 0) {
                                                echo do_shortcode('[video url="'.$live_vid_url.'" full="yes" ]');
                                            } else { //echo $slider;
                                                echo do_shortcode($slider);
                                            }
                                            
                                            
                                            ?>
                                        
                                    </div><!-- media-content -->
                                    
                                    <div class="entry-content">
                                        <?php 
                                        $overview_content = get_the_content();
                                        if(!empty($overview_content)){ ?>
                                        <div class="overview">
                                            <h5><?php _e("Overview", "default"); ?></h5>
                                            <?php echo do_shortcode($overview_content); ?>
                                        </div>
                                        <?php } unset($overview_content); ?>
                                        
                                        <div class="single-info">
                                            <div class="sep hbar"> </div>
                                            <ul class="meta-folio">
                                        <?php // get label and value of custom product datas
                                            for ($i=1; $i <= 9; $i++) {
                                                // get labels from theme options
                                                if(!isset($axiom_options['portfolio_custom_meta_label'.$i])) continue;
                                                $meta_label = $axiom_options['portfolio_custom_meta_label'.$i] ;
                                                if(empty($meta_label)) continue;
                                                
                                                // get portfolio meta values and print
                                                $meta_val = get_post_meta($post->ID, 'axi_portfolio_custom_data'.$i, true);
                                                if(empty($meta_val)) continue;
                                                echo '<li><strong>'.$meta_label.' : </strong>'.$meta_val;
                                            }
                                            
                                            $project_link  = get_post_meta($post->ID, 'project-link', true);
                                            
                                            if(!empty($project_link)){
                                                $project_label = get_post_meta($post->ID, 'project-link-label', true);
                                                $project_label = !empty($project_label)?$project_label:$project_link;
                                        ?>
                                                <li><strong><?php _e("Project's Link", 'default'); ?> : </strong><a href="<?php echo $project_link; ?>"><?php echo $project_label; ?></a></li>
                                        <?php } ?>
                                            </ul>
                                        <?php if(isset($axiom_options["portfolio_show_share_btns"])){ ?>
                                            <ul class="socials">
                                                <li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" class="icon-facebook-sign" target="_blank" > </a>
                                                <li><a href="http://www.twitter.com/share?url=<?php the_permalink(); ?>" class="icon-twitter" target="_blank" > </a>
                                            </ul>
                                        <?php } ?>
                                        </div>
                                        
                                        
                                    </div><!-- entry-content -->
                                    
                                    
                                </div><!-- entry-wrapper -->
                                
                            </article><!-- widget-container -->
