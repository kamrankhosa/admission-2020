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
                  	  <h4 class="mb text-center"> Genrate Merit List</h4>
                      <form class="form-horizontal style-form" method="post" action="<?php echo base_url(); ?>admin/genrate_merit_list">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Program Name</label>
                              <div class="col-sm-10">
                                  <select class="form-control" name="program" required="">
                                    <option selected="" hidden="">Select a Program </option>
                                     <option value="BS">BS</option>
                                     <option value="M.Sc">M.Sc</option>
                                     <option value="MS">MS</option>
                                     <option value="B.Ed">B.Ed</option>
                                  </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Department Name</label>
                              <div class="col-sm-10">
                                  <select class="form-control" name="department" required="">
                                     <option selected="" hidden="">Select a Department</option>
                                     <?php foreach ($departments as $department) {
                                     ?>
                                     <option value="<?php echo $department->Department_name; ?>"><?php echo $department->Department_name; ?></option>

                                   <?php } ?>
                                     
                                  </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Program Time</label>
                              <div class="col-sm-10">
                                  <select class="form-control" name="session" required="">
                                    <option selected="" hidden="">Select a session</option>
                                    <option value="Morning">Morning</option>
                                    <option value="Evening">Evening</option>
                                    <option value="Both">Both</option>
                                  </select>
                              </div>
                          </div>
                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">No. of posts</label>
                              <div class="col-sm-10">
                                  <input type="number" name="posts" class="form-control" placeholder="No. of posts" required="" min="1">
                              </div>
                          </div>
                          <div style="text-align: center;">
                    
                          <input type="submit" name="sub" value="GENRATE" class="btn btn-success btn-lg"/>
                          </div>
                      </form>
                  </div>
          		</div><!-- col-lg-12-->   
              </div>
              </section>

          	 <?php
include 'footer.php';

?> 