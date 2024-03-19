<?php
/**
 * Plugin Name: Elementor Scheme Class Issue
 * 
 * 1) Create wp-content/mu-plugins folder
 * 2) Create php file (name doesn't matter)
 * 3) Copy/Paste
 **/

namespace Elementor;

\add_action(
  'plugins_loaded',
  function() {
    if ( ! class_exists( 'Elementor\Scheme_Color' ) ) {
      class Scheme_Color extends Core\Schemes\Color {}
    }
  }
);

\add_action(
  'plugins_loaded',
  function() {
    if ( ! class_exists( 'Elementor\Scheme_Typography' ) ) {
      class Scheme_Typography extends Core\Schemes\Typography {}
    }
  }
);