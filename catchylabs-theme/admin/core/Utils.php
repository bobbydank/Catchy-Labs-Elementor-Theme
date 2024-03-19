<?php

namespace CL\Elementor\Core;

use Elementor\Plugin;

/**
 * Class Utils
 * @package CL\Elementor
 */
class Utils {

	/**
	 * Return the theme options
	 *
	 * @param $key
	 * @param null $default
	 *
	 * @return false|mixed|void
	 */
	public static function get_theme_option( $key, $default = null ) {
		$options = get_option( 'theme_options' );
		if ( ! isset( $options[ $key ] ) ) {
			return $default;
		}

		return $options[ $key ];
	}


	/**
	 * Return the post meta
	 *
	 * @param $key
	 * @param null $post_id
	 * @param bool $single
	 *
	 * @return mixed
	 */
	public static function get_meta( $key, $post_id = null, $single = true ) {
		if ( is_null( $post_id ) ) {
			$post_id = get_the_ID();
		}

		return get_post_meta( $post_id, $key, $single );
	}

	/**
	 * Echo the content of the section
	 *
	 * @param null $post_id
	 */
	public static function the_elementor_content( $post_id = null ) {
		if ( is_null( $post_id ) ) {
			$post_id = get_the_ID();
		}
		if ( class_exists( '\Elementor\Plugin' ) ) {
			echo \Elementor\Plugin::instance()->frontend->get_builder_content( $post_id );
		}
	}


	/**
	 * Return elementor template
	 *
	 * @param string $type
	 * @param array $args
	 *
	 * @return int[]|\WP_Post[]
	 */
	public static function get_elementor_templates( $type = 'section', $args = array() ) {

		$params = wp_parse_args( $args, array(
			'post_type'      => $type,
			'posts_per_page' => -1,
			'post_status'    => 'publish',
		) );

		/*
		$params = wp_parse_args( $args, array(
			'post_type'      => 'elementor_library',
			'posts_per_page' => - 1,
			'post_status'    => 'publish',
		) );

		if ( ! empty( $type ) ) {
			$params['meta_query'] = array(
				array(
					'key'     => '_elementor_template_type',
					'value'   => $type,
					'compare' => '=',
				)
			);
		}*/

		return get_posts( $params );
	}

	/**
	 * Return custom footer id
	 * @return false|mixed|string|void
	 */
	public static function get_header_id() {
		return self::get_template_id_default( 'header' );
	}

	/**
	 * Return custom footer id
	 * @return false|mixed|string|void
	 */
	public static function get_footer_id() {
		return self::get_template_id_default( 'footer' );
	}

	/**
	 * Return template id based on page override
	 *
	 * @param $type
	 *
	 * @return false|mixed|string|void
	 */
	private static function get_template_id_default( $type ) {

		$template   = '';
		$opt_custom = '';
		$opt_name   = '';

		switch ( $type ) {
			case 'header':
				$opt_custom = 'use_custom_header';
				$opt_name   = 'default_header';
			break;
			case 'footer':
				$opt_custom = 'use_custom_footer';
				$opt_name   = 'default_footer';
			break;
		}

		if ( ! empty( $opt_custom ) && ! empty( $opt_name ) ) {
			$is_custom = self::get_meta( $opt_custom, get_the_ID() );
			if ( 'on' === $is_custom ) {
				$template = self::get_meta( $opt_name );
			}
			if ( empty( $template ) ) {
				$template = self::get_theme_option( $opt_name, '' );
			}
		}

		return $template;
	}

	/**
	 * Is built with elementor
	 * @return bool
	 */
	public static function is_built_with_elementor() {
		global $post;
		if ( empty( $post->ID ) ) {
			return false;
		}

		$document = Plugin::$instance->documents->get( $post->ID );
		if ( ! $document ) {
			return false;
		}

		return $document->is_built_with_elementor();
	}

	/**
	 * Is page title hidden?
	 * @return bool
	 */
	public static function is_page_title_hidden() {

		$hide = false;

		// Don't show when elementor library template
		if ( is_singular( 'elementor_library' ) ) {
			$hide = true;
		}

		$current_doc = \Elementor\Plugin::instance()->documents->get( get_the_ID() );
		if ( $current_doc && 'yes' === $current_doc->get_settings( 'hide_title' ) ) {
			$hide = true;
		}

		return apply_filters( 'cl_elementor_page_title', $hide );
	}

	/**
	 * Get Social Channels
	 * @return array
	 */
	public static function get_social_channels() {
		return array('github', 'twitter', 'instagram', 'facebook', 'linkedin', 'discord');
	}

	/**
	 * Get Social Icons
	 * @return array
	 */
	public static function get_social_icon( $channel ) {
		//these are font awesome icons
		switch ($channel) {
			case 'github':
				return '<i class="fa-brands fa-github"></i>';
				break;
			case 'twitter':
				return '<i class="fa-brands fa-twitter"></i>';
				break;
			case 'instagram':
				return '<i class="fa-brands fa-instagram"></i>';
				break;
			case 'facebook':
				return '<i class="fa-brands fa-facebook"></i>';
				break;
			case 'linkedin':
				return '<i class="fa-brands fa-linkedin"></i>';
				break;
			case 'discord':
				return '<i class="fa-brands fa-discord"></i>';
				break;	
			default:
				return '<i class="fa-solid fa-globe"></i>';
				break;
		}
	}
}
