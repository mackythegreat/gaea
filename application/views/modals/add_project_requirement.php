<!-- Modal -->
  <div class="modal fade" id="addPRModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" >
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
		  
		  <?php foreach ($proj_name as $item): endforeach; ?>
          <h4 class="modal-title"><?php echo $item->p_name; ?></h4>
        </div>
        <div class="modal-body">
		
			
			<?php echo form_open_multipart('requirements/add_project_requirements'); ?>
			<?php echo form_hidden('p_id', $item->p_id); ?>
			<?php echo form_hidden('assigner_id', $this->session->userdata('id'));?>
			
			<label>REQUIREMENT NAME:</label>				
			<?php echo form_input('req_name', set_value('req_name'),'class="form-control"'); ?> <?php echo form_error('req_name'); ?>
			<label>REQUIREMENT TYPE:</label><br />
			<label>CODE: </label> <input type="checkbox" ng-model="code" ><br />
			<label>UTP: </label><input type="checkbox" ng-model="utp" ><br />
			<label>UTE: </label><input type="checkbox" ng-model="ute" ><br />
			
			<!--CODE-->
			<div class="check-element animate-show-hide" ng-show="code" ng-controller="CodeCtrl">
			CODE
			<fieldset  data-ng-repeat="choice in choices">
				Assignee: 					
				<select class="form-control" name="assignee_id[]" ng-model="choice.dev">
				<?php foreach($eid as $assignee){ 
				echo '<option value="'.$assignee->id.'">'.$assignee->eid.'</option>';
				}?> </select>
				Reviewer: 					
				<select class="form-control" name="reviewer_id[]" ng-model="choice.rev">
				<?php foreach($eid as $reviewer){ 
				  echo '<option value="'.$reviewer->id.'">'.$reviewer->eid.'</option>';
				}?> </select>
				
				Status:
				<?php echo form_dropdown('status', $this->db->enum_select('project_req','status'),'','class="form-control"'); ?>
				<input type="text" ng-model="choice.dev" name="assignee_id[]" placeholder="Developer" required hidden>
				
				<button class="remove" ng-show="$last" ng-click="removeChoice()">-</button>
			</fieldset>
			<button class="addfields" ng-click="addNewChoice()">Add fields</button>
			 <div id="choicesDisplay">
				{{ choices }}
			 </div>
			</div>
			
			
			
        </div>
        <div class="modal-footer">
			<?php echo form_submit('submit','Create','class="btn btn-info"');?>
			<?php echo form_close(); ?>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>	
        </div>
      </div>
      
    </div>
  </div>