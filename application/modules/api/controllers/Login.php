<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    //Menampilkan data kontak
    function index() {
        $url = site_url('api/auth?email=admin@admin.com');
        $data = file_get_contents($url); 
        $json = json_decode($data);
        echo $json[0]->email;
    }

    private function _resolve_user_login($email_post, $pass_post)
	{
		$hash = $this->data->get_user($email_post);
		return $this->_verify_password_hash($pass_post, $hash);
    }
    
    private function _verify_password_hash($pass_post, $hash)
	{
		return password_verify($pass_post, $hash);	
	}
}
?>