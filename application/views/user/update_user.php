<title>Update User Account</title>
<body ng-app="app" ng-controller="MainCtrl as main">
<div class="container text-center">
	<div class="row"> <br /> <br /></div>

	<div class="row">
		<div class="col-md-4 well" style="display:inline-block; text-align:left; float:none;">
			<?php foreach($user_details as $user):?>
			
			<h3>
				<font color="#3d3d3d" style="font-weight: bold;" class="centered-text"> Update Account </font>
			</h3>
			<hr />
			
			<?php echo form_open_multipart('user/update_user/' . $user->id, 'name="userForm" novalidate'); ?>
			
			<?php echo form_input('id', $user->id,'class="form-control hidden" id="id" readonly'); ?>

			<!-- EID -->
			<div class="form-group" ng-class="{ 'has-error': userForm.eid.$touched && userForm.eid.$invalid }">
			<label>ENTERPRISE ID</label>
			
			
			<input type="text" name="eid" class="form-control form-control-lg" id="eid"
				ng-init="main.eid = '<?php echo $user->eid; ?>'"
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
				<?php $c_level = array ('12' => '12 - Associate Software Engineer',
									 '11' => '11 - Software Engineer',
									 '10' => '10 - Senior Software Engineer',
									 '9' => '09 - Team Lead',
									 '8' => '08 - Associate Manager',
									 '7' => '07 - Manager',
									 '6' => '06 - Senior Manager' ); ?>
				<?php echo form_dropdown('career_level_id',$c_level, $user->career_level_id,'id="career_level_id" class="form-control"'); ?> 
			</div>
			
			<!-- CAPABILITY -->
			<div class="form-group">
				<label>CAPABILITY</label>
				<?php $team = array ('1' => 'ETL', '2' => '.NET', '3' => 'C++', '4' => 'Java', '5' => 'PHP', '6' => 'PL/SQL', '7' => 'System Test' ); ?>
				<?php echo form_dropdown('team_id',$team, $user->team_id,'id="team_id" class="form-control"'); ?> 
			</div>
		
			<!-- USER TYPE -->
			<div class="form-group">
				<label>User Type</label>
				<?php echo form_dropdown('user_type',
										 $this->db->enum_select('user','user_type'),
										 $user->user_type,'class="form-control" id="user_type"'); ?>
			</div>
		
			<!-- TAG AS ADMIN -->
			<div class="form-group">
				<label>TAG AS ADMIN</label>
					<?php $is_admin = array ('0' => 'No', '1' => 'Yes'); ?>
					<?php echo form_dropdown('is_admin',$is_admin, $user->is_admin,'class="form-control" id="is_admin"'); ?> 
			</div>
			
			<!-- TAG AS QA REPRESENTATIVE -->
			<div class="form-group">
			<label>TAG AS QA REPRESENTATIVE</label>
				<?php $is_qa_rep = array ('0' => 'No', '1' => 'Yes'); ?>
					<?php echo form_dropdown('is_qa_rep',$is_qa_rep, $user->is_qa_rep,'class="form-control" id="is_qa_rep"'); ?>
			</div>
			
			<hr />
			
			<?php echo form_submit('submit','Update','class="btn btn-info btn-block" ng-disabled="userForm.$invalid"');?>
			
			
			
			<a href="<?php echo base_url(). 'user/display_users' ?>" class="btn btn-info btn-block">Cancel</a>
			
			
			
			
			<?php echo form_close(); ?>
			<?php endforeach;?>
		</div>
	</div>
</div>
</body>