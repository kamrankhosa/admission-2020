<?php
include 'header.php';

?> 
<!--main content start-->
      <section id="main-content">
          <section class="wrapper" style="padding-bottom: 180px;">
          	<!-- <h3><i class="fa fa-angle-right"></i> Merit Lists > Genrate List</h3> -->
          	
          	<!-- BASIC FORM ELELEMNTS -->
          	<div class="row mt">
              <div class="col-lg-2">
              </div>
          		<div class="col-lg-8">
                  <div class="form-panel">
                  	  <h4 class="mb text-center"> Proifle Setting</h4>
                      <form class="form-horizontal style-form" method="post" action="<?php echo base_url(); ?>admin/profile_update" enctype="multipart/form-data">
                        <?php foreach ($profile as $data) {
                         ?>
                         <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Full Name</label>
                              <div class="col-sm-10">
                                  <input type="text" name="fname" class="form-control" placeholder="Full Name" required="" value="<?php echo $data->Fullname; ?>">
                              </div>
                          </div>
                              <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Email / Username</label>
                              <div class="col-sm-10">
                                  <input type="email" name="Username" class="form-control" placeholder="Email / Username" required="" value="<?php echo $data->username; ?>">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Gender</label>
                              <div class="col-sm-2">
                                  
                                    <input type="radio" value="Male" name="gender" <?php if ($data->gender=='Male'){
                                      echo "checked";
                                    } ?>
                                     > Male
                                    
                              </div>
                              <div class="col-sm-2">
                                  <input type="radio" value="Female" name="gender" <?php if ($data->gender=='Female'){
                                      echo "checked";
                                    } ?>> Female
                              </div>
                          </div>
                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">From</label>
                              <div class="col-sm-10">
                                  <input type="text" name="dpt" class="form-control" disabled="" value="<?php echo $data->Department; ?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Profile</label>
                              <div class="col-sm-10">
                                  <input type="file" name="profileImage" class="form-control" accept=".jpg,.jpeg,.png">
                              </div>
                          </div>
                        <?php } ?>
                          <div style="text-align: center;">
                    
                          <input type="submit" name="sub" value="Update Profile" class="btn btn-success btn-lg"/>
                          </div>
                      </form>
                  </div>
          		</div><!-- col-lg-12-->   
              </div>
              </section>

          	 <?php
include 'footer.php';

?> 