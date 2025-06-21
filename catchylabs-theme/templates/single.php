<?php
/**
 * The template for displaying singular post-types: posts, pages, and user-defined custom post types.
 *
 * CL\Elementor
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Check if Elementor is active
$template_id = get_the_ID();
$layout = cl_elementor_get_theme_option('blog_layout');
$blog_layout = $layout ? $layout : 'default';
?>

<?php while ( have_posts() ) : the_post(); ?>

<main <?php post_class( 'site-main blog-single' ); ?> role="main" id="<?php echo is_front_page() ? '' : 'main'; ?>">
    <div class="page-content">
        <?php
        if ( cl_is_elementor_page( $template_id ) ) {
            // Elementor content
            the_content();
        } else { 
			get_template_part( 'templates/partials/blog', $blog_layout );
		} ?>
    </div>
</main>

<?php endwhile; ?>
