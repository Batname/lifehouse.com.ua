<?php

require('admin/include/index.php');

/*-----------------------------------------------------------------------------------*/
/*	Setup Header 
/*-----------------------------------------------------------------------------------*/

function after_axiom_fw_setup(){
    
    /*	Add Post Thumbnails
    /*------------------------------------------------------------------------------*/
    if ( function_exists( 'add_theme_support' ) ) {
    	add_theme_support( 'post-thumbnails' , array( 'post', 'page', 'portfolio', 'axi_product', 'news', 'staff', 'testimonial'));
    	set_post_thumbnail_size( 280, 180, true ); // Featured image display size
    	
    	// add_image_size( '80_1' , 80 , 80  , TRUE  ); // Mini posts thumb 
    }
    
    
    /*  Add Post Formats
    /*------------------------------------------------------------------------------*/
    add_theme_support('post-formats', array('aside', 'gallery', 'image', 'link', 'quote', 'video', 'audio'));
    
    
    /*  Adds RSS feed links to <head> for posts and comments.
    /*------------------------------------------------------------------------------*/
    add_theme_support( 'automatic-feed-links' );
    
    
    /*  Register Theme menus
    /*------------------------------------------------------------------------------*/
    if( has_nav_menu('primary')) unregister_nav_menu('primary'); 
    
    // Adds Header menu
    register_nav_menu( 'primary' , __( 'Header Navigation', 'default' ) );
    
    // adds Footer menu
    register_nav_menu( 'footer' , __( 'Footer Navigation', 'default' ) );
    
    
    /*  Config excerpts length
    /*------------------------------------------------------------------------------*/
    add_filter( 'excerpt_length'  , 'av3_excerpt_length' );
    add_filter( 'excerpt_more'    , 'av3_auto_excerpt_more' );
    
    // gererate shortcodes in widget text
    add_filter('widget_text', 'do_shortcode');
    //add_filter( 'get_the_excerpt' , 'av3_custom_excerpt_more' );
    
    remove_filter('get_the_excerpt', 'wp_trim_excerpt');
    add_filter( 'get_the_excerpt'  , 'axiom_trim_excerpt');
    
    
    /*  Make theme available for translation
    /*------------------------------------------------------------------------------*/
    /* Translations can be added to the /languages/ directory. */
    load_theme_textdomain( 'default', get_template_directory() . '/languages' );

    $locale = get_locale();
    $locale_file = get_template_directory() . "/languages/$locale.php";
    if ( is_readable( $locale_file ) )
        require_once( $locale_file );
    
    
    ini_set( 'max_execution_time', '500' );
}

add_action( 'after_setup_theme', 'after_axiom_fw_setup' );

	
/*-----------------------------------------------------------------------------------*/
/*	Excerpt configuration
/*-----------------------------------------------------------------------------------*/

	
// Customizing excerpt length
function av3_excerpt_length( $length ) {
	return 30;
}

// Returns a "Read more..." link for excerpts
function av3_continue_reading_link() {
	return ' <a class="more" href="'. get_permalink() . '">' . __( 'Read more', 'default' ) . '</a>';
}

// Appended "[...]" to automatically generated excerpts
function av3_auto_excerpt_more( $more ) {
	if ( get_post_type() != 'portfolio' ) {
		return ' ...'; //av3_continue_reading_link().'...';
	}else{
		return '';
	}
}

// Adds "Read more" link to custom post excerpts.
function av3_custom_excerpt_more( $output ) {
	if ( has_excerpt() && get_post_type() != 'portfolio' ) {
		$output .= av3_continue_reading_link();
	}
	return $output;
}  

// make shortcodes executable in excerpt
function axiom_trim_excerpt($text = '')
{
    $raw_excerpt = $text;
    if ( '' == $text ) {
        $text = get_the_content('');
        
        //$text = strip_shortcodes( $text );
 
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]&gt;', ']]&gt;', $text);
        $excerpt_length = apply_filters('excerpt_length', 55);
        $excerpt_more   = apply_filters('excerpt_more', ' ' . '[...]');
        $text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
    }
    return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}



/*-----------------------------------------------------------------------------------*/
/*  Dashboard "Right Now" modification
/*-----------------------------------------------------------------------------------*/

function axiom_add_posttypes_2_rightnow() {    
    $post_types = get_post_types( array( '_builtin' => false ), 'objects' ); 
    
    if (count($post_types) > 0)
    foreach( $post_types as $pt => $args ) {
        if($pt == "staff" || $pt == "service" || $pt == "slider" || $pt == "pricetable" ) continue;
        $url = 'edit.php?post_type='.$pt;
        echo '<tr><td class="b"><a href="'. $url .'">'. wp_count_posts( $pt )->publish .'</a></td><td class="t"><a href="'. $url .'">'. $args->labels->name .'</a></td></tr>';
    }
}  

add_action( 'right_now_content_table_end', 'axiom_add_posttypes_2_rightnow' );


/*-----------------------------------------------------------------------------------*/
/*  Prints Widget Title
/*-----------------------------------------------------------------------------------*/

function get_widget_title($title, $nav = "", $filters = NULL){
    
    ob_start();
?>                             <header class="widget-title-bar">
<?php if(!empty($title))  { ?>      <h3 class="widget-title"><?php echo $title; ?></h3>
<?php } ?>
<?php if($nav == "pagination"){ ?>
                                   <div class="widget-nav pagination">
                                       <a href="" class="w_next">next</a>
                                       <a href="" class="w_prev">previous</a>
                                   </div><!-- widget-nav -->
<?php }else if($nav == "filterable" && is_array($filters) ) { ?>
                                   <div class="widget-nav filterable">
                                       <a href="" class="active" data-filter="all" ><?php _e("All", "default");?></a><span>/</span>
                                       <?php // loop throuth an array contains filters
                                       $len = count($filters);
                                       $counter = 0; // create a counter to add diffrent style for last filter
                                       foreach ($filters as $key => $value) {
                                           ++$counter;
                                       echo '<a href="" data-filter="'.$key.'" >'.$value.'</a>';
                                       echo ($counter < $len)?"<span>/</span>":"";
                                       } ?>
                                   </div><!-- widget-nav -->
<?php } ?>                      </header><!-- widget-title-bar -->                                
<?php
    return ob_get_clean();
} 

/*-----------------------------------------------------------------------------------*/
/*  Comments Template
/*-----------------------------------------------------------------------------------*/

function axiom_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li>
     <article <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
       <?php echo get_avatar($comment,'54', '' ); ?>
       <header class="comment-author vcard">
          <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
          <time><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s', 'default'), get_comment_date(),  get_comment_time()) ?></a></time>
          <?php if ($comment->comment_approved == '0') : ?>
              <em><?php _e('Your comment is awaiting moderation.', 'default') ?></em>
              <br />
           <?php endif; ?>
          <?php edit_comment_link(__('(Edit)', 'default'),'  ','') ?>
       </header>
       
       <div class="comment-body">
           <?php comment_text() ?>
       </div>

       <nav>
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
       </nav>
     </article>
    <!-- </li> is added by wordpress automatically -->
<?php
}

/*-----------------------------------------------------------------------------------*/
/*  Add some user contact fields
/*-----------------------------------------------------------------------------------*/

add_filter('user_contactmethods', 'axiom_user_contactmethods');

function axiom_user_contactmethods($user_contactmethods){
  $user_contactmethods['twitter']    = 'Twitter';
  $user_contactmethods['facebook']   = 'Facebook ';
  $user_contactmethods['googleplus'] = 'Google Plus';
  $user_contactmethods['skills']     = 'Skills';
  return $user_contactmethods;
}

/*-----------------------------------------------------------------------------------*/
/*  Get trimmed string
/*-----------------------------------------------------------------------------------*/

function axiom_get_trimmed_string($string, $max_length = 1000, $more = " ..."){
    return (strlen($string) > $max_length) ? substr($string,0,($max_length - strlen($more))).$more : $string;
}

function axiom_the_trimmed_string($string, $max_length = 1000, $more = " ..."){
    echo axiom_get_trimmed_string($string, $max_length, $more);
}



?>