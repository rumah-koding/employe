<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pns extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'data/pns/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pns_m', 'data');
		$this->load->helper('identitas_helper');
		$this->load->helper('my_helper');
		signin();
		group(array('1','2','4','5'));
	}
	
	//halaman index
	public function index()
	{
		$nip = $this->uri->segment(3);
		$search = $this->data->get_nip($nip);
		if($search){
			redirect('data/pns/updated/'.$nip);
		}else{
			redirect('data/pns/created/'.$nip);
		}
		$this->load->view('template/default', $data);
	}
	
	public function created()
	{
		$nip = $this->uri->segment(4);
		
		$data['head'] 		= 'Tambah Data PNS';
		$data['record'] 	= $this->data->get_new();
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['gol']		= $this->data->get_gol();
		$data['ktpu']		= $this->data->get_ktpu();
		$data['nip']		= $nip;
		
		$this->load->view('template/default', $data);
	}
	
	public function updated($id=null)
	{
		$nip = $this->uri->segment(4);
		
		$data['head'] 		= 'Ubah Data PNS';
		$data['record'] 	= $this->data->get_nip($nip);
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['gol']		= $this->data->get_gol();
		$data['ktpu']		= $this->data->get_ktpu();
		$data['nip']		= $nip;
		
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
			'pengesahan' => $this->input->post('pengesahan'),
			'created_id' => $this->session->userdata('userID')
		);
        
        if($this->validation()){
            $insert = $this->data->insert($data);
			helper_log("add", "Menambah Data PNS");
        }
    }
    
    public function ajax_update($id)
    {
        $data = array(
			'sk' => $this->input->post('sk'),
			'tglsk' => yyyymmdd($this->input->post('tglsk')),
			'tmt' => yyyymmdd($this->input->post('tmt')),
			'gol' => $this->input->post('gol'),
			'pengesahan' => $this->input->post('pengesahan'),
			'updated_id' => $this->session->userdata('userID')
		);
		
        if($this->validation($id)){
            $this->data->where('nip', $id)->update($data);
			helper_log("edit", "Merubah Data PNS");
        }
    }
    
    public function ajax_delete($id)
    {
        $this->data->delete($id);
		helper_log("trash", "Menghapus Data PNS");
        echo json_encode(array("status" => TRUE));
    }
    
    public function ajax_delete_all()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->data->delete($id);
			helper_log("trash", "Menghapus Data PNS");
        }
        echo json_encode(array("status" => TRUE));
    }
	
	public function trash()
    {
        $id = $this->uri->segment(5);
		$nip = $this->uri->segment(4);
		$this->data->delete($id);
		helper_log("trash", "Menghapus Data PNS");
		$this->session->set_flashdata('flashconfirm','Data PNS berhasil di hapus!');
        redirect('data/identitas/'.$nip);
    }
	
	private function validation($id=null)
    {
        //$id = $this->input->post('id');
		$data = array('success' => false, 'messages' => array());
        
		if(!isset($id)){
			$this->form_validation->set_rules("sk", "SK PNS", "trim|required");
			$this->form_validation->set_rules("tglsk", "Tanggal SK PNS", "trim|required");
			$this->form_validation->set_rules("tmt", "TMT PNS", "trim|required");
			$this->form_validation->set_rules("gol", "Golongan PNS", "trim|required");
		}else{
			$this->form_validation->set_rules("sk", "SK PNS", "trim|required");
			$this->form_validation->set_rules("tglsk", "Tanggal SK PNS", "trim|required");
			$this->form_validation->set_rules("tmt", "TMT PNS", "trim|required");
			$this->form_validation->set_rules("gol", "Golongan PNS", "trim|required");
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
}
