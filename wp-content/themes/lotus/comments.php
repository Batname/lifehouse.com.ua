<?php
/**
 * @package 
 * @subpackage 
 */
 ?>

<?php
// Do not delete these lines
  if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');

  if ( post_password_required() ) { ?>
    <p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'default'); ?></p>
  <?php
    return;
  }
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
    <div id="comments">
        <h3><?php comments_number( __('No Responses', 'default'), __('One Response', 'default'), __('% Responses', 'default') );?></h3>
    </div>
    
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
    <nav class="comments-navi">
        <div class="comments-pre-page"><?php previous_comments_link() ?></div>
        <div class="comment-next-page"><?php next_comments_link() ?></div>
    </nav>
    <?php endif; ?>
  
    <ol class="commentlist">
        <?php wp_list_comments('type=comment&callback=axiom_comment'); ?>
    </ol>
    
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
    <nav class="comments-navi">
        <div class="comments-pre-page"><?php previous_comments_link() ?></div>
        <div class="comment-next-page"><?php next_comments_link() ?></div>
    </nav>
    <?php endif; ?>
    
    <div class="clear"></div>
    
<?php else : // this is displayed if there are no comments so far ?>

    <?php if ( comments_open() ) : ?>
    <!-- If comments are open, but there are no comments. -->

    <?php elseif(get_post_type() == "post" || get_post_type() == "news") : // comments are closed ?>
    <!-- If comments are closed. -->
 <!--   <p class="nocomments"><?php _e("Comments are closed.", "default"); ?></p> -->

    <?php endif; ?>
    
<?php endif; ?>


<?php 
    $req = get_option( 'require_name_email' );
    $comments_args = array(
            
            'must_log_in' => '<p>'. sprintf( __("You must be %s logged in %s to post a comment", "default"), '<a href="'.wp_login_url( get_permalink() ).'">', '</a>' ) .'</p>',
            
            'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'default' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
            // change the title of send button 
            'label_submit'=> __('Submit' , 'default' ) ,
            // change the title of the reply section
            'title_reply'=>'<span>' . __('Leave a Reply', 'default') . '</span>',
            // remove "Text or HTML to be displayed after the set of comment fields"
            'comment_notes_before' => '',
            'comment_notes_after'  => '',
            // redefine your own textarea (the comment body)
            'comment_field' => '<textarea name="comment" id="comment" cols="58" rows="10" tabindex="4" placeholder="'. __('Comment' , 'default' ). '" ></textarea>',
            'fields' => 
                apply_filters( 'comment_form_default_fields', 
                    array(
                        'author' => '<input type="text"  name="author" id="author" placeholder="'. __('Name (required)' , 'default' ). '" value="'. esc_attr($comment_author). '"     size="22" tabindex="1" '. ( $req ? "aria-required='true' required" : "" ) .' />',
                        'email'  => '<input type="email" name="email"  id="email"  placeholder="'. __('EMail (required)', 'default' ). '" value="'. esc_attr($comment_author_email). '" tabindex="2" ' . ( $req ? "aria-required='true' required" : "" ) .' />',
                        'url'    => '<input type="url"   name="url"    id="url"    placeholder="'. __('Website'         , 'default' ). '" value="'. esc_attr($comment_author_url). '" size="22" tabindex="3" />' 
                        )
                )
    );
    
    comment_form($comments_args);
    
 ?> 