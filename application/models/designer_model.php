<?php

	if( !defined('BASEPATH') ) {
		exit( 'No direct script access allowed' );
	}

	class Designer_model extends CI_Model {

		public function __construct() {
			parent::__construct();
		}

		public function add_designer() {

			$user_id = $this->session->userdata('user_id');
			$designer_name = $this->input->post('designer_name');
			$dir_path = getcwd().'/uploads/'.$designer_name;


			if( !is_dir($dir_path) ) {
				// Should always trigger.
				mkdir($dir_path, 0755);
			}
			$data = array(
				'Name' => $designer_name,
				'Phone' => $this->input->post('designer_phone'),
				'Email' => $this->input->post('designer_email'),
				'Dir_path' => $dir_path,
				'Boutique' => $this->input->post('boutique_name'),
				'Designer_description' => $this->input->post('designer_description'),
				'Boutique_description' => $this->input->post('boutique_description'),
				'User_id' => $user_id
			);
			$this->db->insert( 'Designer_table', $data );

			//Retrive the designer id from this line.
			$query = $this->db->get_where('Designer_table', array('Name' => $designer_name));
			$row = $query->row();
			$designer_id = $row->Id;
			$this->session->set_userdata( array('designer_id' => $designer_id) );

		}

		public function get_id($user_id) {
			$query = $this->db->get_where( 'Designer_table', array('User_id' => $user_id) );
			$row = $query->row();
			return $row->Id;
		}

		public function get_name($designer_id) {
			$query = $this->db->get_where( 'Designer_table', array('id' => $designer_id) );
			$row = $query->row();
			return $row->Name;
		}

		public function get_dir($designer_id) {
			$query = $this->db->get_where( 'Designer_table', array('id' => $designer_id) );
			$row = $query->row();
			return $row->Dir_path;
		}

		public function get_attr($designer_id, $attr_name) {
			$query = $this->db->get_where( 'Designer_table', array('id' => $designer_id) );
			$row = $query -> row();
			if( $row ) {
				return $row->$attr_name;
			}
			return " ";
		}
	}