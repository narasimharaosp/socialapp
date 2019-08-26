        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Profile details</h1>

            <a class="col-md-2 dropdown-item float-right" href="#" data-toggle="modal" data-target="#deleteModal">
              <button type="button" class="btn btn-danger">Delete account</button>
            </a>
      
          </div>

          <!-- Content Row -->
          <div class="row">
            <?php
                if(!empty($this->session->userdata('msg'))){ 
                ?>
                <div class="alert alert-success"><?=$this->session->userdata('msg');?>
                </div>
              <?php }
              ?> 
          </div>
          <div class="row">
              <div class="col-md-3"><h6>User id</h6>
              </div>
              <div class="col-md-9"><span><?= $userid; ?></span>
              </div>
          </div>
          <div class="row">
              <div class="col-md-3"><h6>Name</h6>
              </div>
              <div class="col-md-9"><span><?= $name; ?></span>
              </div>
          </div>
          <div class="row">
              <div class="col-md-3"><h6>Email id</h6>
              </div>
              <div class="col-md-9"><span><?= $email; ?></span>
              </div>
          </div>
          <div class="row">
              <div class="col-md-3"><h6>Age</h6>
              </div>
              <div class="col-md-9"><span><?= $age; ?></span>
              </div>
          </div>
          <div class="row">
              <div class="col-md-3"><h6>Gender</h6>
              </div>
              <div class="col-md-9"><span><?= ($gender == 0) ? 'Male' : 'female'; ?></span>
              </div>
          </div>
          <div class="row">
              <div class="col-md-3"><h6>Location</h6>
              </div>
              <div class="col-md-9"><span><?= 'Bangalore' ?></span>
              </div>
          </div>
          <!-- <div class="row">
              <div class="col-md-3"><h6>Link to facebook</h6>
              </div>
              <div class="col-md-9"><span></span>
              </div>
          </div>
          <div class="row">
              <div class="col-md-3"><h6>Link to Google</h6>
              </div>
              <div class="col-md-9"><span></span>
              </div>
          </div> -->
        </div>