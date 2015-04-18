<?php $pos = get_post_meta($post->ID, 'axi_staff_position', true).get_post_meta($post->ID, 'axi_staff_occupation', true); ?>
                            
                            <article class="hentry type-staff block">
                                
                                <div class="entry-wrapper">
                                    <?php if(has_post_thumbnail()){ ?>
                                    <div class="entry-media one_half">
                                        
                                        <div class="imgHolder">
                                            <?php the_post_thumbnail('635');?>
                                        </div>
                                        
                                    </div><!-- media-content -->
                                    <?php } ?>
                                    <div class="entry-content <?php echo (has_post_thumbnail())?"one_half":"one_one";?>">
                                        
                                        <header class="entry-header">
                                                <h3 class="entry-title"><?php the_title(); ?></h3>
                                                <h5 class="entry-title2"><?php echo $pos; ?></h5>
                                        </header><!-- entry-header -->
                                        
                                        <ul class="socials">
                                            <?php $sc_btn = get_post_meta($post->ID, 'axi_staff_facebook', true);  if(!empty($sc_btn)) { ?>
                                            <li><a href="<?php echo $sc_btn; ?>" class="icon-facebook-sign" target="_blank" > </a>
                                            <?php } $sc_btn = get_post_meta($post->ID, 'axi_staff_twitter', true); if(!empty($sc_btn)) { ?>
                                            <li><a href="<?php echo $sc_btn; ?>" class="icon-twitter" target="_blank" > </a>
                                            <?php } $sc_btn = get_post_meta($post->ID, 'axi_staff_gplus', true);   if(!empty($sc_btn)) { ?>
                                            <li><a href="<?php echo $sc_btn; ?>" class="icon-google-plus-sign" target="_blank" > </a>
                                            <?php } $sc_btn = get_post_meta($post->ID, 'axi_staff_linkedin', true);   if(!empty($sc_btn)) { ?>
                                            <li><a href="<?php echo $sc_btn; ?>" class="icon-linkedin" target="_blank" > </a>
                                            <?php } $sc_btn = get_post_meta($post->ID, 'axi_staff_website', true);   if(!empty($sc_btn)) { ?>
                                            <li><a href="<?php echo $sc_btn; ?>" class="icon-link" target="_blank" > </a>
                                            <?php } $sc_btn = get_post_meta($post->ID, 'axi_staff_email', true);   if(!empty($sc_btn)) { ?>
                                            <li><a href="<?php echo "mailto:".$sc_btn; ?>" class="icon-envelope" target="_blank" > </a>
                                            <?php } ?>
                                        </ul>
                                        
                                        <div class="overview">
                                            <?php the_content(); ?>
                                        </div>
                                        
    
                                    </div><!-- entry-content -->
                                    
                                    
                                </div><!-- entry-wrapper -->
                                
                            </article><!-- widget-container -->