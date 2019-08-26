        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Content Row -->
          <div class="row">
            <?php
                if(!empty($this->session->userdata('msg'))){ 
                ?>
                <div class="col-md-12 alert alert-success"><?=$this->session->userdata('msg');?>
                </div>
              <?php }
              ?> 
          </div>
          
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Hi <?= $userinfo[0]['name']; ?></h1>
          </div>

          <div class="row">

            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Login overview</h6>
                  <div class="dropdown no-arrow">
                    <!-- <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a> -->
                    <!-- <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div> -->
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <canvas id="myPieChart" width="280" height="245" class="chartjs-render-monitor" style="display: block; width: 280px; height: 245px;" data-value='<?= $overview ?>'></canvas>
                  </div>

                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Direct
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Google
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> Facebook
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <?php
            if($userinfo[0]['role'] == 1){ 
            ?>
            <div class="col">
              <div class="card shadow mb-12">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Deleted accounts</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Email id</th>
                          <th>Deleted date</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Email id</th>
                          <th>Deleted date</th>
                        </tr>
                      </tfoot>
                      <tbody>
                    <?php 
                      if(!empty($da)){
                      foreach($da as $val){
                    ?>
                        <tr>
                          <td><?= $val['email']; ?></td>
                          <td><?= $val['deleted']; ?></td>
                        </tr>
                    <?php } } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Login history</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="login_history" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Account Type</th>
                      <th>Login date</th>
                    </tr>
                  </thead>
                  <!-- <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Account Type</th>
                      <th>Login date</th>
                    </tr>
                  </tfoot> -->
                  <tbody>
                      <?php 
                        foreach($lh as $val){
                      ?>
                      <tr>
                        <td><?= $val['name'] ?></td>
                        <td><?= $val['email'] ?></td>
                        <td><?= $val['logintype'] ?></td>
                        <td><?= $val['logindate'] ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
            </div>
          </div>
        </div>
</div>