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
class Submenu extends Widget_Base {

	/**
	 * Get widget name.
	 **
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return CL_ELEMENTOR_PREFIX . '-submenu';
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
		return __( 'Submenu', 'cl-elementor' );
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
		return 'eicon-nav-menu';
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
			'nav_target',
			[
				'label' => __( 'Parent target:', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'self',
				'options' => [
					'self'  => __( 'Self', 'plugin-domain' ),
					'parent' => __( 'Parent', 'plugin-domain' ),
					'top' => __( 'Top Level', 'plugin-domain' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Styles', 'cl-elementor' ),
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
				'selector' => '{{WRAPPER}} .cl-submenu',
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => __( 'Text color', 'cl-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'std'       => '#fff',
				'selectors' => [
					'{{WRAPPER}} .cl-submenu li a' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .cl-submenu' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .cl-submenu' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'spacing',
			[
				'label'          => __( 'Menu Spacing', 'elementor' ),
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
					'{{WRAPPER}} .cl-submenu li' => 'padding-right: {{SIZE}}{{UNIT}};',
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
				'{{WRAPPER}} .cl-submenu ul' => 'text-align: {{VALUE}};',
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
				'center'  => [
					'title' => __( 'Center', 'elementor' ),
					'icon'  => 'eicon-text-align-center',
				],
				'right' => [
					'title' => __( 'Right', 'elementor' ),
					'icon'  => 'eicon-text-align-right',
				],
			],
			'selectors' => [
				'{{WRAPPER}} .cl-submenu ul' => 'text-align: {{VALUE}};',
			],
		] );

		$this->add_responsive_control(
			'padding',
			[
				'label'      => __( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%', 'rem' ],
				'selectors'  => [
					'{{WRAPPER}} .cl-submenu ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __( 'Border', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .cl-submenu ul',
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
		global $post;

		$settings = $this->get_settings_for_display();

		$choice = $settings['nav_target'];

		switch ($choice) {
			case 'self';
				$current_page = $post->ID;
			break;
			case 'parent':
				$current_page = $post->post_parent;
			break;
			case 'top':
				$ancestors = $post->ancestors;
				$current_page = end($ancestors);
			break;
		}

		if (!empty($choice)) :
			$args = array(
		    'post_type' => 'page',
		    'post_parent' => $current_page,
		    'orderby' => 'menu_order',
		    'order'   => 'ASC',
		  );
		  $query = new \WP_Query( $args );

			if ( $query->have_posts() ) :
			?>

			<div class="cl-submenu clearfix">
				<ul>
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<li class="<?php echo (get_the_ID() == $current_page) ? "active" : ""; ?>">
						<a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</li>
				<?php endwhile; ?>
				</ul>
			</div>

			<?php
			endif;
			wp_reset_postdata();
		endif;
	}

}
