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

		public function save_image( $info, $item_id, $item_name, $designer_id ) {
			$data = array(
				'Name' => $item_name,
				'Item_path' => $info->url,
				'Item_id' => $item_id,
				'Designer_id' => $designer_id
			);

			$this->db->insert('Image_table', $data);

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

		public function single_invertory( $designer_id ) {
			$item_list = array();
			$query = $this->db->get_where( 'Item_table', array('Designer_Id'=>$designer_id) );
			if( $query->num_rows() > 0 ) {
				foreach ($query->result() as $row) {
					$item = array();

					$item['id'] = $row->Id;
					$item['img_path'] = $this->item_img_path( $row->Id );
					$item['title'] = $row->Title;
					$item['category'] = $row->Category;
					$item['tags'] = ' ';
					$item_list[] = $item;
				}
				//p($item_list);
				return $item_list;

			} else {
				p("$designer_id has no inventory");
				return 0;
			}
		}

		private function item_img_path( $item_id ) {
			$query = $this->db->get_where( 'Image_table', array("Item_Id"=>$item_id) );
			$row = $query->row();
			return $row->Item_path;
		}
	}