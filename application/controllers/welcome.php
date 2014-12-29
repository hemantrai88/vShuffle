<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
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