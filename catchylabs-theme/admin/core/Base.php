<?php

namespace CL\Elementor\Core;

use IgniteKit\WP\OptionBuilder\Framework;

/**
 * Class Base
 * @package CL\Elementor\Core
 */
abstract class Base {

	/**
	 * Keep the widget classes
	 * @var array
	 */
	protected $widgets = array();

	/**
	 * The options framework
	 * @var Framework
	 */
	protected $framework;

	/**
	 * Theme support
	 * @var array
	 */
	protected $supports = array();

	/**
	 * The nav menus
	 * @var array
	 */
	protected $nav_menus = array();

	/**
	 * The sidebars
	 * @var array
	 */
	protected $sidebars = array();

	/**
	 * The scripts
	 * @var array
	 */
	protected $scripts = array();

	/**
	 * The styles
	 * @var array
	 */
	protected $styles = array();

	/**
	 * The theme options template
	 * @var array
	 */
	protected $theme_options_template = array();

	/**
	 * The theme options page
	 * @var array
	 */
	protected $theme_options_fields = array();

	/**
	 * The theme options sections
	 * @var array
	 */
	protected $theme_options_sections = array();

	/**
	 * The theme shortcodes
	 */
	protected $shortcodes = array();

	/**
	 * Theme constructor.
	 */
	public function __construct() {
		$this->framework = new Framework();
		add_action( 'after_setup_theme', array( $this, 'setup_theme' ), 10 );
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_enqueue_scripts' ), 10 );
		add_action( 'admin_enqueue_scripts', array( $this, 'backend_enqueue_scripts' ), 10 );
		add_action( 'elementor/widgets/register', array( $this, 'register_new_widgets') );
		//add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_elementor_widgets' ) );
		add_filter( 'opb_type_select_choices', array( $this, 'filter_header_footer_templates' ), 10, 2 );

		//construct social options
		$socials = array();
		foreach (Utils::get_social_channels() as $x) {
			$socials[] = array(
				'id'           => 'social_'.$x,
				'label'        => __( ucfirst($x), 'cl-elementor' ),
				'desc'         => sprintf( __( 'URL for your '.$x.' account.', 'cl-elementor' ) ),
				'std'          => '',
				'type'         => 'text',
				'section'      => 'social',
				'rows'         => '',
				'post_type'    => '',
				'taxonomy'     => '',
				'min_max_step' => '',
				'class'        => '',
				'operator'     => 'and',
				'choices'      => array(),
				'condition'    => '',
			);
		}
		$this->theme_options_fields = array_merge( $this->theme_options_fields, $socials );
	}

	/**
	 * Populate the header/footer select fields
	 *
	 * @param $choices
	 * @param $field_id
	 *
	 * @return mixed
	 */
	public function filter_header_footer_templates( $choices, $field_id ) {

		if ( in_array( $field_id, array( 'default_footer', 'default_header' ) ) ) {
			$choices = array(-1 => array('value' => -1, 'label' => 'Theme Default'));
			foreach ( Utils::get_elementor_templates('cl_header_footer') as $p ) {
				array_push( $choices, array(
					'value' => $p->ID,
					'label' => $p->post_title,
				) );
			}
		} 

		return $choices;
	}

	/**
	 * Setup theme options
	 */
	public function setup_theme() {

		load_theme_textdomain( 'cl-elementor', CL_ELEMENTOR_PATH . 'languages' );

		// Register the nav menus
		if ( ! empty( $this->nav_menus ) ) {
			register_nav_menus( $this->nav_menus );
		}

		//  Register the sidebars
		foreach ( $this->sidebars as $sidebar ) {
			register_sidebar( $sidebar );
		}

		// Register the shortcodes
		foreach ( $this->shortcodes as $name => $callback ) {
			add_shortcode( $name, $callback );
		}

		// Configure theme support
		foreach ( $this->supports as $feature => $options ) {
			if ( $feature !== $options ) {
				add_theme_support( $feature, $options );
			} else {
				add_theme_support( $feature );
			}
		}

		$GLOBALS['content_width'] = apply_filters( 'cl_elementor_content_width', 800 );
	}

	/**
	 * Register elementor widgets
	 */
	public function register_elementor_widgets() {
		foreach ( $this->widgets as $widget ) {
			if ( ! class_exists( $widget ) ) {
				continue;
			}
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $widget );
		}
	}
	function register_new_widgets( $widgets_manager ) {
		foreach ( $this->widgets as $widget ) {
			if ( ! class_exists( $widget ) ) {
				continue;
			}
			$widgets_manager->register( new $widget );
		}
	}

	/**
	 * Setup the theme options config
	 */
	protected function prepare_theme_options() {

		$this->theme_options_sections = array_merge( $this->theme_options_sections, array(
			array(
				'id'    => 'settings',
				'title' => __( 'Settings', 'cl-elementor' ),
			),
			array(
				'id'    => 'colors',
				'title' => __( 'Colors', 'cl-elementor' ),
			),
			array(
				'id'    => 'header',
				'title' => __( 'Header', 'cl-elementor' ),
			),
			array(
				'id'    => 'footer',
				'title' => __( 'Footer', 'cl-elementor' ),
			),
			array(
				'id'    => 'social',
				'title' => __( 'Social', 'cl-elementor' ),
			),
			array(
				'id'    => 'libraries',
				'title' => __( 'Libraries', 'cl-elementor' ),
			),
			array(
				'id'    => 'tags',
				'title' => __( 'Tags', 'cl-elementor' ),
			)
		) );

		$this->theme_options_fields = array_merge( $this->theme_options_fields, array(
			//header
			array(
				'id'           => 'default_header',
				'label'        => __( 'Default Header', 'cl-elementor' ),
				'desc'         => sprintf( __( 'Select the default header for this site', 'cl-elementor' ) ),
				'std'          => '',
				'type'         => 'select',
				'section'      => 'header',
				'rows'         => '',
				'post_type'    => '',
				'taxonomy'     => '',
				'min_max_step' => '',
				'class'        => '',
				'operator'     => 'and',
				'choices'      => array(),
				'condition'    => '',
			),
			array(
				'id'           => 'header_logo',
				'label'        => __( 'Logo', 'cl-elementor' ),
				'desc'         => sprintf( __( 'Logo will appear in the default header', 'cl-elementor' ) ),
				'std'          => '',
				'type'         => 'upload',
				'section'      => 'settings',
				'rows'         => '',
				'post_type'    => '',
				'taxonomy'     => '',
				'min_max_step' => '',
				'class'        => '',
				'operator'     => 'and',
				'choices'      => array(),
				'condition'    => '',
			),
			array(
				'id'           => 'header_logo_width',
				'label'        => __( 'Logo Width', 'cl-elementor' ),
				'desc'         => sprintf( __( 'How big is the logo? (em)', 'cl-elementor' ) ),
				'std'          => '',
				'type'         => 'numeric_slider',
				'section'      => 'settings',
				'rows'         => '',
				'post_type'    => '',
				'taxonomy'     => '',
				'min_max_step' => '',
				'class'        => '',
				'operator'     => 'and',
				'choices'      => array(),
				'condition'    => '',
			),
			array(
				'id'           => 'primary_color',
				'label'        => __( 'Primary Color', 'cl-elementor' ),
				'desc'         => sprintf( __( 'A color that is used as the primary color for a number of things', 'cl-elementor' ) ),
				'std'          => '',
				'type'         => 'colorpicker',
				'section'      => 'colors',
				'rows'         => '',
				'post_type'    => '',
				'taxonomy'     => '',
				'min_max_step' => '',
				'class'        => '',
				'operator'     => 'and',
				'choices'      => array(),
				'condition'    => '',
			),
			array(
				'id'           => 'secondary_color',
				'label'        => __( 'Secondary Color', 'cl-elementor' ),
				'desc'         => sprintf( __( 'A color that is used as the secondary color for a number of things', 'cl-elementor' ) ),
				'std'          => '',
				'type'         => 'colorpicker',
				'section'      => 'colors',
				'rows'         => '',
				'post_type'    => '',
				'taxonomy'     => '',
				'min_max_step' => '',
				'class'        => '',
				'operator'     => 'and',
				'choices'      => array(),
				'condition'    => '',
			),
			array(
				'id'           => 'tertiary_color',
				'label'        => __( 'Tertiary Color', 'cl-elementor' ),
				'desc'         => sprintf( __( 'A color that is used as the tertiary color for a number of things', 'cl-elementor' ) ),
				'std'          => '',
				'type'         => 'colorpicker',
				'section'      => 'colors',
				'rows'         => '',
				'post_type'    => '',
				'taxonomy'     => '',
				'min_max_step' => '',
				'class'        => '',
				'operator'     => 'and',
				'choices'      => array(),
				'condition'    => '',
			),
			array(
				'id'           => 'text_color',
				'label'        => __( 'Text Color', 'cl-elementor' ),
				'desc'         => sprintf( __( 'A color that is used as the text color for a number of things', 'cl-elementor' ) ),
				'std'          => '',
				'type'         => 'colorpicker',
				'section'      => 'colors',
				'rows'         => '',
				'post_type'    => '',
				'taxonomy'     => '',
				'min_max_step' => '',
				'class'        => '',
				'operator'     => 'and',
				'choices'      => array(),
				'condition'    => '',
			),
			array(
				'id'           => 'disable_comments',
				'label'        => __( 'Disable Comments', 'cl-elementor' ),
				'desc'         => sprintf( __( 'This will disable all comments on the site.', 'cl-elementor' ) ),
				'std'          => 'off',
				'type'         => 'on-off',
				'section'      => 'settings',
				'rows'         => '',
				'post_type'    => '',
				'taxonomy'     => '',
				'min_max_step' => '',
				'class'        => '',
				'operator'     => 'and',
				'choices'      => array(),
				'condition'    => '',
			),
			array(
				'id'           => 'header_fixed',
				'label'        => __( 'Fix Header', 'cl-elementor' ),
				'desc'         => sprintf( __( 'Fix the header to the top?', 'cl-elementor' ) ),
				'std'          => 'off',
				'type'         => 'on-off',
				'section'      => 'header',
				'rows'         => '',
				'post_type'    => '',
				'taxonomy'     => '',
				'min_max_step' => '',
				'class'        => '',
				'operator'     => 'and',
				'choices'      => array(),
				'condition'    => '',
			),
			array(
				'id'           => 'header_main_padding',
				'label'        => __( 'Main Padding', 'cl-elementor' ),
				'desc'         => sprintf( __( 'How much top padding does the content under the header need? (Pixels)', 'cl-elementor' ) ),
				'std'          => '0',
				'type'         => 'text',
				'section'      => 'header',
				'rows'         => '',
				'post_type'    => '',
				'taxonomy'     => '',
				'min_max_step' => '',
				'class'        => '',
				'operator'     => 'and',
				'choices'      => array(),
				'condition'    => 'header_fixed:is(on)',
			),
			//footer
			array(
				'id'           => 'default_footer',
				'label'        => __( 'Default Footer', 'cl-elementor' ),
				'desc'         => sprintf( __( 'Select the default footer for this site', 'cl-elementor' ) ),
				'std'          => '',
				'type'         => 'select',
				'section'      => 'footer',
				'rows'         => '',
				'post_type'    => '',
				'taxonomy'     => '',
				'min_max_step' => '',
				'class'        => '',
				'operator'     => 'and',
				'choices'      => array(),
				'condition'    => '',
			),
			array(
				'id'           => 'footer_copyright',
				'label'        => __( 'Copyright', 'cl-elementor' ),
				'desc'         => sprintf( __( 'The copyright line that appears in the default footer', 'cl-elementor' ) ),
				'std'          => '',
				'type'         => 'text',
				'section'      => 'footer',
				'rows'         => '',
				'post_type'    => '',
				'taxonomy'     => '',
				'min_max_step' => '',
				'class'        => '',
				'operator'     => 'and',
				'choices'      => array(),
				'condition'    => '',
			),
			array(
				'id'           => 'footer_fixed',
				'label'        => __( 'Fix Footer', 'cl-elementor' ),
				'desc'         => sprintf( __( 'Fix the footer to the top?', 'cl-elementor' ) ),
				'std'          => 'off',
				'type'         => 'on-off',
				'section'      => 'footer',
				'rows'         => '',
				'post_type'    => '',
				'taxonomy'     => '',
				'min_max_step' => '',
				'class'        => '',
				'operator'     => 'and',
				'choices'      => array(),
				'condition'    => '',
			),
			//libraries
			array(
				'id'           => 'css_tailwind',
				'label'        => __( 'Tailwind CSS', 'cl-elementor' ),
				'desc'         => sprintf( __( 'Our theme comes with a scoped Tailwind file. Any styles inside the container with the selector .cl-tailwind-container will be subject to TailwindCSS rules. Would you like to load this Scoped Tailwind CSS file?', 'cl-elementor' ) ),
				'std'          => 'off',
				'type'         => 'on-off',
				'section'      => 'libraries',
				'rows'         => '',
				'post_type'    => '',
				'taxonomy'     => '',
				'min_max_step' => '',
				'class'        => '',
				'operator'     => 'and',
				'choices'      => array(),
				'condition'    => '',
			),
			array(
				'id'           => 'css_fontawesome',
				'label'        => __( 'Fontawesome', 'cl-elementor' ),
				'desc'         => sprintf( __( 'Would you like to load fontawesome?', 'cl-elementor' ) ),
				'std'          => 'on',
				'type'         => 'on-off',
				'section'      => 'libraries',
				'rows'         => '',
				'post_type'    => '',
				'taxonomy'     => '',
				'min_max_step' => '',
				'class'        => '',
				'operator'     => 'and',
				'choices'      => array(),
				'condition'    => '',
			),
			array(
				'id'           => 'js_aos',
				'label'        => __( 'Animate on Scroll', 'cl-elementor' ),
				'desc'         => sprintf( __( 'Would you like to load aos library?', 'cl-elementor' ) ),
				'std'          => 'off',
				'type'         => 'on-off',
				'section'      => 'libraries',
				'rows'         => '',
				'post_type'    => '',
				'taxonomy'     => '',
				'min_max_step' => '',
				'class'        => '',
				'operator'     => 'and',
				'choices'      => array(),
				'condition'    => '',
			),
			array(
				'id'           => 'js_slick',
				'label'        => __( 'Slick JS', 'cl-elementor' ),
				'desc'         => sprintf( __( 'Would you like to load Slick JS library?', 'cl-elementor' ) ),
				'std'          => 'on',
				'type'         => 'on-off',
				'section'      => 'libraries',
				'rows'         => '',
				'post_type'    => '',
				'taxonomy'     => '',
				'min_max_step' => '',
				'class'        => '',
				'operator'     => 'and',
				'choices'      => array(),
				'condition'    => '',
			),
			array(
				'id'           => 'js_magnific',
				'label'        => __( 'Magnific JS', 'cl-elementor' ),
				'desc'         => sprintf( __( 'Would you like to load Magnific JS library?', 'cl-elementor' ) ),
				'std'          => 'on',
				'type'         => 'on-off',
				'section'      => 'libraries',
				'rows'         => '',
				'post_type'    => '',
				'taxonomy'     => '',
				'min_max_step' => '',
				'class'        => '',
				'operator'     => 'and',
				'choices'      => array(),
				'condition'    => '',
			),
			//tags
			array(
				'id'           => 'head_tags',
				'label'        => __( 'Head', 'cl-elementor' ),
				'desc'         => sprintf( __( 'Insert code here to appear in the HEAD of the dom', 'cl-elementor' ) ),
				'std'          => '',
				'type'         => 'javascript',
				'section'      => 'tags',
				'rows'         => '',
				'post_type'    => '',
				'taxonomy'     => '',
				'min_max_step' => '',
				'class'        => '',
				'operator'     => 'and',
				'choices'      => array(),
				'condition'    => '',
			),
			array(
				'id'           => 'openbody_tags',
				'label'        => __( 'Open Body', 'cl-elementor' ),
				'desc'         => sprintf( __( 'Insert code here to appear just after the opening body tag of the dom', 'cl-elementor' ) ),
				'std'          => '',
				'type'         => 'javascript',
				'section'      => 'tags',
				'rows'         => '',
				'post_type'    => '',
				'taxonomy'     => '',
				'min_max_step' => '',
				'class'        => '',
				'operator'     => 'and',
				'choices'      => array(),
				'condition'    => '',
			),
			array(
				'id'           => 'footer_tags',
				'label'        => __( 'Footer', 'cl-elementor' ),
				'desc'         => sprintf( __( 'Insert code here to appear just above the closing body of the dom', 'cl-elementor' ) ),
				'std'          => '',
				'type'         => 'javascript',
				'section'      => 'tags',
				'rows'         => '',
				'post_type'    => '',
				'taxonomy'     => '',
				'min_max_step' => '',
				'class'        => '',
				'operator'     => 'and',
				'choices'      => array(),
				'condition'    => '',
			),
		) );

		$this->theme_options_template = array(
			'id'    => 'theme_options',
			'pages' => array(
				array(
					'id'              => 'theme_options_page',
					'parent_slug'     => 'themes.php',
					'page_title'      => __( 'Theme Options', 'cl-elementor' ),
					'menu_title'      => __( 'Theme Options', 'cl-elementor' ),
					'capability'      => 'edit_theme_options',
					'menu_slug'       => 'demo-theme-options',
					'icon_url'        => null,
					'position'        => null,
					'updated_message' => __( 'Options updated!', 'cl-elementor' ),
					'reset_message'   => __( 'Options reset!', 'cl-elementor' ),
					'button_text'     => __( 'Save changes', 'cl-elementor' ),
					'show_buttons'    => true,
					'screen_icon'     => 'options-general',
				)
			)
		);
	}

	/**
	 * Setup the theme options
	 */
	protected function create_theme_options() {
		$this->theme_options_template['pages'][0]['sections'] = $this->theme_options_sections;
		$this->theme_options_template['pages'][0]['settings'] = $this->theme_options_fields;
		$this->framework->register_settings( array( $this->theme_options_template ) );

	}

	/**
	 * Setup the theme metaboxes
	 */
	protected function create_theme_metaboxes() {

		$this->framework->register_metabox( array(
			'id'       => 'page_settings',
			'title'    => __( 'Page Settings', 'cl-elementor' ),
			'desc'     => '',
			'pages'    => array( 'page' ),
			'context'  => 'normal',
			'priority' => 'high',
			'fields'   => array(
				array(
					'label' => __( 'Use custom header', 'cl-elementor' ),
					'id'    => 'use_custom_header',
					'type'  => 'on-off',
					'desc'  => __( 'Override the default header and use custom one for this specific post/page.', 'cl-elementor' ),
					'std'   => 'off',
				),
				array(
					'id'           => 'default_header',
					'label'        => __( 'Default Header', 'cl-elementor' ),
					'desc'         => sprintf( __( 'Select the default header for this site', 'cl-elementor' ) ),
					'std'          => '',
					'type'         => 'select',
					'section'      => 'page_settings',
					'rows'         => '',
					'post_type'    => '',
					'taxonomy'     => '',
					'min_max_step' => '',
					'class'        => '',
					'operator'     => 'and',
					'choices'      => array(),
					'condition'    => 'use_custom_header:is(on)',
				),
				array(
					'label' => __( 'Use custom footer', 'cl-elementor' ),
					'id'    => 'use_custom_footer',
					'type'  => 'on-off',
					'desc'  => __( 'Override the default header and use custom one for this specific post/page.', 'cl-elementor' ),
					'std'   => 'off',
				),
				array(
					'id'           => 'default_footer',
					'label'        => __( 'Default Footer', 'cl-elementor' ),
					'desc'         => sprintf( __( 'Select the default footer for this site', 'cl-elementor' ) ),
					'std'          => '',
					'type'         => 'select',
					'section'      => 'page_settings',
					'rows'         => '',
					'post_type'    => '',
					'taxonomy'     => '',
					'min_max_step' => '',
					'class'        => '',
					'operator'     => 'and',
					'choices'      => array(),
					'condition'    => 'use_custom_footer:is(on)',
				),
				array(
					'id'           => 'page_specific_tags',
					'label'        => __( 'Page specific tags', 'cl-elementor' ),
					'desc'         => sprintf( __( 'Any conversion or tracking tags you want only on this page.', 'cl-elementor' ) ),
					'std'          => '',
					'type'         => 'javascript',
					'section'      => 'page_settings',
					'rows'         => '',
					'post_type'    => '',
					'taxonomy'     => '',
					'min_max_step' => '',
					'class'        => '',
					'operator'     => 'and',
					'choices'      => array(),
					'condition'    => '',
				),
			),
		) );
	}

	/**
	 * Setup the theme options
	 */
	protected function setup_theme_options() {
		$this->prepare_theme_options();
		$this->create_theme_metaboxes();
		$this->create_theme_options();
	}

	/**
	 * Add theme options section
	 *
	 * @param $id
	 * @param $title
	 */
	protected function add_theme_options_section( $id, $title ) {
		array_push( $this->theme_options_sections, array(
			'id'    => $id,
			'title' => $title,
		) );
	}

	/**
	 * Add theme options params
	 *
	 * @param $params
	 */
	protected function add_theme_options_field( $params ) {
		array_push( $this->theme_options_fields, $params );
	}

	/**
	 * Add default theme support
	 */
	protected function add_default_theme_support() {

		$this->supports = array_merge( $this->supports, array(
			'menus',
			'post-thumbnails',
			'automatic-feed-links',
			'title-tag',
			'html5' => array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		) );
	}

	/**
	 * Add WooCommerce support
	 *
	 * @param array $options
	 */
	protected function add_woocommerce_support( $options = array() ) {
		$final          = array_merge( array(
			'woocommerce',
			'wc-product-gallery-zoom',
			'wc-product-gallery-lightbox',
			'wc-product-gallery-slider',
		), $options );
		$this->supports = array_merge( $this->supports, array_unique( $final ) );
	}

	/**
	 * Add Elementor widget
	 *
	 * @param string $_class
	 */
	protected function add_elementor_widget( $_class ) {
		array_push( $this->widgets, $_class );
	}

	/**
	 * Add theme support
	 *
	 * @param $feature
	 * @param null $options
	 */
	protected function add_theme_support( $feature, $options = null ) {
		if ( ! is_null( $options ) ) {
			if ( 'woocommerce' === $feature ) {
				$this->add_woocommerce_support( $options );
			} else {
				$this->supports[ $feature ] = $options;
			}
		} else {
			if ( 'woocommerce' === $feature ) {
				$this->add_woocommerce_support();
			} else {
				array_push( $this->supports, $feature );
			}
		}
	}

	/**
	 * Add nav menu
	 *
	 * @param $key
	 * @param $name
	 */
	protected function add_nav_menu( $key, $name ) {
		$this->nav_menus[ $key ] = $name;
	}

	/**
	 * Add sidebar
	 *
	 * @param $params
	 */
	protected function add_sidebar( $params ) {
		array_push( $this->sidebars, $params );
	}

	/**
	 * Enqueue the front end scripts
	 */
	public function frontend_enqueue_scripts() {
		if ( isset( $this->scripts['frontend'] ) ) {
			foreach ( $this->scripts['frontend'] as $script ) {
				wp_enqueue_script( $script['handle'], $script['src'], $script['deps'], $script['ver'], $script['in_footer'] );
			}
		}
		if ( isset( $this->styles['frontend'] ) ) {
			foreach ( $this->styles['frontend'] as $style ) {
				wp_enqueue_style( $style['handle'], $style['src'], $style['deps'], $style['ver'], $style['media'] );
			}
		}
	}

	/**
	 * Enqueue the front end scripts
	 */
	public function backend_enqueue_scripts() {
		if ( isset( $this->scripts['backend'] ) ) {
			foreach ( $this->scripts['backend'] as $script ) {
				wp_enqueue_script( $script['handle'], $script['src'], $script['deps'], $script['ver'], $script['in_footer'] );
			}
		}
		if ( isset( $this->styles['backend'] ) ) {
			foreach ( $this->styles['backend'] as $style ) {
				wp_enqueue_style( $style['handle'], $style['src'], $style['deps'], $style['ver'], $style['media'] );
			}
		}
	}

	/**
	 * Enqueue script
	 *
	 * @param $handle
	 * @param string $src
	 * @param array $deps
	 * @param false $ver
	 * @param false $in_footer
	 */
	protected function add_script( $type, $handle, $src = '', $deps = array(), $ver = false, $in_footer = false ) {

		if ( ! isset( $this->styles[ $type ] ) ) {
			$this->scripts[ $type ] = array();
		}

		$this->scripts[ $type ][ $handle ] = array(
			'handle'    => $handle,
			'src'       => $src,
			'deps'      => $deps,
			'ver'       => $ver,
			'in_footer' => $in_footer
		);
	}

	/**
	 * Enqueue style
	 *
	 * @param $handle
	 * @param string $src
	 * @param array $deps
	 * @param false $ver
	 * @param string $media
	 */
	protected function add_style( $type, $handle, $src = '', $deps = array(), $ver = false, $media = 'all' ) {
		if ( ! isset( $this->styles[ $type ] ) ) {
			$this->styles[ $type ] = array();
		}
		$this->styles[ $type ][ $handle ] = array(
			'handle' => $handle,
			'src'    => $src,
			'deps'   => $deps,
			'ver'    => $ver,
			'media'  => $media
		);
	}

	/**
	 * Add backend script
	 *
	 * @param $handle
	 * @param string $src
	 * @param array $deps
	 * @param false $ver
	 * @param bool $in_footer
	 */
	protected function add_backend_script( $handle, $src = '', $deps = array(), $ver = false, $in_footer = false ) {
		$this->add_script( 'backend', $handle, $src, $deps, $ver, $in_footer );
	}

	/**
	 * Add backend script
	 *
	 * @param $handle
	 * @param string $src
	 * @param array $deps
	 * @param false $ver
	 * @param bool $in_footer
	 */
	protected function add_frontend_script( $handle, $src = '', $deps = array(), $ver = false, $in_footer = false ) {
		$this->add_script( 'frontend', $handle, $src, $deps, $ver, $in_footer );
	}

	/**
	 * Add backend style
	 *
	 * @param $handle
	 * @param string $src
	 * @param array $deps
	 * @param false $ver
	 * @param string $media
	 */
	protected function add_backend_style( $handle, $src = '', $deps = array(), $ver = false, $media = 'all' ) {
		$this->add_style( 'backend', $handle, $src, $deps, $ver, $media );
	}

	/**
	 * Add front end style
	 *
	 * @param $handle
	 * @param string $src
	 * @param array $deps
	 * @param false $ver
	 * @param string $media
	 */
	protected function add_frontend_style( $handle, $src = '', $deps = array(), $ver = false, $media = 'all' ) {
		$this->add_style( 'frontend', $handle, $src, $deps, $ver, $media );
	}

	/**
	 * Add shortcode
	 *
	 * @param $name
	 * @param $callback
	 */
	protected function add_shortcode( $name, $callback ) {
		$this->shortcodes[ $name ] = $callback;
	}

}
