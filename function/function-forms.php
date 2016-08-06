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
						<div class="homeform set-flex">
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
							<div class="rowform">
								<input type="text" name="reservation_date[0]" id="datepicker" value=""
							                            placeholder="RESERVATION DATE" required=""
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
								<input type="submit" name="step_home" class="hide">
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
	?>
	<div class="go-surf-container step-two">
		<form method="POST" action="?step=2">
			Lessons & Tours Specifications<br/>

			<div>
				<label>Duration</label> :
				<select class="step_two[day]">
					<?php for ($i = 1; $i <= 3; $i++) { ?>
						<option value="<?php echo $i ?>"><?php echo $i ?> Day</option>
					<?php } ?>
				</select>
			</div>

			<div>Personal Information</div>

			<div>Please insert names and surf proficiency level.
				If you take Intermediate Lesson/ Surf Tour, you must to fill up the surf abilities form.
				The form is available on the next personal information page.
			</div>

			<div>
				<label>Adult</label> :
				<select name="step_two[adult][num]">
					<?php for ($i = 0; $i <= 10; $i++) { ?>
						<option value="<?php echo $i ?>"><?php echo $i ?></option>
					<?php } ?>
				</select>
			</div>

			<div>
				<input type="text" name="step_two[adult][name]">
				<input type="text" name="step_two[adult][skill]" value="beginer">
			</div>

			<div>
				<label>Adult</label> :
				<select name="step_two[child][num]">
					<?php for ($i = 0; $i <= 10; $i++) { ?>
						<option value="<?php echo $i ?>"><?php echo $i ?></option>
					<?php } ?>
				</select>
			</div>

			<div>
				<input type="text" name="step_two[child][name]">
				<input type="text" name="step_two[child][year]" value="7">
				<input type="text" name="step_two[child][skill]" value="beginer">
			</div>

			<div>Surf Board Rental</div>
			<div>
				<label>Reservation Date</label>
				<input type="text" name="step_two[date][day]">
				<input type="text" name="step_two[date][time]">
			</div>

			<div>
				<label>Duration</label>
				<input type="text" name="step_two[duration]">
			</div>

			<div>
				<label>Number of Board</label>
				<select name="step_two[borad]">
					<?php for ($i = 0; $i <= 10; $i++) { ?>
						<option value="<?php echo $i ?>"><?php echo $i ?></option>
					<?php } ?>
				</select>
			</div>

			<div>
				<input type="submit" value="Submit" name="post_step_two">
				<input type="hidden" value="<?php echo $_POST['surfing_activities'][0]; ?>" name="step_two[type]">
			</div>

		</form>
	</div>
	<?php
}

function form_client_data()
{
	?>

	<form id="bookstep" method="post" action="?step=final">
		<div class="column1">
			<div class="bookrow">
				<div class="leftcol">Full Booking Name (*)</div>
				<div class="rightcol">
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
					<div class="linecol"><input name="fullname" type="text" class="required tooltipstered" value="">
					</div>
				</div>
			</div>
			<div class="bookrow">
				<div class="leftcol">Email (*)</div>
				<div class="rightcol">
					<div class="linecol"><input name="email" type="text" class="emailrequired fulllength tooltipstered"
					                            value=""></div>
				</div>
			</div>
			<div class="bookrow">
				<div class="leftcol">Mobile Phone</div>
				<div class="rightcol">
					<div class="linecol"><input name="mobile" type="text" class="fulllength tooltipstered" value="">
					</div>
				</div>
			</div>
			<div class="bookrow">
				<div class="leftcol">Hotel</div>
				<div class="rightcol">
					<div class="linecol"><input name="hotel" type="text" class="fulllength tooltipstered" value="">
					</div>
				</div>
			</div>
			<div class="bookrow">
				<div class="leftcol">Hotel Address</div>
				<div class="rightcol">
					<div class="linecol"><input name="hoteladdress" type="text" class="fulllength tooltipstered"
					                            value=""></div>
				</div>
			</div>
			<div class="bookrow">
				<div class="leftcol">Booking Name in the Hotel</div>
				<div class="rightcol">
					<div class="linecol"><input name="bookinghotel" type="text" class="fulllength tooltipstered"
					                            value=""></div>
				</div>
			</div>
			<div class="bookrow">
				<div class="leftcol">Date of Arrival</div>
				<div class="rightcol">
					<div class="linecol"><input name="arrival" type="text"
					                            class="date fulllength tooltipstered hasDatepicker" value=""
					                            id="dp1470440173019"></div>
				</div>
			</div>
		</div>
		<div class="column2">
			<div class="bookrow">
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
								<option value="South Georgia and the South Sandwich Islands">South Georgia and the South
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
			<div class="bookrow">
				<div class="leftcol">Nationality</div>
				<div class="rightcol">
					<div class="linecol"><input name="nationality" type="text" class="fulllength tooltipstered"
					                            value=""></div>
				</div>
			</div>
			<div class="bookrow"><br> Note (Comments, Request, Question)<br><textarea name="note" cols=""
			                                                                          rows=""></textarea></div>
		</div>
		<input name="booktype" id="booktype" type="hidden" value="2" class="tooltipstered">
		<div class="submitrow">
			<input type="submit" value="Confirm" name="confirm_step">
		</div>
	</form>
	<?php
}