<?php

/*-----------------------------------------------------------------------------------*/
/*  Pricetable
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'pricetable', 'axiom_shortcode_pricetable' );

function axiom_shortcode_pricetable( $atts, $content = null ) {
   // extract attrs to vars
   extract( shortcode_atts( 
            array( 
                'size'      =>  100, // section size
                'title'     => '', // widget header title
                'table_id'    => ''
            )
            , $atts ) 
          );
          
    if(empty($table_id)) return;
    
    // create wp_query to get pricetable
    $args = array(
      'post_type' => 'pricetable',
      'post_status' => 'publish',
      'page_id' => $table_id
    );
    
    $th_query = null;
    $th_query = new WP_Query($args);      
    
    ob_start();
?>

                   
<?php if( $th_query->have_posts() ):  while ($th_query->have_posts()) : $th_query->the_post(); 
       $pt_columns_data = get_post_meta($th_query->post->ID, 'pt-data', true);
?>   
       
       <section class="widget-pricetable widget-container <?php echo 'col'.count($pt_columns_data).' '.axiom_get_grid_name($size); ?>">
           
           <?php if(!empty($title)) echo get_widget_title($title, ""); ?>
           <div class="sep space"></div>
           
                <div class="widget-inner">
                    
                    <?php foreach ($pt_columns_data as $column) { ?>
                    
                    <div class="price-table-col col <?php echo 'pts-'.$column["color"].' '.$column["type"]; ?> ">
                        <div class="pt-header">
                            <h2 class="plan"><?php echo $column["name"] ?></h2>
                            <h3 class="period"><?php echo $column["price"] ?><span> / <?php echo $column["period"] ?></span></h3>
                            <p class="desc"><?php echo $column["desc"] ?></p>
                        </div>
                        <ul class="pt-content">
                        <?php 
                        if(isset($column["rows"])) {
                            foreach ($column["rows"] as $row) {
                                if($row == "mark")  $row = '<i class="icon-ok"></i>';
                                if($row == "cross") $row = '<i class="icon-remove"></i>';
                                echo "<li>".$row."</li>";
                            } 
                        }
                        ?>
                        </ul>
                        <div class="pt-footer">
                            <a href="<?php echo $column["btnLink"] ?>" class="button flat"><?php echo $column["btnLabel"] ?></a>
                        </div>
                    </div><!-- price-table column -->
                    
                    <?php } ?>
                    
                </div><!-- widget-inner -->
            
        </section><!-- widget-pricetable -->
        
<?php  
    unset($pt_columns_data); 
    endwhile; endif;
    wp_reset_query();
?>

<?php    
    return ob_get_clean();
}


?>