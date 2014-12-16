<?php

	if( !defined('BASEPATH') ) {
		exit( 'No direct script access allowed' );
	}

	class Costumer_project_model extends CI_Model {

		public function __construct() {
			parent::__construct();
		}

		public function get_all( $costumer_id ) {
			$project_list = array();
			$query = $this->db->get_where( 'Project_table', array('Costumer_id'=>$costumer_id) );
			if( $query->num_rows() > 0 ) {
				foreach ($query->result() as $row) {

					$project_array = array();
					$project_array['Name'] = $row->Name;
					$project_array['Description'] = $row->Description;
					$project_array['Current'] = $row->Active;
					$project_array['Release_date'] = $row->Release_date;
					$project_array['Create_date'] = $row->Date;

					$project_list[] = $project_array;
				}
				//p($project_list);
				return $project_list;

			} else {
				p("$designer_id has no inventory");
				return 0;
			}
		}
	}
