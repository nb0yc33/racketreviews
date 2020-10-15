<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scroll_pagination extends CI_Controller {

	function index()
	{
		$this->load->view('scroll_pagination');
	}

	function fetch()
	{
		$output = '';
		$this->load->model('scroll_pagination_model');
		$data = $this->scroll_pagination_model->fetch_data($this->input->post('limit'), $this->input->post('start'));
		if($data->num_rows() > 0)
		{
			foreach($data->result() as $row)
			{	
                $name = $row->video_filename;
				$title = $row->video_title;
				$user = $row->username;
				$tag = $row->video_tag;
                $desc = $row->video_desc;

                $file_location = "/video_uploads/$name";
                
                $output .= '<br> <h2> '.$title.' - '.$user.'</h2>
                    <video width="640" height="480" controls>
                        <source src="'.$file_location.'" type="video/mp4">
                        Your browser does not support the video element. Kindly update it to latest version.
                    </video>
                    <?php
                    if(!empty($tag)){ ?>
                        <html>
                            <h3> Tag - '.$tag.' </h3>
                        </html>
               <?php } ?>
                <?php
                    if(!empty($desc)){ ?>
                        <html>
                            <h3> Description -'.$desc.' </h3>
                        </html>
                <?php } ?>
                <br><br>
                <hr style="width:60%;">';
			}
		}
		echo $output;
	}


}