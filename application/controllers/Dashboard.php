<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct() {
		parent::__construct();		
		$this->load->database();   
		$this->load->helper('url');
		$this->load->helper('custom_helper');
		$this->load->library('session');
	}
	public function index()
	{
		checkin_required();
		$data = array();
		$uid = $this->session->userdata('uid');

		//user details
	    $params['table_name'] = 'users';
       	$params['where']['status'] = 1;
       	$params['where']['uid'] = $uid;
		$data['userinfo'] = get_records($params);

		//login details
		$this->db->select('logintype,logincount');
		$this->db->from('login_details');
		$this->db->where('uid =', $uid);
		$this->db->order_by("logintype", "asc");
		$query=$this->db->get();
		$ldetails=$query->result_array();
		foreach($ldetails as $val){
			if($val['logintype'] == 1){
				$overview['direct'] = $val['logincount'];
			}
			elseif($val['logintype'] == 2){
				$overview['google'] = $val['logincount'];
			}
			else{
				$overview['facebook'] = $val['logincount'];
			}
		}
		$overview = json_encode($overview);
		$data['overview'] = $overview;

		//deleted accounts
		$params = array();
	    $params['table_name'] = 'users';
       	$params['where']['status'] = 0;
		$data['da'] = get_records($params);

		//login history
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('login_history','users.uid=login_history.uid');
		if($data['userinfo'][0]['role'] == 2){
			$this->db->where('users.uid= ',$data['userinfo'][0]['uid']);
			$this->db->where('users.role= ',$data['userinfo'][0]['role']);
		}
		$query=$this->db->get();
		$user_lh=$query->result_array();
       	// $params['where']['status'] = 0;
		$data['lh'] = $user_lh;

		$this->load->view('layout/header');
		$this->load->view('dashboard', $data);
		$this->load->view('layout/footer');
	}
}