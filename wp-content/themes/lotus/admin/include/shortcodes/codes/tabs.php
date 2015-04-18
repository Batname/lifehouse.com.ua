<?php

/*-----------------------------------------------------------------------------------*/
/*  Tab
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'tabs', 'axiom_shortcode_tabs' );

function axiom_shortcode_tabs( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'size'      =>  '', // section size
                'position'  => 'top', // tabs position. top ,left
                'title'     => '' // section title
            )
            , $atts ) 
          );    
    
    ob_start();
    $tabs = "";
    $tabs_content = "";
    $GLOBALS["ax_tabs_num"] = 0; 
    $GLOBALS['ax_tabs']     = "";
    
?>
        
        <section class="widget-tabs widget-container bordered <?php echo axiom_get_grid_name($size); ?>">
            
        <?php if(!empty($title))  echo get_widget_title($title, ""); 
              
              do_shortcode($content); 
              
              if( is_array( $GLOBALS['ax_tabs'] ) ){
                  
                  foreach ($GLOBALS["ax_tabs"] as $tab) {
                      $tabs .= '<li><a href="">'.$tab["title"].'</a></li>';
                      $tabs_content .= '<li><div class="entry-editor"><p>'.do_shortcode($tab["content"]).'</p></div></li>';
                  }
              }
        ?>
            
            <div class="widget-inner">
                
                <ul class="tabs">
                    <?php echo $tabs; ?>
                </ul>
           
                <ul class="tabs-content">
                    <?php echo $tabs_content; ?>
                </ul>  
                 
            </div><!-- widget-inner -->
       </section><!-- widget-tabs -->
        
<?php    
    return ob_get_clean();
}

/* tab element -------------------------*/

add_shortcode( 'tab_element', 'axiom_shortcode_tab_element' );

function axiom_shortcode_tab_element( $atts, $content = null ) {
   extract( shortcode_atts( 
            array( 
                'title'     => '' // tab label
            )
            , $atts ) 
          );    
          
    $i = $GLOBALS["ax_tabs_num"];
    $GLOBALS["ax_tabs"][$i] = array('title' => $title, 'content' => $content);
    $GLOBALS["ax_tabs_num"]++;
}


?>