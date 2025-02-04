<?php
/**
 * The template for displaying comments.
 *
 *
 * @package Wedding Elegance
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Comment Reply Script.
if ( comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
}
?>
<section id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h3 class="title-comments screen-reader-text">
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				printf( esc_html_x( 'One Response', 'comments title', 'wedding-elegance' ) );
			} else {
				printf(
					esc_html( /* translators: 1: number of comments */
						_nx(
							'%1$s Response',
							'%1$s Responses',
							$comments_number,
							'comments title',
							'wedding-elegance'
						)
					),
					esc_html( number_format_i18n( $comments_number ) )
				);
			}
			?>
		</h3>

		<?php the_comments_navigation(); ?>

	<ol class="comment-list">
		<?php
		wp_list_comments(
			[
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 42,
			]
		);
		?>
	</ol><!-- .comment-list -->

		<?php the_comments_navigation(); ?>

<?php endif; ?>

<?php

if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
	<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'wedding-elegance' ); ?></p>
<?php endif; ?>

<?php
comment_form(
	[
		'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
		'title_reply_after'  => '</h2>',
	]
);
?>

</section><!-- .comments-area -->
