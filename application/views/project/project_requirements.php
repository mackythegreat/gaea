<script type="text/javascript">
function doconfirm()
{
    job=confirm("Are you sure to delete permanently?");
    if(job!=true)
    {
        return false;
    }
}
</script>

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
				<?php echo form_open('requirements/filter'); ?></p>
					<!-- Requirement Type -->
					<label><span class="text-danger"><b></b></span> Requirement Type</label><br />
					<?php echo form_dropdown('req_type_search', $req_type, '', 'class="form-control form-control-lg" id="stat"'); ?> 
					<br />
					
					<!-- Status -->
					<label><span class="text-danger"><b></b></span> Status</label><br />
					<?php echo form_dropdown('status_search', $status, '', 'class="form-control form-control-lg" id="stat"'); ?> 
					<br />
					
					<?php echo form_submit('submit','Filter', "class='btn btn-block btn-warning'");?>
				</div>

<div class="small col-md-9">
	<table class= "table">
		<thead>
						<tr style="background-color:#333;color:#fff;">
										<th class="text-center">REQUIREMENT</th>
										<th class="text-center">TYPE</th>
										<th class="text-center">DOCUMENT</th>
										<th class="text-center">CHECKLIST</th>
										<th class="text-center">POINTSHEET</th>
										<th class="text-center">OWNER</th>
										<th class="text-center">REVIEWER</th>
										<th class="text-center">STATUS</th>
										<th colspan = 4 class="text-center">ACTION</th>
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
				<td  style="white-space: wrap; column-width: 50px; overflow: hidden; text-overflow: ellipsis; "><?php if($item->assignee){echo $item->assignee;}?></td>
				
				<td  style="overflow: hidden; text-overflow: ellipsis; white-space: wrap; column-width: 100px;"><?php if($item->reviewer){echo $item->reviewer;}?></td>
				<?php 
					switch($item->status)
					{
						case "Not Started":
										$class = 'class="bg-danger text-danger text-center"';
										break;
						case "In Progress":
										$class = 'class="bg-warning text-warning text-center"';
										break;
						case "Completed":
										$class = 'class="bg-success text-success text-center"';
						break;
					}
				?>
				<td <?php echo $class;?> ><?php echo $item->status;?></td>
				<td><div><a href=''
				class="btn btn-success btn-lg btn-xs" data-toggle="modal" data-target="#viewPRModal">
				<span class='glyphicon glyphicon-eye-open'></span></a>
				
				<?php $this->view('/modals/view_project_requirement');?>
				</div></td>

				<td><a href=''
				class="btn btn-info btn-lg btn-xs" data-toggle="tooltip">
				<span class='glyphicon glyphicon-pencil'></span></a></td>

				<td><a href='<?php echo base_url().'requirements/delete_requirements/'.$item->p_id.'/'.$item->req_doc_id.'/'.$item->req_name?>'
				class="btn btn-danger btn-lg btn-xs" data-toggle="tooltip" 
				title="Delete <?php echo $item->req_name?>" onClick="return doconfirm();" >
				<span class='glyphicon glyphicon-remove-circle'></span></a></td>
			</tr>
		</tbody>
			<input type="hidden" name="proj_id" class="form-control form-control-lg" value='<?php echo $item->p_id;?>'>
			<?php endforeach;  ?>
			<?php form_close(); }?>
			
	</table>

	</div>
