<?php

	if( !defined('BASEPATH') ) {
		exit( 'No direct script access allowed' );
	}

	class Designer_Item_model extends CI_Model {

		public function __construct() {
			parent::__construct();
		}

		public function add_item( $designer_id ) {
			$data = array(
				'Title' => $this->input->post('item_title'),
				'Sub_title' => $this->input->post('item_sub_title'),
				'Price' => $this->input->post('item_price'),
				'Description' => $this->input->post('item_description'),
				'Compostion' => $this->input->post('item_compostion'),
				'Category' => $this->input->post('item_category'),
				'Designer_id' => $designer_id
			);

			$this->db->insert( 'item_table', $data );
			$current_working_item = array( 'current_working_item' => $this->input->post('item_title') );
			$this->session->set_userdata( $current_working_item );
		}
	}