<?php
class login_model extends CI_Model {
	
    function __construct(){
        parent::__construct();
    }
	
	function index()
	{
		//$this->agencyUserList();
	}
	
	public function signup($signup_details)
	{
		$insert_signup=0;
		$insert_login=0;
		$u_id=0;

		$curr_datetime = date("Y-m-d H:i:s");

		$dob_frag=explode('/', $signup_details['dob']);	
		$dob = date('Y-m-d',mktime(0,0,0,$dob_frag[1],$dob_frag[0],$dob_frag[2]));
		
		$insert_user_arr=array(
		
			'email'=>$signup_details['email'],
			'uname'=>$signup_details['username'],
			'passw'=>$signup_details['pass'],
			'fname'=>$signup_details['fname'],
			'lname'=>$signup_details['lname'],
			'dob'=>$dob,
			'gender'=>$signup_details['gender'],
			'pref_locations'=>$signup_details['location_string'],
			'pref_lang'=>$signup_details['language_string'],
			'created_on'=>$curr_datetime
		
		);
		
		$insert_signup = $this->db->insert('tbl_users', $insert_user_arr);
		$u_id=$this->db->insert_id();
		
		if($insert_signup){
			$login_arr=array(
				'email'=>$signup_details['email'],
				'uname'=>$signup_details['username'],
				'passw'=>$signup_details['pass'],
				'last_loggedin_ip'=>$_SERVER['REMOTE_ADDR'],
				'u_id'=>$u_id
			);
			
			$insert_login = $this->db->insert('tbl_login', $login_arr);
			
		}
		
		if($insert_signup && $insert_login){
			return 1;
		}else{
			return 0;
		}
	}

	public function validate_credentials($credentials)
	{
		$uname=$credentials['uname'];
		$pass=$credentials['pass'];
		
		$where="passw COLLATE latin1_general_cs LIKE '%".$pass."%' AND (email='".$uname."' OR uname='".$uname."')";

		$this->db->select('*');
		$this->db->from('tbl_login');
		$this->db->where($where);
		// $this->db->where('email',$uname);
		// $this->db->or_where('uname',$uname);
		
		$query=$this->db->get();
		
		$result=$query->result_array();
		if(count($result)>0){

			$this->session->set_userdata('UID', $result[0]['u_id']);
			$this->session->set_userdata('UEMAIL', $result[0]['email']);
		
			$this->session->set_userdata(array('IS_LOGED_IN' => true));
			
			$this->db->select('*');
			$this->db->from('tbl_users');
			$this->db->where('u_id',$result[0]['u_id']);
			
			$q = $this->db->get();
			
			$res=$q->result_array();
			
			if(count($res)>0)
				return $res[0];
			else
				return array();	
			
		}else{
			return array();
		}

		
	}
	
	public function check_email($check_email)
	{
		
		$this->db->select('u_id');
		$this->db->from('tbl_login');
		$this->db->where('email',$check_email);
		
		$query=$this->db->get();
		
		$result=$query->result_array();
		
		if(count($result)>0)
			return 1;
		else
			return 0;
		
	}

	public function check_username($username)
	{
		
		$this->db->select('u_id');
		$this->db->from('tbl_login');
		$this->db->where('uname',$username);
		
		$query=$this->db->get();
		
		$result=$query->result_array();
		
		if(count($result)>0)
			return 1;
		else
			return 0;
		
	}

}

?>