<!-- Modal -->
  <div class="modal fade" id="viewPRModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
		<div class="modal-header" style="background-color:#333;color:#fff;">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">VIEW REQUIREMENT</h4>
		</div>
		
		<div class="modal-body">
			<div class="row">
				<div class="col-md-12">
					
					<div class="form-group">
						<label><span class="text-danger"></span> REQUIREMENT NAME</label>	
						<?php echo form_input('req_name', set_value('req_name'),'class="form-control" readonly'); ?>
					</div>
					
					<hr />
				</div>
			</div>
			
			
			<?php $req_type_name = 'CODE'; // initialize with value from database?>
			
			<div class="row">
				<div class="col-md-12">
					<div class="text-center" style="background-color:#333;color:#fff;">
						<label> <?php echo $req_type_name; ?> </label>
						<br />
					</div>
					
					<br />
					
					<div class="row">
						<div class="col-md-12">
							<!-- Status -->
							<label><span class="text-danger"><b></b></span> STATUS</label><br />
							<?php echo form_input('req_status', set_value('req_status'),'class="form-control" readonly'); ?>
							<br />
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<label><span class="text-danger"><b></b></span> ASSIGNEE</label><br />
							<ul style="list-style: none;">
								<?php //loop ?>
								<li>Example resource #1</li>
								<?php ?>
							</ul>
						</div>
						
						<div class="col-md-6">
							<label><span class="text-danger"><b></b></span> REVIEWER</label><br />
							<ul style="list-style: none;">
								<?php //loop ?>
								<li>Example resource #1</li>
								<?php ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="modal-footer">
			<?php echo form_submit('submit','Create','class="btn btn-info popover-test" ng-disabled="(!code) && (!utp) && (!ute)"');?>
			
          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
		
      </div>
      
    </div>
  </div>