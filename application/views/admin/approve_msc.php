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
                  	  <h4 class="mb text-center"> Update Status (M.Sc)</h4>
                      <form class="form-horizontal style-form" method="post" action="<?php echo base_url(); ?>admin/update_msc_student_status">
                        
                         <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Application ID</label>
                              <div class="col-sm-10">
                                  <input type="number" name="id" class="form-control" placeholder="Application ID" required="">
                                  <input type="number" name="status" hidden="true" value="2">
                              </div>
                          </div>
                            
                          </div>
                          
                          <div style="text-align: center;">
                    
                          <input type="submit" name="sub" value="Update Status" class="btn btn-success btn-lg"/>
                          </div>
                      </form>
                  </div>
          		</div><!-- col-lg-12-->   
              </div>
              </section>

          	 <?php
include 'footer.php';

?> 