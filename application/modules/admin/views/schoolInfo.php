
<div class="row">

    <div class="col-lg-6 col-sm-6 col-md-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>School Info</h5>

            </div>
            <div class="ibox-content">
                <form class="form-horizontal"method="post" action="schoolinfo" id="smart-form-schoolinfo" enctype="multipart/form-data" novalidate autocomplete="off">
                	<input type="hidden" name="schoolId" value="<?= encoding($schoolinfo['schoolId']);?>" >
                  <!--   <p>Sign in today for more expirience.</p> -->
                    <div class="form-group">

                        <div class="col-lg-12">
                        	<label class="control-label">School Name</label>
                        	<input type="text" name="schoolName" placeholder="school name" id="schoolName" value="<?= $schoolinfo['schoolName'];?>" class="form-control" >
                         <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-lg-12">
                        	<label class="control-label">School Email</label>
                        	<input type="text"  name="schoolEmail" placeholder="School email" id="schoolEmail" value="<?= $schoolinfo['schoolEmail'];?>" class="form-control" >
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
                            <strong>Note:</strong> Image dimension should be within 250X56.
                            </div>
                        <div class="col-lg-12">
                        	<?php 
										$logo = base_url().'backend_assets/img/company_logo_default.png';
										if(!empty($schoolinfo['schoolLogo'])){
											//if(file_exists(base_url().'company_assets/logo/'.$companyinfo['logo'])){
											$logo = base_url().'company_assets/schoolLogo/'.$schoolinfo['schoolLogo'];
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



