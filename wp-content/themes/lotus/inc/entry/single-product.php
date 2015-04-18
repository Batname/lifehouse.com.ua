<?php 
    global $axiom_options, $axi_img_size; 
    $axi_layout = axiom_get_page_sidebar_pos($post->ID);
    $size  = ($axi_layout != "no-sidebar")?$axi_img_size["side"]:$axi_img_size["full"];
?>                            
                            
                            <article <?php post_class(axiom_get_page_layout($post->ID));?> >
                                
                                <div class="entry-wrapper">
                                    
                                    <div class="entry-media">
                                        
                                            <?php 
                                              $media_type = get_post_meta( $post->ID, 'product-media-type', true );  
                                              $media_type = "slider";
                                            
                                              if($media_type == "slider"){
                                                    
                                                    // get images display type
                                                    $display_type = get_post_meta($post->ID, "display_type", true);
                                                    
                                                    $slider       = "";
                                                    $live_img_url = ""; // stores one available image url
                                                    $imageNums    = 0 ; // stores the number of images in slider
                                                    
                                                    // if display type is slider
                                                    if($display_type == "flexslider1" || $display_type == "flexslider2"){
                                                        
                                                        $flexslider_effect = ($display_type == "flexslider1")?"fade":"slide";
                                                        
                                                        // get all image links and print flexslider shortcode
                                                        $slider  = '[flexslider uid="single-product-slider" sync="#single-product-carousel"  slideshow="no" smooth_height="yes" effect="'.$flexslider_effect.'" ]';
                                                        for ($i=1; $i <= 10; $i++) { 
                                                            $img_url = get_post_meta($post->ID, "axi_custom_image".$i, true);
                                                            if(!empty($img_url)){
                                                                ++$imageNums;
                                                                $img_url      = axiom_get_the_absolute_image_url($img_url);
                                                                $live_img_url = axiom_get_the_resized_image_src($img_url, $size[0], $size[1], true );
                                                                $slider .= '[simple_slide src="'.$live_img_url.'"  ]';
                                                            }
                                                        }
                                                        
                                                        if($imageNums == 1){ // if there is a single image, do not display slider
                                                            echo '<div class="imgHolder" ><img src="'.$live_img_url.'" alt="'.get_the_title().'" />';
                                                        } else { //echo $slider;
                                                            $slider .= '[/flexslider]';
                                                            echo do_shortcode($slider);
                                                        }
                                                    
                                                    // if display type is regular
                                                    } else {
                                                        
                                                        for ($i=1; $i <= 10; $i++) { 
                                                            $img_url = get_post_meta($post->ID, "axi_custom_image".$i, true);
                                                            if(!empty($img_url)){
                                                                echo '<div class="imgHolder" ><img src="'.axiom_get_the_resized_image_src($img_url, $size[0], $size[1], true ).'" /></div><div class="hbar"></div>';
                                                            }
                                                        }
                                                        
                                                    }
                                            
                                            }elseif($media_type == "video"){ ?>
                                                
                                             
                                            <?php }else { ?>
                                                
                                                <?php the_post_thumbnail('635'); ?>
                                                
                                            <?php } ?>
                                        
                                    </div><!-- media-content -->
                                    
                                    <div class="entry-content">
                                        
                                        <div class="single-info">
                                            
                                            <ul class="meta-product">
                                                
                                        <?php // get and print product price
                                            $pr_overview = get_post_meta( $post->ID, 'axi-product-overview', true );
                                             
                                            if(!empty($pr_overview)) { ?>
                                                <li><?php echo $pr_overview; ?><br /></li>
                                        <?php } unset($pr_overview); ?>
                                                
                                                <li><span class="current-price"><?php echo get_post_meta( $post->ID, 'product-price', true ); ?></span>
                                                
                                        <?php // get and print product price
                                            $reg_price = get_post_meta( $post->ID, 'product-reg-price', true );
                                             
                                            if(!empty($reg_price)) { ?>
                                                <li><strong><?php _e( $axiom_options['product_regular_price_label'], 'default'); ?> : </strong><del><?php echo get_post_meta( $post->ID, 'product-reg-price', true ); ?></del>
                                        <?php } unset($reg_price); ?>
                                              
                                                
                                        <?php // get label and value of custom product datas
                                            for ($i=1; $i <= 10; $i++) {
                                                // get labels from theme options
                                                if(!isset($axiom_options['product_custom_meta_label_0_'.$i])) continue;
                                                $meta_label = $axiom_options['product_custom_meta_label_0_'.$i] ;
                                                if(empty($meta_label)) continue;
                                                
                                                // get product meta values and print
                                                $meta_val = get_post_meta($post->ID, 'axi_product_custom_data'.$i, true);
                                                if(empty($meta_val)) continue;
                                                echo '<li><strong>'.$meta_label.' : </strong>'.$meta_val;
                                            }
                                        ?>
                                        
                                        
                                        <?php // get and print product price
                                            $p_instock = get_post_meta( $post->ID, 'product-in-stock', true );
                                             
                                            if($p_instock == 'yes') {
                                                echo '<li><strong class="p_stock_label" >'.__( 'In Stock', 'default').'</strong>';
                                            } unset($p_instock); 
                                        ?>
                                                
                                            </ul>
                                        <?php if(isset($axiom_options["product_show_share_btns"])){ ?>
                                            <ul class="socials">
                                                <li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" class="icon-facebook-sign" target="_blank" > </a>
                                                <li><a href="http://www.twitter.com/share?url=<?php the_permalink(); ?>" class="icon-twitter" target="_blank" > </a>
                                            </ul>
                                        <?php } ?>
                                            
                                        <?php // get and print buy now button link
                                            $p_buylink = get_post_meta( $post->ID, 'product-buy-link', true );
                                            $p_buylink = esc_url($p_buylink);
                                            $buy_p_label = isset($axiom_options['product_buy_btn_label'])?$axiom_options['product_buy_btn_label']:"Buy Now";
                                            
                                            if(!empty($p_buylink)) {
                                        ?>
                                            <div class="buy-btn">
                                                <a href="<?php echo $p_buylink; ?>" class="button flat"><?php echo $buy_p_label; ?></a>
                                            </div>
                                        <?php } unset($p_buylink); ?>
                                            
                                        </div><!-- single-info -->
                                        
                                        <?php // display slider thumbs if display type is slider
                                        // get images display type
                                        $display_type = get_post_meta($post->ID, "display_type", true);
                                        
                                        if($display_type == "flexslider1" || $display_type == "flexslider2"){ ?>
                                        
                                        <section class="flex-container">
                                            <div id="single-product-carousel" class="flexslider flex-carousel" data-sync="" data-navfor="#single-product-slider" data-minitems="0" 
                                                data-maxitems="0" data-itemwidth="60" data-itemmargin="2" >
                                                
                                                <header class="widget-title-bar">
                                                   <h5 class="widget-title"><?php _e("Other views", "default" );?></h5>
                                                   <div class="widget-nav pagination">
                                                       <a href="" class="w_next"><?php __("next", "default" );?></a>
                                                       <a href="" class="w_prev disabled"><?php __("previous", "default" );?></a>
                                                   </div><!-- widget-nav -->
                                               </header>
                                               
                                               <ul class="slides">
                                                    <?php
                                                        for ($i=1; $i <= 10; $i++) { 
                                                            $img_url = get_post_meta($post->ID, "axi_custom_image".$i, true);
                                                            if(!empty($img_url)){
                                                                $img_url = axiom_get_the_absolute_image_url($img_url);
                                                                echo '<li ><img src="'.axiom_get_the_resized_image_src($img_url, 140, 140, true ).'" /></li>';
                                                            }
                                                        }
                                                    ?>
                                               </ul>
                                               
                                            </div><!-- flexslider -->
                                        </section><!-- flexslider container -->
                                        
                                        <script>
                                            jQuery(function($){
                                                $pr_carousel = $('#single-product-carousel');
                                                if(!$pr_carousel.length || $pr_carousel.find(".slides img").length < 2) return ;
                                                
                                                
                                                $pr_carousel.css({ "display":"block" })
                                                            .flexslider({
                                                    animation: "slide",
                                                    controlNav: false,
                                                    directionNav: false, 
                                                    animationLoop: false,
                                                    slideshow: false,
                                                    itemWidth: 60,
                                                    minItems:5,
                                                    maxItems:5,
                                                    itemMargin: 2,
                                                    asNavFor: '#single-product-slider'
                                                  }).flexsliderManualDirectionControls({
                                                      previousElementSelector: ".w_prev",
                                                      nextElementSelector: ".w_next",
                                                      disabledStateClassName: "disabled"
                                                  });
                                                  
                                            });
                                        </script>
                                        
                                        <?php } ?>
                                        
                                    </div><!-- entry-content -->
                                    
                                </div><!-- entry-wrapper -->
                                
                                <div class="clear"></div>
                                
                            </article><!-- widget-container -->
                            
                            <?php $mce_content = get_the_content();
                                
                            if(!empty($mce_content)) { ?>
                            <div class="editor-entry">
                                <?php the_content(); ?>
                            </div>
                            <?php } ?>