<script type="text/javascript">
 jQuery(document).ready(function(){

	jQuery('select#capab').val('<?php echo $_POST['capability_search'];?>');
	jQuery('select#stat').val('<?php echo $_POST['status_search'];?>');
	jQuery('select#mon').val('<?php echo $_POST['month_search'];?>');
	jQuery('select#yr').val('<?php echo $_POST['year_search'];?>');

 });
</script>

<title>Display All Projects</title>

<body>
		
	<?php $capability = array ('' => 'All',
					   '1' => 'ETL',
					   '2' => '.NET',
					   '3' => 'C++',
					   '4' => 'Java',
					   '6' => 'PL/SQL'); ?>
		
	<?php $status = array ('' => 'All',
						   'Not Started' => 'Not Started',
						   'In Progress' => 'In Progress',
						   'Completed' => 'Completed'); ?>
						
	<?php $month = array (''   => 'All',
						  '01'  => 'January',
						  '02'  => 'February', 
						  '03'  => 'March', 
						  '04'  => 'April', 
						  '05'  => 'May',
						  '06'  => 'June',
						  '07'  => 'July',
						  '08'  => 'August',
						  '09'  => 'September',
						  '10' => 'October',
						  '11' => 'November',
						  '12' => 'December'
						  ); ?>
										  
	<?php $year = array (''     => 'All',
						 '2016' => '2016',
						 '2017' => '2017',
						 '2018' => '2018',
						 '2019' => '2019',
						 '2020' => '2020',
						 '2021' => '2021'
						 ); ?>
		
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
					<?php echo form_button('Add New Project','Add New Project','class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#addProjectModal"'); ?>
					<?php $this->view('/modals/add_project');?>
					</div>
					<!--end of addPRModal Placeholder-->
			</div>
				
			<div> <br/><br/> </div>
		</div>
		
		<div class="row">
		<div class="col-md-12">
		
			<!-- Filter -->
			<div class="small col-md-3 well">
				<?php echo form_open('project/filter'); ?></p>
					
					<!-- Capability -->
					<?php if($this->session->userdata('user_type') != 'User') {?>
					<label><span class="text-danger"><b></b></span> Capability</label><br />
					<?php echo form_dropdown('capability_search', $capability, '', 'class="form-control form-control-lg" id="capab"'); ?>
					<br />
					<?php }?>
					
					<!-- Status -->
					<label><span class="text-danger"><b></b></span> Status</label><br />
					<?php echo form_dropdown('status_search', $status, '', 'class="form-control form-control-lg" id="stat"'); ?> 
					<br />
					
					<!-- Month -->
					<label><span class="text-danger"><b></b></span> Month</label><br />
					<?php echo form_dropdown('month_search', $month, '', 'class="form-control form-control-lg" id="mon"'); ?> 
					<br />
					
					<!-- Year -->
					<label><span class="text-danger"><b></b></span> Year</label><br />
					<?php echo form_dropdown('year_search', $year, '', 'class="form-control form-control-lg" id="yr"'); ?> 
					
					<hr />
					<?php echo form_submit('submit','Filter', "class='btn btn-block btn-warning'");?>
					
					<hr />
					
				<?php echo form_close(); ?>
			</div>
			
			<div class="col-md-9">
			<table class= "table small">
				<thead>
					<tr style="background-color:#333;color:#fff;">
						<th class="text-center">PROJECT NAME</th>
						<th class="text-center">ASSIGNED TEAM</th>
						<th class="text-center">START DATE</th>
						<th class="text-center">END DATE</th>
						<th class="text-center">STATUS</th>
						<th colspan = 4  class="text-center">ACTION</th>
					</tr>
				</thead>
				
				<?php foreach ($projects_table as $item):?>
				<tbody>
					<tr>
						<td class="text-center"><?php echo $item->proj_name;?></td>
						<td class="text-center"><?php echo $item->team;?></td>
						<td class="text-center"><?php echo $item->start_date;?></td>
						<?php if($item->end_date == '0000-00-00'){ ?> <td></td>
						<?php } else { ?> <td class="text-center"><?php echo $item->end_date;?></td> <?php }?>
						<td class="text-center"><?php echo $item->status;?></td>
						
						<td><a href='<?php echo base_url().'project/view_project/'.$item->proj_id?>'
										class="btn btn-success btn-lg btn-xs" data-toggle="tooltip" 
										title="View <?php echo $item->proj_name?>">
										<span class='glyphicon glyphicon-eye-open'></span></a></td>
										
						<td><a href='<?php echo base_url().'requirements/show_project_requirements/'.$item->proj_id?>'
										class="btn btn-warning btn-lg btn-xs" data-toggle="tooltip" 
										title="View <?php echo $item->proj_name?> Project Requirement">
										<span class='glyphicon glyphicon-folder-open'></span></a></td>
						
						<td><a href='<?php echo base_url().'project/update_project/'.$item->proj_id?>'
										class="btn btn-info btn-lg btn-xs" data-toggle="tooltip" 
										title="Edit <?php echo $item->proj_name?>">
										<span class='glyphicon glyphicon-pencil'></span></a></td>
						
						<td><a href='<?php echo base_url().'project/delete_project/'.$item->proj_id.'/'.$item->proj_name?>'
											class="btn btn-danger btn-lg btn-xs" data-toggle="tooltip" 
											title="Delete <?php echo $item->proj_name?>">
											<span class='glyphicon glyphicon-remove-circle'></span></a></td>
											
											
					</tr>
				</tbody>
				<?php endforeach;?>
				</table>
			<div style="text-align:center">
				<?php if($pagination != false ) { echo $pagination; }	?>
			</div>
		</div>
		</div>
		</div>
	</div>
</body>
</html>