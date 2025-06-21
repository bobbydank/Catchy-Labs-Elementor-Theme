<?php
/**
 * The site's entry point.
 *
 * Loads the relevant template part,
 * the loop is executed (when needed) by the relevant template part.
 *
 * CL\Elementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/*
 *
 */
function cl_button($atts) {
	$vars = shortcode_atts( array(
    'url'        => '#',
    'title'      => 'Contact Us',
    'target'     => '_self',
    'white'      => 0,
    'id'         => 'scroll-btn',
    'align'      => 'left',
    'icon'       => 'fa-arrow-right'
 	), $atts );

  $shadowbox = '';
  $target = $vars['target'];
  if (!empty($vars['shadowbox'])) {
    if (wp_is_mobile()) {
      $target="_blank";
    } else {
      $shadowbox = 'rel="shadowbox;'.$vars['shadowbox'].'"';
    }
  }

  ob_start(); ?>

  <div class="button-container <?php echo esc_attr($vars['align']); ?>">
    <a 
      href="<?php echo esc_url($vars['url']); ?>"
			title="<?php echo esc_attr($vars['title']); ?>"
			target="<?php echo esc_attr($vars['target']); ?>" 
      class="cl-button <?php if ($vars['white']) : echo 'white'; endif; ?> show" 
      id="<?php echo esc_attr($vars['id']); ?>"
    >
      <div>
        <?php echo esc_attr($vars['title']); ?> <i class="fa-solid <?php echo esc_attr($vars['icon']) ?>"></i>
      </div>
    </a>
  </div>

  <?php
  $html = ob_get_contents();
  ob_end_clean();
  return $html;
}
add_shortcode('cl-button', 'cl_button');

/*
 *
 */
function cl_more_btn($atts) {
    $vars = shortcode_atts( array(
		'css_classes' => '',
		'link'        => '#',
        'text'        => 'More',
        'mb'          => 25
	), $atts );

    $btn_markup = '';

    //if ($acf_link_field):
        $btn_markup .= '<p style="margin-bottom:'.$vars['mb'].'px"><a class="btn '.$vars['css_classes'].'" href="'.$vars['link'].'">';
            $btn_markup .= $vars['text'].' <i class="fas fa-arrow-down fa-lg"></i>';
        $btn_markup .= '</a></p>';
    //endif;

    return $btn_markup;
}
add_shortcode( 'more_btn', 'cl_more_btn' );