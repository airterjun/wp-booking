<?php
/**
 * Created by PhpStorm.
 * User: macbookpro
 * Date: 8/5/16
 * Time: 11:03 PM
 */

function form_book()
{

	global $gosurf;

	$form = '<div id="go-surf-home-form" class="go-surf-container">
				<div class="go-surf-home-form">
					<form id="homesearch" method="POST" action="' . esc_url(get_bloginfo('home')) . '/booking">
					<div class="homefilter">
						<div class="gs-top-form gs-set-flex">
							<div class="rowform gs-flex-auto">
								<div class="select-style">
									<select id="standard-dropdown" name="surfing_activities" required="">
										<option value="" class="test-class-1">Select Surf Activity</option>
										<option value="surf-lessons-tours" class="test-class-1">Surf Lessons &amp; Tours</option>
										<option value="surf-lessons">Surf Lessons</option>
										<option value="surf-tours">Surf Tours</option>
										<option value="surf-board-rental">Surf Board Rental</option>
									</select>
								</div>
							</div>
							<div class="rowform gs-flex-auto">
								<div class="select-style"><select id="standard-dropdown1" name="adult" required="">
										<option value="0">ADULT</option>
										<option value="1">1 Adult</option>
										<option value="2">2 Adults</option>
										<option value="3">3 Adults</option>
										<option value="4">4 Adults</option>
										<option value="5">5 Adults</option>
										<option value="6">6 Adults</option>
										<option value="7">7 Adults</option>
										<option value="8">8 Adults</option>
										<option value="9">9 Adults</option>
										<option value="10">10 Adults</option>
									</select></div>
							</div>
							<div class="rowform gs-flex-auto">
								<div class="select-style"><select id="standard-dropdown2" name="child" required="">
										<option value="0">CHILDREN</option>
										<option value="1">1 Child</option>
										<option value="2">2 Childs</option>
										<option value="3">3 Childs</option>
										<option value="4">4 Childs</option>
										<option value="5">5 Childs</option>
										<option value="6">6 Childs</option>
										<option value="7">7 Childs</option>
										<option value="8">8 Childs</option>
										<option value="9">9 Childs</option>
										<option value="10">10 Childs</option>
									</select></div>
							</div>
							<div class="rowform gs-flex-auto">
								<input type="text" name="reservation_date" class="datepicker" value=""
							                            placeholder="RESERVATION DATE" required=""
							                            class=""></div>
							<div class="rowform gs-flex-auto">
								<div class="select-style"><select id="standard-dropdown3" name="duration" required="">
										<option value="">DURATION</option>
										<option value="1">1 Day</option>
										<option value="2">2 Days</option>
										<option value="3">3 Days</option>
									</select></div>
							</div>
							<div class="rowform gs-flex-auto">
								<div class="srcbtn" id="srcbtn"></div>
								<input type="submit" name="step_home">
								<input name="action" type="hidden" value="stephome">
								</div>
						</div>
					</div>
				</div>
			</div>
		</form>';


	return $form;


}


function form_step_two()
{
	$surfing_activities = $_SESSION['step_one_query']['surfing_activities'];
	$duration = $_SESSION['step_one_query']['duration'];
	?>
	<div class="go-surf-container step-two">
		<form method="POST" action="?step=2">
			<h2 class="gs-h2">Lessons & Tours Specifications</h2>

			<div class="gs-row-float gs-line-up-divider">
				<label>Surfing Activities</label>
				<div class="gs-set-flex select-activity">
					<div class="activity">
						<input type="checkbox" name="surfing_activities[]" value="Surf Lessons" id="surf-lessons"
							<?php if (($surfing_activities == 'surf-lessons-tours') || ($surfing_activities == 'surf-lessons')) { ?>
								checked="checked"
							<?php } ?>> Surf Lessons
					</div>
					<div class="activity">
						<input type="checkbox" name="surfing_activities[]" value="Surf Tours" id="surf-tours"
							<?php if (($surfing_activities == 'surf-lessons-tours') || ($surfing_activities == 'surf-tours')) { ?>
								checked="checked"
							<?php } ?>> Surf Tours
					</div>
					<div class="activity">
						<input type="checkbox" name="surfing_activities[]" value="Surf Board Rental"
						       id="surf-board-rental"
							<?php if ($surfing_activities == 'surf-board-rental') { ?>
								checked="checked"
							<?php } ?>> Surf Board Rental
					</div>
				</div>
			</div>

			<div class="gs-row-float gs-line-up-divider gs-set-flex">
				<div class="duration-container durations gs-items-left-col">
					<label class="gs-row-float">Duration</label>
					<select class="lesson-duration" name="duration">
						<?php for ($i = 1; $i <= 3; $i++) { ?>
							<option value="<?php echo $i ?>"
								<?php if ($i == $duration) { ?>
									selected="selected"
								<?php } ?> ><?php echo $i ?> Day
							</option>
						<?php } ?>
					</select>
				</div>
				<div class="duration-container reservations-day gs-items-right-col">
					<?php for ($i = 1; $i <= $duration; $i++) { ?>
						<div class="day-select gs-row-float gs-items">
							<label class="gs-row-float">Reservation Day <?php echo $i; ?></label>
							<input type="text" name="reservation_date[]" class="datepicker"
							       value="<?php echo $_SESSION['step_one_query']['reservation_date'] ?>"
							       placeholder="RESERVATION DATE" required="">
						</div>
					<?php } ?>
				</div>
			</div>

			<div class="personal-information gs-row-float gs-line-up-divider">
				<h2>Personal Information</h2>
				<article>
					Please insert names and surf proficiency level.
					If you take Intermediate Lesson/ Surf Tour, you must to fill up the surf abilities form.<br/>
					The form is available on the next personal information page.
				</article>
			</div>

			<div class="personal-information-input gs-row-float gs-set-flex gs-line-up-divide--lighter">

				<div class="select-adult-num gs-items-left-col">
					<label class="gs-row-float">Adult</label>
					<select id="adult-participant" name="adult[number]">
						<?php for ($i = 0; $i <= 10; $i++) { ?>
							<option value="<?php echo $i ?>"
								<?php if ($i == $_SESSION['step_one_query']['adult']) { ?>
									selected="selected"
								<?php } ?>
							><?php echo $i ?></option>
						<?php } ?>
					</select>
					<input type="hidden" id="count_adult" value="<?php echo $_SESSION['step_one_query']['adult'] ?>">
				</div>

				<div class="adults-container adult-detail gs-items-right-col">
					<div class="gs-row-float">
						<label class="gs-row-float">Detail</label>
						<?php if ($_SESSION['step_one_query']['adult'] > 0) { ?>

							<?php for ($a = 1; $a <= $_SESSION['step_one_query']['adult']; $a++) { ?>
								<div class="gs-set-flex adult-input-detail gs-row-float">
									<input placeholder="Name..." type="text"
									       name="adult[participant][<?php echo $a - 1 ?>][name]">
									<select name="adult[participant][<?php echo $a - 1 ?>][skill]">
										<option value="beginner">Beginner</option>
										<option value="intermediate">Intermediate</option>
									</select>
								</div>
							<?php } ?>

						<?php } ?>
					</div>
				</div>
			</div>

			<div class="gs-row-float gs-set-flex gs-line-up-divide--lighter">
				<div class="select-adult-num gs-items-left-col">
					<label class="gs-row-float">Children</label>
					<select id="child-participant" name="child[number]">
						<?php for ($i = 0; $i <= 10; $i++) { ?>
							<option value="<?php echo $i ?>"
								<?php if ($i == $_SESSION['step_one_query']['child']) { ?>
									selected="selected"
								<?php } ?>
							><?php echo $i ?></option>
						<?php } ?>
					</select>
					<input type="hidden" id="count_child" value="<?php echo $_SESSION['step_one_query']['child'] ?>">
				</div>

				<div class="children-container gs-row-float gs-items-right-col">
					<label class="gs-row-float">Detail</label>
					<?php if ($_SESSION['step_one_query']['child'] > 0) { ?>

						<?php for ($c = 1; $c <= $_SESSION['step_one_query']['child']; $c++) { ?>
							<div class="gs-row-float gs-set-flex gs-items">
								<input placeholder="Name..." type="text"
								       name="child[participant][<?php echo $c - 1 ?>][name]">
								<select name="child[participant][<?php echo $c - 1 ?>][age]">
									<?php for ($j = 7; $j <= 15; $j++) { ?>
										<option value="<?php echo $j ?>"><?php echo $j ?> Years</option>
									<?php } ?>
								</select>
								<select name="child[participant][<?php echo $c - 1 ?>][skill]">
									<option value="beginner">Beginner</option>
									<option value="intermediate">Intermediate</option>
								</select>
							</div>
						<?php } ?>

					<?php } ?>
				</div>
			</div>

			<div class="board-rental-wrapper">

			</div>

			<div class="gs-row-float gs-line-up-divider">
				<input type="submit" value="Submit" name="post_step_two">
				<input type="hidden" value="<?php echo $_POST['surfing_activities'][0]; ?>" name="step_two[type]">
			</div>

		</form>
	</div>
	<?php

}

function form_step_three()
{
	$data = $_SESSION['step_two_query'];
	$counter = 1;
	//var_dump($data);
	?>
	<div class="go-surf-container gs-row-float step-three">
		<div>
			<h2 class="gs-h2">Search Criteria</h2>
			<?php
			foreach ($data['surfing_activities'] as $key => $value) {
				echo $value;
				if ($value != end($data['surfing_activities'])) {
					echo ", ";
				} else {
					echo " | ";
				}
			}
			foreach ($data['reservation_date'] as $index => $date) {
				echo $date . " | ";
			}
			echo $data['duration'] . " Day(s) | " . $data['adult']['number'] . " Adult(s) | " . $data['child']['number'] . " Children";


			?>
		</div>

		<div class="gs-row-float gs-line-up-divide--lighter">
			<h2 class="gs-h2">Surf Proficiency Level</h2>
			<ul class="gs-list">
				<?php
				if ($data['adult']['number'] > 0) {
					foreach ($data['adult']['participant'] as $key => $value) {
						?>
						<li><?php echo $value['name'] . " | " . $value['skill'] ?></li>
						<?php
					}
				}

				if ($data['child']['number'] > 0) {
					foreach ($data['child']['participant'] as $key => $value) {
						?>
						<li><?php echo $value['name'] . " | " . $value['skill'] ?></li>
						<?php
					}
				}
				?>
			</ul>
		</div>

		<?php if (isset($data['board_rental'])) { ?>
			<div class="gs-row-float gs-line-up-divide--lighter">
				Board Rental :
				<?php
				echo $data['board_rental']['date'] . " | " . $data['board_rental']['time'] . " | " . $data['board_rental']['duration'] . " | " . $data['board_rental']['number'] . " Board(s)";
				?>
			</div>
		<?php } ?>

		<?php
		$_SESSION['currency'] = 'USD';
		$url = 'http://apilayer.net/api/live?access_key=7ae0be955998c26acd958eddd45322f0&currencies=IDR,USD,AUD,SGD,JPY,EUR&format=1';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		?>
		<div class="curency-option gs-row-float gs-line-up-divide--lighter">
			<select id="currency-option">
				<option value="IDR_<?php echo $result['quotes']['USDIDR'] ?>">IDR</option>
				<option value="EUR_<?php echo $result['quotes']['USDEUR'] ?>">EUR</option>
				<option selected value="USD_<?php echo $result['quotes']['USDUSD'] ?>">USD</option>
				<option value="AUD_<?php echo $result['quotes']['USDAUD'] ?>">AUD</option>
				<option value="SGD_<?php echo $result['quotes']['USDSGD'] ?>">SGD</option>
				<option value="JPY_<?php echo $result['quotes']['USDJPY'] ?>">JPY</option>
			</select>
		</div>

		<form method="POST" action="?step=3">
			<input type="hidden" name="currency" value="USD" id="currency">
			<input type="hidden" name="convertion_value" value="" id="convertion-value">
			<?php
			//available surf package for individual activity (adult)
			if ($data['adult']['number'] > 0) {
				foreach ($data['adult']['participant'] as $key => $value) {
					?>
					<div class="resultbox gs-row-float gs-line-up-divide--lighter">
						<div class="boxtitle">INDIVIDUAL ACTIVITIES :
							<span class=""><?php echo $value['name'] ?></span>
						</div>
						<?php
						//If surfing tour true & Sklill = intermediate
						if ((in_array("Surf Tours", $data['surfing_activities'])) && ($value['skill'] == 'intermediate')) {
							get_cpt_data($counter++, $value['name'], -1, 'tours', '');
						}
						if ($value['skill'] == 'intermediate') { // if skill intermediate
							get_cpt_data($counter++, $value['name'], -1, 'lesson', 'lesson_intermediate');
						}
						if ($value['skill'] == 'beginner') { // if skill beginner & age >= 15 y.o
							get_cpt_data($counter++, $value['name'], -1, 'lesson', 'lesson_group');
							get_cpt_data($counter++, $value['name'], -1, 'lesson', 'lesson_private');
						}
						?>
					</div>
					<?php
				}
			}
			//available surf package for individual activity (child)
			if ($data['child']['number'] > 0) {
				foreach ($data['child']['participant'] as $key => $value) {
					?>
					<div class="resultbox">
						<div class="boxtitle">INDIVIDUAL ACTIVITIES :
							<span class=""><?php echo $value['name'] ?></span>
						</div>
						<?php
						//If surfing tour true & Sklill = intermediate
						if ((in_array("Surf Tours", $data['surfing_activities'])) && ($value['skill'] == 'intermediate')) {
							get_cpt_data($counter++, $value['name'], -1, 'tours', '');
						}
						if ($value['skill'] == 'intermediate') { // if skill intermediate
							get_cpt_data($counter++, $value['name'], -1, 'lesson', 'lesson_intermediate');
						}
						if (($value['skill'] == 'beginner') && ($value['age'] >= 15)) { // if skill beginner & age >= 15 y.o
							get_cpt_data($counter++, $value['name'], -1, 'lesson', 'lesson_group');
							get_cpt_data($counter++, $value['name'], -1, 'lesson', 'lesson_private');
						}
						if ($value['age'] < 15) { //age < 15 y.o
							get_cpt_data($counter++, $value['name'], -1, 'lesson', 'lesson_kids_private');
						}
						?>
					</div>
					<?php
				}
			}
			//available surf package for peers activity (adult)
			if ($data['adult']['number'] > 0) {
				$doubleAdult = [];
				foreach ($data['adult']['participant'] as $index => $adult) {
					foreach ($data['adult']['participant'] as $key => $value) {
						if (($index != $key) && ($value['skill'] == 'beginner') && ($adult['skill'] == 'beginner')) {
							if ((!in_array($index . "-" . $key, $doubleAdult)) || (!in_array($key . "-" . $index, $doubleAdult))) {
								array_push($doubleAdult, $index . "-" . $key);
								array_push($doubleAdult, $key . "-" . $index);
								$participant = $adult['name'] . "_" . $value['name'];


								?>
								<div class="resultbox">
									<div class="boxtitle">ACTIVITIES WITH PEERS :
										<span class=""><?php echo $adult['name'] ?></span>
										<span class=""><?php echo $value['name'] ?></span>
									</div>
									<?php get_cpt_data($counter++, $participant, -1, 'lesson', 'lesson_semi_private'); ?>
								</div>
								<?php
							}
						}
					}
				}
			}

			//available surf package for peers activity (child)
			if ($data['child']['number'] > 0) {
				$doubleChild = [];
				foreach ($data['child']['participant'] as $index => $child) {
					foreach ($data['child']['participant'] as $key => $value) {
						if (($index != $key)
							&& ($value['skill'] == 'beginner')
							&& ($child['skill'] == 'beginner')
							&& ($value['age'] >= 10)
							&& ($child['age'] >= 10)
						) {
							if ((!in_array($index . "-" . $key, $doubleChild)) || (!in_array($key . "-" . $index, $doubleChild))) {
								array_push($doubleChild, $index . "-" . $key);
								array_push($doubleChild, $key . "-" . $index);
								$participant = $child['name'] . "_" . $value['name'];

								?>
								<div class="resultbox">
									<div class="boxtitle">ACTIVITIES WITH PEERS :
										<span class=""><?php echo $child['name'] ?></span>
										<span class=""><?php echo $value['name'] ?></span>
									</div>
									<?php get_cpt_data($counter++, $participant, -1, 'lesson', 'lesson_kids_semi_private'); ?>
								</div>
								<?php
							}
						}
					}
				}
			}

			//available surf package for peers activity (adult & child)
			if (($data['child']['number'] > 0) && ($data['adult']['number'] > 0)) {
				foreach ($data['child']['participant'] as $index => $child) {
					foreach ($data['adult']['participant'] as $key => $adult) {
						if (($adult['skill'] == 'beginner')
							&& ($child['skill'] == 'beginner')
							&& ($child['age'] >= 10)
						) {
							$participant = $child['name'] . "_" . $adult['name'];

							?>
							<div class="resultbox">
								<div class="boxtitle">ACTIVITIES WITH PEERS :
									<span class=""><?php echo $adult['name'] ?></span>
									<span class=""><?php echo $child['name'] ?></span>
								</div>
								<?php get_cpt_data($counter++, $participant, -1, 'lesson', 'lesson_semi_private'); ?>
							</div>
							<?php
						}
					}
				}
			}
			?>

			<br/>

			<?php
			if (isset($data['board_rental'])) {
				$surf_boards = new WP_Query(
					array(
						'posts_per_page' => -1,
						'post_type' => 'board',
						'post_status' => 'publish'
					)
				);

				for ($i = 1; $i <= $data['board_rental']['number']; $i++) {
					?>
					<div class="sb-box">
						<div class="sbbox-title">
							SURF BOARD <?php echo $i ?>
						</div>
						<?php
						foreach ($surf_boards->posts as $key => $post) {
							?>
							<div class="sbbox-info">
								<div class="sbbox-info-left">
									<img width="150" height="150"
									     src="<?php echo get_the_post_thumbnail_url($post->ID) ?>">
								</div>
								<div class="sbbox-info-right">
									<div class="sbbox-info-title"><?php echo $post->post_title ?></div>
									<div class="sbbox-info-desc"><?php echo $post->post_content ?></div>
									<div class="sbbox-info-schedule">
										<span>Duration : <?php echo $data['board_rental']['duration'] ?> </span>
										<span>Date : <?php echo $data['board_rental']['date'] ?> </span>
										<span>Time : <?php echo $data['board_rental']['time'] ?> </span>
									</div>
									<div class="sbbox-info-price">
										<?php $get_lesson_attr = get_post_meta($post->ID, '__lesson_post_attr', $single = true); ?>
										<span id="sbprice-info<?php echo $i ?>" class="surfboard-price"
										      data-price="<?php echo $get_lesson_attr[$data['board_rental']['duration']] ?>">
											Price : <?php echo $get_lesson_attr[$data['board_rental']['duration']] ?>
											USD
										</span>	
										<span>
											BOOK 
											<input name="surf_boards[<?php echo $i ?>]" type="radio"
											       id="chosen-board"
											       value="<?php echo $get_lesson_attr[$data['board_rental']['duration']] . "_ID" . $post->ID ?>"/>
										</span>
									</div>
								</div>
							</div>
							<br/>
							<?php
						}
						?>
					</div>
					<?php
				}
			}
			?>
			<div class="gs-row-float gs-line-up-divide--lighter">
				<input type="submit" value="Submit" name="post_step_three">
			</div>

		</form>
	</div>
	<?php
}

function get_cpt_data($index, $participant, $post_per_page, $post_type, $category)
{

	$query = new WP_Query(
		array(
			'posts_per_page' => $post_per_page,
			'post_type' => $post_type,
			'post_status' => 'publish',
			'meta_query' => array(
				array(
					'key' => '__lesson_post_attr',
					'value' => 's:' . strlen($category) . ':"' . $category . '"',
					'compare' => 'LIKE',
				)
			)
		)
	);

	foreach ($query->posts as $key => $value) {
		$post_meta = get_post_meta($value->ID, '__lesson_post_attr', $single = true);
		cpt_template($index, $participant, $value, $post_meta);
	}
}

function cpt_template($index, $participant, $post_data, $post_meta)
{
	?>

	<div class="infosbox gs-row-float">
		<div class="infosbox-left">
			<img width="150" height="150" src="<?php echo get_the_post_thumbnail_url($post_data->ID) ?>" class=""/>
		</div>
		<div class="infosbox-right">
			<div class="infosbox-top-left">
				<div class="infosbox-title"><?php echo $post_data->post_title ?></div>
				<div class="infosbox-desc"><?php echo $post_data->post_content ?></div>
			</div>
			<div class="">
				<div class="">
					PRICE/PERSON
					<?php
					if (isset($post_meta['price'])) {
						?>
						<span id="price-info<?php echo $index ?>" class="package-price"
						      data-price="<?php echo $post_meta['price'] ?>"><?php echo $post_meta['price'] ?></span>
						<?php
						$participant = $participant . "_" . $post_meta['price'];
					}
					?>
				</div>
				<div class="">BOOK
					<input name="surf_package[<?php echo $participant ?>]" type="checkbox"
					       id="chosen-package<?php echo $index ?>" value="<?php echo $post_data->ID ?>"/>
				</div>
			</div>
		</div>
	</div>
	<?php
}

function form_client_data()
{
	?>
	<div class="go-surf-container step-final gs-row-float">
		<form id="bookstep" method="post" action="?step=final">
			<div class="column1 gs-set-wrap-flex">
				<div class="bookrow gs-row-float gs-items gs-flex-2-col">
					<div class="leftcol">Full Booking Name (*)</div>
					<div class="rightcol gs-set-flex">
						<div class="linecol">
							<div class="book-select-style ftitle"><select id="title" name="title">
									<option value="Mr">Mr</option>
									<option value="Ms">Ms</option>
									<option value="Mrs">Mrs</option>
									<option value="Miss">Miss</option>
									<option value="Mdm">Mdm</option>
									<option value="Dr">Dr</option>
									<option value="Prof">Prof</option>
								</select></div>
						</div>
						<div class="linecol">
							<input name="fullname" type="text" class="required tooltipstered" value="">
						</div>
					</div>
				</div>
				<div class="bookrow gs-row-float gs-items gs-flex-2-col">
					<div class="leftcol">Email (*)</div>
					<div class="rightcol">
						<div class="linecol">
							<input name="email" type="text"
							       class="emailrequired fulllength tooltipstered"
							       value="">
						</div>
					</div>
				</div>
				<div class="bookrow gs-row-float gs-items gs-flex-2-col">
					<div class="leftcol">Mobile Phone</div>
					<div class="rightcol">
						<div class="linecol"><input name="mobile" type="text" class="fulllength tooltipstered" value="">
						</div>
					</div>
				</div>
				<div class="bookrow gs-row-float gs-items gs-flex-2-col">
					<div class="leftcol">Hotel</div>
					<div class="rightcol">
						<div class="linecol"><input name="hotel" type="text" class="fulllength tooltipstered" value="">
						</div>
					</div>
				</div>
				<div class="bookrow gs-row-float gs-items gs-flex-2-col">
					<div class="leftcol">Hotel Address</div>
					<div class="rightcol">
						<div class="linecol"><input name="hoteladdress" type="text" class="fulllength tooltipstered"
						                            value=""></div>
					</div>
				</div>
				<div class="bookrow gs-row-float gs-items gs-flex-2-col">
					<div class="leftcol">Booking Name in the Hotel</div>
					<div class="rightcol">
						<div class="linecol"><input name="bookinghotel" type="text" class="fulllength tooltipstered"
						                            value=""></div>
					</div>
				</div>
				<div class="bookrow gs-row-float gs-items gs-flex-2-col">
					<div class="leftcol">Date of Arrival</div>
					<div class="rightcol">
						<div class="linecol"><input name="arrival" type="text"
						                            class="date fulllength tooltipstered hasDatepicker" value=""
						                            id="dp1470440173019"></div>
					</div>
				</div>
			</div>

			<div class="column2 gs-set-wrap-flex gs-line-up-divide--lighter">
				<div class="bookrow gs-row-float gs-items gs-flex-2-col">
					<div class="leftcol">Country</div>
					<div class="rightcol">
						<div class="linecol">
							<div class="book-select-style"><select id="country" name="country">
									<option value="">Select Country</option>
									<option value="USA">USA</option>
									<option value="Australia">Australia</option>
									<option value="Germany">Germany</option>
									<option value="Netherlands">Netherlands</option>
									<option value="South Korea">South Korea</option>
									<option value="Singapore">Singapore</option>
									<option value="Malaysia">Malaysia</option>
									<option value="Japan">Japan</option>
									<option value="Indonesia">Indonesia</option>
									<option value="China">China</option>
									<option value="">=================</option>
									<option value="Afghanistan">Afghanistan</option>
									<option value="Albania">Albania</option>
									<option value="Algeria">Algeria</option>
									<option value="American Samoa">American Samoa</option>
									<option value="Andorra">Andorra</option>
									<option value="Angola">Angola</option>
									<option value="Anguilla">Anguilla</option>
									<option value="Antarctica">Antarctica</option>
									<option value="Antigua and Barbuda">Antigua and Barbuda</option>
									<option value="Argentina">Argentina</option>
									<option value="Armenia">Armenia</option>
									<option value="Arctic Ocean">Arctic Ocean</option>
									<option value="Aruba">Aruba</option>
									<option value="Ashmore and Cartier Islands">Ashmore and Cartier Islands</option>
									<option value="Atlantic Ocean">Atlantic Ocean</option>
									<option value="Australia">Australia</option>
									<option value="Austria">Austria</option>
									<option value="Azerbaijan">Azerbaijan</option>
									<option value="Bahamas">Bahamas</option>
									<option value="Bahrain">Bahrain</option>
									<option value="Baker Island">Baker Island</option>
									<option value="Bangladesh">Bangladesh</option>
									<option value="Barbados">Barbados</option>
									<option value="Bassas da India">Bassas da India</option>
									<option value="Belarus">Belarus</option>
									<option value="Belgium">Belgium</option>
									<option value="Belize">Belize</option>
									<option value="Benin">Benin</option>
									<option value="Bermuda">Bermuda</option>
									<option value="Bhutan">Bhutan</option>
									<option value="Bolivia">Bolivia</option>
									<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
									<option value="Botswana">Botswana</option>
									<option value="Bouvet Island">Bouvet Island</option>
									<option value="Brazil">Brazil</option>
									<option value="British Virgin Islands">British Virgin Islands</option>
									<option value="Brunei">Brunei</option>
									<option value="Bulgaria">Bulgaria</option>
									<option value="Burkina Faso">Burkina Faso</option>
									<option value="Burundi">Burundi</option>
									<option value="Cambodia">Cambodia</option>
									<option value="Cameroon">Cameroon</option>
									<option value="Canada">Canada</option>
									<option value="Cape Verde">Cape Verde</option>
									<option value="Cayman Islands">Cayman Islands</option>
									<option value="Central African Republic">Central African Republic</option>
									<option value="Chad">Chad</option>
									<option value="Chile">Chile</option>
									<option value="China">China</option>
									<option value="Christmas Island">Christmas Island</option>
									<option value="Clipperton Island">Clipperton Island</option>
									<option value="Cocos Islands">Cocos Islands</option>
									<option value="Colombia">Colombia</option>
									<option value="Comoros">Comoros</option>
									<option value="Cook Islands">Cook Islands</option>
									<option value="Coral Sea Islands">Coral Sea Islands</option>
									<option value="Costa Rica">Costa Rica</option>
									<option value="Cote d'Ivoire">Cote d'Ivoire</option>
									<option value="Croatia">Croatia</option>
									<option value="Cuba">Cuba</option>
									<option value="Cyprus">Cyprus</option>
									<option value="Czech Republic">Czech Republic</option>
									<option value="Denmark">Denmark</option>
									<option value="Democratic Republic of the Congo">Democratic Republic of the Congo
									</option>
									<option value="Djibouti">Djibouti</option>
									<option value="Dominica">Dominica</option>
									<option value="Dominican Republic">Dominican Republic</option>
									<option value="East Timor">East Timor</option>
									<option value="Ecuador">Ecuador</option>
									<option value="Egypt">Egypt</option>
									<option value="El Salvador">El Salvador</option>
									<option value="Equatorial Guinea">Equatorial Guinea</option>
									<option value="Eritrea">Eritrea</option>
									<option value="Estonia">Estonia</option>
									<option value="Ethiopia">Ethiopia</option>
									<option value="Europa Island">Europa Island</option>
									<option value="Falkland Islands (Islas Malvinas)">Falkland Islands (Islas Malvinas)
									</option>
									<option value="Faroe Islands">Faroe Islands</option>
									<option value="Fiji">Fiji</option>
									<option value="Finland">Finland</option>
									<option value="France">France</option>
									<option value="French Guiana">French Guiana</option>
									<option value="French Polynesia">French Polynesia</option>
									<option value="French Southern and Antarctic Lands">French Southern and Antarctic
										Lands
									</option>
									<option value="Gabon">Gabon</option>
									<option value="Gambia">Gambia</option>
									<option value="Gaza Strip">Gaza Strip</option>
									<option value="Georgia">Georgia</option>
									<option value="Germany">Germany</option>
									<option value="Ghana">Ghana</option>
									<option value="Gibraltar">Gibraltar</option>
									<option value="Glorioso Islands">Glorioso Islands</option>
									<option value="Greece">Greece</option>
									<option value="Greenland">Greenland</option>
									<option value="Grenada">Grenada</option>
									<option value="Guadeloupe">Guadeloupe</option>
									<option value="Guam">Guam</option>
									<option value="Guatemala">Guatemala</option>
									<option value="Guernsey">Guernsey</option>
									<option value="Guinea">Guinea</option>
									<option value="Guinea-Bissau">Guinea-Bissau</option>
									<option value="Guyana">Guyana</option>
									<option value="Haiti">Haiti</option>
									<option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands
									</option>
									<option value="Honduras">Honduras</option>
									<option value="Hong Kong">Hong Kong</option>
									<option value="Howland Island">Howland Island</option>
									<option value="Hungary">Hungary</option>
									<option value="Iceland">Iceland</option>
									<option value="India">India</option>
									<option value="Indian Ocean">Indian Ocean</option>
									<option value="Indonesia">Indonesia</option>
									<option value="Iran">Iran</option>
									<option value="Iraq">Iraq</option>
									<option value="Ireland">Ireland</option>
									<option value="Isle of Man">Isle of Man</option>
									<option value="Israel">Israel</option>
									<option value="Italy">Italy</option>
									<option value="Jamaica">Jamaica</option>
									<option value="Jan Mayen">Jan Mayen</option>
									<option value="Japan">Japan</option>
									<option value="Jarvis Island">Jarvis Island</option>
									<option value="Jersey">Jersey</option>
									<option value="Johnston Atoll">Johnston Atoll</option>
									<option value="Jordan">Jordan</option>
									<option value="Juan de Nova Island">Juan de Nova Island</option>
									<option value="Kazakhstan">Kazakhstan</option>
									<option value="Kenya">Kenya</option>
									<option value="Kingman Reef">Kingman Reef</option>
									<option value="Kiribati">Kiribati</option>
									<option value="Kerguelen Archipelago">Kerguelen Archipelago</option>
									<option value="Kosovo">Kosovo</option>
									<option value="Kuwait">Kuwait</option>
									<option value="Kyrgyzstan">Kyrgyzstan</option>
									<option value="Laos">Laos</option>
									<option value="Latvia">Latvia</option>
									<option value="Lebanon">Lebanon</option>
									<option value="Lesotho">Lesotho</option>
									<option value="Liberia">Liberia</option>
									<option value="Libya">Libya</option>
									<option value="Liechtenstein">Liechtenstein</option>
									<option value="Lithuania">Lithuania</option>
									<option value="Luxembourg">Luxembourg</option>
									<option value="Macau">Macau</option>
									<option value="Macedonia">Macedonia</option>
									<option value="Madagascar">Madagascar</option>
									<option value="Malawi">Malawi</option>
									<option value="Malaysia">Malaysia</option>
									<option value="Maldives">Maldives</option>
									<option value="Mali">Mali</option>
									<option value="Malta">Malta</option>
									<option value="Marshall Islands">Marshall Islands</option>
									<option value="Martinique">Martinique</option>
									<option value="Mauritania">Mauritania</option>
									<option value="Mauritius">Mauritius</option>
									<option value="Mayotte">Mayotte</option>
									<option value="Mexico">Mexico</option>
									<option value="Micronesia">Micronesia</option>
									<option value="Midway Islands">Midway Islands</option>
									<option value="Moldova">Moldova</option>
									<option value="Monaco">Monaco</option>
									<option value="Mongolia">Mongolia</option>
									<option value="Montenegro">Montenegro</option>
									<option value="Montserrat">Montserrat</option>
									<option value="Morocco">Morocco</option>
									<option value="Mozambique">Mozambique</option>
									<option value="Myanmar">Myanmar</option>
									<option value="Namibia">Namibia</option>
									<option value="Nauru">Nauru</option>
									<option value="Navassa Island">Navassa Island</option>
									<option value="Nepal">Nepal</option>
									<option value="Netherlands">Netherlands</option>
									<option value="Netherlands Antilles">Netherlands Antilles</option>
									<option value="New Caledonia">New Caledonia</option>
									<option value="New Zealand">New Zealand</option>
									<option value="Nicaragua">Nicaragua</option>
									<option value="Niger">Niger</option>
									<option value="Nigeria">Nigeria</option>
									<option value="Niue">Niue</option>
									<option value="Norfolk Island">Norfolk Island</option>
									<option value="North Korea">North Korea</option>
									<option value="North Sea">North Sea</option>
									<option value="Northern Mariana Islands">Northern Mariana Islands</option>
									<option value="Norway">Norway</option>
									<option value="Oman">Oman</option>
									<option value="Pacific Ocean">Pacific Ocean</option>
									<option value="Pakistan">Pakistan</option>
									<option value="Palau">Palau</option>
									<option value="Palmyra Atoll">Palmyra Atoll</option>
									<option value="Panama">Panama</option>
									<option value="Papua New Guinea">Papua New Guinea</option>
									<option value="Paracel Islands">Paracel Islands</option>
									<option value="Paraguay">Paraguay</option>
									<option value="Peru">Peru</option>
									<option value="Philippines">Philippines</option>
									<option value="Pitcairn Islands">Pitcairn Islands</option>
									<option value="Poland">Poland</option>
									<option value="Portugal">Portugal</option>
									<option value="Puerto Rico">Puerto Rico</option>
									<option value="Qatar">Qatar</option>
									<option value="Reunion">Reunion</option>
									<option value="Republic of the Congo">Republic of the Congo</option>
									<option value="Romania">Romania</option>
									<option value="Russia">Russia</option>
									<option value="Rwanda">Rwanda</option>
									<option value="Saint Helena">Saint Helena</option>
									<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
									<option value="Saint Lucia">Saint Lucia</option>
									<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
									<option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines
									</option>
									<option value="Samoa">Samoa</option>
									<option value="San Marino">San Marino</option>
									<option value="Sao Tome and Principe">Sao Tome and Principe</option>
									<option value="Saudi Arabia">Saudi Arabia</option>
									<option value="Senegal">Senegal</option>
									<option value="Serbia">Serbia</option>
									<option value="Seychelles">Seychelles</option>
									<option value="Sierra Leone">Sierra Leone</option>
									<option value="Singapore">Singapore</option>
									<option value="Slovakia">Slovakia</option>
									<option value="Slovenia">Slovenia</option>
									<option value="Solomon Islands">Solomon Islands</option>
									<option value="Somalia">Somalia</option>
									<option value="South Africa">South Africa</option>
									<option value="South Georgia and the South Sandwich Islands">South Georgia and the
										South
										Sandwich Islands
									</option>
									<option value="South Korea">South Korea</option>
									<option value="Spain">Spain</option>
									<option value="Spratly Islands">Spratly Islands</option>
									<option value="Sri Lanka">Sri Lanka</option>
									<option value="Sudan">Sudan</option>
									<option value="Suriname">Suriname</option>
									<option value="Svalbard">Svalbard</option>
									<option value="Swaziland">Swaziland</option>
									<option value="Sweden">Sweden</option>
									<option value="Switzerland">Switzerland</option>
									<option value="Syria">Syria</option>
									<option value="Taiwan">Taiwan</option>
									<option value="Tajikistan">Tajikistan</option>
									<option value="Tanzania">Tanzania</option>
									<option value="Thailand">Thailand</option>
									<option value="Togo">Togo</option>
									<option value="Tokelau">Tokelau</option>
									<option value="Tonga">Tonga</option>
									<option value="Trinidad and Tobago">Trinidad and Tobago</option>
									<option value="Tromelin Island">Tromelin Island</option>
									<option value="Tunisia">Tunisia</option>
									<option value="Turkey">Turkey</option>
									<option value="Turkmenistan">Turkmenistan</option>
									<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
									<option value="Tuvalu">Tuvalu</option>
									<option value="Uganda">Uganda</option>
									<option value="Ukraine">Ukraine</option>
									<option value="United Arab Emirates">United Arab Emirates</option>
									<option value="United Kingdom">United Kingdom</option>
									<option value="USA">USA</option>
									<option value="Uruguay">Uruguay</option>
									<option value="Uzbekistan">Uzbekistan</option>
									<option value="Vanuatu">Vanuatu</option>
									<option value="Venezuela">Venezuela</option>
									<option value="VietNam">VietNam</option>
									<option value="Virgin Islands">Virgin Islands</option>
									<option value="Wake Island">Wake Island</option>
									<option value="Wallis and Futuna">Wallis and Futuna</option>
									<option value="West Bank">West Bank</option>
									<option value="Western Sahara">Western Sahara</option>
									<option value="Yemen">Yemen</option>
									<option value="Yugoslavia">Yugoslavia</option>
									<option value="Zambia">Zambia</option>
									<option value="Zimbabwe">Zimbabwe</option>
								</select></div>
						</div>
					</div>
				</div>
				<div class="bookrow gs-row-float gs-items gs-flex-2-col">
					<div class="leftcol">Nationality</div>
					<div class="rightcol">
						<div class="linecol"><input name="nationality" type="text" class="fulllength tooltipstered"
						                            value=""></div>
					</div>
				</div>
				<div class="bookrow gs-row-float gs-items gs-flex-2-col"><br> Note (Comments, Request,
					Question)<br><textarea name="note" cols=""
					                       rows=""></textarea></div>
			</div>
			<!--<input name="booktype" id="booktype" type="hidden" value="2" class="tooltipstered">-->
			<div class="submitrow gs-row-float gs-line-up-divide--lighter">
				<input type="submit" value="Confirm" name="confirm_step">
			</div>
		</form>
	</div>
	<?php
}

function final_data()
{
	$data = $_SESSION['step_two_query'];
	$package_board = $_SESSION['step_three_query'];
	$package = $_SESSION['step_three_query']['surf_package'];
	$bookInfo = $_SESSION['step_final_query'];

	//var_dump($_SESSION);
	?>
	<div class="go-surf-container step-three">
	<div class="gs-items">
		<h2 class="gs-h2">Search Criteria</h2>
		<?php
		foreach ($data['surfing_activities'] as $key => $value) {
			echo $value;
			if ($value != end($data['surfing_activities'])) {
				echo ", ";
			} else {
				echo " | ";
			}
		}
		foreach ($data['reservation_date'] as $index => $date) {
			echo $date . " | ";
		}
		echo $data['duration'] . " Day(s) | " . $data['adult']['number'] . " Adult(s) | " . $data['child']['number'] . " Children";

		?>
	</div>
	<?php if (isset($data['board_rental'])) { ?>
	<div class="gs-items">
		<h2 class="gs-h2">Board Rental</h2>
		<?php
		echo $data['board_rental']['date'] . " | " . $data['board_rental']['time'] . " | " . $data['board_rental']['duration'] . " | " . $data['board_rental']['number'] . " Board(s)";
		?>
	</div>
<?php } ?>

	<?php if ($package) : ?>

	<div class="package-summary gs-items">
		<span>SURF PACKAGE</span>
		<?php
		$total = 0;

		foreach ($package as $key => $value) {
			$participant = explode("_", $key);
			$post = get_post($value);
			$total += $participant[count($participant) - 1];
			?>
			<div class="package-box">
				<div class="box-title"> <?php echo $post->post_title ?>
					<?php for ($i = 0; $i < count($participant) - 1; $i++) { ?>
						<span class="participant-name"><?php echo $participant[$i] ?></span>
					<?php } ?>
				</div>

				<div class="box-price">
					Price
					: <?php echo $participant[count($participant) - 1] . " " . $package_board['currency'] ?>
				</div>
			</div>
			<?php
		}
		?>
	</div>

<?php endif; ?>

	<?php
	if (count($package_board['surf_boards'] > 0)) {
		if ($package_board['surf_boards']) :
			?>
			<div class="boards-summary">
				<span>SURF BOARD</span>
				<?php

				foreach ($package_board['surf_boards'] as $i => $value) {
					$sb = explode("_", $value);
					$board_post = get_post(str_replace('ID', '', $sb[1]));
					$total += $sb[0];
					?>
					<div class="sbbox-info">
						<div class="sbbox-info-left">
							<img width="150" height="150"
							     src="<?php echo get_the_post_thumbnail_url($board_post->ID) ?>">
						</div>
						<div class="sbbox-info-right">
							<div class="sbbox-info-title"><?php echo $board_post->post_title ?></div>
							<div class="sbbox-info-desc"><?php echo $board_post->post_content ?></div>
							<div class="sbbox-info-schedule">
								<span>Duration : <?php echo $data['board_rental']['duration'] ?> </span>
								<span>Date : <?php echo $data['board_rental']['date'] ?> </span>
								<span>Time : <?php echo $data['board_rental']['time'] ?> </span>
							</div>
							<div class="sbbox-info-price">
								<span id="" class="">
									Price : <?php echo $sb[0] . " " . $package_board['currency'] ?>
								</span>
							</div>
						</div>
					</div>
					<br/>
				<?php }
				?>
			</div>
			<?php
		endif;
		}
		?>

		<div class="gs-row-float total-amount gs-items gs-line-up-divide--lighter">
			Total amount <?php echo $total . " " . $package_board['currency'] ?>
		</div>

		<div class="booking-summary gs-row-float gs-items gs-line-up-divide--lighter">
			<h2 class="h2">Detail</h2>
			<table>
				<tr>
					<td>Full Booking Name</td>
					<td><?php echo $bookInfo['title'] . " " . $bookInfo['fullname'] ?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><?php echo $bookInfo['email'] ?></td>
				</tr>
				<tr>
					<td>Mobile Phone</td>
					<td><?php echo $bookInfo['mobile'] ?></td>
				</tr>
				<tr>
					<td>Hotel</td>
					<td><?php echo $bookInfo['hotel'] ?></td>
				</tr>
				<tr>
					<td>Hotel Address</td>
					<td><?php echo $bookInfo['hoteladdress'] ?></td>
				</tr>
				<tr>
					<td>Booking Name in the Hotel</td>
					<td><?php echo $bookInfo['bookinghotel'] ?></td>
				</tr>
				<tr>
					<td>Date of Arrival</td>
					<td><?php echo $bookInfo['arrival'] ?></td>
				</tr>
				<tr>
					<td>Country</td>
					<td><?php echo $bookInfo['country'] ?></td>
				</tr>
				<tr>
					<td>Nationality</td>
					<td><?php echo $bookInfo['nationality'] ?></td>
				</tr>
				<tr>
					<td>Note</td>
					<td><?php echo $bookInfo['note'] ?></td>
				</tr>
			</table>
		</div>
		</div>
		<?php
	}

	?>