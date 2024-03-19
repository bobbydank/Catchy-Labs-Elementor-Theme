<?php
/**
 * The template for displaying footer.
 *
 * CL\Elementor
 */

namespace CL\Elementor\Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$template_id = cl_elementor_get_footer_id();

if ( is_singular( 'cl_header_footer' ) && $template_id > 0 ) {
	return;
}

$fixed = cl_elementor_get_theme_option('footer_fixed');

?>
<footer id="colophon" role="contentinfo" class="<?php echo ($fixed === 'on') ? 'fixed' : ''; ?>">
	<?php if ( $template_id == -1 ) : ?>
		<div class="default-footer">
			<div class="copyright">
				<?php 
				$copyright = cl_elementor_get_theme_option('footer_copyright');
				if ( empty( $copyright ) ) {
					$copyright = get_bloginfo('name');
				}
				?>
				<p>&copy; <?php echo date('Y'); ?> <?php echo $copyright; ?> </p>
			</div>
			<div class="social">
				<ul>
					<?php foreach (Utils::get_social_channels() as $social) : 
						$socialUrl = cl_elementor_get_theme_option('social_'.$social);
						if ( !empty($socialUrl) ) : ?>
						<li>
							<a href="<?php echo $socialUrl; ?>" title="<?php echo ucfirst($social); ?>" target="_blank">
								<?php echo Utils::get_social_icon($social); ?>
							</a>
						</li>
						<?php 
						endif;
					endforeach; ?>
				</ul>
			</div>
		</div>
	<?php else : ?>
		<?php cl_elementor_the_content( $template_id ); ?>
	<?php endif; ?>
</footer>
