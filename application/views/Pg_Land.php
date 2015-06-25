<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <!-- jQuery -->
    <script src="<?php echo BASE_PATH; ?>js/jquery.js"></script>
  
      <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="<?php echo BASE_PATH; ?>css/bootstrap.min.css" rel="stylesheet">
    
    <link href="<?php echo BASE_PATH; ?>css/freelancer.css" rel="stylesheet">

      <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="<?php echo BASE_PATH; ?>css/bootstrap.min.filter.css" rel="stylesheet">

    <!-- Custom CSS -->
    <!-- <link href="css/freelancer.css" rel="stylesheet"> -->

    <link href="<?php echo BASE_PATH; ?>css/jquery-ui-1.10.2.custom.min.css" media="screen" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_PATH; ?>css/stream.css" media="screen" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_PATH; ?>colorbox/colorbox.css" media="screen" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_PATH; ?>css/buttons.css" media="screen" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_PATH; ?>css/animate.css" media="screen" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_PATH; ?>css/chosen-style.css" media="screen" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_PATH; ?>css/prism.css" media="screen" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_PATH; ?>css/chosen.css" media="screen" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_PATH; ?>css/font-awesome/css/font-awesome.min.css" media="screen" rel="stylesheet" type="text/css">
    

    <script src="<?php echo BASE_PATH; ?>colorbox/jquery.colorbox.js"  type="text/javascript"></script>
    <script src="<?php echo BASE_PATH; ?>js/jquery-ui-1.10.2.custom.min.js" type="text/javascript"></script>
    <script src="<?php echo BASE_PATH; ?>js/filter.js" type="text/javascript"></script>
    <script src="<?php echo BASE_PATH; ?>js/movies.js" type="text/javascript"></script>
    <script src="<?php echo BASE_PATH; ?>js/filterindex.js" type="text/javascript"></script>
    <script src="<?php echo BASE_PATH; ?>js/jquery.noty.packaged.min.js" type="text/javascript"></script>
    <script src="<?php echo BASE_PATH; ?>js/notification_html.js" type="text/javascript"></script>
    <script src="<?php echo BASE_PATH; ?>js/chosen.jquery.js" type="text/javascript"></script>
    <script src="<?php echo BASE_PATH; ?>js/prism.js" type="text/javascript"></script>
    

	<!-- jQuery easing plugin -->
	<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
	
    <!-- Shuffle Resources CSS -->
    <script src="<?php echo BASE_PATH; ?>js/ShuffleScript.js" type="text/javascript"></script>
    <link href="<?php echo BASE_PATH; ?>css/ShuffleStyle.css" media="screen" rel="stylesheet" type="text/css">

    
</head>
<body id="page-top" class="index">
	<div id="loadsite" class="loadsite"></div>
	<div id="slate" style="display: none;">

<?php $this->load->view('skeleton/login_nav'); ?>

<br /><br /><br /><br /><br />

    <div class="container">
      <div class="sidebar col-span-3">
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
  </div>
</body>