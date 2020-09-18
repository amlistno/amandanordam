<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Alchemist
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

<div id="comments" class="comments-area<?php if ( have_comments() ) : echo ' comment-active'; endif; ?>">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				$comments_number = get_comments_number();
				if ( '1' === $comments_number ) {
					printf(
						/* translators: %s: title. */
						esc_html_x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'alchemist' ),
						get_the_title()
					);
				} else {
					printf( // WPCS: XSS OK.
						/* translators: 1: comment count number, 2: title. */
						esc_html( _nx( '%1$s Reply to &ldquo;%2$s&rdquo;', '%1$s Replies to &ldquo;%2$s&rdquo;', $comments_number, 'comments title', 'alchemist' ) ),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
			?>
		</h2><!-- .comments-title -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'alchemist' ); ?></h2>
			<div class="nav-links">
				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'alchemist' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'alchemist' ) ); ?></div>
			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'			=> 'ol',
					'avatar_size'	=> 48,
					'short_ping'	=> true,
					'callback'		=> 'alchemist_comment'
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'alchemist' ); ?></h2>
			<div class="nav-links">
				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'alchemist' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'alchemist' ) ); ?></div>
			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'alchemist' ); ?></p>
	<?php
	endif;

	$req       = get_option( 'require_name_email' );
	$html_req  = ( $req ? " required='required'" : '' );
	$commenter = wp_get_current_commenter();

	$fields   =  array(
			'author'   => '<p class="comment-form-author">' .
				'<input id ="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $html_req . ' /><label for="author">' . esc_html__( 'Name', 'alchemist' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label></p>',
			'email'    => '<p class="comment-form-email">' .
				'<input id ="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $html_req . ' /><label for="email">' . esc_html__( 'Email', 'alchemist' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label></p>',

	);

	$args = array(
		'comment_field' => '<p class="comment-form-comment"> <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea><label for="comment">' . esc_html_x( 'Comment', 'noun', 'alchemist' ) . '</label></p>',
		'fields'        => $fields
	);

	comment_form( $args );
	?>

</div><!-- #comments -->
