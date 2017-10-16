<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Auth extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    //Menampilkan data kontak
    function index_get() {
        $email = $this->get('email');
        $identitas = array();
        if($email){
            $this->db->select('fullname as name, username, email, password, unker_id as unker, satker_id as satker, level as class, active as status');
            $this->db->from('users');
            $this->db->where('email', $email);
            $this->db->where('deleted_at',null);
            $identitas = $this->db->get()->result();
        }else{
            $this->response($identitas, 204);
        }
        $this->response($identitas, 200);
    }
}
?>