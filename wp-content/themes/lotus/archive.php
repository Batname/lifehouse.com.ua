<?php
/* The Template for displaying all posttype items. */

global $post;

$archive_class  = 'right-sidebar ';
$archive_class .= isset($post)?"list-".get_post_type($post->ID).' '.$post->ID:""; ?>

<?php get_header(); ?>
    
    <div id="main" class="<?php echo $archive_class; ?>" >
        <div class="wrapper fold clearfix">
            
            
            <section id="primary" >
                <div class="content" role="main" data-target="archive"  >
            
            <?php if (have_posts()) : ?>     
                        
                    <?php get_template_part('inc/loop', get_post_type() ); ?>
                            
            <?php else : ?>
                    
                    <?php get_template_part('inc/content', 'none' );?>
                    
            <?php endif; ?>
                    
                </div><!-- end content -->
            </section><!-- end primary -->
            
            
            <?php get_sidebar(); ?>
            
        </div>
    </div><!-- end main -->
    
<?php get_sidebar('footer'); ?>
<?php get_footer(); ?>