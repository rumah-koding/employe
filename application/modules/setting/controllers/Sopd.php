<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sopd extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'setting/sopd/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sopd_m', 'data');
		signin();
		group(array('1'));
	}
	
	//halaman index
	public function index()
	{
		ini_set('memory_limit', '-1');
		$data['head'] 		= 'Daftar Registrasi SOPD';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
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
            $col[] = $row->nip ? $row->nip : '-';
			$col[] = $row->fullname;
			$col[] = $row->username;
			$col[] = '<a href="mailto:'.$row->email.'">'.$row->email.'</a>';
			$col[] = $row->unker;
			$col[] = $row->satker;
			$col[] = level($row->level);
			$col[] = $row->nip;
			$col[] = $row->active ? '<a class="btn btn-xs btn-flat btn-success" href="'.site_url('setting/sopd/active/'.$row->id).'"><i class="fa fa-check-circle-o"></i></a>' : '<a class="btn btn-xs btn-flat btn-danger" href="'.site_url('setting/sopd/active/'.$row->id).'"><i class="fa fa-minus"></i></a>';
            $col[] = $row->dokumen ? '<a class="btn btn-xs btn-flat btn-info" target="_blank" href="'.base_url('document/e-lapkin/'.$row->dokumen).'"><i class="fa fa-file"></i></a>' : '<a class="btn btn-xs btn-flat btn-danger"><i class="fa fa-file"></i></a>';
            
            //add html for action
            
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
    
    public function active($id)
    {
		$find=$this->db->get_where('users', array('id'=>$id, 'deleted_at'=>null))->row();
		
		if($find){
			$active = $find->active == 1 ? 0 : 1;
			$data = array(
					'active' => $active
			);
			
			$this->data->update($data, $id);
			helper_log("edit", "Merubah Aktivasi Registrasi SOPD");
			$this->send_mail($id, $active);
			redirect('setting/sopd');
		}else{
			redirect('setting/sopd');
		}
	}
	
	private function send_mail($id=null, $active=null)
	{
		//Load email library
		$this->load->library('email');
		$this->load->library('encrypt');
		$find=$this->db->get_where('users', array('id'=>$id, 'deleted_at'=>null))->row();
		//SMTP & mail configuration
		$config = array(
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'rifqie@gmail.com',
			'smtp_pass' => 'Handaktahuaj4',
			'mailtype'  => 'html',
			'charset'   => 'utf-8'
		);
		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");

		//Email content
		$htmlContent = '<h3>Data Aktivasi SOPD SIMPEG KALSEL</h3>';
		if($active == 1){
			$htmlContent .= '<p>Anda telah mendaftarkan diri anda atas nama '.$find->fullname.' dengan nip '.$find->nip.' pada SIMPEG KALSEL yang pada saat ini telah AKTIF.</p>';
			$htmlContent .= '<p>Jika anda belum dapat melakukan akses pada halaman login https://simpeg.kalselprov.go.id hubungi administrator.</p>';
		}else{
			$htmlContent .= '<p>Anda telah mendaftarkan diri anda atas nama '.$find->fullname.' dengan nip '.$find->nip.' pada SIMPEG KALSEL yang pada saat ini telah NON AKTIF.</p>';
			$htmlContent .= '<p>Jika anda ingin dapat melakukan akses pada halaman login https://simpeg.kalselprov.go.id hubungi administrator.</p>';
		}
		

		$this->email->to($find->email);
		$this->email->from('rifqie.rusyadi@gmail.com','SIMPEG KALSEL');
		$this->email->subject('Data Registrasi SOPD SIMPEG KALSEL');
		$this->email->message($htmlContent);
		//Send email
		$this->email->send();
	}

}