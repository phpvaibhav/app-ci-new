<?php $backend_assets=base_url().'backend_assets/';  

	/*echo "<pre>";
	print_r($info);
    echo $info->name;
	echo "</pre>";*/

?>
<div class="row m-b-lg m-t-lg">
    <div class="col-md-6">
	    <div class="profile-image">
	        <img src="img/a4.jpg" class="img-rounded circle-border m-b-md" alt="profile">
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
    <div class="col-md-3">
        <table class="table small m-b-xs">
            <tbody>
            <tr>
                <td>
                    <strong>142</strong> Projects
                </td>
                <td>
                    <strong>22</strong> Followers
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
    <div class="col-md-3">
        <small>Sales in last 24h</small>
        <h2 class="no-margins">206 480</h2>
        <div id="sparkline1"></div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="ibox">
            <div class="ibox-content">
                <h3>Personal friends</h3>
                <ul class="list-unstyled file-list">
                    <li><a href=""><i class="fa fa-file"></i> Project_document.docx</a></li>
                    <li><a href=""><i class="fa fa-file-picture-o"></i> Logo_zender_company.jpg</a></li>
                    <li><a href=""><i class="fa fa-stack-exchange"></i> Email_from_Alex.mln</a></li>
                    <li><a href=""><i class="fa fa-file"></i> Contract_20_11_2014.docx</a></li>
                    <li><a href=""><i class="fa fa-file-powerpoint-o"></i> Presentation.pptx</a></li>
                    <li><a href=""><i class="fa fa-file"></i> 10_08_2015.docx</a></li>
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
                        <li class="active"><a data-toggle="tab" href="#assign-teacher"> <i class="fa fa-laptop"></i></a></li>
                        <li class=""><a data-toggle="tab" href="#assign-staff"><i class="fa fa-desktop"></i></a></li>
                        <li class=""><a data-toggle="tab" href="#assign-student"><i class="fa fa-database"></i></a></li>
                    </ul>
                    <div class="tab-content">
                            <div id="assign-teacher" class="tab-pane active">
                                <div class="panel-body">
                                    <strong>Lorem ipsum dolor sit amet, consectetuer adipiscing</strong>
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