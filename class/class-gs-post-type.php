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
		add_action('init', 'product_category', 0); //add_action(‘init’,’function_callback’, priority);

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
				'show_in_nav_menus' 	=> true,
				'taxonomies'          	=> array( 'prod-category' ),
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
				'show_in_nav_menus' 	=> true,
				'taxonomies'          => array( 'prod-category' ),
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
				'show_in_nav_menus' 	=> true,
				'taxonomies'          => array( 'prod-category' ),
			)
		);
	}
}

 function product_category()
{
	register_taxonomy('prod-category', array('product'), array(
		'hierarchical' => true,
		'labels' => array(
			'name' => _x('Product Category', 'taxonomy general name'),
			'singular_name' => _x('Product-Category', 'taxonomy singular name'),
			'search_items' => __('Search Product-Categories'),
			'all_items' => __('All Product-Categories'),
			'parent_item' => __('Parent Product-Category'),
			'parent_item_colon' => __('Parent Product-Category:'),
			'edit_item' => __('Edit Product-Category'),
			'update_item' => __('Update Product-Category'),
			'add_new_item' => __('Add New Product-Category'),
			'new_item_name' => __('New Product-Category Name'),
			'menu_name' => __('Product Categories'),
		),

		'query_var' => true,

		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'catalogue',
			'with_front' => false,
			'hierarchical' => true 
		),
	));
}


function gsCPT(){

	$gs = new GoSurfCPT();

	$gs->init();
	
	return $gs;
}

$GLOBALS['gosurf'] = gsCPT();
