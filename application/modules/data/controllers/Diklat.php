<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diklat extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'data/diklat/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('diklat_m', 'data');
		$this->load->helper('identitas_helper');
		$this->load->helper('my_helper');
		signin();
		group(array('1','2','4','5'));
	}
	
	//halaman index
	public function index()
	{
		$data 		= array();
		redirect('data/diklat/created');
		$this->load->view('template/default', $data);
	}
	
	public function created()
	{
		$data['head'] 		= 'Tambah Data Diklat';
		$data['record'] 	= $this->data->get_new();
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['kode']		= $this->data->get_diklat();
		$data['nip']		= $this->session->userdata('nip');
		
		$this->load->view('template/default', $data);
	}
	
	public function updated($id=null)
	{
		$id = $this->uri->segment(4);
		
		$data['head'] 		= 'Ubah Data Diklat';
		$data['record'] 	= $this->data->get_id($id);
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['kode']		= $this->data->get_diklat();
		$data['nip']		= $this->session->userdata('nip');
		
		$this->load->view('template/default', $data);
	}
	
	public function ajax_save()
    {
        $data = array(
                'nip' => $this->input->post('nip'),
				'jenis' => $this->input->post('jenis'),
				'kode' => $this->input->post('kode'),
				'diklat' => $this->input->post('diklat'),
				'tempat' => $this->input->post('tempat'),
				'panitia' => $this->input->post('panitia'),
				'angkatan' => $this->input->post('angkatan'),
				'mulai' => yyyymmdd($this->input->post('mulai')),
				'akhir' => yyyymmdd($this->input->post('akhir')),
				'tglsk' => yyyymmdd($this->input->post('tglsk')),
				'sk' => $this->input->post('sk'),
				'jam' => $this->input->post('jam'),
				'created_id' => $this->session->userdata('userID')
            );
        
        if($this->validation()){
            $insert = $this->data->insert($data);
			helper_log("add", "Menambah Data Diklat");
        }
    }
    
    public function ajax_update($id)
    {
         $data = array(
                'nip' => $this->input->post('nip'),
				'jenis' => $this->input->post('jenis'),
				'kode' => $this->input->post('kode'),
				'diklat' => $this->input->post('diklat'),
				'tempat' => $this->input->post('tempat'),
				'panitia' => $this->input->post('panitia'),
				'angkatan' => $this->input->post('angkatan'),
				'mulai' => yyyymmdd($this->input->post('mulai')),
				'akhir' => yyyymmdd($this->input->post('akhir')),
				'tglsk' => yyyymmdd($this->input->post('tglsk')),
				'sk' => $this->input->post('sk'),
				'jam' => $this->input->post('jam'),
				'updated_id' => $this->session->userdata('userID')
            );
		
        if($this->validation($id)){
            $this->data->update($data, $id);
			helper_log("edit", "Merubah Data Diklat");
        }
    }
    
    public function ajax_delete($id)
    {
        $this->data->delete($id);
		helper_log("trash", "Menghapus Data Diklat");
        echo json_encode(array("status" => TRUE));
    }
    
    public function ajax_delete_all()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->data->delete($id);
			helper_log("trash", "Menghapus Data Diklat");
        }
        echo json_encode(array("status" => TRUE));
    }
	
	public function trash()
    {
        $id = $this->uri->segment(5);
		$nip = $this->uri->segment(4);
		$this->data->delete($id);
		helper_log("trash", "Menghapus Data Diklat");
		$this->session->set_flashdata('flashconfirm','Data Diklat berhasil di hapus!');
        redirect('data/identitas/'.$nip);
    }
	
	private function validation($id=null)
    {
        //$id = $this->input->post('id');
		$data = array('success' => false, 'messages' => array());
        
		$this->form_validation->set_rules("jenis", "Jenis Diklat", "trim|required");
		$this->form_validation->set_rules("kode", "Kode Diklat Struktural", "trim");
		$this->form_validation->set_rules("sk", "Nomer SK/Sertifikat Diklat", "trim|required");
		$this->form_validation->set_rules("tglsk", "Tanggal SK Diklat", "trim|required");
		$this->form_validation->set_rules("diklat", "Nama Diklat", "trim|required");
		$this->form_validation->set_rules("tempat", "Kota Lokasi Diklat", "trim|required");
		$this->form_validation->set_rules("panitia", "Panitia/Pelaksana Diklat", "trim|required");
		$this->form_validation->set_rules("angkatan", "Angkatan Diklat", "trim");
		$this->form_validation->set_rules("awal", "Tanggal Awal Diklat", "trim");
		$this->form_validation->set_rules("akhir", "Tanggal Akhir Diklat", "trim");
		
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
	
	public function ajax_csfr()
    {
        echo json_encode(array("token" => $this->security->get_csrf_token_name(), "key"=>$this->security->get_csrf_hash()));
    }
}
