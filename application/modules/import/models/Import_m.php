<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Import_m extends MY_Model
{
    public $table = 'identitas'; 
    public $primary_key = 'id'; 
    public $fillable = array(); 
    public $protected = array();
    
    //ajax datatable
    public  $column_order = array('','',null); //set kolom field database pada datatable secara berurutan
    public  $column_search = array('',''); //set kolom field database pada datatable untuk pencarian
    public  $order = array('id' => 'desc'); //order baku 
    
    public function __construct()
    {
        $this->timestamps = TRUE;
        $this->soft_deletes = TRUE;
        
        parent::__construct();
    }
    
    public $rules = array(
        
    );
	
	public function get_new(){
        $record = new stdClass();
        return $record;
    }
	
	public function get_jabatan($nip=null, $tmt=null)
    {
        $this->db->where('nip', $nip);
        $this->db->where('tmt', $tmt);
        $query = $this->db->get('jabatan');
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return FALSE;
        }
    }

    public function ref_instansi($kode)
    {
        $this->db->where('kode', $kode);
        $this->db->limit(1);
        $query = $this->db->get('ref_instansi');
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return FALSE;
        }
    }

    public function ref_unker($kode)
    {
        $this->db->where('kode', $kode);
        $this->db->limit(1);
        $query = $this->db->get('ref_unker');
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return FALSE;
        }
    }

    public function ref_satker($kode)
    {
        $this->db->where('kode', $kode);
        $this->db->limit(1);
        $query = $this->db->get('ref_satker');
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return FALSE;
        }
    }

    public function ref_jabatan($kode)
    {
        $this->db->where('kode', $kode);
        $this->db->where('deleted_at', NULL);
        $this->db->limit(1);
        $query = $this->db->get('ref_jabatan');
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return FALSE;
        }
    }
}