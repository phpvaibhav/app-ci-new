<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
	        <div class="ibox-title">
	            <h5><?= $title; ?></h5>
	            <div class="ibox-tools">
	                <a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
	                    <i class="fa fa-plus"></i> Create
	                </a>
	              
	            </div>
	        </div>
        	<div class="ibox-content">
            	<div class="table-responsive">
        			<table class="table table-striped table-bordered table-hover dataTables-example-list" data-list-url="apiv1/classint/list" data-id="<?= $_SESSION[USER_SESS_KEY]['instituteId'];?>" >
        				<thead>
					        <tr>
					            <th>S.No.</th>
					            <th>Class Name</th>
					            <th>Status</th>
					            <th>Action</th>
					        </tr>
				        </thead>
				        <tbody>  
        				</tbody>
				        <tfoot>
					        <tr>
								<th>S.No.</th>
								<th>Class Name</th>
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
<!-- MOdel -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content animated pulse">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Class</h4>
            </div>
            <!-- form -->
            <form class="form-horizontal"method="post" action="apiv1/classint/add" id="form-class-int" enctype="multipart/form-data" novalidate autocomplete="off">
            <div class="modal-body">
            	<input type="hidden" name="instituteId" value="<?= $_SESSION[USER_SESS_KEY]['instituteId'];?>">
            	<!-- form set -->
            	<div class="row">
            		<div class="col-md-12">
		    			<div class="form-group">
		            		<div class="col-md-12">
									<label class="control-label">Class Name</label>
									<input type="text" name="className" placeholder="Class Name" id="className" value="" class="form-control" >
		            		</div>
		        		</div>	
            		</div>
            	</div>

            	<!-- form set -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="sumbit" class="btn btn-primary">Save</button>
            </div>
            </form>
            <!-- form -->
        </div>
    </div>
</div>
<!-- MOdel -->