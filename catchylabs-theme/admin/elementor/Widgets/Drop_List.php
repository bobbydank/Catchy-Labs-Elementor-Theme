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
class Drop_List extends Widget_Base {
    /**
	 * Get widget name.
	 **
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'cl-drop-list';
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
		return __( 'Drop List', 'cl-elementor' );
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
		return 'eicon-post-list';
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

    //https://developers.elementor.com/elementor-controls/repeater-control/
    $repeater = new \Elementor\Repeater();

    //creates the media control
    //https://developers.elementor.com/elementor-controls/media-control/

    $repeater->add_control(
      'title', [
        'label' => __( 'Title', 'plugin-domain' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __( '' , 'plugin-domain' ),
        'label_block' => true,
      ]
    );

		$repeater->add_control(
      'content',
      [
        'label' => __( 'Content', 'plugin-domain' ),
        'type' => Controls_Manager::WYSIWYG,
        'default' => __( 'Default description', 'plugin-domain' ),
        'placeholder' => __( 'Type your description here', 'plugin-domain' ),
      ]
    );

    $this->add_control(
      'list',
      [
        'label' => __( 'Drop List', 'plugin-domain' ),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $repeater->get_controls(),
        'default' => [
          [
            'title' => __( 'Title #1', 'plugin-domain' ),
          ],
          [
            'title' => __( 'Title #2', 'plugin-domain' ),
          ],
        ],
        'title_field' => '{{{ title }}}',
      ]
    );

		$this->add_control(
			'list_style',
			[
				'label' => esc_html__( 'List Style', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'ol',
				'options' => [
					'ol' => esc_html__( 'Ordered', 'plugin-name' ),
					'ul' => esc_html__( 'Unordered', 'plugin-name' ),
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
    $count = 0;

?>

<div class="b3-drop-list">
	<<?php echo $settings['list_style'] ?>>
		<?php foreach ( $settings['list'] as $item ) : ?>
			<li class="<?php echo !$count ? 'active' : '' ?>">
				<p class="list-title">
					<?php echo $item['title'] ?>
				</p>
				<div class="content">
					<?php echo $item['content'] ?>
				</div>
				<span class="dl-plus"></span>
			</li>
		<?php $count++; endforeach; ?>
	</<?php echo $settings['list_style'] ?>>
</div>

<?php
        //echo '<pre>'.print_r($img, true).'</pre>';
    }
}
