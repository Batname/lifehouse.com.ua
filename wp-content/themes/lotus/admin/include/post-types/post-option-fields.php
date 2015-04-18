<?php
/**
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
 
/*==================================================================================================
  
    Add Post video setting meta box
 
 *=================================================================================================*/

$post_video_metabox        = new AxiomMetabox();
$post_video_metabox->id    = "axi_post_video_meta_box";
$post_video_metabox->title = __('Video Setting', 'default');
$post_video_metabox->type  = array('post');
$post_video_metabox->fields= array(
                                    array(
                                        'name' => __('Youtube or Vimeo Link', 'default'),
                                        'desc' => 'youtube example : http://www.youtube.com/watch?v=jNVPalNZD_I<br/>vimeo example: http://vimeo.com/38149315 ',
                                        'id'   => 'youtube',
                                        'type' => 'textbox',
                                        'std'  => ''
                                    ),
                                    array(
                                        'name' => __('Or Self Hosted Video'  , 'default'),
                                        'desc' => __('Leave youtube-vimeo field blank, if you want to use self hosted video', 'default'),
                                        'type' => 'sep'
                                    ),
                                    array(
                                        'name' => __('MP4 URL', 'default'),
                                        'desc' => __('Internet Explorer 9+, Safari, IOS, Windows Phone 7', 'default'),
                                        'id'   => 'mp4',
                                        'type' => 'textbox',
                                        'std'  => ''
                                    ),
                                    array(
                                        'name' => __('WebM URL', 'default'),
                                        'desc' => __('Internet Explorer 9+, Firefox, Opera, Chrome', 'default'),
                                        'id'   => 'webm',
                                        'type' => 'textbox',
                                        'std'  => ''
                                    ),
                                    array(
                                        'name' => __('OGG URL', 'default'),
                                        'desc' => __('Firefox, Opera, Chrome', 'default'),
                                        'id'   => 'ogg',
                                        'type' => 'textbox',
                                        'std'  => ''
                                    ),
                                    array(
                                        'name' => __('FLV URL ', 'default'),
                                        'desc' => __('Flash player fallback for older browsers', 'default'),
                                        'id'   => 'flv',
                                        'type' => 'textbox',
                                        'std'  => ''
                                    ),
                                    array(
                                        'name' => __('Video Image URL ', 'default'),
                                        'desc' => __('specifies an image to be shown while the video is downloading, or until the user hits the play button.', 'default'),
                                        'id'   => 'poster',
                                        'type' => 'textbox',
                                        'std'  => ''
                                    ),
                                    array(
                                        'name' => __('Player Skin', 'default'),
                                        'desc' => '',
                                        'id'   => 'skin',
                                        'type' => 'select',
                                        'options' => array("dark" , "light")
                                    ),
                                );
$post_video_metabox->init();



/*==================================================================================================
  
    Add Post audio setting meta box
 
 *=================================================================================================*/

$post_audio_metabox        = new AxiomMetabox();
$post_audio_metabox->id    = "axi_post_audio_meta_box";
$post_audio_metabox->title = __('Audio Setting', 'default');
$post_audio_metabox->type  = array('post');
$post_audio_metabox->fields= array(
                                    array(
                                        'name' => __('Self Hosted Audio'  , 'default'),
                                        'desc' => "",
                                        'type' => 'sep'
                                    ),
                                    array(
                                        'name' => __('MP3 URL', 'default'),
                                        'desc' => __('For Internet Explorer 9+, Safari, Chrome', 'default'),
                                        'id'   => 'mp3',
                                        'type' => 'textbox',
                                        'std'  => ''
                                    ),
                                    array(
                                        'name' => __('OGG URL', 'default'),
                                        'desc' => __('For Firefox, Opera, Chrome', 'default'),
                                        'id'   => 'oga',
                                        'type' => 'textbox',
                                        'std'  => ''
                                    ),
                                    array(
                                        'name' => __('Player Skin', 'default'),
                                        'desc' => '',
                                        'id'   => 'audio_skin',
                                        'type' => 'select',
                                        'options' => array("dark" , "light")
                                    ),
                                    array(
                                        'name' => __('Or SoundCloud shortcode'  , 'default'),
                                        'desc' => __('Leave self-hosted audio fields blank, if you want to use soundcloud shortcode', 'default'). '<br/>',
                                        'type' => 'sep'
                                    ),
                                    array(
                                        'name' => __('SoundCloud shortcode', 'default'),
                                        'desc' => __('The SoundCloud Shortcode allows you to easily integrate a player widget for a track, set or group from SoundCloud into your post by using a WordPress shortcode. Use it like this sample :', 'default') . '<br/>' .
                                                  '<code>[soundcloud]http://soundcloud.com/LINK_TO_TRACK_SET_OR_GROUP[/soundcloud]</code>',
                                        'id'   => 'soundcloud',
                                        'type' => 'textarea',
                                        'std'  => ''
                                    ),
                                     
                                );
$post_audio_metabox->init();



/*==================================================================================================
  
    Add Post link setting meta box
 
 *=================================================================================================*/

$post_link_metabox        = new AxiomMetabox();
$post_link_metabox->id    = "axi_post_link_meta_box";
$post_link_metabox->title = __('Link Setting', 'default');
$post_link_metabox->type  = array('post');
$post_link_metabox->fields= array(
                                    array(
                                        'name' => __('URL', 'default'),
                                        'desc' => __('for example : http://www.google.com', 'default'),
                                        'id'   => 'the_link',
                                        'type' => 'textbox',
                                        'std'  => ''
                                    )
                                );
$post_link_metabox->init();



/*==================================================================================================
  
    Add Post quote setting meta box
 
 *=================================================================================================*/

$post_quote_metabox        = new AxiomMetabox();
$post_quote_metabox->id    = "axi_post_quote_meta_box";
$post_quote_metabox->title = __('Quote Setting', 'default');
$post_quote_metabox->type  = array('post');
$post_quote_metabox->fields= array(
                                     array(
                                        'name' => __('The Author', 'default'),
                                        'desc' => "",
                                        'id'   => 'the_author',
                                        'type' => 'textbox',
                                        'std'  => ''
                                    )
                                );
$post_quote_metabox->init();


/*==================================================================================================
  
    Add Post Gallery setting meta box
 
 *=================================================================================================*/

$prefix = 'axi_';
$fields = array();

$fields[] = array(
                'name' => __('Upload your image, select "Full Size" and then click "insert into post"', 'default').'<br/>',
                'desc' => __('For adding image from url , click browse, "from URL" tab. Fill "URL" and "Link Image To" and then click "insert into post"', 'default'),
                'type' => 'sep',
            );


// Define image upload fields
for ($i=1; $i <= 5; $i++) { 
    $fields[] = array(
        'name' => __('Image', 'default').' ('.$i.')',
        'desc' => '',
        'id' => $prefix.'gallery_image'.$i,
        'type' => 'media',
        'class' => 'media_upload_field',
        'upload_std' => __('Browse', 'default'),
        'remove_std' => __('Remove', 'default'),
        'std' => ''
    );
}

 
$post_gallery_metabox        = new AxiomMetabox();
$post_gallery_metabox->id    = "axi_post_gallery_meta_box";
$post_gallery_metabox->title = __('Gallery Setting', 'default');
$post_gallery_metabox->type  = array('post');
$post_gallery_metabox->fields= $fields;
$post_gallery_metabox->init();

unset($prefix, $fields);

?>