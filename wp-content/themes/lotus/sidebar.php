<?php
	/* The sidebar widget area is triggered if any of the areas have widgets. */
    if(is_404()) return;
    global $this_page;
    
    // if no resault
    if(!isset($this_page) || is_search() ) {
?>

            <aside class="sidebar" role="complementary">
                <div class="sidebar_inner">
                    <section >
    
<?php if ( is_active_sidebar( 'axiom-global-sidebar-widget-area' ) ) : ?>       
                        <section class="widget-area">       
                            <?php dynamic_sidebar( 'axiom-global-sidebar-widget-area' ); ?>
                        </section>
<?php endif; ?>

<?php if ( is_active_sidebar( 'axiom-search-sidebar-widget-area' ) ) : ?>       
                        <section class="widget-area">       
                            <?php dynamic_sidebar( 'axiom-search-sidebar-widget-area' ); ?>
                        </section>
<?php endif; ?>
                        
                    </section>
                    
                </div><!-- end sidebar wrapper -->
            </aside><!-- end siderbar -->

<?php
        return;
    }
    
    
    
    
    
    $this_temp_name = get_post_meta( $this_page->ID, '_wp_page_template', TRUE );
    $this_page_type = $this_page->post_type;
?>



<?php if( !axiom_is_fullwidth($this_page->ID) || ($this_page_type == 'post') || ($this_page_type == 'news') ) { ?>

            <aside class="sidebar" role="complementary">
                <div class="sidebar_inner">
					<section >
	
<?php if ( is_active_sidebar( 'axiom-global-sidebar-widget-area' ) ) : ?>		
						<section class="widget-area">		
							<?php dynamic_sidebar( 'axiom-global-sidebar-widget-area' ); ?>
						</section>
<?php endif; ?>
	
	
<?php if ( ($this_page_type == 'news' || strpos($this_temp_name, "news") !== false ) && is_active_sidebar( 'axiom-news-sidebar-widget-area' ) ) : ?>		
						<section class="widget-area">
							<?php dynamic_sidebar( 'axiom-news-sidebar-widget-area' ); ?>
						</section>
<?php endif; ?>


<?php if ( ($this_page_type == 'post' || strpos($this_temp_name, "blog") !== false ) && is_active_sidebar( 'axiom-blog-sidebar-widget-area' ) ) : ?>        
                        <section class="widget-area">
                            <?php dynamic_sidebar( 'axiom-blog-sidebar-widget-area' ); ?>
                        </section>
<?php endif; ?>


<?php $sidebar_id = esc_attr( get_post_meta( $post->ID, 'sidebar-id', true ) );
if(isset($sidebar_id) && !empty($sidebar_id) && is_active_sidebar($sidebar_id) && function_exists('dynamic_sidebar') ){ ?>
                        <section class="widget-area">
                            <?php dynamic_sidebar( $sidebar_id ); ?>
                        </section>
<?php } ?>
						
				    </section>
				    
                </div><!-- end sidebar wrapper -->
            </aside><!-- end siderbar -->

<?php } ?>
