<?php
/**
 * The template for displaying Header Footer Content Type.
 *
 * CL\Elementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! is_user_logged_in() ) {
	wp_redirect('/');
}

while ( have_posts() ) : 
	the_post();
	the_content();
endwhile;

?>