<?
Class oauth2callback extends CI_Controller{
	function __construct(){
		parent::__construct();
		
		/*$this->load->library('session');
		
		if($this->session->IS_LOGED_IN() == 0){
			redirect('welcome');
		}*/
		
	}


	public function index()
	{
		echo "<pre>"; print_r($_REQUEST); echo "</pre>";
		/*$this->load->view('Pg_Playlist');*/
	}
}