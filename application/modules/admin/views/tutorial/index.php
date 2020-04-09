<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
	        <div class="ibox-title">
	            <h5><?= $title; ?></h5>
	            <div class="ibox-tools">
	                <a href="javascript:void(0);" class="btn btn-primary" onclick="openAction();" >
	                    <i class="fa fa-plus"></i> Create
	                </a>
	              
	            </div>
	        </div>
        	<div class="ibox-content">
            	<div class="table-responsive">
        			<table class="table table-striped table-bordered table-hover dataTables-example-list" data-list-url="adminapi/tutorial/list" data-id="0" >
        				<thead>
					        <tr>
					            <th>S.No.</th>
					            <th>Title</th>
					            <th>RoleType</th>
					            <th>Image</th>
					            <th>Description</th>
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
					            <th>RoleType</th>
					            <th>Image</th>
					            <th>Description</th>
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
                <h4 class="modal-title">Tutorial</h4>
            </div>
            <!-- form -->
            <form class="form-horizontal"method="post" action="adminapi/tutorial/add" id="form-add" enctype="multipart/form-data" novalidate autocomplete="off">
            <div class="modal-body">
            	<input type="hidden" id="tutorialId" name="tutorialId" value="0">
            	<!-- form set -->
            	<div class="row">
            		<div class="col-md-12">
		    			<div class="form-group">
		            		<div class="col-md-12">
									<label class="control-label">Title</label>
									<input type="text" name="title" placeholder="Title" id="title" value="" class="form-control" >
		            		</div>
		        		</div>	
            		</div>
            		<div class="col-md-12">
		    			<div class="form-group">
		            		<div class="col-md-12">
		            			<label class="control-label">Select Role Type</label>
								<select  name="roleType" id="roleType" class="form-control">
									
								  <option value=""> Select Role Type</option>
								
								 		 <option value="Student">Student</option>
								 		 <option value="Teacher">Teacher</option>
								 		 <option value="School">School</option>
								 

								</select>
		            		</div>
		        		</div>	
            		</div>
            		<div class="col-md-12">
		    			<div class="form-group">
		            		<div class="col-md-12">
									<label class="control-label">Image</label>
									<input type="text" name="image" placeholder="Image link" id="image" value="" class="form-control" >
		            		</div>
		        		</div>	
            		</div>
            		<div class="col-md-12">
		    			<div class="form-group">
		            		<div class="col-md-12">
								<label class="control-label">Description</label>
								 <textarea name="description" id="description" class="form-control" class=""></textarea>
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