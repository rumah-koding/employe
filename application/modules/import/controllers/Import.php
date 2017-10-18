<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {
    
    /**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
    public $folder = 'import/';
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('import_m','data');
        $this->load->helper('my_helper');
        //$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
        require_once APPPATH."libraries/PHPExcel.php";
        require_once APPPATH."libraries/PHPExcel/IOFactory.php";
    }

    //Menampilkan data kontak
    function index() {
        echo 'hallo';
    }

    public function jabatan()
	{
        $data['head'] 		= 'Import Data Excel - JABATAN';
		$data['record'] 	= $this->data->get_new();
		$data['content'] 	= $this->folder.'jabatan';
		
        $this->load->view('template/default', $data);
    }
    
    public function upload_jabatan(){
        $fileName = time().'_'.$_FILES['file']['name'];
         
        $config['upload_path'] = './source/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
         
        if(! $this->upload->do_upload('file')) $this->upload->display_errors();
            
            $media = $this->upload->data();
            $inputFileName = './source/'.$media['file_name'];
			
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
             
            for ($row = 2; $row <= $highestRow; $row++){ //  Read a row of data into an array                 
                
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL,TRUE,FALSE);
                //Sesuaikan sama nama kolom tabel di database                                
                $limit = 1;
                $instansi =  $this->data->ref_instansi($rowData[0][1]);
                $unker =  $this->data->ref_unker($rowData[0][2]);
                $satker =  $this->data->ref_satker($rowData[0][3]);
                $jabatan =  $this->data->ref_jabatan($rowData[0][4]);
                
                $data = array(
                    "nip"=> $rowData[0][0],
                    "instansi_id"=> $rowData[0][1],
                    "instansi"=> $instansi ? $instansi['instansi'] : NULL,
                    "unker_id"=> $rowData[0][2],
                    "unker"=> $unker ? $unker['unker'] : NULL,
					"satker_id"=> $rowData[0][3],
					"satker"=> $satker ? $satker['satker'] : NULL,
					"jabatan_id"=> $rowData[0][4],
					"jabatan"=> $jabatan ? $jabatan['jabatan'] : NULL,
                    "tmt"=> $rowData[0][5],
                    "eselon"=> $rowData[0][6]
                );
                 
                //sesuaikan nama dengan nama tabel
				$find = $this->data->get_jabatan($data['nip'], $data['tmt']);
				
				if($find){
					$field['nip'] = $find['nip'] == 'NULL' || $find['nip'] == '' ? $data['nip'] : $find['nip'];
					$field['instansi_id'] = $find['instansi_id'] == 'NULL' || $find['instansi_id'] == '' ? $data['instansi_id'] : $find['instansi_id'];
					$field['instansi'] = $find['instansi'] == 'NULL' || $find['instansi'] == '' ? $data['instansi'] : $find['instansi'];
					$field['unker_id'] = $find['unker_id'] == 'NULL' || $find['unker_id'] == '' ? $data['unker_id'] : $find['unker_id'];
					$field['unker'] = $find['unker'] == 'NULL' || $find['unker'] == '' ? $data['unker'] : $find['unker'];
					$field['satker_id'] = $find['satker_id'] == 'NULL' || $find['satker_id'] == '' ? $data['satker_id'] : $find['satker_id'];
					$field['satker'] = $find['satker'] == 'NULL' || $find['satker'] == '' ? $data['satker'] : $find['satker'];
					$field['jabatan_id'] = $find['jabatan_id'] == 'NULL' || $find['jabatan_id'] == '' ? $data['jabatan_id'] : $find['jabatan_id'];
					$field['jabatan'] =$find['jabatan'] == 'NULL' || $find['jabatan'] == '' ? $data['jabatan'] : $find['jabatan'];
					$field['tmt'] = $find['tmt'] == 'NULL' || $find['tmt'] == '' ? $data['tmt'] : $find['tmt'];
					$field['eselon'] = $find['eselon'] == 'NULL' || $find['eselon'] == '' ? $data['eselon'] : $find['eselon'];
					
					$this->db->where('id', $find['id']);
					$update = $this->db->update('jabatan', $field);
				}else{
					$insert = $this->db->insert('jabatan', $data);
				}
                
                //delete_files($media['file_path']);
				//unlink($inputFileName);
				if (file_exists($inputFileName)) unlink($inputFileName);
            }   
        
		$this->session->set_flashdata('flashconfirm','Data berhasil di import');
        redirect('import/jabatan');
    }
}
?>