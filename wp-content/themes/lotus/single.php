<?php
/* The Template for displaying all single posts. */
global $axiom_options, $post;

$layout = axiom_get_page_sidebar_pos($post->ID);

switch (get_post_type()) {
	case 'portfolio':
		$layout = "no-sidebar";
		break;
	case 'axi_product':
        $layout = "no-sidebar";
        break;
    case 'post':
        $layout = isset($axiom_options["blog_sidebar_position"])?$axiom_options["blog_sidebar_position"]:"right-sidebar";
        break;
    case 'news':
        $layout = isset($axiom_options["news_sidebar_position"])?$axiom_options["news_sidebar_position"]:"right-sidebar";
        break;
}
if(empty($layout)) $layout = "right-sidebar";
?>

<?php get_header(); ?>
<?php //include 'slider.php'; ?>
            
    <div id="main" class="<?php echo $layout; ?>" >
        <div class="wrapper fold clearfix">
            
            
            <section id="primary" >
                <div class="content" role="main"  >
                    
                    <?php if (have_posts()) : ?>

                        <?php get_template_part('inc/single', get_post_type() ); ?>
                        
                        <?php if(get_post_type() != "pricetable")
                            comments_template( '/comments.php', true ); ?> 
                        
                    <?php else : ?>
                    
                        <?php get_template_part('inc/content', 'none' ); ?>
                    
                    <?php endif; ?>
                    
                </div><!-- end content -->
            </section><!-- end primary -->
            

            <?php get_sidebar(); ?>

            
        </div>
    </div><!-- end main -->
    
<?php get_sidebar('footer'); ?>
<?php get_footer(); ?>