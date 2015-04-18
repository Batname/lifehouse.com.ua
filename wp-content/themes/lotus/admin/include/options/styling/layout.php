
/* header styles
 *------------------------------ */
<?php if(isset($styles['site_header_logo_width'])){  ?>
header#siteheader #logo .logo_inner {
    width:  <?php echo str_replace('px', '', $styles['site_header_logo_width']). 'px'; ?>;
    height: 85px;
}
<?php } ?>