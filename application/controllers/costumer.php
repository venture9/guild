<?php

	if ( !defined( 'BASEPATH' ) )
	{
		exit( 'No direct script access allowed' );
	}

	class Costumer extends CI_controller {
		public function __construct() {
			parent::__construct();
			$this->load->model( 'costumer_model' );
			$this->load->model( 'user_model' );
			$this->load->helper( 'form' );
		}

		public function index() {
			$user_id = $this->session->userdata( 'user_id' );
			if( !$user_id ) {
				$this->go_home();
			}

			$costumer_id = $this->session->userdata( 'costumer_id' );
			if( $costumer_id ) {

				$costumer_name = $this->get_name_by_id( $costumer_id );
				$data[ 'costumer_name' ] = $costumer_name;
				$this->load_dashboard( $data );
			} else {

				$get_recent_id = $this->costumer_model->get_recent_id( $user_id );
				if( $get_recent_id ) {
					$costumer_name = $this->get_name_by_id ( $costumer_id );
					$data[ 'costumer_name' ] = $costumer_name;
					$this->load_dashboard( $data );
				} else {
					// no history yet
					$data[ 'no_history' ] = 1;
					$this->load_dashboard( $data );
				}
			}
		}

		private function load_dashboard( $data ) {
			$this->load->view( 'main/header' );
			$this->load->view( 'costumer/dashboard', $data );
			$this->load->view( 'main/footer' );
		}

		private function go_home() {
			header( "Location: ".base_url() );
		}

		private function get_name_by_id( $costumer_id ) {
			$costumer_name = $this->costumer_model->get_name( 'costumer_id' );
			return $costumer_name;
		}
	}