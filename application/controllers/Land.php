<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Land extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		$this->load->library('session');
		
		if($this->session->IS_LOGED_IN() == 0){
			redirect('welcome');
		}
		
	}


	public function index()
	{
		$this->load->view('Pg_Playlist');
	}
	
	public function listPlay()
	{
		$this->load->view('Pg_listPlay');
	}

	public function searchVideos(){
		$this->load->view('pg_searchVideos');
	}
	
	public function sheet()
	{
		$this->load->view('Pg_Playlist');
	}
	
	public function test(){
		echo date_default_timezone_get();
		$date = date('d/m/Y h:i:s a', time());
		echo "<br />".$date;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */