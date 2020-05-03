<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
	        <div class="ibox-title">
	            <h5><?= $title; ?></h5>
	            <div class="ibox-tools">
	              <!--   <a href="<?php echo base_url().'admin/plan/add'; ?>" class="btn btn-primary" >
	                    <i class="fa fa-plus"></i> Create
	                </a> -->
	              
	            </div>
	        </div>
        	<div class="ibox-content">
            	<div class="table-responsive">
        			<table class="table table-striped table-bordered table-hover dataTables-example-list" data-list-url="apiv1/plan/list" data-id="0" >
        				<thead>
					        <tr>
					            <th>S.No.</th>
					            <th>Full name</th>
					            <th>Plan Type</th>
					            <th>Price</th>
					            <th>No. Of Students</th>
					            <th>Expiry Date</th>
					            <th>Action</th>
					        </tr>
				        </thead>
				        <tbody>  
				        	<tr>
					            <td colspan="7"><center>No Record Found.</center></td>
					          
					        </tr>
        				</tbody>
				        <tfoot>
					        <tr>
					            <th>S.No.</th>
					            <th>Full name</th>
					            <th>Plan Type</th>
					            <th>Price</th>
					            <th>No. Of Students</th>
					            <th>Expiry Date</th>
					            <th>Action</th>
					        </tr>
				        </tfoot>
        			</table>
            	</div>
        	</div>
    	</div>
	</div>
</div>
