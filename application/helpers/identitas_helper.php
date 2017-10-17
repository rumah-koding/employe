<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//data pribadi
if (! function_exists('nama'))
{
	function nama($nip=null)
	{
		$CI =& get_instance();
		$CI->db->where('nip', $nip);
		$query = $CI->db->get('identitas');
        if($query->num_rows() > 0){
			$row = $query->row();
			return gelar($row->gelar1, $row->nama, $row->gelar2);
		}else{
            return FALSE;
        }
	}
}

if (! function_exists('gelar'))
{
	function gelar($gelar1, $nama, $gelar2)
	{
		$var1 = isset($gelar1) && $gelar1 != '' ? $gelar1.'. ' : '';
		$var2 = isset($nama) ? $nama : '';
		$var3 = isset($gelar2) && $gelar2 != '' ? ', '.$gelar2 : '';
		return $var1.$var2.$var3;
	}
}

if (! function_exists('biodata'))
{
	function biodata($nip=null)
	{
		$CI =& get_instance();
		$CI->db->where('nip', $nip);
		$query = $CI->db->get('identitas');
        if($query->num_rows() > 0){
			return $query->row();
		}else{
            return FALSE;
        }
	}
}

//cari agama
if (! function_exists('agama'))
{
	function agama($id=null)
	{
		$CI =& get_instance();
		$CI->db->where('id', $id);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('ref_agama');
        if($query->num_rows() > 0){
			return $query->row()->agama;
		}else{
            return '-';
        }
	}
}

//cari kedudukan
if (! function_exists('kedudukan'))
{
	function kedudukan($id=null)
	{
		$CI =& get_instance();
		$CI->db->where('id', $id);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('ref_kedudukan');
        if($query->num_rows() > 0){
			return $query->row()->kedudukan;
		}else{
            return '-';
        }
	}
}

//cari status
if (! function_exists('status'))
{
	function status($id=null)
	{
		$CI =& get_instance();
		$CI->db->where('id', $id);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('ref_status');
        if($query->num_rows() > 0){
			return $query->row()->status;
		}else{
            return '-';
        }
	}
}

//cari jenis
if (! function_exists('jenis'))
{
	function jenis($kode=null)
	{
		$CI =& get_instance();
		$CI->db->where('kode', $kode);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('ref_jenis');
        if($query->num_rows() > 0){
			return $query->row()->jenis;
		}else{
            return '-';
        }
	}
}

//data cpns
if (! function_exists('cpns'))
{
	function cpns($nip=null)
	{
		$CI =& get_instance();
		$CI->db->where('nip', $nip);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('cpns');
        if($query->num_rows() > 0){
			return $query->row();
		}else{
            return FALSE;
        }
	}
}

//data pns
if (! function_exists('pns'))
{
	function pns($nip=null)
	{
		$CI =& get_instance();
		$CI->db->where('nip', $nip);
		$query = $CI->db->get('pns');
        if($query->num_rows() > 0){
			return $query->row();
		}else{
            return FALSE;
        }
	}
}

//list pangkat
if (! function_exists('pangkat'))
{
	function pangkat($nip=null)
	{
		$CI =& get_instance();
		$CI->db->where('nip', $nip);
		$CI->db->where('deleted_at', null);
		$CI->db->order_by('tmt', 'DESC');
		$query = $CI->db->get('pangkat');
        if($query->num_rows() > 0){
			return $query->result();
		}else{
            return FALSE;
        }
	}
}

//cari golongan
if (! function_exists('gol'))
{
	function gol($kode=null)
	{
		$CI =& get_instance();
		$CI->db->where('kode', $kode);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('ref_pangkat');
        if($query->num_rows() > 0){
			return $query->row()->golongan;
		}else{
            return '-';
        }
	}
}

//cari pangkat
if (! function_exists('pkt'))
{
	function pkt($kode=null)
	{
		$CI =& get_instance();
		$CI->db->where('kode', $kode);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('ref_pangkat');
        if($query->num_rows() > 0){
			return $query->row()->pangkat;
		}else{
            return '-';
        }
	}
}

//cari pangkat
if (! function_exists('eselon'))
{
	function eselon($kode=null)
	{
		$CI =& get_instance();
		$CI->db->where('kode', $kode);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('ref_eselon');
        if($query->num_rows() > 0){
			return $query->row()->jabatan;
		}else{
            return '-';
        }
	}
}

//list jabatan
if (! function_exists('jabatan'))
{
	function jabatan($nip=null)
	{
		$CI =& get_instance();
		$CI->db->where('nip', $nip);
		$CI->db->where('deleted_at', null);
		$CI->db->order_by('tmt', 'DESC');
		$query = $CI->db->get('jabatan');
        if($query->num_rows() > 0){
			return $query->result();
		}else{
            return FALSE;
        }
	}
}

//list pendidikan
if (! function_exists('pendidikan'))
{
	function pendidikan($nip=null)
	{
		$CI =& get_instance();
		$CI->db->where('nip', $nip);
		$CI->db->where('deleted_at', null);
		$CI->db->order_by('ktpu', 'DESC');
		$CI->db->order_by('tahun', 'DESC');
		$query = $CI->db->get('pendidikan');
        if($query->num_rows() > 0){
			return $query->result();
		}else{
            return FALSE;
        }
	}
}

//cari ktpu
if (! function_exists('ktpu'))
{
	function ktpu($ktpu=null)
	{
		$CI =& get_instance();
		$CI->db->where('kode', $ktpu);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('ref_ktpu');
        if($query->num_rows() > 0){
			return $query->row()->ktpu;
		}else{
            return '-';
        }
	}
}

//list diklat
if (! function_exists('diklat'))
{
	function diklat($nip=null)
	{
		$CI =& get_instance();
		$CI->db->where('nip', $nip);
		$CI->db->where('deleted_at', null);
		$CI->db->order_by('jenis', 'ASC');
		$CI->db->order_by('akhir', 'DESC');
		$query = $CI->db->get('diklat');
        if($query->num_rows() > 0){
			return $query->result();
		}else{
            return FALSE;
        }
	}
}

//list ktpu_akhir (pendidikan akhir)
if (! function_exists('ktpu_akhir'))
{
	function ktpu_akhir($nip=null)
	{
		$CI =& get_instance();
		$CI->db->where('nip', $nip);
		$CI->db->where('deleted_at', null);
		$CI->db->limit(1);
		$query = $CI->db->get('pendidikan_akhir');
        if($query->num_rows() > 0){
			return $query->row();
		}else{
            return FALSE;
        }
	}
}

//list pangkat_akhir
if (! function_exists('pangkat_akhir'))
{
	function pangkat_akhir($nip=null)
	{
		$CI =& get_instance();
		$CI->db->where('nip', $nip);
		$CI->db->where('deleted_at', null);
		$CI->db->limit(1);
		$query = $CI->db->get('pangkat_akhir');
        if($query->num_rows() > 0){
			return $query->row();
		}else{
            return FALSE;
        }
	}
}

//list jabatan_akhir
if (! function_exists('jabatan_akhir'))
{
	function jabatan_akhir($nip=null)
	{
		$CI =& get_instance();
		$CI->db->where('nip', $nip);
		$CI->db->where('deleted_at', null);
		$CI->db->limit(1);
		$query = $CI->db->get('jabatan_akhir');
        if($query->num_rows() > 0){
			return $query->row();
		}else{
            return FALSE;
        }
	}
}

//analisa jabatan
if (! function_exists('analisa'))
{
	function analisa($nip=null, $eselon=null, $kode=null, $parent=null)
	{
		if($eselon == '99' || $eselon == ''){
			$CI =& get_instance();
			$CI->db->where('eselon', '41');
			//$CI->db->or_where('eselon', '42');
			$CI->db->where('satker_id', $kode);
			$query = $CI->db->get('jabatan_akhir')->row('nip');
			if($query){
				$bos = $query;
			}else{
				$bos = null;
			}
			
			$pimpinan = pangkat_akhir($bos) ? pangkat_akhir($bos)->gol : 0;
			$pangkat = pangkat_akhir($nip) ? pangkat_akhir($nip)->gol : 0;
			if($pimpinan != 0){
				if($pangkat > $pimpinan){
					return 'Pangkat Lebih Tinggi Dari Pengawas';
				}else{
					return '-';
				}
			}else{
				return '-';
			}
		}else{
			return '-';
		}
	}
}

if (! function_exists('jenis_jabatan'))
{
	function jenis_jabatan($kode=null)
	{
		if($kode == 1){
			$kode = 'STRUKTURAL';
		}elseif($kode == 2){
			$kode = 'JFT';
		}elseif($kode == 3){
			$kode = 'NEGARAWAN';
		}else{
			$kode = 'JFU';
		}
		return $kode;
	}
}

if (! function_exists('sex'))
{
	function sex($id=null)
	{
		if($id == 1){
			$kode = 'LAKI-LAKI';
		}elseif($id == 2){
			$kode = 'PEREMPUAN';
		}else{
			$kode = '-';
		}
		return $kode;
	}
}

if (! function_exists('kawin'))
{
	function kawin($id=null)
	{
		if($id == 1){
			$kode = 'BELUM MENIKAH';
		}elseif($id == 2){
			$kode = 'SUDAH MENIKAH';
		}elseif($id == 3){
			$kode = 'DUDA/JANDA CERAI';
		}elseif($id == 4){
			$kode = 'DUDA/JANDA MENINGGAL';
		}else{
			$kode = '-';
		}
		return $kode;
	}
}