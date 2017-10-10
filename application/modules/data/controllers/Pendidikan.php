<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendidikan extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'data/pendidikan/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pendidikan_m', 'data');
		$this->load->helper('identitas_helper');
		$this->load->helper('my_helper');
		signin();
		group(array('1','2','4','5'));
	}
	
	//halaman index
	public function index()
	{
		$data 		= array();
		redirect('data/pendidikan/created');
		$this->load->view('template/default', $data);
	}
	
	public function created()
	{
		$data['head'] 		= 'Tambah Data Pendidikan';
		$data['record'] 	= $this->data->get_new();
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['ktpu']		= $this->data->get_ktpu();
		$data['nip']		= $this->session->userdata('nip');
		
		$this->load->view('template/default', $data);
	}
	
	public function updated($id=null)
	{
		$id = $this->uri->segment(4);
		
		$data['head'] 		= 'Ubah Data Pendidikan';
		$data['record'] 	= $this->data->get_id($id);
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['ktpu']		= $this->data->get_ktpu();
		$data['nip']		= $this->session->userdata('nip');
		
		$this->load->view('template/default', $data);
	}
	
	public function ajax_save()
    {
        $data = array(
                'nip' => $this->input->post('nip'),
				'ktpu' => $this->input->post('ktpu'),
				'jurusan' => $this->input->post('jurusan'),
				'tanggal' => yyyymmdd($this->input->post('tanggal')),
				'tahun' => yyyy(yyyymmdd($this->input->post('tanggal'))),
				'ijasah' => $this->input->post('ijasah'),
				'sekolah' => $this->input->post('sekolah'),
				'tempat' => $this->input->post('tempat'),
				'created_id' => $this->session->userdata('userID')
            );
        
        if($this->validation()){
            $insert = $this->data->insert($data);
			helper_log("add", "Menambah Data Pendidikan");
        }
    }
    
    public function ajax_update($id)
    {
        $data = array(
                'nip' => $this->input->post('nip'),
				'ktpu' => $this->input->post('ktpu'),
				'jurusan' => $this->input->post('jurusan'),
				'tanggal' => yyyymmdd($this->input->post('tanggal')),
				'tahun' => yyyy(yyyymmdd($this->input->post('tanggal'))),
				'ijasah' => $this->input->post('ijasah'),
				'sekolah' => $this->input->post('sekolah'),
				'tempat' => $this->input->post('tempat'),
				'updated_id' => $this->session->userdata('userID')
            );
		
        if($this->validation($id)){
            $this->data->update($data, $id);
			helper_log("edit", "Merubah Data Pendidikan");
        }
    }
    
    public function ajax_delete($id)
    {
        $this->data->delete($id);
		helper_log("trash", "Menghapus Data Pendidikan");
        echo json_encode(array("status" => TRUE));
    }
    
    public function ajax_delete_all()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->data->delete($id);
			helper_log("trash", "Menghapus Data Pendidikan");
        }
        echo json_encode(array("status" => TRUE));
    }
	
	public function trash()
    {
        $id = $this->uri->segment(5);
		$nip = $this->uri->segment(4);
		$this->data->delete($id);
		helper_log("trash", "Menghapus Data Pendidikan");
		$this->session->set_flashdata('flashconfirm','Data Pendidikan berhasil di hapus!');
        redirect('data/identitas/'.$nip);
    }
	
	private function validation($id=null)
    {
        //$id = $this->input->post('id');
		$data = array('success' => false, 'messages' => array());
        
		$this->form_validation->set_rules("ktpu", "Tingkat Pendidikan", "trim|required");
		$this->form_validation->set_rules("jurusan", "Jurusan Pendidikan", "trim|required");
		$this->form_validation->set_rules("ijasah", "Nomer Ijasah Pendidikan", "trim|required");
		$this->form_validation->set_rules("tanggal", "Tanggal Ijasah Pendidikan", "trim|required");
		$this->form_validation->set_rules("sekolah", "Nama Sekolah/Perguruan Tingi", "trim|required");
		$this->form_validation->set_rules("tempat", "Kota Lokasi Sekolah/Perguruan Tinggi", "trim|required");
		
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
