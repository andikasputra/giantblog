<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package giantblog
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'giantblog' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h2><!-- .comments-title -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'giantblog' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'giantblog' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'giantblog' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'giantblog' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'giantblog' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'giantblog' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'giantblog' ); ?></p>
	<?php
	endif;

	$comment_fields = array(
		'author' => '<div class="group">
						<label for="author">' . _x( 'Name', 'noun' ) . ' ' . ( $req ? '<span class="required">*</span>' : '' ) . '</label>
						<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" required>',
		'email' => '<div class="group">
						<label for="email">' . _x( 'Email', 'noun' ) . ' ' . ( $req ? '<span class="required">*</span>' : '' ) . '</label>
						<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" required>',
		'url' => '<div class="group">
						<label for="url">' . _x( 'Website', 'noun' ) . ' ' . ( $req ? '<span class="required">*</span>' : '' ) . '</label>
						<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" required>'
	);
	
	$comment_form_args = array(
		'class_submit' => 'button transparent',
		'comment_field' => '<div class="group comment-form-comment">
							<label for="comment">' . _x('Comment', 'noun') . '</label>
							<textarea id="comment" name="comment" rows="10" placeholder="Your Comment Here" required></textarea>
							</div>',
		'must_log_in' => '<div class="must-log-in">' .
							sprintf(
								__( 'You must be <a href="%s">logged in</a> to post a comment.' ),
								wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
							) . '</div>',
		'fields' => apply_filters( 'comment_form_default_fields', $comment_fields )
	);
	comment_form($comment_form_args);
	?>

</div><!-- #comments -->
