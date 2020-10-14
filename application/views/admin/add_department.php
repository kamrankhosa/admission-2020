<?php
include 'header.php';

?> 
<section id="main-content">
          <section class="wrapper" style="padding-bottom: 250px;">
          	<h3><i class="fa fa-angle-right"></i> Departments > Add Department</h3>
          	
          	<!-- BASIC FORM ELELEMNTS -->
          	<div class="row mt">
          		<div class="col-lg-2">
              </div>
                <div class="col-lg-8">
                  <div class="form-panel">
                  	  <h4 class="mb"><i class="fa fa-angle-right"></i> Add Department</h4>
                      <form class="form-horizontal style-form" method="post" action="<?php echo base_url();?>admin/add_depart">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Department Name</label>
                              <div class="col-sm-10">
                                  <input type="text" name="dep_name" class="form-control">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Program Name</label>
                              <div class="col-sm-10">
                                  <input type="text" name="prg_name" class="form-control">
                              </div>
                          </div>
                          <div style="text-align: center;">
                          <input type="submit" name="sub" value="Add Department" class="btn btn-success"/>
                          </div>
                      </form>
                  </div>
          		</div><!-- col-lg-12-->   
              </div>
              </section>   	
          	       <?php
include 'footer.php';

?> 