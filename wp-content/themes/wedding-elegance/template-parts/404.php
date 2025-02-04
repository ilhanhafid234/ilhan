<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Wedding Elegance
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<main class="site-main" role="main">
	<header class="page-header">
		<h1 class="entry-title"><?php esc_html_e( 'The page can&rsquo;t be found.', 'wedding-elegance' ); ?></h1>
	</header>
	<div class="page-content">
		<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'wedding-elegance' ); ?></p>
	</div>

</main>
