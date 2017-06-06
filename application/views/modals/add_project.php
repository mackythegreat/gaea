<!-- Modal -->
  <div class="modal fade" id="addProjectModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" ng-app="app" ng-controller="MainCtrl as main">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
		  
		 
          <h4 class="modal-title">ADD NEW PROJECT</h4>
        </div>
        <div class="modal-body">
			
			<?php echo form_open_multipart('project/add_project', 'name="projForm" novalidate'); ?>
					
				<!--Project Name-->
				<div class="form-group" ng-class="{ 'has-error': projForm.p_name.$touched && projForm.p_name.$invalid }">
					<label><span class="text-danger"><b>*</b></span> PROJECT NAME</label>
					<?php echo form_input('p_name', set_value('p_name'), 'class="form-control form-control-lg" ng-model="main.p_name"
					ng-minlength="5"
					ng-maxlength="50"
					required'); ?> 
					
					<div class="help-block" ng-messages="projForm.p_name.$error" ng-if="projForm.p_name.$touched">
					<p ng-message="minlength">Project Name is too short. Mininum characters of 5.</p>
					<p ng-message="maxlength">Project Name is too long. Maximum characrers of 50.</p>
					<p ng-message="required">Project Name is required.</p>
					
					</div>
				</div>
				
				<!--Team-->
				<?php if (($this->session->userdata('is_admin') == 1) || ($this->session->userdata('is_qa_rep') == 1)) { ?> 
				<div class='show'> <?php } else { ?>  <div class='hidden'> <?php } ?>
					<div class="form-group" ng-class="{ 'has-error': projForm.p_team_id.$touched && projForm.p_team_id.$invalid }">
						<label><span class="text-danger"><b>*</b></span> TEAM</label>
						<?php $team = array ('' => '-- Select Team --','1' => 'ETL', '2' => '.NET', '3' => 'C++', '4' => 'Java', '5' => 'PHP', '6' => 'PL/SQL', '7' => 'System Test' ); ?>
						<?php echo form_dropdown('p_team_id',$team, '','class="form-control form-control-lg" ng-model="main.p_team_id" required'); ?>
					
						<div class="help-block" ng-messages="projForm.p_team_id.$error" ng-if="projForm.p_team_id.$touched">
							<p ng-message="required">Team is required.</p>
						</div>
					</div>
				</div>
					
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
					
					<label><span class="text-danger"><b>*</b></span> STATUS</label><br />
					<?php $p_status = array ('Not Started' => 'Not Started', 'In Progress' => 'In Progress', 'Completed' => 'Completed'); ?>
					<?php echo form_dropdown('p_status',$p_status, '','class="form-control form-control-lg"'); ?> <?php echo form_error('p_status'); ?>             
					<br /><br />
						
						
				<!--Technical Design-->
				<div class="form-group" ng-class="{ 'has-error': projForm.td_doc_name.$touched && projForm.td_doc_name.$invalid }">
					<label><span class="text-danger"><b>*</b></span>TECHNICAL DESIGN NAME</label>
					<?php echo form_input('td_doc_name', set_value('td_doc_name'), 'class="form-control form-control-lg" ng-model="main.td_doc_name"
					ng-minlength="5"
					ng-maxlength="50"
					required'); ?> 
					
					<div class="help-block" ng-messages="projForm.td_doc_name.$error" ng-if="projForm.td_doc_name.$touched">
					<p ng-message="minlength">Technical Design Name is too short. Mininum characters of 5.</p>
					<p ng-message="maxlength">Technical Design Name is too long. Maximum characrers of 50.</p>
					<p ng-message="required">Technical Design Name is required.</p>
					
					</div>
				</div>
				
				<!--Technical Design Link-->
				<div class="form-group" ng-class="{ 'has-error': projForm.td_doc_link.$touched && projForm.td_doc_link.$invalid }">
					<label><span class="text-danger"><b>*</b></span> TECHNICAL DESIGN LINK</label>
					<?php echo form_input('td_doc_link', set_value('td_doc_link'), 'class="form-control form-control-lg" ng-model="main.td_doc_link"
					ng-minlength="5"
					ng-maxlength="50"
					required'); ?> 
					
					<div class="help-block" ng-messages="projForm.td_doc_link.$error" ng-if="projForm.td_doc_link.$touched">
					<p ng-message="minlength">Technical Design Link is too short. Mininum characters of 5.</p>
					<p ng-message="maxlength">Technical Design Link is too long. Maximum characrers of 100.</p>
					<p ng-message="required">Technical Design Link is required.</p>
					
					</div>
				</div>
				
				<!--ENTRY_EXIT-->
				<div class="form-group" ng-class="{ 'has-error': projForm.ee_doc_name.$touched && projForm.ee_doc_name.$invalid }">
					<label><span class="text-danger"><b>*</b></span>ENTRY-EXIT NAME</label>
					<?php echo form_input('ee_doc_name', set_value('ee_doc_name'), 'class="form-control form-control-lg" ng-model="main.ee_doc_name"
					ng-minlength="5"
					ng-maxlength="50"
					required'); ?> 
					
					<div class="help-block" ng-messages="projForm.ee_doc_name.$error" ng-if="projForm.ee_doc_name.$touched">
					<p ng-message="minlength">Entry-Exit Name is too short. Mininum characters of 5.</p>
					<p ng-message="maxlength">Entry-Exit Name is too long. Maximum characrers of 50.</p>
					<p ng-message="required">Entry-Exit Name is required.</p>
					
					</div>
				</div>
				
				<!--ENTRY_EXIT Link-->
				<div class="form-group" ng-class="{ 'has-error': projForm.ee_doc_link.$touched && projForm.ee_doc_link.$invalid }">
					<label><span class="text-danger"><b>*</b></span> ENTRY-EXIT LINK</label>
					<?php echo form_input('ee_doc_link', set_value('ee_doc_link'), 'class="form-control form-control-lg" ng-model="main.ee_doc_link"
					ng-minlength="5"
					ng-maxlength="50"
					required'); ?> 
					
					<div class="help-block" ng-messages="projForm.ee_doc_link.$error" ng-if="projForm.ee_doc_link.$touched">
					<p ng-message="minlength">Entry-Exit Link is too short. Mininum characters of 5.</p>
					<p ng-message="maxlength">Entry-Exit Link is too long. Maximum characrers of 100.</p>
					<p ng-message="required">Entry-Exit Link is required.</p>
					
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