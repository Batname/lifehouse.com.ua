<?php
/**
 * Creates and outputs PriceTable builder
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
 
/* Add PriceTable meta box. -----------------------------
 * --------------------------------------------------- */
 
function axiom_price_table_builder_meta_box(){
	add_meta_box("axiom_price_table_builder", 
				__("Price Table Builder", 'default'), 
				"axiom_display_price_table", 
				"pricetable", 
				"normal", 
				"low");
}  

/* Display the Slider SETTING meta box. -----------------
 * --------------------------------------------------- */

function axiom_display_price_table(){
	global $post;
    
    $pt_data = get_post_meta( $post->ID, 'pt-data', true ) ;
    $nonce   = wp_create_nonce("pt-data-nonce");
    
	//$setting = esc_attr( get_post_meta( $post->ID, 'slider-setting', true ) );
?>
<script type="text/javascript">
    var pt_nonce   = "<?php echo $nonce; ?>";
    var pt_id      = "<?php echo $post->ID; ?>";
    var pt_data    =  <?php echo json_encode($pt_data); ?>;
</script>
                        <div class="av3_container">
                            
                            <div class="pt_wrapper">
                                
                                <div class="pt_inner" >
                                    <button class="pt_add_col" data-bind="click:addNewCol" >+ Add New Column</button>
                                    <div class="pt_labels pt_cells">
                                        <div class="lb_dark">Plan Name</div>
                                        <div class="lb_dark">Plan Price</div>
                                        <div class="lb_dark">Plan Period</div>
                                        <div class="lb_dark">Plan Desc</div>
                                        <ul  class="pt_remove_holder" data-bind="template:{name:'temp-pt-removw-row', foreach:rows}"></ul>
                                        <div class="lb_light">Button Label</div>
                                        <div class="lb_light">Button Link</div>
                                        <div class="lb_light">Featured?</div>
                                        <div class="lb_light">Color</div>
                                        <button class="pt_add_row" data-bind="click:addNewRow">+ Add New Row</button>
                                    </div> 
                                     
                                    <div data-bind="template:{name:'temp-pt-col' , foreach:columns, beforeRemove: hideColumn }"> </div> 
                                    
                                </div>
                                
                                <div class="pb_confirm">
                                    <div class="pb_popup">
                                        <div class="pb_s_m">
                                            <p>Are you sure ?</p>
                                            <a href="#" data-name="no" class="white button">Cancel</a>
                                            <a href="#" data-name="yes"  class="yellow button">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <p><?php _e('If you want to insert "mark" icon just type "mark" and for "cross" icon type "cross" in value fields ', 'default');?></p>
                                
                            </div>
                            
                        </div>
                        
                        
                        
                        
                        
                        <script id="temp-pt-col" type="text/html">
                            <div class="pt_cells">
                                <div><input type="text" data-bind="value:name"     /></div>
                                <div><input type="text" data-bind="value:price"    /></div>
                                <div><input type="text" data-bind="value:period"   /></div>
                                <div><input type="text" data-bind="value:desc"     /></div>
                                <ul data-bind="template:{name:'temp-pt-row', foreach:rows }"></ul>
                                <div><input type="text" data-bind="value:btnLabel" /></div>
                                <div><input type="text" data-bind="value:btnLink"  /></div>
                                <div><select data-bind="value:type">
                                    <option value="regular">Regular</option>
                                    <option value="featured">Featured</option>
                                    <option value="theading">Label Column</option>
                                </select></div>
                                <div>
                                    <select data-bind="value:color">
                                        <option value="black">Black</option>
                                        <option value="brown">Brown</option>
                                        <option value="yellow">Yellow</option>
                                        <option value="red">Red</option>
                                        <option value="orange">Orange</option>
                                        <option value="blue">Blue</option>
                                        <option value="green">Green 1</option>
                                        <option value="green2">Green 2</option>
                                    </select>
                                </div>
                                <div><button class="pt_remove yellow" data-bind="click:remove">Remove This Column</button></div>
                            </div>
                        </script>
                        
                        <script id="temp-pt-row" type="text/html">
                            <li><input type="text" data-bind="value:name" /></li>
                        </script>
                        <script id="temp-pt-removw-row" type="text/html">
                            <li><button class="pt_remove" data-bind="click:$root.removeRow">Remove This Row</button></li>
                        </script>

<?php
	unset($nonce, $pt_data);
} 

// Add PriceTable meta boxe
add_action("admin_init", "axiom_price_table_builder_meta_box"); 


?>