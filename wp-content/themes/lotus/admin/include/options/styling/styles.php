<?php // general color styles
    if(isset($styles['enable_custom_general_colors'])) {
?>
/* Custom general styles
 *================================================================== */
a  {
  color: <?php echo $styles['site_general_link_color']; ?>;
}

a:hover {
  color: <?php echo $styles['site_general_link_hover_color']; ?>;
}


.entry-meta .readmore a.linkblock {
  background-color: <?php echo $styles['site_general_link_color']; ?>;
}
a.cell-comment:hover, 
.entry-tax a[rel="category"]:hover,
.entry-meta .readmore a.linkblock:hover {
  background-color: <?php echo $styles['site_general_link_hover_color']; ?>;
}

/* body color ------- */

.right-sidebar .one_half.callout a.featured_btn, 
.left-sidebar .one_half.callout a.featured_btn { border-top-color: <?php echo $styles['site_body_color']; ?>; }

.callout a.featured_btn { border-left-color: <?php echo $styles['site_body_color']; ?>;  }
.widget-pages figure .imgHolder,
.widget-product figure .imgHolder { border-bottom-color: <?php echo $styles['site_body_color']; ?>; }

#inner-body,
.entry-tax ,
.entry-share ,
.divider span ,
#comments h3, .respond-title h3 ,#reply-title span,
#cancel-comment-reply-link ,
.widget-title-bar .widget-title ,
.widget-nav ,
.widget-tabs .tabs > li.active a ,
.type-staff.hentry .entry-content .socials li ,
.widget-product figcaption .item-title a ,
.widget-staff figcaption .item-title a ,
.single-portfolio .right-layout .entry-nav-inner ,
.flexslider .flex-dir-nav.pagination a ,
.flexslider .flex-dir-nav.pagination a.disabled ,
.entry-meta .readmore ,
.widget-pages figcaption .item-title a { background-color: <?php echo $styles['site_body_color']; ?>; }

.widget-tabs .tabs > li.active a { border-bottom-color: <?php echo $styles['site_body_color']; ?>; }


 blockquote ,
.widget-staff figure:hover ,
.widget-staff figure:hover .item-title a ,
.widget-product figure:hover ,
.widget-product figure:hover .item-title a ,
.widget-chart .widget-inner > div  { background-color: <?php echo ColorShader($styles['site_body_color'], 10); ?> }

.widget-staff figcaption .socials a { color: <?php echo ColorShader($styles['site_body_color'], -10); ?> }

@media only screen and (max-width: 767px) {
    .callout a.featured_btn { border-top-color: <?php echo $styles['site_body_color']; ?>; }
}


/* dividers color ------- */
/*.page-header { border-bottom: 1px solid <?php echo $styles['divider_color']; ?>; }*/
hr, .divider { border-color: <?php echo $styles['divider_color']; ?>; }


/* feature color ------- */

aside .widget_nav_menu ul li.current-menu-item { border-left: 2px solid <?php echo $styles['feature_color']; ?>; }


.widget-testimonial .testimonial-author a, 
.subfooter .widget-testimonial .testimonial-author a,
aside.sidebar .widget-container a:hover ,
.cell-date span ,
.socials a:hover ,
.widget-tabs .tabs > li a:hover,
.widget-tabs .tabs > li.active a ,
.widget-staff figcaption p.staff-spes ,
.widget-staff figcaption .socials a:hover ,
.widget-column section > span, .widget-column .col > span ,
.widget-folio.caption-over .imgHolder em h4 ,
.tweet a:hover ,
.tweet .avatar .icon-twitter:hover ,
.single-info ul:first-child a ,
.type-staff.hentry .entry-header .entry-title2 ,
.single-axi_product .single-info .meta-product li .current-price ,
.widget-blog .entry-title a:hover, 
.list-post .entry-title a:hover, 
.widget_recent_blog .entry-title a:hover,
.widget-folio .fig-title a:hover ,
.widget-staff figcaption .item-title a:hover ,
.entry-related .fig-title a:hover ,
#author-description dt a:hover ,
.widget-product figcaption .item-title a:hover ,
.list-news #primary .entry-title a:hover, .single-news #primary .entry-title a:hover,
#axi_breadcrumbs a:hover ,
.subfooter a:hover, .subfooter .entry-title a:hover { color: <?php echo $styles['feature_color']; ?>; }


aside .widget_testimonial .testimonial-author a,
.subfooter .widget_testimonial .testimonial-author a,
.subfooter .tweet .mt_user:hover { color: <?php echo $styles['feature_color']; ?> !important; }

a.more, button.more,
a.linkblock:hover, 
.dropcap.square, 
.dropcap.circle,
.cell-date em ,
.axi_paginate_nav a.page-numbers:hover ,
.entry-meta .readmore .cell-comment, .entry-meta .readmore .entry-tax a[rel="category"], .entry-tax .entry-meta .readmore a[rel="category"] ,
.widget-blog .post-format:hover, .list-post .post-format:hover, 
.widget_recent_blog .post-format:hover,
.widget-faq section.active dt i ,
.widget-chart .widget-inner div div ,
.axi_paginate_nav .current ,
.single-axi_product .single-info .buy-btn a,
.callout a.featured_btn { background-color: <?php echo $styles['feature_color']; ?>; }

::selection { background-color: <?php echo $styles['feature_color']; ?>; }
::-moz-selection { background-color: <?php echo $styles['feature_color']; ?>; }

#single-product-carousel .slides > li.flex-active-slide,
.widget-tabs .tabs > li.active a { border-top-color: <?php echo $styles['feature_color']; ?>; }

.widget-staff figure:hover .imgHolder { border-bottom-color: <?php echo $styles['feature_color']; ?>; }


.single-axi_product .single-info .buy-btn a:hover ,
a.more:hover , button.more:hover { background-color: <?php echo ColorShader($styles['feature_color'], 10); ?> }


.widget-column section > span , 
[class^="icon-"], [class*=" icon-"] { color:<?php echo $styles['font_icon_color']; ?>; }


.callout a.featured_btn, .stunning a.featured_btn { background-color:<?php echo $styles['callout_btn_bgcolor']; ?>; }

.callout a.featured_btn:hover, .stunning a.featured_btn:hover { background-color: <?php echo ColorShader($styles['callout_btn_bgcolor'], 10); ?> }



<?php // active and hover parent style ;
    } if(isset($styles['enable_header_custom_style'])) {
?>

/* Custom header styles
 *------------------------------ */
header#siteheader {
    background-color: <?php echo $styles['site_header_background_color1']; ?>;
    border-bottom: 1px solid <?php echo $styles['site_header_border_bottom_color']; ?>;
}

@media only screen and (max-width: 767px){
    header#siteheader #sitetitle {
        background-color: <?php echo $styles['site_header_background_color2']; ?>;
    }
}

@media only screen and (max-width: 959px) and (min-width: 768px){
    header#siteheader #logo {
        background-color: <?php echo $styles['site_header_background_color2']; ?>;
    }
}

/* Custom header navigation styles
 *------------------------------ */
header#siteheader .sf-menu > li a {
    color: <?php echo $styles['site_header_nav_main_text_color']; ?>;
}
@media only screen and (min-width: 960px)  {
    header#siteheader .container { height: <?php echo $styles['site_header_container_height']."px"; ?>; }
}
@media only screen and (max-width: 959px)  {
    header#siteheader #logo { height: <?php echo $styles['site_header_container_height']."px"; ?>; }
}


<?php // styles for main menu items ?>
.sf-menu > li a:hover,
.sf-menu > li.sfHover,
.sf-menu > li.sfHover > a {
    color: <?php echo $styles['site_header_nav_main_hover_text_color']; ?> !important;
    background-color: <?php echo $styles['site_header_nav_main_hover_bg_color']; ?>;
}

<?php // styles for submenus ?>
header#siteheader .sf-menu li li a {
    color: <?php echo $styles['site_header_nav_submenu_text_color']; ?>;
}

<?php // styles for submenus when mouse is over ?>
.sfHover li a:hover ,
header#siteheader .sf-menu li.sfHover li.sfHover > a { <?php // styles for parent of 3rd level ?>
    color: <?php echo $styles['site_header_nav_submenu_hover_text_color']; ?> !important; 
}



<?php // styles for current active menu ?>
.sf-menu li.current-menu-ancestor, 
.sf-menu li.current-menu-ancestor > a ,
.sf-menu li.current-menu-parent, 
.sf-menu li.current-menu-parent > a ,
.sf-menu li.current_page_item , 
.sf-menu li.current_page_item > a ,
.sf-menu li.current-menu-item  , 
.sf-menu li.current-menu-item > a {
    color: <?php echo $styles['site_header_nav_current_text_color']; ?> !important;
    background-color: <?php echo $styles['site_header_nav_current_bg_color']; ?> !important;
}

<?php // border color for main current and hover items ?>
.sf-menu li.current-menu-ancestor > a ,
.sf-menu li.current-menu-parent > a ,
.sf-menu li.current_page_item > a ,
.sf-menu li.current-menu-item > a,
.sf-menu > li > a:hover,
.sf-menu > li.sfHover,
.sf-menu > li.sfHover > a {
    border-bottom-color: <?php echo $styles['site_header_nav_current_border_color']; ?>;
}

/* Custom header vertical navigation styles
 *------------------------------ */
@media only screen and (max-width: 767px) {
    
    header#siteheader .sf-menu > li > a {
        border-bottom: 1px solid <?php echo $styles['site_header_nav_submenu_bottom_border_color']; ?>;
        border-top: 1px solid <?php echo $styles['site_header_nav_submenu_top_border_color']; ?>;
    }
}

<?php // submenu style style ; 
    }
?>

<?php if(isset($styles['site_footer_bg_color'])) {  ?>
/* footer custom style
 *------------------------------ */
footer#sitefooter { background-color: <?php echo $styles['site_footer_bg_color']; ?>; }

<?php } if(isset($styles['site_footer_text_color'])) {  ?>
footer#sitefooter ul.footer-menu li a,
footer#sitefooter { color: <?php echo $styles['site_footer_text_color']; ?>; }

footer#sitefooter ul.footer-menu li a { border-color: <?php echo $styles['site_footer_sep_color']; ?> !important; }

footer#sitefooter ul.footer-menu li a:hover { color: <?php echo ColorShader($styles['site_footer_text_color'], 10); ?>; }
<?php } ?>