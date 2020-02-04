
            <div class="row">

                <div class="col-lg-6 col-sm-6 col-md-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Change Password</h5>

                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal" method="post" action="changePassword" id="smart-form-changepass" enctype="multipart/form-data" novalidate autocomplete="off">
                              <!--   <p>Sign in today for more expirience.</p> -->
                                <div class="form-group">

                                    <div class="col-lg-12">
                                    	<label class="control-label">Password</label>
                                    	<input type="password" name="password" placeholder="Current Password" id="password" class="form-control"> <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="col-lg-12">
										<label class="control-label">New Password</label>
                                    	<input type="password" name="npassword" id="npassword" placeholder="Password" class="form-control"></div>
                                </div> 
                                <div class="form-group">

                                    <div class="col-lg-12">
                                    	<label class="control-label">Confirm Password</label>
                                    	<input type="password" name="rnpassword" placeholder="Confirm password" class="form-control"></div>
                                </div>
                               <!--  <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"><label> <input type="checkbox"><i></i> Remember me </label></div>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"  id="submit">Change</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
