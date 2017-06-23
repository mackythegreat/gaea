<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class MRequirements extends CI_Model{
		
		public function __construct()
		{
			parent::__construct(); 	
			$this->load->database();	
		}
		
		public function get_all_proj_req($proj_id)
		{
			if($proj_id != '')
			{
					$this->db->where('pr.p_id',$proj_id);
			}
			
			
			$this->db->select('pr.req_name as req_name, rt.rt_name as req_type, rd.status as status, rd.doc_name as doc_name, 
				   rd.doc_link as doc_link, rd.rev_name as rev_name, rd.rev_link as rev_link, rd.chklist_name as chklist_name, rd.chklist_link as chklist_link, (select group_concat(asgne.eid SEPARATOR "; ") from tb_dev_rev dr
				   join user asgne on dr.assignee_id = asgne.id
				   where dr.p_req_id = 1 and dr.rt_id = rd.rt_id) as assignee');
			$this->db->from('tb_proj_req as pr');
			$this->db->join('tb_req_doc as rd', 'pr.p_req_id = rd.p_req_id');
			$this->db->join('tb_req_type as rt', 'rd.rt_id = rt.rt_id');
		
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
		
		
		
	}
?>