<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

    function index(){
        $this->load->view('search');
    }

    function fetch(){
        $output = '';
        $query = '';
        $this->load->model('search_model');
        if($this->input->post('query')){
            $query = $this->input->post('query');
        }
        $data = $this->search_model->fetch_data($query);
        $output .= '
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>TITLE</th>
                            <th>USERNAME</th>
                            <th>TAG</th>
                            <th>DESCRIPTION</th>
                            <th>VIEW_VIDEO</th>
                        </tr>
                   ';
        if($data->num_rows() > 0){
            foreach($data->result() as $row){
                $filename = $row->video_filename;
                $output .= '
                            <tr>
                                <td>'.$row->video_title.'</td>
                                <td>'.$row->username.'</td>
                                <td>'.$row->video_tag.'</td>
                                <td>'.$row->video_desc.'</td>
                                <td> <a href = "http://localhost/infs3202/video_uploads/'.$filename.'">'.$row->video_title.'</a> </td>
                            </tr>
                            ';
            }
        } else {
            $output .= '<tr>
                            <td colspan="5">NO_VIDEOS_FOUND</td>
                        </tr>';
        }
        $output .= '</table>';
        echo $output;
    }
 
}