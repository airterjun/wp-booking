<?php
/**
 * Created by PhpStorm.
 * User: macbookpro
 * Date: 8/18/16
 * Time: 3:31 AM
 */


function form_step_two()
{
	$surfing_activities = $_SESSION['step_one_query']['surfing_activities'];
	$duration = $_SESSION['step_one_query']['duration'];
	?>
	<div class="go-surf-container step-two">
		<form method="POST" action="?step=2" id="step-two">
			<h2 class="gs-h2">Lessons & Tours Specifications</h2>

			<div class="gs-row-float gs-line-up-divider">
				<label>Surfing Activities</label>
				<div class="gs-set-flex select-activity">
					<div class="activity gs-flex-auto">
						<input type="checkbox" name="surfing_activities[]" value="Surf Lessons" id="surf-lessons"
							<?php if (($surfing_activities == 'surf-lessons-tours') || ($surfing_activities == 'surf-lessons')) { ?>
								checked="checked"
							<?php } ?>> Surf Lessons
					</div>
					<div class="activity gs-flex-auto">
						<input type="checkbox" name="surfing_activities[]" value="Surf Tours" id="surf-tours"
							<?php if (($surfing_activities == 'surf-lessons-tours') || ($surfing_activities == 'surf-tours')) { ?>
								checked="checked"
							<?php } ?>> Surf Tours
					</div>
					<div class="activity gs-flex-auto">
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
								<div class="gs-set-flex adult-input-detail gs-row-float gs-items">
									<input placeholder="Name..." type="text"
									       name="adult[participant][<?php echo $a - 1 ?>][name]" class="gs-require">
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
								       name="child[participant][<?php echo $c - 1 ?>][name]" class="gs-require">
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
