<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
	        <div class="ibox-title">
	            <h5><?= $title; ?></h5>
	            <div class="ibox-tools">
	                <a href="<?php echo base_url().'admin/page/add'; ?>" class="btn btn-primary" >
	                    <i class="fa fa-plus"></i> Create
	                </a>
	              
	            </div>
	        </div>
        	<div class="ibox-content">
            	<div class="table-responsive">
        			<table class="table table-striped table-bordered table-hover dataTables-example-list" data-list-url="adminapi/page/list" data-id="0" >
        				<thead>
					        <tr>
					            <th>S.No.</th>
					            <th>Title</th>
					            <th>Slug</th>
					          <!--   <th>Description</th> -->
					            <th>Status</th>
					            <th>Action</th>
					        </tr>
				        </thead>
				        <tbody>  
        				</tbody>
				        <tfoot>
					        <tr>
								<th>S.No.</th>
								<th>Title</th>
								<th>Slug</th>
								<!-- <th>Description</th> -->
								<th>Status</th>
								<th>Action</th>
					        </tr>
				        </tfoot>
        			</table>
            	</div>
        	</div>
    	</div>
	</div>
</div>
