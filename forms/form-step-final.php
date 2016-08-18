<?php
/**
 * Created by PhpStorm.
 * User: macbookpro
 * Date: 8/18/16
 * Time: 3:33 AM
 */


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