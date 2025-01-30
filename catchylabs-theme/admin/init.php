<?php

require_once CL_ELEMENTOR_PATH . 'vendor/autoload.php';
$theme = new \CL\Elementor\Theme\Theme();

/**
 * Returns post meta
 *
 * @param $key
 * @param null $post_id
 * @param bool $single
 *
 * @return mixed|null
 */
function cl_elementor_get_meta( $key, $post_id = null, $single = true ) {
	return \CL\Elementor\Core\Utils::get_meta( $key, $post_id, $single );
}

/**
 * Returns theme option
 *
 * @param $key
 * @param null $default
 *
 * @return false|mixed|void|null
 */
function cl_elementor_get_theme_option( $key, $default = null ) {
	return \CL\Elementor\Core\Utils::get_theme_option( $key, $default );
}

/**
 * 
 */
// Function to check if Elementor is used
function cl_is_elementor_page($post_id) {
	if (class_exists('Elementor\Plugin')) {
		return \Elementor\Plugin::$instance->db->is_built_with_elementor($post_id);
	}
	return false;
}

/**
 * Print the content
 *
 * @param null $post_id
 */
function cl_elementor_the_content( $post_id = null ) {
	\CL\Elementor\Core\Utils::the_elementor_content( $post_id );
}

/**
 * Return the header id
 * @return string|int
 */
function cl_elementor_get_header_id() {
	return \CL\Elementor\Core\Utils::get_header_id();
}

/**
 * Return the header id
 * @return string|int
 */
function cl_elementor_get_footer_id() {
	return \CL\Elementor\Core\Utils::get_footer_id();
}

/**
 * Is page built with elementor
 * @return false
 */
function cl_elementor_is_built_with_elementor() {
	return \CL\Elementor\Core\Utils::is_built_with_elementor();
}

/**
 * Is the page title hidden?
 * @return false
 */
function cl_elementor_is_page_title_hidden() {
	return \CL\Elementor\Core\Utils::is_page_title_hidden();
}

/**
 * Adds theme additions to Elementor widget categories
 */
function add_elementor_widget_categories( $elements_manager ) {
	$elements_manager->add_category(
		'theme-widgets',
		[
			'title' => __( 'Theme Widgets', 'theme-widgets' ),
			'icon' => 'fa fa-plug',
		]
	);
}
add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );


