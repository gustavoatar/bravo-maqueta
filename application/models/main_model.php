<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class main_model extends CI_Model {


    function __construct()
    {
        parent::__construct();
    }
    
	
    function get_sections()
    {
        $query = $this->db->get('content');
        return $query->result();
    }
    function get_logos()
    {
       	$this->db->order_by("weight", "asc"); 
        $query = $this->db->get('logos');
        return $query->result();
    }
	
    function get_content($id)
    {
		$query = $this->db->get_where('content', array('vanity' => $id), 1);
        return $query->row();
    }
	


	
    function get_logo_pages($offset)
    {
    	$this->db->order_by("weight", "asc"); 
		$query = $this->db->get_where('logos', array('active' => 1), 15, $offset);
        return $query->result();
    }
	
	function get_logos_total()
	{
		$this->db->where('active', 1);
		return $this->db->count_all_results('logos');
	}
	
    function get_slider($id)
    {
		$query = $this->db->get_where('sliders', array('name' => $id), 1);
        return $query->row();
    }

    function get_slider_images($id)
    {
		$query = $this->db->get_where('images', array('sid' => $id));
        return $query->result();
    }
		
	function get_video_tags ($id) {
		$query = $this->db->query('SELECT tags.id FROM tags, videos, tags_rel WHERE tags_rel.tid = tags.id AND tags_rel.vid = videos.id AND tags_rel.vid = ?', array($id ));
        return $query->result();
	}
	
    
}