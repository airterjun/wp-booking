<?php

/**
 * Created by PhpStorm.
 * User: macbookpro
 * Date: 8/5/16
 * Time: 10:33 PM
 */
if (!defined('ABSPATH')) {
	exit;
}


class GoSurfCPT
{

	public $resultPage = 'booking';

	public function init()
	{

		add_action('init', array($this, 'register_post_types'));

	}

	public function register_post_types()
	{

		register_post_type( 'lesson',
			array(
				'label' 				=> __('Surf Lesson'),
				'public' 				=> true,
				'show_ui' 				=> true,
				'capability_type' 		=> 'post',
				'menu_position' 		=> 5,
				'map_meta_cap'			=> true,
				'publicly_queryable' 	=> true,
				'exclude_from_search' 	=> false,
				'hierarchical' 			=> false, // Hierarchical causes memory issues - WP loads all records!
				'query_var' 			=> true,
				'has_archive'           => false,
				'supports' 				=> array( 'title','thumbnail','editor'),
				'show_in_nav_menus' 	=> true
			)
		);

		register_post_type( 'tours',
			array(
				'label' 				=> __('Surf Tours'),
				'public' 				=> true,
				'show_ui' 				=> true,
				'capability_type' 		=> 'post',
				'menu_position' 		=> 5,
				'map_meta_cap'			=> true,
				'publicly_queryable' 	=> true,
				'exclude_from_search' 	=> false,
				'hierarchical' 			=> false, // Hierarchical causes memory issues - WP loads all records!
				'query_var' 			=> true,
				'has_archive'           => false,
				'supports' 				=> array( 'title','thumbnail','editor'),
				'show_in_nav_menus' 	=> true
			)
		);

		register_post_type( 'board',
			array(
				'label' 				=> __('Board Rental'),
				'public' 				=> true,
				'show_ui' 				=> true,
				'capability_type' 		=> 'post',
				'menu_position' 		=> 5,
				'map_meta_cap'			=> true,
				'publicly_queryable' 	=> true,
				'exclude_from_search' 	=> false,
				'hierarchical' 			=> false, // Hierarchical causes memory issues - WP loads all records!
				'query_var' 			=> true,
				'has_archive'           => false,
				'supports' 				=> array( 'title','thumbnail','editor'),
				'show_in_nav_menus' 	=> true
			)
		);
	}
}

function gsCPT(){

	$gs = new GoSurfCPT();

	$gs->init();
	
	return $gs;
}

$GLOBALS['gosurf'] = gsCPT();
