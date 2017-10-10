<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_m extends MY_Model
{
	public $table = 'users'; // you MUST mention the table name
	
	public function get_user($email)
	{
		return $this->db->where('email', $email)->where('active',1)->where('deleted_at',null)->get($this->table)->row('password');
	}
	
	public function get_userID($email)
	{
		return $this->db->where('email', $email)->where('active',1)->where('deleted_at',null)->get($this->table)->row('id');
	}
	
	public function get_username($email)
	{
		return $this->db->where('email', $email)->where('active',1)->where('deleted_at',null)->get($this->table)->row('username');
	}
	
	public function get_level($email)
	{
		return $this->db->where('email', $email)->where('active',1)->where('deleted_at',null)->get($this->table)->row('level');
	}
}