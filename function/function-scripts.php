<?php
/**
 * Created by PhpStorm.
 * User: macbookpro
 * Date: 8/5/16
 * Time: 11:12 PM
 */
function wpdocs_theme_name_scripts() {
	wp_enqueue_style( 'gos-surf-style', PLUGIN_BASE_URL . '/assets/css/go-style.css' );
	
	if ( ! wp_script_is( 'jquery', 'enqueued' )) {
		wp_enqueue_script( 'jquery' );
	}
	wp_enqueue_script('gos-surf-script', PLUGIN_BASE_URL . '/assets/js/gs-script.js');
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );
add_action('admin_print_styles-post.php', 'wpdocs_theme_name_scripts');
add_action('admin_print_styles-post-new.php', 'wpdocs_theme_name_scripts');