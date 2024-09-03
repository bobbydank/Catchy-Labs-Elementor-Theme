<?php

namespace CL\Elementor\Theme\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * Class Menu
 * @package CL\Elementor\Widgets
 */
class Sitemap extends Widget_Base {

	/**
	 * Get widget name.
	 **
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return CL_ELEMENTOR_PREFIX . '-sitemap';
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
		return __( 'Sitemap', 'cl-elementor' );
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
		return 'eicon-sitemap';
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

		// Styling post title
        $this->start_controls_section(
            'section_styling_post_title',
            [
                'label' => __( 'Colors', 'cl-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'primary_color',
            [
                'label' => __( 'First Level Color', 'cl-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} #sitemapNav ul li a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

		$this->add_control(
            'primary_hover',
            [
                'label' => __( 'First Level Hover Color', 'cl-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} #sitemapNav ul li a:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

		$this->add_control(
            'primary_text_color',
            [
                'label' => __( 'First Level Text', 'cl-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} #sitemapNav ul li a, {{WRAPPER}} #sitemapNav > ul > li > a:link:after, {{WRAPPER}} #sitemapNav > ul > li > a:visited:after' => 'color: {{VALUE}};',
                ],
            ]
        );

		$this->add_control(
            'primary_text_hover',
            [
                'label' => __( 'First Level Text Hover', 'cl-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} #sitemapNav ul li a:hover, {{WRAPPER}} #sitemapNav > ul > li:hover > a:link:after, {{WRAPPER}} #sitemapNav > ul > li:hover > a:visited:after' => 'color: {{VALUE}};',
                ],
            ]
        );

		$this->add_control(
            'secondary_color',
            [
                'label' => __( 'Second Level Color', 'cl-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} #sitemapNav ul ul li a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

		$this->add_control(
            'secondary_hover',
            [
                'label' => __( 'Second Level Hover Color', 'cl-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} #sitemapNav ul ul li a:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

		$this->add_control(
            'secondary_text_color',
            [
                'label' => __( 'Second Level Text', 'cl-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} #sitemapNav ul ul li a, {{WRAPPER}} #sitemapNav ul ul > li > a:link:after, {{WRAPPER}} #sitemapNav ul ul > li > a:visited:after' => 'color: {{VALUE}};',
                ],
            ]
        );

		$this->add_control(
            'secondary_text_hover',
            [
                'label' => __( 'Second Level Text Color', 'cl-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} #sitemapNav ul ul li a:hover, {{WRAPPER}} #sitemapNav ul ul > li:hover > a:link:after, {{WRAPPER}} #sitemapNav ul ul > li:hover > a:visited:after' => 'color: {{VALUE}};',
                ],
            ]
        );

		$this->add_control(
            'third_color',
            [
                'label' => __( 'Third Level Color', 'cl-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} #sitemapNav ul ul ul li a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

		$this->add_control(
            'third_hover',
            [
                'label' => __( 'Third Level Hover Color', 'cl-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} #sitemapNav ul ul ul li a:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

		$this->add_control(
            'third_text_color',
            [
                'label' => __( 'Third Level Color', 'cl-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} #sitemapNav ul ul ul li a' => 'color: {{VALUE}};',
                ],
            ]
        );

		$this->add_control(
            'third_text_hover',
            [
                'label' => __( 'Third Level Hover Color', 'cl-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} #sitemapNav ul ul ul li a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'secondary_line_color',
            [
                'label' => __( 'Secondary Line Color', 'cl-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} #sitemapNav ul:before, {{WRAPPER}} #sitemapNav ul:after, {{WRAPPER}} #sitemapNav ul li:before, {{WRAPPER}} #sitemapNav ul li:after' => 'border-color: {{VALUE}};',
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
        ?>
        
        <nav id="sitemapNav">
            <ul id="sitemap"><?php echo wp_list_pages('title_li=&child_of=0&depth=6&echo=0') ?></ul>
        </nav>

		<?php
	}

}
