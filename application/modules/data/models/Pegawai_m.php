<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_m extends MY_Model
{
	public $table = 'identitas'; // you MUST mention the table name
	public $primary_key = 'id'; // you MUST mention the primary key
	public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
	public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
	
	//ajax datatable
    public $column_order = array('id','nip','nama','status','kedudukan','jenis',null); //set kolom field database pada datatable secara berurutan
    public $column_search = array('nip','nama','status','kedudukan','jenis'); //set kolom field database pada datatable untuk pencarian
    public $order = array('nip' => 'asc'); //order baku 
	
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
		$record->nama = '';
		$record->gelar1 = '';
		$record->gelar2 = '';
		$record->tmlahir = '';
		$record->tglahir = '';
		$record->sex = '';
		$record->agama_id = '';
		$record->darah = '';
		$record->kawin = '';
		
		$record->status_id = '';
		$record->kedudukan_id = '';
		$record->jenis_id = '';
		$record->profesi = '';
		
		$record->alamat = '';
		$record->kodepos = '';
		$record->telpon = '';
		$record->email = '';
		
		$record->karpeg = '';
		$record->bpjs = '';
		$record->karis = '';
		$record->taspen = '';
		$record->npwp = '';
		$record->ktp = '';
        return $record;
    }
	
	//urusan lawan datatable
    private function _get_datatables_query()
    {
        $this->db->select('a.status, b.kedudukan, c.jenis, d.* ');
		$this->db->from('identitas d');
		$this->db->join('ref_status a','a.id = d.status_id','LEFT');
		$this->db->join('ref_kedudukan b','b.id = d.kedudukan_id','LEFT');
		$this->db->join('ref_jenis c','c.id = d.jenis_id','LEFT');
		
		//$this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    //urusan lawan ambil data
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->where('d.deleted_at', NULL);
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
	
	function get_id($id=null)
    {
        $this->db->where('id', $id);
		$this->db->where('deleted_at', NULL);
        $query = $this->db->get($this->table);
        return $query->row();
    }
	
	public function get_agama()
	{
        $query = $this->db->where('deleted_at',NULL)->order_by('id', 'ASC')->get('ref_agama');
        if($query->num_rows() > 0){
        $dropdown[''] = 'Pilih Agama/Kepercayaan';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->id] = $row->agama;
		}
        }else{
            $dropdown[''] = 'Belum Ada Agama Tersedia'; 
        }
		return $dropdown;
	}
	
	public function get_status()
	{
        $query = $this->db->where('deleted_at',NULL)->order_by('status', 'ASC')->get('ref_status');
        if($query->num_rows() > 0){
        $dropdown[''] = 'Pilih Status Pegawai';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->id] = $row->status;
		}
        }else{
            $dropdown[''] = 'Belum Ada Status Tersedia'; 
        }
		return $dropdown;
	}

	public function get_kedudukan()
	{
        $query = $this->db->where('deleted_at',NULL)->order_by('id', 'ASC')->get('ref_kedudukan');
        if($query->num_rows() > 0){
        $dropdown[''] = 'Pilih Kedudukan Pegawai';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->id] = $row->kedudukan;
		}
        }else{
            $dropdown[''] = 'Belum Ada Kedudukan Tersedia'; 
        }
		return $dropdown;
	}
	
	public function get_jenis()
	{
        $query = $this->db->where('deleted_at',NULL)->order_by('id', 'ASC')->get('ref_jenis');
        if($query->num_rows() > 0){
        $dropdown[''] = 'Pilih Jenis Pegawai';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->kode] = $row->jenis;
		}
        }else{
            $dropdown[''] = 'Belum Ada Jenis Tersedia'; 
        }
		return $dropdown;
	}
}