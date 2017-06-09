<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class MProject extends CI_Model{
		
		public function __construct()
		{
			parent::__construct(); 	
			$this->load->database();	
		}
		
		public function get_p_id() // used
		{	
			$this->db->select_max('P_ID');
			$this->db->from('tb_project');
			$query = $this->db->get();

			if($query->num_rows() > 0)
			{
				foreach ($query->result() as $row)
				{
					return $row->P_ID;
				}
			}
			else
			{
				return FALSE;	
			}
		}
		
		public function get_td_version($p_id) // used
		{	
			$this->db->select_max('td_version');
			$this->db->from('tb_tech_design');
			$this->db->where('p_id', $p_id);
			$query = $this->db->get();

			if($query->num_rows() > 0)
			{
				foreach ($query->result() as $row)
				{
					return $row->td_version;
				}
			}
			else
			{
				return FALSE;	
			}
		}
		
		public function get_project_details($id)
		{	
			$this->db->select('tb_project.p_id as proj_id, tb_project.p_name as proj_name, capability.team as team, tb_project.p_start_dt as start_date, 
							   tb_project.p_end_dt as end_date, tb_project.p_status as status');
			$this->db->from('tb_project');
			$this->db->join('capability', 'tb_project.p_team_id = capability.id');
			$this->db->where('tb_project.p_id',$id);
			$query = $this->db->get();
			
			if($query->num_rows() > 0)
			{
				return $query;
			}
			else
			{
				return FALSE;	
			}					
		}
		
		public function get_td_details($id) // used
		{	
			$this->db->select('td_id, p_id, td_doc_name, td_doc_link, td_version');
			$this->db->from('tb_tech_design');
			$this->db->where('p_id',$id);
			$query = $this->db->get();
			
			if($query->num_rows() > 0)
			{
				return $query;
			}
			else
			{
				return FALSE;	
			}					
		}
		
		public function get_ee_details($id) // used
		{	
			$this->db->select('ee_id, p_id, ee_doc_name, ee_doc_link');
			$this->db->from('tb_entry_exit');
			$this->db->where('p_id',$id);
			$query = $this->db->get();
			
			if($query->num_rows() > 0)
			{
				return $query;
			}
			else
			{
				return FALSE;	
			}					
		}
		
		public function get_all_projects($limit, $start, $capabiltity_search, $status_search) // used
		{
			if ($capabiltity_search!='')
			{
				$this->db->where("(capability.id LIKE '%$capabiltity_search%')");
            }
			if ($status_search!='')
			{
				$this->db->where("(tb_project.p_status LIKE '%$status_search%')");
            }
			
			$this->db->limit($limit, $start);
			$this->db->select('tb_project.p_id as proj_id, tb_project.p_name as proj_name, capability.team as team, tb_project.p_start_dt as start_date, 
							   tb_project.p_end_dt as end_date, tb_project.p_status as status');
			$this->db->from('tb_project');
			$this->db->join('capability', 'tb_project.p_team_id = capability.id');
			
			$this->db->order_by("tb_project.p_id", "desc"); 
			
			$query = $this->db->get();
			
			if ($query->num_rows() > 0) {
				
				return $query;
			}
			$this->session->set_flashdata('message','No Project/s found!');
			redirect('project/display_projects','refresh');
		}
		
		public function proj_count($capabiltity_search='', $status_search='') {
			if ($capabiltity_search!='')
			{
				$this->db->where("(capability.id LIKE '%$capabiltity_search%')");
            }
			if ($status_search!='')
			{
				$this->db->where("(project.status LIKE '%$status_search%')");
            }
			
			$this->db->select('project.proj_id as proj_id, project.proj_name as proj_name, capability.team as team, project.start_date as start_date, project.end_date as end_date, project.status as status');
			$this->db->from('project');
			$this->db->join('capability', 'project.capability_id = capability.id');
			$this->db->order_by("project.proj_id", "desc"); 
			
			$query = $this->db->get();
			return $query->num_rows();
		}
		
		
		
		public function insert_project($data) // used
		{
			if($this->db->insert('tb_project', $data))
			{
				return TRUE;
			}
				return FALSE;
		}
		
		public function delete_project($p_id)
		{
			$this->db->where('p_id',$p_id);
			$this->db->delete('tb_project');	
		}
		
		public function delete_td($p_id)
		{
			$this->db->where('p_id',$p_id);
			$this->db->delete('tb_tech_design');	
		}
		
		public function delete_ee($p_id)
		{
			$this->db->where('p_id',$p_id);
			$this->db->delete('tb_entry_exit');	
		}
		
		public function insert_ee($data) //used
		{
			if($this->db->insert('tb_entry_exit', $data))
			{
				return TRUE;
			}
				return FALSE;
		}
		
		public function insert_td($data) //used
		{
			if($this->db->insert('tb_tech_design', $data))
			{
				return TRUE;
			}
				return FALSE;
		}
		
		
		public function get_all_proj_req($proj_id)
		{
			if($proj_id != '')
			{
					$this->db->where('pr.proj_id',$proj_id);
			}
			
			$this->db->select('pr.proj_req_id as proj_req_id, p.proj_name as proj_name, r.req_name as req_name, pr.doc_link as doc_link, pr.doc_name as doc_name, pr.rvw_link as rvw_link, pr.rvw_name as rvw_name, rev.eid as reviewer, asgnr.eid as assigner, asgne.eid as assignee, pr.status as status, r.req_type_id as req_type_id, pr.proj_id as proj_id', false);
			$this->db->from('project_req as pr');
			$this->db->join('project as p', 'pr.proj_id = p.proj_id');
			$this->db->join('req_type as r', 'r.req_type_id = pr.req_type_id');
			$this->db->join('user as rev', 'pr.reviewer_id = rev.id');
			$this->db->join('user as asgnr', 'pr.assigner_id = asgnr.id');
			$this->db->join('user as asgne', 'pr.assignee_id = asgne.id');
		
			//$this->db->order_by("project.proj_id", "asc"); 
			$query = $this->db->get();
			
			if($query->num_rows() > 0)
			{
				return $query;
			}	
			else
			{	
				return FALSE;
			}			
		}
		
		public function get_proj_req_dashbrd($id, $is_lead)
		{
			/*
				$this->db->where('pr.status != ', 'Approved');
				$this->db->where('pr.reviewer_id', $id);
				$this->db->or_where('pr.assignee_id', $id); 
			*/
			
			$team_id = '';
			if($is_lead != 1)
			{
				$where = "(pr.status != 'Closed' AND (pr.reviewer_id = $id OR pr.assignee_id = $id))";
				$this->db->where($where);
			}
			else
			{
				$team_id = $this->session->userdata('team_id');
				
				$this->db->where('pr.status != ', 'Closed');
				$this->db->where('p.capability_id', $team_id);
				
			}
				
			$this->db->order_by("pr.proj_req_id", "desc"); 
			
			$this->db->select('pr.proj_req_id as proj_req_id, p.proj_name as proj_name, r.req_name as req_name, pr.doc_link as doc_link, pr.doc_name as doc_name, pr.rvw_link as rvw_link, pr.rvw_name as rvw_name, rev.eid as reviewer, asgnr.eid as assigner, asgne.eid as assignee, pr.status as status, pr.reviewer_id as rev_id, pr.assignee_id as assign_id', false);
			$this->db->from('project_req as pr');
				
			/*
				select team_id from users where id = $id;
				select id from users where team_id = team_id(first query);
				select * from proj_req where assignee_id = id OR reviewer_id = id;
			*/
			
			$this->db->join('project as p', 'pr.proj_id = p.proj_id');
			$this->db->join('req_type as r', 'r.req_type_id = pr.req_type_id');
			
			$this->db->join('user as rev', 'pr.reviewer_id = rev.id');
			$this->db->join('user as asgnr', 'pr.assigner_id = asgnr.id');
			$this->db->join('user as asgne', 'pr.assignee_id = asgne.id');
			$query = $this->db->get();
			
			if($query->num_rows() > 0){
				return $query;
			}	
			else{	
				return FALSE;
			}	
		}
		
		public function get_req_type()
		{	
			$query = $this->db->get('req_type');

			if($query->num_rows() > 0)
			{
				return $query;
			}
			else
			{
				return FALSE;	
			}
		}
		
		public function insert_project_req($data)
		{
			if($this->db->insert('project_req', $data))
			{
				return TRUE;
			}
				return FALSE;
		}
		
		public function update_proj_req_dshbrd($id, $data) # 
		{
			$this->db->where('proj_req_id',$id);
			$this->db->update('project_req',$data);
		}
		
		/* Update Project */
		public function update_project($id, $data) 
		{
			$this->db->where('p_id',$id);
			$this->db->update('tb_project',$data);
		}
		
		public function update_td($id, $td_id, $data)
		{
			$this->db->where('td_id',$td_id);
			$this->db->where('p_id',$id);
			$this->db->update('tb_tech_design',$data);
		}
		
		public function update_ee($id, $ee_id, $data)
		{
			$this->db->where('ee_id',$ee_id);
			$this->db->where('p_id',$id);
			$this->db->update('tb_entry_exit',$data);
		}
	}
?>