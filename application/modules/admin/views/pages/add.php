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
            <form class="form-horizontal"method="post" action="adminapi/page/add" id="form-add" enctype="multipart/form-data" novalidate autocomplete="off">
          		<input type="hidden" name="pageId" value="<?= isset($info['pageId']) ? encoding($info['pageId']):0; ?>">
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
									<input type="text" name="slug" placeholder="Title" id="slug" value="<?= isset($info['slug']) ? $info['slug']:""; ?>" class="form-control sluginput" readonly="">
									<span class="help-block m-b-none"><?= base_url().'info-page/' ?><span class="slugUrl"><?= isset($info['slug']) ? $info['slug']:""; ?></span></span>
		            		</div>
		        		</div>	
            		</div>
            		<div class="col-md-12">
		    			<div class="form-group">
		            		<div class="col-md-12">
									<label class="control-label">Meta Title</label>
									<input type="text" name="meta_title" placeholder="Meta Title" value="<?= isset($info['meta_title']) ? $info['meta_title']:""; ?>" class="form-control">
		            		</div>
		        		</div>	
            		</div>
            		<div class="col-md-12">
		    			<div class="form-group">
		            		<div class="col-md-12">
									<label class="control-label">Meta Keyword</label>
									<input type="text" name="meta_keyword" placeholder="Meta Keyword" value="<?= isset($info['meta_keyword']) ? $info['meta_keyword']:""; ?>" class="form-control">
		            		</div>
		        		</div>	
            		</div>
            		<div class="col-md-12">
		    			<div class="form-group">
		            		<div class="col-md-12">
									<label class="control-label">Meta Description</label>
									<textarea rows="3" placeholder="Meta Description" name="meta_description" class="form-control"><?= isset($info['meta_description']) ? $info['meta_description']:""; ?></textarea>
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
