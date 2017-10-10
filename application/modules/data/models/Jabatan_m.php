<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan_m extends MY_Model
{
	public $table = 'jabatan'; // you MUST mention the table name
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
		$record->instansi_id = '';
		$record->instansi = '';
		$record->unker_id = '';
		$record->unker = '';
		$record->satker_id = '';
		$record->satker = '';
		$record->jenis = '';
		$record->jabatan_id = '';
		$record->jabatan = '';
		$record->sk = '';
		$record->tglsk = '';
		$record->tmt = '';
		$record->eselon = '';
		$record->penetapan = '';
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
	
	public function get_satker($instansi=null, $unker=null)
	{
		$this->db->where('deleted_at',NULL);
        $this->db->where('instansi_id', $instansi);
		$this->db->where('unker_id', $unker);
        $query = $this->db->order_by('kode', 'ASC')->get('ref_satker');
        if($query->num_rows() > 0){
        $dropdown[] = 'Pilih Satuan Kerja';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->kode] = $row->kode.' - '.$row->satker;
		}
        }else{
            $dropdown[] = 'Belum Ada Satuan Kerja Tersedia';
        }
		return $dropdown;
	}
	
	public function get_eselon()
	{
        $query = $this->db->where('deleted_at',NULL)->order_by('kode', 'ASC')->get('ref_eselon');
        if($query->num_rows() > 0){
        $dropdown[] = 'Pilih Tingkat Jabatan';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->kode] = $row->eselon.' - '.$row->jabatan;
		}
        }else{
            $dropdown[] = 'Belum Ada Tingkat Jabatan'; 
        }
		return $dropdown;
	}
	
	public function get_jabatan($instansi=null, $unker=null, $satker=null, $jenis=null)
	{
		$this->db->where('deleted_at',NULL);
        $this->db->where('instansi_id', $instansi);
		if($jenis == 1):
			$this->db->where('unker_id', $unker);
			$this->db->where('satker_id', $satker);
			$this->db->where('jenis', $jenis);
		else:
			$this->db->where('unker_id', '00');
			$this->db->where('satker_id', 'S00001');
			$this->db->where('jenis', $jenis);
		endif;
		$query = $this->db->order_by('kode', 'ASC')->get('ref_jabatan');
        if($query->num_rows() > 0){
        $dropdown[] = 'Pilih jabatan';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->kode] = $row->kode.' - '.$row->jabatan;
		}
        }else{
            $dropdown[] = 'Belum Ada Jabatan Tersedia';
        }
		return $dropdown;
	}
	
	//function get_record_satker(){
	//	$this->db->where('satker_id !=', '');
	//	$query = $this->db->order_by('satker_id','ASC')->get($this->table);
	//	if($query->num_rows() > 0){
	//	   return $query->result();
	//	}else{
	//	   return FALSE;
	//	}
	//}
	//
	//function get_record_jabatan(){
	//	$this->db->where('posisi_id !=', '');
	//	$query = $this->db->order_by('posisi_id','ASC')->get($this->table);
	//	if($query->num_rows() > 0){
	//	   return $query->result();
	//	}else{
	//	   return FALSE;
	//	}
	//}
	//
	//function get_satker_id($id){
	//	$query = $this->db->where('kode',$id)->get('ref_satker');
	//	if($query->num_rows() > 0){
	//	   return $query->row()->kodex;
	//	}else{
	//	   return FALSE;
	//	}
	//}
	//
	//function get_jabatan_id($id){
	//	$query = $this->db->where('kode',$id)->get('ref_jabatan');
	//	if($query->num_rows() > 0){
	//	   return $query->row()->kodex;
	//	}else{
	//	   return FALSE;
	//	}
	//}
}