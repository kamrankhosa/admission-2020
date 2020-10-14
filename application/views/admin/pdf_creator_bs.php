   <?php $this->load->view('form/header')?>
   <section id="main-content">
          <section class="wrapper">
      		<div class="row mt">
            <br>
            <br>
            <br>
            <br><br>
            <br>
            <br>
            <br>
            <br>
            <br>
      			<div class="col-lg-9 col-md-9 col-sm-12" style="bottom: 30px;">
      				<div class="showback">
      					<h4><i class="fa fa-angle-right"></i> Check your application status</h4>
	      				
                                    <div class="row" style="text-align: center;">
                                        <div class="col-md-3">
                                        </div>
                                       <div class="col-md-6">
                                          <form method="post" action="<?php echo base_url();?>admin/get_pdf_for_bs">
                                             <label>Enter application Number of BS</label>
                                             
                                             <div class="form-group">
                                                <input type="number" name="app_no" class="form-control" pattern="[0-9]" placeholder="xxxx">
                                             </div>
                                             <div class="form-group">
                                                <input type="submit" name="search" class="btn btn-danger" value="Search">
                                             </div>

                                          </form>
                                       </div>
                                    </div>

	      				<div style="text-align: right; padding-top: 20px;">
	      					<a href="<?php echo base_url();?>" class="btn btn-primary"><i class="fa fa-angle-right"></i> Return to the form  </a>
	      				</div>
	      				
						
						
      				</div><!--/showback -->
               </div>
            </div>
         </section>
      </section>

   <?php $this->load->view('form/footer')?>
      				