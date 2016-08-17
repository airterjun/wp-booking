<?php
/**
 * Created by PhpStorm.
 * User: macbookpro
 * Date: 8/5/16
 * Time: 9:17 PM
 */

require_once PLUGIN_PATH_DIR . '/class/class-GoSurf.php';
require_once PLUGIN_PATH_DIR . '/class/class-gs-post-type.php';
require_once PLUGIN_PATH_DIR . '/class/class-gs-booking-action.php';


require_once PLUGIN_PATH_DIR . '/function/function-forms.php';
require_once PLUGIN_PATH_DIR . '/function/function-scripts.php';


add_action('admin_init', 'install_go_surf');

function install_go_surf()
{

	$go = new GoSurf();

}




add_action('init', 'get_result_step_one');
add_action('init', 'set_session_client',1);


function set_session_client(){

	if( !session_id() ){

		session_start();
	}

}

function get_result_step_one()
{

	global $bookStep;
	global $wpdb;

	$bookStep->session = $bookStep->generate_session_key(true);
	$_SESSION['clinet_session_id'] = $bookStep->session;

	if (isset($_POST['step_home'])) {

		get_step_one();

	}


	if( isset($_GET['step']) == 2 && isset($_POST['post_step_two'])){

		get_step_two();

	}


	if( isset($_GET['step']) == 3 && isset($_POST['post_step_three'])){

		get_step_three();

	}


	if( isset($_GET['step']) == 'final' && isset($_POST['confirm_step'])){

		$_SESSION['step_final_query'] = $_POST;
		//var_dump($_POST);die;

		$table_session = $wpdb->prefix . 'go_surf_session';
		$table_client = $wpdb->prefix . 'go_surf_client_data';
		$table_order = $wpdb->prefix . 'go_surf_order_item';

		$wpdb->insert( 
			$table_session, 
			array( 
			  	'session_key' => $_SESSION['clinet_session_id'],
			  	'session_value' => serialize($_SESSION),
			  	'session_expiry' => 200,
			) 
		);
		$session_id = $wpdb->insert_id;

		$wpdb->insert( 
			$table_client, 
			array( 
			  	'client_name' => $_POST['title']." ".$_POST['fullname'],
			  	'client_email' => $_POST['email'],
			  	'client_phone' => $_POST['mobile'],
			  	'client_hotel' => $_POST['hotel'],
			  	'client_hotel_address' => $_POST['hoteladdress'],
			  	'client_name_in_hotel' => $_POST['bookinghotel'],
			  	'client_arrival' => $_POST['arrival'],
			  	'client_country' => $_POST['country'],
			  	'client_nationality' => $_POST['nationality'],
			  	'client_message' => $_POST['note'],
			) 
		);	

		$client_id = $wpdb->insert_id;	

		$wpdb->insert( 
			$table_order, 
			array( 
			  	'client_id' => $client_id,
			  	'session_id' => $session_id,
			  	'order_status' => 'pending',
			) 
		);

		get_step_final();

	}

}

function crete_gs_shortcode()
{
	return form_book();
}

add_shortcode('go_surf_booking', 'crete_gs_shortcode');


/*
 * Render form steping
 */

function get_step_one()
{


	if (isset($_POST['surfing_activities'])) {

		if ($_POST['surfing_activities'][0] == 'surf-lessons-tours') {



		}

	}
	$_SESSION['step_one_query'] = $_POST;


	add_filter('the_content', 'form_step_two', 20);




}


function get_step_two(){


	$_SESSION['step_two_query'] = $_POST;

	/*
	 * Hook form into the_content()
	 */
	add_filter('the_content', 'form_step_three', 20);

//	form_step_three();
}

function get_step_three(){
	$_SESSION['step_three_query'] = $_POST;
	add_filter('the_content', 'form_client_data', 20);

//	form_client_data();

}

function get_step_final(){
	add_filter('the_content', 'final_data', 20);

//	final_data();

}