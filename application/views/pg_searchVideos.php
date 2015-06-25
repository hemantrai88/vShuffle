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
    <link rel="stylesheet" href="//yui.yahooapis.com/pure/0.6.0/pure-min.css">

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
    <style type="text/css">
    .video_result {
	    background-color: #fff;
	    border: 1px solid #000;
	    color: #00628b;
	    display: inline-block;
	    padding: 2%;
	    width: 48%;
	}
    .search_title{
    	vertical-align: top;
    	display: block;
    }
    .add_video{
    	margin-left: 25%;
    }
    .close_video{
    	display: none;
    }
    </style>

    <script type="text/javascript">

    	//Load player api asynchronously.
	    var tag = document.createElement('script');
	    tag.src = "https://www.youtube.com/iframe_api";
	    var firstScriptTag = document.getElementsByTagName('script')[0];
	    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	    var done = false;
	    var player;

	    function onPlayerReady(evt) {
	         evt.target.playVideo();
	     }

    	function playVideo(vid, div_id){
	    	player = new YT.Player(div_id, {
	          height: '50%',
	          width: '90%',
	          videoId: vid,
	          events: {
	            'onReady': onPlayerReady	          
	        	}
	        });

	        $('#img_'+vid).hide();
	        $('#div_'+vid).show();
	        $('#close_'+vid).show();

	        $('.video_result').css("opacity", "0.5");
	    	$('#li_'+vid).css("opacity", "1");
	        
	    }

	    function addToPlay(vid){
	    	alert('Video was added to your playlist');
	    	console.log(vid);
	    }

	    function closeVideo(vid){
	    	//player.stopVideo();
	    	$('#div_'+vid).html('');
	    	$('#div_'+vid).hide();
	    	$('#close_'+vid).hide();
	    	$('#img_'+vid).show();
	    	$('.video_result').css("opacity", "1.0");
	    }

	    var $listItems = $("ul li");

		$listItems.hover(function() {

		    $listItems.not(this).css("opacity", "0.25");

		}, function() {

		    $listItems.not(this).css("opacity", "1.0");    

		});


	    
    </script>
    
</head>
<body id="page-top" class="index">
	<div id="loadsite" class="loadsite"></div>
	<div id="slate" style="display: none;">

<?php $this->load->view('skeleton/login_nav'); ?>

<br /><br /><br /><br /><br />

<?php

$htmlBody = <<<END
<form method="GET">
  <div>
    Search Term: <input type="search" id="q" name="q" placeholder="Enter Search Term">
  </div>
  <div>
    Max Results: <input type="number" id="maxResults" name="maxResults" min="1" max="50" step="1" value="25">
  </div>
  <input type="submit" value="Search">
</form>
END;

// This code will execute if the user entered a search query in the form
// and submitted the form. Otherwise, the page displays the form above.
if (isset($_GET['q']) && isset($_GET['maxResults'])) {
  // Call set_include_path() as needed to point to your client library.
include_once "templates/base.php";
session_start();

require_once 'autoload.php';

  /*
   * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
   * Google Developers Console <https://console.developers.google.com/>
   * Please ensure that you have enabled the YouTube Data API for your project.
   */
  $DEVELOPER_KEY = 'AIzaSyD4iQQbOmc38HRgFGhjjxLDE3na5Qpc7m4';

  $client = new Google_Client();
  $client->setDeveloperKey($DEVELOPER_KEY);

  // Define an object that will be used to make all API requests.
  $youtube = new Google_Service_YouTube($client);

  try {
    // Call the search.list method to retrieve results matching the specified
    // query term.
    $searchResponse = $youtube->search->listSearch('id,snippet', array(
      'q' => $_GET['q'],
      'maxResults' => $_GET['maxResults'],
    ));

    $videos = '';
    $channels = '';
    $playlists = '';

    // Add each result to the appropriate list, and then display the lists of
    // matching videos, channels, and playlists.
    foreach ($searchResponse['items'] as $searchResult) {
    	//echo "<pre>"; print_r($searchResult); echo "</pre>";
      switch ($searchResult['id']['kind']) {
        case 'youtube#video':
          $videos .= sprintf('<li class="video_result" id="li_'.$searchResult['id']['videoId'].'">%s %s </li>',  '<span id="title_'.$searchResult['id']['videoId'].'" class="search_title"> '.$searchResult['snippet']['title'].'</span>', 
              '<img id="img_'.$searchResult['id']['videoId'].'" src="'.$searchResult['snippet']['thumbnails']['default']['url'].'" class="search_img" onclick="playVideo(\''.$searchResult['id']['videoId'].'\', \'div_'.$searchResult['id']['videoId'].'\');" /><div id="div_'.$searchResult['id']['videoId'].'" class="search_video"></div> <div id="actions_'.$searchResult['id']['videoId'].'" class="vid_actions"><input type="button" id="add_to_play_'.$searchResult['id']['videoId'].'" class="add_video pure-button pure-button-primary" value="Add to playlist" onclick="addToPlay(\''.$searchResult['id']['videoId'].'\');" ><input type="button" id="close_'.$searchResult['id']['videoId'].'" class="close_video pure-button" value="Close video" onclick="closeVideo(\''.$searchResult['id']['videoId'].'\');" ></div>');
          break;
        case 'youtube#channel':
          $channels .= sprintf('<li>%s (%s)</li>',
              $searchResult['snippet']['title'], $searchResult['id']['channelId']);
          break;
        case 'youtube#playlist':
          $playlists .= sprintf('<li>%s (%s)</li>',
              $searchResult['snippet']['title'], $searchResult['id']['playlistId']);
          break;
      }
    }

    $htmlBody .= <<<END
    <h3>Videos</h3>
    <ul>$videos</ul>
    <h3>Channels</h3>
    <ul>$channels</ul>
    <h3>Playlists</h3>
    <ul>$playlists</ul>
END;
  } catch (Google_ServiceException $e) {
    $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
      htmlspecialchars($e->getMessage()));
  } catch (Google_Exception $e) {
    $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
      htmlspecialchars($e->getMessage()));
  }
}
?>

<!doctype html>
<html>
  <head>
    <title>YouTube Search</title>
    <script type="text/javascript">
    	$(document).ready(function(){
	    	$('.video_result').click(function(){
	    		//console.log('HERE');
	    		//console.log(this);
	    		$(this).closest('ul').find('li').not($(this).parent()).css("opacity", "0.5");
	    		$(this).css("opacity", "1");
	    	});
	    });
    </script>
  </head>
  <body>
    <?=$htmlBody?>
  </body>
</html>


  </div>
</body>