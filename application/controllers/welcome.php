<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {


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
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('main_model','',TRUE);
		//$this->load->library('session');
		$this->load->helper('url');
	} 
	
	public function index()
	{
		$data['logos'] = $this->main_model->get_logos();
		
		$data['content_agencia'] 	= $this->main_model->get_content("agencia");
		$data['content_marketing'] 	= $this->main_model->get_content("marketing");
		$data['content_creatividad']= $this->main_model->get_content("creatividad");
		$data['content_medios'] 	= $this->main_model->get_content("medios");
		$data['content_exterior'] 	= $this->main_model->get_content("exterior");
		$data['content_online'] 	= $this->main_model->get_content("online");
		
		$this->load->view('stage', $data);
	}

	public function slider($name)
	{
		$data['slider'] 	= $this->main_model->get_slider($name);
		$data['images'] 	= $this->main_model->get_slider_images($data['slider']->id);
		
		$this->load->view('pages/slider', $data);
		
	}
	
	public function principal()
	{
		
		$data['principal'] 	= $this->main_model->get_content($name);
		$this->load->view('pages/principal', $data);	
	}
	
	public function logos($offset=0)
	{
		$this->load->library('pagination');
		
		$data['logos'] = $this->main_model->get_logo_pages($offset);
		$data['total'] = $this->main_model->get_logos_total();
		
		$config['base_url'] = base_url().'index.php/welcome/logos/';
		$config['total_rows'] = $data['total'];
		$config['per_page'] = 15; 
		$config['display_pages'] = FALSE;
		$config['next_link'] = '';
		$config['next_tag_open'] = '<span class="arrow next">';
		$config['next_tag_close'] = '</span>';
		$config['prev_link'] = '';
		$config['prev_tag_open'] = '<span class="arrow previous">';
		$config['prev_tag_close'] = '</span>';

		$this->pagination->initialize($config); 
		
		
		$this->load->view('pages/logos', $data);
	}

	public function interior($name)
	{
		$data['section'] = $name;
		$data['interior'] 	= $this->main_model->get_content($name);
		$this->load->view('pages/interior', $data);
	}
	
	public function contacto()
	{
		
		$this->load->library('email');
		if($this->input->post())
		{
		
			$this->email->from('noresponder@bravopublicidad.es', 'Bravo web');
			$this->email->to('simbiosis@bravopublicidad.es'); 
			$config['charset'] = 'iso-8859-1';
			$config['wordwrap'] = TRUE;
			$config['mailtype'] = "HTML";
			$this->email->subject('Solicitud de la web');
			$spaceout = $this->input->post();
			$message = "Hay una solicidad nueva en la web con la siguiente información:\n\n";
			$message .= ""; 
			foreach ($spaceout as $sd => $sv) {
				$message .= "- ". $sd . ": " . $sv ."\n"; 
			}
			$message .= ""; 
			$message .= "\n\nUn saludo,\nLa Maquina ;)"; 
			$this->email->message($message);	
			$this->email->send();
			
			echo "Solicitud enviado con exito";
			
		}
	}
	
	
}