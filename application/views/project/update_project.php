<body ng-app="app" ng-controller="MainCtrl as main">

<?php echo $td_ver?>
<script>
var td_ver = Number('<?php echo $td_ver;?>')+1;
function addRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	if(rowCount < 10){                            // limit the user from creating fields more than your limits
	
		//test
		td_ver += 1;
        document.getElementById("td_ver").innerHTML = td_ver;
		//test
	
		var row = table.insertRow(rowCount);
		var colCount = table.rows[0].cells.length;
		for(var i=0; i <colCount; i++) {
			var newcell = row.insertCell(i);
			newcell.innerHTML = table.rows[0].cells[i].innerHTML;
		}
	}else{
		 alert("Maximum Technical Design to be added is 10");
			   
	}
}

function deleteRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	for(var i=0; i<rowCount; i++) {
		var row = table.rows[i];
		var chkbox = row.cells[0].childNodes[0];
		if(null != chkbox && true == chkbox.checked) {
			if(rowCount <= 1) {               // limit the user from removing all the fields
				alert("Cannot remove all Technical Designs.");
				break;
			}
			table.deleteRow(i);
			rowCount--;
			i--;
		}
	}
}
</script>


	<?php $p_name = '' ?>
	
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
			
			<?php $p_name = "{{main.p_name}}";?>
			
			<div class="help-block" ng-messages="projForm.p_name.$error" ng-if="projForm.p_name.$touched">
			<p ng-message="minlength">Project Name is too short. Mininum characters of 5.</p>
			<p ng-message="maxlength">Project Name is too long. Maximum characrers of 50.</p>
			<p ng-message="required">Project Name is required.</p>
			
			</div>
		</div>
		
		<!-- START DATE -->	
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
		
		<!-- END DATE -->	
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
	
		
		<div class="form-group">
			<label><span class="text-danger"><b>*</b></span> STATUS</label><br />
			<?php $p_status = array ('Not Started' => 'Not Started', 'In Progress' => 'In Progress', 'Completed' => 'Completed'); ?>
			<?php echo form_dropdown('p_status',$p_status, $item->status,'class="form-control form-control-lg"'); ?> <?php echo form_error('p_status'); ?>            
		</div>
		<br>
		
	<?php endforeach;?> <!--PROJECT-->
	
	<!--START ENTRY-EXIT-->
	<?php foreach($ee_details as $ee_items):?>	
		<tbody>
			<tr>
				<td>
				<input type="text" required="required" name="ee_id" value="<?php echo $ee_items->ee_id?>" hidden >
				<label>ENTRY-EXIT NAME</label>
				<input type="text" required="required" name="ee_doc_name" value="<?php echo $ee_items->ee_doc_name?>" readonly class="form-control form-control-lg">

			 </td>
			 <td>
				<label for="tx_td_doc_link">ENTRY-EXIT LINK</label>
				<input type="text" required="required" name="ee_doc_link" value="<?php echo $ee_items->ee_doc_link?>" class="form-control form-control-lg">
			 </td>
			</tr>
		</tbody>
	<?php endforeach;?>
	<!--END ENTRY-EXIT-->

		<input type="button" value="Add Technical Design" onClick="addRow('dataTable')" /> 
		<input type="button" value="Remove Technical Design" onClick="deleteRow('dataTable')"  /> 
		
		<?php $td_name = 'Accenture Intralot - '. $p_name . ' - Technical Design'; ?>
		<!--Edit Technical Design-->
			<table>
				<?php foreach($td_details as $td_items):?>
				
				<tbody>
					<tr>
						<td><input type="checkbox" required="required" name="chk[]" checked="checked" disabled/></td>
						<td>
						<input type="text" required="required" name="tx_td_id[]" value="<?php echo $td_items->td_id?>" hidden >
						<label>TECHNICAL DESIGN NAME</label>
						<input type="text" required="required" name="tx_td_doc_name[]" value="<?php echo $td_name; ?>" readonly>

					 </td>
					 <td>
						<label for="tx_td_doc_link">TECHNICAL DESIGN LINK</label>
						<input type="text" required="required" name="tx_td_doc_link[]" value="<?php echo $td_items->td_doc_link?>">
					 </td>
					</tr>
				</tbody>
			<?php endforeach;?>
			</table>
		
		
		
		<!--Add Technical Design-->
		 <table id="dataTable" class="form" >
			<tbody>
				<tr>
				  <p>
					<td><input type="checkbox" required="required" name="chk[]" checked="checked" /></td>
					<div class="form-group">
						<td>
							<input type="text" required="required" name="bx_p_id[]" value="<?php echo $item->proj_id?>" hidden>
							<label>TECHNICAL DESIGN NAME</label>
							<input type="text" required="required" name="bx_td_doc_name[]" value="<?php echo $td_name; ?>">	
						 </td>
					</div>
					 <td>
						<label for="bx_td_doc_link">TECHNICAL DESIGN LINK</label>
						<input type="text" required="required"  name="bx_td_doc_link[]">
					 </td>
					 
					<p id="td_ver">0</p>
					</p>
				</tr>
			</tbody>
        </table>
		
		<?php echo form_submit('submit','Save','class="btn btn-info" ng-disabled="projForm.$invalid"');?>
		<?php echo form_close(); ?>	

		

</body>
