<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.5.2
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */

add_action( 'tgmpa_register', 'cl_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function cl_register_required_plugins() {
	$plugins = array(
		array(
			'name'                     => esc_html__('Elementor Page Builder'), // The plugin name
		   	'slug'                     => 'elementor', // The plugin slug (typically the folder name)
		   	'required'                 => true, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'                     => esc_html__('SVG Support'), // The plugin name
		   	'slug'                     => 'svg-support', // The plugin slug (typically the folder name)
		   	'required'                 => false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'                     => esc_html__('Classic Editor'), // The plugin name
		   	'slug'                     => 'classic-editor', // The plugin slug (typically the folder name)
		   	'required'                 => false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'                     => esc_html__('Redirection'), // The plugin name
		   	'slug'                     => 'redirection', // The plugin slug (typically the folder name)
		   	'required'                 => false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'                     => esc_html__('Fluent SMTP'), // The plugin name
		   	'slug'                     => 'fluent-smtp', // The plugin slug (typically the folder name)
		   	'required'                 => false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'                     => esc_html__('CMS Tree Page View'), // The plugin name
		   	'slug'                     => 'cms-tree-page-view', // The plugin slug (typically the folder name)
		   	'required'                 => false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'                     => esc_html__('WPForms'), // The plugin name
		   	'slug'                     => 'wpforms-lite', // The plugin slug (typically the folder name)
		   	'required'                 => false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'                     => esc_html__('WPForms Datatbase Addon'), // The plugin name
			'slug'                     => 'database-for-wpforms', // The plugin slug (typically the folder name)
			'required'                 => false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'                     => esc_html__('Yoast SEO'), // The plugin name
			'slug'                     => 'wordpress-seo', // The plugin slug (typically the folder name)
			'required'                 => false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'                     => esc_html__('Wordfence'), // The plugin name
			'slug'                     => 'wordfence', // The plugin slug (typically the folder name)
			'required'                 => false, // If false, the plugin is only 'recommended' instead of required
		),
	);
	$config = array(
		'default_path' => '', // Default absolute path to pre-packaged plugins.
		'menu' => 'tgmpa-install-plugins', // Menu slug.
		'has_notices' => true, // Show admin notices or not.
		'dismissable' => true, // If false, a user cannot dismiss the nag message.
		'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false, // Automatically activate plugins after installation or not.
		'message' => '', // Message to output right before the plugins table.
		'strings' => array(
		'page_title' => esc_html__( 'Install Required Plugins' ),
		'menu_title' => esc_html__( 'Install Plugins' ),
		'installing' => esc_html__( 'Installing Plugin: %s' ), // %s = plugin name.
		'oops' => esc_html__( 'Something went wrong with the plugin API.' ),
		'notice_can_install_required' => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
		'notice_can_install_recommended' => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
		'notice_cannot_install' => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
		'notice_can_activate_required' => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
		'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.'), // %1$s = plugin name(s).
		'notice_cannot_activate' => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
		'notice_ask_to_update' => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
		'notice_cannot_update' => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.'), // %1$s = plugin name(s).
		'install_link' => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
		'activate_link' => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
		'return' => esc_html__( 'Return to Required Plugins Installer'),
		'plugin_activated' => esc_html__( 'Plugin activated successfully.' ),
		'complete' => esc_html__( 'All plugins installed and activated successfully. %s' ), // %s = dashboard link.
		'nag_type' => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		)
	);
   tgmpa( $plugins, $config );
}