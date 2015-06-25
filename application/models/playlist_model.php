<?php
class playlist_model extends CI_Model {
	
    function __construct(){
        parent::__construct();
    }
	
	function index()
	{
		//$this->agencyUserList();
	}

	function addNewPlaylist($pl_arr){

		return $this->db->insert('tbl_pl_data', $pl_arr);

	}

}
?>