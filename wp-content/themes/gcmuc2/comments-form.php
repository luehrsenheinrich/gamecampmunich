<?php
	global $post;
	
	$post_id = $post->ID;
	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';
	

?>

<form id="respond" method="post" action="<?php echo WP_THEME_URL; ?>/lh-wp-comments-post.php">

	<div class="form_wrapper clearfix">
        <div class="comment-fields">
        <?php if ( is_user_logged_in() ) : ?>
        	<div class="left">
                <h4><?php comment_form_title( __("Say something, my friend!", "gcmuc"), __('Reply to %s', 'gcmuc') ) ?>
                	<?php cancel_comment_reply_link( __( 'Cancel reply', "gcmuc" ) ); ?>
                </h4>
            </div>
            <div class="right">
                <h4 id="user"><?php echo sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'gcmuc' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) ?></h4>
            </div>
        <?php else: ?>
            <div class="left">
				<h4><?php comment_form_title( __("Say something, my friend!", "gcmuc"), __('Reply to %s', 'gcmuc') ) ?>
                	<?php cancel_comment_reply_link( __( 'Cancel reply', "gcmuc" ) ); ?>
                </h4>                <input type="text" id="author" name="author" value="<?php esc_attr( $commenter['comment_author'] ); ?>" placeholder="<?php _e("Name", "gcmuc"); ?> *" />
            </div>
            <div class="right">
                <input type="text" id="email" name="email" value="<?php esc_attr( $commenter['comment_email'] ); ?>" placeholder="<?php _e("E-Mail", "gcmuc"); ?> *" />
                <input type="text" id="url" name="url" value="<?php esc_attr( $commenter['comment_url'] ); ?>" placeholder="<?php _e("URL", "gcmuc"); ?>" />
            </div>
       <?php endif; ?>
            <div class="center">
            	<textarea id="comment" name="comment" rows="10" aria-required="true"></textarea>
                <div class="buttons">
                    <button type="reset" name="resetButton" class="reset-button"><i class="fa fa-trash-o"></i> <?php _e("Reset", "gcmuc"); ?></button>
                    <button type="submit" name="submitButton" class="submit-button"><i class="fa fa-check-square"></i> <?php _e("Submit", "gcmuc"); ?></button>
                </div>
            </div>
        </div>
		<div class="sidenotes hidden-xs">
			<p class="netiquette"><?php _e("Netiquette:", "gcmuc"); ?></p>
        	<p><?php _e("Please pay respect to common sense and manners while posting your comment, as we do not tolerate insults, racism and hateful speech!", "gcmuc"); ?></p>
        	<code><?php echo allowed_tags(); ?></code>
        </div>
    </div>

	<div class="hide">
		<?php comment_id_fields( $post_id ); ?>
    </div>
    <?php do_action( 'comment_form', $post_id ); ?>
</form>