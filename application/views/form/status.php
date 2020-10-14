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
      					<h2 style="text-align: center;">Your application status</h2>
	      				
                                     <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>

                                            <th>Student Name</th>
                                            <th>Father Name</th>
                                            <th>CNIC</th>
                                            <th>Department</th>
                                            <th>Program</th>
                                            <th>Percentage</th>
                                            <th>Status</th>
                                            <?php if(!empty($this->session->userdata('active_admin')) && $this->session->userdata('active_admin_depart')=='admin') {?>
                                            <th>Download pdf</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($bs)){foreach ($bs as $bs_student) {
                                          ?>
                                        <tr class="odd gradeX">

                                            <td><?php echo 'BS'.$bs_student->ID; ?></td>
                                            <td><?php echo $bs_student->sname; ?></td>
                                            <td><?php echo $bs_student->fname; ?></td>
                                            <td><?php echo $bs_student->cnic; ?></td>
                                            <td><?php echo $bs_student->department; ?></td>
                                            <td><?php echo $bs_student->st_program; ?></td>
                                            <td><?php echo round($bs_student->inter_percentage); ?></td>
                                            <td><?php if ($bs_student->status==NULL) {
                                          echo "Registered";
                                         }
                                         elseif ($bs_student->status=='2') {
                                          echo "File submitted";
                                         }
                                         elseif ($bs_student->status=='3') {
                                          echo "Verified";
                                         }
                                         else{
                                          echo "Short listed";
                                         }

                                         ?></td>
                                            
                                        <td> <?php if(!empty($this->session->userdata('active_admin')) && $this->session->userdata('active_admin_depart')=='admin') {?>
                                            <a href="<?php echo base_url();?>admin/print_bs_file?id=<?php echo base64_encode($bs_student->ID) ?>" target="_blank">
                                       <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editModal" title="view PDF"><i class="fa fa-eye"></i></button></a>
                                            <?php }?></td> 
                                      
                                        </tr>
                                    <?php } }?>
                                      <?php if (!empty($msc)){foreach ($msc as $msc_student) {
                                          ?>
                                        <tr class="odd gradeX">

                                            <td><?php echo 'M.Sc'.$msc_student->ID; ?></td>
                                            <td><?php echo $msc_student->sname; ?></td>
                                            <td><?php echo $msc_student->fname; ?></td>
                                            <td><?php echo $msc_student->cnic; ?></td>
                                            <td><?php echo $msc_student->department; ?></td>
                                            <td><?php echo $msc_student->st_program; ?></td>
                                            <td><?php echo round($msc_student->bachelor_percentage); ?></td>
                                            <td><?php if ($msc_student->status==NULL) {
                                          echo "Registered";
                                         }
                                         elseif ($msc_student->status==2) {
                                          echo "File submitted";
                                         }
                                         elseif ($msc_student->status==3) {
                                          echo "Verified";
                                         }
                                         else{
                                          echo "Short listed";
                                         }

                                         ?></td>
                                           
                                            <td> <?php if(!empty($this->session->userdata('active_admin')) && $this->session->userdata('active_admin_depart')=='admin') {?>
                                            <a href="<?php echo base_url();?>admin/print_msc_file?id=<?php echo base64_encode($msc_student->ID) ?>" target="_blank">
                                       <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editModal" title="view PDF"><i class="fa fa-eye"></i></button></a>
                                            <?php }?></td> 

                                        </tr>
                                    <?php } }?>
                                    <?php if(!empty($ms)){foreach ($ms as $ms_student) {
                                          ?>
                                        <tr class="odd gradeX">

                                            <td><?php echo 'MS'.$ms_student->ID; ?></td>
                                            <td><?php echo $ms_student->sname; ?></td>
                                            <td><?php echo $ms_student->fname; ?></td>
                                            <td><?php echo $ms_student->cnic; ?></td>
                                            <td><?php echo $ms_student->department; ?></td>
                                            <td><?php echo $ms_student->st_program; ?></td>
                                            <td><?php if(!empty($ms_student->master_percentage)){
                                            echo round($ms_student->master_percentage); 
                                                
                                            }
                                            else{
                                               echo round($ms_student->bachelor_percentage); 
                                            }
                                            ?></td>
                                            <td><?php if ($ms_student->status==NULL) {
                                          echo "Registered";
                                         }
                                         elseif ($ms_student->status==2) {
                                          echo "File submitted";
                                         }
                                         elseif ($ms_student->status==3) {
                                          echo "Verified";
                                         }
                                         else{
                                          echo "Short listed";
                                         }

                                         ?></td>
                                           
                                         <td> <?php if(!empty($this->session->userdata('active_admin')) && $this->session->userdata('active_admin_depart')=='admin') {?>
                                            <a href="<?php echo base_url();?>admin/print_ms_file?id=<?php echo base64_encode($ms_student->ID) ?>" target="_blank">
                                       <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editModal" title="view PDF"><i class="fa fa-eye"></i></button></a>
                                            <?php }?></td> 

                                        </tr>
                                    <?php } }?>
                                        
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>

	      				<div style="text-align: right; padding-top: 20px;">
	      					<a href="<?php echo base_url();?>" class="btn btn-primary"><i class="fa fa-angle-right"></i> Return to the form  </a>
	      				</div>
                     <?php if (empty($bs) &&empty($msc) &&empty($ms)) {
                       $this->session->set_flashdata('error','Record not found');
                     } ?>
	      				
						
						
      				</div><!--/showback -->
               </div>
            </div>
         </section>
      </section>

   <?php $this->load->view('form/footer')?>
      				