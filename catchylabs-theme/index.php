<?php
/**
 * The site's entry point.
 *
 * Loads the relevant template part,
 * the loop is executed (when needed) by the relevant template part.
 *
 * CL\Elementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit(); // Exit if accessed directly.
}

get_header();

$is_cl_elementor_exist = function_exists( 'elementor_theme_do_location' );

if ( is_singular() ) {
	if ( ! $is_cl_elementor_exist || ! elementor_theme_do_location( 'single' ) ) {
		if (is_singular('cl_header_footer')) {
			get_template_part( 'templates/hf' );
		} elseif (is_page()) {
			get_template_part( 'templates/page' );
		} else {
			get_template_part( 'templates/single' );
		}
	}
} elseif ( is_archive() || is_home() ) {
	if ( ! $is_cl_elementor_exist || ! elementor_theme_do_location( 'archive' ) ) {
		get_template_part( 'templates/archive' );
	}
} elseif ( is_search() ) {
	if ( ! $is_cl_elementor_exist || ! elementor_theme_do_location( 'archive' ) ) {
		get_template_part( 'templates/search' );
	}
} else {
	if ( ! $is_cl_elementor_exist || ! elementor_theme_do_location( 'single' ) ) {
		get_template_part( 'templates/404' );
	}
}

get_footer();
