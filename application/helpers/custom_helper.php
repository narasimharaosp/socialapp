<?php

if (!function_exists('get_records')) {
	function get_records($params) {
		$ci = &get_instance();

		//load databse library
       	$ci->load->database();

		$records = array();
	    $ci->db->select('*');
	    $ci->db->from($params['table_name']);

	    if(!empty($params['where'])){
		    foreach($params['where'] as $col => $val){
		    	$where[$col.' =']= $val;	
		    }
		    $ci->db->where($where);
		}
	    
	    $records = $ci->db->get()->result_array();
	    if(count($records) > 0){
           return $records;
       }else{
           return false;
       }
	}
}

if (!function_exists('checkin_required')) {
	function checkin_required() {
		$ci = &get_instance();
		if (!is_checkedin()) {
			redirect(base_url('user/login'));
			exit;
		}
	}

}

// Checks if the user is logged in (Returns TRUE/FALSE)
if (!function_exists('is_checkedin')) {
	function is_checkedin() {
		$ci = &get_instance();
		if ($ci->session->userdata('login_state') === TRUE) {
			return TRUE;
		}
		return FALSE;
	}

}

?>