<?php 
/*-----------------------------------------------------------------------------------*/
/*  page builder
/*-----------------------------------------------------------------------------------*/

function pagebuilder_elements($pid = null) {
    echo get_pagebuilder_elements($pid);
}

function get_pagebuilder_elements($pid = null) {
    if(!isset($pid)){
        global $post;
        if(!isset($post)) return;
        $pid = $post->ID;
    }
    $elements_shortcode = get_post_meta($pid, "axiom-pb-shortcode", true );
    return do_shortcode($elements_shortcode);
}

function the_smartpagebuilder_content($pid = null) {
    echo get_the_smartpagebuilder_content($pid );
}






function get_the_smartpagebuilder_content($pid = null) {
    $pagebuilder_content = get_pagebuilder_elements($pid);
    if(empty($pagebuilder_content)) return;
    ob_start();
?>  
    <div class="entry-builder-wrapper">
        <div class="entry-builder container">
            <div class="entry-builder-frame"><?php echo $pagebuilder_content; ?></div>
        </div><!-- axiom-builder container -->
    </div><!-- axiom-builder wrapper -->
<?php    
    return ob_get_clean();
}




/* page builder parser function
 * ---------------------------------------------*/

function axi_get_pagebuilder_shortcodes($pb_data = NULL, $debug = NULL) {
    global $post;
    
    $axiom_pb_data = isset($pb_data)?$pb_data:get_post_meta($post->ID, 'axiom-pb-data', true );
    $axiom_pb_data = is_string($axiom_pb_data)?json_decode($axiom_pb_data):$axiom_pb_data;
    
    if(!isset($axiom_pb_data) || empty($axiom_pb_data)) return;
    
    $output = '';
    
    foreach ($axiom_pb_data as $key => $section) {
        
        if(isset($debug)){
            echo '<br/>name : '.$section->name;
            echo '<br/>size : '.$section->size;
            echo '<br/>setting :  ';
            var_dump($section->setting);
            echo '<br/><br/>';
        }
        
        switch ($section->name) {
            case 'portfolio':
                $output .= axiom_the_portfolio_section($section, $key);
                break;
            case 'pages':
                $output .= axiom_the_pages_section($section, $key);
                break;
            case 'callout':
                $output .= axiom_the_callout_section($section, $key);
                break;
            case 'toggle':
                $output .= axiom_the_accordion_section($section, $key);
                break;
            case 'listitem':
                $output .= axiom_the_list_section($section, $key);
                break;
            case 'tab':
                $output .= axiom_the_tabs_section($section, $key);
                break;
            case 'msgbox':
                $output .= axiom_the_msgbox_section($section, $key);
                break;
            case 'divider':
                $output .= axiom_the_divider_section($section, $key);
                break;
            case 'column':
                $output .= axiom_the_column_section($section, $key);
                break;
            case 'video':
                $output .= axiom_the_video_section($section, $key);
                break;
            case 'staff':
                $output .= axiom_the_staff_section($section, $key);
                break;
            case 'product':
                $output .= axiom_the_product_section($section, $key);
                break;
            case 'blog':
                $output .= axiom_the_blog_section($section, $key);
                break;
            case 'news':
                $output .= axiom_the_news_section($section, $key);
                break;
            case 'service':
                $output .= axiom_the_service_section($section, $key);
                break;
            case 'price':
                $output .= axiom_the_price_section($section, $key);
                break;
            case 'faq':
                $output .= axiom_the_faq_section($section, $key);
                break;
            case 'client':
                $output .= axiom_the_client_section($section, $key);
                break;
            case 'map':
                $output .= axiom_the_map_section($section, $key);
                break;
            case 'testimonial':
                $output .= axiom_the_testimonial_section($section, $key);
                break;
            case 'contact':
                $output .= axiom_the_contact_form_section($section, $key);
                break;
            case 'twitter':
                $output .= axiom_the_twitter_section($section, $key);
                break;
            case 'image':
                $output .= axiom_the_image_section($section, $key);
                break;    
            case 'slider':
                $output .= axiom_the_slider_section($section, $key);
                break;   
            case 'chart':
                $output .= axiom_the_chart_section($section, $key);
                break;   
        }
    }

    return $output;
}


function axiom_the_chart_section($section, $section_index) {
    
    $attrs  = ' size="'.$section->size.'" ';
    $attrs .= ' title="'.$section->setting->title.'" ';
    
    $content = "";
    
    // create all chart bars
    foreach ($section->setting->tabs as $key => $tab) {
        $content .= '[chart_bar percent="'.$tab->content.'" ]'.$tab->title.'[/chart_bar]';
    }
    
    return '[chart '.$attrs.' ]'.do_shortcode($content).'[/chart]'; 
}


function axiom_the_slider_section($section, $section_index) {
    
    $attrs  = ' size="'.$section->size.'" ';
    $attrs .= ' title="'.$section->setting->title.'" ';
    $attrs .= ' id="'.$section->setting->id.'" ';
    
    return '[axi_slider '.$attrs.' ]'; 
}


function axiom_the_image_section($section, $section_index) {
    
    $attrs  = ' size="'.$section->size.'" ';
    $attrs .= ' title="'.$section->setting->title.'" ';
    $attrs .= ' src="'.$section->setting->src.'" ';
    $attrs .= ' lightbox="'.$section->setting->lightbox.'" ';
    $attrs .= ' alt="'.$section->setting->alt.'" ';
    $attrs .= ' link="'.$section->setting->link.'" ';
    $attrs .= ' icon="'.$section->setting->icon.'" ';
    
    return '[image_widget '.$attrs.' ]'; 
}


function axiom_the_twitter_section($section, $section_index) {
    
    $attrs  = ' size="'.$section->size.'" ';
    $attrs .= ' title="'.$section->setting->title.'" ';
    $attrs .= ' user="'.$section->setting->user.'" ';
    $attrs .= ' avatar="'.$section->setting->avatar.'" ';
    $attrs .= ' limit="'.$section->setting->num.'" ';
    $attrs .= ' uid="'.$section->setting->uid.'" ';
    
    return '[latest_tweets '.$attrs.' ]'; 
}

function axiom_the_contact_form_section($section, $section_index) {
    
    $attrs  = ' size="'.$section->size.'" ';
    $attrs .= ' title="'.$section->setting->title.'" ';
    $attrs .= ' email="'.$section->setting->email.'" ';
    $wcf7   = $section->setting->wcf7;
    
    return '[contact_form '.$attrs.' ]'.$wcf7.'[/contact_form]'; 
}

function axiom_the_map_section($section, $section_index) {
    
    $attrs  = ' size="'.$section->size.'" ';
    $attrs .= ' title="'.$section->setting->title.'" ';
    $attrs .= ' height="'.$section->setting->height.'" ';
    $attrs .= ' type="'.$section->setting->type.'" ';
    $attrs .= ' latitude="'.$section->setting->lat.'" ';
    $attrs .= ' longitude="'.$section->setting->lon.'" ';
    $attrs .= ' zoom="'.$section->setting->zoom.'" ';
    $attrs .= ' info="'.$section->setting->info.'" ';
    
    return '[gmaps '.$attrs.' ]'; 
}

function axiom_the_client_section($section, $section_index) {
    
    $attrs  = ' size="'.$section->size.'" ';
    $attrs .= ' title="'.$section->setting->title.'" ';
    $attrs .= ' display_type="'.$section->setting->displayType.'" ';
    $attrs .= ' auto_play="'.$section->setting->uid.'" ';
    
    $content= '';
    
    // create all tab shortcodes
    foreach ($section->setting->tabs as $key => $tab) {
        $content .= '[list_item link="'.$tab->link.'" ]<img src="'.$tab->image.'" />[/list_item]';
    }
    
    return '[brands '.$attrs.' ]'.$content.'[/brands]'; 
}

function axiom_the_faq_section($section, $section_index) {
    
    $attrs  = ' size="'.$section->size.'" ';
    $attrs .= ' title="'.$section->setting->title.'" ';
    $attrs .= ' cat_id="'.$section->setting->id.'" ';
    
    return '[faq '.$attrs.' ]'; 
}

function axiom_the_price_section($section, $section_index) {
    
    $attrs  = ' size="'.$section->size.'" ';
    $attrs .= ' title="'.$section->setting->title.'" ';
    $attrs .= ' table_id="'.$section->setting->id.'" ';
    
    return '[pricetable '.$attrs.' ]'; 
}

function axiom_the_service_section($section, $section_index) {
    
    $attrs  = ' size="'.$section->size.'" ';
    $attrs .= ' title="'.$section->setting->title.'" ';
    $attrs .= ' col="'.$section->setting->iSize.'" ';
    $attrs .= ' excerpt_len="'.$section->setting->excerpt.'" ';
    $attrs .= ' cat_id="'.$section->setting->id.'" ';
    $attrs .= ' link_to_single="'.$section->setting->uid.'" '; // link to single?
    $attrs .= ' display_type="'.$section->setting->type.'" ';
    
    return '[services '.$attrs.' ]'; 
}

function axiom_the_testimonial_section($section, $section_index) {
    
    $attrs  = ' size="'.$section->size.'" ';
    $attrs .= ' title="'.$section->setting->title.'" ';
    $attrs .= ' type="'.$section->setting->type.'" ';
    $attrs .= ' id_type="'.$section->setting->idType.'" ';
    $attrs .= ' single_id="'.$section->setting->singleId.'" ';
    $attrs .= ' cat_id="'.$section->setting->catId.'" ';
    
    return '[get_testimonial '.$attrs.' ][/get_testimonial]'; 
}

function axiom_the_news_section($section, $section_index) {
    
    if    ($section->setting->type == "slide")  $navType  = "pagination";
    else $navType = "";
    
    $attrs  = ' size="'.$section->size.'" ';
    $attrs .= ' title="'.$section->setting->title.'" ';
    $attrs .= ' col="'.$section->setting->iSize.'" ';
    $attrs .= ' view_more="'.$section->setting->viewAll.'" ';
    $attrs .= ' more_label="'.$section->setting->viewAllLabel.'" ';
    $attrs .= ' num="'.$section->setting->fetchedNum.'" ';
    $attrs .= ' view_thumb="'.$section->setting->viewThumb.'" ';
    $attrs .= ' thumb_mode="'.$section->setting->thumbPos.'" ';
    $attrs .= ' date_type="'.$section->setting->dateType.'" ';
    $attrs .= ' excerpt_len="'.$section->setting->excerpt.'" ';
    $attrs .= ' cat_id="'.$section->setting->id.'" ';
    $attrs .= ' auto_play="'.$section->setting->uid.'" ';
    $attrs .= ' nav="'.$navType.'" ';
    
    return '[latest_news '.$attrs.' ]'; 
}

function axiom_the_blog_section($section, $section_index) {
    
    if    ($section->setting->type == "slide")  $navType  = "pagination";
    else $navType = "";
    
    $attrs  = ' size="'.$section->size.'" ';
    $attrs .= ' title="'.$section->setting->title.'" ';
    $attrs .= ' col="'.$section->setting->iSize.'" ';
    $attrs .= ' view_more="'.$section->setting->viewAll.'" ';
    $attrs .= ' more_label="'.$section->setting->viewAllLabel.'" ';
    $attrs .= ' num="'.$section->setting->fetchedNum.'" ';
    $attrs .= ' view_thumb="'.$section->setting->viewThumb.'" ';
    $attrs .= ' thumb_mode="'.$section->setting->thumbPos.'" ';
    $attrs .= ' date_type="'.$section->setting->dateType.'" ';
    $attrs .= ' excerpt_len="'.$section->setting->excerpt.'" ';
    $attrs .= ' cat_id="'.$section->setting->id.'" ';
    $attrs .= ' auto_play="'.$section->setting->uid.'" ';
    $attrs .= ' nav="'.$navType.'" ';
    
    return '[latest_blog '.$attrs.' ]'; 
}

function axiom_the_product_section($section, $section_index) {
    // determines if navigation type is paginate or filter
    if    ($section->setting->type == "slide")  $navType  = "pagination";
    elseif($section->setting->type == "filter") $navType  = "filterable";
    else $navType = "";
    
    $attrs  = ' size="'.$section->size.'" ';
    $attrs .= ' title="'.$section->setting->title.'" ';
    $attrs .= ' view_price="'.$section->setting->viewPrice.'" ';
    $attrs .= ' num="'.$section->setting->fetchedNum.'" ';
    $attrs .= ' col="'.$section->setting->iSize.'" ';
    $attrs .= ' nav="'.$navType.'" ';
    $attrs .= ' cat_id="'.$section->setting->id.'" ';
    $attrs .= ' section_index="'.$section_index.'" ';
    $attrs .= ' mode="'.$section->setting->displayMode.'" ';
    
    return '[latest_products '.$attrs.' ]'; 
}

function axiom_the_staff_section($section, $section_index) {
    
    $col = $section->setting->iSize;
    
    $attrs  = ' size="'.$section->size.'" ';
    $attrs .= ' title="'.$section->setting->title.'" ';
    $attrs .= ' view_socials="'.$section->setting->viewSocial.'" ';
    $attrs .= ' view_excerpt="'.$section->setting->viewExcerpt.'" ';
    $attrs .= ' link_to_single="'.$section->setting->linkToSingle.'" ';
    $attrs .= ' num="-1" ';
    $attrs .= ' col="'.$section->setting->iSize.'" ';
    $attrs .= ' cat_id="'.$section->setting->id.'" ';
    
    return '[latest_staffs '.$attrs.' ]'; 
}

function axiom_the_video_section($section, $section_index) {
    
    $attrs  = ' size ="'.$section->size.'" ';
    $attrs .= ' title="'.$section->setting->title.'" ';
    $attrs .= ' fit="'.$section->setting->fit.'" ';
    $attrs .= ' url="'.$section->setting->url.'" ';
    $attrs .= ' mp4="'.$section->setting->mp4.'" ';
    $attrs .= ' ogg="'.$section->setting->ogg.'" ';
    $attrs .= ' webm="'.$section->setting->webm.'" ';
    $attrs .= ' flv="'.$section->setting->flv.'" ';
    $attrs .= ' poster="'.$section->setting->poster.'" ';
    $attrs .= ' skin="'.$section->setting->skin.'" ';
    
    return '[video '.$attrs.' ]';
}

function axiom_the_column_section($section, $section_index) {
    $content = $section->setting->content;
    
    $attrs  = ' size ="'.$section->size.'" ';
    $attrs .= ' title="'.$section->setting->title.'" ';
    $attrs .= ' text_style="'.$section->setting->textStyle.'" ';
    $attrs .= ' icon="'.$section->setting->icon.'" ';
    $attrs .= ' icon_color="'.$section->setting->iconColor.'" ';
    $attrs .= ' image="'.$section->setting->image.'" ';
    $attrs .= ' image_position="'.$section->setting->imagePosition.'" ';
    
    return '[column '.$attrs.' ]'.$content.'[/column]';
}

function axiom_the_divider_section($section, $section_index) {
    
    $attrs  = ' size ="'.$section->size.'" ';
    $attrs .= ' style="'.$section->setting->type.'" ';
    $attrs .= ' btn_label="'.$section->setting->text.'" ';
    $attrs .= ' height="'.$section->setting->height.'" ';
    
    return '[divider '.$attrs.' ]'; 
}

function axiom_the_msgbox_section($section, $section_index) {
    
    $attrs  = ' size="'.$section->size.'" ';
    $attrs .= ' title="'.$section->setting->title.'" ';
    $attrs .= ' type="'.$section->setting->type.'" ';
    $attrs .= ' show_icon="'.$section->setting->showIcon.'" ';
    $content = $section->setting->content;
    
    return '[msgbox '.$attrs.' ]'.$content.'[/msgbox]'; 
}

function axiom_the_tabs_section($section, $section_index) {
    $content = "";
    
    $attrs  = ' size="'.$section->size.'" ';
    $attrs .= ' title="'.$section->setting->title.'" ';
    $attrs .= ' position="'.$section->setting->position.'" ';
    
    // create all tab shortcodes
    foreach ($section->setting->tabs as $key => $tab) {
        $content .= '[tab_element title="'.$tab->title.'" ]'.$tab->content.'[/tab_element]';
    }
    
    return '[tabs '.$attrs.' ]'.$content.'[/tabs]'; 
}


function axiom_the_list_section($section, $section_index) {
    $content = "";
    
    $attrs  = ' size="'.$section->size.'" ';
    $attrs .= ' title="'.$section->setting->title.'" ';
    $attrs .= ' style="'.$section->setting->icon.'" ';
    $attrs .= ' border="'.$section->setting->bordered.'" ';
    
    // create all lists
    foreach ($section->setting->tabs as $key => $tab) {
        $content .= '<li>'.$tab->title.'</li>';
    }
    
    return '[list '.$attrs.' ]'.$content.'[/list]'; 
}


function axiom_the_accordion_section($section, $section_index) {
    $content = "";
    
    $attrs  = ' size="'.$section->size.'" ';
    $attrs .= ' title="'.$section->setting->title.'" ';
    $attrs .= ' type="'.$section->setting->type.'" ';
    
    // create all acc_element shortcodes
    foreach ($section->setting->tabs as $key => $tab) {
        $content .= '[acc_element title="'.$tab->title.'" ]'.$tab->content.'[/acc_element]';
    }
    
    return '[accordion '.$attrs.' ]'.$content.'[/accordion]'; 
}

function axiom_the_tab_element($section, $section_index) {
    $content = "" ;
    
    $attrs  = ' title="'.$section->setting->title.'" ';
    $attrs .= ' type="'.$section->setting->type.'" ';
    
    return '[tab_element '.$attrs.' ]'.$content.'[/tab_element]'; 
}


function axiom_the_callout_section($section, $section_index) {
    
    $attrs  = ' size="'.$section->size.'" ';
    $attrs .= ' title="'.$section->setting->title.'" ';
    $attrs .= ' caption="'.$section->setting->caption.'" ';
    $attrs .= ' btn_label="'.$section->setting->buttonLabel.'" ';
    $attrs .= ' btn_link="'.$section->setting->buttonLink.'" ';
    $attrs .= ' target="'.$section->setting->target.'" ';
    $attrs .= ' type="'.$section->setting->type.'" ';
    
    return '[callout '.$attrs.' ]'; 
}


function axiom_the_portfolio_section($section, $section_index) {
    
    if    ($section->setting->type == "slide")  $navType  = "pagination";
    elseif($section->setting->type == "filter") $navType  = "filterable";
    else $navType = "";
    
    $displayMode = ($section->setting->displayMode == "over" )?' mode="caption-over" grid="g1" ':'';
    $col = $section->setting->iSize;
    
    $attrs  = ' size="'.$section->size.'" ';
    $attrs .= ' title="'.$section->setting->title.'" ';
    $attrs .= ' posttype="portfolio" ';
    $attrs .= ' view_title="'.$section->setting->viewTitle.'" ';
    $attrs .= ' view_excerpt="'.$section->setting->viewExcerpt.'" ';
    $attrs .= ' excerpt_len="'.$section->setting->excerpt.'" ';
    $attrs .= ' num="'.$section->setting->fetchedNum.'" ';
    $attrs .= ' col="'.$section->setting->iSize.'" ';
    $attrs .= ' nav="'.$navType.'" ';
    $attrs .= ' cat_id="'.$section->setting->id.'" ';
    $attrs .= ' taxonomy="project-type" ';
    $attrs .= ' section_index="'.$section_index.'" ';
    
    $attrs .=   $displayMode;
    
    return '[latest_items '.$attrs.' ]'; 
}

function axiom_the_pages_section($section, $section_index) {
    $page_ids = array();
    if    ($section->setting->type == "slide")  $navType  = "pagination";
    else $navType = "";
    
    $attrs  = ' size="'.$section->size.'" ';
    $attrs .= ' title="'.$section->setting->title.'" ';
    
    $attrs .= ' view_title="'.$section->setting->viewTitle.'" ';
    $attrs .= ' view_excerpt="'.$section->setting->viewExcerpt.'" ';
    $attrs .= ' excerpt_len="'.$section->setting->excerpt.'" ';
    $attrs .= ' col="'.$section->setting->iSize.'" ';
    $attrs .= ' nav="'.$navType.'" ';
    $attrs .= ' section_index="'.$section_index.'" ';
    
    // create all tab shortcodes
    foreach ($section->setting->tabs as $key => $tab) {
        $page_ids[] .= $tab->link;
    }
    
    $attrs .= ' ids="'.implode(",", $page_ids).'" ';
    
    return '[axi_get_pages '.$attrs.' ]'; 
}


?>