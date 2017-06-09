<body ng-app="app" ng-controller="MainCtrl as main">

<div class="container text-center">
	<div class="row"> <br /> <br /></div>
	
	<div class="row">
		<div class="col-md-8 well" style="display:inline-block; text-align:left; float:none;">
		
		<h3>
				<font color="#3d3d3d" style="font-weight: bold;" class="centered-text"> View Project </font>
		</h3>
		<hr />
	
		<?php $p_name = '' ?>
	
		<?php foreach($project_details as $item):?>
		
	
			<?php echo form_hidden('p_id',$item->proj_id);?>
	
			<!-- Project Name -->
			<div class="row">
				<div class="col-md-6">
				<div class="form-group" ng-class="{ 'has-error': projForm.p_name.$touched && projForm.p_name.$invalid }">
					<label><span class="text-danger"><b>*</b></span> PROJECT NAME</label>
					<div ng-init="main.p_name='<?php echo $item->proj_name ?>'"></div>
		
					<?php echo form_input('p_name', '{{main.p_name}}', 'class="form-control form-control-lg" ng-model="main.p_name"
					ng-minlength="5"
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
				<!-- Status -->
				<div class="form-group">
					<label><span class="text-danger"><b>*</b></span> STATUS</label><br />
					<?php $p_status = array ('Not Started' => 'Not Started', 'In Progress' => 'In Progress', 'Completed' => 'Completed'); ?>
					<?php echo form_dropdown('p_status',$p_status, $item->status,'class="form-control form-control-lg"'); ?> <?php echo form_error('p_status'); ?>            
				</div>
				</div>
				
			</div>
		
			<div class="row">
				<div class="col-md-6">
					<!-- Start Date -->	
					<div class="form-group" ng-class="{ 'has-error': projForm.p_start_dt.$touched && projForm.p_start_dt.$invalid }">
						<label><span class="text-danger"><b>*</b></span> START DATE </label><br />
						<div ng-init="main.p_start_dt='<?php echo $item->start_date ?>'"></div>
						
						<div id="p_start_dt" class="input-group date"  data-date-format="yyyy-dd-mm">
							<?php echo form_input('p_start_dt', '{{main.p_start_dt}}', 'type="text" class="form-control"
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
					<!-- End Date -->	
					<div class="form-group" ng-class="{ 'has-error': projForm.p_end_dt.$touched && projForm.p_end_dt.$invalid }">
						<label><span class="text-danger"><b>*</b></span> END DATE </label><br />
						<div ng-init="main.p_end_dt='<?php echo $item->end_date ?>'"></div>
						
						<div id="p_end_dt" class="input-group date"  data-date-format="yyyy-dd-mm">
							<?php echo form_input('p_end_dt', '{{main.p_end_dt}}', 'type="text" class="form-control"
							ng-model="main.p_end_dt"
							required'); ?>
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-th"></span>
							</div>
						</div>
						
						<script type="text/javascript">
							$("#p_end_dt").datepicker({
								format: "yyyy-mm-dd",
								autoclose: true,
								todayHighlight: true,
								clearBtn: true
							});
						</script>
					
						<div class="help-block" ng-messages="projForm.p_end_dt.$error" ng-if="projForm.p_end_dt.$touched">
							<p ng-message="required">End Date is required.</p>
						</div>
					</div>
				</div>
			</div>
		
		<hr />
		
	<?php endforeach;?> 
	
	
			<?php $td_name = 'Accenture Intralot - '. $p_name . ' - Technical Design'; ?>
			
			<div class="row">
				<div class="col-md-12">
					<label>ENTRY-EXIT NAME</label>
					<?php foreach($ee_details as $ee_items):?>	
						<ul>
							<li><a href="<?php echo $ee_items->ee_doc_link?>"><?php echo $ee_items->ee_doc_name?></a></li>
						</ul>
					<?php endforeach;?>
				</div>
				
				
		
			</div>
			<div class="row">
			<div class="col-md-12">
					<label>TECHNICAL DESIGN</label>
					
					<?php foreach($td_details as $td_items):?>
						<ul>
							<li><a href="<?php echo $td_items->td_doc_link?>"><?php echo $td_name . ' ver.' . $td_items->td_version ; ?></a></li>
						</ul>
					<?php endforeach;?>
				</div>
			</div>
			<hr />
			
			
		
		
		
		<hr />
		
		<!-- Back Button -->
		<a href="javascript:history.go(-1)"class="btn btn-warning btn-block" > Back </a>
		
		</div>
	</div>
	
	
</div>

</body>


