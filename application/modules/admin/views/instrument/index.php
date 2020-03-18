<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
	        <div class="ibox-title">
	            <h5><?= $title; ?></h5>
	            <div class="ibox-tools">
	                <a  href="javascript:void(0);" class="btn btn-primary" onclick="openAction();" >
	                    <i class="fa fa-plus"></i> Create
	                </a>
	              
	            </div>
	        </div>
        	<div class="ibox-content">
            	<div class="table-responsive">
        			<table class="table table-striped table-bordered table-hover dataTables-example-list" data-list-url="adminapi/instrument/list" data-id="0" >
        				<thead>
					        <tr>
					            <th>S.No.</th>
					            <th>Image</th>
					            <th>Name</th>
					            <th>Status</th>
					            <th>Action</th>
					        </tr>
				        </thead>
				        <tbody>  
        				</tbody>
				        <tfoot>
					        <tr>
					            <th>S.No.</th>
					            <th>Image</th>
					            <th>Name</th>
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
                <h4 class="modal-title">Instrument</h4>
            </div>
            <!-- form -->
            <form class="form-horizontal"method="post" action="adminapi/instrument/add" id="form-add" enctype="multipart/form-data" novalidate autocomplete="off">
            <div class="modal-body">
            	<input type="hidden" name="instrumentId" id="instrumentId" value="0">
            	<!-- form set -->
            	<div class="row">
            		<div class="col-md-12">
		    			<div class="form-group">
		            		<div class="col-md-12">
									<label class="control-label">Name</label>
									<input type="text" name="name" placeholder="Name" id="name" value="" class="form-control" >
		            		</div>
		        		</div>	
            		</div>
            		<div class="col-md-12">
						<div class="form-group">
							<div class="col-md-12">
						 	<label class="control-label">Image</label>
							<!-- image -->
							<div class="fileinput fileinput-new input-group" data-provides="fileinput">
								<div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
								<span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="image" accept="image/*" onchange="filePreviewImage(this);"></span>
								<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
							</div>
							<!-- image -->
							</div>
						</div>
								
					</div>
            		<div class="col-md-12">
						<div class="form-group">
							<div class="col-md-12">
							 	<label class="control-label">Image Privew</label>
								<!-- image -->
								<div id="privew">
									<img src="#"  class="img img-responsive img-thunbnail image_link_pre"/>
								</div>
							</div>
							<!-- image -->
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
