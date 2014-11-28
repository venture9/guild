<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'user_model' );
		$this->load->helper('form', 'string');
	}

	public function index()
	{
		$this->load->view('main/index');
	}

	public function signup()
	{
		$data[ 'error' ] = '';
		$this->load->view('main/header');
		$this->load->view('main/signup', $data);
		$this->load->view('main/footer');
	}

	public function signin()
	{
		// Check if user is logged in
		if($this->session->userdata('user_name') != '') {
			$this->dashboard();
		} else {
			$data['error'] = '';
			$this->load->view('main/header');
			$this->load->view('main/signin', $data);
			$this->load->view('main/footer');
		}
	}

	public function registration()
	{
		$this->load->library('form_validation');
		// field name, error message, validation rules
		$this->form_validation->set_rules('user_name', 'User Name', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('email_address', 'Your Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('con_password', 'Password Confirmation', 'trim|required|matches[password]');
		if($this->form_validation->run() == FALSE)
		{
			$this->signup();
		}
		else
		{
			$key = $this->input->post('user_key');
			$role = $this->user_model->validate($key);
			$company = $this->user_model->get_company($key);
			if($role)
			{
				$this->user_model->add_user($role, $key, $company);
				$this->dashboard();
			} else {
				// Pin validation failed
				p('Pin validation failed');
			}
		}
	}

	public function login()
	{
		$email=$this->input->post('email');
		$password=md5($this->input->post('pass'));

		$result=$this->user_model->login($email,$password);
		if($result) {
			// Successfully logged in
			$this->dashboard();
		}else {
			p('Guild:: Login Failed');
			$this->signin();
		}
	}

	private function dashboard()
	{
		$this->load->view('main/header');
		$this->load->view('main/dashboard');
		$this->load->view('main/footer');
	}

	public function logout()
	{
		$newdata = array(
		'user_id'   =>'',
		'user_name'  =>'',
		'user_email'     => '',
		'designer_id' =>'',
		'logged_in' => FALSE
		);
		$this->session->unset_userdata($newdata );
		$this->session->sess_destroy();
		$this->index();
	}

	public function key_gen()
	{
		$this->load->view('main/header');
		$this->load->view('main/key_gen');
		$this->load->view('main/footer');
	}

	public function key_result()
	{
		$pwd = $this->input->post('password');

		if($pwd == 'viewpal') {
			$role = $this->input->post('role');
			$name = $this->input->post('user_name');
			$company = $this->input->post('user_company');
			$pin = random_string( 'alnum', 5);
			p($pin);
			$newuser = array(
				'Role' => $role,
				'Name' => $name,
				'Company' => $company,
				'PIN' => $pin
				);
			if($this->db->insert( 'Pin_table', $newuser)) {
				$data[ 'message' ] = "Key Successfully created!";
				$data[ 'pin' ] = $pin;
				$this->load->view('main/header');
				$this->load->view('main/key_result', $data);
				$this->load->view('main/footer');
			}else {
				$data[ 'error' ] = 1;
				$data[ 'message' ] = "Something wrong with the database";
				$this->load->view('main/header');
				$this->load->view('main/key_result', $data);
				$this->load->view('main/footer');
			}
		}else {
			$data[ 'error' ] = 1;
			$data[ 'message' ] = "Password not correct, who you are!!?";
			$this->load->view('main/header');
			$this->load->view('main/key_result', $data);
			$this->load->view('main/footer');
		}
	}
}
