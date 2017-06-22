<title>Project Requirements</title>

<?php $status = array ('' => 'All',
					   'Not Started' => 'Not Started',
					   'In Progress' => 'In Progress',
					   'Completed' => 'Completed'); ?>
					   
<?php $req_type = array (''  => 'All',
					     '1' => 'UTP',
					     '2' => 'CODE',
					     '3' => 'UTE'); ?>
					   
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php if($this->session->flashdata('message')){ ?> <div class="alert alert-success text-center"> <?php echo $this->session->flashdata('message'); ?> </div> <?php } ?>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<!--addPRModal Placeholder-->
				<div style='margin-right: 15px; margin-lef:10px;'>
				<button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#addPRModal" data-id='<?php echo $item->proj_req_id;?>'>Add New Requirement</button>
				<?php $this->view('/modals/add_project_requirement');?>
				</div>
				<!--end of addPRModal Placeholder-->
			</div>
			
			<div> <br/><br/> </div>
		</div>
		
		
		
		<div class="row">
			<div class="col-md-12">
				<!-- Filter -->
				<div class="small col-md-3 well">
					<!-- Requirement Type -->
					<label><span class="text-danger"><b></b></span> Requirement Type</label><br />
					<?php echo form_dropdown('req_type', $req_type, '', 'class="form-control form-control-lg" id="stat"'); ?> 
					<br />
					
					<!-- Status -->
					<label><span class="text-danger"><b></b></span> Status</label><br />
					<?php echo form_dropdown('status_search', $status, '', 'class="form-control form-control-lg" id="stat"'); ?> 
					<br />
					
					
				</div>
				
				<div class="small col-md-9">
				<table class= "table">
					<thead>
						<tr style="background-color:#333;color:#fff;">
							<th>REQUIREMENT</th>
							<th>DOCUMENT</th>
							<th>ASSIGNEE</th>
							<th>POINTSHEET</th>
							<th>REVIEWER</th>
							<th>STATUS</th>
							<th colspan = 3>ACTION</th>
						</tr>
					</thead>

					<tbody>
					<?php if(empty($proj_req_tbl)) {?>	
						<tr class="text-center">
							<td colspan=10>No assigned requirements yet.</td>
						</tr> 
					<?php } else { ?>
				
					<?php foreach ($proj_req_tbl as $item):?>
					
						<tr>
							<td><?php echo $item->req_name;?></td>
							<td><?php if ($item->doc_link){ echo anchor($item->doc_link, $item->doc_name, 'target="_blank"'); }?></td>
							<td><?php echo $item->assignee;?></td>
							<td><?php if ($item->rvw_link){ echo anchor($item->rvw_link, $item->rvw_name, 'target="_blank"'); }?></td>
							<td><?php echo $item->reviewer;?></td>
							
							<?php 
								switch($item->status)
								{
									case "Not Started":
										$class = 'class="bg-danger text-danger "';
										break;
									case "In Progress":
										$class = 'class="bg-warning text-warning"';
										break;
									case "For Review":
										$class = 'class="bg-info text-info"';
										break;
									case "Approved":
										$class = 'class="bg-success text-success"';
										break;
									case "Closed":
										$class = 'class="bg-primary text-white"';
									break;
								}
							?>
							<td <?php echo $class;?> ><?php echo $item->status;?></td>
							
						</tr>
					</tbody>
					<?php endforeach;  ?>
					<?php form_close(); }?>
					<?php //endif; ?>
				</table>
	
				</div>
			</div>
		</div>
		
		<div class="row">
			
	
			
			</div>
		</div>
</body>
