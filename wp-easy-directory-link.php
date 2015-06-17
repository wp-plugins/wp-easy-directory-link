<?php
/**
 * Main plugin file
 *
 * @link              http://www.barrahome.org/proyectos/
 * @since             1.0.0
 * @package           wp-easy-directory-link
 *
 * @wordpress-plugin
 * Plugin Name:       WP Easy Directory Link
 * Plugin URI:        https://wordpress.org/plugins/wp-easy-directory-link/
 * Description:       Simple plugin to make a directory link listing
 * Version:           1.2
 * Author:            Alberto Ferrer
 * Author URI:        http://www.barraohme.org
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

/**
 * Load plugin functions.
 *
 * @since 1.2
 */
require_once( dirname(__FILE__) . '/wp-easy-directory-link_functions.php' );

// We enable the link manager.
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

// Languages
add_action( 'plugins_loaded', 'wp_easy_directory_link_languages' );

// We Init the plugin
add_action( 'init', 'wp_edl_init');
