<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satker_m extends MY_Model
{
	public $table = 'ref_satker'; // you MUST mention the table name
	public $primary_key = 'id'; // you MUST mention the primary key
	public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
	public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
	
	//ajax datatable
    public $column_order = array('c.id','c.kode','c.satker','b.unker','a.instansi',null); //set kolom field database pada datatable secara berurutan
    public $column_search = array('c.kode','c.satker','b.unker','a.instansi'); //set kolom field database pada datatable untuk pencarian
    public $order = array('a.unker_id' => 'ASC','c.kode' => 'ASC'); //order baku 
	
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
		$record->kode = '';
		$record->instansi_id = '';
		$record->unker_id = '';
		$record->parent_id = '';
		$record->satker = '';
		$record->upt = '';
		$record->alamat = '';
		$record->email = '';
		$record->telpon = '';
        return $record;
    }
	
	//urusan lawan datatable
    private function _get_datatables_query()
    {
        $this->db->select('a.instansi, b.unker, c.*');
		$this->db->from('ref_satker c');
		$this->db->join('ref_instansi a','a.kode = c.instansi_id','LEFT');
		$this->db->join('ref_unker b','b.kode = c.unker_id','LEFT');
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
        $this->db->where('c.deleted_at', NULL);
		$this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
	
	function get_id($id=null)
    {
        $this->db->where('id', $id);
		$this->db->where('deleted_at', NULL);
        $query = $this->db->get($this->table);
		if($query->num_rows() > 0){
			return $query->row();	
		}else{
			//show_404();
			return FALSE;
		}
        
    }
	
	public function get_instansi()
	{
        $query = $this->db->where('deleted_at',NULL)->order_by('kode', 'ASC')->get('ref_instansi');
        if($query->num_rows() > 0){
        $dropdown[] = 'Pilih instansi Kerja';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->kode] = $row->kode.' - '.$row->instansi;
		}
        }else{
            $dropdown[] = 'Belum Ada Instansi Tersedia'; 
        }
		return $dropdown;
	}
	
	public function get_unker($instansi=null)
	{
		$this->db->where('deleted_at',NULL);
        $this->db->where('instansi', $instansi);
        $query = $this->db->order_by('kode', 'ASC')->get('ref_unker');
        if($query->num_rows() > 0){
        $dropdown[] = 'Pilih Unit Kerja';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->kode] = $row->kode.' - '.$row->unker;
		}
        }else{
            $dropdown[] = 'Belum Ada Unit Kerja Tersedia';
        }
		return $dropdown;
	}
	
	public function get_parent($instansi=null, $unker=null)
	{
		$this->db->where('deleted_at',NULL);
        $this->db->where('instansi_id', $instansi);
		$this->db->where('unker_id', $unker);
        $query = $this->db->order_by('kode', 'ASC')->get('ref_satker');
        if($query->num_rows() > 0){
        $dropdown[] = 'Pilih Satuan Kerja Induk';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->kode] = $row->kode.' - '.$row->satker;
		}
        }else{
            $dropdown[] = 'Belum Ada Satuan Kerja Induk Tersedia';
        }
		return $dropdown;
	}
	
	public function get_kode() {
		$query = $this->db->query("SELECT MAX(RIGHT(kode,5)) AS kode FROM simpeg_ref_satker");
		$kode = "";
	  
		if($query->num_rows() > 0){ 
			  foreach($query->result() as $k){
				  $tmp = ((int)$k->kode)+1;
				  $kode = sprintf("%05s", $tmp);
			  }
		 }else{
		  $kode = "00001";
		}
		$karakter = "S"; 
		return $karakter.$kode;
    }

//   
//	function get_record(){
//		$query = $this->db->order_by('kode','ASC')->get($this->table);
//		if($query->num_rows() > 0){
//		   return $query->result();
//		}else{
//		   return FALSE;
//		}
//	}
//	
//	function get_parent(){
//		$query = $this->db->order_by('kodex','ASC')->get($this->table);
//		if($query->num_rows() > 0){
//		   return $query->result();
//		}else{
//		   return FALSE;
//		}
//	}
//	
//	function get_parent_id($id){
//		$query = $this->db->where('id',$id)->get($this->table);
//		if($query->num_rows() > 0){
//		   return $query->row()->kodex;
//		}else{
//		   return FALSE;
//		}
//	}
}