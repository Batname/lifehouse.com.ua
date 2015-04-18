        
        <!-- audio player-->
        <div id="<?php echo $uid.'m'; ?>" class="jp-audio <?php echo ($skin == "light")?"jp-light":""; ?>">
            <div class="jp-type-single">
              
              <div id="<?php echo $uid; ?>" class="jp-jplayer"></div>
              
              
              <!-- audio controls -->
              <div class="jp-gui">
                  
                <div class="jp-interface">
                  
                    <ul class="jp-play-controls">
                      <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
                      <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
                    </ul>
                    
                    <div class="jp-current-time"></div>
                    
                    <div class="jp-progress-container" >
                        <div class="jp-progress">
                            <div class="jp-seek-bar">
                                <div class="jp-play-bar"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="jp-volume-toggle" >
                        
                        <div class="jp-volume-container">
                            <ul class="jp-volume-controls">
                              <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
                              <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
                            </ul>
                            
                            <div class="jp-volume-bar">
                              <div class="jp-volume-bar-value"></div>
                            </div>
                        </div>
                    </div>
                    
                </div>
              </div>
              <div class="jp-no-solution">
                <span>Update Required</span>
                To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
              </div>
            </div>
        </div><!-- end audio player-->
       
<?php 
    $audio_files   = "";
    $audio_files  .= (!empty($mp3)  )?'m4a:"'.$mp3.'",':'';
    $audio_files  .= (!empty($ogg)  )?'oga:"'.$ogg.'",':'';
    
    if(strlen($audio_files)) $audio_files = substr($audio_files, 0, -1);
?>
 
<script>
    jQuery(document).ready(function($){
      $ = jQuery.noConflict();
      $.jPlayer.prototype.optionsVideo.size = { cssClass: 'jp-video-resp', width:'100%', height:'auto' };  
      $.jPlayer.prototype.options.preload   = "none";  
      
      $("#<?php echo $uid; ?>").jPlayer( {
        ready: function () {
          $(this).jPlayer("setMedia", {
            <?php echo $audio_files; ?>
          })
        },
        solution: "html, flash",
        supplied: "m4a, oga",
        cssSelectorAncestor: "<?php echo '#'.$uid.'m'; ?>",
        swfPath: "<?php echo THEME_URL; ?>js/libs/plugins/jquery.jplayer/"
      });
    });
</script>