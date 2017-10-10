<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'setting/password/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('password_m', 'data');
		signin();
		//group(array('1'));
	}
	
	//halaman index
	public function index()
	{
		redirect('setting/user');
	}
	
	public function created()
	{
		redirect('setting/user');
	}
	
	public function trash()
	{
		redirect('setting/user');
	}
	
	public function delete()
	{
		redirect('setting/user');
	}
	
	public function updated($id)
	{
		//if($this->session->userdata('userID') != $id){
		//	redirect('setting/user');	
		//}
		
		$data['head'] 		= 'Pengaturan Password Pengguna';
		$data['record'] 	= $this->data->get_id($id);
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view('template/default', $data);
	}
	
	public function ajax_update($id)
    {
        $data = array(
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
            );
		
        if($this->validation($id)){
            $update = $this->data->update($data, $id);
			helper_log("edit", "Merubah Password Pengguna");
        }
    }
	
	private function validation($id=null)
    {
        $data = array('success' => false, 'messages' => array());
        
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[6]|max_length[18]");
		$this->form_validation->set_rules("repassword", "Ulangi Password", "trim|required|matches[password]");
		
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        
        if($this->form_validation->run()){
            $data['success'] = true;
        }else{
            foreach ($_POST as $key => $value) {
                $data['messages'][$key] = form_error($key);
            }
        }
        echo json_encode($data);
        return $this->form_validation->run();
    }
}
