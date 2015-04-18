<?php 

//// WPML Custom Functions  ////////////////////////////////////////////////////////////////////////


function axiom_the_single_post_languages(){
  if(!function_exists("icl_get_languages")) return;
  
  $languages = icl_get_languages('skip_missing=1');
  if(1 < count($languages)){
    echo __('This is also available in: ', 'default');
    foreach($languages as $l){
      if(!$l['active']) $langs[] = '<a href="'.$l['url'].'">'.$l['translated_name'].'</a>';
    }
    echo join(', ', $langs);
  }
}


function language_selector_flags(){
    if(!function_exists('icl_get_languages')) return;
    
    $languages = icl_get_languages('skip_missing=0&orderby=code');
    
    if(!empty($languages)){
        echo '<div class="header_flags_lan_selector">';
        
        foreach($languages as $l){
            if(!$l['active']) echo '<a href="'.$l['url'].'" title="'.$l['translated_name'].'" >';
            echo '<img class="iclflag" src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
            if(!$l['active']) echo '</a>';
        }
        
        echo "</div>";
    }
}


function languages_list_footer(){
    if(!function_exists("icl_get_languages")) return;
    
    $languages = icl_get_languages('skip_missing=0&orderby=code');
    if(!empty($languages)){
        echo '<div id="footer_language_list"><ul>';
        foreach($languages as $l){
            echo '<li>';
            if($l['country_flag_url']){
                if(!$l['active']) echo '<a href="'.$l['url'].'">';
                echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
                if(!$l['active']) echo '</a>';
            }
            if(!$l['active']) echo '<a href="'.$l['url'].'">';
            echo icl_disp_language($l['native_name'], $l['translated_name']);
            if(!$l['active']) echo '</a>';
            echo '</li>';
        }
        echo '</ul></div>';
    }
}



?>