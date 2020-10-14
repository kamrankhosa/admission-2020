<?php
include 'header.php';

?> 
<section id="main-content">
          <section class="wrapper" style="padding-bottom: 250px;">
          	
          	
          	<!-- BASIC FORM ELELEMNTS -->
          	<div class="row mt">
          		<div class="col-lg-2">
              </div>
                <div class="col-lg-8">
                  <div class="form-panel">
                  	  <h4 class="mb"><i class="fa fa-angle-right"></i> Today Record</h4>
                      <form class="form-horizontal style-form" method="post" action="<?php echo base_url();?>admin/today_record">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Department Name</label>
                              <div class="col-sm-10">
                                <select name="dep_name" class="form-control" required="">
                                  <option hidden="">Select department</option>
                                <?php foreach ($departments as $department) {?>
                                    <option value="<?php echo $department->Department_name; ?>"><?php echo $department->Department_name; ?></option>

                                  <?php
                                
                                } ?>
                              </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Program Name</label>
                              <div class="col-sm-10">
                                <select name="dep_program" class="form-control" required="">
                                  <option hidden="">Select Program</option>
                                  <option value="BS">BS</option>
                                  <option value="MSc">MSc</option>
                                  <option value="M.Phill">M.Phill</option>
                                
                              </select>
                              </div>
                          </div>

                          <div style="text-align: center;">
                          <input type="submit" name="sub" value="Get List" class="btn btn-success"/>
                          </div>
                      </form>
                  </div>
          		</div><!-- col-lg-12-->   
              </div>
              </section>   	
          	       <?php
include 'footer.php';

?> 