<?php

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
 * @see http://codeigniter.com/user_guide/general/urls.html
 */

class admin extends CI_Controller 
{	
	/**
	 * 
	 * Load construct and set values for app.
	 * 
	 */
	
    var $sess_profile   = '';
    var $sess_email 	= '';
    var $sess_vanity 	= '';
    var $logged    		= '';
	var $data 			= '';
	
	function __construct()
	{
		
		parent::__construct();
		$this->load->model('admin_model','',TRUE);
		$this->load->library('session');
		$this->load->helper('url');
		
		$this->sess_profile		= $this->session->userdata('profile');
		$this->sess_email		= $this->session->userdata('email');

		$this->logged			= $this->session->userdata('logged_in');
		
		$this->data['sel_secciones'] = "";
		$this->data['sel_sliders'] 	= "";
		$this->data['sel_logos'] 	= "";
		$this->data['sel_config'] 	= "";
		$this->data['sel_cm'] 		= "";
		$this->data['post'] 		= FALSE;
		
	}
	
	
	function index()
	{
		$this->_check_login();	
		$this->_selected("videos");
		
		$this->logos();
	}
	
	
	function login()
	{ 
		
		if($this->logged) {
			redirect('/admin/');
		}
		
		$this->data['message']	= "";
		$this->data['post'] = FALSE;
		
			if($this->input->post('gologin')) {
				
				$valcheck = TRUE;
				$this->data['post'] = TRUE;
				$valemail = $this->input->post('email');
				$password  = md5($this->input->post('password'));

				if(($valemail) && ($password)) {
					
					$check_email = $this->admin_model->get_email($valemail);
					
					if(isset($check_email) && ($password == $check_email->password)) {
						
						if($valcheck){
							$newdata = array(
							                   'userid'  => $check_email->id,
							                   'role'  => $check_email->id,
							                   'email'     => $check_email->email,
							                   'logged_in' => TRUE
							               );

							$this->session->set_userdata($newdata);
							redirect('/admin/');

						} else {
							$this->data['logged']	  = $valcheck;
							$this->data['message'] = "Combinac&iacute;on email / clave no correto";
						}

					} else {
						$this->data['logged']	  = FALSE;
						$this->data['message'] = "Combinac&iacute;on email / clave no correto";
					}
				} else {					
					$this->data['logged'] = FALSE;
					$this->data['message'] = "Todos los campos son obligatorios";
				}
			}

		$this->load->view('admin/pages/login', $this->data);
	}
	

	function config() 
	{
		$this->_check_login();	
		$this->load->view('admin/pages/config', $this->data);	
	}
	
	function logos($action=NULL)
	{
		$this->data['result'] = FALSE;
		$this->_check_login();
		$this->_selected("logos");
		
		switch ($action) {
			
			case 'update':
				
				
				parse_str($this->input->post('pages'), $pageOrder);
				
				//print_r($pageOrder);
				
				foreach ($pageOrder['logo'] as $key => $value) {
					$this->admin_model->update_order($value, $key);
				}
	

				break;
				
			case 'new':
			
				if($this->input->post('photo')) {
					$result = $this->admin_model->create_profile();
					if($result) $this->data['result'] = TRUE;
				}
				break;


			case 'new':
			
				if($this->input->post('photo')) {
					$result = $this->admin_model->create_profile();
					if($result) $this->data['result'] = TRUE;
				}
				break;
			
			case 'delete':
				
				$result = $this->admin_model->delete("logos", $this->input->post('lid'));
				if($result) $this->data['result'] = TRUE;
				$this->load->view('admin/pages/profiles', $this->data);
				
				break;
				
			default:
			
				$this->data['logos'] = $this->admin_model->get_orderby("logos", "weight", "active = 1");
				$this->data['logosoff'] = $this->admin_model->get_orderby("logos", "weight", "active = '0'");
				$this->load->view('admin/pages/images', $this->data);	
				break;
			
		}
	}
	
	
	function secciones($action=NULL, $aid=NULL) 
	{
		$this->data['result'] = FALSE;
		$this->_check_login();	
		$this->_selected("profiles");
		
		switch ($action) {
			case 'edit':
				
				if($this->input->post('guardar_seccion')) {
					$this->data['result'] = TRUE;
					
					//print_r($this->input->post());
					
					//echo $this->input->post('html');
					
					$this->admin_model->updatesection($aid);
					
				}
				
				$this->data['filter'] = $this->admin_model->get_one("content", "id = $aid");
				$this->load->view('admin/pages/secciones_edit', $this->data);	
				
				break;
			
			case 'photo':
				
				$config['upload_path'] =  $_SERVER['DOCUMENT_ROOT'].'/images/techs/thumbnails/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '2000';
				$config['max_width']  = '1024';
				$config['max_height']  = '768';
		
				$this->load->library('upload', $config);
		
				if (!$this->upload->do_upload()) {
					
					$error = array('error' => $this->upload->display_errors());
					echo "error";
					
				} else {
					
					echo "success";
					$data = array('upload_data' => $this->upload->data());
					
				}
				
				break;
				
			case 'new':
			

				if($this->input->post('photo')) {
					$result = $this->admin_model->create_profile();
					if($result) $this->data['result'] = TRUE;
				}
				
				break;
			
			case 'delete':
				
				$result = $this->admin_model->delete_profile($aid);
				if($result) $this->data['result'] = TRUE;
				$this->load->view('admin/pages/profiles', $this->data);
				
				break;
				
			default:
				
				$this->data['result'] = $this->admin_model->get("content");
				$this->load->view('admin/pages/secciones', $this->data);	
				
				break;
				
		}

	}
	
	
	function videos($action=NULL, $aid=NULL) 
	{
		$this->_check_login();	
		$this->_selected("videos");
		
		$this->data['result'] = FALSE;
		$this->data['action'] = $action;


		
		
		switch ($action) {
			case 'edit':
				
				if($this->input->post('modify_video')) {
					print_r($this->input->post());
					$passingtags = $this->input->post('tags');
					$result = $this->admin_model->modify_video($aid);
					
					if($result) {
						
						foreach ($passingtags as $pt) {
							$existrel = $this->admin_model->find_tag($aid,$val); 
							if($existrel >= "1") {
								//$this->admin_model->modify_video($aid, $val);
								
							}
							
							
						}
						
						$this->data['result'] = TRUE; 
					}

				}
				
				$this->data['tags'] = $this->admin_model->get_filters();
				$cleanit = $this->admin_model->get_video_tags($aid);
				$newvalues = array();
				foreach ($cleanit  as $c) {
					$newvalues[] = $c->id;
				}
				$this->data['tags_selected'] = $newvalues;
				$this->data['video'] = $result = $this->admin_model->get_video($aid);
				$this->data['embedded'] = simplexml_load_string($this->_curl_get("http://vimeo.com/api/oembed.xml?url=".$this->data['video']->link."&height=200"));
				$this->load->view('admin/pages/videos_edit', $this->data);
				
				break;
				
			case 'new':
				
				if($this->input->post('new_video')) {
					$result = $this->admin_model->new_video();
					if($result) $this->data['result'] = TRUE;
				}
				
				break;
				
			case 'delete':
				
				$this->data['videos'] = $result = $this->admin_model->get_videos();
				$result = $this->admin_model->delete_video($aid);
				if($result) $this->data['result'] = TRUE;
				$this->load->view('admin/pages/videos', $this->data);
				
				break;
				
			default:
				
				$this->data['tags'] = $this->admin_model->get_filters();
				$this->data['videos'] = $result = $this->admin_model->get_videos();
				$this->load->view('admin/pages/videos', $this->data);	
				break;
				
		}
		
	}


	function filters($action=NULL, $aid=NULL) 
	{
		$this->_check_login();
		$this->_selected("filters");
		$this->data['post'] = FALSE;
		$this->data['result'] = FALSE;
		
		switch ($action) {
			case 'edit':
				
				if($this->input->post('modify_filter')) {
					$result = $this->admin_model->modify_filter($aid);
					if($result) { $this->data['result'] = TRUE; }
				}
				
				$this->data['filter'] = $result = $this->admin_model->get_filter($aid);
				$this->load->view('admin/pages/filters_edit', $this->data);
				
				break;
				
			case 'new':
				
				if($this->input->post('name')) {
					$result = $this->admin_model->create_tag();
					if($result) $this->data['result'] = TRUE;
				}
				
				$this->load->view('admin/pages/filters', $this->data);
				
				break;
				
			case 'delete':
				
				$result = $this->admin_model->delete_filter($aid);
				if($result) $this->data['result'] = TRUE;
				$this->data['filters'] = $result = $this->admin_model->get_filters();
				$this->load->view('admin/pages/filters', $this->data);
				
				break;
				
			default:
				
				$this->data['filters'] = $result = $this->admin_model->get_filters();
				$this->load->view('admin/pages/filters', $this->data);	
				
				break;
				
		}
	}


	function cm($action=NULL) 
	{
		$this->_check_login();
		$this->_selected("cm");
		$this->data['result'] ="";
		
		switch ($action) {
				
			case 'update':
				
				if($this->input->post('about_save')) {
					
					$result = $this->admin_model->modify_about();
					if($result) $this->data['result'] = "about";
				}


				if($this->input->post('contact_save')) {
					
					$result = $this->admin_model->modify_contact();
					if($result) {
						 $this->data['result'] = "contact"; 
					}
				}

				$this->data['data'] = $this->admin_model->get_content();
				$this->load->view('admin/pages/cm', $this->data);
			
				break;
				
				
			case 'upload':
			
					$config['upload_path'] =  $_SERVER['DOCUMENT_ROOT'].'/images/docs/';
					$config['allowed_types'] = 'pdf';
					$config['max_size']	= '10000';

					$this->load->library('upload', $config);
			
					if (!$this->upload->do_upload()) {
						$error = array('error' => $this->upload->display_errors());
						echo "error";
					} else {
						echo "success";
						$data = array('upload_data' => $this->upload->data());
					}
				
				break;
				

				
			default:
				
				$this->data['data'] = $this->admin_model->get_content();
				$this->load->view('admin/pages/cm', $this->data);
				
				break;
				
		}
	}	
	
	function images($action=NULL, $aid=NULL) 
	{
		$this->_check_login();
		$this->_selected("images");

		switch ($action) {
			case 'edit':
				
				if($this->input->post('modify_filter')) {
					$result = $this->admin_model->modify_filter($aid);
					if($result) { $this->data['result'] = TRUE; }
				}
				
				$this->data['filter'] = $result = $this->admin_model->get_filter($aid);
				$this->load->view('admin/pages/filters_edit', $this->data);
				
				break;
				
			case 'new':
				
				if($this->input->post('photo')) {
					
					$result = $this->admin_model->create_image();
					if($result) $this->data['result'] = TRUE;
				}
								
				break;
				
				
			case 'upload':
			
					$config['upload_path'] =  $_SERVER['DOCUMENT_ROOT'].'/images/studiobig/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '2000';
					$config['max_width']  = '1024';
					$config['max_height']  = '768';
			
					$this->load->library('upload', $config);
			
					if (!$this->upload->do_upload()) {
						
						$error = array('error' => $this->upload->display_errors());
						echo "error";
						
					} else {
						
						$image_resize = $this->upload->data();
						
						$configsize['image_library'] = 'gd2';
						$configsize['source_image']	= $image_resize['full_path'];
						$configsize['new_image'] = $_SERVER['DOCUMENT_ROOT'].'/images/studiothumb/'.$image_resize['file_name'];
						$configsize['maintain_ratio'] = TRUE;
						$configsize['width']	 = 200;
						
						$this->load->library('image_lib', $configsize); 
						$this->image_lib->resize();
						
						if(!$this->image_lib->resize()) {
							echo "error";
						} else {
							echo "success";
						}
						
						$data = array('upload_data' => $this->upload->data());
						
					}
				
				break;
				
			case 'delete':
				
				$result = $this->admin_model->delete_image($aid);
				if($result) $this->data['result'] = TRUE;
				$this->data['images'] = $this->admin_model->get_images();
				$this->load->view('admin/pages/images', $this->data);
				
				break;
				
			default:
				
				$this->data['images'] = $this->admin_model->get_images();
				$this->load->view('admin/pages/images', $this->data);
				
				break;
				
		}
		
	}	
	
	
	function logout()
	{
		$this->session->sess_destroy();
		redirect('/admin/login/?s=l');

	}
	
	function _check_login()  {
		if(!$this->logged) {
			redirect('/admin/login');
			exit;
		}
	}
	
	
	function _selected($sel) 
	{
		
		$this->data['sel_secciones'] = "";
		$this->data['sel_sliders'] 	= "";
		$this->data['sel_logos'] 	= "";
		$this->data['sel_config']	= "";
		$this->data['sel_images'] 	= "";
		
		switch ($sel) {
			case 'secciones':
				$this->data['sel_secciones'] 	= "selected";
				break;
			case 'sliders':
				$this->data['sel_sliders'] 	= "selected";
				break;
			case 'logos':
				$this->data['sel_logos'] 	= "selected";
				break;
			case 'config':
				$this->data['sel_config'] 	= "selected";
				break;
			case 'images':
				$this->data['sel_images'] 	= "selected";
				break;
				
			default:
				break;
		}
	}
	
	function _curl_get($url) 
	{
		
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		$return = curl_exec($curl);
		curl_close($curl);
		return $return;
	
	}
}