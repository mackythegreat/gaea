<title>Update Requirement</title>
<body ng-app="app" ng-controller="MainCtrl as main">
<div class="container text-center">
	<div class="row"> <br /> <br /></div>

	<div class="row">
		<div class="col-md-8 well" style="display:inline-block; text-align:left; float:none;">
		
		<h3>
				<font color="#3d3d3d" style="font-weight: bold;" class="centered-text"> Update Requirement -  </font>
		</h3>
		<hr />
		
		
		<div class="row">
			<div class="col-md-12">
				<label><span class="text-danger"><b>*</b></span> REQUIREMENT NAME</label>
				
				<?php echo form_input('p_name', '{{main.p_name}}', 'class="form-control form-control-lg"'); ?> 
			</div>
			
			
		</div>
		
		<br />
		
		<div class="row">
			<div class="col-md-6">
				<label><span class="text-danger"><b>*</b></span> TYPE</label>
				
				<?php echo form_input('p_name', '{{main.p_name}}', 'class="form-control form-control-lg"'); ?> 
			</div>
			
			<div class="col-md-6">
				<label><span class="text-danger"><b>*</b></span> STATUS</label>
				
				<?php echo form_input('p_name', '{{main.p_name}}', 'class="form-control form-control-lg"'); ?> 
			</div>
		</div>
		
		<br />
		
		<div class="row">
			<div class="col-md-6">
				<label><span class="text-danger"><b>*</b></span> DEVELOPER</label>
				
				<?php echo form_input('p_name', '{{main.p_name}}', 'class="form-control form-control-lg"'); ?> 
			</div>
			
			<div class="col-md-6">
				<label><span class="text-danger"><b>*</b></span> REVIEWER</label>
				
				<?php echo form_input('p_name', '{{main.p_name}}', 'class="form-control form-control-lg"'); ?> 
			</div>
		</div>
		
		<br />
		
		<div class="row">
			<div class="col-md-12">
				<label><span class="text-danger"><b>*</b></span> DOCUMENT</label>
			</div>
			
			<br /><br />
			
			<div class="col-md-12">
				<label><span class="text-danger"><b>*</b></span> CHECKLIST</label>
			</div>
			
			<br /><br />
			
			<div class="col-md-12">
				<label><span class="text-danger"><b>*</b></span> POINTSHEET</label>
			</div>
		</div>
		
		<br />
		
		
		<hr />
		
		<?php echo form_submit('submit','Save','class="btn btn-info btn-block" ng-disabled="checkErr(main.p_start_dt,main.p_end_dt) === false || projForm.$invalid"');?>
		
		<!-- Back Button -->
		<a href="javascript:history.go(-1)"class="btn btn-warning btn-block" > Back </a>
		
		</div>
		
	</div>
</div>
</body>