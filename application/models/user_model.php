<?php
	if( !defined('BASEPATH') ) {
		exit( 'No direct script access allowed' );
	}

	class User_model extends CI_Model {
		public function __construct()
		{
			parent::__construct();
		}

		function add_user($role, $key)
		{
			//$key = $this->input->post('user_key');
			// validate this key
			$data = array(
				'username' => $this->input->post('user_name'),
				'email' => $this->input->post('email_address'),
				'role' => $role,
				'password' => md5($this->input->post('password')),
				'pin' => $key
			);
			$this->db->insert( 'Users' , $data);

		}

		function validate($key)
		{
			$this->db->where("PIN", $key);
			$query = $this->db->get("Pin_table");
			if( $query->num_rows() == 1 ) {
				foreach($query->result() as $rows){
					$role = $rows->Role;
					return $role;
				}
			} else {
				return false;
			}

		}

		function login($email,$password)
		{
		$this->db->where("email", $email);
		$this->db->where("password", $password);
		$query = $this->db->get("Users");
		if($query->num_rows() == 1)
		{
			//p('Found rows:'.$query->num_rows());
			foreach($query->result() as $rows)
			{
				//add all data to session
				$newdata = array(
				  'user_id'  => $rows->Id,
				  'user_name'  => $rows->Username,
				  'user_email' => $rows->Email,
				  'user_role' => $rows->Role,
				  'logged_in'  => TRUE,
				);
			}
				$this->session->set_userdata($newdata);
				return true;
			}
			return false;
		}
	}