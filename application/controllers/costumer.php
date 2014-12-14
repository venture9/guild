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
			//p( $this->session->all_userdata() );
			$user_id = $this->session->userdata( 'user_id' );
			$user_role = $this->session->userdata( 'user_role' );
			$cmp = strcmp( $user_role, 'Costumer' );
			if( !$user_id || $cmp !== 0 ) {
				//No permissio
				echo "Session exception occured!".'<br>';
				echo "User_id:".$user_id."</br>";
				echo 'User_role:'.$user_role.'</br>';
				die();
			}
			echo "User_id:".$user_id."</br>";
			echo 'User_role:'.$user_role;
			$id = $this->costumer_model->get_id( $user_id );
			$name = $this->costumer_model->get_attr( $id, 'Name');
			$email = $this->costumer_model->get_attr( $id, 'Email' );
			$company = $this->costumer_model->get_attr( $id, 'Company' );
			$phone = $this->costumer_model->get_attr( $id, 'Phone' );
			$company_description = $this->costumer_model->get_attr( $id, 'Company_description' );
			$description = $this->costumer_model->get_attr( $id, 'Costumer_description' );
			// Mandatory field
			$data[ 'costumer_id' ] = $id;
			$data[ 'costumer_name' ] = $name;
			$data[ 'costumer_email' ] = $email;
			$data[ 'costumer_company' ] = $company;
			// Optional
			$data[ 'costumer_phone' ] = $phone;
			$data[ 'company_description' ] = $company_description;
			$data[ 'costumer_description' ] = $description;

			$this->load_dashboard( $data );
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