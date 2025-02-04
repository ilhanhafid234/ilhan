<?php
/**
 * The template for displaying the footer.
 *
 * Contains the body & html closing tags.
 *
 * @package Wedding Elegance
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

	$footer_nav_menu = wp_nav_menu( [
		'theme_location' => 'footer',
		'fallback_cb' => false,
		'echo' => false,
	] );
	?>
	<footer id="site-footer" class="site-footer dynamic-footer" role="contentinfo">
		<div class="container">

			<div class="footer-inner">
			    <div id="footer-widgets" class="clearfix">
					<?php
					for ( $i=1; $i <= 4; $i++ ) :
						echo '<div class="footer-widget">';
						dynamic_sidebar( 'footer-sidebar-'.$i );
						echo '</div> <!-- end .footer-widget -->';
					endfor;
					?>
			    </div> <!-- #footer-widgets -->
			</div>  

			<?php if ( $footer_nav_menu ) : ?>
				<nav class="footer-navigation" role="navigation">
					<?php echo $footer_nav_menu; ?>
				</nav>
			<?php endif; ?>

			<div class="footer-social-lnks">
				<?php 
					$items = array(
						'wedding_elegance_instagram_text_block'	=>	'fa-instagram', 
						'wedding_elegance_facebook_text_block'	=>	'fa-facebook', 
						'wedding_elegance_twitter_text_block'	=>	'fa-twitter', 
					);

					foreach($items as $item => $class):

						if(wedding_elegance_get_theme_option($item) != ''):
				?>
						<a href="<?php echo wedding_elegance_get_theme_option($item); ?>" class="social-lnk-item">
							<i class="fa <?php echo $class; ?>"></i>
						</a>
				<?php
						endif;
					endforeach;
				?>
			</div>

			<?php if(wedding_elegance_get_theme_option('wedding_elegance_copyright_text_block') != ''): ?>
			<div class="footer-copyright">
				<p>
					<?php echo wedding_elegance_get_theme_option('wedding_elegance_copyright_text_block'); ?>
				</p>
			</div>
		<?php endif; ?>
		</div>
	</footer>

<?php wp_footer(); ?>

</body>
</html>
