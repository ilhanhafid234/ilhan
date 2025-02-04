<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wedding_event_management
 */

get_header();

$wedding_event_management_column = get_theme_mod( 'wedding_event_management_archive_column_layout', 'column-1' );
?>
<main id="primary" class="site-main">
	<?php if ( have_posts() ) : ?>
		<div class="wedding_event_management-archive-layout grid-layout <?php echo esc_attr( $wedding_event_management_column ); ?>">
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content',  get_post_format() );

			endwhile;
			?>
		</div>
		<?php
		do_action( 'wedding_event_management_posts_pagination' );
	else :
		get_template_part( 'template-parts/content', 'none' );
	endif;
	?>
</main><!-- #main -->
<?php
if ( wedding_event_management_is_sidebar_enabled() ) {
	get_sidebar();
}
get_footer();