<body ng-app="app" ng-controller="MainCtrl as main">

<div class="container text-center">
	<div class="row"> <br /> <br /></div>
	
	<div class="row">
		<div class="col-md-8 well" style="display:inline-block; text-align:left; float:none;">
		
		<h3>
				<font color="#3d3d3d" style="font-weight: bold;" class="centered-text"> View Project </font>
		</h3>
		<hr />
	
	
		<?php foreach($project_details as $item):?>
		
	
			<?php echo form_hidden('p_id',$item->proj_id);?>
	
			<!-- Project Name -->
			<div class="row">
				<div class="col-md-6">
					<label><span class="text-danger"></span> PROJECT NAME </label>
					<p><?php echo $item->proj_name ?></p>
				</div>
				
				<div class="col-md-6">
					<!-- Status -->
					<label><span class="text-danger"></span> STATUS </label>
					<p><?php echo $item->status ?></p>	
				</div>
				
			</div>
		
			<div class="row">
				<div class="col-md-6">
					<label><span class="text-danger"></span> START DATE </label><br />
					<?php echo $item->start_date ?>
				</div>
				
				<div class="col-md-6">
					<label><span class="text-danger"></span> END DATE </label><br />
					<?php echo $item->end_date ?>
				</div>
			</div>
		
		<hr />
		
	<?php endforeach;?> 
	
			<?php $p_name = $item->proj_name ?>
			<?php $td_name = 'Accenture Intralot - '.$p_name.' - Technical Design'; ?>
			
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


