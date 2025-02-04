<?php
if ( ! get_theme_mod( 'wedding_event_management_enable_banner_section', true ) ) {
	return;
}

$wedding_event_management_slider_content_ids  = array();
$wedding_event_management_slider_content_type = get_theme_mod( 'wedding_event_management_banner_slider_content_type', 'post' );

for ( $wedding_event_management_i = 1; $wedding_event_management_i <= 3; $wedding_event_management_i++ ) {
	$wedding_event_management_slider_content_ids[] = get_theme_mod( 'wedding_event_management_banner_slider_content_' . $wedding_event_management_slider_content_type . '_' . $wedding_event_management_i );
}
// Get the category for the banner slider from theme mods or a default category
$wedding_event_management_banner_slider_category = get_theme_mod('wedding_event_management_banner_slider_category', 'slider');

// Modify query to fetch posts from a specific category
$wedding_event_management_banner_slider_args = array(
	'post_type'           => $wedding_event_management_slider_content_type,
	'post__in'            => array_filter( $wedding_event_management_slider_content_ids ),
	'orderby'             => 'post__in',
	'posts_per_page'      => absint(3),
	'ignore_sticky_posts' => true,
);

// Apply category filter only if content type is 'post'
if ( 'post' === $wedding_event_management_slider_content_type && ! empty( $wedding_event_management_banner_slider_category ) ) {
	$wedding_event_management_banner_slider_args['category_name'] = $wedding_event_management_banner_slider_category;
}
$wedding_event_management_banner_slider_args = apply_filters( 'wedding_event_management_banner_section_args', $wedding_event_management_banner_slider_args );

wedding_event_management_render_banner_section( $wedding_event_management_banner_slider_args );

/**
 * Render Banner Section.
 */
function wedding_event_management_render_banner_section( $wedding_event_management_banner_slider_args ) {     ?>

	<section id="wedding_event_management_banner_section" class="banner-section banner-style-1">
		<?php
		if ( is_customize_preview() ) :
			wedding_event_management_section_link( 'wedding_event_management_banner_section' );
		endif;
		?>
		<div class="banner-section-wrapper">
			<?php
			$wedding_event_management_query = new WP_Query( $wedding_event_management_banner_slider_args );
			if ( $wedding_event_management_query->have_posts() ) :
				?>
				<div class="asterthemes-banner-wrapper banner-slider wedding-event-management-carousel-navigation" data-slick='{"autoplay": false }'>
					<?php
					$wedding_event_management_i = 1;
					while ( $wedding_event_management_query->have_posts() ) :
						$wedding_event_management_query->the_post();
						$wedding_event_management_button_label = get_theme_mod( 'wedding_event_management_banner_button_label_' . $wedding_event_management_i);
						$wedding_event_management_button_link  = get_theme_mod( 'wedding_event_management_banner_button_link_' . $wedding_event_management_i);
						$wedding_event_management_button_link  = ! empty( $wedding_event_management_button_link ) ? $wedding_event_management_button_link : get_the_permalink();
						?>
						<div class="banner-single-outer">
							<div class="banner-single">
								<div class="banner-img">
									<?php the_post_thumbnail( 'full' ); ?>
								</div>
								<div class="banner-caption">
									<div class="asterthemes-wrapper">
										<div class="banner-catption-wrapper">
											<h1 class="banner-caption-title">
												<?php the_title(); ?>
											</h1>
											<div class="mag-post-excerpt">
												<?php the_excerpt(); ?>
											</div>
											<?php if ( ! empty( $wedding_event_management_button_label ) ) { ?>
												<div class="banner-slider-btn">
													<a href="<?php echo esc_url( $wedding_event_management_button_link ); ?>" class="asterthemes-button"><?php echo esc_html( $wedding_event_management_button_label ); ?></a>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
						$wedding_event_management_i++;
					endwhile;
					wp_reset_postdata();
					?>
				</div>
				<?php
			endif;
			?>
		</div>
	</section>

	<?php
}
