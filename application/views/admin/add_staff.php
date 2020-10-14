<?php
include 'header.php';

?> 
<section id="main-content">
          <section class="wrapper" style="padding-bottom: 250px;">
          	<h3><i class="fa fa-angle-right"></i> Users > Add User</h3>
          	
          	<!-- BASIC FORM ELELEMNTS -->
          	<div class="row mt">
          		<div class="col-lg-2">
              </div>
                <div class="col-lg-8">
                  <div class="form-panel">
                  	  <h4 class="mb"><i class="fa fa-angle-right"></i> Add User</h4>
                      <form class="form-horizontal style-form" method="post" action="<?php echo base_url();?>admin/adding_user">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Department Name</label>

                              <div class="col-sm-10">
                                <select name="dep_name" class="form-control">
                                  <option hidden="" selected="">Select department</option>
                                <?php foreach ($departments as $department) {?>
                                    <option value="<?php echo $department->Department_name; ?>"><?php echo $department->Department_name; ?></option>

                                  <?php
                                
                                } ?>
                              </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">User Name</label>
                              <div class="col-sm-10">
                                  <input type="text" name="Name" class="form-control">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Password</label>
                              <div class="col-sm-10">
                                  <input type="text" name="Password" class="form-control">
                              </div>
                          </div>

                          <div style="text-align: center;">
                          <input type="submit" name="sub" value="Add User" class="btn btn-success"/>
                          </div>
                      </form>
                  </div>
          		</div><!-- col-lg-12-->   
              </div>
              </section>   	
          	       <?php
include 'footer.php';

?> 