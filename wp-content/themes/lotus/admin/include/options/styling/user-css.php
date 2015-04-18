<?php 
global $axiom_options;

if( isset($axiom_options['axiom_user_custom_css']) ){
?>

/* User Custom styles
 *------------------------------ */
<?php
    echo stripslashes($axiom_options['axiom_user_custom_css']);
}

?>