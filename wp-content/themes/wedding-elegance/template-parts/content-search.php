<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Wedding Elegance
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-item">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="featured-image">
				<a href="<?php the_permalink();?>"><?php the_post_thumbnail(); ?></a>
				<div class="entry-meta">
	                <?php the_time( 'd F Y' ); ?>
	            </div><!-- .entry-meta -->
			</div><!-- .featured-image -->
	    <?php endif; ?>

		<div class="entry-container">
			<header class="entry-header">
				<?php
				if ( is_single() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div><!-- .entry-content -->

            <div class="read-more">
                <a href="<?php the_permalink();?>"><?php echo esc_html_x( 'Read More', 'label', 'wedding-elegance' ) ?><i class="fas fa-plus"></i></a>
            </div><!-- .read-more -->
		</div><!-- .entry-container -->
	</div><!-- .post-item -->
</article><!-- #post-## -->