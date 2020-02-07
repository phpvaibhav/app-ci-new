
<div class="row">

    <div class="col-lg-6 col-sm-6 col-md-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Info</h5>

            </div>
            <div class="ibox-content">
                <form class="form-horizontal"method="post" action="apiv1/users/instituteInfo" id="smart-form-updateInfo" enctype="multipart/form-data" novalidate autocomplete="off">
                	<input type="hidden" name="instituteId" value="<?= encoding($info['instituteId']);?>" >
                  <!--   <p>Sign in today for more expirience.</p> -->
                    <div class="form-group">

                        <div class="col-lg-12">
                        	<label class="control-label">Institute Name</label>
                        	<input type="text" name="name" placeholder="school name" id="name" value="<?= $info['name'];?>" class="form-control" >
                         <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-lg-12">
                        	<label class="control-label">Email</label>
                        	<input type="text"  name="email" placeholder=" Email" id="email" value="<?= $info['email'];?>" class="form-control" >
                         <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
                        </div>
                    </div> 
                    <div class="form-group">

                        <div class="col-lg-12">
                            <label class="control-label">Phone Number</label>
                            <input type="text"  name="phoneNumber" placeholder="Phone Number" id="phoneNumber" value="<?= $info['phoneNumber'];?>" class="form-control" >
                         <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
                        </div>
                    </div> 
                    <div class="form-group">

                        <div class="col-lg-12">
                            <label class="control-label">Description</label>
                            <textarea name="description" class="form-control"><?= $info['description'];?></textarea>
                         <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
                        </div>
                    </div>
                  <!--   <div class="form-group">

                        <div class="col-lg-12">
                        	<label class="control-label">Logo</label>
                        	<div class="input input-file">
								<span class="button"><input type="file" name="logoImage" id="file" onchange="filePreviewImage(this);this.parentNode.nextSibling.value = this.value" accept="image/*">Browse</span><input type="text" readonly="">
							</div>
                        
                        </div>
                    </div> -->
                        <!-- image -->
                                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                        <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                        <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="logoImage" accept="image/*"  onchange="filePreviewImage(this);"></span>
                                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                <!-- image -->
                     <div class="form-group">
                        <div class="note">
                            <strong>Note:</strong> Image dimension should be within 200X60.
                            </div>
                        <div class="col-lg-12">
                        	<?php 
										$logo = base_url().'common_assets/img/meteor_logo.png';
										if(!empty($info['logo'])){
											//if(file_exists(base_url().'company_assets/logo/'.$companyinfo['logo'])){
											$logo = base_url().'uploads/logo/'.$info['logo'];
											//}
										}

									 ?>
									 <div id="privew">
										<img src="<?= $logo; ?>" class="img img-responsive img-thunbnail">
									</div>
                        </div>
                    </div>
                   
                  
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"  id="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



