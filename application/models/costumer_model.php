<?php

	if( !defined('BASEPATH') ) {
		exit( 'No direct script access allowed' );
	}

	class Costumer_model extends CI_Model {

		public function __construct() {
			parent::__construct();
		}

		public function get_name( $costumer_id ) {

			$query = $this->db->get_where( 'Costumer_table', array( "Id" => $costumer_id ) );
			$row = $query->row();
			$costumer_name = $row->Name;

			return $costumer_name;
		}

		public function get_recent_id( $user_id ) {

			$query = $this->db->get_where( 'Costumer_table', array( "User_id" => $user_id, "Recent" => 1) );
			$row = $query->row();
			if ($row) {
				$recent_id = $row->Id;
				return $recent_id;
			} else {
				return 0;
			}
		}
	}

