<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://purecharity.com
 * @since             1.0.0
 * @package           Purecharity_Wp_Donations
 *
 * @wordpress-plugin
 * Plugin Name:       Pure Charity Donations Plugin 
 * Plugin URI:        http://github.com/purecharity/pure-donations
 * Description:       Plugin for showing a general donation page
 * Version:           1.0
 * Author:            / Pure Charity
 * Author URI:        http://purecharity.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       purecharity-wp-donations
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/activator.class.php';

/**
 * The code that runs during plugin deactivation.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/deactivator.class.php';

/** This action is documented in includes/purecharity-wp-donations-activator.class.php */
register_activation_hook( __FILE__, array( 'Purecharity_Wp_Donations_Activator', 'activate' ) );

/** This action is documented in includes/purecharity-wp-donations-deactivator.class.php */
register_deactivation_hook( __FILE__, array( 'Purecharity_Wp_Donations_Deactivator', 'deactivate' ) );

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/purecharity-wp-donations.class.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_purecharity_wp_donations() {

	$plugin = new Purecharity_Wp_Donations();
	$plugin->run();

}
run_purecharity_wp_donations();
register_activation_hook( __FILE__, array( 'Purecharity_Wp_Donations', 'activation_check' ) );
