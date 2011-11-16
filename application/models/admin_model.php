<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin_model extends CI_Model {


    function __construct()
    {
        parent::__construct();
    }
    
	
    function get($table=null)
    {
        $query = $this->db->get($table);
        return $query->result();
    }

    function get_one($table=null, $where=null)
    {
    	if($where) { $this->db->where($where); }
        $query = $this->db->get($table);
        return $query->row();
    }
	
	function get_orderby($table=NULL, $orderby=NULL, $where=NULL)
	{
		if($where) { $this->db->where($where); }
		$this->db->order_by($orderby);
        $query = $this->db->get($table);
        return $query->result();
	}
	
    function get_content()
    {
		$query = $this->db->get_where('content', array('id' => "1"), 1);
        return $query->row();
    }
	
    function get_video($id)
    {
		$query = $this->db->get_where('videos', array('id' => $id), 1);
        return $query->row();
    }
	
    function updatesection($id)
    {
		
		$html = $this->input->post('html');
		$interior = $this->input->post('interior');
		
		$data = array(
		               'vanity' => $this->input->post('vanity'),
		               'html' => $html,
					   'interior' => $interior
		            );
					
		$this->db->where('id', $id);
		$query = $this->db->update('content', $data); 
		return $query;
    }
	
    function update_order($id, $weight)
    {
		$data = array('weight' => $weight, 'active' => '1');
		$this->db->where('id', $id);
		$query = $this->db->update('logos', $data); 
		return $query;
    }
    
    function update_status($id, $weight)
    {
		$data = array('weight' => $weight, 'active' => '1');
		$this->db->where('id', $id);
		$query = $this->db->update('logos', $data); 
		return $query;
    }
	
	function find_tag($vid, $tid) 
	{
		$this->db->where('tid', $tid);
		$this->db->where('vid', $vid);
		$this->db->from('tags_rel');
	
		return $this->db->count_all_results();
		
	}
	
	
    function delete_filter($id)
    {
        $query = $this->db->delete('tags', array('id' => $id)); 
        return $query;
    }


    function delete_admin_users($id)
    {
        $query = $this->db->delete('profiles', array('id' => $id)); 
        return $query;
    }



	function create_tag() 
	{
		$data = array('name' => $this->input->post("name"));
		$this->db->insert('tags', $data); 
	}
	
	function get_email($email="")
    {

		$this->db->select('*');
		$this->db->where('email', $email);
		$this->db->limit(1);

        $query = $this->db->get('admin_users');	
		//return $query->row();

		if ($query->num_rows() == 1) return $query->row();
		return NULL;
    }
}