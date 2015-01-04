<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		
		$this->load->library('session');
		
		/*
		if($this->session->IS_LOGED_IN() == 0){
				redirect('login');
				}
				*/
		
	}

	public function index()
	{
		$this->load->view('Pg_Land');
	}
	
	public function video_details()
	{
		 $url='https://www.youtube.com/watch?v='.$_POST['vid'];
		 $youtube = "http://www.youtube.com/oembed?url=". $url ."&format=json";
		
		 $curl = curl_init($youtube);
		 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		 $return = curl_exec($curl);
		 curl_close($curl);
		 echo $return;
	}
	
	public function land(){
		$this->load->view('Pg_Land');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */