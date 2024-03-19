<?php
namespace CL\Elementor\Theme\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Utils;

/**
 * Class Menu
 * @package CL\Elementor\Widgets
 */
class Image_Title_Hover extends Widget_Base {
    /**
	 * Get widget name.
	 **
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'cl-image-title-hover';
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
		return __( 'Image/Title Hover', 'cl-elementor' );
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
		return 'eicon-image-rollover';
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
      'content',
      [
        'label' => __( 'Content', 'cl-elementor' ),
        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'plugin-domain' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
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
      'sub_title', [
        'label' => __( 'Sub Title', 'plugin-domain' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( '' , 'plugin-domain' ),
        'label_block' => true,
      ]
    );

		$this->add_control(
			'show_title',
			[
				'label' => __( 'Show Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'website_link',
			[
				'label' => __( 'Link', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'plugin-domain' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
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

		$image_alt = get_post_meta( $settings['image']['id'], '_wp_attachment_image_alt', TRUE );
		$img = wp_get_attachment_image_src( $settings['image']['id'], $settings['thumbnail_size']);

		$url = $settings['website_link'];
		$target = ($url['is_external']) ? 'target="_blank"' : '';
		$nofollow = ($url['is_external']) ? '' : 'rel="nofollow"';
		//print_r($url);
?>

<?php if ($url) : ?>
<a class="cl-image-title-hover" href="<?php echo $url['url'] ?>" <?php echo $target ?> <?php echo $nofollow ?>>
<?php else : ?>
<div class="cl-image-title-hover">
<?php endif; ?>

	<img src="<?php echo $img[0]; ?>" alt="<?php echo $item['title'] ?>" class="b3-slider-image" />
	<div class="image-hover <?php echo ( 'yes' === $settings['show_title'] ) ? 'title-on' : ''; ?>">
			<p class="title"><?php echo $settings['title'] ?></p>
			<p class="sub-title"><?php echo $settings['sub_title'] ?></p>
	</div>

<?php if ($url) : ?>
</a>
<?php else : ?>
</div>
<?php endif; ?>

<?php
        //echo '<pre>'.print_r($img, true).'</pre>';
    }
}
