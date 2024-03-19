<?php

namespace CL\Elementor\Theme\Widgets;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

/**
 * Class Menu
 * @package CL\Elementor\Widgets
 */
class Before_After_Image extends Widget_Base {

	/**
	 * Get widget name.
	 **
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return CL_ELEMENTOR_PREFIX . '-before-after-image';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_title() {
		return __( 'Before After Image', 'cl-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'eicon-shrink';
	}

	/**
	 * Get widget categories.
	 *
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_categories() {
		return [ 'theme-widgets' ];
	}

	/**
	 * Register widget controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$locations = array();

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Settings', 'cl-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'before_image',
			[
			  'label' => __( 'Before Image', 'plugin-domain' ),
			  'type' => \Elementor\Controls_Manager::MEDIA,
			  'default' => [
				'url' => \Elementor\Utils::get_placeholder_image_src(),
			  ],
			]
		);

		$this->add_control(
			'after_image',
			[
			  'label' => __( 'After Image', 'plugin-domain' ),
			  'type' => \Elementor\Controls_Manager::MEDIA,
			  'default' => [
				'url' => \Elementor\Utils::get_placeholder_image_src(),
			  ],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
        ?>
		
        <div class="cl-image-comparison">
			<div class="image-comparison-hover before"></div>
			<div class="image-comparison-hover after"></div>
			<div class="imageBox imageBefore">
				<?php echo wp_get_attachment_image( $settings['before_image']['id'], 'large' ); ?>
			</div>
			<div class="imageBox imageAfter">
				<?php echo wp_get_attachment_image( $settings['after_image']['id'], 'large' ); ?>
			</div>
		</div>
		
		<?php 
	}

}
