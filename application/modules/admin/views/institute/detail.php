<?php $backend_assets=base_url().'common_assets/';  

    $logo = $backend_assets.'img/placeholder-logo.png';
    if(!empty($info->logo)):
        $logo = base_url().'uploads/logo/'.$info->logo;
    endif;
	/*echo "<pre>";
	print_r($info);
   
	echo "</pre>";*/

?>
<div class="row m-b-lg m-t-lg">
    <div class="col-md-6">
	    <div class="profile-image">
	        <img src="<?=  $logo; ?>" class="img-rounded  m-b-md" alt="profile">
	    </div>
	    <div class="profile-info">
	        <div class="">
	            <div>
	                <h2 class="no-margins">
	                    <?= isset($info->name) ? ucfirst($info->name):"NA"; ?>
	                </h2>
	                <h4> <?= isset($info->createdBy) ? ucfirst($info->createdBy):"NA"; ?></h4>
	                <small>
	                   <?= isset($info->description) ? $info->description:"NA"; ?>
	                </small>
	            </div>
	        </div>
	    </div>
    </div>
    <div class="col-md-6">
        <table class="table small m-b-xs">
            <tbody>
            <tr>
                <td>
                    <strong>142</strong> Teachers
                </td>
                 <td>
                    <strong>142</strong> Staff
                </td>
             
               <td>
                    <strong>142</strong> Students
                </td>

            </tr> 
           
           <!--  <tr>
                <td>
                    <strong>61</strong> Comments
                </td>
                <td>
                    <strong>54</strong> Articles
                </td>
            </tr> -->
          
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="ibox">
            <div class="ibox-content">
                <h3>Basic Information</h3>
                <ul class="list-unstyled file-list">
                    <li><a href="javascript:void(0);"><i class="fa fa-envelope"></i> <?= $info->email; ?></a></li>
                    <li><a href="javascript:void(0);"><i class="fa fa-phone"></i> <?= $info->phoneNumber; ?></a></li>
                   
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
    	<!-- Tab -->
        <div class="row">
            <div class="col-lg-12">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#assign-teacher"> <i class="fa fa-vcard"></i> Teachers</a></li>
                        <li class=""><a data-toggle="tab" href="#assign-staff"><i class="fa fa-group"></i> Staff</a></li>
                        <li class=""><a data-toggle="tab" href="#assign-student"><i class="fa fa-child"></i> Students</a></li>
                    </ul>
                    <div class="tab-content">
                            <div id="assign-teacher" class="tab-pane active">
                                <div class="panel-body">
                                   <!-- Contact -->
                                   <div class="row" >
                                        <div class="col-lg-4">
                                            <div class="contact-box center-version">

                                                <a href="profile.html">

                                                    <img alt="image" class="img-circle" src="<?= $backend_assets;?>img/a2.jpg">


                                                    <h3 class="m-b-xs"><strong>John Smith</strong></h3>

                                                    <div class="font-bold">Graphics designer</div>
                                                    <address class="m-t-md">
                                                        <strong>Twitter, Inc.</strong><br>
                                                        795 Folsom Ave, Suite 600<br>
                                                        San Francisco, CA 94107<br>
                                                        <abbr title="Phone">P:</abbr> (123) 456-7890
                                                    </address>

                                                </a>
                                                <div class="contact-box-footer">
                                                    <div class="m-t-xs btn-group">
                                                        <a class="btn btn-xs btn-white"><i class="fa fa-phone"></i> Call </a>
                                                        <a class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Email</a>
                                                        <a class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Follow</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                   </div>
                                   <!-- Contact -->
                               </div>
                            </div>
                            <div id="assign-staff" class="tab-pane">
                                <div class="panel-body">
                                    <strong>Donec quam felis</strong>
                                </div>
                            </div>
                            <div id="assign-student" class="tab-pane">
                                <div class="panel-body">
                                    <strong>Donec quam felis</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    	<!-- Tab -->
	</div>
</div>