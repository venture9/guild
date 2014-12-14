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
			$this->check_data( $serial_data );

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

		public function update_costumer_info( $costumer_id, $serial_data ) {

			$this->check_data( $serial_data );

			$data = array(
						"Name" => $serial_data[ 'costumer_name' ],
						"Email" => $serial_data[ 'costumer_email' ],
						"Phone" => $serial_data[ 'costumer_phone' ],
						"Company" => $serial_data[ 'costumer_company' ],
						"Costumer_description" => $serial_data[ 'costumer_description' ],
						"Company_description" => $serial_data[ 'company_description']
					);
			$this->db->where( 'Id', $costumer_id );
			if( $this->db->update( 'Costumer_table', $data ) ) {
				return "Sucessfully Updated";
			}
			return "Unknown exception";
		}

		public function costumer_create_project( $costumer_id, $serial_data ) {

			$this->check_data( $serial_data );

			$data = array(
					"Name" => $serial_data["project_name"],
					"Description" => $serial_data["project_description"],
					"Release_date" => $serial_data["release_date"],
					"Active" => 1
				);

			if ( $this->db->insert( 'Project_table', $data ) ) {
				return "Successfully Created";
			} else {
				return "Unknown exception";
			}
		}

		private function check_data( $serial_data ) {
			foreach ( $serial_data as $key => $value) {
				if ( !$serial_data[$key] || $serial_data[$key]==' ' ) {
					return "Please fill in filed $key";
				}
			}
		}
	}