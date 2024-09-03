<?php

namespace CL\Elementor\Theme\Widgets;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Icons_Manager;

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

        $this->add_control(
            'dropper_id', [
                'label' => __( 'Dropper ID', 'plugin-domain' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
                'description' => __( 'The ID of the Elementor Section we will be controlling. To make this, add a new section and under the Advanced Section, put a unique id under CSS ID. Don\'t forget to use the cl-drop-down class as well on the dropdown. No #' , 'plugin-domain' )
            ]
        );

        $this->add_control(
			'starting_position',
			[
				'label' => __( 'Starting Position', 'plugin-domain' ),
				'type' => Controls_Manager::SWITCHER,
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
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'your-plugin' ),
				'label_off' => __( 'Off', 'your-plugin' ),
				'return_value' => 'on',
				'default' => 'off',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'icon_content_section',
			[
				'label' => __( 'Icon', 'cl-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'closed_icon',
			[
				'name' => 'Closed Icon',
				'label' => __('Closed Icon', 'plugin-name'),
				'type' => Controls_Manager::ICONS,
			],
		);

		$this->add_control(
			'open_icon',
			[
				'name' => 'Dont use this.',
				'label' => __('Open Icon', 'plugin-name'),
				'type' => Controls_Manager::ICONS,
			],
		);

		$this->add_control(
			'icon',
			[
				'name' => 'icon',
				'label' => __('Old. Dont use.', 'plugin-name'),
				'type' => Controls_Manager::ICONS,
				//'condition' => ['dropper_id' => '#catchylabs_labs_is_awesome']
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
			'content_align',
			[
				'label' => esc_html__( 'Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'start'    => [
						'title' => esc_html__( 'Start', 'elementor' ),
						'icon' => "eicon-text-align-left",
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__( 'End', 'elementor' ),
						'icon' => "eicon-text-align-right",
					],
					'space-between' => [
						'title' => esc_html__( 'Space between', 'elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => 'start',
				'selectors' => [
					'{{WRAPPER}} .cl-dropper-title' => 'justify-content: {{VALUE}};',
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
			'open_text_color',
			[
				'label'     => __( 'Active Text Color', 'cl-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'std'       => '#fff',
				'selectors' => [
					'{{WRAPPER}} .cl-dropper-title.on p' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'open_text_bg_color',
			[
				'label'     => __( 'Active Text BG Color', 'cl-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'std'       => '#fff',
				'selectors' => [
					'{{WRAPPER}} .cl-dropper-title.on p' => 'background-color: {{VALUE}};',
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
						'max' => 100,
					],
				],
				'selectors'      => [
					'{{WRAPPER}} .cl-dropper-title .line' => 'height: {{SIZE}}{{UNIT}};',
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

		$this->start_controls_section(
			'icon_section',
			[
				'label' => __( 'Icon', 'cl-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_width',
			[
				'label'          => __( 'Icon Width', 'elementor' ),
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
                    '{{WRAPPER}} .cl-dropper-title .icon-container svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cl-dropper-title .icon-container i' => 'font-size: {{SIZE}}{{UNIT}};'
				],
			]
		);

        $this->add_control(
			'icon_color',
			[
				'label'     => __( 'Icon color', 'cl-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'std'       => '#fff',
				'selectors' => [
					'{{WRAPPER}} .cl-dropper-title .icon-container svg path' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .cl-dropper-title .icon-container i' => 'color: {{VALUE}};'
				],
			]
		);

        $this->add_control(
			'icon_bg_color',
			[
				'label'     => __( 'Icon Background color', 'cl-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'std'       => '#fff',
				'selectors' => [
					'{{WRAPPER}} .cl-dropper-title .icon-container' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__( 'Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .cl-dropper-title .icon-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

        $this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => esc_html__( 'Icon Border Radius', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .cl-dropper-title .icon-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
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
		//print_r($settings);
        ?>
		
        <div class="cl-dropper-title <?php echo ($settings['starting_position'] === 'on') ? 'off on' : 'off' ?>" data-id="<?php echo $settings['dropper_id']; ?>">
			<?php if ( $settings['line'] === 'on' && $settings['content_align'] == 'end' ) : ?>
				<div class="line"></div>
			<?php endif; ?>

            <p><?php echo $settings['title']; ?></p>

			<?php if ( $settings['line'] === 'on' && ( $settings['content_align'] == 'space-between' || $settings['content_align'] == 'center' ) ) : ?>
				<div class="line"></div>
			<?php endif; ?>

			<?php if (!empty($settings['icon']['value'])) : ?>
				<span class="icon"><?php Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?></span>
			<?php else: ?>
				<div class="icon-container open">
					<span class="icon-closed">
						<?php if (!empty($settings['closed_icon']['value'])) : ?>
							<?php Icons_Manager::render_icon($settings['closed_icon'], ['aria-hidden' => 'true']); ?>
						<?php else : ?>
							<i class="fa-solid fa-plus"></i>
						<?php endif; ?>
					</span>
				
					<span class="icon-open">
						<?php if (!empty($settings['open_icon']['value']))  : ?>
							<?php Icons_Manager::render_icon($settings['open_icon'], ['aria-hidden' => 'true']); ?>
						<?php else : ?>
							<i class="fa-solid fa-minus"></i>
						<?php endif; ?>
					</span>
				</div>
			<?php endif; ?>

			<?php if ( $settings['line'] === 'on' && $settings['content_align'] == 'start' ) : ?>
				<div class="line"></div>
			<?php endif; ?>
        </div>
		
		<?php 
	}

}
