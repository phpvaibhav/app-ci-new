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
            <form class="form-horizontal"method="post" action="adminapi/blog/add" id="form-add" enctype="multipart/form-data" novalidate autocomplete="off">
          		<input type="hidden" name="blogId" value="<?= isset($info['blogId']) ? encoding($info['blogId']):0; ?>">
            	<!-- form set -->
            	<div class="row">
            		<div class="col-md-12">
		    			<div class="form-group">
		            		<div class="col-md-12">
									<label class="control-label">Title</label>
									<input type="text" name="title" placeholder="Title" id="title" value="<?= isset($info['title']) ? $info['title']:""; ?>" class="form-control txturl" >
		            		</div>
		        		</div>	
            		</div>
            	
            		<div class="col-md-12">
		    			<div class="form-group">
		            		<div class="col-md-12">
									<label class="control-label">Slug</label>
									<input type="text" name="slug" placeholder="Slug" id="slug" value="<?= isset($info['slug']) ? $info['slug']:""; ?>" class="form-control sluginput" readonly="">
									<span class="help-block m-b-none"><?= base_url().'blog-info/' ?><span class="slugUrl"><?= isset($info['slug']) ? $info['slug']:""; ?></span></span>
		            		</div>
		        		</div>	
            		</div>
            		<div class="col-md-12">
		    			<div class="form-group">
		            		<div class="col-md-12">
									<label class="control-label">Instruments</label>
									<select name="instrumentId"  class="form-control">
										  <option value="" selected="" disabled="">Select Instrument</option>
										<?php if(!empty($instruments)): foreach ($instruments as $k => $instrument) {?>
										<option value="<?= $instrument->instrumentId ; ?>" <?= (isset($info['instrumentId']) && $instrument->instrumentId==$info['instrumentId']) ?"selected='selected'":""  ?>><?= $instrument->name; ?></option>
									<?php } endif; ?>
									</select>
		            		</div>
		        		</div>	
            		</div>
            		<div class="col-md-12">
		    			<div class="form-group">
		            		<div class="col-md-12">
									<label class="control-label">Description</label>
									 <textarea name="description" rows = "5" cols = "40" class="form-control"><?= isset($info['description']) ? $info['description']:""; ?></textarea>
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
									<?php
										$img = 'common_assets/img/avatars/sunny-big.png';
										if(isset($info['image']) && !empty($info['image'])){
											$img = 'uploads/blog/thumb/'.$info['image'];
										}

									?>
									<img src="<?= base_url().$img; ?>"  class="img img-responsive img-thunbnail image_link_pre" width="150" height="150" />
								</div>
							</div>
							<!-- image -->
						</div>

            		<div class="col-md-12">
							<div class="form-group">
							<div class="col-md-12">
							<button type="sumbit" class="btn btn-primary pull-right">Save</button>
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
