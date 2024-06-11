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
function cl_planck_button($atts) {
	$vars = shortcode_atts( array(
    'whiteIcons' => 0,
    'url'        => '#',
    'title'      => 'Contact Us',
    'target'     => '_self',
    'shadowbox'  => '',
    'white'      => 0,
    'align'      => 'left'
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

  <span class="planck-button <?php echo $vars['align']; ?> <?php if ($vars['whiteIcons']) : echo 'white-icons'; endif; ?> <?php if ($vars['white']) : echo 'white-icons'; endif; ?>">
    <a class="<?php if ($vars['white']) : echo 'white'; endif; ?>"
			 href="<?php echo esc_url($vars['url']); ?>"
			 title="<?php echo esc_attr($vars['title']); ?>"
			 target="<?php echo esc_attr($vars['target']); ?>"
			 <?php echo esc_attr($shadowbox); ?>
    >
      <div class="title">
        <?php echo esc_attr($vars['title']); ?>
      </div>
      <div class="arrow">
        <i class="fa-solid fa-angle-right"></i>
      </div>
    </a>
  </span>

  <?php
  $html = ob_get_contents();
  ob_end_clean();
  return $html;
}
add_shortcode('planck-button', 'cl_planck_button');

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
