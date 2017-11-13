<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sopd_m extends MY_Model
{
	public $table = 'users'; // you MUST mention the table name
	public $primary_key = 'id'; // you MUST mention the primary key
	public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
	public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
	
	//ajax datatable
    public $column_order = array(null); //set kolom field database pada datatable secara berurutan
    public $column_search = array(); //set kolom field database pada datatable untuk pencarian
    public $order = array('id' => 'asc'); //order baku 
	
	public function __construct()
	{
		$this->timestamps = TRUE;
		$this->soft_deletes = TRUE;
		parent::__construct();
	}
	
	public function get_new()
    {
        $record = new stdClass();
        $record->id = '';
		$record->nip = '';
		$record->username = '';
		$record->password = '';
		$record->repassword = '';
		$record->fullname = '';
		$record->email = '';
		$record->telpon = '';
		$record->unker_id = '';
		$record->satker_id = '';
		$record->level = '';
		$record->active = '';
        return $record;
    }
	
	public function get_unker()
	{
        $this->db->where('kode !=','00');
        $this->db->where('deleted_at',NULL);
        $query = $this->db->order_by('kode', 'ASC')->get('ref_unker');
        if($query->num_rows() > 0){
        $dropdown[''] = 'Pilih Unit Kerja';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->kode] = $row->kode.' - '.$row->unker;
		}
        }else{
            $dropdown[''] = 'Belum Ada Unit Kerja Tersedia';
        }
		return $dropdown;
	}
	
	public function get_satker($unker=null)
	{
        $query = $this->db->query("SELECT kode, satker FROM simpeg_view_satker WHERE unker_id = '{$unker}' AND (parent_id IS NULL OR upt = 1) ORDER BY kode ASC");
        //$this->db->where('parent_id',NULL);
        //$this->db->where('unker_id', $unker);
        //$query = $this->db->order_by('kode', 'ASC')->get('view_satker');
        if($query->num_rows() > 0){
        $dropdown[''] = 'Pilih Satuan Kerja';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->kode] = $row->kode.' - '.$row->satker;
		} 
        }else{
            $dropdown[''] = 'Belum Ada Satuan Kerja Tersedia';
        }
		return $dropdown;
	}
	
	public function insert_data($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

}