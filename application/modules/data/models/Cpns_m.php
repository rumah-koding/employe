<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpns_m extends MY_Model
{
	public $table = 'cpns'; // you MUST mention the table name
	public $primary_key = 'id'; // you MUST mention the primary key
	public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
	public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
	
	//ajax datatable
    public $column_order = array('id','nip',null); //set kolom field database pada datatable secara berurutan
    public $column_search = array('nip'); //set kolom field database pada datatable untuk pencarian
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
		$record->sk = '';
		$record->tglsk = '';
		$record->tmt = '';
		$record->gol = '';
		$record->ktpu = '';
        return $record;
    }
	
	//urusan lawan datatable
    private function _get_datatables_query()
    {
        $this->db->from($this->table);
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
        $this->db->where('deleted_at', NULL);
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
	
	function get_nip($nip=null)
    {
        $this->db->where('nip', $nip);
		$this->db->where('deleted_at', NULL);
		$this->db->limit(1);
        $query = $this->db->get($this->table);
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return FALSE;
		}
    }
	
	public function get_gol()
	{
        $query = $this->db->where('deleted_at',NULL)->order_by('kode', 'ASC')->get('ref_pangkat');
        if($query->num_rows() > 0){
        $dropdown[] = 'Pilih Golongan Awal';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->kode] = $row->golongan.' - '.$row->pangkat;
		}
        }else{
            $dropdown[] = 'Belum Ada Golongan Tersedia'; 
        }
		return $dropdown;
	}
	
	public function get_ktpu()
	{
        $query = $this->db->where('deleted_at',NULL)->order_by('kode', 'ASC')->get('ref_ktpu');
        if($query->num_rows() > 0){
        $dropdown[] = 'Pilih Pendidikan Awal';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->kode] = $row->ktpu;
		}
        }else{
            $dropdown[] = 'Belum Ada Tingkat Pendidikan Tersedia'; 
        }
		return $dropdown;
	}

}