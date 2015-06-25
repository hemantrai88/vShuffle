<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class playlist extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		$this->load->library('session');
		
		/*if($this->session->IS_LOGED_IN() == 0){
			redirect('welcome');
		}*/

		ini_set('display_errors',1);
		ini_set('display_startup_errors',1);
		error_reporting(-1);
		
	}

	public function Factory(){
		$this->load->view('Pg_plFactory');
	}

	public function save_playlist()
	{
		$this->load->model('playlist_model');

		$playlist = $this->input->post();
		$pl_tags_text = '';
		$add_pl_arr = array();
		
		foreach ($playlist as $key => $value) {
			if(is_array($value)){
				foreach ($value as $k => $v) {
					$pl_tags_text .= $v.",";
				}
				$pl_tags_text = substr($pl_tags_text, 0, strlen($pl_tags_text)-1);
				$add_pl_arr[$key] = $pl_tags_text;
			}else{
				$add_pl_arr[$key] = $value;
			}
		}

		echo $this->playlist_model->addNewPlaylist($add_pl_arr);
	}

	public function searchYoutube(){

		// This code will execute if the user entered a search query in the form
		// and submitted the form. Otherwise, the page displays the form above.
		if (isset($_POST['q']) && isset($_POST['maxResults'])) {
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
		      'q' => $_POST['q'],
		      'maxResults' => $_POST['maxResults'],
		    ));

		    $videos = '';
		    $channels = '';
		    $playlists = '';
		    $htmlBody = '';

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

		    $htmlBody .= "<h3>Videos</h3> <ul>".$videos."</ul>";
		  } catch (Google_ServiceException $e) {
		    $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
		      htmlspecialchars($e->getMessage()));
		  } catch (Google_Exception $e) {
		    $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
		      htmlspecialchars($e->getMessage()));
		  }
		}
		
		echo $htmlBody;

	}

	public function searchYoutubePoly(){

		// This code will execute if the user entered a search query in the form
		// and submitted the form. Otherwise, the page displays the form above.
		if (isset($_POST['q']) && isset($_POST['maxResults'])) {
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
		      'q' => $_POST['q'],
		      'maxResults' => $_POST['maxResults'],
		    ));

		    $videos = '';
		    $channels = '';
		    $playlists = '';
		    $htmlBody = '';

		    // Add each result to the appropriate list, and then display the lists of
		    // matching videos, channels, and playlists.
		    foreach ($searchResponse['items'] as $searchResult) {
		    	//echo "<pre>"; print_r($searchResult); echo "</pre>";
		      switch ($searchResult['id']['kind']) {
		        case 'youtube#video':

					$videos .= '<post-card id="search_pc__'.$searchResult['id']['videoId'].'">
							    
							    <h2 id="pc_link__'.$searchResult['id']['videoId'].'" class="result_text" onclick="open_vid_card(\''.$searchResult['id']['videoId'].'\');"  onmouseenter="show_preview(\''.$searchResult['id']['videoId'].'\');" onmouseleave="hide_preview(\''.$searchResult['id']['videoId'].'\');" >'.$searchResult['snippet']['title'].'</h2>
							  </post-card>

							  <paper-action-dialog id="dialog_action__'.$searchResult['id']['videoId'].'" heading="'.$searchResult['snippet']['title'].'" style="width: 100%; height: 100%;">
						          
						          <div style="width:100%; height:100%;">
						          	<div id="player__'.$searchResult['id']['videoId'].'"></div>
						          </div>

						          <paper-button dismissive>Close</paper-button>
						          <paper-button affirmative>Add to playlist</paper-button>
						      </paper-action-dialog>';
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

		    $htmlBody .= $videos;
		  } catch (Google_ServiceException $e) {
		    $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
		      htmlspecialchars($e->getMessage()));
		  } catch (Google_Exception $e) {
		    $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
		      htmlspecialchars($e->getMessage()));
		  }
		}
		
		echo $htmlBody;

	}

	public function polyTest(){
		$this->load->view('Pg_polytest');
	}

	public function firstPage(){
		$this->load->view('Pg_factoryView');
	}
}

/* End of file Playlist.php */
