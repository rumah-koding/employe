<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pangkat extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'data/pangkat/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pangkat_m', 'data');
		$this->load->helper('identitas_helper');
		$this->load->helper('my_helper');
		signin();
		group(array('1','2','4','5'));
	}
	
	//halaman index
	public function index()
	{
		$data 		= array();
		redirect('data/pangkat/created');
		$this->load->view('template/default', $data);
	}
	
	public function created()
	{
		$data['head'] 		= 'Tambah Data Pangkat';
		$data['record'] 	= $this->data->get_new();
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['gol']		= $this->data->get_gol();
		$data['ktpu']		= $this->data->get_ktpu();
		$data['nip']		= $this->session->userdata('nip');
		
		$this->load->view('template/default', $data);
	}
	
	public function updated($id=null)
	{
		$id = $this->uri->segment(4);
		
		$data['head'] 		= 'Ubah Data Pangkat';
		$data['record'] 	= $this->data->get_id($id);
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['gol']		= $this->data->get_gol();
		$data['ktpu']		= $this->data->get_ktpu();
		$data['nip']		= $this->session->userdata('nip');
		
		$this->load->view('template/default', $data);
	}
	
	public function ajax_save()
    {
        $data = array(
                'nip' => $this->input->post('nip'),
				'sk' => $this->input->post('sk'),
				'tglsk' => yyyymmdd($this->input->post('tglsk')),
				'tmt' => yyyymmdd($this->input->post('tmt')),
				'gol' => $this->input->post('gol'),
				'thn' => $this->input->post('thn'),
				'bln' => $this->input->post('bln'),
				'pengesahan' => $this->input->post('pengesahan'),
				'created_id' => $this->session->userdata('userID')
            );
        
        if($this->validation()){
            $insert = $this->data->insert($data);
			helper_log("add", "Menambah Data Pangkat");
        }
    }
    
    public function ajax_update($id)
    {
        $data = array(
                'nip' => $this->input->post('nip'),
				'sk' => $this->input->post('sk'),
				'tglsk' => yyyymmdd($this->input->post('tglsk')),
				'tmt' => yyyymmdd($this->input->post('tmt')),
				'gol' => $this->input->post('gol'),
				'thn' => $this->input->post('thn'),
				'bln' => $this->input->post('bln'),
				'pengesahan' => $this->input->post('pengesahan'),
				'updated_id' => $this->session->userdata('userID')
            );
		
        if($this->validation($id)){
            $this->data->update($data, $id);
			helper_log("edit", "Merubah Data Pangkat");
        }
    }
    
    public function ajax_delete($id)
    {
        $this->data->delete($id);
		helper_log("trash", "Menghapus Data Pangkat");
        echo json_encode(array("status" => TRUE));
    }
    
    public function ajax_delete_all()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->data->delete($id);
			helper_log("trash", "Menghapus Data Pangkat");
        }
        echo json_encode(array("status" => TRUE));
    }
	
	public function trash()
    {
        $id = $this->uri->segment(5);
		$nip = $this->uri->segment(4);
		$this->data->delete($id);
		helper_log("trash", "Menghapus Data Pangkat");
		$this->session->set_flashdata('flashconfirm','Data Pangkat berhasil di hapus!');
        redirect('data/identitas/'.$nip);
    }
	
	private function validation($id=null)
    {
        //$id = $this->input->post('id');
		$data = array('success' => false, 'messages' => array());
        
		if(!isset($id)){
			$this->form_validation->set_rules("sk", "SK Pangkat", "trim|required");
			$this->form_validation->set_rules("tglsk", "Tanggal SK Pangkat", "trim|required");
			$this->form_validation->set_rules("tmt", "TMT Pangkat", "trim|required");
			$this->form_validation->set_rules("gol", "Golongan Pangkat", "trim|required");
			$this->form_validation->set_rules("pengesahan", "Pejabat Pengesahan", "trim|required");
		}else{
			$this->form_validation->set_rules("sk", "SK Pangkat", "trim|required");
			$this->form_validation->set_rules("tglsk", "Tanggal SK Pangkat", "trim|required");
			$this->form_validation->set_rules("tmt", "TMT Pangkat", "trim|required");
			$this->form_validation->set_rules("gol", "Golongan Pangkat", "trim|required");
			$this->form_validation->set_rules("pengesahan", "Pejabat Pengesahan", "trim|required");
		}
        
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
