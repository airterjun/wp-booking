<?php
/*
Plugin Name: Surf Booking
Plugin URI:  http://matapurusa.com
Description: Plugin to book surf training
Version:     1.0
Author:      Edy Saputra
Author URI:  http://matapurusa.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// Abort loading if WordPress is upgrading
if ( defined( 'WP_INSTALLING' ) && WP_INSTALLING ) {
	return;
}


define('PLUGIN_PATH_DIR', plugin_dir_path( __FILE__ ));

require_once PLUGIN_PATH_DIR . 'function/functions.php';
