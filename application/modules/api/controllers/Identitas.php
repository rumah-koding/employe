<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Identitas extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    //Menampilkan data kontak
    function index_get() {
        $nip = $this->get('nip');
        if ($nip == '') {
            $this->db->select('nip, nama, gelar1 as gelar_depan, gelar2 as gelar_belakang');
            $this->db->where_in('status_id', array(1,2));
            $this->db->where('deleted_at',null);
            $identitas = $this->db->get('identitas')->result();
        } else {
            $this->db->select('nip, nama, gelar1 as gelar_depan, gelar2 as gelar_belakang');
            $this->db->where_in('status_id', array(1,2));
            $this->db->where('nip', $nip);
            $this->db->where('deleted_at',null);
            $identitas = $this->db->get('identitas')->result();
        }
        $this->response($identitas, 200);
    }
}
?>