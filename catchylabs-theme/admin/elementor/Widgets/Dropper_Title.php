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
class Dropper_Title extends Widget_Base {

	/**
	 * Get widget name.
	 **
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return CL_ELEMENTOR_PREFIX . '-dropper-title';
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
		return __( 'Dropper Title', 'cl-elementor' );
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
		return 'eicon-v-align-bottom';
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
            'title', [
                'label' => __( 'Title', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'dropper_id', [
                'label' => __( 'Dropper ID', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
                'description' => __( 'The ID of the Elementor Section we will be controlling. To make this, add a new section and under the Advanced Section, put a unique id under CSS ID.Don\'t forget to use the cl-drop-down class as well.' , 'plugin-domain' )
            ]
        );

        $this->add_control(
			'starting_position',
			[
				'label' => __( 'Starting Position', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'your-plugin' ),
				'label_off' => __( 'Off', 'your-plugin' ),
				'return_value' => 'on',
				'default' => 'off',
			]
		);

		$this->add_control(
			'line',
			[
				'label' => __( 'Center line?', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'your-plugin' ),
				'label_off' => __( 'Off', 'your-plugin' ),
				'return_value' => 'on',
				'default' => 'off',
			]
		);
		
		$this->add_control(
			'icon',
			[
				'name' => 'icon',
				'label' => __('Icon', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::ICONS,
			],
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Settings', 'cl-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_width',
			[
				'label'          => __( 'Icon Width', 'elementor' ),
				'type'           => \Elementor\Controls_Manager::SLIDER,
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
					'{{WRAPPER}} .cl-dropper-title .icon' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'bg_color',
			[
				'label'     => __( 'BG Color', 'cl-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'std'       => '#fff',
				'selectors' => [
					'{{WRAPPER}} .cl-dropper-title' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'line_position',
			[
				'label' => esc_html__( 'Positioning', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Between', 'your-plugin' ),
				'label_off' => esc_html__( 'Next to', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => '',
				'selectors'      => [
					'{{WRAPPER}} .cl-dropper-title' => 'justify-content: space-between',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .cl-dropper-title p',
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label'          => __( 'Text Width', 'elementor' ),
				'type'           => \Elementor\Controls_Manager::SLIDER,
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
					'{{WRAPPER}} .cl-dropper-title p' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => __( 'Text color', 'cl-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'std'       => '#fff',
				'selectors' => [
					'{{WRAPPER}} .cl-dropper-title p' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'text_bg_color',
			[
				'label'     => __( 'Text BG Color', 'cl-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'std'       => '#fff',
				'selectors' => [
					'{{WRAPPER}} .cl-dropper-title p' => 'background-color: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'line_color',
			[
				'label'     => __( 'Line Color', 'cl-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'std'       => '#000',
				'selectors' => [
					'{{WRAPPER}} .cl-dropper-title .line' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'line_size',
			[
				'label'          => __( 'Line Size', 'elementor' ),
				'type'           => \Elementor\Controls_Manager::SLIDER,
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
						'max' => 100,
					],
				],
				'selectors'      => [
					'{{WRAPPER}} .cl-dropper-title .line' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'dropper_color',
			[
				'label'     => __( 'Dropper color', 'cl-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'std'       => '#000',
				'selectors' => [
					'{{WRAPPER}} .cl-dropper-title i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'dropper_size',
			[
				'label'          => __( 'Dropper Size', 'elementor' ),
				'type'           => \Elementor\Controls_Manager::SLIDER,
				'default'        => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units'     => [ 'px', 'rem', 'em' ],
				'range'          => [
					'px'  => [
						'min' => 1,
						'max' => 100,
					],
					'rem' => [
						'min' => 1,
						'max' => 10,
					],
					'em' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'selectors'      => [
					'{{WRAPPER}} .cl-dropper-title i' => 'font-size: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .cl-dropper-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'border-radius',
			[
				'label'      => __( 'Border Radius', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%', 'rem' ],
				'selectors'  => [
					'{{WRAPPER}} .cl-dropper-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		
        <div class="cl-dropper-title <?php echo $settings['starting_position'] ?>" data-id="<?php echo $settings['dropper_id']; ?>">
            <p><?php echo $settings['title']; ?></p>
			<?php if ($settings['line'] === 'on') : ?>
				<div class="line"></div>
			<?php endif; ?>
			<?php if ($settings['icon']) : ?>
				<span class="icon"><?php echo \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?></span>
			<?php else: ?>
				<i class="fa-solid fa-angle-down"></i>
			<?php endif; ?>
        </div>
		
		<?php 
	}

}
