<!-- Modal -->
<div class="modal fade" id="addUserModal" role="dialog">
<div class="modal-dialog">
   
<!-- Modal content-->
	<div class="modal-content" ng-controller="MainCtrl as main">
		<div class="modal-header" style="background-color:#333;color:#fff;">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title"> CREATE NEW ACCOUNT </h4>
		</div>
		<div class="modal-body">
			<?php echo form_open_multipart('user/add_user','name="userForm" novalidate'); ?>
		
		<div class="row">
		
			<div class="col-md-12">
				<!-- EID -->
				<div class="form-group" ng-class="{ 'has-error': userForm.eid.$touched && userForm.eid.$invalid }">
				<label>ENTERPRISE ID</label>
				<input type="text" name="eid" class="form-control form-control-lg" 
					ng-model="main.eid"
					ng-minlength="5"
					ng-maxlength="30"
					ng-pattern="/^[a-z]+(?:\.[a-z]+)\.[a-z]+(?:\.[a-z]+)?$/"
					required>
					
				<div class="help-block" ng-messages="userForm.eid.$error" ng-if="userForm.eid.$touched">
					<p ng-message="minlength">Enterprise is too short. Mininum characters of 5.</p>
					<p ng-message="maxlength">Enterprise is too long. Maximum characrers of 30.</p>
					<p ng-message="required">Enterprise ID is required.</p>
					<p ng-message="pattern">Enterprise ID is invalid.</p>
				</div>
				</div>
				
				<!-- LEVEL -->
				<div class="form-group" >
				<label>CAREER LEVEL</label>
					<select id="career_level_id" name="career_level_id" class="form-control">
					<!--option value="">-- Select Career Level --</option-->
					<option value="12">12 - Associate Software Engineer</option>
					<option value="11">11 - Software Engineer</option>
					<option value="10">10 - Senior Software Engineer</option>
					<option value="9">09 - Team Lead</option>
					<option value="8">08 - Associate Manager</option>
					<option value="7">07 - Manager</option>
					<option value="6">06 - Senior Manager</option>
					</select>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				<!-- CAPABILITY -->
				<div class="form-group">
						<label>CAPABILITY</label>
						<?php $team = array ('1' => 'ETL', '2' => '.NET', '3' => 'C++', '4' => 'Java', '6' => 'PL/SQL' ); ?>
						<?php echo form_dropdown('team_id',$team, '','class="form-control"'); ?> 
					
					<?php echo form_hidden('team_id', $this->session->userdata('team_id'));?>
				</div>
			</div>
			
			<div class="col-md-6">
				<!-- USER TYPE -->
				<div class="form-group">
				<label>User Type</label>
				<?php echo form_dropdown('user_type', $this->db->enum_select('user','user_type'),'','class="form-control"'); ?>
				</div>
			</div>
		</div>
		
		
		<div class="row">
			<div class="col-md-6">
				<!-- TAG AS ADMIN -->
				<div class="form-group">
				<label>TAG AS ADMIN</label>
					<?php $is_admin = array ('0' => 'No', '1' => 'Yes'); ?>
					<?php echo form_dropdown('is_admin',$is_admin, '','class="form-control"'); ?> 
				</div>
			</div>
			
			<div class="col-md-6">
				<!-- TAG AS QA REPRESENTATIVE -->
				<div class="form-group">
				<label>TAG AS QA REPRESENTATIVE</label>
					<?php $is_qa_rep = array ('0' => 'No', '1' => 'Yes'); ?>
						<?php echo form_dropdown('is_qa_rep',$is_qa_rep, '','class="form-control"'); ?>
				</div>
			</div>
		</div>

		<div class="modal-footer">
			<?php echo form_submit('submit','Create','class="btn btn-info" ng-disabled="userForm.$invalid"');?>
			<?php echo form_close(); ?>
			<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>	
        </div>
      </div>
      
    </div>
  </div>