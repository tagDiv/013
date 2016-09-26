<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package tdmag
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

?>

<div class="comments" id="comments">
	<?php if (post_password_required()) {
		return;
	}

	if (have_comments()) {

		$num_comments = get_comments_number(); // get_comments_number returns only a numeric value
		if ($num_comments > 1) {
			$td_comments_no_text = $num_comments . ' ' . __td('COMMENTS', TAGDIV_THEME_NAME);
		} else {
			$td_comments_no_text = __td('1 COMMENT', TAGDIV_THEME_NAME);
		}
		?>

		<div class="td-comments-title-wrap">
			<h4 class="td-comments-title"><span><?php echo $td_comments_no_text?></span></h4>
		</div>

		<ol class="comment-list">
			<?php wp_list_comments(array('callback' => 'td_comment')); ?>
		</ol>
		<div class="comment-pagination">
			<?php previous_comments_link(); ?>
			<?php next_comments_link(); ?>
		</div>

	<?php }

	if (!comments_open() and (get_comments_number() > 0)) { ?>
		<p class="td-pb-padding-side"><?php __td( 'Comments are closed.', TAGDIV_THEME_NAME ); ?></p>
	<?php }

	$commenter = wp_get_current_commenter();

	if (empty($aria_req)) {
		$aria_req = '';
	}

	$fields = array(
		'author' =>
			'<p class="comment-form-input-wrap td-form-author">
			            <span class="comment-req-wrap">
			            	<input class="" id="author" name="author" placeholder="' . __td('Name:', TAGDIV_THEME_NAME) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' . ( $req ? '</span>' : '' ) .
			'</p>',

		'email'  =>
			'<p class="comment-form-input-wrap td-form-email">
			            <span class="comment-req-wrap"><input class="" id="email" name="email" placeholder="' . __td('Email:', TAGDIV_THEME_NAME) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' . ( $req ? '</span>' : '' ) .
			'</p>',

		'url' =>
			'<p class="comment-form-input-wrap td-form-url">
			            <input class="" id="url" name="url" placeholder="' . __td('Website:', TAGDIV_THEME_NAME) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />' .
			'</p>',
	);

	$defaults = array('fields' => apply_filters('comment_form_default_fields', $fields));
	$defaults['comment_field'] =
		'<div class="clearfix"></div>
				<p class="comment-form-input-wrap td-form-comment">
					<textarea placeholder="' . __td('Comment:', TAGDIV_THEME_NAME) . '" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
		        </p>';

	$defaults['comment_notes_before'] = '';
	$defaults['comment_notes_after'] = '';
	$defaults['title_reply'] = __td('LEAVE A REPLY', TAGDIV_THEME_NAME);
	$defaults['label_submit'] = __td('Post Comment', TAGDIV_THEME_NAME);
	$defaults['cancel_reply_link'] = __td('Cancel reply', TAGDIV_THEME_NAME);


	$url = wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) );
	$defaults['must_log_in'] = '<p class="must-log-in td-login-comment"><a class="td-login-modal-js" data-effect="mpf-td-login-effect" href="' . $url .'">' . __td('Log in to leave a comment', TAGDIV_THEME_NAME) . ' </a></p>';

	comment_form($defaults);

	?>
</div> <!-- /.content -->

<?php

	/**
	* Custom callback for outputting comments
	*
	* @return void
	* @author tagdiv
	*/

	function td_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	$td_isPingTrackbackClass = '';

	if($comment->comment_type == 'pingback') {
	$td_isPingTrackbackClass = 'pingback';
	}

	if($comment->comment_type == 'trackback') {
	$td_isPingTrackbackClass = 'trackback';
	}

	if (!empty($comment->comment_author_email)) {
	$td_comment_auth_email = $comment->comment_author_email;
	} else {
	$td_comment_auth_email = '';
	}

	$td_article_date_unix = @strtotime("{$comment->comment_date_gmt} GMT");
	//print_r($td_article_date_unix);


	?>
<li class="comment <?php echo $td_isPingTrackbackClass ?>" id="comment-<?php comment_ID() ?>">
	<article>
		<footer>
			<?php
			//echo get_template_directory_uri() . "/images/avatar.jpg";
			//echo get_avatar($td_comment_auth_email, 50, get_template_directory_uri() . "/images/avatar.jpg");
			echo get_avatar($td_comment_auth_email, 50);
			?>
			<cite><?php comment_author_link() ?></cite>

			<a class="comment-link" href="#comment-<?php comment_ID() ?>">
				<time pubdate="<?php echo $td_article_date_unix ?>"><?php comment_date() ?> at <?php comment_time() ?></time>
			</a>
		</footer>

		<div class="comment-content">
			<?php if ($comment->comment_approved == '0') { ?>
				<em><?php echo __td('Your comment is awaiting moderation', TAGDIV_THEME_NAME); ?></em>
			<?php }
			comment_text(); ?>
		</div>

		<div class="comment-meta" id="comment-<?php comment_ID() ?>">
			<?php comment_reply_link(array_merge( $args, array(
				'depth' => $depth,
				'max_depth' => $args['max_depth'],
				'reply_text' => __td('Reply', TAGDIV_THEME_NAME),
				'login_text' =>  __td('Log in to leave a comment', TAGDIV_THEME_NAME)
			)))
			?>
		</div>
	</article>
<?php

}
?>