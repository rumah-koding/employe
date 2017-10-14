<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'auth/auth/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_m', 'data');
	}
	
	public function index()
	{
		//echo password_hash('admin', PASSWORD_BCRYPT);
		
		$data['title'] 		= 'SIMPEG KALSEL';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view($data['content'], $data);
	}
	
	public function login()
	{
		$validation = array(
			array('field'=>'email', 'rules'=>'required|valid_email'),
			array('field'=>'password','rules'=>'required')
		);
		
		$this->form_validation->set_rules($validation);
		if($this->form_validation->run() == TRUE){
			$email_post = $this->input->post('email');
			$pass_post = $this->input->post('password');
			
			if($this->_resolve_user_login($email_post, $pass_post)){
				
				$user_ID = $this->_get_userID($email_post);
				$username = $this->_get_username($email_post);
				$ip_address = $this->input->ip_address();
				$level = $this->_get_level($email_post);
				
				$create_session = array(
					'userID'=> $user_ID,
					'username' => $username,
					'ip_address'=> $ip_address,
					'signin' => TRUE,
					'level' => $level
				);
				
				$this->session->set_userdata($create_session);
				helper_log("login", "Login Pada Sistem");
				redirect('dashboard');
			}else{
				$this->session->set_flashdata('flasherror','Email/Password Tidak Ditemukan.');
				$this->index();
			}
		}else{
			$this->session->set_flashdata('flasherror', validation_errors('<div class="error">', '</div>'));
			$this->index();
		}
	}
	
	private function _resolve_user_login($email_post, $pass_post)
	{
		$hash = $this->data->get_user($email_post);
		return $this->_verify_password_hash($pass_post, $hash);
	}
	
	private function _get_userID($email_post){
		$userID = $this->data->get_userID($email_post);
		return $userID;
	}
	
	private function _get_username($email_post){
		$username = $this->data->get_username($email_post);
		return $username;
	}
	
	private function _get_level($email_post){
		$level = $this->data->get_level($email_post);
		return $level;
	}
	
	private function _verify_password_hash($pass_post, $hash)
	{
		return password_verify($pass_post, $hash);	
	}
	
	public function logout()
	{
		$this->session->unset_userdata('userID');
		$this->session->unset_userdata('password');
		$this->session->sess_destroy();
		helper_log("logout", "Logout Pada Sistem");
		redirect('login');
	}
}
