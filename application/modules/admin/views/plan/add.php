<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
	        <div class="ibox-title">
	            <h5><?= $title; ?></h5>
	            <div class="ibox-tools">
	                <!-- <a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
	                    <i class="fa fa-plus"></i> Create
	                </a> -->
	              
	            </div>
	        </div>
        	<div class="ibox-content">
            <!-- form -->
            <form class="form-horizontal"method="post" action="adminapi/plan/add" id="form-add" enctype="multipart/form-data" novalidate autocomplete="off">
          		<input type="hidden" name="planId" value="<?= isset($info['planId']) ? encoding($info['planId']):0; ?>">
            	<!-- form set -->
            	<div class="row">
            		<div class="col-md-12">
		    			<div class="form-group">
		            		<div class="col-md-12">
									<label class="control-label">Title</label>
									<input type="text" name="title" placeholder="Title" id="title" value="<?= isset($info['title']) ? $info['title']:""; ?>" class="form-control" >
		            		</div>
		        		</div>	
            		</div>
        			<div class="col-md-6">
		    			<div class="form-group">
		            		<div class="col-md-12">
								<label class="control-label">Role Type</label>
								<select  name="classId" class="form-control">
									<option value="" >Select role</option>
									<option value="1" >Institute</option>
									<option value="1" >Teacher</option>
									
								</select>
		            		</div>
		        		</div>	
            		</div>
            		<div class="col-md-6">
		    			<div class="form-group">
		            		<div class="col-md-12">
							<label class="control-label">Number of </label>
						<input type="text" name="count" placeholder=""  value="" class="form-control" >
		            		</div>
		        		</div>	
            		</div>
        		
            		<div class="col-md-6">
		    			<div class="form-group">
		            		<div class="col-md-12">
									<label class="control-label">Price</label>
									<input type="text" name="price" placeholder="Price"  value="" class="form-control" >
		            		</div>
		        		</div>	
            		</div>
            		<div class="col-md-6">
		    			<div class="form-group">
		            		<div class="col-md-12">
									<label class="control-label">Discount(%)</label>
									<input type="text" name="discount" placeholder="Discount(%)"  value="" class="form-control" >
		            		</div>
		        		</div>	
            		</div>
            	
            		<div class="col-md-12">
		    			<div class="form-group">
		            		<div class="col-md-12">
									<label class="control-label">Description</label>
									 <textarea name="description" class="note_description" ><?= isset($info['description']) ? $info['description']:""; ?></textarea>
		            		</div>
		        		</div>	
            		</div>
            		<div class="col-md-12">
							<div class="form-group">
							<div class="col-md-12">
							<button type="sumbit" class="btn btn-primary">Save</button>
							</div>
							</div>	
            		</div>
            	
            	</div>

            	<!-- form set -->
       

            </form>
            <!-- form -->
        	</div>
    	</div>
	</div>
</div>
