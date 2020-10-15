<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {
		parent::__construct();
		$this->load->model('Racket_model');

	}

	public function index(){
		if ($this->session->userdata('view1')){
            $this->session->set_userdata('view1', $this->session->userdata('view1')+1);
        } else {
            $this->session->set_userdata('view1', 1);
		}
		$data['title'] = 'Session';
		$data['view1'] = $this->session->userdata('view1');
		$this->load->view('welcome_message', $data);
    }
	
	public function login(){
		$username = $this->input->post("username");
		$email = $this->input->post("email");
		$password = $this->input->post("password");


		$this->load->model('User_model');
	

		if ($_POST['submit'] == 'LOG_IN'){
            $data['username']=$username;
            $data['email']=$email;
			$data['password']=$password;
			
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			if ($this->form_validation->run() == FALSE){
				$this->load->view('welcome_message');
			} else {
				if ($username == '' OR $password == ''){
					$this->load->view('login_failure');
				} else {
					$this->User_model->login($username, $email, $password);
					if($this->input->post("cookiecheck")){
						$this->input->set_cookie('username', $username, 86500);
						$this->input->set_cookie('email', $email, 86500);
						$this->input->set_cookie('password', $password, 86500);
					} else {
						delete_cookie('username');
						delete_cookie('email');
						delete_cookie('password');
					}
					if($this->User_model->login($username, $email, $password) == true){
						$user_data = array(
							'username' => $username,
							'email' => $email,
							'logged_in' => true
						);
						$this->session->set_userdata($user_data);
						$this->load->view('dashboard',$user_data);
					} else {
						$this->load->view('login_failure');
					}   
				}
			}
		}
	}

	public function create_account(){
		$this->load->view('new_account');
	}

	public function submit_account(){
		$username = $this->input->post("username");
		$email = $this->input->post("email");
		$password = $this->input->post("new_password");
		$q1 = $this->input->post("q1");
		$q2 = $this->input->post("q2");
		$q3 = $this->input->post("q3");
		$this->load->model('User_model');
	
		$data['username']=$username;
		$data['email']=$email;
		$data['new_password']=$password;
		$data['q1']=$q1;
		$data['q2']=$q2;
		$data['q3']=$q3;

		$rules = array(
			[
				'field' => 'new_password',
				'label' => 'New Password',
				'rules' => 'callback_valid_password',
			],
		);

			
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('g-recaptcha-response', 'recaptcha validation', 'required|callback_validate_captcha');
		$this->form_validation->set_message('validate_captcha', 'Please check the the captcha form');
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == FALSE){
			$this->load->view('new_account');
		} else {
			if ($username == '' OR $password == ''){
				$this->load->view('login_failure');
			} else {
				$this->User_model->create_account($username, $email, $password, $q1, $q2, $q3);
			}
		}
	}

	public function valid_password($password = ''){
		$password = trim($password);

		$regex_lowercase = '/[a-z]/';
		$regex_uppercase = '/[A-Z]/';
		$regex_number = '/[0-9]/';
		$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>ยง~]/';

		if (empty($password))
		{
			$this->form_validation->set_message('valid_password', 'The password field is required.');

			return FALSE;
		}

		if (preg_match_all($regex_lowercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The password field must contain at least one lowercase letter.');

			return FALSE;
		}

		if (preg_match_all($regex_uppercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The password field must contain at least one uppercase letter.');

			return FALSE;
		}

		if (preg_match_all($regex_number, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The password field must contain at least one number.');

			return FALSE;
		}

		if (preg_match_all($regex_special, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The password field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>ยง~'));

			return FALSE;
		}

		if (strlen($password) < 5)
		{
			$this->form_validation->set_message('valid_password', 'The password field must be at least 5 characters in length.');

			return FALSE;
		}

		return TRUE;
	}



	 public function update_email(){
		$email = $this->input->post("email");
		$username = $this->input->post("username");

		$this->load->model('User_model');

		if ($_POST['submit'] == 'UPDATE_EMAIL'){
			$data['email']=$email;
			$data['username']=$username;

			$this->User_model->update_email($username, $email);	

		} else if ($_POST['submit'] == 'LOG_OUT'){
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('username');

			$this->load->view('welcome_message');	
		}
	}

	function forgot_password(){
		$this->load->view('forgot_password');
	}

	function password_to_email(){
		$email = $this->input->post("email");
		$q1 = $this->input->post("q1");
		$q2 = $this->input->post("q2");
		$q3 = $this->input->post("q3");
		$this->load->model('User_model');
		$data['email']=$email;
		$data['q1']=$q1;
		$data['q2']=$q2;
		$data['q3']=$q3;	

		$this->User_model->password_to_email($email, $q1, $q2, $q3);
	}


	function verify_account(){
		$verifycode = $this->input->post("verifycode");
		$username = $this->session->userdata('username');
		$this->load->model('User_model');
		$data['verifycode']=$verifycode;

		if ($verifycode == ''){
			$this->load->view('verify_failure');
		} else {
			$this->User_model->verify($verifycode, $username);
		}


	}

	function validate_captcha() {
        $captcha = $this->input->post('g-recaptcha-response');
         $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcCSv0UAAAAAOZx0M6qDe5TRusQap9bpiDrnYX4&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
        if ($response . 'success' == false) {
            return FALSE;
        } else {
            return TRUE;
        }
	}
	
	function force_logout(){
		session_destroy();
		$this->load->view('welcome_message');


	}
	
}
