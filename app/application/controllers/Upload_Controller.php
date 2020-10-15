<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Upload_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function do_upload(){

		  if ($_POST['submit'] == 'UPLOAD_VIDEO'){
            $username = $this->session->userdata('username');
		        $title = $this->input->post("title");
		        $tag = $this->input->post("tag");
		        $desc = $this->input->post("desc");	

		        $this->load->model('User_model');	

		        $data['title']=$title;
		        $data['tag']=$tag;
		        $data['desc']=$desc;

		      if ($title == ''){
			      $this->load->view('upload_failure');
		      } else {
                $config = array(
                'upload_path' => "./video_uploads/",
                'allowed_types' => "mp4",
                'overwrite' => TRUE,
                'max_size' => "1000000", 
                'max_height' => "1440",
                'max_width' => "2560"
                );
                $this->load->library('upload', $config);
                if($this->upload->do_upload()){
                    $data = array('upload_data' => $this->upload->data());
                    $file_info = $this->upload->data();
                    $filename = $file_info['file_name'];
                    $this->User_model->video_details($filename, $title, $tag, $desc, $username);
                    $this->load->view('upload_success',$data);
                } else {
                  $this->load->view('upload_failure');
                }
            }
       }
    }


}
