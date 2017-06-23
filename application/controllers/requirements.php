<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Requirements extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			
			$this->load->helper(array('url','form'));
			$this->load->library('form_validation');
			$this->load->library('pagination');	
			$this->load->model('mproject','m_project');
			$this->load->model('mrequirements','m_requirements');
			$this->load->model('muser','m_user'); 
			$this->load->library('session');
			$this->load->library('email'); 

			if (!$this->session->userdata('eid')){
				header('Location: '.site_url('login/authenticate'));
			}
		}
		
		/*public function show_project_requirements($proj_id)
		{    	
			if($row = $this->m_requirements->get_all_proj_req($proj_id))
			{
				$data['proj_req_tbl'] = $row->result();
			}
			
			$data['title'] = 'Project Requirements';
			$data['norecord'] = '';
			$this->load->view('template/header');
			$this->load->view('project/project_requirements',$data);
			$this->load->view('template/footer');
		}*/
		
		public function show_project_requirements($proj_id) 
		{		
			$config = array();				
			$config['base_url'] = site_url('requirements/show_project_requirements/'.$proj_id);

			$where = "(SELECT p_req_id from tb_proj_req WHERE p_id = $proj_id)";
			$query = $this->db->where('p_req_id', $where)->get('tb_proj_req');
			$config['total_rows'] = $query->num_rows();
			
			
			$config['per_page'] = 10;
			$config["uri_segment"] = 3;
			$choice = $config["total_rows"]/$config["per_page"];
			$config["num_links"] = floor($choice);
			
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = '&#171';
			$config['last_link'] = '&#187';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = '&#139';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '&#155';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			
			$this->pagination->initialize($config);

			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			
			$projects_result = $this->m_requirements->get_all_proj_req($config["per_page"], $page, '', '', $proj_id);
			if($projects_result != FALSE)
			{
				$data["proj_req_tbl"] = $projects_result->result();
			}
			
			$data["pagination"] = $this->pagination->create_links();

			$data['title'] = 'Project Requirements';
			$data['norecord'] = '';
			$this->load->view('template/header');
			$this->load->view('project/project_requirements',$data);
			$this->load->view('template/footer');
		}
		
		public function filter()
		{
			
			$req_type_search = ($this->input->post("req_type_search"))? $this->input->post("req_type_search") : 0;
			$status_search = ($this->input->post("status_search"))? $this->input->post("status_search") : 0;
			$proj_id = ($this->input->post("proj_id"))? $this->input->post("proj_id") : 0;
			

			// pagination settings
			$config = array();
			$config['base_url'] = site_url("project/filter/$proj_id/$req_type_search/$status_search");
			$config['total_rows'] = $this->m_requirements->req_count($status_search,$req_type_search, $proj_id);
			$config['per_page'] = 10;
			$config["uri_segment"] = 6;
			$choice = $config["total_rows"]/$config["per_page"];
			$config["num_links"] = floor($choice);

			// integrate bootstrap pagination
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = 'Prev';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = 'Next';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);

			$page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
			$projects_result = $this->m_requirements->get_all_proj_req($config['per_page'], $page, $status_search, $req_type_search, $proj_id);
			$data["proj_req_tbl"] = $projects_result->result();
			$data['pagination'] = $this->pagination->create_links();

			$data['title'] = 'Project Requirements';
			$data['norecord'] = '';
			$this->load->view('template/header');
			$this->load->view('project/project_requirements',$data);
			$this->load->view('template/footer');
		}
		
	}
?>