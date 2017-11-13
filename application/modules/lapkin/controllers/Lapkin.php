<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lapkin extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	public $folder = 'lapkin/lapkin/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('lapkin_m', 'data');
		require_once APPPATH."libraries/PHPExcel.php";
        require_once APPPATH."libraries/PHPExcel/IOFactory.php";
		signin();
		group(array('4'));
	}
	
	public function index()
	{
		$data['head'] 		= 'E-Lapkin';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view('template/default', $data);
	}
	
	public function created()
	{
		$data['head'] 		= 'Upload Dokumen E-Lapkin';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['unker'] 		= $this->data->get_unker();
		$data['tahun'] 		= $this->data->get_tahun();
		
		$this->load->view('template/default', $data);
	}

	public function detail()
	{
		$data['head'] 		= 'Upload Dokumen E-Lapkin';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'detail';
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
            $col[] = $row->nama;
			$col[] = $row->nip;
			$col[] = $row->jabatan;
			$col[] = $row->unker;
			$col[] = $row->satker;
			$col[] = $row->skp;
			$col[] = $row->pelayanan;
			$col[] = $row->integritas;
			$col[] = $row->komitmen;
			$col[] = $row->disiplin;
			$col[] = $row->kerjasama;
			$col[] = $row->kepemimpinan;
			$col[] = $row->tahun;
			
            
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
	
	public function get_satker(){
        $record = $this->data->get_id($this->uri->segment(4));
		$unker = $this->input->post('unker');
        $satker = $this->data->get_satker($unker);
        if(!empty($satker)){
            //$selected = (set_value('parent')) ? set_value('parent') : '';
			$selected = set_value('satker', $record->satker_id);
            echo form_dropdown('satker', $satker, $selected, "class='form-control select2' name='satker' id='satker'");
        }else{
            echo form_dropdown('satker', array(''=>'Pilih Satuan Kerja'), '', "class='form-control select2' name='satker' id='satker'");
        }
	}
	
	public function upload_data(){
        $fileName = time().'_'.$_FILES['file']['name'];
         
        $config['upload_path'] = './document/e-lapkin/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = 50000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
         
        if(! $this->upload->do_upload('file')) $this->upload->display_errors();
            
            $media = $this->upload->data();
            $inputFileName = './document/e-lapkin/'.$media['file_name'];
			
            $objPHPExcel = new PHPExcel(); 
            try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
        
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
			 
			$find = $this->db->get_where('lapkin', array('tahun'=>$this->input->post('tahun'),'unker_id'=> $this->session->userdata('unker'), 'satker_id'=>$this->session->userdata('satker')))->result();
			if($find){
				$this->db->delete('lapkin', array('tahun'=>$this->input->post('tahun'),'unker_id'=> $this->session->userdata('unker'), 'satker_id'=>$this->session->userdata('satker')));
			}
			
			for ($row = 4; $row <= $highestRow; $row++){ //  Read a row of data into an array                 
                
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL,TRUE,FALSE);
                //Sesuaikan sama nama kolom tabel di database                                
                $limit = 1;
                
                $data = array(
                    "nama"=> $rowData[0][1],
					"nip"=> $rowData[0][2],
					"jabatan"=> $rowData[0][3],
					"unker"=> $rowData[0][4],
					"satker"=> $rowData[0][5],
					"skp"=> $rowData[0][6],
					"pelayanan"=> $rowData[0][7],
					"integritas"=> $rowData[0][8],
					"komitmen"=> $rowData[0][9],
					"disiplin"=> $rowData[0][10],
					"kerjasama"=> $rowData[0][11],
					"kepemimpinan"=> $rowData[0][12],
					"unker_id" => $this->session->userdata('unker'),
					"satker_id" => $this->session->userdata('satker'),
					"tahun" => $this->input->post('tahun'),
					"dokumen" => $media['file_name']
                );
                 
                //sesuaikan nama dengan nama tabel
				$insert = $this->db->insert('lapkin', $data);
				
                //delete_files($media['file_path']);
				//unlink($inputFileName);
				if (file_exists($inputFileName)) unlink($inputFileName);
            }   
        
		$this->session->set_flashdata('flashconfirm','Data berhasil di import');
        redirect('lapkin');
    }
}
