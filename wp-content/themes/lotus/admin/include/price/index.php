<?php
/**
 * Price Table custom fields here
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
 
/* Creats and outputs price table builder */
 include ADMIN_INC. 'price/pt-builder-metabox.php';
 
/* Adds Save button meta box */
 include ADMIN_INC. 'price/pt-save-metabox.php';

/* Ajax handler for saving price table data */
 include ADMIN_INC. 'price/pt-save-ajax.php';

/*==================================================================================================*/

/* Edit page customization. -----------------
 * ---------------------------------------- */

// remove quick edit
function axiom_pt_editpage_customization( $actions, $post ) {
    if( $post->post_type == 'pricetable' ) {
        unset( $actions['inline hide-if-no-js'] );
    }
    return $actions;
}
add_filter( 'post_row_actions', 'axiom_pt_editpage_customization', 10, 2 );
 
?>