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
class Title extends Widget_Base {

	/**
	 * Get widget name.
	 **
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return CL_ELEMENTOR_PREFIX . '-title';
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
		return __( 'Title', 'cl-elementor' );
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
		return 'eicon-t-letter';
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
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'cl-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
      'title', [
        'label' => __( 'Title', 'plugin-domain' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( '' , 'plugin-domain' ),
        'label_block' => true,
      ]
    );

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Settings', 'cl-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .page-current-title',
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => __( 'Text color', 'cl-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'std'       => '#fff',
				'selectors' => [
					'{{WRAPPER}} .page-current-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label'     => __( 'Background color', 'cl-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'std'       => '#000',
				'selectors' => [
					'{{WRAPPER}} .page-current-title' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'width',
			[
				'label'          => __( 'Width', 'elementor' ),
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
					'{{WRAPPER}} .page-current-title' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control( 'text_align', [
			'label'     => __( 'Alignment', 'elementor' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'left'   => [
					'title' => __( 'Left', 'elementor' ),
					'icon'  => 'eicon-text-align-left',
				],
				'center' => [
					'title' => __( 'Center', 'elementor' ),
					'icon'  => 'eicon-text-align-center',
				],
				'right'  => [
					'title' => __( 'Right', 'elementor' ),
					'icon'  => 'eicon-text-align-right',
				],
			],
			'selectors' => [
				'{{WRAPPER}} .page-current-title' => 'text-align: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'position', [
			'label'     => __( 'Position', 'elementor' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'left'  => [
					'title' => __( 'Left', 'elementor' ),
					'icon'  => 'eicon-text-align-left',
				],
				'right' => [
					'title' => __( 'Right', 'elementor' ),
					'icon'  => 'eicon-text-align-right',
				],
			],
			'selectors' => [
				'{{WRAPPER}} .page-current-title' => 'float: {{VALUE}}; display:block;',
			],
		] );

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label'      => __( 'Border Radius', 'elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .page-current-title' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label'      => __( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%', 'rem' ],
				'selectors'  => [
					'{{WRAPPER}} .page-current-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		if ($settings['title']) {
			$title = $settings['title'];
		} else if ( is_single() || is_page() ) {
			$title = get_the_title();
		} else if ( is_archive() ) {
			$title = get_the_archive_title();
		} else if ( is_category() ) {
			$object = get_queried_object();
			$title  = $object->name;
		} else {
			$title = '';
		}
		$title = apply_filters( 'cl_page_title', $title );
		if ( empty( $title ) ) {
			return;
		}
		?>
        <h1 class="page-current-title">
			<?php echo $title; ?>
        </h1>
		<?php

	}

}
