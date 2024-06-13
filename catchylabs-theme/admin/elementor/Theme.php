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
use CL\Elementor\Theme\Widgets\Hover_FAQ;
use CL\Elementor\Theme\Widgets\Breadcrumbs;

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
		//$this->add_elementor_widget( Brand_Window::class );
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
		$this->add_elementor_widget( Hover_FAQ::class );
		$this->add_elementor_widget( Breadcrumbs::class );

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
