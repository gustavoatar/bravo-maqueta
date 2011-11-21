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
	

	function config($action=null, $aid=null) 
	{
		$this->_check_login();
		$this->_selected("config");
	
		$this->data['result'] = FALSE;

		switch ($action) {
			
			case 'update':
				
				$this->admin_model->update_order($value, $key);

				break;
				
			case 'new':
			
				if($this->input->post('photo')) {
					$result = $this->admin_model->create_profile();
					if($result) $this->data['result'] = TRUE;
				}
				break;

			case 'delete':
				$this->data['result'] = TRUE;
				
				$this->admin_model->delete("admin_users", $aid);

				$this->data['users'] = $this->admin_model->get("admin_users");
				$this->load->view('admin/pages/config', $this->data);
				
				
				break;
				
			default:
			
				$this->data['users'] = $this->admin_model->get("admin_users");
				$this->load->view('admin/pages/config', $this->data);
				
				break;
			
		}

	}
	
	function logos($action=NULL, $aid=NULL)
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


			case 'upload':
			
				$config['upload_path'] =  $_SERVER['DOCUMENT_ROOT'].'/img/logos/';
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
					$image_path = "/img/logos/";
					$image_name = $image_resize['file_name'];
					$result = $this->admin_model->insert_logo($image_path, $image_name);
					echo "success";
				}
				
				break;
			
			
			case 'delete':
				
				$this->admin_model->delete("logos", $aid);
				
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
		$this->_selected("secciones");
		
		switch ($action) {
			case 'edit':
				
				if($this->input->post('guardar_seccion')) {
					$this->data['result'] = TRUE;
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
	
	
	function sliders($action=NULL, $aid=NULL) 
	{
		$this->_check_login();	
		$this->_selected("sliders");
		
		$this->data['result'] = FALSE;
		$this->data['action'] = $action;

		
		
		switch ($action) {
			case 'edit':
				 
				if($this->input->post('guardar')) {
					
					$result = $this->admin_model->modify_slider($aid);
				
					if($result) {
						$this->data['result'] = TRUE; 
					}

				}


				$this->data['slider'] = $result = $this->admin_model->get_one("sliders", "id = $aid");
				$this->data['images'] = $result = $this->admin_model->get("images");
				
				$this->load->view('admin/pages/sliders_edit', $this->data);
				
				break;
				
				
			case 'new':
				
				if($this->input->post('new_video')) {
					$result = $this->admin_model->new_video();
					if($result) $this->data['result'] = TRUE;
				}
				
				break;
				

			case 'update':
				
				
				parse_str($this->input->post('pages'), $pageOrder);
								
				foreach ($pageOrder['logo'] as $key => $value) {
					$this->admin_model->update_slider_order($value, $key);
				}
	
				break;
				
			case 'delete':
				
				$this->admin_model->delete("images", $aid);
				
				break;

			case 'upload':
			
				$config['upload_path'] =  $_SERVER['DOCUMENT_ROOT'].'/img/slider/upload/';
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
					$image_name = $image_resize['file_name'];
					$image_path = "/img/slider/upload/".$image_name;
					
					$result = $this->admin_model->insert_image($image_path, $aid);
					
					echo "success";
				}
				
				break;
				
			default:
				
				$this->data['sliders'] = $result = $this->admin_model->get("sliders");
				$this->data['images'] = $result = $this->admin_model->get("images");
				
				$this->load->view('admin/pages/sliders', $this->data);	
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