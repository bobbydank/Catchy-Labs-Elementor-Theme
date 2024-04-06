<?php

namespace CL\Elementor\Theme;

use CL\Elementor\Core\Base;
use CL\Elementor\Theme\Widgets\Slider;
use CL\Elementor\Theme\Widgets\Simple_Modal;
use CL\Elementor\Theme\Widgets\Video_Popup;
use CL\Elementor\Theme\Widgets\Icon_Slider;
use CL\Elementor\Theme\Widgets\Image_Title_Hover;
use CL\Elementor\Theme\Widgets\Brand_Window;
use CL\Elementor\Theme\Widgets\Submenu;
use CL\Elementor\Theme\Widgets\Team_Slider;
use CL\Elementor\Theme\Widgets\Circle_Graphic;
use CL\Elementor\Theme\Widgets\Drop_List;
use CL\Elementor\Theme\Widgets\Menu;
use CL\Elementor\Theme\Widgets\Title;
use CL\Elementor\Theme\Widgets\Sitemap;
use CL\Elementor\Theme\Widgets\Search;
use CL\Elementor\Theme\Widgets\Popup_Gallery;
use CL\Elementor\Theme\Widgets\Dropper_Title;
use CL\Elementor\Theme\Widgets\Before_After_Image;
use CL\Elementor\Theme\Widgets\Review_Slider;
use CL\Elementor\Theme\Widgets\Post_Feed;

/**
 * Class Theme
 * @package CL\Elementor\Theme
 */
class Theme extends Base {

	/**
	 * Theme constructor.
	 */
	public function __construct() {

		parent::__construct();

		// Register Theme options
		$this->setup_theme_options();

		// Register menus
		$this->add_nav_menu( 'menu-1', __( 'Primary', 'cl-elementor' ) );

		// Register Elementor widgets
		$this->add_elementor_widget( Menu::class );
		$this->add_elementor_widget( Title::class );
		$this->add_elementor_widget( Sitemap::class );
		$this->add_elementor_widget( Simple_Modal::class );
		$this->add_elementor_widget( Video_Popup::class );
		//$this->add_elementor_widget( Icon_Slider::class );
		//$this->add_elementor_widget( Image_Title_Hover::class );
		$this->add_elementor_widget( Brand_Window::class );
		//$this->add_elementor_widget( Submenu::class );
		//$this->add_elementor_widget( Team_Slider::class );
		//$this->add_elementor_widget( Circle_Graphic::class );
		//$this->add_elementor_widget( Drop_List::class );
		//$this->add_elementor_widget( Slider::class );
		$this->add_elementor_widget( Search::class );
		$this->add_elementor_widget( Popup_Gallery::class );
		$this->add_elementor_widget( Dropper_Title::class );
		$this->add_elementor_widget( Before_After_Image::class );
		$this->add_elementor_widget( Review_Slider::class );
		$this->add_elementor_widget( Post_Feed::class );

		$this->add_frontend_script( CL_ELEMENTOR_PREFIX . '-slick', CL_ELEMENTOR_URI . 'elementor/assets/js/slick-js/slick.min.js', [ 'jquery' ], 1.0, true );
		$this->add_frontend_style( CL_ELEMENTOR_PREFIX . '-slick', CL_ELEMENTOR_URI . 'elementor/assets/js/slick-js/slick.css', [], 1.0 );

		// Register styles
		$styles = array(
			'theme',
			'simple-modal',
			'review-slider',
			'video-popup',
			'brand-window',
			'post-feed'
		);
		$this->register_styles( $styles );

		// Register scripts
		$scripts = array(
			'theme',
			'brand-window'
		);
		$this->register_scripts( $scripts );

		// Register shortcodes
		$this->add_shortcode( 'year', array( $this, 'do_shortcode_year' ) );
		$this->add_shortcode( 'user_name', array( $this, 'do_shortcode_username' ) );
	}

	/**
	 * Do shortcode year.
	 */
	public function do_shortcode_year() {
		return wp_date( 'Y' );
	}

	public function do_shortcode_username() {
		global $current_user; wp_get_current_user();
		return $current_user->display_name;
	}

	/**
	 * Private functions */
	/**
	 * 
	 */
	private function register_styles( $styles ) {
		if (empty($styles)) {
			return;
		}

		foreach ($styles as $style) {
			$this->add_frontend_style( CL_ELEMENTOR_PREFIX . '-' . $style, CL_ELEMENTOR_URI . 'elementor/assets/css/'. $style .'.css', [], filemtime( CL_ELEMENTOR_PATH . 'elementor/assets/css/'. $style .'.css' ) );
		}
	}

	/**
	 * 
	 */
	private function register_scripts( $scripts ) {
		if (empty($scripts)) {
			return;
		}

		foreach ($scripts as $script) {
			$this->add_frontend_script( CL_ELEMENTOR_PREFIX . '-' .$script, CL_ELEMENTOR_URI . 'elementor/assets/js/'.$script.'.js', [ 'jquery' ], filemtime( CL_ELEMENTOR_PATH . 'elementor/assets/js/'.$script.'.js' ), true );
		}
	}
}

//$this->add_frontend_style( CL_ELEMENTOR_PREFIX . '-icon-slider', CL_ELEMENTOR_URI . 'elementor/assets/css/icon-slider.css', [], filemtime( CL_ELEMENTOR_PATH . 'elementor/assets/css/icon-slider.css' ) );
//$this->add_frontend_style( CL_ELEMENTOR_PREFIX . '-image-title-hover', CL_ELEMENTOR_URI . 'elementor/assets/css/image_title_hover.css', [], filemtime( CL_ELEMENTOR_PATH . 'elementor/assets/css/image_title_hover.css' ) );
//$this->add_frontend_style( CL_ELEMENTOR_PREFIX . '-submenu', CL_ELEMENTOR_URI . 'elementor/assets/css/submenu.css', [], filemtime( CL_ELEMENTOR_PATH . 'elementor/assets/css/submenu.css' ) );
//$this->add_frontend_style( CL_ELEMENTOR_PREFIX . '-team-slider', CL_ELEMENTOR_URI . 'elementor/assets/css/team-slider.css', [], filemtime( CL_ELEMENTOR_PATH . 'elementor/assets/css/team-slider.css' ) );
//$this->add_frontend_style( CL_ELEMENTOR_PREFIX . '-circle-graphic', CL_ELEMENTOR_URI . 'elementor/assets/css/circle-graphic.css', [], filemtime( CL_ELEMENTOR_PATH . 'elementor/assets/css/circle-graphic.css' ) );
//$this->add_frontend_style( CL_ELEMENTOR_PREFIX . '-drop-list', CL_ELEMENTOR_URI . 'elementor/assets/css/drop-list.css', [], filemtime( CL_ELEMENTOR_PATH . 'elementor/assets/css/drop-list.css' ) );
//$this->add_frontend_style( CL_ELEMENTOR_PREFIX . '-slider', CL_ELEMENTOR_URI . 'elementor/assets/css/slider.css', [], filemtime( CL_ELEMENTOR_PATH . 'elementor/assets/css/slider.css' ) );

//$this->add_frontend_script( CL_ELEMENTOR_PREFIX . '-slick', CL_ELEMENTOR_URI . 'elementor/assets/js/slick-js/slick.min.js', [ 'jquery' ], 1.0, filemtime( CL_ELEMENTOR_PATH . 'elementor/assets/js/slick-js/slick.min.js' ) );
//$this->add_frontend_script( CL_ELEMENTOR_PREFIX . '-slider-icon', CL_ELEMENTOR_URI . 'elementor/assets/js/icon-slider.js', [ 'jquery' ], filemtime( CL_ELEMENTOR_PATH . 'elementor/assets/js/icon-slider.js' ), true );
//$this->add_frontend_script( CL_ELEMENTOR_PREFIX . '-team-slider', CL_ELEMENTOR_URI . 'elementor/assets/js/team-slider.js', [ 'jquery' ], filemtime( CL_ELEMENTOR_PATH . 'elementor/assets/js/team-slider.js' ), true );