
body {
    font-family: <?php axi_the_fontface('content_typography[face]'); ?>,arial,sans-serif;
    color: <?php echo $styles['content_typography[color]']; ?>;
}

.open-sans, h1, h2, h3, h4, h5, h6, header#siteheader #logo h2, header#siteheader #logo h3, 
.flexslider.side-circle-slider .slides > li p, 
.stunning p, .widget-testimonial .testimonial-author, .widget_testimonial .testimonial-author ,
.widget-blog .entry-title a, .list-post .entry-title a, .widget_recent_blog .entry-title a ,
.widget-staff figcaption .item-title a {
    font-family: <?php axi_the_fontface('main_title_typography[face]'); ?>,arial,sans-serif;
    color: <?php echo $styles['main_title_typography[color]']; ?>;
}

.merri, 
.callout .widget-title, 
.callout p, 
.stunning .widget-title, 
.stunning p {
    font-family: <?php axi_the_fontface('stunning_typography[face]'); ?>,georgia,serif;
}

.stunning .widget-title, 
.stunning p {
    color: <?php echo $styles['stunning_typography[color]']; ?>;
}


.page-title {
    font-family: <?php axi_the_fontface('page_title_typography[face]'); ?>,georgia,serif;
    color: <?php echo $styles['page_title_typography[color]']; ?>;
}

header#siteheader nav li {
    font-family: <?php axi_the_fontface('header_menu_typography[face]'); ?>,arial,sans-serif;
}

