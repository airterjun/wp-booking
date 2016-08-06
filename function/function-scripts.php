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
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );