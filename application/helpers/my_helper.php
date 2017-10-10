<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//untuk menghilangkan tanda , pada number
if (! function_exists('replacecoma'))
{
	function replacecoma($number)
	{
		return str_replace(',','',$number);
	}
}

// untuk menghilangkan tanda . pada number
if (! function_exists('replacedot'))
{
	function replacedot($number)
	{
		return str_replace('.','',$number);
	}
}

// untuk memotong paragraf ketika ketemu <!--more-->
if (! function_exists('readmore'))
{
	function readmore($article)
	{
		$i = strpos($article,'<!--more-->');
		if($i !== FALSE){
			$i += strlen('<!--more-->');
			return substr($article, 0, $i);
		}else{
			return $article;
		}
	}
}

// untuk tanggal indonesia 01 Januari 2015
if ( ! function_exists('ddMMMyyyy'))
{
	function ddMMMyyyy($tgl)
	{
		if($tgl != null){
			$ubah = date("Y-m-d", strtotime($tgl));
			$pecah = explode("-",$ubah);
			$tanggal = $pecah[2];
			$bulan = bulan($pecah[1]);
			$tahun = $pecah[0];
			return strtoupper($tanggal.' '.$bulan.' '.$tahun);
		}
	}
}

// untuk tanggal indonesia 31-12-2015
if ( ! function_exists('ddmmyyyy'))
{
	function ddmmyyyy($tgl)
	{
		if($tgl != null){
			$ubah = date("Y-m-d", strtotime($tgl));
			$pecah = explode("-",$ubah);
			$tanggal = $pecah[2];
			$bulan = $pecah[1];
			$tahun = $pecah[0];
			return $tanggal.'-'.$bulan.'-'.$tahun;
		}
	}
}

// untuk tanggal standart iso 2015-12-31
if ( ! function_exists('yyyymmdd'))
{
	function yyyymmdd($tgl)
	{
		if($tgl != null){
			$ubah = gmdate($tgl, time()+60*60*8);
			$pecah = explode("-",$ubah);
			$tanggal = $pecah[0];
			$bulan = $pecah[1];
			$tahun = $pecah[2];
			return $tahun.'-'.$bulan.'-'.$tanggal;
		}
	}
}

// untuk tanggal saja
if ( ! function_exists('dd'))
{
	function dd($tgl)
	{
		if($tgl != null){
			$ubah = date("Y-m-d", strtotime($tgl));
			$pecah = explode("-",$ubah);
			$tanggal = $pecah[2];
			$bulan = $pecah[1];
			$tahun = $pecah[0];
			return number_format($tanggal);
		}
	}
}

// untuk bulan saja
if ( ! function_exists('mm'))
{
	function mm($tgl)
	{
		if($tgl != null){
			$ubah = date("Y-m-d", strtotime($tgl));
			$pecah = explode("-",$ubah);
			$tanggal = $pecah[2];
			$bulan = $pecah[1];
			$tahun = $pecah[0];
			return number_format($bulan);
		}
	}
}

// untuk tahun saja
if ( ! function_exists('yyyy'))
{
	function yyyy($tgl)
	{
		if($tgl != null){
			$ubah = date("Y-m-d", strtotime($tgl));
			$pecah = explode("-",$ubah);
			$tanggal = $pecah[2];
			$bulan = $pecah[1];
			$tahun = $pecah[0];
			return $tahun;
		}
	}
}

// untuk bulan bahasa indonesia
if ( ! function_exists('bulan'))
{
	function bulan($bln)
	{
		switch ($bln)
		{
			case 1:
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	}
}


// untuk nama hari
if ( ! function_exists('hari'))
{
	function hari($tanggal)
	{
		//$ubah = gmdate($tanggal, time()+60*60*8);
		$ubah = date("Y-m-d", strtotime($tanggal));
		$pecah = explode("-",$ubah);
		$tgl = $pecah[2];
		$bln = $pecah[1];
		$thn = $pecah[0];

		$nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
		$nama_hari = "";
		if($nama=="Sunday") {$nama_hari="Minggu";}
		else if($nama=="Monday") {$nama_hari="Senin";}
		else if($nama=="Tuesday") {$nama_hari="Selasa";}
		else if($nama=="Wednesday") {$nama_hari="Rabu";}
		else if($nama=="Thursday") {$nama_hari="Kamis";}
		else if($nama=="Friday") {$nama_hari="Jumat";}
		else if($nama=="Saturday") {$nama_hari="Sabtu";}
		return $nama_hari;
	}
}


// untuk hitung mundur
if ( ! function_exists('countdown'))
{
	function countdown($wkt)
	{
		$waktu=array(	365*24*60*60	=> "tahun",
						30*24*60*60		=> "bulan",
						7*24*60*60		=> "minggu",
						24*60*60		=> "hari",
						60*60			=> "jam",
						60				=> "menit",
						1				=> "detik");

		$hitung = strtotime(gmdate ("Y-m-d H:i:s", time () +60 * 60 * 8))-$wkt;
		$hasil = array();
		if($hitung<5)
		{
			$hasil = 'kurang dari 5 detik yang lalu';
		}
		else
		{
			$stop = 0;
			foreach($waktu as $periode => $satuan)
			{
				if($stop>=6 || ($stop>0 && $periode<60)) break;
				$bagi = floor($hitung/$periode);
				if($bagi > 0)
				{
					$hasil[] = $bagi.' '.$satuan;
					$hitung -= $bagi*$periode;
					$stop++;
				}
				else if($stop>0) $stop++;
			}
			$hasil=implode(' ',$hasil).' yang lalu';
		}
		return $hasil;
	}
}

// untuk cek usia
if ( ! function_exists('age'))
{
	function age($tgl)
	{
		if($tgl != null){
			$tanggal['lahir'] = $tgl;
			$tanggal['sekarang'] = date('Y-m-d');
			$lahir = $tanggal['lahir'];
			$selisih = time()-strtotime($lahir);
			$tahun = floor($selisih / 31536000);
			$bulan = floor(($selisih % 31536000) / 2592000);
			return $tahun.' THN, '.$bulan.' BLN';
		}
	}
}

// untuk angka terbilang
if ( ! function_exists('terbilang'))
{
	function terbilang($number)
	{
		$before_comma = trim(to_word($number));
		//$after_comma = trim(comma($number));
		//return ucwords($results = $before_comma.' koma '.$after_comma);
		return ucwords($results = $before_comma);
	}

	function to_word($number)
	{
		$words = "";
		$arr_number = array(
		"",
		"satu",
		"dua",
		"tiga",
		"empat",
		"lima",
		"enam",
		"tujuh",
		"delapan",
		"sembilan",
		"sepuluh",
		"sebelas");

		if($number<12)
		{
			$words = " ".$arr_number[$number];
		}
		else if($number<20)
		{
			$words = to_word($number-10)." belas";
		}
		else if($number<100)
		{
			$words = to_word($number/10)." puluh ".to_word($number%10);
		}
		else if($number<200)
		{
			$words = "seratus ".to_word($number-100);
		}
		else if($number<1000)
		{
			$words = to_word($number/100)." ratus ".to_word($number%100);
		}
		else if($number<2000)
		{
			$words = "seribu ".to_word($number-1000);
		}
		else if($number<1000000)
		{
			$words = to_word($number/1000)." ribu ".to_word($number%1000);
		}
		else if($number<1000000000)
		{
			$words = to_word($number/1000000)." juta ".to_word($number%1000000);
		}
		else if($number<1000000000000)
		{
			$words = to_word($number/1000000000)." miliyar ".to_word($number%1000000000);
		}
		else
		{
			$words = "undefined";
		}
		return $words;
	}

	function comma($number)
	{
		$after_comma = stristr($number,',');
		$arr_number = array(
		"nol",
		"satu",
		"dua",
		"tiga",
		"empat",
		"lima",
		"enam",
		"tujuh",
		"delapan",
		"sembilan");

		$results = "";
		$length = strlen($after_comma);
		$i = 1;
		while($i<$length)
		{
			$get = substr($after_comma,$i,1);
			$results .= " ".$arr_number[$get];
			$i++;
		}
		return $results;
	}
}


// untuk list bulan dalam bahasa indonesia
if ( ! function_exists('list_bulan'))
{
	function list_bulan($kosong = 0)
	{
		$CI =& get_instance();
		$CI->lang->load('calendar');

		if($kosong) $result[0] = 'Semua bulan';
		$result['01'] = $CI->lang->line('cal_january');
		$result['02'] = $CI->lang->line('cal_february');
		$result['03'] = $CI->lang->line('cal_march');
		$result['04'] = $CI->lang->line('cal_april');
		$result['05'] = $CI->lang->line('cal_may');
		$result['06'] = $CI->lang->line('cal_june');
		$result['07'] = $CI->lang->line('cal_july');
		$result['08'] = $CI->lang->line('cal_august');
		$result['09'] = $CI->lang->line('cal_september');
		$result['10'] = $CI->lang->line('cal_october');
		$result['11'] = $CI->lang->line('cal_november');
		$result['12'] = $CI->lang->line('cal_december');
		
		return $result;
	}
}

// untuk list tahun
if ( ! function_exists('list_tahun'))
{
	function list_tahun($kosong = 0, $dari = -10, $sampai = 0)
	{
		$CI =& get_instance();
		$CI->lang->load('calendar');

		if($kosong) $result[0] = 'Semua Tahun';
		
		$y = date("Y");
		for($i = $dari; $i <= $sampai; $i++)
		{
			$result[$y + $i] = $y + $i;
		}

		return $result;
	}
}

// untuk list tahun
if ( ! function_exists('bln_romawi'))
{
	function bln_romawi($bln)
	{
		switch ($bln)
		{
			case 1:
				return "I";
				break;
			case 2:
				return "II";
				break;
			case 3:
				return "III";
				break;
			case 4:
				return "IV";
				break;
			case 5:
				return "V";
				break;
			case 6:
				return "VI";
				break;
			case 7:
				return "VII";
				break;
			case 8:
				return "VIII";
				break;
			case 9:
				return "IX";
				break;
			case 10:
				return "X";
				break;
			case 11:
				return "XI";
				break;
			case 12:
				return "XII";
				break;
		}
	}
}

// untuk currency rupiah
if ( ! function_exists('rupiah'))
{
	function rupiah($value)
	{
		if($value < 0)
		{
			return '( Rp '.number_format(abs($value), 0, '', '.').' )';
		}
		else
		{
			return 'Rp '.number_format($value, 0, '', '.').'  ';
		}
	}
}