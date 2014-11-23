<?php

	if ( !defined( 'BASEPATH' ) )
	{
		exit( 'No direct script access allowed' );
	}

	class Designer extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model( 'designer_item_model');
			$this->load->helper('form');
		}

		public function index() {
			if( $designer = $this->session->userdata('user_name')) {

				$this->check_designer_dir();

				$data['designer_id'] = $this->session->userdata('user_id');
				$data['designer_name'] = $designer;
				$data['designer_dir_path'] = $this->session->userdata('designer_dir_path');
				$data['error'] = '';
				$this->load->view( 'static/upload_header' );
				$this->load->view( 'designer/dashboard', $data );
				$this->load->view( 'static/upload_footer' );
			} else {

				header('Location: '.base_url());
			}

		}

		public function upload_catalog() {
			$data[ 'error' ] = '';
			$this->load->view( 'designer/upload_catalog', $data );
		}

		public function upload_item() {
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
				$desinger_id = $this->session->userdata('user_id');
				$this->designer_item_model->add_item( $desinger_id );
			}

		}

		public function upload_files() {
			$this->load->view( 'desinger/upload_files' );
		}

		public function check_designer_dir() {
			// path like: /uploads/designer_name/item_name/
			$designer = $this->session->userdata('user_name');
			$dir_path = getcwd().'/uploads/'.$designer;

			if( !is_dir($dir_path) ) {
				// dest path is not a directory, create a directory, access 755.
				mkdir($dir_path, 0755);
				echo "Just made a directory for $designer";
			}
			$designer_dir_path = array( 'designer_dir_path' => $dir_path );
			$this->session->set_userdata( $designer_dir_path );

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
			/**
			 * This method handles user uploading images, they should be stored under
			 * /uploads/designer_name/item_name/
			 */

			$designer_name = $this->session->userdata('user_name');
			$item_name = $this->session->userdata('current_working_item');

	        $upload_path_url = base_url() . 'uploads/'.$designer_name.'/'.$item_name.'/';

	        $config['upload_path'] = FCPATH . 'uploads/'.$designer_name.'/'.$item_name.'/';
	        $config['allowed_types'] = 'jpg|jpeg|png|gif';
	        $config['max_size'] = '30000';

	        $this->load->library('upload', $config);

	        if (!$this->upload->do_upload()) {
	            //$error = array('error' => $this->upload->display_errors());
	            //$this->load->view('upload', $error);
	            p('can not do upload method');
	            //Load the list of existing files in the upload directory

	            $existingFiles = get_dir_file_info($config['upload_path']);
	            $foundFiles = array();
	            $f=0;
	            foreach ($existingFiles as $fileName => $info) {
	              if($fileName!='thumbs'){//Skip over thumbs directory
	                //set the data for the json array
	                $foundFiles[$f]['name'] = $fileName;
	                $foundFiles[$f]['size'] = $info['size'];
	                $foundFiles[$f]['url'] = $upload_path_url . $fileName;
	                $foundFiles[$f]['thumbnailUrl'] = $upload_path_url . 'thumbs/' . $fileName;
	                $foundFiles[$f]['deleteUrl'] = base_url() . 'upload/deleteImage/' . $fileName;
	                $foundFiles[$f]['deleteType'] = 'DELETE';
	                $foundFiles[$f]['error'] = null;

	                $f++;
	              }
	            }
	            $this->output
	            ->set_content_type('application/json')
	            ->set_output(json_encode(array('files' => $foundFiles)));
	        } else {
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
	            // I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$data['file_name']
	            $info->thumbnailUrl = $upload_path_url . 'thumbs/' . $data['file_name'];
	            $info->deleteUrl = base_url() . 'upload/deleteImage/' . $data['file_name'];
	            $info->deleteType = 'DELETE';
	            $info->error = null;

	            $files[] = $info;
	            //this is why we put this in the constants to pass only json data

	            if (IS_AJAX) {
	                echo json_encode(array("files" => $files));
	            } else {
	                $file_data['upload_data'] = $this->upload->data();
	                $this->load->view('upload/upload_success', $file_data);
	            }
        	}
    	}
	}