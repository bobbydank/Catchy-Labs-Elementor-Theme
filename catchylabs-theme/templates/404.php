<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * CL\Elementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$template_id = cl_elementor_get_theme_option('default_404');
if (is_numeric($template_id)) {
	wp_redirect( get_permalink($template_id) );
	exit;
}

?>
<main class="site-main four-oh-four" role="main">
	<section>
		<h1 class="entry-title"><?php esc_html_e( 'The page can&rsquo;t be found.', 'cl-elementor' ); ?></h1>
		<div class="page-content">
			<img src="<?php bloginfo('template_url'); ?>/assets/images/404.png" style="margin:50px 0; width:100%; max-width:500px;" alt="404 error. Page not found." />
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Please use the menu above to navigate the website.', 'cl-elementor' ); ?></p>
		</div>
	</section>
</main>
