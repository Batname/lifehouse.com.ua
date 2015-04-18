        
        <!-- video player-->
        <div id="<?php echo $uid.'m'; ?>" class="jp-video <?php echo ($skin == "light")?"jp-light":""; ?>">
            <div class="jp-type-single">
              
              <!-- video view  -->
              <div class="jp-view-container">
                  <div id="<?php echo $uid; ?>" class="jp-jplayer"></div>
                  <div class="jp-video-play">
                    <a href="javascript:;" class="jp-video-play-icon" tabindex="1">play</a>
                  </div> 
              </div>
              
              
              <!-- video controls -->
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
        </div><!-- end video player-->
       
<?php $video_files  = "";
    $video_files  .= (!empty($mp4)  )?'m4v:"'.$mp4.'",':'';
    $video_files  .= (!empty($ogg)  )?'ogv:"'.$ogg.'",':'';
    $video_files  .= (!empty($webm) )?'webmv:"'.$webm.'",':'';
    $video_files  .= (!empty($flv)  )?'flv:"'.$flv.'",':'';
    $video_files  .= (!empty($poster))?'poster:"'.$poster.'",':'';
    
    if(strlen($video_files)) $video_files = substr($video_files, 0, -1);
?>
 
<script>
    jQuery(document).ready(function($){
      
      $.jPlayer.prototype.optionsVideo.size = { cssClass: 'jp-video-resp', width:'100%', height:'auto' };  
      $.jPlayer.prototype.options.preload   = "none";  
      
      $("#<?php echo $uid; ?>").jPlayer( {
        ready: function () {
          $(this).jPlayer("setMedia", {
            <?php echo $video_files; ?>
          })
        },
        solution: "html, flash",
        supplied: "m4v, webmv, ogv, flv",
        cssSelectorAncestor: "<?php echo '#'.$uid.'m'; ?>",
        swfPath: "<?php echo THEME_URL; ?>js/libs/plugins/jquery.jplayer/"
      });
      
    });
</script>