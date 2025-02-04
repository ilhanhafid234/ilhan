<?php
/**
 * The template for displaying archive pages.
 *
 * @package Wedding Elegance
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<main class="site-main" role="main" id="main_content">
	<header class="page-header">
		<div class="container">
			<?php
			the_archive_title( '<h1 class="entry-title">', '</h1>' );
			the_archive_description( '<p class="archive-description">', '</p>' );
			?>
		</div>
	</header>
	<div class="container">
		
		<div class="page-content">
			<?php
			while ( have_posts() ) {
				the_post();
				$post_link = get_permalink();
				?>
				<article class="post">
					<div class="post-image-wrapper">
						<?php 
							if ( has_post_thumbnail() ) { 
								printf( '<a href="%s">%s</a>', esc_url( $post_link ), get_the_post_thumbnail( $post, 'large' ) );
							}
							else {
						?>
							<img class="default-thumb" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/post-dummy.png' ); ?>" alt="<?php esc_attr_e( 'Post Image', 'wedding-elegance' ); ?>">
						<?php
							}
						?>
					</div>
					<div class="post-title-wrapper">
						<?php
						printf( '<h2 class="%s"><a href="%s">%s</a></h2>', 'entry-title', esc_url( $post_link ), esc_html( get_the_title() ) );
						?>
					</div>
					<div class="post-content-wrapper">
						<?php
							the_excerpt();
						?>
					</div>
					<a class="read-more" href="<?php the_permalink();?>"><?php echo esc_html_x( 'Read More', 'label', 'wedding-elegance' ) ?></a>
				</article>
			<?php } ?>
		</div>

		<?php wp_link_pages(); ?>

		<?php
		global $wp_query;
		if ( $wp_query->max_num_pages > 1 ) :
			?>
			<nav class="pagination" role="navigation">
				<?php /* Translators: HTML arrow */ ?>
				<div class="nav-previous"><?php next_posts_link( sprintf( __( '%s older', 'wedding-elegance' ), '<span class="meta-nav">&larr;</span>' ) ); ?></div>
				<?php /* Translators: HTML arrow */ ?>
				<div class="nav-next"><?php previous_posts_link( sprintf( __( 'newer %s', 'wedding-elegance' ), '<span class="meta-nav">&rarr;</span>' ) ); ?></div>
			</nav>
		<?php endif; ?>
	</div>
</main>
