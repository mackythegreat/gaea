<!-- Modal -->
  <div class="modal fade" id="addPRModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" >
		
			<div class="modal-header" style="background-color:#333;color:#fff;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<?php foreach ($proj_name as $item): endforeach; ?>
				<h4 class="modal-title">ADD REQUIREMENT - <?php echo $item->p_name; ?></h4>
		  </div>
        <div class="modal-body">
		
			
			<?php echo form_open_multipart('requirements/add_project_requirements'); ?>
			<?php echo form_hidden('p_id', $item->p_id); ?>
			<?php echo form_hidden('assigner_id', $this->session->userdata('id'));?>
			
			<div class="row">
				<div class="col-md-12">
					<label>REQUIREMENT NAME</label>				
					<?php echo form_input('req_name', set_value('req_name'),'class="form-control"'); ?>
						<?php echo form_error('req_name'); ?>
					
					<br />
					
					<label>REQUIREMENT TYPE</label><br />
					<ul style="list-style: none;">
						<li><input type="checkbox" ng-model="code" > CODE</li>
						<li><input type="checkbox" ng-model="utp" > UTP</li>
						<li><input type="checkbox" ng-model="ute" > UTE</li>
					</ul>
				</div>
			</div>
			
			<!--CODE-->
			<div class="check-element animate-show-hide" ng-show="code" ng-controller="CodeCtrl">
			<hr />
			
			<div class="row">
				<div class="col-md-12">
					<label>STATUS</label>
					<?php echo form_dropdown('status', $this->db->enum_select('project_req','status'),'','class="form-control"'); ?>
					<input type="text" ng-model="choice.dev" name="assignee_id[]" placeholder="Developer" required hidden>
				</div>
			</div>
				
			<br />
			
			<div class="row">
				<div class="col-md-6">
				<fieldset  data-ng-repeat="choice in choices">
					<div>
						<label>ASSIGNEE</label>
					</div>
					
					<div class="input-group">
						<select class="form-control" name="assignee_id[]" ng-model="choice.dev">
							<?php foreach($eid as $assignee){ 
							echo '<option value="'.$assignee->id.'">'.$assignee->eid.'</option>';
						}?> </select>
						
						<span class="input-group-btn">
							<button class="btn btn-danger remove" ng-show="$last" ng-click="removeChoice()"><span
							class="glyphicon glyphicon-remove"></span></button>
						</span>
					</div>	
				</fieldset>
				
				<br />
				<button class="btn btn-success addfields" ng-click="addNewChoice()">Add Assignee</button>
				
				</div>
				
				
				
				<div class="col-md-6">
				<fieldset  data-ng-repeat="choice in choices">
					<div>
						<label>REVIEWER</label>
					</div>
					
					
					<div class="input-group">
						<select class="form-control " name="reviewer_id[]" ng-model="choice.rev">
						<?php foreach($eid as $reviewer){ 
						echo '<option value="'.$reviewer->id.'">'.$reviewer->eid.'</option>';
						}?> </select>
						
						<span class="input-group-btn">
							<button class="btn btn-danger remove" ng-show="$last" ng-click="removeChoice()"><span
							class="glyphicon glyphicon-remove"></span></button>
						</span>
					</div>
					
				</fieldset>
				
				<br />
				<button class="btn btn-success addfields" ng-click="addNewChoice()">Add Reviewer</button>
				</div>
				
			</div>
			
			<br />
			
			 <div id="choicesDisplay">
				{{ choices }}
			 </div>
			 <hr />
			</div>
			
			
			
        </div>
        <div class="modal-footer">
			<?php echo form_submit('submit','Create','class="btn btn-info"');?>
			<?php echo form_close(); ?>
          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>