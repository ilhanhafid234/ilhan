<?php

if ( ! get_theme_mod( 'wedding_event_management_enable_testimonial_section', false ) ) {
  return;
}

$wedding_event_management_content_ids  = array();
$wedding_event_management_content_type = get_theme_mod( 'wedding_event_management_testimonial_content_type', 'post' );

for ( $wedding_event_management_i = 1; $wedding_event_management_i <= 2; $wedding_event_management_i++ ) {
  $wedding_event_management_content_ids[] = get_theme_mod( 'wedding_event_management_service_content_' . $wedding_event_management_content_type . '_' . $wedding_event_management_i );
}

// Get the category for the services slider from theme mods or a default category
$wedding_event_management_services_category = get_theme_mod('wedding_event_management_services_category', 'testimonial');

// Modify query to fetch posts from a specific category
$wedding_event_management_testimonial_args = array(
    'post_type'           => $wedding_event_management_content_type,
    'post__in'            => array_filter( $wedding_event_management_content_ids ),
    'orderby'             => 'post__in',
    'posts_per_page'      => absint(4),
    'ignore_sticky_posts' => true,
);

// Apply category filter only if content type is 'post'
if ( 'post' === $wedding_event_management_content_type && ! empty( $wedding_event_management_services_category ) ) {
    $wedding_event_management_testimonial_args['category_name'] = $wedding_event_management_services_category;
}


$wedding_event_management_testimonial_args = apply_filters( 'wedding_event_management_service_section_args', $wedding_event_management_testimonial_args );

wedding_event_management_render_service_section( $wedding_event_management_testimonial_args );

/**
 * Render Testimonial Section.
 */
function wedding_event_management_render_service_section( $wedding_event_management_testimonial_args ) { ?>

  <section id="wedding_event_management_service_section" class="asterthemes-frontpage-section service-section service-style-1 testi-bg">
    <?php
    if ( is_customize_preview() ) :
      wedding_event_management_section_link( 'wedding_event_management_service_section' );
    endif;

    $wedding_event_management_testimonial_heading = get_theme_mod( 'wedding_event_management_testimonial_heading');
    $wedding_event_management_testimonial_content = get_theme_mod( 'wedding_event_management_testimonial_content');
    ?>
    <div class="asterthemes-wrapper">
      <?php if ( ! empty( $wedding_event_management_testimonial_heading ) ||  ! empty( $wedding_event_management_testimonial_content ) ) { ?>
        <div class="testimonial-contact-inner">
          <?php if ( ! empty( $wedding_event_management_testimonial_heading ) ) { ?>
            <h6 class="heading"><?php echo esc_html( $wedding_event_management_testimonial_heading ); ?></h6>
          <?php } ?>
          <?php if ( ! empty( $wedding_event_management_testimonial_content ) ) { ?>
            <h3 class="conent-produt"><?php echo esc_html( $wedding_event_management_testimonial_content ); ?></h3>
          <?php } ?>
        </div>
      <?php } ?>
      
      <div class="video-main-box">
        <?php 
        $wedding_event_management_query = new WP_Query( $wedding_event_management_testimonial_args );
        if ( $wedding_event_management_query->have_posts() ) :
          ?>
          <div class="section-body">
            <div class="service-section-wrapper">
              <?php
              $wedding_event_management_i = 1;
              while ( $wedding_event_management_query->have_posts() ) :
                $wedding_event_management_query->the_post();
                ?>
                <div class="service-single">
                  <div class="service-image-box">
                  	<div class="service-content">
                      <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                      <div class="mag-post-excerpt">
                        <?php  $wedding_event_management_excerpt = wp_trim_words(get_the_excerpt(), 25, '...');
                          echo $wedding_event_management_excerpt;
                        ?>
                      </div>
                      <?php
                            if ( get_theme_mod( 'wedding_event_management_enable_social' .$wedding_event_management_i, true ) === true ) { ?>
                        <div class="socail-search">
                            <div class="social-icons">
                                <?php
                                if ( has_nav_menu( 'testimonial-' . $wedding_event_management_i ) ) {
                                    wp_nav_menu(
                                        array(
                                            'menu_class'     => 'menu social-links',
                                            'link_before'    => '<span class="screen-reader-text">',
                                            'link_after'     => '</span>',
                                            'theme_location' => 'testimonial-' . $wedding_event_management_i,
                                        )
                                    );
                                }
                                ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <?php if ( has_post_thumbnail() ) { ?>
                      <div class="service-image">
                        <?php the_post_thumbnail( 'full' ); ?>
                      </div>
                    <?php } ?>  
                  </div>
                </div>
                <?php
                $wedding_event_management_i++;
              endwhile;
              wp_reset_postdata();
              ?>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <?php
}
