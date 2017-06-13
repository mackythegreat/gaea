<script type="text/javascript">
 jQuery(document).ready(function(){

	jQuery('select#capab').val('<?php echo $_POST['capability_search'];?>');
	jQuery('select#usr').val('<?php echo $_POST['usertype_search'];?>');
	jQuery('select#eid_src').val('<?php echo $_POST['eid_search'];?>');
 });
</script>

<title>Display All Users</title>

<body>
	
	<?php $capability = array ('' => 'All',
							   '1' => 'ETL',
							   '2' => '.NET',
							   '3' => 'C++',
							   '4' => 'Java',
							   '6' => 'PL/SQL'); ?>
	
	<?php $user_type = array ('' => 'All',
							  'User' => 'User',
							  'Lead' => 'Lead'); ?>
	
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
					<?php echo form_button('Add New Resource','Add New Resource','class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#addUserModal"'); ?>
					<?php $this->view('/modals/add_user');?>
					</div>
				<!--end of addPRModal Placeholder-->
				
				<!-- <div style='margin-left: 100px;'> -->
				<?php // echo anchor('user/add_user','Export To Excel', "class='btn btn-success btn-sm pull-right'"); ?>
				<!-- </div> -->
			</div>
				
				<div>
					<br/>
					<br/>
				</div>
		
		</div>
			
		
		<div class="row">
			<div class="col-md-12">
				<div class="small col-md-3">
					<?php echo form_open('user/filter'); ?></p>
						<label><span class="text-danger"></span> Capability</label><br />
						<?php echo form_dropdown('capability_search', $capability, '', 'class="form-control form-control-lg" id="capab"'); ?> 
						<br />
						
						<label><span class="text-danger"></span> Type</label><br />
						<?php echo form_dropdown('usertype_search', $user_type, '', 'class="form-control form-control-lg" id="usr"'); ?> 
						<br />
						
						<label><span class="text-danger"></span> EID</label><br />
						<input type="text" name="eid_search" class="form-control form-control-lg" id="eid_src">
						<br />
		
						<?php echo form_submit('submit','Filter', "class='btn btn-block btn-warning'");?>
							
					<?php echo form_close(); ?>
						
					<hr />
				</div>
				
				<div class="col-md-9">
				<table class= "table small">
					<thead>
						<tr style="background-color:#333;color:#fff;">
							
							<th class="text-center">ENTERPRISE ID</th>
							<th class="text-center">CAREER LEVEL</th>
							<th class="text-center">TYPE</th>
							<th class="text-center">CAPABILITY</th>
							<th colspan = 3" class="text-center">ACTION</th>
						</tr>
					</thead>
					<?php //$count = $this->m_user->get_all_users($offset,$page,$search); ?>
					<?php //if($count->num_rows()>0):?>
					
				
					<?php foreach ($users_table as $users_item):?>
						<tbody>
							<tr>
								
								<td><?php echo $users_item->eid;?></td>
								
								<td class="text-center"><?php echo $users_item->title;?></td>
								<td class="text-center"><?php echo $users_item->user_type;?></td>
								<td class="text-center"><?php echo $users_item->team;?></td>
								
								
								<td><a href='<?php echo base_url().'user/update_user/'.$users_item->id?>'
										class="btn btn-info btn-lg btn-xs" data-toggle="tooltip" 
										title="Update <?php echo $users_item->eid?>">
										<span class='glyphicon glyphicon-pencil'></span></a></td>
										
								<td><a href='<?php echo base_url();?>user/reset_password/<?php echo $users_item->id?>/<?php echo $users_item->eid?>'
												class='btn btn-warning btn-lg btn-xs' data-toggle='tooltip' 
												title='Reset <?php echo $users_item->eid ?> password'>
												<span class='glyphicon glyphicon-refresh'></span></a></td>
								
								<?php if($users_item->is_active != 0){ ?>
									<td><a href='<?php echo base_url();?>user/set_to_inactive/<?php echo $users_item->id?>/<?php echo $users_item->eid?>' class='btn btn-danger btn-lg btn-xs' data-toggle='tooltip' title='Deactivate <?php echo $users_item->eid ?>'>
										<span class='glyphicon glyphicon-ban-circle'></span></a></td>
								<?php } else{  ?>
									<td><a href='<?php echo base_url();?>user/set_to_active/<?php echo $users_item->id?>/<?php echo $users_item->eid?>' class='btn btn-success btn-lg btn-xs' data-toggle='tooltip' title='Reactivate <?php echo $users_item->eid?>'>
										<span class='glyphicon glyphicon-ok-circle'></span></a></td>
								<?php } ?>
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