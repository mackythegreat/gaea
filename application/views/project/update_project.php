<body ng-app="app" ng-controller="MainCtrl as main">
	<?php foreach($project_details as $item):?>
	
		<?php echo form_open_multipart('project/update_project/'.$item->proj_id, 'name="projForm" novalidate'); ?>
		
		<?php echo form_hidden('p_id',$item->proj_id);?>
	
		<div class="form-group" ng-class="{ 'has-error': projForm.p_name.$touched && projForm.p_name.$invalid }">
			<label><span class="text-danger"><b>*</b></span> PROJECT NAME</label>
			
			<div ng-init="main.p_name='<?php echo $item->proj_name ?>'"></div>

			
			<?php echo form_input('p_name', '{{main.p_name}}', 'class="form-control form-control-lg" ng-model="main.p_name"
			ng-minlength="5"
			ng-maxlength="50"
			required'); ?> 
			
			<div class="help-block" ng-messages="projForm.p_name.$error" ng-if="projForm.p_name.$touched">
			<p ng-message="minlength">Project Name is too short. Mininum characters of 5.</p>
			<p ng-message="maxlength">Project Name is too long. Maximum characrers of 50.</p>
			<p ng-message="required">Project Name is required.</p>
			
			</div>
		</div>
		
		
		
		<?php echo form_submit('submit','Update Profile');?>


		<?php endforeach;?>

		<?php echo form_close(); ?>
</body>
