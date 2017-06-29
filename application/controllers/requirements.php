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
		
		public function add_project_requirements()
		{
			/*if($this->submit_validate()===FALSE)
			{
				$this->session->set_flashdata('message','End Date should not be greater than the Start Date');
				redirect('project/display_projects/','refresh');	
			}
			else
			{*/
				// Insert new project requirement
				//get last_req_id
				
				$p_req_id = $this->m_requirements->get_p_req_id();
				if($p_req_id == FALSE){
					$p_req_id = 1;
				}
				else{	
					$p_req_id += 1;
				}
				
				$data['p_req_id'] = $p_req_id;
				$data['p_id'] = $this->input->post('p_id');
				$data['req_name'] = $this->input->post('p_name');
				$this->m_requirements->insert_proj_req($data);
				
				// Insert requirement document
				if($this->input->post('cb_code') != false)
				{
					$code['p_req_id'] = $p_req_id;
					$code['rt_id'] = 1;
					$code['status'] = $this->input->post('code_status');
					$this->m_requirements->insert_req_doc($code);
					
					// Get the requirement doc_id
					$req_doc_id = $this->m_requirements->get_req_doc_id($p_req_id, 1);
					
					// Insert Developers and Reviewers
					//DEV
					extract($_POST);
					foreach($code_assignee as $key=>$value) 
					{
						$cd_dev_arr = array(

							'p_req_id' => $p_req_id,
							'rt_id' => 1, // code
							'req_doc_id' => $req_doc_id,
							'assignee_id' => $code_assignee[$key],
							'reviewer_id' => 0,
							'assigner_id' => $this->session->userdata('id')
						);
						
						if($cd_dev_arr['assignee_id'] != null){
							$this->m_project->insert_dev_rev($cd_dev_arr);	
						}
					}
					//REV
					extract($_POST);
					foreach($code_reviewer as $key=>$value) 
					{
						$cd_rev_arr = array(

							'p_req_id' => $p_req_id,
							'rt_id' => 1, // code
							'req_doc_id' => $req_doc_id,
							'assignee_id' => 0,
							'reviewer_id' => $code_reviewer[$key],
							'assigner_id' => $this->session->userdata('id')
						);
						
						if($cd_rev_arr['reviewer_id'] != null){
							$this->m_project->insert_dev_rev($cd_rev_arr);	
						}
					}
				}
				else if($this->input->post('cb_utp') != false)
				{
					$utp['p_req_id'] = $p_req_id;
					$utp['rt_id'] = 2;
					$utp['status'] = $this->input->post('code_status');
					$this->m_requirements->insert_req_doc($utp);
					
					// Get the requirement doc_id
					$req_doc_id = $this->m_requirements->get_req_doc_id($p_req_id, 2);
					
					// Insert Developers and Reviewers
					//DEV
					extract($_POST);
					foreach($utp_assignee as $key=>$value) 
					{
						$utp_dev_arr = array(

							'p_req_id' => $p_req_id,
							'rt_id' => 2, // utp
							'req_doc_id' => $req_doc_id,
							'assignee_id' => $utp_assignee[$key],
							'reviewer_id' => 0,
							'assigner_id' => $this->session->userdata('id')
						);
						
						if($utp_dev_arr['assignee_id'] != null){
							$this->m_project->insert_dev_rev($utp_dev_arr);	
						}
					}
					//REV
					extract($_POST);
					foreach($utp_reviewer as $key=>$value) 
					{
						$utp_rev_arr = array(

							'p_req_id' => $p_req_id,
							'rt_id' => 2, // utp
							'req_doc_id' => $req_doc_id,
							'assignee_id' => 0,
							'reviewer_id' => $utp_reviewer[$key],
							'assigner_id' => $this->session->userdata('id')
						);
						
						if($utp_rev_arr['reviewer_id'] != null){
							$this->m_project->insert_dev_rev($utp_rev_arr);	
						}
					}
				}
				else if($this->input->post('cb_ute') != false)
				{
					$ute['p_req_id'] = $p_req_id;
					$ute['rt_id'] = 3;
					$ute['status'] = $this->input->post('code_status');
					$this->m_requirements->insert_req_doc($ute);
					
					// Get the requirement doc_id
					$req_doc_id = $this->m_requirements->get_req_doc_id($p_req_id, 3);
					
					// Insert Developers and Reviewers
					//DEV
					extract($_POST);
					foreach($ute_assignee as $key=>$value) 
					{
						$ute_dev_arr = array(

							'p_req_id' => $p_req_id,
							'rt_id' => 3, // ute
							'req_doc_id' => $req_doc_id,
							'assignee_id' => $ute_assignee[$key],
							'reviewer_id' => 0,
							'assigner_id' => $this->session->userdata('id')
						);
						
						if($ute_dev_arr['assignee_id'] != null){
							$this->m_project->insert_dev_rev($ute_dev_arr);	
						}
					}
					//REV
					extract($_POST);
					foreach($ute_reviewer as $key=>$value) 
					{
						$ute_reviewer = array(

							'p_req_id' => $p_req_id,
							'rt_id' => 3, // ute
							'req_doc_id' => $req_doc_id,
							'assignee_id' => 0,
							'reviewer_id' => $ute_reviewer[$key],
							'assigner_id' => $this->session->userdata('id')
						);
						
						if($ute_reviewer['reviewer_id'] != null){
							$this->m_project->insert_dev_rev($ute_reviewer);	
						}
					}
				}
					
				$this->session->set_flashdata('message','New project requirement has been added!');
				redirect('requirements/show_project_requirements/'.$data['p_id'],'refresh');
			//}	
		}
			
		public function show_project_requirements($proj_id) 
		{		
			// forbidden jutsu! :)
			// did this just to get the project name to be placed inside the modal
			$this->db->select('p_name, p_id');
			$this->db->from('tb_project');
			$this->db->where('p_id',$proj_id);
			$query = $this->db->get();
			$data['proj_name'] = $query->result();
			
			$this->db->select('id, eid');
			$this->db->from('user');
			if($this->session->userdata('is_admin') != 1)
			{
				$this->db->where('team_id', $this->session->userdata('team_id'));
			}
			$this->db->where('is_active !=', 0);
			$query = $this->db->get();
			$data['eid'] = $query->result();
		
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