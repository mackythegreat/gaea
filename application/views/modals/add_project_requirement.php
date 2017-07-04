<?php $status = array ( 'Not Started' => 'Not Started',
						'In Progress' => 'In Progress',
						'Completed' => 'Completed'); ?>

<!-- Modal -->
  <div class="modal fade" id="addPRModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" ng-controller="MainCtrl">
		
			<div class="modal-header" style="background-color:#333;color:#fff;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<?php foreach ($proj_name as $item): endforeach; ?>
				<h4 class="modal-title">ADD REQUIREMENT - <?php echo $item->p_name; ?></h4>
		  </div>
        <div class="modal-body" >
		
		
			<?php echo form_open_multipart('requirements/add_project_requirements','name="reqForm" novalidate'); ?>
			
			<?php echo form_hidden('p_id', $item->p_id); ?>
			<?php echo form_hidden('assigner_id', $this->session->userdata('id'));?>
			
			<div class="row">
				<div class="col-md-12">
					
					<div class="form-group" ng-class="{ 'has-error': reqForm.req_name.$touched && reqForm.req_name.$invalid }">
						<label><span class="text-danger"><b>*</b></span> REQUIREMENT NAME</label>	
						<?php echo form_input('req_name', set_value('req_name'),'class="form-control" ng-model="req_name" ng-minlength="2"
						ng-maxlength="50"
						required'); ?>
						
						<br />
						<div class="help-block" ng-messages="reqForm.req_name.$error" ng-if="reqForm.req_name.$touched">
							<p ng-message="minlength">Requirement Name is too short. Mininum characters of 2.</p>
							<p ng-message="maxlength">Requirement Name is too long. Maximum characrers of 50.</p>
							<p ng-message="required">Requirement Name is required.</p>
						</div>
					</div>
					
					<label>REQUIREMENT TYPE</label><br />
					
					<div class="checkbox">
						<label>
							<input type="checkbox" ng-init="code=false" ng-model="code" checked style="font-size: 1.5em" name="cb_code" value="{{code}}">
							<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
							CODE
						</label>
					</div>

					
					<div class="checkbox">
						<label>
							<input type="checkbox" ng-init="utp=false" ng-model="utp" name="cb_utp" checked value="{{utp}}">
							<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
							UTP
						</label>
					</div>
					
					<div class="checkbox">
						<label>
							<input type="checkbox" ng-init="ute=false" ng-model="ute" name="cb_ute" checked value="{{ute}}" >
							<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
							UTE
							
						</label>
					</div>
					<hr />
				</div>
				
			</div>
			
			<!--CODE-->
			<div class="well check-element animate-show-hide" ng-show="code" ng-controller="CodeCtrl">
			<div class="text-center" style="background-color:#333;color:#fff;">
				<label> CODE </label>
				
			</div>
			<br />
			<div class="row">
				
				<div class="col-md-12">
					<!-- Status -->
					<label><span class="text-danger"><b></b></span> Status</label><br />
					<?php echo form_dropdown('code_status', $status, '', 'class="form-control form-control-lg" id="stat"'); ?> 
					<br />
				</div>
			</div>
				
			<br />
			
			<div class="row">
				<div class="col-md-6">
				<div>
						<label>ASSIGNEE</label>
				</div>
				
				<fieldset  data-ng-repeat="dev_item in dev_list">
				
					<div class="input-group">
					
						<select class="form-control col-xs-5" name="code_assignee[]" ng-model="dev_item.dev" required>
							
							<?php foreach($eid as $assignee){
								echo '<option value="'.$assignee->id.'">'.$assignee->eid.'</option>';
						}?> </select>
					
						<span class="input-group-btn">
							<button class="btn btn-danger remove" ng-show="$last" ng-click="removeDev()" ng-model="item_dev" ng-disabled="item_dev <=1"><span
							class="glyphicon glyphicon-remove"></span></button>
						</span>			
					</div>
					
					<br >
			
				</fieldset>
				
				<br />
				<a href="#" class="btn btn-success addfields" ng-click="addNewDev()" role="button" ng-disabled="">Add Assignee</a>
				
				</div>

				<div class="col-md-6">
				<div>
					<label>REVIEWER</label>
				</div>
				
				<fieldset  data-ng-repeat="rev_item in rev_list">
				
					<div class="input-group">
					
						<select class="form-control col-xs-5" name="code_reviewer[]" ng-model="rev_item.rev">
							
							<?php foreach($eid as $assignee){
								echo '<option value="'.$assignee->id.'">'.$assignee->eid.'</option>';
						}?> </select>
					
						<span class="input-group-btn">
							<button class="btn btn-danger remove" ng-show="$last" ng-click="removeRev()" ng-model="item_rev" ng-disabled="item_rev <=1"><span
							class="glyphicon glyphicon-remove"></span></button>
						</span>			
					</div>
					
					<br >
				</fieldset>
				
				<br />
				<a href="#" class="btn btn-success addfields" ng-click="addNewRev()" role="button" ng-disabled="">Add Reviewer</a>
				
				</div>
				
			
			</div>
			<hr />
			<br />
			
			</div>
			<!--END OF CODE-->
			
			
			<!--UTP-->
			<div class="well check-element animate-show-hide" ng-show="utp" ng-controller="UTPCtrl">
			
			<div class="text-center" style="background-color:#333;color:#fff;">
				<label> UTP </label>
			</div>
			<br />
			
			<div class="row">
				
				<div class="col-md-12">
					<!-- Status -->
					<label><span class="text-danger"><b></b></span> Status</label><br />
					<?php echo form_dropdown('utp_status', $status, '', 'class="form-control form-control-lg" id="stat"'); ?> 
					<br />
				</div>
			</div>
				
			<br />
			
			<div class="row">
				<div class="col-md-6">
				<div>
						<label>ASSIGNEE</label>
				</div>
				<fieldset  data-ng-repeat="dev_item in dev_list">
					<div class="input-group">
					
						<select class="form-control col-xs-5" name="utp_assignee[]" ng-model="dev_item.dev" >
							<?php foreach($eid as $assignee){ 
							echo '<option value="'.$assignee->id.'">'.$assignee->eid.'</option>';
						}?> </select>
					
						<span class="input-group-btn">
							<button class="btn btn-danger remove" ng-show="$last" ng-click="removeDev()" ng-model="item_dev" ng-disabled="item_dev <=1"><span
							class="glyphicon glyphicon-remove"></span></button>
						</span>
					</div>
					<br />
				</fieldset>
				
				<br />
				<a href="#" class="btn btn-success addfields" ng-click="addNewDev()" role="button">Add Assignee</a>
				
				</div>
				
				<div>
					<label>REVIEWER</label>
				</div>
				<div class="col-md-6">
				<fieldset  data-ng-repeat="rev_item in rev_list">
					
					
					<div class="input-group">
						<select class="form-control" name="utp_reviewer[]" ng-model="rev_item.rev">
							<?php foreach($eid as $assignee){ 
							echo '<option value="'.$assignee->id.'">'.$assignee->eid.'</option>';
						}?> </select>
						
						<span class="input-group-btn">
							<button class="btn btn-danger remove" ng-show="$last" ng-click="removeRev()" ng-model="item_rev" ng-disabled="item_rev <=1"><span
							class="glyphicon glyphicon-remove"></span></button>
						</span>
					</div>
					<br />					
				</fieldset>
				
				<br />
				<a href="#" class="btn btn-success addfields" ng-click="addNewRev()" role="button">Add Reviewer</a>
				
				</div>
					
			</div>
			
			<hr />
			
			</div>
			<!--END OF UTE-->
			
			<!--UTE-->
			<div class="well check-element animate-show-hide" ng-show="ute" ng-controller="UTECtrl">
			<div class="text-center" style="background-color:#333;color:#fff;">
				<label> UTE </label>
				
			</div>
			<br />
			<div class="row">
				
				<div class="col-md-12">
					<!-- Status -->
					<label><span class="text-danger"><b></b></span> Status</label><br />
					<?php echo form_dropdown('ute_status', $status, '', 'class="form-control form-control-lg" id="stat"'); ?> 
					<br />
				</div>
			</div>
				
			<br />
			
			<div class="row">
				<div class="col-md-6">
				<div>
						<label>ASSIGNEE</label>
				</div>
				<fieldset  data-ng-repeat="dev_item in dev_list">
					<div class="input-group">
					
						<select class="form-control col-xs-5" name="ute_assignee[]" ng-model="dev_item.dev" >
							<?php foreach($eid as $assignee){ 
							echo '<option value="'.$assignee->id.'">'.$assignee->eid.'</option>';
						}?> </select>
					
						<span class="input-group-btn">
							<button class="btn btn-danger remove" ng-show="$last" ng-click="removeDev()" ng-model="item_dev" ng-disabled="item_dev <=1"><span
							class="glyphicon glyphicon-remove"></span></button>
						</span>
					</div>
					<br />
				</fieldset>
				
				<br />
				
				<a href="#" class="btn btn-success addfields" ng-click="addNewDev()" role="button">Add Assignee</a>
				
				</div>
				
				<div>
					<label>REVIEWER</label>
				</div>
				<div class="col-md-6">
				<fieldset  data-ng-repeat="rev_item in rev_list">
					
					
					<div class="input-group">
						<select class="form-control" name="ute_reviewer[]" ng-model="rev_item.rev">
							<?php foreach($eid as $assignee){ 
							echo '<option value="'.$assignee->id.'">'.$assignee->eid.'</option>';
						}?> </select>
						
						<span class="input-group-btn">
							<button class="btn btn-danger remove" ng-show="$last" ng-click="removeRev()" ng-model="item_rev" ng-disabled="item_rev <=1"><span
							class="glyphicon glyphicon-remove"></span></button>
						</span>
					</div>
					<br />					
				</fieldset>
				
				<br />
				<a href="#" class="btn btn-success addfields" ng-click="addNewRev()" role="button">Add Reviewer</a>
				
				</div>
					
			</div>
			
			<hr />
			<br />
			
			</div>
			<!--END OF UTE-->
			
			
        </div>
        <div class="modal-footer">
			<?php echo form_submit('submit','Create','class="btn btn-info popover-test" ng-disabled="(!code) && (!utp) && (!ute)"');?>
			<?php echo form_close(); ?>
          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>