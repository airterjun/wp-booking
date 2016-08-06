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

	$form = '<form id="homesearch" method="POST" action="'.esc_url( get_bloginfo('home') ).'/booking">
		<div class="homefilter">
			<div class="homelogo"></div>
			<div class="homeform">
				<div class="rowform">
					<div class="select-style">
						<select id="standard-dropdown" name="surfing_activities[]" required="">
							<option value="" class="test-class-1">Select Surf Activity</option>
							<option value="surf-lessons-tours" class="test-class-1">Surf Lessons &amp; Tours</option>
							<option name="surfing_activities[]" value="Surf Lessons">Surf Lessons</option>
							<option name="surfing_activities[]" value="Surf Tours">Surf Tours</option>
							<option name="surfing_activities[]" value="Surf Board Rental">Surf Board Rental</option>
						</select>
					</div>
				</div>
				<div class="rowform">
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
				<div class="rowform">
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
				<div class="rowform"><input type="text" name="reservation_date[0]" id="datepicker" value=""
				                            placeholder="RESERVATION DATE" readonly="readonly" required=""
				                            class="hasDatepicker"></div>
				<div class="rowform">
					<div class="select-style"><select id="standard-dropdown3" name="duration" required="">
							<option value="">DURATION</option>
							<option value="1">1 Day</option>
							<option value="2">2 Days</option>
							<option value="3">3 Days</option>
						</select></div>
				</div>
				<div class="rowform">
					<div class="srcbtn" id="srcbtn"></div>
					<input type="submit" name="step_home" class="hide"><input name="action" type="hidden" value="stephome"></div>
			</div>
		</div>
	</form>';


	return $form;


}