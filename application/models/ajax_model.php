<?php

	if( !defined('BASEPATH') ) {
		exit( 'No direct script access allowed' );
	}

	class Ajax_model extends CI_model {
		public function __construct() {
			parent::__construct();
		}

		public function update_designer_info( $designer_id, $serial_data ) {
			// check serial_data
			foreach ( $serial_data as $key => $value) {
				if ( !$serial_data[$key] || $serial_data[$key]==' ' ) {
					return "Please fill in filed $key";
				}
			}

			$data = array(
						"Name" => $serial_data[ 'designer_name' ],
						"Email" => $serial_data[ 'designer_email' ],
						"Phone" => $serial_data[ 'designer_phone' ],
						"Boutique" => $serial_data[ 'boutique_name' ],
						"Designer_description" => $serial_data[ 'designer_description' ],
						"Boutique_description" => $serial_data[ 'boutique_description']
					);
			$this->db->where( 'Id', $designer_id );
			if( $this->db->update( 'Designer_table', $data ) ) {
				return "Sucessfully Updated";
			}
			return "Unknown exception";
		}
	}