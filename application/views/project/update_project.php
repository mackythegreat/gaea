<body ng-app="app" ng-controller="MainCtrl as main">

<div class="container text-center">
	<div class="row"> <br /> <br /></div>
	
	<div class="row">
		<div class="col-md-8 well" style="display:inline-block; text-align:left; float:none;">
		
		<h3>
				<font color="#3d3d3d" style="font-weight: bold;" class="centered-text"> Update Project </font>
		</h3>
		<hr />
	
		<?php $p_name = '' ?>
	
		<?php foreach($project_details as $item):?>
		<?php echo form_open_multipart('project/update_project/'.$item->proj_id, 'name="projForm" novalidate'); ?>
		
	
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
	
			<div class="row">
				
				<!--START ENTRY-EXIT-->
				<?php foreach($ee_details as $ee_items):?>	
					<tbody>
						<tr>
							<div class="col-md-6">
								<td>
									<input type="text" required="required" name="ee_id" value="<?php echo $ee_items->ee_id?>" hidden >
									
									<label>ENTRY-EXIT NAME</label>
									<input type="text" required="required" name="ee_doc_name" value="<?php echo $ee_items->ee_doc_name?>" readonly class="form-control form-control-lg">
				
								</td>
							</div>
							
							<div class="col-md-6">
								<td>
									<label for="tx_td_doc_link">ENTRY-EXIT LINK</label>
									<input type="text" required="required" name="ee_doc_link" value="<?php echo $ee_items->ee_doc_link?>" class="form-control form-control-lg">
								</td>
							</div>
						</tr>
					</tbody>
				<?php endforeach;?>
				
				<!--END ENTRY-EXIT-->

		
			</div>
			
			<hr />
			
			
		
			
		<?php $td_name = 'Accenture Intralot - '. $p_name . ' - Technical Design'; ?>
		
		
		<div class="row">
		<thead>
					<tr>
						<th>
							<div class="col-md-6">
							<label>TECHNICAL DESIGN NAME</label>
							</div>
						</th>
						<th>
							<div class="col-md-6">
							<label for="tx_td_doc_link">TECHNICAL DESIGN LINK</label>
							</div>
						</th>
					</tr>
				</thead>
			<?php foreach($td_details as $td_items):?>
		<!--Edit Technical Design-->
				
				<tbody>
					<tr>
						<div class="col-md-6">
							<td>
								<input type="text" required="required" name="tx_td_id[]" value="<?php echo $td_items->td_id?>" hidden>

								<input type="text" required="required" name="tx_td_doc_name[]" 
								value="<?php echo $td_name . ' ver.' . $td_items->td_version ; ?>" 
								readonly class="form-control form-control-lg" data-toggle="tooltip" 
								title="<?php echo $td_name . ' ver.' . $td_items->td_version ; ?>">
								<br>
							</td>
						</div>
						
						<div class="col-md-6">
							<td>
								<input type="text" required="required" name="tx_td_doc_link[]" class="form-control form-control-lg" value="<?php echo $td_items->td_doc_link?>">
								<br>
							</td>
						</div>
					</tr>
				</tbody>
			<?php endforeach;?>
			
		</div>
		
		<hr />
		<div class="row">
				<div class="col-md-12">
					<input type="button" class="btn btn-info" value="Add Technical Design" onClick="addRow()" /> 
					
				</div>
		</div>
		
		<br>
		
		<!-- Add Technical Design -->
		<div class="row text-center">
			<div class="col-md-12" style="display:inline-block; text-align:left; float:none;">
				<p id="tech_design"></p>
			</div>
		</div>
		<!-- Add Technical Design -->
		
		
		<hr />
		
		<?php echo form_submit('submit','Save','class="btn btn-info btn-block" ng-disabled="projForm.$invalid"');?>
		
		<!-- Back Button -->
		<a href="javascript:history.go(-1)"class="btn btn-warning btn-block" > Back </a>
		
		<?php echo form_close(); ?>	
		</div>
	</div>
	
	
</div>

</body>


<script/javascript>
			var i = Number('<?php echo $td_ver;?>');
			var count = 1;
			
			var td_ver = <?php echo ($td_items->td_version); ?>;
			function addRow() {
				if(count > 5)
				{
					alert("Maximum Technical Design to be added is 5.");
				}
				count++;
				var p_id = document.createElement("INPUT");
				//var td_name = document.createElement("INPUT");
				var td_link = document.createElement("INPUT");
				var td_vr = document.createElement("INPUT");
				var br = document.createElement("br");
				
				td_ver++;
				
				p_id.setAttribute("type", "text");
				p_id.setAttribute("value", "<?php echo $td_items->p_id?>");
				p_id.setAttribute("name", "bx_p_id[]");
				p_id.setAttribute("placeholder", "Technical Design Name");
				p_id.style.display = "none";
				document.getElementById("tech_design").appendChild(p_id);
				
				//td_name.setAttribute("type", "text");
				//td_name.setAttribute("value", "<?php echo $td_name . ' ver.' . ($td_items->td_version+1) ; ?>");
				//td_name.setAttribute("name", "bx_td_doc_name[]");
				//td_name.setAttribute("placeholder", "Technical Design Name");
				//td_name.setAttribute("class","form-control form-control-lg");
				//document.getElementById("tech_design").appendChild(td_name);

				
				td_link.setAttribute("type", "text");
				td_link.setAttribute("value", "");
				td_link.setAttribute("name", "bx_td_doc_link[]");
				td_link.setAttribute("placeholder", "Technical Design ver." + td_ver + " Link");
				td_link.setAttribute("class","form-control form-control-lg");
				document.getElementById("tech_design").appendChild(td_link);
				
				td_vr.setAttribute("name", "bx_td_version[]");
				td_vr.setAttribute("type", "text");
				td_vr.setAttribute("value", i++);
				td_vr.style.display = "none";
				document.getElementById("tech_design").appendChild(td_vr);
				
				var br = document.createElement("br");
				document.getElementById("tech_design").appendChild(br);
			}
</script>
