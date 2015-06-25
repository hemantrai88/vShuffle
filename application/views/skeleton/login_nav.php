    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top header-nav">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://stoneman.boozie.in/">vShuffle</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a class='inline' href="javascript:void(0)" id="login_window">Log in</a>
                    </li>
                    <li class="page-scroll">
                        <a href="javascript:void(0)" id="signup_window">Sign up</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    
    <br />
<div style='display:none'>    
	<div id="login_div">
		<!-- login form -->
		<form id="login_form" method="POST" action="Login/validate">
			<br /><br />
			<!-- fieldsets -->
			<fieldset>
				<h2 class="fs-title">Log In</h2>
				<h3 class="fs-subtitle">Please provide your login details:</h3>
				<input type="text" name="uname" placeholder="Username or Email" />
				<input type="password" name="pass" placeholder="Password" />
				<input type="submit" name="login_button" class="submit action-button"id="submit_login" value="Log-in" />
				<div id="login_spinner" class="spinner" style="display: none;">
				  <div class="rect1"></div>
				  <div class="rect2"></div>
				  <div class="rect3"></div>
				  <div class="rect4"></div>
				  <div class="rect5"></div>
				</div>
			</fieldset>
		</form>
	</div>
</div>
<div style='display:none'>    
	<div id="register_div">
		<!-- registration form -->
		<form id="register_form">
			<!-- progressbar -->
			<!-- <ul id="progressbar">
				<li class="active">Log</li>
				<li>Preferences</li>
				<li>Personal Details</li>
			</ul> -->

			<!-- fieldsets -->
			<fieldset id="first_signup_fieldset">
				<h2 class="fs-title">Log-in Details</h2>
				<h3 class="fs-subtitle"></h3>
				<input type="text" name="email" id="sign_up_email" placeholder="Email" required="required" />
				<i id="signup_email_success" class="fa fa-check text-success validate_success_icon"></i>
				<span id="msg_signup_email" class="validate_error">
					<div id="signup_email_spinner" class="spinner" style="display: none;">
					  <div class="rect1"></div>
					  <div class="rect2"></div>
					  <div class="rect3"></div>
					  <div class="rect4"></div>
					  <div class="rect5"></div>
					</div>
				</span>
				
				<input type="text" id="signup_username" name="username" placeholder="Username" required="required" data-geo="" title="<div class='tooltip_outer_div'><div class='tooltip_head'><strong>Username Syntax:</strong><hr></div><div class='tooltip_body'><div class='tooltip_title'> Length: </div><div class='tooltip_desc'> 6 - 15 characters </div></div><div class='tooltip_body'><div class='tooltip_title'> Required: </div><div class='tooltip_desc'> Start with an alphabet &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div></div><div class='tooltip_body'><div class='tooltip_title'> Allowed: </div><div class='tooltip_desc'> [ a-z ] [A-Z ] [ 0-9 ] . _ - </div></div></div>" />
				<i id="signup_username_success" class="fa fa-check text-success validate_success_icon"></i>
				<span id="msg_signup_username" class="validate_error">
					<div id="signup_username_spinner" class="spinner" style="display: none;">
					  <div class="rect1"></div>
					  <div class="rect2"></div>
					  <div class="rect3"></div>
					  <div class="rect4"></div>
					  <div class="rect5"></div>
					</div>
				</span>
				<input type="password" id="signup_pass" name="pass" data-geo="" title="<div class='tooltip_outer_div'><div class='tooltip_head'><strong>Password Syntax:</strong><hr></div><div class='tooltip_body'><div class='tooltip_title'>Length:</div><div class='tooltip_desc'>Min 8 characters</div></div><div class='tooltip_body'><div class='tooltip_title'>Required: </div><div class='tooltip_desc'>A lowercase alphabet, an upercase alphabet, a number</div></div><div class='tooltip_body'><div class='tooltip_title'>Allowed:</div><div class='tooltip_desc'>[ a-z ] [ A-Z ] [ 0-9 ] . _ -</div></div></div>" placeholder="Password" required="required" />
				<i id="signup_pass_success" class="fa fa-check text-success validate_success_icon"></i>
				<span id="msg_signup_pass" class="validate_error"></span>
				<input type="password" id="signup_conf_pass" name="cpass" placeholder="Confirm Password" required="required" />
				<i id="signup_conf_pass_success" class="fa fa-check text-success validate_success_icon"></i>
				<span id="msg_signup_conf_pass" class="validate_error"></span>
				<input type="button" name="next" class="next action-button" value="Next" />
			</fieldset>
			<fieldset id="second_signup_fieldset">
				<h2 class="fs-title">Preferences</h2>
				<h3 class="fs-subtitle"></h3>
				<!-- <input type="text" name="languages" placeholder="Languages (comma seperated)" required="required" />
				<input type="text" name="locations" placeholder="Locations (comma seperated)" required="required" /> -->
				<select name="languages[]" id="languages" multiple required="required" data-placeholder="Languages" class="chosen-select" multiple style="width:350px;" tabindex="4">
					
					<option value="af">Afrikaans</option> 
					<option value="am">Amharic - ‪አማርኛ‬</option> 
					<option value="ar">Arabic - ‫العربية‬</option> 
					<option value="eu">Basque - ‪euskara‬</option> 
					<option value="bn">Bengali - ‪বাংলা‬</option> 
					<option value="bg">Bulgarian - ‪български‬</option> 
					<option value="ca">Catalan - ‪català‬</option> 
					<option value="zh-HK">Chinese (Hong Kong) - ‪中文（香港）‬</option> 
					<option value="zh-CN">Chinese (Simplified) - ‪简体中文‬</option> 
					<option value="zh-TW">Chinese (Traditional) - ‪繁體中文‬</option> 
					<option value="hr">Croatian - ‪Hrvatski‬</option> 
					<option value="cs">Czech - ‪Čeština‬</option> 
					<option value="da">Danish - ‪Dansk‬</option> 
					<option value="nl">Dutch - ‪Nederlands‬</option> 
					<option value="en-GB">English (United Kingdom)</option> 
					<option value="en">English (United States)</option> 
					<option value="et">Estonian - ‪eesti‬</option> 
					<option value="fil">Filipino</option> 
					<option value="fi">Finnish - ‪Suomi‬</option> 
					<option value="fr-CA">French (Canada) - ‪Français (Canada)‬</option> 
					<option value="fr">French (France) - ‪Français (France)‬</option> 
					<option value="gl">Galician - ‪galego‬</option> 
					<option value="de">German - ‪Deutsch‬</option> 
					<option value="el">Greek - ‪Ελληνικά‬</option> 
					<option value="gu">Gujarati - ‪ગુજરાતી‬</option> 
					<option value="iw">Hebrew - ‫עברית‬</option> 
					<option value="hi">Hindi - ‪हिन्दी‬</option> 
					<option value="hu">Hungarian - ‪magyar‬</option> 
					<option value="is">Icelandic - ‪íslenska‬</option> 
					<option value="id">Indonesian - ‪Bahasa Indonesia‬</option> 
					<option value="it">Italian - ‪Italiano‬</option> 
					<option value="ja">Japanese - ‪日本語‬</option> 
					<option value="kn">Kannada - ‪ಕನ್ನಡ‬</option> 
					<option value="ko">Korean - ‪한국어‬</option> 
					<option value="lv">Latvian - ‪latviešu‬</option> 
					<option value="lt">Lithuanian - ‪lietuvių‬</option> 
					<option value="ms">Malay - ‪Bahasa Melayu‬</option> 
					<option value="ml">Malayalam - ‪മലയാളം‬</option> 
					<option value="mr">Marathi - ‪मराठी‬</option> 
					<option value="no">Norwegian - ‪norsk‬</option> 
					<option value="or">Oriya - ‪ଓଡ଼ିଆ‬</option> 
					<option value="fa">Persian - ‫فارسی‬</option> 
					<option value="pl">Polish - ‪polski‬</option> 
					<option value="pt-BR">Portuguese (Brazil) - ‪Português (Brasil)‬</option> 
					<option value="pt-PT">Portuguese (Portugal) - ‪português (Portugal)‬</option> 
					<option value="ro">Romanian - ‪română‬</option> 
					<option value="ru">Russian - ‪Русский‬</option> 
					<option value="sr">Serbian - ‪српски‬</option> 
					<option value="sk">Slovak - ‪Slovenčina‬</option> 
					<option value="sl">Slovenian - ‪slovenščina‬</option> 
					<option value="es-419">Spanish (Latin America) - ‪Español (Latinoamérica)‬</option> 
					<option value="es">Spanish (Spain) - ‪Español (España)‬</option> 
					<option value="sw">Swahili - ‪Kiswahili‬</option> 
					<option value="sv">Swedish - ‪Svenska‬</option> 
					<option value="ta">Tamil - ‪தமிழ்‬</option> 
					<option value="te">Telugu - ‪తెలుగు‬</option> 
					<option value="th">Thai - ‪ไทย‬</option> 
					<option value="tr">Turkish - ‪Türkçe‬</option> 
					<option value="uk">Ukrainian - ‪Українська‬</option> 
					<option value="ur">Urdu - ‫اردو‬</option> 
					<option value="vi">Vietnamese - ‪Tiếng Việt‬</option> 
					<option value="zu">Zulu - ‪isiZulu‬</option></select>
				</select>
				<br /><br />
				<select name="locations[]" id="locations" multiple required="required" data-placeholder="Locations" class="chosen-select" multiple style="width:350px;" tabindex="4">
					
					<option value=""></option>
		            <option value="Afghanistan">Afghanistan</option>
		            <option value="Aland Islands">Aland Islands</option>
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
		            <option value="Aruba">Aruba</option>
		            <option value="Australia">Australia</option>
		            <option value="Austria">Austria</option>
		            <option value="Azerbaijan">Azerbaijan</option>
		            <option value="Bahamas">Bahamas</option>
		            <option value="Bahrain">Bahrain</option>
		            <option value="Bangladesh">Bangladesh</option>
		            <option value="Barbados">Barbados</option>
		            <option value="Belarus">Belarus</option>
		            <option value="Belgium">Belgium</option>
		            <option value="Belize">Belize</option>
		            <option value="Benin">Benin</option>
		            <option value="Bermuda">Bermuda</option>
		            <option value="Bhutan">Bhutan</option>
		            <option value="Bolivia, Plurinational State of">Bolivia, Plurinational State of</option>
		            <option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
		            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
		            <option value="Botswana">Botswana</option>
		            <option value="Bouvet Island">Bouvet Island</option>
		            <option value="Brazil">Brazil</option>
		            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
		            <option value="Brunei Darussalam">Brunei Darussalam</option>
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
		            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
		            <option value="Colombia">Colombia</option>
		            <option value="Comoros">Comoros</option>
		            <option value="Congo">Congo</option>
		            <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
		            <option value="Cook Islands">Cook Islands</option>
		            <option value="Costa Rica">Costa Rica</option>
		            <option value="Cote D&apos;ivoire">Cote D'ivoire</option>
		            <option value="Croatia">Croatia</option>
		            <option value="Cuba">Cuba</option>
		            <option value="Curacao">Curacao</option>
		            <option value="Cyprus">Cyprus</option>
		            <option value="Czech Republic">Czech Republic</option>
		            <option value="Denmark">Denmark</option>
		            <option value="Djibouti">Djibouti</option>
		            <option value="Dominica">Dominica</option>
		            <option value="Dominican Republic">Dominican Republic</option>
		            <option value="Ecuador">Ecuador</option>
		            <option value="Egypt">Egypt</option>
		            <option value="El Salvador">El Salvador</option>
		            <option value="Equatorial Guinea">Equatorial Guinea</option>
		            <option value="Eritrea">Eritrea</option>
		            <option value="Estonia">Estonia</option>
		            <option value="Ethiopia">Ethiopia</option>
		            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
		            <option value="Faroe Islands">Faroe Islands</option>
		            <option value="Fiji">Fiji</option>
		            <option value="Finland">Finland</option>
		            <option value="France">France</option>
		            <option value="French Guiana">French Guiana</option>
		            <option value="French Polynesia">French Polynesia</option>
		            <option value="French Southern Territories">French Southern Territories</option>
		            <option value="Gabon">Gabon</option>
		            <option value="Gambia">Gambia</option>
		            <option value="Georgia">Georgia</option>
		            <option value="Germany">Germany</option>
		            <option value="Ghana">Ghana</option>
		            <option value="Gibraltar">Gibraltar</option>
		            <option value="Greece">Greece</option>
		            <option value="Greenland">Greenland</option>
		            <option value="Grenada">Grenada</option>
		            <option value="Guadeloupe">Guadeloupe</option>
		            <option value="Guam">Guam</option>
		            <option value="Guatemala">Guatemala</option>
		            <option value="Guernsey">Guernsey</option>
		            <option value="Guinea">Guinea</option>
		            <option value="Guinea-bissau">Guinea-bissau</option>
		            <option value="Guyana">Guyana</option>
		            <option value="Haiti">Haiti</option>
		            <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
		            <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
		            <option value="Honduras">Honduras</option>
		            <option value="Hong Kong">Hong Kong</option>
		            <option value="Hungary">Hungary</option>
		            <option value="Iceland">Iceland</option>
		            <option value="India">India</option>
		            <option value="Indonesia">Indonesia</option>
		            <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
		            <option value="Iraq">Iraq</option>
		            <option value="Ireland">Ireland</option>
		            <option value="Isle of Man">Isle of Man</option>
		            <option value="Israel">Israel</option>
		            <option value="Italy">Italy</option>
		            <option value="Jamaica">Jamaica</option>
		            <option value="Japan">Japan</option>
		            <option value="Jersey">Jersey</option>
		            <option value="Jordan">Jordan</option>
		            <option value="Kazakhstan">Kazakhstan</option>
		            <option value="Kenya">Kenya</option>
		            <option value="Kiribati">Kiribati</option>
		            <option value="Korea, Democratic People&apos;s Republic of">Korea, Democratic People's Republic of</option>
		            <option value="Korea, Republic of">Korea, Republic of</option>
		            <option value="Kuwait">Kuwait</option>
		            <option value="Kyrgyzstan">Kyrgyzstan</option>
		            <option value="Lao People&apos;s Democratic Republic">Lao People's Democratic Republic</option>
		            <option value="Latvia">Latvia</option>
		            <option value="Lebanon">Lebanon</option>
		            <option value="Lesotho">Lesotho</option>
		            <option value="Liberia">Liberia</option>
		            <option value="Libya">Libya</option>
		            <option value="Liechtenstein">Liechtenstein</option>
		            <option value="Lithuania">Lithuania</option>
		            <option value="Luxembourg">Luxembourg</option>
		            <option value="Macao">Macao</option>
		            <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
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
		            <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
		            <option value="Moldova, Republic of">Moldova, Republic of</option>
		            <option value="Monaco">Monaco</option>
		            <option value="Mongolia">Mongolia</option>
		            <option value="Montenegro">Montenegro</option>
		            <option value="Montserrat">Montserrat</option>
		            <option value="Morocco">Morocco</option>
		            <option value="Mozambique">Mozambique</option>
		            <option value="Myanmar">Myanmar</option>
		            <option value="Namibia">Namibia</option>
		            <option value="Nauru">Nauru</option>
		            <option value="Nepal">Nepal</option>
		            <option value="Netherlands">Netherlands</option>
		            <option value="New Caledonia">New Caledonia</option>
		            <option value="New Zealand">New Zealand</option>
		            <option value="Nicaragua">Nicaragua</option>
		            <option value="Niger">Niger</option>
		            <option value="Nigeria">Nigeria</option>
		            <option value="Niue">Niue</option>
		            <option value="Norfolk Island">Norfolk Island</option>
		            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
		            <option value="Norway">Norway</option>
		            <option value="Oman">Oman</option>
		            <option value="Pakistan">Pakistan</option>
		            <option value="Palau">Palau</option>
		            <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
		            <option value="Panama">Panama</option>
		            <option value="Papua New Guinea">Papua New Guinea</option>
		            <option value="Paraguay">Paraguay</option>
		            <option value="Peru">Peru</option>
		            <option value="Philippines">Philippines</option>
		            <option value="Pitcairn">Pitcairn</option>
		            <option value="Poland">Poland</option>
		            <option value="Portugal">Portugal</option>
		            <option value="Puerto Rico">Puerto Rico</option>
		            <option value="Qatar">Qatar</option>
		            <option value="Reunion">Reunion</option>
		            <option value="Romania">Romania</option>
		            <option value="Russian Federation">Russian Federation</option>
		            <option value="Rwanda">Rwanda</option>
		            <option value="Saint Barthelemy">Saint Barthelemy</option>
		            <option value="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option>
		            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
		            <option value="Saint Lucia">Saint Lucia</option>
		            <option value="Saint Martin (French part)">Saint Martin (French part)</option>
		            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
		            <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
		            <option value="Samoa">Samoa</option>
		            <option value="San Marino">San Marino</option>
		            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
		            <option value="Saudi Arabia">Saudi Arabia</option>
		            <option value="Senegal">Senegal</option>
		            <option value="Serbia">Serbia</option>
		            <option value="Seychelles">Seychelles</option>
		            <option value="Sierra Leone">Sierra Leone</option>
		            <option value="Singapore">Singapore</option>
		            <option value="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option>
		            <option value="Slovakia">Slovakia</option>
		            <option value="Slovenia">Slovenia</option>
		            <option value="Solomon Islands">Solomon Islands</option>
		            <option value="Somalia">Somalia</option>
		            <option value="South Africa">South Africa</option>
		            <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
		            <option value="South Sudan">South Sudan</option>
		            <option value="Spain">Spain</option>
		            <option value="Sri Lanka">Sri Lanka</option>
		            <option value="Sudan">Sudan</option>
		            <option value="Suriname">Suriname</option>
		            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
		            <option value="Swaziland">Swaziland</option>
		            <option value="Sweden">Sweden</option>
		            <option value="Switzerland">Switzerland</option>
		            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
		            <option value="Taiwan, Province of China">Taiwan, Province of China</option>
		            <option value="Tajikistan">Tajikistan</option>
		            <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
		            <option value="Thailand">Thailand</option>
		            <option value="Timor-leste">Timor-leste</option>
		            <option value="Togo">Togo</option>
		            <option value="Tokelau">Tokelau</option>
		            <option value="Tonga">Tonga</option>
		            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
		            <option value="Tunisia">Tunisia</option>
		            <option value="Turkey">Turkey</option>
		            <option value="Turkmenistan">Turkmenistan</option>
		            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
		            <option value="Tuvalu">Tuvalu</option>
		            <option value="Uganda">Uganda</option>
		            <option value="Ukraine">Ukraine</option>
		            <option value="United Arab Emirates">United Arab Emirates</option>
		            <option value="United Kingdom">United Kingdom</option>
		            <option value="United States">United States</option>
		            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
		            <option value="Uruguay">Uruguay</option>
		            <option value="Uzbekistan">Uzbekistan</option>
		            <option value="Vanuatu">Vanuatu</option>
		            <option value="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic of</option>
		            <option value="Viet Nam">Viet Nam</option>
		            <option value="Virgin Islands, British">Virgin Islands, British</option>
		            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
		            <option value="Wallis and Futuna">Wallis and Futuna</option>
		            <option value="Western Sahara">Western Sahara</option>
		            <option value="Yemen">Yemen</option>
		            <option value="Zambia">Zambia</option>
		            <option value="Zimbabwe">Zimbabwe</option>
				</select>
				<input type="button" name="previous" class="previous action-button" value="Previous" />
				<input type="button" name="next" class="next action-button" value="Next" />
			</fieldset>	
			<fieldset id="third_signup_fieldset">
				<h2 class="fs-title">Personal Details</h2>
				<h3 class="fs-subtitle"></h3>
				<input type="text" name="fname" id="fname" placeholder="First Name" required="required" />
				<input type="text" name="lname" id="lname" placeholder="Last Name" required="required" />
				<input type="text" name="dob" id="dob" placeholder="Date of birth" required="required" />
				<select name="gender" id="gender" required="required">
					<option value="" selected="selected">Gender</option>
					<option value="male">Male</option>
					<option value="female">Female</option>
				</select>

				<input type="button" name="previous" class="previous action-button" value="Previous" />
				<input type="submit" id="submit_signup" name="submit" class="submit action-button" value="Submit" />
				<div id="signup_spinner" class="spinner" style="display: none;">
					  <div class="rect1"></div>
					  <div class="rect2"></div>
					  <div class="rect3"></div>
					  <div class="rect4"></div>
					  <div class="rect5"></div>
					</div>
			</fieldset>
		
			
		</form>
	</div>
</div>