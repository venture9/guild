<?php

	if( !defined('BASEPATH') ) {
		exit( 'No direct script access allowed' );
	}

	class Costumer_model extends CI_Model {

		public function __construct() {
			parent::__construct();
		}

		public function get_id( $user_id ) {
			$query = $this->db->get_where( 'Costumer_table', array( 'User_Id' => $user_id) );
			$row = $query->row();
			return $row->Id;
		}

		public function get_attr( $costumer_id, $attr_name) {
			$query = $this->db->get_where( 'Costumer_table', array('id' => $costumer_id) );
			$row = $query -> row();
			if( $row ) {
				return $row->$attr_name;
			}
			return "";
		}
	}

