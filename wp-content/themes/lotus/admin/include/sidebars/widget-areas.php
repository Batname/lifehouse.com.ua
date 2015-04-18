<?php

/*===================================================================================
 *	Register widgetized areas
 *===================================================================================*/

function axiom_theme_widgets_init() {

//---- Default sidebar widget areas --------------------------------------

	// Located at the top of all post types and pages.
	register_sidebar( array(
		'name'          => __( 'Global Widget Area', 'default' ),
		'id'            => 'axiom-global-sidebar-widget-area',
		'description'   => __( 'This sidebar displays on all post and pages.' , 'default' ),
		'before_widget' => '<article id="%1$s" class="widget-container %2$s">',
		'after_widget'  => '</article>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	) );
	
	// This widget area displays on blog sidebar
	register_sidebar( array(
		'name'          => __( 'Blog Widget Area' , 'default' ),
		'id'            => 'axiom-blog-sidebar-widget-area',
		'description'   => __( 'Displays on blog sidebar.' , 'default' ),
		'before_widget' => '<article id="%1$s" class="widget-container %2$s">',
		'after_widget'  => '</article>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	) );
    
    // This widget area displays on news sidebar
    register_sidebar( array(
        'name'          => __( 'News Widget Area' , 'default' ),
        'id'            => 'axiom-news-sidebar-widget-area',
        'description'   => __( 'Displays on news sidebar.' , 'default' ),
        'before_widget' => '<article id="%1$s" class="widget-container %2$s">',
        'after_widget'  => '</article>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>'
    ) );
    
    // This widget area displays on news sidebar
    register_sidebar( array(
        'name'          => __( 'Search Widget Area' , 'default' ),
        'id'            => 'axiom-search-sidebar-widget-area',
        'description'   => __( 'Displays on search resault page.' , 'default' ),
        'before_widget' => '<article id="%1$s" class="widget-container %2$s">',
        'after_widget'  => '</article>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>'
    ) );
	
    
//---- Footer sidebar widget areas --------------------------------------
    
    // get number of active subfooters
    // user can change this number via option panel
    $col_nums     = axiom_get_active_footer_columns();
    $footer_names = array("First", "Second", "Third", "Fourth");
    
    for ($i=1; $i <= $col_nums; $i++) {
        
        register_sidebar( array(
            'name'          => __( 'Footer '.$footer_names[$i-1].' Widget Area', 'default' ),
            'id'            => 'axiom-footer'.$i.'-sidebar-widget-area',
            'description'   => __( 'The '.$footer_names[$i-1].' Column in Footer.' , 'default' ),
            'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>'
        ) );
    }
    
    unset($col_nums ,$footer_names);


//---- Sidebar generator -------------------------------------------------------------
    
    // get and register all user define sidebars
    $axiom_sidebars = get_option( THEME_ID.'_sidebars');
    
    if(isset($axiom_sidebars)  && !empty($axiom_sidebars)) {
        foreach($axiom_sidebars as $key => $value) {
            $sidebar_id = THEME_ID .'-'. strtolower(str_replace(' ', '-', $value));
            
            register_sidebar( array(
                'name'          => __( $value , 'default' ),
                'id'            => $sidebar_id,
                'description'   => '',
                'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            ) );
            
        }
    }
}

add_action( 'widgets_init', 'axiom_theme_widgets_init' );

?>