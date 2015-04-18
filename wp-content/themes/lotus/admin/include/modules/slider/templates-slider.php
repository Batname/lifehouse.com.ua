
<script id="temp_none" type="text/html" >
</script>

<script id="temp_general" type="text/html" >
    
    <div class="sBlock">
        <div class="tab-bar clearfix">
            <span class="sliderBlockName"><?php _e("General Setting", "default") ?></span>
            <div class="expand" data-bind="click:toggle">-</div>
        </div>
        <ul class="tabs-content" >
            <li>
                <div class="slider_fields_w">
                    <!--<div><span>Width  : </span><input type="text" data-bind="value:width" /><em data-desc="Width of slider wrapper in pixel." ></em></div>-->
                    <div><span><?php _ex("Max Height", "the max height for flexslider", "default") ?> : </span><input type="text" data-bind="value:height" /><em data-desc="Max height of slider wrapper in pixel. (0 means no max height)" ></em></div>
                    <!--<div><span><?php  _e("Slide Spacing", "default") ?> : </span><input type="text" data-bind="value:spacing" /><em data-desc="Size of blanck space around slider in pixel." ></em></div>-->
                    <!--<div><span>Randon Start : </span><select data-bind="value:random"><option value="yes">Yes</option><option value="no">No</option></select><em data-desc="Start on a random slide or not?" ></em></div>-->
                </div>
            </li>
        </ul>
    </div>
    
</script>

<script id="temp_nivo" type="text/html" >
    <div class="sBlock">
        <div class="tab-bar clearfix">
            <span class="sliderBlockName">Nivo Slider</span>
            <ul class="tabs">
                <li class="active"><a>Interface</a></li>
                <li><a>Transition</a></li>
            </ul>
            <div class="expand" data-bind="click:toggle">-</div>
        </div>
        <ul class="tabs-content">
            <li style="display:block">
                <div class="slider_fields_w">
                    <div><span>Use Arrows : </span>
                        <select data-bind="value:showArrows" ><option value="yes">Yes</option><option value="no">No</option></select>
                        <em data-desc="Display 'Next' and 'Prev' navigation arrows?" ></em>
                    </div>
                    <!--
                    <div><span>Auto-hide Arrows : </span>
                        <select data-bind="value:autohide" ><option value="yes">Yes</option><option value="no">No</option></select>
                        <em data-desc="Only show arrows on hover?" ></em>
                    </div>-->
                    <div><span>Control Navigation Type : </span>
                        <select data-bind="value:controlType" >
                            <option value="none"     >None</option>
                            <option value="bullet"   >Bullet</option>
                        </select>
                        <em data-desc="Type of navigation control. ('none' means do not display controls)" ></em>
                    </div>
                    <div><span>Pause on Hover : </span>
                        <select data-bind="value:pauseOnHover" ><option value="yes">Yes</option><option value="no">No</option></select>
                        <em data-desc="Stop animation while hovering?" ></em>
                    </div>
                    <!--
                    <div><span>Slideshow : </span>
                        <select data-bind="value:slideshow" ><option value="yes">Yes</option><option value="no">No</option></select>
                        <em data-desc="Animate slider automatically?" ></em>
                    </div>-->
                </div>
            </li>
            <li>
                <div class="slider_fields_w">
                    <div><span>Transition Speed(ms) : </span><input type="text" data-bind="value:tranSpeed" /><em data-desc="Slide transition speed (milisecond)." ></em></div>
                    <div><span>Show Time(ms) : </span><input type="text" data-bind="value:showTime" /><em data-desc="How long each slide will show (milisecond)." ></em></div>
                    <div><span>Box Columns : </span><input type="text" data-bind="value:boxCols" /><em data-desc="Number of vertical slices for box animations." ></em></div>
                    <div><span>Box Rows : </span><input type="text" data-bind="value:boxRows" /><em data-desc="Number of horizontal slices for box animations." ></em></div>
                    <div><span>Slices : </span><input type="text" data-bind="value:slices" /><em data-desc="Number of slices for slice animations." ></em></div>
                    
                    <div><span>Animation Effect : </span>
                        <select data-bind="value:effect">
                            <option value="random"><?php _e('Random', 'default'); ?></option>
                            <option value="sliceDown"><?php _e('sliceDown', 'default'); ?></option>
                            <option value="sliceDownLeft"><?php _e('sliceDownLeft', 'default'); ?></option>
                            <option value="sliceUp"><?php _e('sliceUp', 'default'); ?></option>
                            <option value="sliceUpLeft"><?php _e('sliceUpLeft', 'default'); ?></option>
                            <option value="sliceUpDown"><?php _e('sliceUpDown', 'default'); ?></option>
                            <option value="sliceUpDownLeft"><?php _e('sliceUpDownLeft', 'default'); ?></option>
                            <option value="fold"><?php _e('fold', 'default'); ?></option>
                            <option value="fade"><?php _e('fade', 'default'); ?></option>
                            <option value="slideInRight"><?php _e('slideInRight', 'default'); ?></option>
                            <option value="slideInLeft"><?php _e('slideInLeft', 'default'); ?></option>
                            <option value="boxRandom"><?php _e('boxRandom', 'default'); ?></option>
                            <option value="boxRain"><?php _e('boxRain', 'default'); ?></option>
                            <option value="boxRainReverse"><?php _e('boxRainReverse', 'default'); ?></option>
                            <option value="boxRainGrow"><?php _e('boxRainGrow', 'default'); ?></option>
                            <option value="boxRainGrowReverse"><?php _e('boxRainGrowReverse', 'default'); ?></option>
                        </select>
                        <em data-desc="Select animation type" ></em>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</script>

<script id="temp_flex" type="text/html" >
    <div class="sBlock">
        <div class="tab-bar clearfix">
            <span class="sliderBlockName">Flex Slider</span>
            <ul class="tabs">
                <li class="active"><a>Interface</a></li>
                <li><a>Transition</a></li>
            </ul>
            <div class="expand" data-bind="click:toggle">-</div>
        </div>
        <ul class="tabs-content">
            <li style="display:block">
                <div class="slider_fields_w">
                    <div><span>Use Arrows : </span>
                       <select data-bind="value:showArrows" ><option value="yes">Yes</option><option value="no">No</option></select>
                       <em data-desc="Display 'Next' and 'Prev' navigation arrows?" ></em>
                    </div>
                    <!--
                    <div><span>Auto-hide Arrows : </span>
                        <select data-bind="value:autohide" ><option value="yes">Yes</option><option value="no">No</option></select>
                        <em data-desc="Only show arrows on hover?" ></em>
                    </div>
                    -->
                    <div><span>Control Navigation Type : </span>
                        <select data-bind="value:controlType" >
                            <option value="none">None</option>
                            <option value="bullet">Bullet</option>
                            <!--<option value="thumbnail">Thumbnail</option>-->
                        </select>
                        <em data-desc="Type of navigation control. ('none' means do not display controls)" ></em>
                    </div>
                    <div><span>Pause on Hover : </span>
                        <select data-bind="value:pauseOnHover" ><option value="yes">Yes</option><option value="no">No</option></select>
                        <em data-desc="Stop animation while hovering?" ></em>
                    </div>
                    <!--
                    <div><span>Reverse Animation : </span>
                        <select data-bind="value:reverse " ><option value="yes">Yes</option><option value="no">No</option></select>
                        <em data-desc="Reverse the animation direction?" ></em>
                    </div>
                    -->
                    <div><span>Animation Loop : </span>
                        <select data-bind="value:loop" ><option value="yes">Yes</option><option value="no">No</option></select>
                        <em data-desc="Should the animation loop? If 'No', arrow button will disable at either end" ></em>
                    </div>
                    <div><span>Smooth Height : </span>
                        <select data-bind="value:smoothHeight" ><option value="yes">Yes</option><option value="no">No</option></select>
                        <em data-desc="Allow height of the slider to animate smoothly in horizontal mode?" ></em>
                    </div>
                    <div><span>Slideshow : </span>
                        <select data-bind="value:slideshow" ><option value="yes">Yes</option><option value="no">No</option></select>
                        <em data-desc="Animate slider automatically?" ></em>
                    </div>
                </div>
            </li>
            <li>
                <div class="slider_fields_w">
                    <div><span>Transition Speed(ms) : </span><input type="text" data-bind="value:tranSpeed" /><em data-desc="Slide transition speed (milisecond)." ></em></div>
                    <div><span>Show Time(ms) : </span><input type="text" data-bind="value:showTime" /><em data-desc="How long each slide will show (milisecond)." ></em></div>
                    <div><span>Animation Effect : </span>
                        <select data-bind="value:effect">
                            <option value="slide">Slide </option>
                            <option value="fade">Fade</option>
                        </select>
                        <em data-desc="Select animation type" ></em>
                    </div>
                    <div><span>Easing : </span>
                        <select data-bind="value:easing" style="width:160px;">
                            <option value="swing">swing</option>
                            <option value="linear">linear</option>
                            <option value="easeInQuad">easeInQuad</option>
                            <option value="easeOutQuad">easeOutQuad</option>
                            <option value="easeInOutQuad">easeInOutQuad</option>
                            <option value="easeInCubic">easeInCubic</option>
                            <option value="easeOutCubic">easeOutCubic</option>
                            <option value="easeInOutCubic">easeInOutCubic</option>
                            <option value="easeInQuart">easeInQuart</option>
                            <option value="easeOutQuart">easeOutQuart</option>
                            <option value="easeInOutQuart">easeInOutQuart</option>
                            <option value="easeInQuint">easeInQuint</option>
                            <option value="easeOutQuint">easeOutQuint</option>
                            <option value="easeInOutQuint">easeInOutQuint</option>
                            <option value="easeInSine">easeInSine</option>
                            <option value="easeOutSine">easeOutSine</option>
                            <option value="easeInOutSine">easeInOutSine</option>
                            <option value="easeInExpo">easeInExpo</option>
                            <option value="easeOutExpo">easeOutExpo</option>
                            <option value="easeInOutExpo">easeInOutExpo</option>
                            <option value="easeInCirc">easeInCirc</option>
                            <option value="easeOutCirc">easeOutCirc</option>
                            <option value="easeInOutCirc">easeInOutCirc</option>
                            <option value="easeInElastic">easeInElastic</option>
                            <option value="easeOutElastic">easeOutElastic</option>
                            <option value="easeInOutElastic">easeInOutElastic</option>
                            <option value="easeInBack">easeInBack</option>
                            <option value="easeOutBack">easeOutBack</option>
                            <option value="easeInOutBack">easeInOutBack</option>
                            <option value="easeInBounce">easeInBounce</option>
                            <option value="easeOutBounce">easeOutBounce</option>
                            <option value="easeInOutBounce">easeInOutBounce</option>
                        </select>
                        <em data-desc="Determines the easing method used in transitions." ></em>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</script>

<script id="temp_slide" type="text/html">
    <div class="slideWrapper" >
        <div class="slideImage">
            <div class="dragHandle"> </div>
            <div class="imgHolder">
                <img data-bind="attr:{src:imageURL}, css:{hidden:previewState}" alt="">
                <a data-bind="visible:previewState, click:uploadImage" ><strong>Click Here To Add An Image</strong></a>
            </div>
        </div>
        
        <div class="sBlock">
            <div class="tab-bar clearfix">
                <ul class="tabs">
                    <li class="active"><a>Image</a></li>
                    <li><a>Caption</a></li>
                    <li><a>Link</a></li>
                    <li><a>Effect</a></li>
                </ul>
                <div class="close" data-bind="click:remove" title="Remove slide">x</div>
            </div>
            
            <ul class="tabs-content">
                <li style="display:block">
                    <div class="slider_fields_w">
                        <div class="full_c"><span>Image URL :</span>
                            <input type="text" data-bind="value:imageURL" />
                            <em data-desc="Insert your image url here, or use image uploader in image preview section. to remove image just delete Image URL." ></em>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="slider_fields_w">
                        <div class="full_c"><span>Slide Caption : </span>
                            <textarea data-bind="value:caption"></textarea>
                            <em data-desc="The text you want to add on image. Inline HTML captions are supported, so you can use tag such as <code>span</code>, <code>small</code>, <code>em</code>, <code>i</code>, ... in your text" ></em>
                        </div>
                    </div>
                </li>
                <li style="display:block">
                    <div class="slider_fields_w">
                        <div class="full_c"><span>Link :</span>
                            <input type="text" data-bind="value:link" />
                            <em data-desc="If you want to drop a link on this slide, insert your link here, else leave it blank" ></em>
                        </div>
                        <div><span>Target : </span>
                            <select data-bind="value:target" >
                                <option value="_blank">_blank</option>
                                <option value="_self">_self</option>
                            </select>
                            <em data-desc="The target attribute specifies where to open the linked document.(blank : open link in new page, self: open link in same page)" ></em>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="slider_fields_w">
                        <div data-bind="visible:$root.type()=='flex'" ><span>No Custom Effect</span>
                            <em data-desc="In FlexSlider you can not assign custom effect to each slide.All slides have same effect." ></em>
                        </div>
                        <div class="big_c" data-bind="visible:$root.type()=='nivo'"><span>Animation Effect : </span>
                            <select data-bind="value:effect">
                                <option value="">random</option>
                                <option value="sliceDown">sliceDown</option>
                                <option value="sliceDownLeft">sliceDownLeft</option>
                                <option value="sliceUp">sliceUp</option>
                                <option value="sliceUpLeft">sliceUpLeft</option>
                                <option value="sliceUpDown">sliceUpDown</option>
                                <option value="sliceUpDownLeft">sliceUpDownLeft</option>
                                <option value="fold">fold</option>
                                <option value="fade">fade</option>
                                <option value="slideInRight">slideInRight</option>
                                <option value="slideInLeft">slideInLeft</option>
                                <option value="boxRandom">boxRandom</option>
                                <option value="boxRain">boxRain</option>
                                <option value="boxRainReverse">boxRainReverse</option>
                                <option value="boxRainGrow">boxRainGrow</option>
                                <option value="boxRainGrowReverse">boxRainGrowReverse</option>
                            </select>
                            <em data-desc="Select animation type" ></em>
                        </div>
                    </div>
                </li>
            </ul>
            
        </div>
    </div>
</script>