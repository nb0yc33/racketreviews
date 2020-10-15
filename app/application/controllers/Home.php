<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$this->load->model('User_model');
	}

	public function index(){
	
    }
	
	public function login_page(){
		$this->load->view('welcome_message');
	}
	

	public function dashboard(){
		$this->load->view('dashboard');
	}

	 public function upload(){
		$this->load->view('upload_view');
	 }

	 public function profile(){
		 $this->load->view('profile');
	 }

	 public function forgot_your_password(){
		 $this->load->view('forgot_password');
	 }

	 public function search(){
		 $this->load->view('search');
	 }

	 public function force_logout(){
		 $this->load->view('welcome_message');
	 } 


	
}

