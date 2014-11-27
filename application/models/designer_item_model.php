<?php

	if( !defined('BASEPATH') ) {
		exit( 'No direct script access allowed' );
	}

	class Designer_Item_model extends CI_Model {

		public function __construct() {
			parent::__construct();
		}

		public function add_item( $designer_id ) {

			$title = $this->input->post('item_title');
			$query = $this->db->get_where( 'Designer_table', array( 'id'=>$designer_id ) );
			$row = $query->row();
			$designer_dir_path = $row->Dir_path;
			$item_dir_path = $designer_dir_path.'/'.$title;
			$data = array(
				'Title' => $title,
				'Sub_title' => $this->input->post('item_sub_title'),
				'Price' => $this->input->post('item_price'),
				'Description' => $this->input->post('item_description'),
				'Compostion' => $this->input->post('item_composition'),
				'Category' => $this->input->post('item_category'),
				'Dir_path' => $item_dir_path,
				'Designer_id' => $designer_id
			);

			$this->db->insert( 'item_table', $data );

			// Set session for current working item.
			$query = $this->db->get_where( 'Item_table', array( 'Title'=>$title) );
			$row = $query->row();
			$item_id = $row->Id;
			$current_working_item = array( 'item_id'=>$item_id);
			$this->session->set_userdata($current_working_item);

			// Create a dir for that item.
			if( !is_dir($item_dir_path) ) {
				mkdir( $item_dir_path, 0755 );
				mkdir( $item_dir_path.'/thumbs', 0755);
			} else {
				p('Some one is tring to make the same dir');
			}

		}

		public function get_name( $item_id ) {
			$query = $this->db->get_where( 'Item_table', array('id' => $item_id) );
			$row = $query->row();
			return $row->Title;
		}

		public function get_dir( $item_id ) {
			$query = $this->db->get_where( 'Item_table', array('id' => $item_id) );
			$row = $query->row();
			return $row->Dir_path;
		}
	}