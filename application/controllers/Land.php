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
	
	public function sheet()
	{
		$this->db->select('*');
		$this->db->from('test');
		$arrStatus = $this->db->get();
		$arrStatus = $arrStatus->result_array();
		print_r($arrStatus);
		exit;
		$this->load->view('Pg_sheet');
	}
	
	public function test(){
		echo date_default_timezone_get();
		$date = date('d/m/Y h:i:s a', time());
		echo "<br />".$date;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */