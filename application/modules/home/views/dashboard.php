        <div class="row">
            <?php if(!empty($count_list)): foreach ($count_list as $k => $count) {
               ?>
                    <div class="col-lg-3">
                        <a href="<?= base_url().$count['link']; ?>">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                             <!--    <span class="label label-success pull-right">Monthly</span> -->
                                <h5><?= $count['label']; ?></h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?= $count['count']; ?></h1>
                                <div class="stat-percent font-bold text-success"><i class="<?= $count['icon']; ?>"></i></div>
                                <small>Total <?= $count['label']; ?></small>
                            </div>
                        </div>
                        </a>
                    </div>
               <?php } endif; ?>
                   
        </div>
   <!--  <div class="middle-box text-center animated fadeInRightBig">
        <h3 class="font-bold">This is page content</h3>
        <div class="error-desc">
            You can create here any grid layout you want. And any variation layout you imagine:) Check out
            main dashboard and other site. It use many different layout.
            <br/><a href="index.html" class="btn btn-primary m-t">Dashboard</a>
        </div>
    </div>
 -->