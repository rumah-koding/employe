<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'data/file/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('file_m', 'data');
		$this->load->helper('identitas_helper');
		$this->load->helper('my_helper');
		signin();
		group(array('1','2'));
	}
	
	//halaman index
	public function index()
	{
		$nip = $this->uri->segment(3);
		$search = $this->session->userdata('nip');
		if($search){
			redirect('data/file/updated/');
		}else{
			redirect('data/file/created/');
		}
		$this->load->view('template/default', $data);
	}

	public function get_file()
	{
		$data['modul_id'] = $this->input->post('id');
		$data['modul'] = $this->input->post('modul');
		$data['nip'] = $this->input->post('nip');
		$this->load->view('file/form', $data);
	}
	
	public function upload()
    {
			
		$this->upload_file();
		if($_FILES['file']['name'])
		{
			if ($this->upload->do_upload('file')){
				$dokumen = $this->upload->data();
				$data = array(
					'nip' => $this->input->post('nip'),
					'modul_id' => $this->input->post('modul_id'),
					'modul' => $this->input->post('modul'),
					'dokumen' => $dokumen['file_name']
				);
				$find = $this->db->get_where('file', array('nip'=>$this->input->post('nip'),'modul_id'=>$this->input->post('modul_id'),'modul'=>$this->input->post('modul')))->row();
				if($find){
					$data['updated_id'] = $this->session->userdata('userID');
					$proses = $this->data->where('id', $find->id)->update($data);
					helper_log("edit", "Memperbaharui Data Dokumen/File");
				}else{
					$data['created_id'] = $this->session->userdata('userID');
					$proses = $this->data->insert($data);
					helper_log("add", "Menambah Data Dokumen/File");
				}

				if($proses){
					$this->session->set_flashdata('flashconfirm','Dokumen Telah Di Upload');
					redirect('data/identitas/'.$data['nip']);
				}else{
					$this->session->set_flashdata('flasherror','Ada Kesalahan Dalam Upload Data');
					redirect('data/pegawai');
				}
			}
		}else{
			$this->session->set_flashdata('flasherror','Ada Kesalahan Dalam Upload Data');
			redirect('data/identitas/'.$this->input->post('nip'));
		}
    }
	
	private function upload_file(){
		$this->load->library('upload');
        $nmfile = "dokumen_".time(); //nama file saya beri nama langsung dan diikuti fungsi time
        $config['upload_path'] = './source/'; //path folder
        $config['allowed_types'] = 'pdf|jpg|png|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '2048'; //maksimum besar file 2M
        $config['max_width']  = '3000'; //lebar maksimum 1288 px
        $config['max_height']  = '3000'; //tinggi maksimu 768 px
        $config['file_name'] = $nmfile; //nama yang terupload nantinya
        $this->upload->initialize($config);
	}

}
