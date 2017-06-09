<title>Change Password</title>	
<html>
<body style="background-color:#f5f5f5;" ng-app="app" ng-controller="MainCtrl as main">
	<div class="container">
		<div class="row">
			
		</div>
		
		<div class="row">
			<div class="col-md-4 col-md-offset-4" style="margin-top:100px;">
				<div class="panel-body">
					<?php if($this->session->flashdata('message')){ ?> <div class="alert alert-success text-center"> <?php echo $this->session->flashdata('message'); ?> </div> <?php } ?>
					<h3>
						<font color="#3d3d3d" style="font-weight: bold;" class="centered-text">Change Password</font>
					</h3>
					<?php foreach($user_detail as $item):?>
					<?php echo form_open_multipart('user/change_password/'.$item->eid, 'name="loginform"'); ?>
						
					<form role="form">
						<fieldset>
							<!-- Password -->
							<div class="form-group" 
							ng-class="{ 'has-error': loginform.password.$touched && loginform.password.$invalid }">
								<input class="form-control" placeholder="New Password" name="password" type="password"
								ng-model="main.password"
								ng-minlength="5" 
								ng-maxlength="255"
								ng-pattern="/^(?=.*\d)(?=.*[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{5,}$/"
								required 
								style="font-style:italic"
								password-verify="{{main.confirm_password}}">
								
								<div class="help-block small" ng-messages="loginform.password.$error" ng-if="loginform.password.$touched">
									<p ng-message="minlength">New Password is too short. Mininum characters of 5.</p>
									<p ng-message="maxlength">New Password is too long. Maximum characrers of 100.</p>
									<p ng-message="required">New Password is required.</p>
									<p ng-message="pattern">New Password must have at least one of each: <br/> <b>character, number, and special character</b></p>
									<p ng-message="passwordVerify">Password does not match!</p>
								</div>
								
								<?php echo form_error('password'); ?> <!--error message-->
							</div>
							
							<!-- Confirm Password -->
							<div class="form-group"
							ng-class="{ 'has-error': loginform.confirm_password.$touched && loginform.confirm_password.$invalid }">
							
								<input class="form-control" placeholder="Confirm Password" name="confirm_password" type="password" 
								ng-model="main.confirm_password"
								ng-minlength="5" 
								ng-maxlength="255"
								ng-pattern="/^(?=.*\d)(?=.*[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{5,}$/"
								required  
								style="font-style:italic"
								password-verify="{{main.password}}">
								
								<div class="help-block small" ng-messages="loginform.confirm_password.$error" ng-if="loginform.confirm_password.$touched">
									<p ng-message="minlength">New Password is too short. Mininum characters of 5.</p>
									<p ng-message="maxlength">New Password is too long. Maximum characrers of 100.</p>
									<p ng-message="required">New Password is required.</p>
									<p ng-message="pattern">New Password must have at least one of each: <br/> <b>character, number, and special character</b></p>
									<p ng-message="passwordVerify">Password does not match!</p>
								</div>
								
								<?php echo form_error('confirm_password'); ?> <!--error message-->
							</div>
							
							
							<div class="form-group">
								<!-- Change Password Button -->
								<?php echo form_submit('submit','Change Password','class="btn btn-info btn-block" ng-disabled="loginform.$invalid"');?>

								<!-- Back Button -->
								<a href="javascript:history.go(-1)"class="btn btn-warning btn-block" > Back </a>
							</div>
							
						</fieldset>
					</form>
					<?php echo form_close(); ?>
					<?php endforeach;?>
				</div>
			</div>	
		</div>
	</div>
</body>
</html>