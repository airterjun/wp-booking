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



add_action('admin_init', 'install_go_surf');

function install_go_surf(){

	$go = new GoSurf();

}


add_action('init', 'get_result_step_one');


function get_result_step_one(){

	global $bookStep;

	if( isset($_POST['step_home']) ){

		$bookStep->session = $bookStep->generate_session_key(true);

		$_SESSION['clinet_session_id'] = $bookStep->session;

		get_step_one_form();

	}

}

function crete_gs_shortcode(){

	return form_book();

}

add_shortcode('go_surf_booking', 'crete_gs_shortcode');



/*
 * Render form steping
 */

function get_step_one_form(){


	if( isset( $_POST['surfing_activities'] )){

		if( $_POST['surfing_activities'][0] == 'surf-lessons-tours'){

			?>

			Lessons & Tours Specifications<br/>
			
			<div><label>Duration</label> : <select>
					<?php for($i = 1; $i<= 3;$i++) {?>
					<option value="<?php echo $i ?>"><?php echo $i ?> Day</option>
					<?php }?>
				</select></div>

			<?php

		}

	}


}