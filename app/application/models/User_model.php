<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class User_model extends CI_Model{

		public function login($username, $email, $password){
		
			$this->db->where('username', $username);
			$this->db->where('email', $email);
			$this->db->where('password', $password);
            
			$result = $this->db->get('users');

			if($result->num_rows() == 1){
				return true;
			} else {
				return false;
			}
		}

		public function check_username_exists($username){
			$query = $this->db->get_where('username', array('username' => $username));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
		}

		public function create_account($username, $email, $password, $q1, $q2, $q3){
			$username_query = $this->db->get_where('users', array('username' => $username));
			$email_query = $this->db->get_where('users', array('email' => $email));
			if(empty($username_query->row_array())){
				if(!$username == ''){
					if(empty($email_query->row_array())){
						$hash_verify = md5(rand(0,1000));
						$sql_query = "INSERT INTO users (`username`, `email`, `password`, `q1`, `q2`, `q3`, `hash_code`, `verified`) VALUES ('$username', '$email',
						'$password', '$q1', '$q2', '$q3', '$hash_verify', 'NOT_VERIFIED')";
						$this->db->query($sql_query);
						$query = $this->User_model->retrieve_verification_code($email);			
						$config = array(
							'protocol' => 'smtp', 
							'smtp_host' => 'ssl://smtp.gmail.com', 
							'smtp_port' => 465, 
							'smtp_user' => 'techcentralhelp187@gmail.com', 
							'smtp_pass' => 'BROWNdog1', 
							'mailtype' => 'html', 
							'charset' => 'iso-8859-1'
						);
						$this->email->initialize($config);
						$this->email->set_mailtype("html");
						$this->email->set_newline("\r\n");
				 
				 
						$this->email->to($email);
						$this->email->from('techcentralhelp187@gmail.com');
						$this->email->subject('ACCOUNT_VERIFICATION_CODE - TECH_CENTRAL');
						$this->email->message($query);
		
						$this->email->send();
						$this->load->view('acc_creation');
					} else {
						$this->load->view('exists_failure');
					}
				} else {
					$this->load->view('blank_failure');
				}
			} else {
				$this->load->view('exists_failure');
			}
		}

		public function update_email($username, $email){
			$username_query = $this->db->get_where('users', array('username' => $username));
			$email_query = $this->db->get_where('users', array('email' => $email));

			if(!empty($username_query->row_array())){
				if(!$username == ''){
					if(!$email == ''){
						if(empty($email_query->row_array())){
							$sql_query = "UPDATE users SET email = '$email' WHERE username = '$username'";
							$this->db->query($sql_query);
							$this->load->view('email_update');	
						}
					}
				} 
			} else {
				$this->load->view('update_failure');
			}

		}

		public function video_details($filename, $title, $tag, $desc, $username){
			$sql_query = "INSERT INTO videos (`video_filename`,`video_title`, `video_tag`, `video_desc`, `username`) VALUES ('$filename','$title', '$tag',
			'$desc', '$username')";
			$this->db->query($sql_query);		
		}

		public function thumbnail_upload($filename, $username, $title){
			$sql_query = "INSERT INTO thumbnails (`thumbnails_filename`,`username`, `video_title`) VALUES ('$filename', '$username', '$title')";
			$this->db->query($sql_query);
		}

		public function password_to_email($email, $q1, $q2, $q3){
			$query = $this->db->query("SELECT *  FROM users WHERE email = '$email' AND q1 = '$q1' AND q2 = '$q2' AND q3 = '$q3'");
			$query2 = $this->User_model->retrieve_password($email);			
			if ($query->num_rows() > 0) {
				$config = array(
					'protocol' => 'smtp', 
					'smtp_host' => 'ssl://smtp.gmail.com', 
					'smtp_port' => 465, 
					'smtp_user' => 'techcentralhelp187@gmail.com', 
					'smtp_pass' => 'BROWNdog1', 
					'mailtype' => 'html', 
					'charset' => 'iso-8859-1'
				);
				$this->email->initialize($config);
				$this->email->set_mailtype("html");
				$this->email->set_newline("\r\n");
		 
		 
				$this->email->to($email);
				$this->email->from('techcentralhelp187@gmail.com');
				$this->email->subject('PASSWORD_RECOVERY - TECH_CENTRAL');
				$this->email->message($query2);

				$this->email->send();
				$this->load->view('forgot_success');

			} else {
				$this->load->view('forgot_error');	
			}

		}

		public function retrieve_password($email){
	 
	 		$this->db->select('password');
	 		$this->db->from('users');
	 		$this->db->where('email',$email);
	 		$this->db->limit(1);
			 $query=$this->db->get();
			 
		 	if ($query->num_rows() == 1){
				$val = $query->row();
				return $val->password;   
		 	} else {
		   		return false;
		   	}
		}

		public function retrieve_verification_code($email){

			$this->db->select('hash_code');
			$this->db->from('users');
			$this->db->where('email',$email);
			$this->db->limit(1);
			$query=$this->db->get();
			
			if ($query->num_rows() == 1){
			   $val = $query->row();
			   return $val->hash_code;   
			} else {
				  return false;
			}

		}

		public function retrieve_verification_code2($username){

			$this->db->select('hash_code');
			$this->db->from('users');
			$this->db->where('username',$username);
			$this->db->limit(1);
			$query=$this->db->get();
			
			if ($query->num_rows() == 1){
			   $val = $query->row();
			   return $val->hash_code;   
			} else {
				  return false;
			}

		}

		public function verify($verifycode, $username){
			$query = $this->User_model->retrieve_verification_code2($username);	
			if ($query == true && $verifycode == $query){
				$sql_query = "UPDATE users SET verified = 'VERIFIED' WHERE username = '$username'";
				$this->db->query($sql_query);
				$this->load->view('verify_success');				
			} else {
				$this->load->view('verify_failure');
			}
		}

		public function retrieve_verification_status($username){
			$this->db->select('verified');
			$this->db->from('users');
			$this->db->where('username',$username);
			$this->db->limit(1);
			$query=$this->db->get();
			
			if ($query->num_rows() == 1){
			   $val = $query->row();
			   return $val->verified;   
			} else {
				  return false;
			}
		}

		public function echo_verification_status(){
			$verification_status = $this->session->userdata('username');
			return $status = $this->User_model->retrieve_verification_status($verification_status);

		}
	}