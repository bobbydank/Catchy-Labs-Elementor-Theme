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
	// Set up a WP_Query to get the page with the given ID
	$args = array(
		'p' => $template_id, // Get the page by ID
		'post_type' => 'page', // Make sure it's a page
		'post_status' => 'publish', // Only get published pages
	);

	$query = new WP_Query($args);

	// If the page exists, display its content
	if ($query->have_posts()) {
		$query->the_post(); // Set up the post data for the page
		
		if (cl_is_elementor_page($template_id)) {
			// Display Elementor content
			?>
			<main class="site-main four-oh-four" role="main">
				<section>
					<?php cl_elementor_the_content( $template_id ); ?>
				</section>
			</main>
			<?php
		} else {
			// Display normal WordPress content
			?>
			<main class="site-main four-oh-four" role="main">
				<section>
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="page-content">
						<?php the_content(); ?>
					</div>
				</section>
			</main>
			<?php
		}
	} else {
		// Fallback if the page doesn't exist
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
		<?php
	}

	// Reset the global post data after the custom query
	wp_reset_postdata();
} else {
	// Default 404 page content if no custom page is set
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
	<?php
}
?>
