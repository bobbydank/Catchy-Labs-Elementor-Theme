<?php
/**
 * The template for displaying header.
 *
 * CL\Elementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$template_id = cl_elementor_get_header_id();

if ( is_singular( 'cl_header_footer' ) && $template_id > 0 ) {
	return;
}

$site_name   = get_bloginfo( 'name' );
$tagline     = get_bloginfo( 'description', 'display' );
$fixed = cl_elementor_get_theme_option('header_fixed');
$absolute = cl_elementor_get_theme_option('header_absolute');

?>

<header id="masthead" class="<?php echo is_front_page() ? 'home' : ''; ?> <?php echo ($fixed === 'on') ? 'fixed' : ''; ?> <?php echo ($absolute === 'on') ? 'absolute' : ''; ?>">
	<?php if ( $template_id == -1 ) : ?>
		<div class="default-header">
			<div class="logo">
				<a href="<?php bloginfo('url'); ?>">
					<?php 
					$img = cl_elementor_get_theme_option('header_logo'); 

					if ( !empty($img) ) : 
						$width = intval( cl_elementor_get_theme_option('header_logo_width') ); ?>
						<img src="<?php echo $img ?>" class="logo" title="<?php echo $site_name; ?> | <?php echo $tagline; ?>" style="max-width:<?php echo $width; ?>em;" />
					<?php else: ?>
						<?php echo $site_name ?>
					<?php endif; ?>
				</a>
			</div>
			<div class="nav">
				<div id="cl-hamburger">
					<span></span><span></span><span></span><span></span><span></span><span></span>
				</div>
				<svg version="1.1" class="hamburger-blob" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 137.5 137.9" xml:space="preserve">
					<path style="fill:<?php echo cl_elementor_get_theme_option('theme_color'); ?>" class="st0" d="M127.6,20.2c12.3,15.4,12.2,40.7,4.6,60.4c-7.6,19.7-22.9,33.6-41.6,44.1s-41,17.5-56.6,10.2c-15.6-7.4-24.5-29-29.8-51.6C-1.2,60.6-2.9,36.9,8,21.9S42.3,0.5,66.4,0S115.2,4.9,127.6,20.2z"/>
				</svg>
			</div>
		</div>
	<?php else : ?>
		<?php cl_elementor_the_content( $template_id ); ?>
	<?php endif; ?>
</header>

