                    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" >
                        
                        <?php 
                        $pt_columns_data = get_post_meta($post->ID, 'pt-data', true);
                        ?>
                        <section class="widget-pricetable widget-container <?php echo 'col'.count($pt_columns_data); ?>">
                            
                                                        
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
                        </section><!-- widget-container -->
                        
                    </article>