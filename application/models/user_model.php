<?php
	if( !defined('BASEPATH') ) {
		exit( 'No direct script access allowed' );
	}

	class User_model extends CI_Model {
		public function __construct()
		{
			parent::__construct();
		}

		function add_user($role, $key, $company)
		{
			$name = $this->input->post('user_name');
			$email = $this->input->post('email_address');
			$password = md5($this->input->post('password'));

			$data = array(
				'username' => $name,
				'email' => $email,
				'role' => $role,
				'password' => $password,
				'pin' => $key
			);
			$this->db->insert( 'Users' , $data);

			$query = $this->db->get_where( 'Users', array("username" => $name) );
			$row = $query->row();
			$id = $row->Id;

			if( $role == 'Costumer' ) {
				$data = array(
					'Name' => $name,
					'Email' => $email,
					'Project' => $company,
					'User_id' => $id
				);
				$this->db->insert( 'Costumer_table', $data);
				$this->login( $email, $password);
			}else{
				$dir_path = getcwd().'/uploads/'.$name;
				if( !is_dir($dir_path) ) {
					mkdir($dir_path, 0755);
				}

				$data = array(
					'Name' => $name,
					'Email' => $email,
					'Boutique' => $company,
					'Dir_path' => $dir_path,
					'User_id' => $id
				);
				$this->db->insert( 'Designer_table', $data);
				$this->login( $email, $password);
			}
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

		function check_role($user_id)
		{
			$query = $this->db->get_where( 'Users', array('Id'=>$user_id) );
			$row = $query->row();
			$role = $row->Role;
			return $role;
		}

		function get_company($key) {
			$query = $this->db->get_where( 'Pin_table', array('PIN' => $key) );
			$row = $query->row();
			$company = $row->Company;

			return $company;
		}
	}