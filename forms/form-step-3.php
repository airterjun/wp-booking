<?php
/**
 * Created by PhpStorm.
 * User: macbookpro
 * Date: 8/18/16
 * Time: 3:32 AM
 */

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