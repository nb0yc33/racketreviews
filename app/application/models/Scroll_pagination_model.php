<?php
class Scroll_pagination_model extends CI_Model
{
	function fetch_data($limit, $start)
	{
		$this->db->select("*");
		$this->db->limit($limit, $start);
		$query = $this->db->get('videos');
		return $query;
	}
}
?>