<?php

namespace CL\Elementor\Theme\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

/**
 * Class Menu
 * @package CL\Elementor\Widgets
 */
class Popup_Gallery extends Widget_Base {

	/**
	 * Get widget name.
	 **
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return CL_ELEMENTOR_PREFIX . '-popup-gallery';
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
		return __( 'Popup Gallery', 'cl-elementor' );
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
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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
			'header_tag',
			[
				'label' => __( 'HTML Tag', 'indutri-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h2',
			]
		);

        $this->add_control(
			'gallery',
			[
				'label' => esc_html__( 'Add Images', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'show_label' => false,
				'default' => [],
			]
		);

		$this->add_control(
			'hover_effect',
			[
				'label' => __( 'Hover Effect', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'your-plugin' ),
				'label_off' => __( 'No', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'no',
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

		$classes .= ('yes' === $settings['hover_effect']) ? ' hover-effect' : '';
		$header_tag = $settings['header_tag'];
   		$header_tag = empty($header_tag) ? 'p' : $header_tag;

		$gallery = $settings['gallery'];
		?>

        <div class="cl-popup-gallery <?php echo $classes; ?>">
			<?php for ( $x = 0; $x < count($gallery); $x++ ) : ?>
				<a href="<?php echo esc_url( $gallery[$x]['url'] ); ?>" class="custom-magnific-popup" <?php echo ($x == 0) ? 'data-mfp-src="'.$gallery[1]['url'].'"' : ''; ?>>
					<img src="<?php echo esc_url( $gallery[$x]['url'] ); ?>" alt="<?php echo esc_attr( $gallery[$x]['id'] ); ?>">
					<?php if ('yes' === $settings['hover_effect']) : ?>
						<div class="hover"><i class="fa-solid fa-share"></i></div>
					<?php endif; ?>
				</a>
            <?php endfor; ?>
        </div>
		<?php if ($settings['title']) : ?>
			<<?php echo esc_attr($header_tag) ?> class="popup-gallery-title">
				<?php echo $settings['title'] ?>
			</<?php echo esc_attr($header_tag) ?>>
		<?php endif; ?>

        <?php
	}

}