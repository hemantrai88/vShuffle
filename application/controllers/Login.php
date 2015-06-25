<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		$this->load->model('login_model');
		
		/*
		if($this->session->IS_LOGED_IN() == 0){
				redirect('login');
				}
				*/
		
	}	 
	 
	 
	public function index()
	{
		$this->load->view('Pg_Playlist');
	}
	
	public function validate(){
		$credentials=$this->input->post();

		$validate_login=$this->login_model->validate_credentials($credentials);
		
		if(count($validate_login)>0){
			Echo json_encode($validate_login);
		}else{
			echo 0;
		}
		
	}
	
	public function signup()
	{
		$signup_details=$this->input->post();
		
		$location_string=implode("||", $signup_details['locations']);
		$language_string=implode("||", $signup_details['languages']);
		
		$signup_details['location_string'] = $location_string;
		$signup_details['language_string'] = $language_string;
		
		echo $this->login_model->signup($signup_details);
		
	}
	
	public function chekEmail()
	{
		
		$email=$this->input->post('email');
		
		echo $this->login_model->check_email($email);
		
	}
	
	public function chekUsername()
	{
		
		$username=$this->input->post('username');
		
		echo $this->login_model->check_username($username);
		
	}
	
		function logout()
	{
		$this->session->sess_destroy();
	}
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */