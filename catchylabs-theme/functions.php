<?php
/**
 * Theme functions and definitions
 *
 * @package CL\Elementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Load text domain for translations
 */
function cl_elementor_load_textdomain() {
    load_theme_textdomain( 'cl-elementor', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'cl_elementor_load_textdomain' );

define( 'CL_ELEMENTOR_VERSION', '1.0.0' );
define( 'CL_ELEMENTOR_PATH', trailingslashit( get_template_directory() ) . 'admin/' );
define( 'CL_ELEMENTOR_URI', trailingslashit( get_template_directory_uri() ) . 'admin/' );
define( 'CL_ELEMENTOR_PREFIX', 'cl_elementor' );

define( 'CL_THEME_DIR', get_template_directory() );
define( 'CL_THEME_URL', get_template_directory_uri() );

/*
 *
 */
if ( file_exists( CL_ELEMENTOR_PATH . 'vendor/autoload.php' ) ) {
	if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
		if ( ! is_admin() && ! is_login() ) {
			wp_die( 'Please install Elementor first.' );
		}
	}
}

add_theme_support( 'post-thumbnails' );

/*
 * Theme requires
 */
require_once CL_THEME_DIR . '/inc/funcs.php';
require_once CL_THEME_DIR . '/inc/shortcodes.php';

require_once CL_THEME_DIR . '/admin/init.php';
require_once CL_THEME_DIR . '/admin/hooks/elementor.php';
require_once CL_THEME_DIR . '/admin/hooks/content-types.php';

if (function_exists('cl_elementor_get_theme_option')) {
	if (cl_elementor_get_theme_option('disable_comments') === 'on') {
		require_once CL_THEME_DIR . '/inc/disable-comments.php';
	}
}

/*
 *
 */
//image sizes
add_image_size( 'cl_square', 800, 800, array('center', 'center') );
add_image_size( 'cl_squareBig', 1500, 1500, array('center', 'center') );
add_image_size( 'cl_rect', 1500, 1000, array('center', 'center') );
add_image_size( 'cl_rectSmall', 800, 553, array('center', 'center') );

/*
 *
 */
if ( ! isset( $content_width ) ) {
	$content_width = 800; // Pixels.
}

/**
 * 
 */
function cl_enqueue_elementor_editor_styles() {
    // Check if we are in the Elementor editor
    if ( \Elementor\Plugin::$instance->editor->is_edit_mode() || isset( $_GET['action'] ) && $_GET['action'] === 'elementor' ) {
        // Enqueue your custom stylesheet
        wp_enqueue_style(
            'custom-elementor-editor-style', // Unique handle for the stylesheet
            get_stylesheet_directory_uri() . '/css/elementor-editor.css', // Path to your stylesheet
            [], // Dependencies (empty array if none)
            '1.0.0', // Version number (optional, for cache busting)
            'all' // Media type
        );
    }
}
add_action( 'wp_enqueue_scripts', 'cl_enqueue_elementor_editor_styles' );
add_action( 'admin_enqueue_scripts', 'cl_enqueue_elementor_editor_styles' );

/*
 *
 */
function cl_load_scripts () {
	$ver = time();

	if ( !is_admin() ) {
		/***************************** 
		 * js
		 */
		wp_deregister_script('jquery');
		wp_enqueue_script('jquery', "//ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js", false);
		wp_enqueue_script('hoverintent', get_template_directory_uri() . '/assets/js/jquery.hoverIntent.js', array('jquery'), 1.0, true);
		//wp_enqueue_script('cl_submenu', get_template_directory_uri() . '/assets/js/submenus.js', array('jquery'), $ver, true);

		if (cl_elementor_get_theme_option('js_aos') === 'on') {
			//aos
			wp_enqueue_script('cl_aos_js', 'https://unpkg.com/aos@2.3.1/dist/aos.js', false);
			wp_enqueue_style('cl_aos_js', 'https://unpkg.com/aos@2.3.1/dist/aos.css', false);
		}

		if (cl_elementor_get_theme_option('js_slick') === 'on') {
			//slick
			wp_enqueue_script('cl_slick_js', get_template_directory_uri() . '/assets/js/slick-js/slick.min.js', array('jquery'));
			wp_enqueue_style('cl_slick_js', get_template_directory_uri() . '/assets/js/slick-js/slick.css', false);
		}

		if (cl_elementor_get_theme_option('js_magnific') === 'on') {
			//magnific
			wp_enqueue_script('cl_magnific_js', get_template_directory_uri() . '/assets/js/magnific/jquery.magnific-popup.js', array('jquery'));
			wp_enqueue_style( 'cl_magnific_js', get_template_directory_uri().'/assets/js/magnific/magnific-popup.css', array());
		}

		wp_enqueue_script('cl_slider', get_template_directory_uri() . '/assets/js/slider.js', array('jquery'), $ver, true);
		wp_enqueue_script('cl_elementor_addons', get_template_directory_uri() . '/assets/js/elementor-addons/main.js', array('jquery'), $ver, true);
		wp_enqueue_script('cl_theme', get_template_directory_uri() . '/assets/js/theme.js', array('jquery'), $ver, true);

		/***************************** 
		 * css
		 */
		wp_enqueue_style( 'cl_reset', get_template_directory_uri().'/assets/css/reset.css', false );
		wp_enqueue_style( 'cl_variables', get_template_directory_uri().'/assets/css/variables.css', false );
		
		//css libs
		if (cl_elementor_get_theme_option('css_tailwind') === 'on') {
			//wp_enqueue_style( 'cl_tailwind', '//cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css', false );
			wp_enqueue_style( 'cl_scoped_tailwind', get_template_directory_uri() . '/assets/css/cl-scoped-tailwind-all.min.css', false );
		}
		
		if (cl_elementor_get_theme_option('css_fontawesome') === 'on') {
			wp_enqueue_style( 'cl_fontawesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css', false );
			wp_enqueue_style( 'cl_fontawesome_solid', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/solid.min.css', false );
			wp_enqueue_style( 'cl_fontawesome_brands', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/brands.min.css', false );
			wp_enqueue_style( 'cl_fontawesome_regular', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/regular.min.css', false );
		}
		
		wp_enqueue_style( 'cl_base', get_template_directory_uri().'/assets/css/base.css', array(), $ver, false );
		wp_enqueue_style( 'cl_theme', get_template_directory_uri().'/assets/css/theme.css', array(), $ver, false );
		wp_enqueue_style( 'cl_elements', get_template_directory_uri().'/assets/css/elements.css', array(), $ver, false );
		wp_enqueue_style( 'cl_elementor', get_template_directory_uri().'/assets/css/elementor.css', array(), $ver, false );

		wp_enqueue_style( 'cl_eleadds_theme', get_template_directory_uri().'/assets/css/elementor-addons/theme.css', array(), $ver, false );
		wp_enqueue_style( 'cl_eleadds_simple_modal', get_template_directory_uri().'/assets/css/elementor-addons/simple-modal.css', array(), $ver, false );
		wp_enqueue_style( 'cl_eleadds_review_slider', get_template_directory_uri().'/assets/css/elementor-addons/review-slider.css', array(), $ver, false );
		wp_enqueue_style( 'cl_eleadds_video_popup', get_template_directory_uri().'/assets/css/elementor-addons/video-popup.css', array(), $ver, false );
		wp_enqueue_style( 'cl_eleadds_post_feed', get_template_directory_uri().'/assets/css/elementor-addons/post-feed.css', array(), $ver, false );
		wp_enqueue_style( 'cl_eleadds_sitemap', get_template_directory_uri().'/assets/css/elementor-addons/sitemap.css', array(), $ver, false );

		wp_enqueue_style( 'cl_styles', get_stylesheet_uri(), array(), $ver, false );
  	}
}
add_action('wp_enqueue_scripts', 'cl_load_scripts');

/*
 *
 */
function cl_load_custom_wp_admin_style() {
	$ver = time();

    if ( is_admin() ) {
        wp_enqueue_style( 'cl_admin', get_template_directory_uri().'/assets/css/admin.css', array(), $ver, false );
    }
}
add_action('admin_enqueue_scripts', 'cl_load_custom_wp_admin_style');

/*
 *
 */
function cl_register_menu() {
  	register_nav_menu('full-menu',__( 'Full Menu' ));
	register_nav_menu('footer-menu',__( 'Footer Menu' ));
	register_nav_menu('footer-one',__( 'Footer One' ));
	register_nav_menu('menu-one',__( 'Menu One' ));
	register_nav_menu('menu-two',__( 'Menu Two' ));
	register_nav_menu('menu-three',__( 'Menu Three' ));
	register_nav_menu('menu-four',__( 'Menu Four' ));
}
add_action( 'init', 'cl_register_menu' );

/*
 * TGM plugin activation (recommended and required plugins)
 */
if ( is_admin() ) {
	require_once CL_THEME_DIR . '/admin/tgmpa/class-tgm-plugin-activation.php';
	require_once CL_THEME_DIR . '/admin/tgmpa/config.php';
}

/**
 * Update checker
 */
function cl_check_for_theme_update($checked_data) {
    if (empty($checked_data->checked))
        return $checked_data;

    $request = wp_remote_get('https://files.catchylabs.dev/themes/catchylabs-theme/metadata.json');
    if (is_wp_error($request) || wp_remote_retrieve_response_code($request) !== 200) {
        return $checked_data;
    }

    $data = json_decode(wp_remote_retrieve_body($request));
    if (isset($data->version) && version_compare($data->version, $checked_data->checked['catchylabs-theme'], '>')) {
        $checked_data->response['catchylabs-theme'] = array(
            'theme'       => 'catchylabs-theme',
            'new_version' => $data->version,
            'url'         => $data->details_url,
            'package'     => $data->download_url
        );
    }
    return $checked_data;
}
add_filter('pre_set_site_transient_update_themes', 'cl_check_for_theme_update');

function cl_theme_slug_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'textdomain' ),
		'id'            => 'blog_sidebar',
		'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'textdomain' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h3 class="widgettitle">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'cl_theme_slug_widgets_init' );
