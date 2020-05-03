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
            <form class="form-horizontal"method="post" action="apiv1/plan/add" id="form-add" enctype="multipart/form-data" novalidate autocomplete="off">
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
								<label class="control-label">Plan For</label>
								<select  name="planFor" class="form-control">
									<option value="" >Select role</option>
									<option value="Institute" <?= (isset($info['planFor']) &&$info['planFor']=='Institute')  ? "selected='selected'" :""; ?> >Institute</option>
									<option value="Teacher" <?= (isset($info['planFor']) &&$info['planFor']=='Teacher') ?  "selected='selected'" :""; ?> >Teacher</option>
									
								</select>
		            		</div>
		        		</div>	
            		</div>
            		<div class="col-md-6">
		    			<div class="form-group">
		            		<div class="col-md-12">
								<label class="control-label">Plan Type</label>
								<select  name="planType" class="form-control">
									<option value="" >Select plan</option>
									<option value="1" <?= (isset($info['planType']) &&$info['planType']=='1') ?  "selected='selected'" :""; ?> >Monthly</option>
									<option value="2"  <?= (isset($info['planType']) &&$info['planType']=='2') ?  "selected='selected'" :""; ?> >Quarterly</option>
									<option value="3"  <?= (isset($info['planType']) &&$info['planType']=='3') ?  "selected='selected'" :""; ?> >Half Yearly</option>
									<option value="4"  <?= (isset($info['planType']) &&$info['planType']=='4') ?  "selected='selected'" :""; ?> >Yearly</option>
									
								</select>
		            		</div>
		        		</div>	
            		</div>
            		<div class="col-md-6">
		    			<div class="form-group">
		            		<div class="col-md-12">
							<label class="control-label">No. Of students</label>
						<input type="text" name="studentCount" placeholder="No. Of students"  value="<?= isset($info['studentCount']) ? $info['studentCount']:""; ?>" class="form-control number-only" >
		            		</div>
		        		</div>	
            		</div>
        		
            		<div class="col-md-6">
		    			<div class="form-group">
		            		<div class="col-md-12">
									<label class="control-label">Price</label>
									<input type="text" name="price" placeholder="Price"  value="<?= isset($info['price']) ? $info['price']:""; ?>" class="form-control floatNumeric" >
		            		</div>
		        		</div>	
            		</div>
            		<div class="col-md-6">
		    			<div class="form-group">
		            		<div class="col-md-12">
									<label class="control-label">Discount(%)</label>
									<input type="text" name="discount" placeholder="Discount(%)"  value="<?= isset($info['discount']) ? $info['discount']:""; ?>" class="form-control floatNumeric" >
		            		</div>
		        		</div>	
            		</div>
            		<div class="col-md-6">
		    			<div class="form-group">
		            		<div class="col-md-12">
									<label class="control-label">Order by</label>
									<input type="text" name="sort_by" placeholder="Order by"  value="<?= isset($info['sort_by']) ? $info['sort_by']:""; ?>" class="form-control number-only" >
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
