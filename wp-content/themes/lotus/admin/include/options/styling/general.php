<?php 
    $site_bg_image = empty($styles['site_body_background_pattern'])?"":ADMIN_URL.'images/bg/'.$styles['site_body_background_pattern']; 
    $site_bg_image = empty($styles['site_body_background_custom_image'])?$site_bg_image:$styles['site_body_background_custom_image']; 
?>
body {
    background: <?php echo $styles['site_body_background_color']; ?> url(<?php echo $site_bg_image; ?>) <?php echo $styles['site_body_background_repeat']; ?> <?php echo $styles['site_body_background_attachment']; ?> <?php echo $styles['site_body_background_position']; ?>;
}

