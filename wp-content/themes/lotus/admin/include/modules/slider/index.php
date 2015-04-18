<?php
/**
 * Slider custom fields here
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
 
/* Creats and outputs slider setting block */
 include 'setting-metabox.php';
 
/* Adds slider save button meta box */
 include 'save-metabox.php';
 
/* Ajax handler for saving slider manager data */
 include 'save-ajax.php';

/*==================================================================================================*/

/* Edit page customization. -----------------
 * ---------------------------------------- */

// remove quick edit
function axiom_slider_editpage_customization( $actions, $post ) {
    if( $post->post_type == 'slider' ) {
        unset( $actions['inline hide-if-no-js'] );
    }
    return $actions;
}
add_filter( 'post_row_actions', 'axiom_slider_editpage_customization', 10, 2 );
 
?>