<?php
/**
 * The template for displaying the footer.
 *
 * Contains the body & html closing tags.
 *
 * @package CL\Elementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'cl_elementor_do_location' ) || ! cl_elementor_do_location( 'footer' ) ) {
	get_template_part( 'templates/footer' );
}
?>

<?php get_template_part('inc/overlay', 'search'); ?>
<div>
	<?php wp_footer(); ?>
	<?php 
		if (cl_elementor_get_theme_option('js_aos') === 'on') : ?>
			<script>AOS.init();</script>
		<?php endif; 

		echo cl_elementor_get_theme_option('footer_tags');
		
	?>
</div>

</body>
</html>
