<?php

	if ( !defined( 'BASEPATH' ) )
	{
		exit( 'No direct script access allowed' );
	}

	class Ajax extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model( 'ajax_model' );
			$this->load->model( 'designer_model' );
			$this->load->model( 'costumer_model' );
		}

		public function designer_info_update() {

			//p( $this->input->post() );
			$user_id = $this->session->userdata( 'user_id' );
			$designer_id = $this->designer_model->get_id( $user_id );
			$result = $this->ajax_model->update_designer_info( $designer_id, $this->input->post() );
			echo $result;
		}

		public function costumer_info_update() {

			$user_id = $this->session->userdata( 'user_id' );
			$costumer_id = $this->costumer_model->get_id( $user_id );
			$result = $this->ajax_model->update_costumer_info( $costumer_id, $this->input->post() );
			echo $result;
		}

		public function costumer_create_project() {
			$user_id = $this->session->userdata( 'user_id' );
			$costumer_id = $this->costumer_model->get_id( $user_id );
			$result = $this->ajax_model->costumer_create_project( $costumer_id, $this->input->post() );
			echo $result;
		}
	}