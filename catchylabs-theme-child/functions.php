<?php
/**
 *
 * @package Catchy Labs Elementor Theme
 * @author  Catchy Labs Elementor Theme <catchylabs.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * 
 */

function clet_child_scripts() {
    wp_enqueue_style( 'clet-child-style', get_stylesheet_uri(), array(), time(), false);
}
add_action( 'wp_enqueue_scripts', 'clet_child_scripts', 9999 );

