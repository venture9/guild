<?php

	if ( !defined( 'BASEPATH' ) )
	{
		exit( 'No direct script access allowed' );
	}

	class Designer extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model( 'designer_model' );
			$this->load->model( 'designer_item_model');
			$this->load->helper('form', 'file');
		}

		public function index() {

			$user_id = $this->session->userdata( 'user_id' );
			$role = $this->session->userdata( 'user_role' );
			if( !$user_id || strcmp( $role, 'Designer' ) !== 0 ) {
				$this->go_home();
			}

			$designer_id = $this->designer_model->get_id( $user_id );
			$designer_name = $this->designer_model->get_name( $designer_id );
			$designer_email = $this->designer_model->get_attr( $designer_id, 'Email' );
			$designer_boutique = $this->designer_model->get_attr( $designer_id, 'Boutique' );

			// Mandatory Fields
			$data[ 'designer_id' ] = $designer_id;
			$data[ 'designer_name' ] = $designer_name;
			$data[ 'designer_email' ] = $designer_email;
			$data[ 'designer_boutique' ] = $designer_boutique;
			// Optional Fields
			$data[ 'designer_phone' ] = $this->designer_model->get_attr( $designer_id, 'Phone');
			$data[ 'designer_description' ] = $this->designer_model->get_attr( $designer_id, 'Designer_description' );
			$data[ 'boutique_description' ] = $this->designer_model->get_attr( $designer_id, 'Boutique_description' );
			// Get this Designer's Invertory
			$data[ 'designer_inventory' ] = $this->designer_item_model->single_invertory( $designer_id );

			$this->load_dashboard( $data );

		}

		private function go_home() {
			header('Location: '.base_url());
		}

		private function load_dashboard( $data ) {
			$this->load->view( 'main/header' );
			$this->load->view( 'designer/dashboard', $data );
			$this->load->view( 'main/footer' );
		}

		public function upload_catalog() {
			$data[ 'error' ] = '';
			$this->load->view( 'designer/upload_catalog', $data );
		}

		public function add_designer() {
			$this->load->library( 'form_validation' );
			$this->form_validation->set_rules( 'designer_name', 'Designer Name', 'required');
			$this->form_validation->set_rules( 'designer_email', 'Designer Email', 'required');

			if($this->form_validation->run() == FALSE) {
				$this->index();
			}
			else
			{
				$this->designer_model->add_designer();
			}
		}

		public function add_item() {
			$this->load->library( 'form_validation' );

			$this->form_validation->set_rules('item_title', 'Title', 'required');
			$this->form_validation->set_rules('item_sub_title', 'Sub Title', 'required');

			if($this->form_validation->run() == FALSE) {
				p('failed form validation for desinger item');
				$this->index();
			}
			else
			{
				// More validations here.
				$user_id = $this->session->userdata('user_id');
				$designer_id = $this->designer_model->get_id( $user_id );

				$this->designer_item_model->add_item( $designer_id );
				$this->add_images( $designer_id );
			}

		}

		public function add_images() {

			$item_id = $this->session->userdata('item_id');
			$data['item_dir_path'] = $this->designer_item_model->get_dir($item_id);

			$this->load->view('static/upload_header');
			$this->load->view('designer/add_images', $data);
			$this->load->view('static/upload_footer');
		}

		public function upload_files() {
			$this->load->view( 'desinger/upload_files' );
		}

		public function do_upload()
		{
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']	= '100';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload())
			{
				$error = array('error' => $this->upload->display_errors());

				$this->load->view('designer/upload_catalog', $error);
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());

				$this->load->view('designer/upload_success', $data);
			}
		}

		public function do_upload_images() {

			$user_id = $this->session->userdata( 'user_id' );
			$designer_id = $this->designer_model->get_id( $user_id );
			$designer_name = $this->designer_model->get_name( $designer_id );
			$item_id = $this->session->userdata('item_id');
			$item_name = $this->designer_item_model->get_name( $item_id );

			$upload_path_url = base_url() . 'uploads/'.$designer_name.'/'.$item_name.'/';
			$config['upload_path'] = FCPATH . 'uploads/'.$designer_name.'/'.$item_name.'/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['max_size'] = '30000';

			$this->load->library('upload', $config);
			if ($this->upload->do_upload()) {

				$data = $this->upload->data();

				$config = array();
				$config['image_library'] = 'gd2';
				$config['source_image'] = $data['full_path'];
				$config['create_thumb'] = TRUE;
				$config['new_image'] = $data['file_path'] . 'thumbs/';
				$config['maintain_ratio'] = TRUE;
				$config['thumb_marker'] = '';
				$config['width'] = 75;
				$config['height'] = 50;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				//set the data for the json array
				$info = new StdClass;
				$info->name = $data['file_name'];
				$info->size = $data['file_size'] * 1024;
				$info->type = $data['file_type'];
				$info->url = $upload_path_url . $data['file_name'];

				$info->thumbnailUrl = $upload_path_url . 'thumbs/' . $data['file_name'];
				$info->deleteUrl = base_url() . 'upload/deleteImage/' . $data['file_name'];
				$info->deleteType = 'DELETE';
				$info->error = null;

				$files[] = $info;

				if (IS_AJAX) {
					$this->designer_item_model->save_image( $info, $item_id, $item_name, $designer_id );
					echo json_encode(array("files" => $files));
				}
			}
		}

		public function update( $item_id ) {
			echo "Item id:".$item_id."<br>";
			// first check if user is logged in and this item_id belongs to him
			$user_id = $this->session->userdata('user_id');
			$designer_id = $this->designer_model->get_id($user_id);

			$check_permission = $this->designer_item_model->check_permission( $designer_id, $item_id );
			if( !$check_permission ) {
				echo "No permission";
				die();
				//$this->load->view('not_allowed');
			}
			echo "Placeholders for updating this page";

		}
	}