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
            <ul id="sitemap"><?php wp_list_pages('title_li=&child_of=0&depth=6&echo=0') ?></ul>
        </nav>

		<?php
	}

}
