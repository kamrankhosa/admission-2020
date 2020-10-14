   <?php $this->load->view('form/header')?>
   <section id="main-content">
          <section class="wrapper">
      		<div class="row mt">
            <br>
            <br>
            <br>
            <br><br>
            <br>
            
      			<div class="col-lg-9 col-md-9 col-sm-12" style="bottom: 30px;">
      				<div class="showback">
                <h2 style="text-align: center;">All Merit Lists</h2>
      					<h2 style="text-align: center;">Ghazi University DG Khan 2020</h2>
	      				
                                     <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example">
                                    <thead>
                                      <?php $n=1; ?>
                                        <tr>
                                            <th>#</th>

                                            <th>Department Name</th>
                                            <th>Program</th>
                                            <th>Session</th>
                                            <th>Announcement Date</th>
                                            <th>Download List</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                        <tr class="odd gradeX">
                                            <td><?php echo $n++;?></td>
                                            <td>CS & IT</td>
                                            <td>BS</td>
                                            <td>Morning</td>
                                            <td><?php echo date('d-m-Y') ?></td>
                                            <td><a href=""><i class="fa fa-download"></i></a></td>
                                          </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>

	      				
						
						
      				</div><!--/showback -->
               </div>
            </div>
         </section>
      </section>

   <?php $this->load->view('form/footer')?>
      				