<?php

namespace CL\Elementor\Theme\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Icons_Manager;

/**
 * Class Menu
 * @package CL\Elementor\Widgets
 */
class Standing_Gallery extends Widget_Base {

	/**
	 * Get widget name.
	 **
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return CL_ELEMENTOR_PREFIX . '-standing-gallery';
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
		return __( 'Standing Gallery', 'cl-elementor' );
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
		return 'eicon-slides';
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

        $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'cl-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'gallery',
			[
				'label' => esc_html__( 'Add Images', 'textdomain' ),
				'type' => Controls_Manager::GALLERY,
				'show_label' => false,
				'default' => [],
			]
		);

		/*
		$this->add_control(
			'slide_num',
			[
				'label' => esc_html__( 'Slider Number', 'textdomain' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 1,
			]
		);
		*/

		$this->add_control(
			'autoplay_speed',
			[
				'label' => esc_html__( 'Autoplay Speed', 'textdomain' ),
				'description' => __('In seconds', 'cl-elementor'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 1,
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'icon_content_section',
			[
				'label' => __( 'Icons', 'cl-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'left_icon',
			[
				'name' => 'Left Icon',
				'label' => __('Left Icon', 'plugin-name'),
				'type' => Controls_Manager::ICONS,
			],
		);

		$this->add_control(
			'right_icon',
			[
				'name' => 'Right Icon',
				'label' => __('Right Icon', 'plugin-name'),
				'type' => Controls_Manager::ICONS,
			],
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_main_section',
			[
				'label' => __( 'Main Image', 'cl-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'main_width',
			[
				'label'          => __( 'Main Width', 'elementor' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units'     => [ '%', 'px', 'vw' ],
				'range'          => [
					'%'  => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'      => [
					'{{WRAPPER}} .cl-standing-gallery .main-image' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'main_padding',
			[
				'label'      => __( 'Main Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%', 'rem' ],
				'selectors'  => [
					'{{WRAPPER}} .cl-standing-gallery .main-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'bottom_spacing',
			[
				'label'          => __( 'Bottom Spacing', 'elementor' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units'     => [ 'px' ],
				'range'          => [
					'px' => [
						'min' => 1,
						'max' => 200,
					],
				],
				'selectors'      => [
					'{{WRAPPER}} .cl-standing-gallery .main-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_nav_section',
			[
				'label' => __( 'Nav Images', 'cl-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'main_nav_padding',
			[
				'label'      => __( 'Main Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%', 'rem' ],
				'selectors'  => [
					'{{WRAPPER}} .cl-standing-gallery .nav-image .nav-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'main_nav_margin',
			[
				'label'      => __( 'Main Margin', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%', 'rem' ],
				'selectors'  => [
					'{{WRAPPER}} .cl-standing-gallery .nav-image .nav-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$classes = '';

		$gallery = $settings['gallery'];
		?>

        <div class="cl-standing-gallery <?php echo $classes; ?>" data-speed="<?php echo $settings['autoplay_speed'] ?>">
			<div class="main-image">
				<?php for ( $x = 0; $x < count($gallery); $x++ ) : ?>
					<img src="<?php echo esc_url( $gallery[$x]['url'] ); ?>" alt="<?php echo esc_attr( $gallery[$x]['id'] ); ?>">
				<?php endfor; ?>
			</div>
			<div class="nav-image">
				<?php for ( $x = 0; $x < count($gallery); $x++ ) : ?>
					<div class="nav-item">
						<img src="<?php echo esc_url( $gallery[$x]['url'] ); ?>" alt="<?php echo esc_attr( $gallery[$x]['id'] ); ?>">
					</div>
				<?php endfor; ?>
			</div>
			<?php /*
			<div class="nav-arrows">
				<?php Icons_Manager::render_icon($settings['left_icon'], ['aria-hidden' => 'true', 'class' => 'left-icon']); ?>
				<?php Icons_Manager::render_icon($settings['right_icon'], ['aria-hidden' => 'true', 'class' => 'right-icon']); ?>
			</div>
			*/ ?>
        </div>
        <?php
	}

}