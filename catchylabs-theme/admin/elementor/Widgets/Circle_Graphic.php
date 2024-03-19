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
class Circle_Graphic extends Widget_Base {
    /**
	 * Get widget name.
	 **
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'cl-circle-graphic';
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
		return __( 'Circle Graphic', 'cl-elementor' );
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
		return 'eicon-dot-circle-o';
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
      'main_content',
      [
        'label' => __( 'Main Content', 'cl-elementor' ),
        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'main_title', [
        'label' => __( 'Main Title', 'plugin-domain' ),
        'type' => Controls_Manager::TEXTAREA,
        'default' => __( '' , 'plugin-domain' ),
        'label_block' => true,
      ]
    );

    $this->add_control(
			'circle_image',
			[
				'label' => __( 'Choose Image', 'plugin-domain' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

    $this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => [ 'custom' ],
				'include' => [],
				'default' => 'large',
			]
		);

    $this->end_controls_section();

    $this->start_controls_section(
      'content_one_section',
      [
        'label' => __( 'Content One', 'cl-elementor' ),
        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'title_one', [
        'label' => __( 'Title 1', 'plugin-domain' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __( '' , 'plugin-domain' ),
        'label_block' => true,
      ]
    );

    $this->add_control(
      'content_one',
      [
        'label' => __( 'Content 1', 'plugin-domain' ),
        'type' => Controls_Manager::WYSIWYG,
        'default' => __( 'Default description', 'plugin-domain' ),
        'placeholder' => __( 'Type your description here', 'plugin-domain' ),
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'content_two_section',
      [
        'label' => __( 'Content Two', 'cl-elementor' ),
        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'title_two', [
        'label' => __( 'Title 2', 'plugin-domain' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __( '' , 'plugin-domain' ),
        'label_block' => true,
      ]
    );

    $this->add_control(
      'content_two',
      [
        'label' => __( 'Content 2', 'plugin-domain' ),
        'type' => Controls_Manager::WYSIWYG,
        'default' => __( 'Default description', 'plugin-domain' ),
        'placeholder' => __( 'Type your description here', 'plugin-domain' ),
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'content_three_section',
      [
        'label' => __( 'Content Three', 'cl-elementor' ),
        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'title_three', [
        'label' => __( 'Title 3', 'plugin-domain' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __( '' , 'plugin-domain' ),
        'label_block' => true,
      ]
    );

    $this->add_control(
      'content_three',
      [
        'label' => __( 'Content 3', 'plugin-domain' ),
        'type' => Controls_Manager::WYSIWYG,
        'default' => __( 'Default description', 'plugin-domain' ),
        'placeholder' => __( 'Type your description here', 'plugin-domain' ),
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
    $count = 0;

		$classes  = '';

    $image_alt = get_post_meta( $settings['circle_image']['id'], '_wp_attachment_image_alt', TRUE );
		$img = wp_get_attachment_image_src( $settings['circle_image']['id'], $settings['thumbnail_size']);
?>

<div class="b3-circle-graphic">
  <div class="b3-cg-right">
    <div class="inside">
      <span class="three"></span>
      <a href="#" class="one"></a>
      <a href="#" class="two"></a>
      <a href="#" class="three"></a>
      <img src="<?php echo $img[0] ?>" alt="<?php echo $image_alt ?>" class="circle-graphic" />
    </div>
  </div>
  <div class="b3-cg-left">
    <h3><?php echo $settings['main_title'] ?></h3>
    <div class="content">
      <div class="one">
        <p class="title"><?php echo $settings['title_one'] ?></p>
        <?php echo $settings['content_one'] ?>
      </div>
      <div class="two">
        <p class="title"><?php echo $settings['title_two'] ?></p>
        <?php echo $settings['content_two'] ?>
      </div>
      <div class="active three">
        <p class="title"><?php echo $settings['title_three'] ?></p>
        <?php echo $settings['content_three'] ?>
      </div>
    </div>
  </div>

</div>

<?php
        //echo '<pre>'.print_r($img, true).'</pre>';
    }
}
