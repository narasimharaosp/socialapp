<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
		$this->load->model('User_model','model');
	}
	public function index()
	{
		checkin_required();
	}
	public function login()
	{
		$this->load->view('user/login');
	}
	public function submit(){
		$data = array(
			'userid'=>$this->input->post('userid'), 
			'pass'=>$this->input->post('password'), 
			'login_type'=>1,//default direct login
		);
		$result = $this->model->userlogin($data);
		$this->session->set_flashdata('msg', $result);
		redirect(base_url());
	}
	public function profile(){
		checkin_required();
        $login_state = $this->session->userdata('login_state');
       	if($login_state){
       		$uid = $this->session->userdata('uid');
       		$data = $this->model->userinfo($uid);
       		$this->load->view('layout/header');
       		$this->load->view('user/profile',$data);
       		$this->load->view('layout/footer');
       	}
       	else{
       		redirect(base_url());
       	}
    }
	public function logout(){
        $this->session->sess_destroy();
        redirect(base_url(), TRUE);
    }

    public function delete(){
        $uid = $this->session->userdata('uid');
       	$result = $this->model->delete_user($uid);
		$this->session->set_flashdata('msg', $result);
		$this->session->sess_destroy();
		redirect(base_url());
    }

    public function register()
	{
		$this->load->view('user/register');
	}

	public function createaccount()
	{	
		$data = $this->input->post();
		$result = $this->model->create_account($data);
	}
}
