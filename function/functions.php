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
	$bookStep->session = $bookStep->generate_session_key(true);
	$_SESSION['clinet_session_id'] = $bookStep->session;


	if (isset($_POST['step_home'])) {

		get_step_one_form();

	}


	if( isset($_GET['step']) == 2 && isset($_POST['post_step_two'])){

		get_step_two();

	}


	if( isset($_GET['step']) == 3 && isset($_POST['post_step_three'])){

		get_step_three();

	}


	if( isset($_GET['step']) == 'final' && isset($_POST['confirm_step'])){

		$_SESSION['step_final_query'] = $_POST;

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

function get_step_one_form()
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

	?>

	<div>Search Criteria : <?php echo $_POST['type'] ?></div>
	<div>Adult : <?php echo $_POST['step_two']['adult']['name'] ?> | <?php echo $_POST['step_two']['adult']['skill'] ?></div>
	<div>Child : <?php echo $_POST['step_two']['child']['name'] ?> | <?php echo $_POST['step_two']['child']['skill'] ?></div>
	<div>Date : <?php echo $_POST['step_two']['date']['day'] ?> | <?php echo $_POST['step_two']['date']['time'] ?></div>
	<div>Duration : <?php echo $_POST['step_two']['duration'] ?></div>
	<div>Borad : <?php echo $_POST['step_two']['borad'] ?></div>

	<form method="POST" action="?step=3">
		<div>
			<label>INDIVIDUAL ACTIVITIES Child</label>
			<input type="radio" name="step_three[activity][child]" value="Activity 1">
		</div>

		<div>
			<label>INDIVIDUAL ACTIVITIES Child</label>
			<input type="radio" name="step_three[activity][adult]" value="Activity adult 1"> Adult 1
			<input type="radio" name="step_three[activity][adult]" value="Activity adult 2"> Adult 2
		</div>
		<div>
			<input type="submit" value="Submit" name="post_step_three">
		</div>
	</form>

	<?php
}

function get_step_three(){
	$_SESSION['step_three_query'] = $_POST;
	var_dump($_SESSION);

	form_client_data();

}