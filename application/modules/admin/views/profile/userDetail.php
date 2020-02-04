<?php 
	$backend_assets=base_url().'backend_assets/';  
	$img 	= $backend_assets.'img/avatars/sunny-big.png';
	if(!empty($userData['profileImage'])):
		$img = base_url().'uploads/admin/thumb/'.$userData['profileImage'];
	endif;
	$fullName = ucfirst($userData['fullName']);
	switch ($userData['userType']) {
		case 1:
			$userType = 'Super Admin';
			break;
		case 2:
			$userType ='Customer';
			break;
		case 3:
			$userType ='Employee';
			break;
		
		default:
			$userType ='Unknown';
			break;
	}


	 ?>
<!-- Profile -->
<div class="row m-b-lg m-t-lg">
	<div class="col-md-4">
        <div class="ibox-content padding border-left-right">
          	<div class="profile-image">
            	<img src="<?= $img ;?>" class="img-circle circle-border m-b-md" alt="<?php echo $userData['fullName'];?>">
        	</div>
	        <div class="profile-info">
	            <div class="">
	                <div>
	                    <h2 class="no-margins">
	                       <?php echo $fullName;?>
	                    </h2>
	                    <h4> <?php echo $userType;?></h4>
	                    <small>
	                    	<br>
	                    	<br>
	                    	<br>
	                    	<br>
	                        <!-- There are many variations of passages of Lorem Ipsum available, but the majority
	                        have suffered alteration in some form Ipsum available. -->
	                    </small>
	                    <!--  -->
	                </div>
	            </div>
	        </div>
	        <!-- test -->    
            <div id="vertical-timeline" class="vertical-container light-timeline no-margins">
                <div class="vertical-timeline-block">
                    <div class="vertical-timeline-icon blue-bg">
                        <i class="fa fa-envelope"></i>
                    </div>

                    <div class="vertical-timeline-content">
                       <h5><?= $userData['email'];?></h5>
                       
                    </div>
                </div>
                <div class="vertical-timeline-block">
                    <div class="vertical-timeline-icon yellow-bg">
                        <i class="fa fa-phone"></i>
                    </div>

                    <div class="vertical-timeline-content">
                       <h5><?php echo $userData['contactNumber']; ?></h5>
                       
                    </div>
                </div>
            </div>

	        <!-- test -->
        </div>
    </div>
              
    <div class="col-md-8">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Profile</h5>
            </div>
            <div class="ibox-content">
				<form class="form-horizontal" method="post" action="updateUser" id="smart-form-updateuser" enctype="multipart/form-data" novalidate autocomplete="off">
					<input type="hidden" name="userauth" value="<?php echo $this->uri->segment(2); ?>">
				          <!--   <p>Sign in today for more expirience.</p> -->
				            <div class="form-group">

				                <div class="col-lg-12">
				                	<label class="control-label">Full name</label>
				                	<input type="text" class="form-control" name="fullName" placeholder="Full name" value="<?php echo $userData['fullName']; ?>" maxlength="30" size="30">
				                </div>
				            </div>
							<div class="form-group">

							    <div class="col-lg-12">
							    	<label class="control-label">Email</label>
							    	<input class="form-control" type="email" name="email" placeholder="Email address" value="<?php echo $userData['email']; ?>" maxlength="30" size="30">
							    </div>
							</div>
							<div class="form-group">

							    <div class="col-lg-12">
							    	<label class="control-label">Contect</label>
							    	<input class="form-control" type="text" name="contact" maxlength="20" size="20" class="number-only" placeholder="Contact"  value="<?php echo $userData['contactNumber']; ?>">
							    </div>
					<!-- 	    	<div class="input input-file">
									<span class="button"><input type="file" name="profileImage" id="file" onchange="this.parentNode.nextSibling.value = this.value" accept="image/*">Browse</span><input type="text" readonly="">
								</div> -->

							</div>
								<!-- image -->
									<div class="fileinput fileinput-new input-group" data-provides="fileinput">
										<div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
										<span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="profileImage" accept="image/*"></span>
										<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
									</div>
								<!-- image -->
				            <div class="form-group">
				                <div class="col-lg-offset-2 col-lg-10">
				                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"  id="submit">Update</button>
				                </div>
				            </div>
				        </form>
            </div>
        </div>

    </div>
</div>