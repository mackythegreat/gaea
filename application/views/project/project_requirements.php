<title>Project Requirements</title>

<?php $status = array ('' => 'All',
					   'Not Started' => 'Not Started',
					   'In Progress' => 'In Progress',
					   'Completed' => 'Completed'); ?>
					   
<?php $req_type = array (''  => 'All',
					     '1' => 'CODE',
					     '2' => 'UTP',
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
				<table class= "table" style="table-layout: fixed;">
					<thead>
						<tr style="background-color:#333;color:#fff;">
							<th colspan = 1>REQUIREMENT</th>
							<th colspan = 1>TYPE</th>
							<th colspan = 1>DOCUMENT</th>
							<th colspan = 1>CHECKLIST</th>
							<th colspan = 1>POINTSHEET</th>
							<th colspan = 1>OWNER</th>
							<th colspan = 1>STATUS</th>
							<th colspan = 4>ACTION</th>
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
							<td><?php echo $item->req_type;?></td>
							<td><?php if ($item->doc_link){ echo anchor($item->doc_link, $item->doc_name, 'target="_blank"'); }else{ echo 'N/A'; }?></td>
							<td><?php if ($item->chklist_name){ echo anchor($item->chklist_link, $item->chklist_name, 'target="_blank"'); }else{ echo 'N/A'; }?></td>
							<td><?php if ($item->rev_link){ echo anchor($item->rev_link, $item->rev_name, 'target="_blank"'); }else{ echo 'N/A'; }?></td>
							<td  style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php if($item->assignee){echo $item->assignee;}?></td>
							<?php 
								switch($item->status)
								{
									case "Not Started":
										$class = 'class="bg-danger text-danger "';
										break;
									case "In Progress":
										$class = 'class="bg-warning text-warning"';
										break;
									case "Completed":
										$class = 'class="bg-success text-success"';
									break;
								}
							?>
							<td <?php echo $class;?> ><?php echo $item->status;?></td>
							<td><a href=''
										class="btn btn-success btn-lg btn-xs" data-toggle="tooltip" 
										>
										<span class='glyphicon glyphicon-eye-open'></span></a></td>
										
						<td><a href=''
										class="btn btn-warning btn-lg btn-xs" data-toggle="tooltip" 
										>
										<span class='glyphicon glyphicon-folder-open'></span></a></td>
						
						<td><a href=''
										class="btn btn-info btn-lg btn-xs" data-toggle="tooltip" 
										>
										<span class='glyphicon glyphicon-pencil'></span></a></td>
						
						<td><a href=''
											class="btn btn-danger btn-lg btn-xs" data-toggle="tooltip" 
											>
											<span class='glyphicon glyphicon-remove-circle'></span></a></td>
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
