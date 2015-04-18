<?php 
    $axi_temp_pb_data = get_post_meta($post->ID, 'axiom-pb-data', true ); 
    $axi_temp_pb_data = empty($axi_temp_pb_data)?"":$axi_temp_pb_data;
    
    // backup $post data at beginning, and restore at the end of builder
    global $post, $bu_the_post; $bu_the_post = $post;
?>

<script>
    var axiom_pb_data = <?php echo empty($axi_temp_pb_data)?'""':$axi_temp_pb_data; ?>;
    //console.log(axiom_pb_data);
</script>

<input type="hidden" id="axiom_pb_draft_data" name="axiom_pb_draft_data" value="" />

<!------ Block Templates ------>
<script id="temp-toggle" type="text/html">
    <li class="element_block g1_4 accordion" data-bind="css:sizeClass">
        <div class="symbol_block">
            <h5><?php _e("Toggle Box/ Accordion", "default"); ?></h5>
            <div class="symbol">
                <div></div>
                <div></div>
                <div class="grad_bar"></div>
                <div></div>
            </div>
        </div>
        <div class="controls" data-bind="template: 'temp-controls' , event:{ dblclick: edit } "></div>
    </li>
</script>

<script id="temp-column" type="text/html">
    <li class="element_block g1_4 column" data-bind="css:sizeClass">
        <div class="symbol_block">
            <h5><?php _e("Column", "default"); ?></h5>
            <div class="symbol"></div>
        </div>
        <div class="controls" data-bind="template: 'temp-controls', event:{ dblclick: edit }"></div>
    </li>
</script>

<script id="temp-testimonial" type="text/html">
    <li class="element_block g1_4 testimonial" data-bind="css:sizeClass">
        <div class="symbol_block">
            <h5><?php _e("Testimonial", "default"); ?></h5>
            <div class="symbol">
                <div>
                  <span></span>
                </div>
            </div>
        </div>
        <div class="controls" data-bind="template: 'temp-controls', event:{ dblclick: edit }"></div>
    </li>
</script>

<script id="temp-contact" type="text/html">
    <li class="element_block g1_4 contact" data-bind="css:sizeClass">
        <div class="symbol_block">
            <h5><?php _e("Contact", "default"); ?></h5>
            <div class="symbol">
                <div></div>
                <div></div>
                <span></span>
            </div>
        </div>
        <div class="controls" data-bind="template: 'temp-controls' , event:{ dblclick: edit } "></div>
    </li>
</script>

<script id="temp-price" type="text/html">
    <li class="element_block g1_4 price1" data-bind="css:sizeClass">
        <div class="symbol_block">
            <h5><?php _e("Price Table", "default"); ?></h5>
            <div class="symbol">
                <div><span></span></div>
                <div class="mid1"><span></span></div>
                <div class="lst1"><span></span></div>
            </div>
        </div>
        <div class="controls" data-bind="template: 'temp-controls' , event:{ dblclick: edit } "></div>
    </li>
</script>

<script id="temp-video" type="text/html">
    <li class="element_block g1_4 video" data-bind="css:sizeClass">
        <div class="symbol_block">
            <h5><?php _e("Video", "default"); ?></h5>
            <div class="symbol">
                <div><span> </span></div>
            </div>
        </div>
        <div class="controls" data-bind="template: 'temp-controls' , event:{ dblclick: edit } "></div>
    </li>
</script>

<script id="temp-tab" type="text/html">
    <li class="element_block g1_4 tab" data-bind="css:sizeClass">
        <div class="symbol_block">
            <h5><?php _e("Tab", "default"); ?></h5>
            <div class="symbol">
                <span class="first"></span>
                <span></span>
                <span class="last"></span>
                <div></div>
            </div>
        </div>
        <div class="controls" data-bind="template: 'temp-controls' , event:{ dblclick: edit } "></div>
    </li>
</script>

<script id="temp-pages" type="text/html">
    <li class="element_block g1_4 msgb1 pages1" data-bind="css:sizeClass">
        <div class="symbol_block">
            <h5><?php _e("Pages", "default"); ?></h5>
            <div class="symbol">
                <div></div>
            </div>
        </div>
        <div class="controls" data-bind="template: 'temp-controls' , event:{ dblclick: edit } "></div>
    </li>
</script>

<script id="temp-slider" type="text/html">
    <li class="element_block g1_4 slider" data-bind="css:sizeClass">
        <div class="symbol_block">
            <h5><?php _e("Slider", "default"); ?></h5>
            <div class="symbol">
                <div><em class="le">&lsaquo;</em><em class="ri">&rsaquo;</em></div>
                <span></span>
                <span></span>
                <span class="last"></span>
            </div>
        </div>
        <div class="controls" data-bind="template: 'temp-controls' , event:{ dblclick: edit } "></div>
    </li>
</script>

<script id="temp-portfolio" type="text/html">
    <li class="element_block g1_4 portfo" data-bind="css:sizeClass">
        <div class="symbol_block">
            <h5><?php _e("Portfolio", "default"); ?></h5>
            <div class="symbol">
                <div></div>
            </div>
        </div>
        <div class="controls" data-bind="template: 'temp-controls' , event:{ dblclick: edit } "></div>
    </li>
</script>

<script id="temp-chart" type="text/html">
    <li class="element_block g1_4 chart" data-bind="css:sizeClass">
        <div class="symbol_block">
            <h5><?php _e("Progress Chart", "default"); ?></h5>
            <div class="symbol">
                <div><div style="width:63%"></div><span>63%</span></div>
                <div><div style="width:47%"></div><span>47%</span></div>
                <div><div style="width:89%"></div><span>89%</span></div>
            </div>
        </div>
        <div class="controls" data-bind="template: 'temp-controls' , event:{ dblclick: edit } "></div>
    </li>
</script>

<script id="temp-divider" type="text/html">
    <li class="element_block g1_4 divider1" data-bind="css:sizeClass">
        <div class="divider-bar controls" data-bind="template: 'temp-divider-controls' , event:{ dblclick: edit } "></div>
    </li>
</script>

<script id="temp-blog" type="text/html">
    <li class="element_block g1_4 blog1" data-bind="css:sizeClass">
        <div class="symbol_block">
            <h5><?php _e("Blog", "default"); ?></h5>
            <div class="symbol">
                <div class="ri"></div>
                <div class="le">
                    <div></div>
                    <small></small>
                    <span></span>
                </div>
            </div>
        </div>
        <div class="controls" data-bind="template: 'temp-controls' , event:{ dblclick: edit } "></div>
    </li>
</script>

<script id="temp-news" type="text/html">
    <li class="element_block g1_4 news1" data-bind="css:sizeClass">
        <div class="symbol_block">
            <h5><?php _e("News", "default"); ?></h5>
            <div class="symbol">
                <div>
                    <strong></strong>
                    <small></small>
                    <span></span>
                </div>
                <div>
                    <strong></strong>
                    <small></small>
                    <span></span>
                </div>
            </div>
        </div>
        <div class="controls" data-bind="template: 'temp-controls' , event:{ dblclick: edit } "></div>
    </li>
</script>

<script id="temp-listitem" type="text/html">
    <li class="element_block g1_4 list1" data-bind="css:sizeClass">
        <div class="symbol_block">
            <h5><?php _e("List / Iconic List", "default"); ?></h5>
            <div class="symbol">
                <div>
                    <strong></strong>
                    <small></small>
                    <span></span>
                </div>
                <div>
                    <strong></strong>
                    <small></small>
                    <span></span>
                </div>
                <div>
                    <strong></strong>
                    <small></small>
                    <span></span>
                </div>
            </div>
        </div>
        <div class="controls" data-bind="template: 'temp-controls' , event:{ dblclick: edit } "></div>
    </li>
</script>

<script id="temp-staff" type="text/html">
    <li class="element_block g1_4 staff1" data-bind="css:sizeClass">
        <div class="symbol_block">
            <h5><?php _e("Staff", "default"); ?></h5>
            <div class="symbol">
                <div></div>
            </div>
        </div>
        <div class="controls" data-bind="template: 'temp-controls' , event:{ dblclick: edit } "></div>
    </li>
</script>

<script id="temp-callout" type="text/html">
    <li class="element_block g1_4 call1" data-bind="css:sizeClass">
        <div class="symbol_block">
            <h5><?php _e("Callout", "default"); ?></h5>
            <div class="symbol">
                <div>
                    <small></small>                                                           <small></small>
                    <span></span>
                </div>
            </div>
        </div>
        <div class="controls" data-bind="template: 'temp-controls' , event:{ dblclick: edit } "></div>
    </li>
</script>

<script id="temp-client" type="text/html">
    <li class="element_block g1_4 client1" data-bind="css:sizeClass">
        <div class="symbol_block">
            <h5><?php _e("Clients/Barnds", "default"); ?></h5>
            <div class="symbol">
                <div></div>
            </div>
        </div>
        <div class="controls" data-bind="template: 'temp-controls' , event:{ dblclick: edit } "></div>
    </li>
</script>

<script id="temp-social" type="text/html">
    <li class="element_block g1_4 social1" data-bind="css:sizeClass">
        <div class="symbol_block">
            <h5><?php _e("Social Bar", "default"); ?></h5>
            <div class="symbol">
                <div></div>
            </div>
        </div>
        <div class="controls" data-bind="template: 'temp-controls' , event:{ dblclick: edit } "></div>
    </li>
</script>

<script id="temp-msgbox" type="text/html">
    <li class="element_block g1_4 msgb1" data-bind="css:sizeClass">
        <div class="symbol_block">
            <h5><?php _e("Message Box", "default"); ?></h5>
            <div class="symbol">
                <div></div>
            </div>
        </div>
        <div class="controls" data-bind="template: 'temp-controls' , event:{ dblclick: edit } "></div>
    </li>
</script>

<script id="temp-map" type="text/html">
    <li class="element_block g1_4 map" data-bind="css:sizeClass">
        <div class="symbol_block">
            <h5><?php _e("Map", "default"); ?></h5>
            <div class="symbol">
                <div></div>
            </div>
        </div>
        <div class="controls" data-bind="template: 'temp-controls' , event:{ dblclick: edit } "></div>
    </li>
</script>

<script id="temp-product" type="text/html">
    <li class="element_block g1_4 product1" data-bind="css:sizeClass">
        <div class="symbol_block">
            <h5><?php _e("Product", "default"); ?></h5>
            <div class="symbol">
                <div><span></span></div>
                <small></small>
                <span></span>
            </div>
        </div>
        <div class="controls" data-bind="template: 'temp-controls' , event:{ dblclick: edit } "></div>
    </li>
</script>

<script id="temp-faq" type="text/html">
    <li class="element_block g1_4 faq1" data-bind="css:sizeClass">
        <div class="symbol_block">
            <h5><?php _e("FAQ", "default"); ?></h5>
            <div class="symbol">
                <div></div>
            </div>
        </div>
        <div class="controls" data-bind="template: 'temp-controls' , event:{ dblclick: edit } "></div>
    </li>
</script>

<script id="temp-gallery" type="text/html">
    <li class="element_block g1_4 gal1" data-bind="css:sizeClass">
        <div class="symbol_block">
            <h5><?php _e("Gallery", "default"); ?></h5>
            <div class="symbol">
                <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
            </div>
            
        </div>
        <div class="controls" data-bind="template: 'temp-controls' , event:{ dblclick: edit } "></div>
    </li>
</script>

<script id="temp-image" type="text/html">
    <li class="element_block g1_4 img1" data-bind="css:sizeClass">
        <div class="symbol_block">
            <h5><?php _e("Image", "default"); ?></h5>
            <div class="symbol">
                <div></div>
            </div>
            
        </div>
        <div class="controls" data-bind="template: 'temp-controls' , event:{ dblclick: edit } "></div>
    </li>
</script>

<script id="temp-twitter" type="text/html">
    <li class="element_block g1_4 list1 tweet1" data-bind="css:sizeClass">
        <div class="symbol_block">
            <h5><?php _e("Recent Tweets", "default"); ?></h5>
            <div class="symbol">
                <div>
                    <strong></strong>
                    <small></small>
                    <span></span>
                </div>
                <div>
                    <strong></strong>
                    <small></small>
                    <span></span>
                </div>
                <div>
                    <strong></strong>
                    <small></small>
                    <span></span>
                </div>
            </div>
        </div>
        <div class="controls" data-bind="template: 'temp-controls' , event:{ dblclick: edit } "></div>
    </li>
</script>
<script id="temp-service" type="text/html">
    <li class="element_block g1_4 msgb1 service1" data-bind="css:sizeClass">
        <div class="symbol_block">
            <h5><?php _e("Services", "default"); ?></h5>
            <div class="symbol">
                <div></div>
            </div>
        </div>
        <div class="controls" data-bind="template: 'temp-controls' , event:{ dblclick: edit } "></div>
    </li>
</script>

<script id="temp-controls" type="text/html">
    <a href="" class="trash"    data-bind="click:remove"><span class="png16 trash"></span></a>
    <a href="" class="edit"     data-bind="click:edit"><span class="png16 edit"></span></a>
    <span      class="size"     data-bind="text:blockSizeLabel">1/4</span>
    <a href="" class="decrease" data-bind="click:decrease"><span class="png16 dec"></span></a>
    <a href="" class="increase" data-bind="click:increase"><span class="png16 dec"></span></a>
</script>

<script id="temp-divider-controls" type="text/html">
    <a href="" class="trash"    data-bind="click:remove"><span class="png16 trash"></span></a>
    <a href="" class="edit"     data-bind="click:edit"><span class="png16 edit"></span></a>
    <span      class="size"><?php _e("Divider", "default"); ?></span>
</script>


<!------ Setting Templates ------>

<!-- parts -->
<script id="setting-blank" type="text/html"> </script>
<script id="setting-footer" type="text/html">
    <a href="#" class="button yellow" data-bind="click:$root.saveSettingToObject"><?php _e("Accept", "default"); ?></a>
</script>
<script id="area-tab" type="text/html">
    <div class="area">
      <a href="#" class="close" title="Remove" data-bind="click:removeTab"></a>
      <label><?php _e("Tab Title", "default"); ?></label>
      <input type="text" data-bind="value:title"/>
      <label><?php _e("Content", "default"); ?></label>
      <textarea data-bind="value:content"></textarea>
    </div>
</script>
<script id="area-image" type="text/html">
    <div class="area">
      <a href="#" class="close" title="Remove" data-bind="click:removeTab"></a>
      <label><?php _e("Image URL", "default"); ?> :</label>
      <input type="text" data-bind="value:image"/>
      <label><?php _e("Clinet URL", "default"); ?> :</label>
      <input type="text" data-bind="value:link" />
    </div>
</script>
<script id="area-list" type="text/html">
    <div class="area">
      <a href="#" class="close" title="Remove" data-bind="click:removeTab"></a>
      <label><?php _e("Content", "default"); ?> </label>
      <input type="text" data-bind="value:title"/>
      <!--<label>Description</label>-->
      <!--<textarea data-bind="value:content"></textarea>-->
    </div>
</script>
<script id="area-chart" type="text/html">
    <div class="area">
      <a href="#" class="close" title="Remove" data-bind="click:removeTab"></a>
      <label><?php _e("Bar Label", "default"); ?></label>
      <input type="text" data-bind="value:title"/>
      <br />
      <label><?php _e("Percent", "default"); ?></label>
      <input type="text" data-bind="value:content" placeholder="100"/>
    </div>
</script>
<script id="area-pages" type="text/html">
    <div class="area">
      <a href="#" class="close" title="Remove" data-bind="click:removeTab"></a>
      <label><?php _e("Select Page", "default"); ?></label>
      <select data-bind="value:link" > 
         <option value=""><?php echo esc_attr( __( 'Select page', 'default') ); ?></option> 
         <?php 
          $pages = get_pages(); 
          foreach ( $pages as $page )
            echo '<option value="' . $page->ID . '">'. $page->post_title. '</option>';
         ?>
     </select>
    </div>
</script>

<!-- templates -->
<script id="setting-slider" type="text/html">
    <div class="pb_popup">
        <div class="pb_s_t" data-bind="mclick:close" >
            <h4><?php _e("Slider", "default"); ?></h4>
            <a href="#" data-bind="click:$root.closeSetting"></a>
        </div>
        
        <div class="pb_s_m">
              <div>
                  <label><?php _e("Title", "default"); ?> :</label>
                  <input type="text" data-bind="value:title" />
                  <p><?php _e("Specifies the section title.(optional)", "default") ?></p>
              </div>
              <div>
                  <label><?php _e("Select Slider", "default"); ?> :</label>
                  <select data-bind="value:id">
                      <option value="none" ><?php _e("Choose ..", "default"); ?></option>
                  <?php 
                    $args = array(
                      'post_type' => 'slider',
                      'orderby' => "date",
                      'post_status' => 'publish',
                      'posts_per_page' => -1
                    );
                    // print flex and nivo sliders
                    $th_query = null;
                    $th_query = new WP_Query($args);  
                    if( $th_query->have_posts() ):  while ($th_query->have_posts()) : $th_query->the_post();
                        $opts = get_post_meta($th_query->post->ID, 'slider-data', true); 
                        $type = $opts["type"];
                        echo '<option value="'.$th_query->post->ID.'"  >['.$type.'] '.get_the_title().'</option>';
                        unset($opts, $type);
                    endwhile; endif; 
                    unset($args);
                    
                  ?>
                  </select>
                  <p><?php _e('Choose from sliders you have created before.<br/>Just "Flex Slider" and "Nivo Slider" are supported in page builder.<br/>(You can create new slider from "Sliders" section in admin menu)', "default"); ?></p>
              </div>
        </div>
        
        <div class="pb_s_b" data-bind="template:{name:'setting-footer'}"></div>
    </div>
</script>


<script id="setting-column" type="text/html">
    <div class="pb_popup">
        <div class="pb_s_t" data-bind="mclick:close" >
            <h4><?php _e("Column - Feature Column", "default"); ?></h4>
            <a href="#" data-bind="click:$root.closeSetting"></a>
        </div>
        
        <div class="pb_s_m">
          <div>
              <label><?php _e("Title", "default"); ?> :</label>
              <input type="text" data-bind="value:title" />
              <p><?php _e("Specifies the section title.(optional)", "default") ?></p>
          </div>
          <div>
              <label><?php _e("Text Style", "default"); ?> :</label>
              <select data-bind="value:textStyle">
                  <option value="paragraph"><?php _e("Paragraph", "default"); ?> </option>
                  <option value="blockquote"><?php _e("Blockquote", "default"); ?> </option>
              </select>
              <p><?php _e("Do you want to display column content as quote(Blockquote) or default text style (Paragraph)", "default"); ?> </p>
          </div>
          <div>
              <label><?php _e("Content", "default"); ?> :</label>
              <textarea id="setting-column-content" data-bind="value:content, ckeditor:content"></textarea>
              <p><?php _e("Please insert column content here", "default"); ?> </p>
          </div>
          <div>
              <label><?php _e("Shape", "default"); ?> :</label>
              <select data-bind="value:icon">
                <option value="none"><?php _e("None", "default"); ?></option>
                <?php include 'partials/icons.php'; ?>
              </select>
              <p><?php _e("You can choose from available shapes to display around the content", "default"); ?></p>
          </div>
          <div>
              <label><?php _e("Shape/Image Position", "default"); ?> :</label>
              <select data-bind="value:imagePosition">
                  <option value="top"><?php _e("Top", "default"); ?></option>
                  <option value="left"><?php _e("Left", "default"); ?></option>
                  <option value="right"><?php _e("Right", "default"); ?></option>
              </select>
              <p><?php _e("This is the position of shape/image around the content", "default"); ?></p>
          </div>
          <!--
          <div>
              <label>Image Color :</label>
              <input type="color" data-bind="value:iconColor" />
              <p>Lorem ipsum dolor sit amet.</p>
          </div>
          <div>
              <label>Custom Image :</label>
              <fieldset class="uploader">
                  <input type="text" data-bind="value:image" />
                  <button class="white" >Upload</button>
                  <button class="white alert" >Remove</button>
              </fieldset>
              <p>Lorem ipsum dolor sit amet.</p>
          </div>-->
          <div>
              <label><?php _e("Custom Image","default");?></label>
              <input type="text" data-bind="value:image" />
              <p><?php _e('You can display custom image instead of default shapes<br/>Add the image link you want to display as column image. <br/>If you set this field, "Shape" field will be ignored.', "default"); ?></p>
          </div>
        </div>
        
        <div class="pb_s_b" data-bind="template:{name:'setting-footer'}"></div>
    </div>
</script>


<script id="setting-callout" type="text/html">
    <div class="pb_popup">
        <div class="pb_s_t" data-bind="mclick:close" >
            <h4><?php _e("Callout / Stunning Text", "default"); ?></h4>
            <a href="#" data-bind="click:$root.closeSetting"></a>
        </div>
        
        <div class="pb_s_m">
              <div>
                  <label><?php _e("Type", "default"); ?> :</label>
                  <select data-bind="value:type">
                      <option value="callout"><?php _e("Callout", "default"); ?></option>
                      <option value="stunning"><?php _e("Stunning Text", "default"); ?></option>
                  </select>
                  <p><?php _e('If you choose "Callout" a big box appears around the content.', 'default') ?></p>
              </div>
              <div>
                  <label><?php _e("Title", "default"); ?> :</label>
                  <input type="text" data-bind="value:title" />
                  <p><?php _e("This is the main big text", "default") ?></p>
              </div>
              <div>
                  <label><?php _e("Caption", "default"); ?> :</label>
                  <input type="text" data-bind="value:caption" />
                  <p><?php _e("This is the medium size text", "default"); ?></p>
              </div>
              <!--
              <div>
                  <label>Background Color :</label>
                  <select data-bind="value:bgcolor">
                      <option value="default">Default</option>
                      <option value="transparent">Transparent</option>
                  </select>
                  <p>Lorem ipsum dolor sit amet.</p>
              </div>-->
              <div>
                  <label><?php _e('Button Label', 'default'); ?> :</label>
                  <input type="text" data-bind="value:buttonLabel"/>
                  <p><?php _e("The Text appears in button (Leave it blank if you do not want to add button)","default"); ?></p>
              </div>
              <div>
                  <label><?php _e('Button Link', 'default'); ?> :</label>
                  <input type="text" data-bind="value:buttonLink" />
                  <p><?php _e('You can add link to the button. Put the link here , or leave it blank if you do not want to use button', 'default'); ?></p>
              </div>
              <div>
                  <label><?php _e('Button Link Target', 'default'); ?> :</label>
                  <select data-bind="value:target">
                      <option value="self">_self</option>
                      <option value="blank">_blank</option>
                  </select>
                  <p><?php _e('Specifies how new page opens when the button is clicked', 'default'); ?><br/>
                     <?php _e('"blank" : Opens the linked page in a new window or tab', 'default'); ?><br/>
                     <?php _e('"self"  : Opens the linked page in the same page as it was clicked', 'default'); ?> 
                  </p>
              </div>
        </div>
        
        <div class="pb_s_b" data-bind="template:{name:'setting-footer'}"></div>
    </div>
</script>

<script id="setting-toggle" type="text/html">
    <div class="pb_popup">
        <div class="pb_s_t" data-bind="mclick:close" >
            <h4><?php _e("Toggle Box", "default"); ?></h4>
            <a href="#" data-bind="click:$root.closeSetting"></a>
        </div>
        
        <div class="pb_s_m">
              <div>
                  <label><?php _e("Title", "default"); ?> :</label>
                  <input type="text" data-bind="value:title" />
                  <p><?php _e("This is the section title", "default") ?></p>
              </div>
              <div>
                  <label><?php _e("Always One Tab Visible?", "default"); ?></label>
                  <select data-bind="value:type">
                      <option value="accordion"><?php _e("Yes", "default"); ?></option>
                      <option value="toggle"><?php _e("No", "default"); ?></option>
                  </select>
                  <p><?php _e("Do you want to collapse other tabs when the current tab is open?", "default"); ?></p>
              </div>
              <div>
                  <button class="grey addnew" data-bind="click:addTab" >+<?php _e("Add New Tab", "default"); ?></button>
                  <div class="tabsContainer" data-bind="template:{name:'area-tab', foreach:$root.settingTabs}"></div>
              </div>
        </div>
        
        <div class="pb_s_b" data-bind="template:{name:'setting-footer'}"></div>
    </div>
</script>

<script id="setting-listitem" type="text/html">
    <div class="pb_popup">
        <div class="pb_s_t" data-bind="mclick:close" >
            <h4><?php _e("Title", "default"); ?>List / Iconic List</h4>
            <a href="#" data-bind="click:$root.closeSetting"></a>
        </div>
        
        <div class="pb_s_m">
              <div>
                  <label><?php _e("Title", "default"); ?> :</label>
                  <input type="text" data-bind="value:title" />
                  <p><?php _e("This is the section title", "default") ?></p>
              </div>
              <div>
                  <label><?php _e("ICON", "default"); ?> :</label>
                  <select data-bind="value:icon">
                      <option value=""><?php _e("None", "default"); ?></option>
                      <option value="disc"><?php _e("Disc", "default"); ?></option>
                      <option value="arrow"><?php _e("Arrow 1", "default"); ?></option>
                      <option value="arrow2"><?php _e("Arrow 2", "default"); ?></option>
                      <option value="arrow3"><?php _e("Arrow 3", "default"); ?></option>
                      <option value="arrow4"><?php _e("Arrow 4", "default"); ?></option>
                      <option value="cross"><?php _e("Cross", "default"); ?></option>
                      <option value="plus"><?php _e("Plus", "default"); ?></option>
                      <option value="pen"><?php _e("Pen", "default"); ?></option>
                      <option value="star"><?php _e("Star", "default"); ?></option>
                      <option value="check"><?php _e("Check", "default"); ?></option>
                      <option value="bookmark"><?php _e("Bookmark", "default"); ?></option>
                      <option value="download"><?php _e("Download", "default"); ?></option>
                      <option value="decimal"><?php _e("Decimal", "default"); ?></option>
                  </select>
                  <p><?php _e("This is the icon for list items", "default") ?></p>
              </div>
              <div>
                  <label><?php _e("Display Bottom Border", "default"); ?> :</label>
                  <select data-bind="value:bordered">
                      <option value="no"><?php _e("No", "default"); ?></option>
                      <option value="dotted"><?php _e("Yes (dotted)", "default"); ?></option>
                      <option value="dashed"><?php _e("Yes (dashed)", "default"); ?></option>
                  </select>
                  <p><?php _e("Do you want to add line between list items?", "default") ?></p>
              </div>
              <div class="st-list">
                  <button class="grey addnew" data-bind="click:addTab">+<?php _e("Add List Item", "default") ?></button>
                  <div class="tabsContainer" data-bind="template:{name:'area-list', foreach:$root.settingTabs}"></div>
              </div>
        </div>
        
        <div class="pb_s_b" data-bind="template:{name:'setting-footer'}"></div>
    </div>
</script>

<script id="setting-gallery" type="text/html">
    <div class="pb_popup">
        <div class="pb_s_t" data-bind="mclick:close" >
            <h4>Gallery</h4>
            <a href="#" data-bind="click:$root.closeSetting"></a>
        </div>
        
        <div class="pb_s_m">
              <div>
                  <label>Header Title :</label>
                  <input type="text" data-bind="value:title" />
                  <p>Lorem ipsum dolor sit amet.</p>
              </div>
              <div>
                <label>Select Gallery :</label>
                <select data-bind="value:id">
                    <option value="none">Choose ..</option>
                    <option value="1">Gallery 1</option>
                </select>
                <p>Lorem ipsum dolor sit amet.</p>
              </div>
              <div>
                <label>Thumbnails Size :</label>
                <select data-bind="value:iSize">
                    <option value="25" >1/4</option>
                    <option value="33" >1/3</option>
                    <option value="50" >1/2</option>
                    <option value="66" >2/3</option>
                    <option value="75" >3/4</option>
                    <option value="100">1/1</option>
                </select>
                <p>Lorem ipsum dolor sit amet.</p>
              </div>
              <div>
                <label>Open Images in :</label>
                <select data-bind="value:type">
                    <option value="lightbox">Lightbox</option>
                    <option value="new">New Window</option>
                </select>
                <p>Lorem ipsum dolor sit amet.</p>
              </div>
        </div>
        
        <div class="pb_s_b" data-bind="template:{name:'setting-footer'}"></div>
    </div>
</script>


<script id="setting-image" type="text/html">
    <div class="pb_popup">
        <div class="pb_s_t" data-bind="mclick:close" >
            <h4><?php _e("Image", "default"); ?></h4>
            <a href="#" data-bind="click:$root.closeSetting"></a>
        </div>
        
        <div class="pb_s_m">
              <div>
                  <label><?php _e("Title", "default"); ?> :</label>
                  <input type="text" data-bind="value:title" />
                  <p><?php _e("This is the section title", "default") ?></p>
              </div>
              <div>
                  <label><?php _e("Image Source","default"); ?> :</label>
                  <input type="text" data-bind="value:src" />
                  <p><?php _e("Enter image source url here", "default"); ?></p>
              </div>
              <div>
                <label><?php _e("Open in Lightbox","default"); ?> :</label>
                <select data-bind="value:lightbox">
                    <option value="yes"><?php _e("Yes", "default"); ?></option>
                    <option value="no"><?php _e("No", "default"); ?></option>
                </select>
                <p><?php _e('Specifies that after click, image opens in lightbox or not. if this option set to "Yes", link option will be ignored.', 'default'); ?></p>
              </div>
              <div>
                  <label><?php _e("Link","default"); ?> :</label>
                  <input type="text" data-bind="value:link" />
                  <p><?php _e('An external link on image. this option will be ignored if you choose to open image in lightbox', 'default'); ?></p>
              </div>
              <div>
                  <label><?php _e("Alternative Text","default"); ?> :</label>
                  <input type="text" data-bind="value:alt" />
                  <p><?php _e('Specifies an alternate text for image (optioanl)', 'default'); ?></p>
              </div>
        </div>
        
        <div class="pb_s_b" data-bind="template:{name:'setting-footer'}"></div>
    </div>
</script>


<script id="setting-video" type="text/html">
    <div class="pb_popup">
        <div class="pb_s_t" data-bind="mclick:close" >
            <h4><?php _e("Video", "default"); ?></h4>
            <a href="#" data-bind="click:$root.closeSetting"></a>
        </div>
        
        <div class="pb_s_m">
              <div>
                  <label><?php _e("Title", "default"); ?> :</label>
                  <input type="text" data-bind="value:title" />
                  <p><?php _e("This is the section title", "default") ?></p>
              </div>
              <div>
                <label><?php _e('Fit Video in Wrapper?', 'default'); ?></label>
                <select data-bind="value:fit">
                    <option value="no"><?php _e('No', 'default'); ?></option>
                    <option value="yes"><?php _e('Yes', 'default'); ?></option>
                </select>
                <p><?php _e('Allow video to fill the warapper or not?', 'default'); ?></p>
              </div>
              <h5><?php _e('Youtube - Vimeo', 'default'); ?> : </h5>
              <div>
                <label><?php _e('Youtube or Vimeo URL', 'default'); ?> :</label>
                <input type="text" data-bind="value:url" />
                <p><?php _e('youtube example : http://www.youtube.com/watch?v=jNVPalNZD_I', 'default'); echo '<br/>'; _e('vimeo example: http://vimeo.com/38149315', 'default'); ?> </p>
              </div>
              <h5><?php _e('Or Self Hosted Video', 'default'); ?> : </h5>
              <div>
                <label><?php _e('Mp4 URL', 'default'); ?> :</label>
                <input type="text" data-bind="value:mp4" />
                <p><?php _e('Internet Explorer 9+, Safari, IOS, Windows Phone 7', 'default'); ?></p>
              </div>
              <div>
                <label><?php _e('WebM URL', 'default'); ?> :</label>
                <input type="text" data-bind="value:webm" />
                <p><?php _e('Internet Explorer 9+, Firefox, Opera, Chrome', 'default'); ?></p>
              </div>
              <div>
                <label><?php _e('Ogg URL', 'default'); ?> :</label>
                <input type="text" data-bind="value:ogg" />
                <p><?php _e('Firefox, Opera, Chrome', 'default'); ?></p>
              </div>
              <div>
                <label><?php _e('FLV URL', 'default'); ?> :</label>
                <input type="text" data-bind="value:flv" />
                <p><?php _e('Flash player fallback for older browsers', 'default'); ?></p>
              </div>
              <div>
                <label><?php _e('Video Image URL', 'default'); ?> :</label>
                <input type="text" data-bind="value:poster" />
                <p><?php _e('specifies an image to be shown while the video is downloading, or until the user hits the play button', 'default'); ?></p>
              </div>
              <div>
                <label><?php _e('Player Skin', 'default'); ?> :</label>
                <select data-bind="value:skin">
                    <option value="dark" ><?php _e('Dark', 'default');  ?></option>
                    <option value="light"><?php _e('Light', 'default'); ?></option>
                </select>
                <p><?php _e('Select Player skin color (this feature is only for self hosted video player)', 'default'); ?></p>
              </div>
        </div>
        
        <div class="pb_s_b" data-bind="template:{name:'setting-footer'}"></div>
    </div>
</script>

<script id="setting-tab" type="text/html">
    <div class="pb_popup">
        <div class="pb_s_t" data-bind="mclick:close" >
            <h4><?php _e("Tab", "default"); ?></h4>
            <a href="#" data-bind="click:$root.closeSetting"></a>
        </div>
        
        <div class="pb_s_m">
              <div>
                  <label><?php _e("Title", "default"); ?> :</label>
                  <input type="text" data-bind="value:title" />
                  <p><?php _e("This is the section title", "default") ?></p>
              </div>
              <!--
              <div>
                  <label>Tabs Position :</label>
                  <select data-bind="value:position">
                      <option value="top" >Top</option>
                      <option value="left">Left</option>
                  </select>
                  <p>Lorem ipsum dolor sit amet.</p>
              </div>-->
              <div>
                  <button class="grey addnew" data-bind="click:addTab" >+<?php _e('Add New Tab', 'default'); ?></button>
                  <div class="tabsContainer" data-bind="template:{name:'area-tab', foreach:$root.settingTabs}"></div>
              </div>
        </div>
        
        <div class="pb_s_b" data-bind="template:{name:'setting-footer'}"></div>
    </div>
</script>

<script id="setting-pages" type="text/html">
    <div class="pb_popup">
        <div class="pb_s_t" data-bind="mclick:close" >
            <h4><?php _e("Pages setting", "default"); ?></h4>
            <a href="#" data-bind="click:$root.closeSetting"></a>
        </div>
        
        <div class="pb_s_m">
              <div>
                  <label><?php _e("Title", "default"); ?> :</label>
                  <input type="text" data-bind="value:title" />
                  <p><?php _e("This is the section title", "default") ?></p>
              </div>
              
              <div class="st-pages">
                  <button class="grey addnew" data-bind="click:addTab" >+<?php _e('Get New Page', 'default'); ?></button>
                  <div class="tabsContainer" data-bind="template:{name:'area-pages', foreach:$root.settingTabs}"></div>
              </div>
              
              <div>
                <label><?php _e("Grid Size", "default"); ?> :</label>
                <select data-bind="value:iSize">
                    <option value="20" >1/5</option>
                    <option value="25" >1/4</option>
                    <option value="33" >1/3</option>
                    <option value="50" >1/2</option>
                    <option value="100">1/1</option>
                </select>
                <p>
                    <?php _e('This is the size of each item.', "default"); ?><br/>
                    <?php _e('For example, "1/2" means each item\'s width is 50% of wrapper width', "default"); ?>
                </p>
              </div>
              
              <div>
                  <label><?php _e("Display Page Title?", "default"); ?></label>
                  <select data-bind="value:viewTitle">
                      <option value="yes"><?php _e("Yes", "default"); ?></option>
                      <option value="no" ><?php _e("No" , "default"); ?></option>
                  </select>
                  <p><?php _e("Do you want to display the neme of each page item?", "default"); ?></p>
              </div>
              <div>
                  <label><?php _e("Display Excerpt?", "default"); ?></label>
                  <select data-bind="value:viewExcerpt">
                      <option value="yes"><?php _e("Yes", "default"); ?></option>
                      <option value="no" ><?php _e("No" , "default"); ?></option>
                  </select>
                  <p><?php _e("Do you want to display the excerpt of each page item?", "default"); ?></p>
              </div>
              <div>
                  <label><?php _e("Max Length of Excerpt", "default"); ?> :</label>
                  <input type="text" data-bind="value:excerpt" />
                  <p><?php _e("Add a number that indicates the maximum length of excerpt text", "default"); ?></p>
              </div>
              
              <div>
                  <label><?php _e("Explore Type", "default"); ?> :</label>
                  <select data-bind="value:type">
                      <option value="regular" ><?php _e("Regular", "default"); ?></option>
                      <option value="slide" ><?php _e("Slideable", "default"); ?></option>
                  </select>
                  <p><?php _e("Regular : Display items in grid", "default"); ?><br/><?php _e("Slideable : Display items as carousel", "default"); ?></p>
              </div>
        </div>
        
        <div class="pb_s_b" data-bind="template:{name:'setting-footer'}"></div>
    </div>
</script>

<script id="setting-chart" type="text/html">
    <div class="pb_popup">
        <div class="pb_s_t" data-bind="mclick:close" >
            <h4><?php _e("Progress Chart", "default"); ?></h4>
            <a href="#" data-bind="click:$root.closeSetting"></a>
        </div>
        
        <div class="pb_s_m">
              <div>
                  <label><?php _e("Title", "default"); ?> :</label>
                  <input type="text" data-bind="value:title" />
                  <p><?php _e("This is the section title", "default") ?></p>
              </div>
              <!--
              <div>
                  <label>Tabs Position :</label>
                  <select data-bind="value:position">
                      <option value="top" >Top</option>
                      <option value="left">Left</option>
                  </select>
                  <p>Lorem ipsum dolor sit amet.</p>
              </div>-->
              <div>
                  <button class="grey addnew" data-bind="click:addTab" >+ <?php _e("Add New Bar", "default"); ?></button>
                  <div class="tabsContainer" data-bind="template:{name:'area-chart', foreach:$root.settingTabs}"></div>
              </div>
        </div>
        
        <div class="pb_s_b" data-bind="template:{name:'setting-footer'}"></div>
    </div>
</script>

<script id="setting-msgbox" type="text/html">
    <div class="pb_popup">
        <div class="pb_s_t" data-bind="mclick:close" >
            <h4><?php _e("Message Box", "default"); ?></h4>
            <a href="#" data-bind="click:$root.closeSetting"></a>
        </div>
        
        <div class="pb_s_m">
            <div>
                  <label><?php _e("Message Box Type", "default"); ?> :</label>
                  <select data-bind="value:type">
                      <option value="none"   ><?php _e("General", "default"); ?></option>
                      <option value="success"><?php _e("Success (green)", "default"); ?></option>
                      <option value="info"   ><?php _e("Info (blue)", "default"); ?></option>
                      <option value="warn"   ><?php _e("Warn (yellow)", "default"); ?></option>
                      <option value="error"  ><?php _e("Error (red)", "default"); ?></option>
                      <option value="notice" ><?php _e("Notice", "default"); ?> </option>
                  </select>
                  <p><?php _e("Select message box style", "default"); ?></p>
              </div>
              <div>
                  <label><?php _e("Display ICON?", "default"); ?></label>
                  <select data-bind="value:showIcon">
                      <option value="yes"><?php _e("Yes", "default"); ?></option>
                      <option value="no" ><?php _e("No" , "default"); ?></option>
                  </select>
                  <p><?php _e("Do you want to display related icon in box?", "default"); ?></p>
              </div>
              <!--<div>
                  <label>Title :</label>
                  <input type="text" data-bind="value:title" />
                  <p>Lorem ipsum dolor sit amet.</p>
              </div>-->
              <div>
                  <label><?php _e("Content", "default"); ?> :</label>
                  <textarea data-bind="value:content" ></textarea>
                  <p><?php _e("Inset the message text here", "default"); ?></p>
              </div>
        </div>
        
        <div class="pb_s_b" data-bind="template:{name:'setting-footer'}"></div>
    </div>
</script>

<script id="setting-news" type="text/html">
    <div class="pb_popup">
        <div class="pb_s_t" data-bind="mclick:close" >
            <h4><?php _e("News", "default"); ?></h4>
            <a href="#" data-bind="click:$root.closeSetting"></a>
        </div>
        
        <div class="pb_s_m">
              <div>
                  <label><?php _e("Title", "default"); ?> :</label>
                  <input type="text" data-bind="value:title" />
                  <p><?php _e("This is the section title", "default") ?></p>
              </div>
              <div>
                <label><?php _e("Grid Size", "default"); ?> :</label>
                <select data-bind="value:iSize">
                    <option value="25" >1/4</option>
                    <option value="33" >1/3</option>
                    <option value="50" >1/2</option>
                    <option value="100">1/1</option>
                </select>
                <p>
                    <?php _e('This is the size of each news item.', "default"); ?><br/>
                    <?php _e('For example, "1/2" means each item\'s width is 50% of wrapper width', "default"); ?>
                </p>
              </div>
              <div>
                  <label><?php _e("Select Category", "default"); ?> :</label>
                  <select data-bind="value:id">
                      <option value="all" ><?php _e("All", "default"); ?></option>
                      <?php $axi_cat_ids = get_categories( array('type' => 'news', 'taxonomy' => 'news-category') ); 
                        foreach ($axi_cat_ids as $tax) 
                            echo '<option value="'.$tax->term_id.'"  >'.$tax->name.'</option>';
                      ?>
                  </select>
                  <p><?php _e("Select the items you want to show", "default"); ?></p>
              </div>
              <div>
                  <label><?php _e("Thumbnails Size", "default"); ?> :</label>
                  <select data-bind="value:thumbPos">
                      <option value="top" ><?php _e("Normal at Top", "default"); ?> </option>
                      <option value="land"><?php _e("Normal at Left", "default"); ?> </option>
                      <option value="mini"><?php _e("Icon Size", "default"); ?> </option>
                  </select>
                  <p><?php _e('This option indicates the media layout and position.', "default"); ?>.</p>
              </div>
              <div>
                  <label><?php _e("Display Thumbnails?", "default"); ?></label>
                  <select data-bind="value:viewThumb">
                      <option value="yes"><?php _e("Yes", "default"); ?></option>
                      <option value="no" ><?php _e("No" , "default"); ?></option>
                  </select>
                  <p><?php _e("Do you want to display the news thumbnail?", "default"); ?></p>
              </div>
              <div>
                  <label><?php _e("Display Date?", "default"); ?></label>
                  <select data-bind="value:dateType">
                      <option value="big"><?php _e("Yes - Calendar Type", "default"); ?></option>
                      <option value="inline"><?php _e("Yes - Text size", "default"); ?></option>
                      <option value="none" ><?php _e("No", "default"); ?></option>
                  </select>
                  <p><?php _e("How Do you want to display news date?", "default"); ?></p>
              </div>
              <div>
                  <label><?php _e('Display "View All" Button ?', "default"); ?></label>
                  <select data-bind="value:viewAll">
                      <option value="yes"><?php _e("Yes", "default"); ?></option>
                      <option value="no" ><?php _e("No", "default"); ?></option>
                  </select>
                  <p><?php _e("Do you want to display a buttom at the end of news items for displaying more news?", "default"); ?></p>
              </div>
              <div>
                  <label><?php _e('Label of "View All" Button', "default"); ?> :</label>
                  <input type="text" data-bind="value:viewAllLabel" />
                  <p></p>
              </div>
              <div>
                  <label><?php _e('Number of Fetched News', "default"); ?> :</label>
                  <select data-bind="value:fetchedNum">
                      <option value="all"><?php _e('All', "default"); ?></option>
                      <?php for ($i=1; $i < 50; $i++) {
                          echo '<option value="'.$i.'"  >'.$i.'</option>';
                      } ?>
                  </select>
                  <p><?php _e('How many News you want to display?', "default"); ?></p>
              </div>
              <div>
                  <label><?php _e("Explore Type", "default"); ?> :</label>
                  <select data-bind="value:type">
                      <option value="regular" ><?php _e("Regular", "default"); ?></option>
                      <option value="slide" ><?php _e("Slideable", "default"); ?></option>
                  </select>
                  <p><?php _e("Regular : Display items in grid", "default"); ?><br/><?php _e("Slideable : Display items as carousel", "default"); ?></p>
              </div>
              <div>
                  <label><?php _e("Auto Scroll", "default"); ?> :</label>
                  <select data-bind="value:uid">
                    <option value="no"><?php _e("No", "default"); ?></option>
                    <option value="yes"  ><?php _e("Yes", "default"); ?></option>
                    <p><?php _e("if 'Explore Type' is 'slide', you can choose to make the slider auto scroll or not", "default") ?></p>
                  </select>
                  <p></p>
              </div>
              <div>
                  <label><?php _e("Max Length of Excerpt", "default"); ?> :</label>
                  <input type="text" data-bind="value:excerpt" />
                  <p><?php _e("Add a number that indicates the maximum length of excerpt text", "default"); ?></p>
              </div>
        </div>
        
        <div class="pb_s_b" data-bind="template:{name:'setting-footer'}"></div>
    </div>
</script>

<script id="setting-blog" type="text/html">
    <div class="pb_popup">
        <div class="pb_s_t" data-bind="mclick:close" >
            <h4><?php _e("Blog", "default"); ?> </h4>
            <a href="#" data-bind="click:$root.closeSetting"></a>
        </div>
        
        <div class="pb_s_m">
              <div>
                  <label><?php _e("Title", "default"); ?> :</label>
                  <input type="text" data-bind="value:title" />
                  <p><?php _e("This is the section title", "default") ?></p>
              </div>
              <div>
                <label><?php _e("Grid Size", "default"); ?> :</label>
                <select data-bind="value:iSize">
                    <option value="25" >1/4</option>
                    <option value="33" >1/3</option>
                    <option value="50" >1/2</option>
                    <option value="100">1/1</option>
                </select>
                <p>
                    <?php _e('This is the size of each post.', "default"); ?><br/>
                    <?php _e('For example, "1/2" means each item\'s width is 50% of wrapper width', "default"); ?>
                </p>
              </div>
              <div>
                  <label><?php _e("Select Category", "default"); ?> :</label>
                  <select data-bind="value:id">
                      <option value="all" ><?php _e("All", "default"); ?></option>
                      <?php $axi_cat_ids = get_categories( array('type' => 'post', 'taxonomy' => 'category') ); 
                        foreach ($axi_cat_ids as $tax) 
                            echo '<option value="'.$tax->term_id.'"  >'.$tax->name.'</option>';
                      ?>
                  </select>
                  <p><?php _e("Select the items you want to show", "default"); ?></p>
              </div>
              <div>
                  <label><?php _e("Thumbnails Size", "default"); ?> :</label>
                  <select data-bind="value:thumbPos">
                      <option value="top" ><?php _e("Normal at Top", "default"); ?> </option>
                      <option value="land"><?php _e("Normal at Left", "default"); ?> </option>
                      <option value="mini"><?php _e("Icon Size", "default"); ?> </option>
                  </select>
                  <p><?php _e('This option indicates the media layout and position.', "default"); ?>.</p>
              </div>
              <div>
                  <label><?php _e("Display Thumbnails?", "default"); ?></label>
                  <select data-bind="value:viewThumb">
                      <option value="yes"><?php _e("Yes", "default"); ?></option>
                      <option value="no" ><?php _e("No" , "default"); ?></option>
                  </select>
                  <p><?php _e("Do you want to display post thumbnail?", "default"); ?></p>
              </div>
              <div>
                  <label><?php _e("Display Date?", "default"); ?></label>
                  <select data-bind="value:dateType">
                      <option value="big"><?php _e("Yes - Calendar Type", "default"); ?></option>
                      <option value="inline"><?php _e("Yes - Text size", "default"); ?></option>
                      <option value="none" ><?php _e("No", "default"); ?></option>
                  </select>
                  <p><?php _e("How Do you want to display post date?", "default"); ?></p>
              </div>
              <div>
                  <label><?php _e('Display "View All" Button ?', "default"); ?></label>
                  <select data-bind="value:viewAll">
                      <option value="yes"><?php _e("Yes", "default"); ?></option>
                      <option value="no" ><?php _e("No", "default"); ?></option>
                  </select>
                  <p><?php _e("Do you want to display a buttom at the end of post items for displaying more posts?", "default"); ?></p>
              </div>
              <div>
                  <label><?php _e('Label of "View All" Button', "default"); ?> :</label>
                  <input type="text" data-bind="value:viewAllLabel" />
                  <p></p>
              </div>
              <div>
                  <label><?php _e('Number of Fetched Posts', "default"); ?> :</label>
                  <select data-bind="value:fetchedNum">
                      <option value="all"><?php _e('All', "default"); ?></option>
                      <?php for ($i=1; $i <= 50; $i++) {
                          echo '<option value="'.$i.'"  >'.$i.'</option>';
                      } ?>
                  </select>
                  <p><?php _e('How many post you want to display?', "default"); ?></p>
              </div>
              <div>
                  <label><?php _e("Explore Type", "default"); ?> :</label>
                  <select data-bind="value:type">
                      <option value="regular" ><?php _e("Regular", "default"); ?></option>
                      <option value="slide" ><?php _e("Slideable", "default"); ?></option>
                  </select>
                  <p><?php _e("Regular : Display items in grid", "default"); ?><br/><?php _e("Slideable : Display items as carousel", "default"); ?></p>
              </div>
              <div>
                  <label><?php _e("Auto Scroll", "default"); ?> :</label>
                  <select data-bind="value:uid">
                    <option value="no"><?php _e("No", "default"); ?></option>
                    <option value="yes"  ><?php _e("Yes", "default"); ?></option>
                    <p><?php _e("if 'Explore Type' is 'slide', you can choose to make the slider auto scroll or not", "default") ?></p>
                  </select>
                  <p></p>
              </div>
              <div>
                  <label><?php _e("Max Length of Excerpt", "default"); ?> :</label>
                  <input type="text" data-bind="value:excerpt" />
                  <p><?php _e("Add a number that indicates the maximum length of excerpt text", "default"); ?></p>
              </div>
        </div>
        
        <div class="pb_s_b" data-bind="template:{name:'setting-footer'}"></div>
    </div>
</script>


<script id="setting-portfolio" type="text/html">
    <div class="pb_popup">
        <div class="pb_s_t" data-bind="mclick:close" >
            <h4><?php _e("Portfolio", "default"); ?></h4>
            <a href="#" data-bind="click:$root.closeSetting"></a>
        </div>
        
        <div class="pb_s_m">
              <div>
                  <label><?php _e("Title", "default"); ?> :</label>
                  <input type="text" data-bind="value:title" />
                  <p><?php _e("This is the section title", "default") ?></p>
              </div>
              <div>
                <label><?php _e("Grid Size", "default"); ?> :</label>
                <select data-bind="value:iSize">
                    <option value="20" >1/5</option>
                    <option value="25" >1/4</option>
                    <option value="33" >1/3</option>
                    <option value="50" >1/2</option>
                    <option value="100">1/1</option>
                </select>
                <p>
                    <?php _e('This is the size of each item.', "default"); ?><br/>
                    <?php _e('For example, "1/2" means each item\'s width is 50% of wrapper width', "default"); ?>
                </p>
              </div>
              <div>
                  <label><?php _e("Select Category", "default"); ?> :</label>
                  <select data-bind="value:id">
                      <option value="all" ><?php _e("All", "default"); ?></option>
                      <?php $axi_cat_ids = get_categories( array('type' => 'portfolio', 'taxonomy' => 'project-type') ); 
                        foreach ($axi_cat_ids as $tax) 
                            echo '<option value="'.$tax->term_id.'"  >'.$tax->name.'</option>';
                      ?>
                  </select>
                  <p><?php _e("Select the items you want to show", "default"); ?></p>
              </div>
              <div>
                  <label><?php _e("Display Portfolio Title?", "default"); ?></label>
                  <select data-bind="value:viewTitle">
                      <option value="yes"><?php _e("Yes", "default"); ?></option>
                      <option value="no" ><?php _e("No" , "default"); ?></option>
                  </select>
                  <p><?php _e("Do you want to display the neme of each portfolio item?", "default"); ?></p>
              </div>
              <div>
                  <label><?php _e("Display Excerpt?", "default"); ?></label>
                  <select data-bind="value:viewExcerpt">
                      <option value="yes"><?php _e("Yes", "default"); ?></option>
                      <option value="no" ><?php _e("No" , "default"); ?></option>
                  </select>
                  <p><?php _e("Do you want to display the excerpt of each portfolio item?", "default"); ?></p>
              </div>
              <div>
                  <label><?php _e("Max Length of Excerpt", "default"); ?> :</label>
                  <input type="text" data-bind="value:excerpt" />
                  <p><?php _e("Add a number that indicates the maximum length of excerpt text", "default"); ?></p>
              </div>
              <div>
                  <label><?php _e('Number of Fetched Posts', "default"); ?> :</label>
                  <select data-bind="value:fetchedNum">
                      <option value="all"><?php _e('All', "default"); ?></option>
                      <?php for ($i=1; $i <= 50; $i++) {
                          echo '<option value="'.$i.'"  >'.$i.'</option>';
                      } ?>
                  </select>
                  <p><?php _e('How many portfolio item you want to display?', "default"); ?></p>
              </div>
              <!--
              <div>
                  <label><?php _e('Number of Visible Items', "default"); ?> :</label>
                  <select data-bind="value:perPage">
                      <option value="all"><?php _e('All', "default"); ?></option>
                      <?php for ($i=1; $i <= 30; $i++) {
                          echo '<option value="'.$i.'"  >'.$i.'</option>';
                      } ?>
                  </select>
                  <p><?php _e('How many portfolio item you want to display?', "default"); ?><br/>
                  </p>
              </div> -->
              <div>
                  <label><?php _e('Display Mode', "default"); ?> :</label>
                  <select data-bind="value:displayMode">
                      <option value="under"  ><?php _e('Text Under Thumbnail', "default"); ?></option>
                      <option value="over" ><?php _e('Text Over Thumbnail', "default"); ?></option>
                  </select>
                  <p><?php _e('Do you want to display portfolio info "Over Thumbnail" or "Under Thumbnail"?', "default"); ?></p>
              </div>
              <div>
                  <label><?php _e("Explore Type", "default"); ?> :</label>
                  <select data-bind="value:type">
                      <option value="regular" ><?php _e("Regular", "default"); ?></option>
                      <option value="slide" ><?php _e("Slideable", "default"); ?></option>
                      <option value="filter"><?php _e("Filterable", "default"); ?></option>
                  </select>
                  <p><?php _e("Regular : Display items in grid", "default"); ?><br/><?php _e("Slideable : Display items as carousel", "default"); ?><br/><?php _e('Filterable : Items can be filtered by "portfolio tags"', 'default'); ?></p>
              </div>
              <!--
              <div>
                  <label>Portfolio Image Hover Effect :</label>
                  <select data-bind="value:effect">
                      <option value="none"  >None</option>
                      <option value="darken">Darken</option>
                  </select>
                  <p>Lorem ipsum dolor sit amet.</p>
              </div>-->
        </div>
        
        <div class="pb_s_b" data-bind="template:{name:'setting-footer'}"></div>
    </div>
</script>

<script id="setting-product" type="text/html">
    <div class="pb_popup">
        <div class="pb_s_t" data-bind="mclick:close" >
            <h4><?php _e('Product', 'default'); ?></h4>
            <a href="#" data-bind="click:$root.closeSetting"></a>
        </div>
        
        <div class="pb_s_m">
              <div>
                  <label><?php _e("Title", "default"); ?> :</label>
                  <input type="text" data-bind="value:title" />
                  <p><?php _e("This is the section title", "default") ?></p>
              </div>
              <div>
                <label><?php _e("Grid Size", "default"); ?> :</label>
                <select data-bind="value:iSize">
                    <option value="20" >1/5</option>
                    <option value="25" >1/4</option>
                    <option value="33" >1/3</option>
                    <option value="50" >1/2</option>
                    <option value="100">1/1</option>
                </select>
                <p>
                    <?php _e('This is the size of each item.', "default"); ?><br/>
                    <?php _e('For example, "1/2" means each item\'s width is 50% of wrapper width', "default"); ?>
                </p>
              </div>
              <div>
                  <label><?php _e("Select Category", "default"); ?> :</label>
                  <select data-bind="value:id">
                      <option value="all" ><?php _e("All", "default"); ?></option>
                      <?php $axi_cat_ids = get_categories( array('type' => 'product', 'taxonomy' => 'product-category') ); 
                        foreach ($axi_cat_ids as $tax) 
                            echo '<option value="'.$tax->term_id.'"  >'.$tax->name.'</option>';
                      ?>
                  </select>
                  <p><?php _e("Select the items you want to show", "default"); ?></p>
              </div>
              <div>
                  <label><?php _e("Display Price?", "default"); ?></label>
                  <select data-bind="value:viewPrice">
                      <option value="yes"><?php _e("Yes", "default"); ?></option>
                      <option value="no" ><?php _e("No" , "default"); ?></option>
                  </select>
                  <p></p>
              </div>
              <div>
                  <label><?php _e('Number of Fetched Products', "default"); ?> :</label>
                  <select data-bind="value:fetchedNum">
                      <option value="all"><?php _e('All', "default"); ?></option>
                      <?php for ($i=1; $i < 50; $i++) {
                          echo '<option value="'.$i.'"  >'.$i.'</option>';
                      } ?>
                  </select>
                  <p><?php _e('How many Product you want to display?', "default"); ?></p>
              </div>
              <div>
                  <label><?php _e('Display Mode', "default"); ?> :</label>
                  <select data-bind="value:displayMode">
                      <option value="grid"  ><?php _e('Grid', "default"); ?></option>
                      <option value="list" ><?php _e('List', "default"); ?></option>
                      <option value="thumblist" ><?php _e('ThumbList', "default"); ?></option>
                  </select>
                  <p><?php _e('<b>Grid :</b> mode is the most common type for displaying products.', "default"); ?><br />
                  <?php _e('<b>List :</b> type is perfect for displaying products in something like restaurant menu.', "default"); ?><br />
                  <?php _e('<b>ThumbList :</b> type is similar to "List" type + Thumbnail if it is available  ', "default"); ?></p>
              </div>
              <div>
                  <label><?php _e("Explore Type", "default"); ?> :</label>
                  <select data-bind="value:type">
                      <option value="regular" ><?php _e("Regular", "default"); ?></option>
                      <option value="slide" ><?php _e("Slideable", "default"); ?></option>
                      <option value="filter"><?php _e("Filterable", "default"); ?></option>
                  </select>
                  <p><?php _e("Regular : Display items in grid", "default"); ?><br/><?php _e("Slideable : Display items as carousel", "default"); ?><br/><?php _e('Filterable : Items can be filtered by "product tags"', 'default'); ?></p>
              </div>
        </div>
        
        <div class="pb_s_b" data-bind="template:{name:'setting-footer'}"></div>
    </div>
</script>

<script id="setting-divider" type="text/html">
    <div class="pb_popup">
        <div class="pb_s_t" data-bind="mclick:close" >
            <h4><?php _e('Divider', 'default'); ?></h4>
            <a href="#" data-bind="click:$root.closeSetting"></a>
        </div>
        
        <div class="pb_s_m">
            <div>
                  <label><?php _e('Type', 'default'); ?> :</label>
                  <select data-bind="value:type">
                      <option value="solid"> <?php _e('Horizontal Solid Line', 'default'); ?></option>
                      <option value="dotted"><?php _e('Horizontal Dotted Line', 'default'); ?></option>
                      <option value="bar" >  <?php _e('Horizontal Bar', 'default'); ?></option>
                      <option value="space"> <?php _e('White Space', 'default'); ?></option>
                  </select>
                  <p></p>
              </div>
              <div>
                  <label><?php _e('Go to Top Text', 'default'); ?> :</label>
                  <input type="text" data-bind="value:text" />
                  <p><?php _e('If you set this field, a text link appears on divider for scrolling to top of page.<br/>Please note that this option just applies to "horizontal line" types', 'default'); ?></p>
              </div>
              <div>
                  <label><?php _e('White Space Height', 'default'); ?> :</label>
                  <select data-bind="value:height">
                      <option value=""><?php _e('Default', 'default'); ?></option>
                      <?php for ($i=1; $i <= 100; $i++) { 
                          echo '<option value="'.$i.'px"  >'.$i.'px</option>';
                      } ?>
                  </select>
                  <p><?php _e('The height of divider in pixel', 'default'); ?></p>
              </div>
        </div>
        
        <div class="pb_s_b" data-bind="template:{name:'setting-footer'}"></div>
    </div>
</script>


<script id="setting-staff" type="text/html">
    <div class="pb_popup">
        <div class="pb_s_t" data-bind="mclick:close" >
            <h4><?php _e("Staff", "default"); ?></h4>
            <a href="#" data-bind="click:$root.closeSetting"></a>
        </div>
        
        <div class="pb_s_m">
              <div>
                  <label><?php _e("Title", "default"); ?> :</label>
                  <input type="text" data-bind="value:title" />
                  <p><?php _e("This is the section title", "default") ?></p>
              </div>
              <div>
                <label><?php _e("Grid Size", "default"); ?> :</label>
                <select data-bind="value:iSize">
                    <option value="20" >1/5</option>
                    <option value="25" >1/4</option>
                    <option value="33" >1/3</option>
                    <option value="50" >1/2</option>
                    <option value="100">1/1</option>
                </select>
                <p>
                    <?php _e('This is the size of each item.', "default"); ?><br/>
                    <?php _e('For example, "1/2" means each item\'s width is 50% of wrapper width', "default"); ?>
                </p>
              </div>
              <div>
                  <label><?php _e("Select Departman", "default"); ?> :</label>
                  <select data-bind="value:id">
                      <option value="all" ><?php _e("All", "default"); ?></option>
                      <?php $axi_cat_ids = get_categories( array('type' => 'staff', 'taxonomy' => 'departman') ); 
                        foreach ($axi_cat_ids as $tax) 
                            echo '<option value="'.$tax->term_id.'"  >'.$tax->name.'</option>';
                      ?>
                  </select>
                  <p><?php _e("Which departman you want to show?", "default"); ?></p>
              </div>
              <div>
                  <label><?php _e("Display Staff Socials?", "default"); ?></label>
                  <select data-bind="value:viewSocial">
                      <option value="no" ><?php _e("No", "default"); ?></option>
                      <option value="yes"><?php _e("Yes", "default"); ?></option>
                  </select>
                  <p><?php _e("Do you want to display staff's social info?", "default"); ?></p>
              </div>
              <div>
                  <label><?php _e("Display Staff Excerpt?", "default"); ?></label>
                  <select data-bind="value:viewExcerpt">
                      <option value="no" ><?php _e("No", "default"); ?></option>
                      <option value="yes"><?php _e("Yes", "default"); ?></option>
                  </select>
                  <p></p>
              </div>
              <div>
                  <label><?php _e("Link to Single Page?", "default"); ?></label>
                  <select data-bind="value:linkToSingle">
                      <option value="no" ><?php _e("No", "default"); ?></option>
                      <option value="yes"><?php _e("Yes", "default"); ?></option>
                  </select>
                  <p><?php _e("Do you want to link thumbnail to staff single page?", "default"); ?></p>
              </div>
        </div>
        
        <div class="pb_s_b" data-bind="template:{name:'setting-footer'}"></div>
    </div>
</script>

<script id="setting-service" type="text/html">
    <div class="pb_popup">
        <div class="pb_s_t" data-bind="mclick:close" >
            <h4><?php _e("Services", "default"); ?></h4>
            <a href="#" data-bind="click:$root.closeSetting"></a>
        </div>
        
        <div class="pb_s_m">
              <div>
                  <label><?php _e("Title", "default"); ?> :</label>
                  <input type="text" data-bind="value:title" />
                  <p><?php _e("This is the section title", "default") ?></p>
              </div>
              
              <div>
                <label><?php _e("Select Service", "default"); ?> :</label>
                  <select data-bind="value:id">
                      <option value="all" ><?php _e("All", "default"); ?></option>
                      <?php $axi_cat_ids = get_categories( array('type' => 'service', 'taxonomy' => 'service-category') ); 
                        foreach ($axi_cat_ids as $tax) 
                            echo '<option value="'.$tax->term_id.'"  >'.$tax->name.'</option>';
                      ?>
                  </select>
                  <p><?php _e("Which service category you want to display?", "default"); ?></p>
              </div>
              <div>
                <label><?php _e("Appearance Type", "default"); ?> :</label>
                <select data-bind="value:type">
                    <option value="tab"   ><?php _e("Tab", "default"); ?></option>
                    <option value="column"><?php _e("Column (grid view)", "default"); ?></option>
                </select>
                <p><?php _e("How do you want to display services?", "default"); ?></p>
              </div>
              <div>
                <label><?php _e("Grid Size", "default"); ?> :</label>
                <select data-bind="value:iSize">
                    <option value="25" >1/4</option>
                    <option value="33" >1/3</option>
                    <option value="50" >1/2</option>
                    <option value="100">1/1</option>
                </select>
                <p>
                    <?php _e('This is the size of each item.', "default"); ?><br/>
                    <?php _e('For example, "1/2" means each item\'s width is 50% of wrapper width', "default"); ?><br/>
                    <?php _e('(Note : This option will be ignored if the "Appearance Type" is "Tab") ', "default"); ?>
                </p>
              </div>
              <div>
                  <label><?php _e("Link to Single Page?", "default"); ?></label>
                  <select data-bind="value:uid">
                      <option value="no" ><?php _e("No", "default"); ?></option>
                      <option value="yes"><?php _e("Yes", "default"); ?></option>
                  </select>
                  <p><?php _e("Do you want to link each service to it's single page?", "default"); ?></p>
              </div>
              <div>
                  <label><?php _e("Max Length of Excerpt", "default"); ?> :</label>
                  <input type="text" data-bind="value:excerpt" />
                  <p><?php _e("Add a number that indicates the maximum length of excerpt text", "default"); ?></p>
              </div>
        </div>
        
        <div class="pb_s_b" data-bind="template:{name:'setting-footer'}"></div>
    </div>
</script>

<script id="setting-testimonial" type="text/html">
    <div class="pb_popup">
        <div class="pb_s_t" data-bind="mclick:close" >
            <h4><?php _e("Testimonial", "default"); ?></h4>
            <a href="#" data-bind="click:$root.closeSetting"></a>
        </div>
        
        <div class="pb_s_m">
              <div>
                  <label><?php _e("Title", "default"); ?> :</label>
                  <input type="text" data-bind="value:title" />
                  <p><?php _e("This is the section title", "default") ?></p>
              </div>
              <div>
                <label><?php _e("Display Item(s) From", "default"); ?> :</label>
                <select data-bind="value:idType" data-role="selector" >
                    <option value="specific" ><?php _e("Specific", "default"); ?></option>
                    <option value="category"> <?php _e("Category", "default"); ?></option>
                </select>
                <p><?php _e('Do you want to display one "specific" or several (category) testimonial?', "default"); ?></p>
              </div>
              
              <div data-target="specific" >
                <label><?php _e("Select Testimonial Item", "default"); ?> :</label>
                  <select data-bind="value:singleId">
                      <option value=""><?php _e("Select ..", "default"); ?></option>
                    <?php 
                        $args = array(
                          'post_type' => 'testimonial',
                          'orderby' => "date",
                          'post_status' => 'publish',
                          'posts_per_page' => -1
                        );
                        
                        $th_query = null;
                        $th_query = new WP_Query($args);  
                        if( $th_query->have_posts() ):  while ($th_query->have_posts()) : $th_query->the_post();
                            echo '<option value="'.$th_query->post->ID.'"  >'.get_the_title().'</option>';
                        endwhile; endif; 
                        wp_reset_query();
                        unset($args);
                    ?>
                  </select>
                  <p><?php _e('Here you can select one "specific" testimonial', "default"); ?></p>
              </div>
              <div data-target="category" >
                <label><?php _e("Select Testimonial Category", "default"); ?> :</label>
                  <select data-bind="value:catId">
                      <option value=""><?php _e("Select ..", "default"); ?></option>
                      <?php $axi_cat_ids = get_categories( array('type' => 'yestimonial', 'taxonomy' => 'testimonial-category') ); 
                        foreach ($axi_cat_ids as $tax) 
                            echo '<option value="'.$tax->term_id.'"  >'.$tax->name.'</option>';
                      ?>
                  </select>
                  <p><?php _e('Here you can select a category of testimonial', "default"); ?></p><br/>
                  <p><?php _e('If the category have more than one testimonial, they will be displayed as carousel', "default"); ?></p>
              </div>              
              <div>
                <label><?php _e("Appearance Type", "default"); ?> :</label>
                <select data-bind="value:type">
                    <option value="blockquote"><?php _e("Blockquote", "default"); ?></option>
                    <option value="box"  ><?php _e("Box", "default"); ?></option>
                </select>
                <p><?php _e('Do you want to display testimonials as blockquote or "spread box"?', "default") ?></p>
              </div>
        </div>
        
        <div class="pb_s_b" data-bind="template:{name:'setting-footer'}"></div>
    </div>
</script>

<script id="setting-client" type="text/html">
    <div class="pb_popup">
        <div class="pb_s_t" data-bind="mclick:close" >
            <h4><?php _e("Clients / Partners / Sponsors", "default"); ?></h4>
            <a href="#" data-bind="click:$root.closeSetting"></a>
        </div>
        
        <div class="pb_s_m">
              <div>
                  <label><?php _e("Title", "default"); ?> :</label>
                  <input type="text" data-bind="value:title" />
                  <p><?php _e("Specifies the section title.(optional)", "default") ?></p>
              </div>
              <div>
                  <label><?php _e("Display Type", "default"); ?> :</label>
                  <select data-bind="value:displayType">
                    <option value="slider"><?php _e("Slider", "default"); ?></option>
                    <option value="normal"  ><?php _e("All Visible", "default"); ?></option>
                  </select>
                  <p></p>
              </div>
              <div>
                  <label><?php _e("Auto Scroll", "default"); ?> :</label>
                  <select data-bind="value:uid">
                    <option value="no"><?php _e("No", "default"); ?></option>
                    <option value="yes"  ><?php _e("Yes", "default"); ?></option>
                    <p><?php _e("if 'Display Type' is 'Slider', you can choose to make the slider auto scroll or not", "default") ?></p>
                  </select>
                  <p></p>
              </div>
              <!--
              <div>
                  <label>Image Height (pixel) :</label>
                  <input type="text" data-bind="value:height" />
                  <p>Lorem ipsum dolor sit amet.</p>
              </div>-->
              <div>
                  <button class="grey addnew" data-bind="click:addTab" >+ <?php _e("Add New Image", "default"); ?></button>
                  <div class="tabsContainer" data-bind="template:{name:'area-image', foreach:$root.settingTabs}"></div>
              </div>
        </div>
        
        <div class="pb_s_b" data-bind="template:{name:'setting-footer'}"></div>
    </div>
</script>

<script id="setting-map" type="text/html">
    <div class="pb_popup">
        <div class="pb_s_t" data-bind="mclick:close" >
            <h4><?php _e("Map", "default"); ?></h4>
            <a href="#" data-bind="click:$root.closeSetting"></a>
        </div>
        
        <div class="pb_s_m">
              <div>
                  <label><?php _e("Title", "default"); ?> :</label>
                  <input type="text" data-bind="value:title" />
                  <p><?php _e("Specifies the section title.(optional)", "default") ?></p>
              </div>
              <div>
                  <label><?php _e("Type of Map", "default"); ?> :</label>
                  <select data-bind="value:type">
                      <option value="ROADMAP"   ><?php _e("Road Map", "default"); ?></option>
                      <option value="SATELLITE" ><?php _e("Satellite", "default"); ?> </option>
                      <option value="HYBRID"    ><?php _e("Hybrid", "default"); ?> </option>
                      <option value="TERRAIN"   ><?php _e("Terrain", "default"); ?> </option>
                  </select>
                  <p></p>
              </div>
              <div>
                  <label><?php _e("Map Height (pixel)", "default"); ?>:</label>
                  <input type="text" data-bind="value:height" />
                  <p></p>
              </div>
              <div>
                  <label><?php _e("Latitude", "default"); ?> :</label>
                  <input type="text" data-bind="value:lat" />
                  <p><?php _e("Insert your location\'s Latitude here", "default"); ?></p>
              </div>
              <div>
                  <label><?php _e("Longitude", "default"); ?> :</label>
                  <input type="text" data-bind="value:lon" />
                  <p><?php _e("Insert your location\'s Longitude here", "default"); ?></p>
              </div>
              <div>
                  <label><?php _e("Zoom", "default"); ?> :</label>
                  <select data-bind="value:zoom">
                  <?php for ($i=1; $i < 22; $i++) { 
                      echo '<option value="'.$i.'"  >'.$i.'</option>';
                  } ?>
                  </select>
                  <p><?php _e("this is the map Zoom level on your location", "default"); ?></p>
              </div>
              <div>
                  <label><?php _e("Marker Caption", "default"); ?> :</label>
                  <input type="text" data-bind="value:info" />
                  <p><?php _e("This is the caption appears on your location", "default"); ?></p>
              </div>
        </div>
        
        <div class="pb_s_b" data-bind="template:{name:'setting-footer'}"></div>
    </div>
</script>

<script id="setting-contact" type="text/html">
    <div class="pb_popup">
        <div class="pb_s_t" data-bind="mclick:close" >
            <h4><?php _e("Contact Form", "default"); ?></h4>
            <a href="#" data-bind="click:$root.closeSetting"></a>
        </div>
        
        <div class="pb_s_m">
              <div>
                  <label><?php _e("Title", "default"); ?> :</label>
                  <input type="text" data-bind="value:title" />
                  <p><?php _e("Specifies the section title.(optional)", "default") ?></p>
              </div>
              <div>
                  <label><?php _e("Contact Form Type", "default"); ?> :</label>
                  <select data-bind="value:type">
                      <option value="built-in" ><?php _e("Use Built-in Contact Form", "default"); ?></option>
                      <option value="wcf7"     ><?php _e("Use Contact Form 7 Plugin", "default"); ?> </option>
                  </select>
                  <p><?php _e('You can use built-in contact form , or you can use "contact form 7" plugin', 'default'); ?></p>
              </div>
              <div>
                  <label><?php _e("Email Address", "default"); ?> :</label>
                  <input type="text" data-bind="value:email" />
                  <p><?php _e("This is the email that built-in contact form uses to send contacts to.", "default"); ?></p>
              </div>
              <div>
                  <label><?php _e("Enter Contact form 7 shortcode ", "default"); ?>:</label>
                  <input type="text" data-bind="value:wcf7" />
                  <p><?php _e('Please paste contact form 7 shortcode here. (when you create a form in contact form 7 plugin, the plugin will generate a shortcode for using in pages. copy that shortcode and paste here. a shortcode sample : [contact-form-7 id="78" title="Contact form 1"] ).', 'default'); ?></p>
              </div>
        </div>
        
        <div class="pb_s_b" data-bind="template:{name:'setting-footer'}"></div>
    </div>
</script>

<script id="setting-price" type="text/html">
    <div class="pb_popup">
        <div class="pb_s_t" data-bind="mclick:close" >
            <h4><?php _e("Price Table", "default"); ?></h4>
            <a href="#" data-bind="click:$root.closeSetting"></a>
        </div>
        
        <div class="pb_s_m">
              <div>
                  <label><?php _e("Title", "default"); ?> :</label>
                  <input type="text" data-bind="value:title" />
                  <p><?php _e("Specifies the section title", "default") ?></p>
              </div>
              <div>
                <label>Select Price Table :</label>
                <select data-bind="value:id">
                    <option value="none"><?php _e("Choose ..", "default"); ?></option>
                <?php 
                    $args = array(
                      'post_type' => 'pricetable',
                      'orderby' => "date",
                      'post_status' => 'publish'
                    );
                    
                    $th_query = null;
                    $th_query = new WP_Query($args);  
                    if( $th_query->have_posts() ):  while ($th_query->have_posts()) : $th_query->the_post();
                        echo '<option value="'.$th_query->post->ID.'"  >'.get_the_title().'</option>';
                    endwhile; endif; 
                    wp_reset_query();
                    
                    unset($args);
                ?>
                </select>

                <p></p>
              </div>
        </div>
        
        <div class="pb_s_b" data-bind="template:{name:'setting-footer'}"></div>
    </div>
</script>

<script id="setting-twitter" type="text/html">
    <div class="pb_popup">
        <div class="pb_s_t" data-bind="mclick:close" >
            <h4><?php _e("Latest Tweets", "default"); ?> :</h4>
            <a href="#" data-bind="click:$root.closeSetting"></a>
        </div>
        
        <div class="pb_s_m">
              <div>
                  <label><?php _e("Username", "default"); ?> :</label>
                  <input type="text" data-bind="value:user" />
                  <p><?php _e('Enter the twitter username you want to display latest tweets from. also you can add multi usernames by seperating each username by ","', "default"); ?></p>
              </div>
              <div>
                  <label><?php _e("Title", "default"); ?> :</label>
                  <input type="text" data-bind="value:title" />
                  <p><?php _e("Specifies the section title", "default") ?></p>
              </div>
              <div>
                  <label><?php _e("Number of Tweets", "default"); ?> :</label>
                  <select data-bind="value:num">
                      <?php for ($i=1; $i < 15; $i++) { 
                          echo '<option value="'.$i.'"  >'.$i.'</option>';
                      } ?>
                  </select>
                  <p><?php _e("Max Number of tweets to display", "default"); ?>.</p>
              </div>
              <div>
                  <label><?php _e("Display Avatar?", "default"); ?> :</label>
                  <select data-bind="value:avatar">
                      <option value="yes"><?php _e("Yes", "default"); ?></option>
                      <option value="no" ><?php _e("No" , "default"); ?></option>
                  </select>
                  <p></p>
              </div>
        </div>
        
        <div class="pb_s_b" data-bind="template:{name:'setting-footer'}"></div>
    </div>
</script>

<script id="setting-faq" type="text/html">
    <div class="pb_popup">
        <div class="pb_s_t" data-bind="mclick:close" >
            <h4><?php _e("FAQ", "default"); ?></h4>
            <a href="#" data-bind="click:$root.closeSetting"></a>
        </div>
        
        <div class="pb_s_m">
              <div>
                  <label><?php _e("Title", "default"); ?> :</label>
                  <input type="text" data-bind="value:title" />
                  <p><?php _e("Specifies the section title", "default") ?></p>
              </div>
              <div>
                  <label><?php _e("Select Category", "default"); ?> :</label>
                  <select data-bind="value:id">
                      <option value="all" ><?php _e("All", "default"); ?></option>
                      <?php $axi_cat_ids = get_categories( array('type' => 'faq', 'taxonomy' => 'faq-category') ); 
                        foreach ($axi_cat_ids as $tax) 
                            echo '<option value="'.$tax->term_id.'"  >'.$tax->name.'</option>';
                      ?>
                  </select>
                  <p><?php _e("which FAQ items you want to display?", "default"); ?></p>
              </div>
              <!--
              <div>
                  <label>Always One Item Visible?</label>
                  <select data-bind="value:viewOne">
                      <option value="no" >No</option>
                      <option value="yes">Yes</option>
                  </select>
                  <p>Lorem ipsum dolor sit amet.</p>
              </div>-->
              
        </div>
        
        <div class="pb_s_b" data-bind="template:{name:'setting-footer'}"></div>
    </div>
</script>

<?php $post = $bu_the_post; ?>
