<?php
/**
 * The template for displaying the header
 *
 * This is the template that displays all of the <head> section, opens the <body> tag and adds the site's header.
 *
 * @package CL\Elementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$extraClass='';
if (wp_is_mobile()) {
	$extraClass .= ' mobile';
}

$description = get_bloginfo('description');
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php $viewport_content = apply_filters( 'cl_elementor_viewport_content', 'width=device-width, initial-scale=1' ); ?>
	<meta name="viewport" content="<?php echo esc_attr( $viewport_content ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php get_template_part( 'templates/head' ); ?>
	<title><?php wp_title('', 'echo', 'right'); ?><?php echo empty($description) ? '' : ' | '.$description; ?></title>
    <?php 
		wp_head(); 
		$pt = intval(cl_elementor_get_theme_option('header_main_padding'));
		if ( cl_elementor_get_theme_option('header_fixed') === 'on' && $pt > 0) {
			echo '<style type="text/css">main {padding-top:'.$pt.'px;}</style>';
		}
		echo cl_elementor_get_theme_option('head_tags');
		if (isset($post)) {
			echo cl_elementor_get_meta('page_specific_tags', $post->ID);
		}
	?>
</head>
<body <?php body_class($extraClass); ?>>
	<?php 
		wp_body_open(); 
		echo cl_elementor_get_theme_option('openbody_tags');
	?>

	<a class="screen-reader-text" href="#main">Skip to content</a>

	<div id="full-menu">
		<div class="full-menu-container full-menu-right">
			<div class="close">
				<i class="fa-solid fa-circle-xmark"></i>
			</div>
			<?php wp_nav_menu( array( 'theme_location' => 'full-menu', 'container_class' => 'mobile-menu' ) ); ?>
		</div>
	</div>

	<?php
	if ( ! function_exists( 'cl_elementor_do_location' ) || ! cl_elementor_do_location( 'header' ) ) {
		get_template_part( 'templates/header' );
	}
	?>


