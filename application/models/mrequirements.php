<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class MRequirements extends CI_Model{
		
		public function __construct()
		{
			parent::__construct(); 	
			$this->load->database();	
		}
			
		public function get_all_proj_req($limit, $start, $status_search, $req_type_search, $proj_id) // used
		{
			if ($req_type_search!='')
			{
				$this->db->where("(rt.rt_id LIKE '%$req_type_search%')");
            }
			if ($status_search!='')
			{
				$this->db->where("(rd.status LIKE '%$status_search%')");
            }
			if($proj_id != '')
			{
					$this->db->where('pr.p_id',$proj_id);
			}
			
			
			$this->db->limit($limit, $start);
			$this->db->select('pr.p_req_id as p_req_id, pr.p_id as p_id, pr.req_name as req_name, rt.rt_name as req_type, rd.status as status, rd.doc_name as doc_name, rd.req_doc_id as req_doc_id,
				   rd.doc_link as doc_link, rd.rev_name as rev_name, rd.rev_link as rev_link, rd.chklist_name as chklist_name, rd.chklist_link as chklist_link, (select group_concat(distinct(asgne.eid) SEPARATOR "; ") from tb_dev_rev dr
				   join user asgne on dr.assignee_id = asgne.id
				   where dr.p_req_id = rd.p_req_id and dr.rt_id = rd.rt_id) as assignee,
					(select group_concat(distinct(rev.eid) SEPARATOR "; ") from tb_dev_rev dr
				   join user rev on dr.reviewer_id = rev.id
				   where dr.p_req_id = rd.p_req_id and dr.rt_id = rd.rt_id) as reviewer');
			$this->db->from('tb_proj_req as pr');
			$this->db->join('tb_req_doc as rd', 'pr.p_req_id = rd.p_req_id');
			$this->db->join('tb_req_type as rt', 'rd.rt_id = rt.rt_id');
			$this->db->order_by("rd.req_doc_id", "desc"); 
			
			$query = $this->db->get();
			
			if ($query->num_rows() > 0) {
				
				return $query;
			}
			else
			{	
				return FALSE;
			}
			$this->session->set_flashdata('message','No Project Requirement/s found!');
			redirect('requirements/show_project_requirements/'.$proj_id,'refresh');
		}
		
		public function req_count($status_search='', $req_type_search='', $proj_id='') 
		{
			if ($req_type_search!='')
			{
				$this->db->where("(rt.rt_id LIKE '%$req_type_search%')");
            }
			if ($status_search!='')
			{
				$this->db->where("(rd.status LIKE '%$status_search%')");
            }
			if($proj_id != '')
			{
					$this->db->where('pr.p_id',$proj_id);
			}
			
			$this->db->select('pr.p_req_id as p_req_id, pr.p_id as p_id, pr.req_name as req_name, rt.rt_name as req_type, rd.status as status, rd.doc_name as doc_name, rd.req_doc_id as req_doc_id,
				   rd.doc_link as doc_link, rd.rev_name as rev_name, rd.rev_link as rev_link, rd.chklist_name as chklist_name, rd.chklist_link as chklist_link, (select group_concat(distinct(asgne.eid) SEPARATOR "; ") from tb_dev_rev dr
				   join user asgne on dr.assignee_id = asgne.id
				   where dr.p_req_id = rd.p_req_id and dr.rt_id = rd.rt_id) as assignee,
					(select group_concat(distinct(rev.eid) SEPARATOR "; ") from tb_dev_rev dr
				   join user rev on dr.reviewer_id = rev.id
				   where dr.p_req_id = rd.p_req_id and dr.rt_id = rd.rt_id) as reviewer');
			$this->db->from('tb_proj_req as pr');
			$this->db->join('tb_req_doc as rd', 'pr.p_req_id = rd.p_req_id');
			$this->db->join('tb_req_type as rt', 'rd.rt_id = rt.rt_id');
			
			$query = $this->db->get();
			
			if ($query->num_rows() > 0) {
				
				return $query->num_rows();
			}
			else
			{	
				$this->session->set_flashdata('message','No Project Requirement/s found!');
				redirect('requirements/show_project_requirements/'.$proj_id,'refresh');
			}
			
		}
		
		public function get_p_req_id() // used
		{	
			$this->db->select_max('p_req_id');
			$this->db->from('tb_proj_req');
			$query = $this->db->get();

			if($query->num_rows() > 0)
			{
				foreach ($query->result() as $row)
				{
					return $row->p_req_id;
				}
			}
			else
			{
				return FALSE;	
			}
		}
		
		public function insert_proj_req($data) // used
		{
			if($this->db->insert('tb_proj_req', $data))
			{
				return TRUE;
			}
				return FALSE;
		}
		
		public function insert_req_doc($data) // used
		{
			if($this->db->insert('tb_req_doc', $data))
			{
				return TRUE;
			}
				return FALSE;
		}
		
		public function get_req_doc_id($p_req_id, $rt_id) // used
		{	
			$this->db->select('req_doc_id');
			$this->db->from('tb_req_doc');
			$this->db->where('p_req_id', $p_req_id);
			$this->db->where('rt_id', $rt_id);
			$query = $this->db->get();

			if($query->num_rows() > 0)
			{
				foreach ($query->result() as $row)
				{
					return $row->req_doc_id;
				}
			}
			else
			{
				return FALSE;	
			}
		}
		
		public function insert_dev_rev($data) // used
		{
			if($this->db->insert('tb_dev_rev', $data))
			{
				return TRUE;
			}
				return FALSE;
		}
			
		/*delete*/
		
		public function delete_dev_rev($id)
		{
			$this->db->where('req_doc_id',$id);
			$this->db->delete('tb_dev_rev');		
		}
		
		public function delete_req_doc($id)
		{
			$this->db->where('req_doc_id',$id);
			$this->db->delete('tb_req_doc');
		}
		
		/*public function delete_proj_req($id) //used
		{
			$this->db->where('p_req_id',$id);
			$this->db->delete('tb_proj_req');
		}*/
		
	}
?>