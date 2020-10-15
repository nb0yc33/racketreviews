<?php
class Search_model extends CI_Model {
    
    function fetch_data($query){
        $this->db->select("*");
        $this->db->from("videos");
        if($query != ''){
            $this->db->like('video_title', $query);
            $this->db->or_like('username', $query);
            $this->db->or_like('video_tag', $query);
            $this->db->or_like('video_desc', $query);
        }
        $this->db->order_by('video_id', 'DESC');
        return $this->db->get();
    }
}
?>