<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'data/pegawai/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pegawai_m', 'data');
		$this->load->helper('identitas_helper');
		$this->load->helper('my_helper');
		$this->session->unset_userdata('nip');
		signin();
		group(array('1','2','4'));
		
	}
	
	//halaman index
	public function index()
	{
		$data['head'] 		= 'Data Pegawai';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view('template/default', $data);
	}
	
	public function created()
	{
		$data['head'] 		= 'Tambah Data Pegawai';
		$data['record'] 	= $this->data->get_new();
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['agama'] 		= $this->data->get_agama();
		$data['status'] 	= $this->data->get_status();
		$data['kedudukan'] 	= $this->data->get_kedudukan();
		$data['jenis'] 		= $this->data->get_jenis();
		
		$this->load->view('template/default', $data);
	}
	
	public function updated($id)
	{
		$data['head'] 		= 'Ubah Data Pegawai';
		$data['record'] 	= $this->data->get_id($id);
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['agama'] 		= $this->data->get_agama();
		$data['status'] 	= $this->data->get_status();
		$data['kedudukan'] 	= $this->data->get_kedudukan();
		$data['jenis'] 		= $this->data->get_jenis();
		
		$this->load->view('template/default', $data);
	}
	
	public function ajax_list()
    {
        ini_set('memory_limit', '-1');
		$record	= $this->data->get_datatables();
        $data 	= array();
        $no 	= $_POST['start'];
		
        foreach ($record as $row) {
            $no++;
            $col = array();
            $col[] = '<input type="checkbox" class="data-check" value="'.$row->id.'">';
            $col[] = $row->nip;
			$col[] = $row->nama;
			$col[] = $row->status;
			$col[] = $row->kedudukan;
			$col[] = $row->jenis;
            
            //add html for action
            $col[] = '<a class="btn btn-xs btn-flat btn-info" onclick="#" href="'.site_url('data/identitas/'.$row->nip).'" data-toggle="tooltip" title="View"><i class="glyphicon glyphicon-user"></i></a> <a class="btn btn-xs btn-flat btn-warning" onclick="edit_data();" href="'.site_url('data/pegawai/updated/'.$row->id).'" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                  <a class="btn btn-xs btn-flat btn-danger" data-toggle="tooltip" title="Hapus" onclick="deleted('."'".$row->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
 
            $data[] = $col;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->data->count_all(),
                        "recordsFiltered" => $this->data->count_filtered(),
                        "data" => $data,
                );
        
		echo json_encode($output);
    }
	
	public function ajax_save()
    {
        $data = array(
                'nip' => $this->input->post('nip'),
				'nama' => $this->input->post('nama'),
				'gelar1' => $this->input->post('gelar1'),
				'gelar2' => $this->input->post('gelar2'),
				'tmlahir' => $this->input->post('tmlahir'),
				'tglahir' => yyyymmdd($this->input->post('tglahir')),
				'sex' => $this->input->post('sex'),
				'agama_id' => $this->input->post('agama_id'),
				'darah' => $this->input->post('darah'),
				'kawin' => $this->input->post('kawin'),
				'status_id' => $this->input->post('status_id'),
				'kedudukan_id' => $this->input->post('kedudukan_id'),
				'jenis_id' => $this->input->post('jenis_id'),
				'profesi' => $this->input->post('profesi'),
				'alamat' => $this->input->post('alamat'),
				'kodepos' => $this->input->post('kodepos'),
				'telpon' => $this->input->post('telpon'),
				'email' => $this->input->post('email'),
				'ktp' => $this->input->post('ktp'),
				'karpeg' => $this->input->post('karpeg'),
				'bpjs' => $this->input->post('bpjs'),
				'karis' => $this->input->post('karis'),
				'taspen' => $this->input->post('taspen'),
				'npwp' => $this->input->post('npwp'),
				'created_id' => $this->session->userdata('userID')
            );
        
        if($this->validation()){
            $insert = $this->data->insert($data);
			helper_log("add", "Menambah Data Pegawai");
        }
    }
    
    public function ajax_update($id)
    {
         $id = $this->uri->segment(4);
		 $data = array(
                'nama' => $this->input->post('nama'),
				'gelar1' => $this->input->post('gelar1'),
				'gelar2' => $this->input->post('gelar2'),
				'tmlahir' => $this->input->post('tmlahir'),
				'tglahir' => yyyymmdd($this->input->post('tglahir')),
				'sex' => $this->input->post('sex'),
				'agama_id' => $this->input->post('agama_id'),
				'darah' => $this->input->post('darah'),
				'kawin' => $this->input->post('kawin'),
				'status_id' => $this->input->post('status_id'),
				'kedudukan_id' => $this->input->post('kedudukan_id'),
				'jenis_id' => $this->input->post('jenis_id'),
				'profesi' => $this->input->post('profesi'),
				'alamat' => $this->input->post('alamat'),
				'kodepos' => $this->input->post('kodepos'),
				'telpon' => $this->input->post('telpon'),
				'email' => $this->input->post('email'),
				'ktp' => $this->input->post('ktp'),
				'karpeg' => $this->input->post('karpeg'),
				'bpjs' => $this->input->post('bpjs'),
				'karis' => $this->input->post('karis'),
				'taspen' => $this->input->post('taspen'),
				'npwp' => $this->input->post('npwp'),
				'updated_id' => $this->session->userdata('userID')
            );
		
        if($this->validation($id)){
            $this->data->update($data, $id);
			helper_log("edit", "Merubah Data Pegawai");
        }
    }
    
    public function ajax_delete($id)
    {
        $this->data->delete($id);
		helper_log("trash", "Menghapus Data Pegawai");
        echo json_encode(array("status" => TRUE));
    }
    
    public function ajax_delete_all()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->data->delete($id);
			helper_log("trash", "Menghapus Data Pegawai");
        }
        echo json_encode(array("status" => TRUE));
    }
	
	private function validation($id=null)
    {
        //$id = $this->input->post('id');
		$data = array('success' => false, 'messages' => array());
        
		if(!isset($id)){
			$this->form_validation->set_rules("nip", "NIP", "trim|required|is_unique[identitas.nip]");
			$this->form_validation->set_rules("nama", "Nama Lengkap", "trim|required");
			$this->form_validation->set_rules("gelar1", "Gelar Depan", "trim");
			$this->form_validation->set_rules("gelar2", "Gelar Belakang", "trim");
			$this->form_validation->set_rules("tmlahir", "Tempat Lahir", "trim|required");
			$this->form_validation->set_rules("tglahir", "Tanggal Lahir", "trim|required");
			$this->form_validation->set_rules("sex", "Jenis Kelamin", "trim|required");
			$this->form_validation->set_rules("agama_id", "Agama", "trim|required");
			$this->form_validation->set_rules("darah", "Golongan Darah", "trim");
			$this->form_validation->set_rules("kawin", "Status Perkawinan", "trim|required");
			$this->form_validation->set_rules("status_id", "Status Pegawai", "trim|required");
			$this->form_validation->set_rules("kedudukan_id", "Kedudukan Pegawai", "trim|required");
			$this->form_validation->set_rules("jenis_id", "Jenis Pegawai", "trim|required");
			$this->form_validation->set_rules("profesi", "Profesi", "trim");
			$this->form_validation->set_rules("alamat", "Alamat Tinggal", "trim|required");
			$this->form_validation->set_rules("kodepos", "Kodepos", "trim|required");
			$this->form_validation->set_rules("telpon", "Telpon", "trim|required");
			$this->form_validation->set_rules("email", "Email", "trim|required");
			$this->form_validation->set_rules("karpeg", "Karpeg", "trim");
			$this->form_validation->set_rules("ktp", "Kartu Penduduk", "trim");
			$this->form_validation->set_rules("taspen", "Taspen", "trim");
			$this->form_validation->set_rules("karis", "Karis / Karsu", "trim");
			$this->form_validation->set_rules("npwp", "NPWP", "trim");
			$this->form_validation->set_rules("bpjs", "BPJS", "trim");
		}else{
			$this->form_validation->set_rules("nama", "Nama Lengkap", "trim|required");
			$this->form_validation->set_rules("gelar1", "Gelar Depan", "trim");
			$this->form_validation->set_rules("gelar2", "Gelar Belakang", "trim");
			$this->form_validation->set_rules("tmlahir", "Tempat Lahir", "trim|required");
			$this->form_validation->set_rules("tglahir", "Tanggal Lahir", "trim|required");
			$this->form_validation->set_rules("sex", "Jenis Kelamin", "trim|required");
			$this->form_validation->set_rules("agama_id", "Agama", "trim|required");
			$this->form_validation->set_rules("darah", "Golongan Darah", "trim");
			$this->form_validation->set_rules("kawin", "Status Perkawinan", "trim|required");
			$this->form_validation->set_rules("status_id", "Status Pegawai", "trim|required");
			$this->form_validation->set_rules("kedudukan_id", "Kedudukan Pegawai", "trim|required");
			$this->form_validation->set_rules("jenis_id", "Jenis Pegawai", "trim|required");
			$this->form_validation->set_rules("profesi", "Profesi", "trim");
			$this->form_validation->set_rules("alamat", "Alamat Tinggal", "trim|required");
			$this->form_validation->set_rules("kodepos", "Kodepos", "trim|required");
			$this->form_validation->set_rules("telpon", "Telpon", "trim|required");
			$this->form_validation->set_rules("email", "Email", "trim|required");
			$this->form_validation->set_rules("karpeg", "Karpeg", "trim");
			$this->form_validation->set_rules("ktp", "Kartu Penduduk", "trim");
			$this->form_validation->set_rules("taspen", "Taspen", "trim");
			$this->form_validation->set_rules("karis", "Karis / Karsu", "trim");
			$this->form_validation->set_rules("npwp", "NPWP", "trim");
			$this->form_validation->set_rules("bpjs", "BPJS", "trim");
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
