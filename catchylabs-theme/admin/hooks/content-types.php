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
	exit; // Exit if accessed directly.
}

function cl_hf_post_type() {

	$labels = array(
		'name'                => _x( 'Header/Footers', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Header/Footer', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Header/Footer', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Header/Footer:', 'text_domain' ),
		'all_items'           => __( 'All Header/Footers', 'text_domain' ),
		'view_item'           => __( 'View Header/Footer', 'text_domain' ),
		'add_new_item'        => __( 'Add New Header/Footer', 'text_domain' ),
		'add_new'             => __( 'New Header/Footer', 'text_domain' ),
		'edit_item'           => __( 'Edit Header/Footer', 'text_domain' ),
		'update_item'         => __( 'Update Header/Footer', 'text_domain' ),
		'search_items'        => __( 'Search Header/Footers', 'text_domain' ),
		'not_found'           => __( 'No Header/Footers found', 'text_domain' ),
		'not_found_in_trash'  => __( 'No SHeader/Footers found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'header-footer', 'text_domain' ),
		'description'         => __( 'header-footer information pages', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'thumbnail', 'title', 'excerpt', 'revisions', 'editor' ),
		'taxonomies'          => array( ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 7,
		'can_export'          => true,
		'has_archive'         => true,
		'menu_icon'           => 'dashicons-excerpt-view',
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post'
	);
	register_post_type( 'cl_header_footer', $args );

}
add_action( 'init', 'cl_hf_post_type', 0 );