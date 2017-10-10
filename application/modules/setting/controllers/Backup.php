<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'setting/backup/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('backup_m', 'data');
		signin();
		group(array('1'));
	}
	
	//halaman index
	public function index()
	{
		ini_set('memory_limit', '-1');
		// Load the DB utility class
        $this->load->dbutil();
        // Backup your entire database and assign it to a variable
        $backup = $this->dbutil->backup();
        // nama file backup
        $namafile = "dbbackup". "-" . date("Y-m-d_H-i-s") . ".sql.gz";
        // Load the file helper and write the file to your server
        $this->load->helper('file');
		$path = 'source/db_backup';
		$user_name = 'www-data';
		if(!file_exists($path)) {
				mkdir($path, 0755, true);
				chown($path, $user_name);
		}	
        write_file(FCPATH .'/'.$path.'/'.$namafile, $backup);
        // Load the download helper and send the file to your desktop
        $this->load->helper('download');
		helper_log("add", "Membackup Database Simpeg");
        force_download($namafile, $backup);
	}
}
