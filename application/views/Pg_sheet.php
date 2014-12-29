<head>
	
        <!-- jQuery -->
    <script src="<?php echo BASE_PATH; ?>js/jquery.js"></script>
  
      <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="<?php echo BASE_PATH; ?>css/bootstrap.min.filter.css" rel="stylesheet">

    <!-- Custom CSS -->
    <!-- <link href="css/freelancer.css" rel="stylesheet"> -->
    
    <link href="<?php echo BASE_PATH; ?>css/jquery-ui-1.10.2.custom.min.css" media="screen" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_PATH; ?>css/stream.css" media="screen" rel="stylesheet" type="text/css">
    <script src="<?php echo BASE_PATH; ?>js/jquery-ui-1.10.2.custom.min.js" type="text/javascript"></script>
    <script src="<?php echo BASE_PATH; ?>js/filter.js" type="text/javascript"></script>
    <script src="<?php echo BASE_PATH; ?>js/movies.js" type="text/javascript"></script>
    <script src="<?php echo BASE_PATH; ?>js/filterindex.js" type="text/javascript"></script>    
    

<script>
//jQuery time

$(document).ready(function(){
	
	var current_fs, next_fs, previous_fs; //fieldsets
	var left, opacity, scale; //fieldset properties which we will animate
	var animating; //flag to prevent quick multi-click glitches
	
	$(".next").click(function(){
		console.log('IN');
		if(animating) return false;
		animating = true;
		
		current_fs = $(this).parent();
		next_fs = $(this).parent().next();
		
		//activate next step on progressbar using the index of next_fs
		$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
		
		//show the next fieldset
		next_fs.show(); 
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
			step: function(now, mx) {
				//as the opacity of current_fs reduces to 0 - stored in "now"
				//1. scale current_fs down to 80%
				scale = 1 - (1 - now) * 0.2;
				//2. bring next_fs from the right(50%)
				left = (now * 50)+"%";
				//3. increase opacity of next_fs to 1 as it moves in
				opacity = 1 - now;
				current_fs.css({'transform': 'scale('+scale+')'});
				next_fs.css({'left': left, 'opacity': opacity});
			}, 
			duration: 800, 
			complete: function(){
				current_fs.hide();
				animating = false;
			}, 
			//this comes from the custom easing plugin
			easing: 'easeInOutBack'
		});
	});
	
	$(".previous").click(function(){
		if(animating) return false;
		animating = true;
		
		current_fs = $(this).parent();
		previous_fs = $(this).parent().prev();
		
		//de-activate current step on progressbar
		$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
		
		//show the previous fieldset
		previous_fs.show(); 
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
			step: function(now, mx) {
				//as the opacity of current_fs reduces to 0 - stored in "now"
				//1. scale previous_fs from 80% to 100%
				scale = 0.8 + (1 - now) * 0.2;
				//2. take current_fs to the right(50%) - from 0%
				left = ((1-now) * 50)+"%";
				//3. increase opacity of previous_fs to 1 as it moves in
				opacity = 1 - now;
				current_fs.css({'left': left});
				previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
			}, 
			duration: 800, 
			complete: function(){
				current_fs.hide();
				animating = false;
			}, 
			//this comes from the custom easing plugin
			easing: 'easeInOutBack'
		});
	});
	
	$(".submit").click(function(){
		return false;
	})
	
	$('#signup_window').click(function(){
		$('#login_form').hide();
		$('#register_form').toggle();
	});
	
	$('#login_window').click(function(){
		$('#register_form').hide();
		$('#login_form').toggle();
	});

});
</script>
  
<style>

	/*custom font*/
	@import url(http://fonts.googleapis.com/css?family=Montserrat);
	
	/*basic reset*/
	* {margin: 0; padding: 0;}
	
	body{
		background-color: #00628B;
	}
	
	/*form styles*/
	#register_form {
		width: 400px;
		margin: 50px auto;
		text-align: center;
		position: relative;
	}
	#register_form fieldset {
		background: white;
		border: 0 none;
		border-radius: 3px;
		box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
		padding: 20px 30px;
		
		box-sizing: border-box;
		width: 80%;
		margin: 0 10%;
		
		/*stacking fieldsets above each other*/
		position: absolute;
	}
	/*Hide all except first fieldset*/
	#register_form fieldset:not(:first-of-type) {
		display: none;
	}
	/*inputs*/
	#register_form input, #register_form textarea {
		padding: 15px;
		border: 1px solid #ccc;
		border-radius: 3px;
		margin-bottom: 10px;
		width: 100%;
		box-sizing: border-box;
		font-family: montserrat;
		color: #2C3E50;
		font-size: 13px;
	}
	/*buttons*/
	#register_form .action-button {
		width: 100px;
		background: #27AE60;
		font-weight: bold;
		color: white;
		border: 0 none;
		border-radius: 1px;
		cursor: pointer;
		padding: 10px 5px;
		margin: 10px 5px;
	}
	#register_form .action-button:hover, #register_form .action-button:focus {
		box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
	}
	
	#login_form {
		width: 400px;
		margin: 50px auto;
		text-align: center;
		position: relative;
	}
	#login_form fieldset {
		background: white;
		border: 0 none;
		border-radius: 3px;
		box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
		padding: 20px 30px;
		
		box-sizing: border-box;
		width: 80%;
		margin: 0 10%;
		
		/*stacking fieldsets above each other*/
		position: absolute;
	}
	/*Hide all except first fieldset*/
	#login_form fieldset:not(:first-of-type) {
		display: none;
	}
	/*inputs*/
	#login_form input, #register_form textarea {
		padding: 15px;
		border: 1px solid #ccc;
		border-radius: 3px;
		margin-bottom: 10px;
		width: 100%;
		box-sizing: border-box;
		font-family: montserrat;
		color: #2C3E50;
		font-size: 13px;
	}
	/*buttons*/
	#login_form .action-button {
		width: 100px;
		background: #27AE60;
		font-weight: bold;
		color: white;
		border: 0 none;
		border-radius: 1px;
		cursor: pointer;
		padding: 10px 5px;
		margin: 10px 5px;
	}
	#login_form .action-button:hover, #login_form .action-button:focus {
		box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
	}
	
	
	/*headings*/
	.fs-title {
		font-size: 15px;
		text-transform: uppercase;
		color: #2C3E50;
		margin-bottom: 10px;
	}
	.fs-subtitle {
		font-weight: normal;
		font-size: 13px;
		color: #666;
		margin-bottom: 20px;
	}
	/*Registration progressbar*/
	#progressbar {
		margin-bottom: 30px;
		overflow: hidden;
		/*CSS counters to number the steps*/
		counter-reset: step;
	}
	#progressbar li {
		list-style-type: none;
		color: white;
		text-transform: uppercase;
		font-size: 9px;
		width: 33.33%;
		float: left;
		position: relative;
	}
	#progressbar li:before {
		content: counter(step);
		counter-increment: step;
		width: 20px;
		line-height: 20px;
		display: block;
		font-size: 10px;
		color: #333;
		background: white;
		border-radius: 3px;
		margin: 0 auto 5px auto;
	}
	/*progressbar connectors*/
	#progressbar li:after {
		content: '';
		width: 100%;
		height: 2px;
		background: white;
		position: absolute;
		left: -50%;
		top: 9px;
		z-index: -1; /*put it behind the numbers*/
	}
	#progressbar li:first-child:after {
		/*connector not needed before the first step*/
		content: none; 
	}
	/*marking active/completed steps green*/
	/*The number of the step and the connector before it = green*/
	#progressbar li.active:before,  #progressbar li.active:after{
		background: #27AE60;
		color: white;
	}

</style>

</head>
<body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://stoneman.boozie.in/">VShuffle</a>
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

<!-- login form -->
<form id="login_form" style="display: none;">

	<!-- fieldsets -->
	<fieldset>
		<h2 class="fs-title">Log In</h2>
		<h3 class="fs-subtitle">Please provide your login details:</h3>
		<input type="text" name="email" placeholder="Email" />
		<input type="password" name="pass" placeholder="Password" />
		<input type="button" name="login_button" class="submit action-button" value="Log-in" />
	</fieldset>
</form>

<!-- registration form -->
<form id="register_form" style="display: none;">
	<!-- progressbar -->
	<ul id="progressbar">
		<li class="active">Account Setup</li>
		<li>Social Profiles</li>
		<li>Personal Details</li>
	</ul>
	<!-- fieldsets -->
	<fieldset>
		<h2 class="fs-title">Create your account</h2>
		<h3 class="fs-subtitle">This is step 1</h3>
		<input type="text" name="email" placeholder="Email" />
		<input type="password" name="pass" placeholder="Password" />
		<input type="password" name="cpass" placeholder="Confirm Password" />
		<input type="button" name="next" class="next action-button" value="Next" />
	</fieldset>
	<fieldset>
		<h2 class="fs-title">Social Profiles</h2>
		<h3 class="fs-subtitle">Your presence on the social network</h3>
		<input type="text" name="twitter" placeholder="Twitter" />
		<input type="text" name="facebook" placeholder="Facebook" />
		<input type="text" name="gplus" placeholder="Google Plus" />
		<input type="button" name="previous" class="previous action-button" value="Previous" />
		<input type="button" name="next" class="next action-button" value="Next" />
	</fieldset>
	<fieldset>
		<h2 class="fs-title">Personal Details</h2>
		<h3 class="fs-subtitle">We will never sell it</h3>
		<input type="text" name="fname" placeholder="First Name" />
		<input type="text" name="lname" placeholder="Last Name" />
		<input type="text" name="phone" placeholder="Phone" />
		<textarea name="address" placeholder="Address"></textarea>
		<input type="button" name="previous" class="previous action-button" value="Previous" />
		<input type="submit" name="submit" class="submit action-button" value="Submit" />
	</fieldset>
</form>



    <div class="container">
      <h1 class="title">Filter.js</h1>
      <div class="sidebar col-span-3">
        <div class="row">
          <h4 class="col-span-6"> Movies (<span id="total_movies">250</span>)</h4>
          <div class="col-span-6 progress">
            <div class="progress-bar" id="stream_progress" style="width: 0%">0 %</div>
          </div>
        </div>
        <div>
          <input type="text" id="searchbox" placeholder="Search...">
          <span class="glyphicon glyphicon-search search-icon"></span>
        </div>
        <div class="criteria" id="rating_criteria">
          <h4>Rating</h4>
          <span id="rating_range_label" class="slider-label">8 - 10</span>
          <div id="rating_slider" class="slider"></div>
          <input type="hidden" id="rating_filter" value="8-10"/>
        </div>
        <div class="criteria" id="runtime_criteria">
          <h4>Runtime</h4>
          <span id="runtime_range_label" class="slider-label">50 mins - 250 mins</span>
          <div id="runtime_slider" class="slider"></div>
          <input type="hidden" id="runtime_filter" value="50-250">
        </div>
        <div class="criteria" id="year_criteria">
          <h4>Year</h4>
          <select id="year_filter" class="col-span-8">
            <option value="1920-2020">All (1920 - 2020)</option>
            <option value="1920-1930">1920 - 1930</option>
            <option value="1931-1940">1931 - 1940</option>
            <option value="1941-1950">1941 - 1950</option>
            <option value="1951-1960">1951 - 1960</option>
            <option value="1961-1970">1961 - 1970</option>
            <option value="1971-1980">1971 - 1980</option>
            <option value="1981-1990">1981 - 1990</option>
            <option value="1991-2000">1991 - 2000</option>
            <option value="2001-2010">2001 - 2010</option>
            <option value="2011-2020">2011 - 2020</option>
          </select>
        </div>
        <div class="criteria" id="genre_criteria">
          <h4>Genre</h4>
          <div class="checkbox">
            <label>
              <input type="checkbox" value="All" id="all_genre"> All
            </label>
          </div>
          <div class="checkbox">
            <label>
              <input type="checkbox" value="Crime"> Crime
            </label>
            </div><div class="checkbox">
            <label>
              <input type="checkbox" value="Drama"> Drama
            </label>
            </div><div class="checkbox">
            <label>
              <input type="checkbox" value="Thriller"> Thriller
            </label>
            </div><div class="checkbox">
            <label>
              <input type="checkbox" value="Adventure"> Adventure
            </label>
            </div><div class="checkbox">
            <label>
              <input type="checkbox" value="Western"> Western
            </label>
            </div><div class="checkbox">
            <label>
              <input type="checkbox" value="Action"> Action
            </label>
            </div><div class="checkbox">
            <label>
              <input type="checkbox" value="Biography"> Biography
            </label>
            </div><div class="checkbox">
            <label>
              <input type="checkbox" value="History"> History
            </label>
            </div><div class="checkbox">
            <label>
              <input type="checkbox" value="War"> War
            </label>
            </div><div class="checkbox">
            <label>
              <input type="checkbox" value="Fantasy"> Fantasy
            </label>
            </div><div class="checkbox">
            <label>
              <input type="checkbox" value="Sci-Fi"> Sci-Fi
            </label>
            </div><div class="checkbox">
            <label>
              <input type="checkbox" value="Mystery"> Mystery
            </label>
            </div><div class="checkbox">
            <label>
              <input type="checkbox" value="Romance"> Romance
            </label>
            </div><div class="checkbox">
            <label>
              <input type="checkbox" value="Family"> Family
            </label>
            </div><div class="checkbox">
            <label>
              <input type="checkbox" value="Horror"> Horror
            </label>
            </div><div class="checkbox">
            <label>
              <input type="checkbox" value="Film-Noir"> Film-Noir
            </label>
            </div><div class="checkbox">
            <label>
              <input type="checkbox" value="Comedy"> Comedy
            </label>
            </div><div class="checkbox">
            <label>
              <input type="checkbox" value="Animation"> Animation
            </label>
            </div><div class="checkbox">
            <label>
              <input type="checkbox" value="Musical"> Musical
            </label>
            </div><div class="checkbox">
            <label>
              <input type="checkbox" value="Music"> Music
            </label>
            </div><div class="checkbox">
            <label>
              <input type="checkbox" value="Sport"> Sport
            </label>
        </div></div>

      </div>
      <div class="sorting content col-span-9">
      </div>
      <div class="movies content col-span-9" id="movies">
      </div>
      <script id="movie-template" type="text/html">
        <div class="col-span-4 movie">
          <div class="thumbnail">
            <span class="label label-success rating"><%= rating %>
            <i class="glyphicon glyphicon-star"></i>
          </span>
          <div class="caption">
            <h4><%= name %></h4>
            <div class="outline">
              <%= outline %>
              <span class="runtime">
                <i class="glyphicon glyphicon-time"></i>
                <%= runtime %> mins.
              </span>
            </div>
            <div class="detail">
              <dl>
                <dt>Director</dt>
                <dd><%= director %></dd>
                <dt>Actors</dt>
                <dd><%= stars %></dt>
                <dt>Year</dt>
                <dd><%= year %></dd>
              </dl>
            </div>
          </div>
        </div>
      </div>
      </script>
      <script id="genre_template" type="text/html">
        <div class="checkbox">
          <label>
            <input type="checkbox" value="<%= genre %>"> <%= genre %>
          </label>
        </div>
      </script>

</body>