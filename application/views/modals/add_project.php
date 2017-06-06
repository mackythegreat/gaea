<!-- Modal -->
<div class="modal fade" id="addProjectModal" role="dialog">
	<div class="modal-dialog">
	
		<!-- Modal content-->
		<div class="modal-content" ng-app="app" ng-controller="MainCtrl as main">
		<div class="modal-header" style="background-color:#333;color:#fff;">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">ADD NEW PROJECT</h4>
		</div>
		
		<div class="modal-body">
			
			<?php echo form_open_multipart('project/add_project', 'name="projForm" novalidate'); ?>
					
				<div class="row">
					<div class="col-md-12">
						<!--Project Name-->
						<div class="form-group" ng-class="{ 'has-error': projForm.p_name.$touched && projForm.p_name.$invalid }">
						<label><span class="text-danger"><b>*</b></span> PROJECT NAME</label>
						<?php echo form_input('p_name', set_value('p_name'), 'class="form-control form-control-lg" ng-model="main.p_name"
						ng-minlength="1"
						ng-maxlength="50"
						required'); ?> 
						
						<?php $p_name = "{{main.p_name}}";?>
					
						<div class="help-block" ng-messages="projForm.p_name.$error" ng-if="projForm.p_name.$touched">
						<p ng-message="minlength">Project Name is too short. Mininum characters of 5.</p>
						<p ng-message="maxlength">Project Name is too long. Maximum characrers of 50.</p>
						<p ng-message="required">Project Name is required.</p>
						</div>
						</div>
						
					</div>
					<div class="col-md-6">
						<!--Team-->
						
						<div class="form-group" ng-class="{ 'has-error': projForm.p_team_id.$touched && projForm.p_team_id.$invalid }">
						<label><span class="text-danger"><b>*</b></span> TEAM</label>
						<?php $team = array ('' => '-- Select Team --','1' => 'ETL', '2' => '.NET', '3' => 'C++', '4' => 'Java', '5' => 'PHP', '6' => 'PL/SQL', '7' => 'System Test' ); ?>
						<?php echo form_dropdown('p_team_id',$team, '','class="form-control form-control-lg" ng-model="main.p_team_id" required'); ?>
					
						<div class="help-block" ng-messages="projForm.p_team_id.$error" ng-if="projForm.p_team_id.$touched">
							<p ng-message="required">Team is required.</p>
						</div>
						</div>
						
					</div>
					
					<div class="col-md-6">
					<label><span class="text-danger"><b>*</b></span> STATUS</label><br />
					<?php $p_status = array ('Not Started' => 'Not Started', 'In Progress' => 'In Progress', 'Completed' => 'Completed'); ?>
					<?php echo form_dropdown('p_status',$p_status, '','class="form-control form-control-lg"'); ?> <?php echo form_error('p_status'); ?>            
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<!-- START DATE -->	
						<div class="form-group" ng-class="{ 'has-error': projForm.p_start_dt.$touched && projForm.p_start_dt.$invalid }">
						<label><span class="text-danger"><b>*</b></span> START DATE </label><br />
						<div id="p_start_dt" class="input-group date"  data-date-format="yyyy-dd-mm">
						<?php echo form_input('p_start_dt', set_value('p_start_dt'), 'type="text" class="form-control"
						ng-model="main.p_start_dt"
						required'); ?>
						<div class="input-group-addon">
							<span class="glyphicon glyphicon-th"></span>
						</div>
						</div>
					
						<script type="text/javascript">
							$("#p_start_dt").datepicker({
								format: "yyyy-mm-dd",
								autoclose: true,
								todayHighlight: true,
								clearBtn: true
							});
						</script>
					
						<div class="help-block" ng-messages="projForm.p_start_dt.$error" ng-if="projForm.p_start_dt.$touched">
							<p ng-message="required">Start Date is required.</p>
						</div>
						</div>
					</div>
					
					<div class="col-md-6">
					<label><span class="text-danger"></span> END DATE</label><br />
					<div id="p_end_dt" class="input-group date" data-date-format="yyyy-dd-mm">
						<!--input type="text" class="form-control" id="end-date" name="p_end_dt"-->
						<?php echo form_input('p_end_dt', set_value('p_end_dt'), 'type="text" class="form-control"'); ?>
						<div class="input-group-addon">
							<span class="glyphicon glyphicon-th"></span>
						</div>
					</div>
					<br />
					
					<?php echo form_error('p_end_dt'); ?> 
					
					<script type="text/javascript">
						$("#p_end_dt").datepicker({
							format: "yyyy-mm-dd",
							autoclose: true,
							todayHighlight: true,
							clearBtn: true
						});
					</script>
					</div>
				</div>
				
				<hr/>
				
				
				<?php $td_name = 'Accenture Intralot - '. $p_name . ' - Technical Design'; ?>
				<?php $ee_name = $p_name . ' - Entry-Exit Criteria' ;?>
				
				
				<div class="row">
					<div class="col-md-12">
					<!--Technical Design-->
					
					
					
					
					
					
					<label><span class="text-danger"></span>TECHNICAL DESIGN NAME</label>
					<div class="form-group">
						<input name="td_doc_name" type="text" size="255" value="<?php echo $td_name; ?>" class="form-control form-control-lg" 
						readonly>
					</div>
					
					<!--Technical Design Link-->
					<div class="form-group" ng-class="{ 'has-error': projForm.td_doc_link.$touched && projForm.td_doc_link.$invalid }">
						<label><span class="text-danger"><b>*</b></span> TECHNICAL DESIGN LINK</label>
						<?php echo form_input('td_doc_link', set_value('td_doc_link'), 'class="form-control form-control-lg" ng-model="main.td_doc_link"
						ng-minlength="5"
						ng-maxlength="255"
						required'); ?> 
						
						<div class="help-block" ng-messages="projForm.td_doc_link.$error" ng-if="projForm.td_doc_link.$touched">
						<p ng-message="minlength">Technical Design Link is too short. Mininum characters of 5.</p>
						<p ng-message="maxlength">Technical Design Link is too long. Maximum characrers of 100.</p>
						<p ng-message="required">Technical Design Link is required.</p>
						
						</div>
					</div>
					
					<!--ENTRY_EXIT-->
					
					<div class="form-group">
						<input name="ee_doc_name" type="text" size="255" value="<?php echo $ee_name; ?>" class="form-control form-control-lg" readonly>
					</div>
					
					<!--ENTRY_EXIT Link-->
					<div class="form-group" ng-class="{ 'has-error': projForm.ee_doc_link.$touched && projForm.ee_doc_link.$invalid }">
						<label><span class="text-danger"><b>*</b></span> ENTRY-EXIT LINK</label>
						<?php echo form_input('ee_doc_link', set_value('ee_doc_link'), 'class="form-control form-control-lg" ng-model="main.ee_doc_link"
						ng-minlength="5"
						ng-maxlength="255"
						required'); ?> 
						
						<div class="help-block" ng-messages="projForm.ee_doc_link.$error" ng-if="projForm.ee_doc_link.$touched">
						<p ng-message="minlength">Entry-Exit Link is too short. Mininum characters of 5.</p>
						<p ng-message="maxlength">Entry-Exit Link is too long. Maximum characrers of 100.</p>
						<p ng-message="required">Entry-Exit Link is required.</p>
						
						</div>
					</div>
					</div>
				</div>
		</div>
		<div class="modal-footer">
			<?php echo form_submit('submit','Save','class="btn btn-info" ng-disabled="projForm.$invalid"');?>
			<?php echo form_close(); ?>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>	
		</div>
	</div>
	</div>
</div>