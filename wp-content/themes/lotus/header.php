<?php
/* The Header for theme.
 * Displays all of the <head> section and everything up till <div id="main"> */
?>
<!DOCTYPE html>
<!--[if IE 7]>    <html class="no-js oldie ie7 ie" <?php language_attributes(); ?> > <![endif]-->
<!--[if IE 8]>    <html class="no-js oldie ie8 ie" <?php language_attributes(); ?> > <![endif]-->
<!--[if IE 9 ]>   <html class="no-js       ie9 ie" <?php language_attributes(); ?> > <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="no-js" <?php language_attributes(); ?> > <!--<![endif]-->
<head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" >
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title><?php
        /* Print the <title> tag based on what is being viewed. */
        global $page, $paged, $post, $axiom_options, $this_page;
        $this_page = $post;
        
        wp_title( '|', true, 'right' );
        
        // Add the blog name.
        bloginfo( 'name' );
        
        // Add the blog description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
        	echo " | $site_description";
        
        // Add a page number if necessary:
        if ( $paged >= 2 || $page >= 2 )
        	echo ' | ' . sprintf( __( 'Page %s', 'default' ), max( $paged, $page ) );
        
        ?></title>
	
        <!-- devices setting -->
        <meta name="viewport"           content="initial-scale=1,user-scalable=no,width=device-width">
	
        <!-- Microsoft cleartype rendering -->
        <meta http-equiv="cleartype"    content="on">
        <meta name="author"             content="">
	
        <!-- feeds, pingback -->
        <link rel="profile"             href="http://gmpg.org/xfn/11" />
        <link rel="alternate"           href="<?php bloginfo( 'rss2_url'); ?>" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS2 Feed" />  
        <link rel="pingback"            href="<?php bloginfo( 'pingback_url' ); ?>" />
        <?php  if( isset($axiom_options["site_favicon_16"]) && !empty($axiom_options["site_favicon_16"]) ) { ?>
        <!-- favicon -->
        <link rel="shortcut icon"       href="<?php echo $axiom_options["site_favicon_16"]; ?>" >
        <?php } ?>
        
<?php $subset = get_option( THEME_ID. '_font_subsets'); 
      $subset = empty($subset)?"":"&subset=". $subset;
?>
        <link rel="stylesheet"          href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800<?php echo $subset; ?>' >
        
        <!-- stylesheets -->
        <link rel="stylesheet"          href="<?php echo get_template_directory_uri(); ?>/css/base.css?ver=3.2"      type="text/css" media="screen"/>
        <link rel="stylesheet"          href="<?php echo get_template_directory_uri(); ?>/css/main.css?ver=1.1"      type="text/css" media="all" />
        <link rel="stylesheet"          href="<?php echo get_template_directory_uri(); ?>/css/other/superfish.css?ver=1.3" type="text/css" media="screen"/>
<?php  if( isset($axiom_options["enable_site_reponsiveness"])) { ?>
        <link rel="stylesheet"          href="<?php echo get_template_directory_uri(); ?>/css/responsive.css?ver=1.0"      type="text/css" media="all" />
<?php } ?>
        <link rel="stylesheet"          href="<?php echo get_template_directory_uri(); ?>/css/fonts.css?ver=1.3"     type="text/css" />
        <link rel="stylesheet"          href="<?php echo get_stylesheet_directory_uri(); ?>/style.css?ver=1.4"       type="text/css" media="all" />
        
        
        <!--[if IE 7]>
            <link rel="stylesheet"      href="<?php echo get_template_directory_uri(); ?>/css/ie7.css?ver=3.0" type="text/css" media="screen"/>
        <![endif]-->
        
        <!-- enables HTML5 elements & feature detects -->
        <script src="<?php echo get_template_directory_uri(); ?>/js/libs/modernizr-2.6.2.min.js"></script>
    
<!-- outputs by wp_head -->
<?php
	if ( is_singular() && get_option( 'thread_comments' ) )	 wp_enqueue_script( 'comment-reply' );
	wp_head();
?>
<!-- end wp_head -->

<?php // a fallback for inline printing of option panel styles
    axi_print_option_panel_styles_fallback(); ?> 

<!-- custom styles for plugins -->
<link rel="stylesheet"  href="<?php echo get_template_directory_uri(); ?>/css/other/overwrite.css?ver=1.5" type="text/css" media="screen"/>

<?php // print custom background styles if it is available
    axi_print_custom_background_style(); ?> 
    
<!-- Media query for old IE
[if lt IE 9]><script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/libs/modules/css3-mediaqueries.js"></script><![endif]-->

</head>



<?php $isBoxed = (isset($axiom_options['site_layout_style']) && $axiom_options['site_layout_style'] == "boxed")?"boxed":"";  ?>
<body <?php body_class($isBoxed); ?> >
<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
<div id="inner-body">
    
    <?php  if( isset($axiom_options["show_topheader"])) { ?>
    <div id="top-header">
        <div class="container fold">
            

            
            <?php  if( isset($axiom_options["show_search_in_header"]) || isset($axiom_options["show_socials_in_header"]) ) { ?>
            <div class="header-tools">
                
                <?php  if( isset($axiom_options["show_search_in_header"]) ) { ?>
                <div id="searchform">
                    <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
                        <input type="text" id="s" placeholder="<?php esc_attr_e( '......', 'default' ); ?>" name="s" />
                    </form>
                </div><!-- end searchform -->
                <?php } ?>
                
                <?php if( isset($axiom_options["show_socials_in_header"]) ) echo axiom_the_socials(); ?>
                
                <?php language_selector_flags(); ?> 
				 
				 
				<?php  if( !empty($axiom_options["topheader_message"]) ) {
                // display top header message 
                echo   '<div class="header_massage">'.stripslashes($axiom_options["topheader_message"]).'</div>';
            } ?>
			    
                
            </div><!-- end header tools -->
            <?php } ?>
            
        </div><!-- end container -->
    </div><!-- end top header -->
    <?php } ?>
    
    
    <header id="siteheader" role="banner" class="wrapper">
        <div class="container">
	  	
        <div id="sitetitle">
            <div id="logo" class="fold" >
                <div class="logo_inner">
                    <hgroup>
                        <h2 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
                        <h3 class="site-description"><?php bloginfo( 'description' ); ?></h3>
                    </hgroup>
                    <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                        <?php if(!empty($axiom_options["site_header_logo"])){
                                
                            $img2x = '';
                            if(isset($axiom_options["site_header_logo_2x"]) && !empty($axiom_options["site_header_logo_2x"])){
                                $img2x = 'data-image2x="'. $axiom_options["site_header_logo_2x"]. '"';
                            } 
                        ?>
                        <img src="<?php echo $axiom_options["site_header_logo"]; ?>" <?php echo $img2x; ?>  alt="<?php bloginfo( 'name' ); ?>" />
                        <?php } ?>
                    </a>
                </div><!-- end logo inner -->
                
                <div class="nav-toggle"><a href="#"></a></div>
            </div><!-- end logo fold -->
        </div><!-- end #sitetitle -->


<!-- start navigation -->
<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
<?php wp_nav_menu( array( 
	
	'container' => 'nav',
	'container_id' => 'access',
	'menu_id' => '',
	'menu_class' => 'sf-menu',
	'theme_location' => 'primary' 
	)); 
?>
<!-- end navigation -->

			
        </div><!-- end of container -->
    </header><!-- end header -->

<?php layerslider(10, '122'); ?> 
<?php layerslider(10, '2499'); ?> 
<?php layerslider(10, '2498'); ?> 

    
    <?php axiom_the_main_title(); ?>
    

    <?php axiom_the_header_slider($post); ?>  
    
    
    <?php axiom_the_content_top_margin(); ?>
    