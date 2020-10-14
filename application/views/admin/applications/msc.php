<?php
$this->load->view('admin/header');


?>  
   <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          	 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line text-center">M.Sc Registered Students</h1>

                    </div>
                </div>

              <div class="row">
              	 <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          All M.Sc Applications &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <?php if ($this->session->userdata('active_admin_depart') != 'admin' || $this->session->userdata('active_admin_depart') != 'all') {?>
                          <span><a href="<?php echo base_url(); ?>admin/exportCSV_msc" class="btn btn-success">Download File</a></span>
                          <?php }?>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                             <th>UPDATE/DELETE</th>
                                            <th>ID</th>

                                            <th>Student Name</th>
                                            <th>Father Name</th>
                                            <th>CNIC</th>
                                            <th>Department</th>
                                            <th>Program</th>
                                            <th>Hafiz</th>
                                            <th>Cell No</th>
                                            <th>Date of Birth</th>
                                            <th>Emergency Person Name</th>
                                            <th>Cell No (Father / Guardian)</th>
                                             <th>Passing Year</th>
                                             <th>Obtained Marks</th>
                                             <th>Percentage</th>
                                            <th>Status</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($msc as $msc_student) {
                                          ?>
                                        <tr class="odd gradeX">
    <td>
        <?php if ($this->session->userdata('active_admin_depart')=='admin') {?>
                                               <a href="<?php echo base_url();?>admin/msc_edit_form?id=<?php echo base64_encode($msc_student->ID) ?>" target="_blank"> <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil" title="Update"></i></button></a>
                                      <?php }?>
                                      <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal" title="Delete"><i class="fa fa-trash-o "></i></button>
                                       <?php if ($this->session->userdata('active_admin_depart')=='admin') {?>
                                      <a href="<?php echo base_url();?>admin/print_msc_file?id=<?php echo base64_encode($msc_student->ID) ?>">
                                       <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editModal" title="view PDF"><i class="fa fa-eye"></i></button></a>
                                     <?php }?>
                                          <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#statusModal<?php echo $msc_student->ID; ?>" title="Status"><i class="fa fa-tasks">
                                       </i></button>
                                            </td>
                                            <td><?php echo $msc_student->ID; ?></td>
                                            <td><?php echo $msc_student->sname; ?></td>
                                            <td><?php echo $msc_student->fname; ?></td>
                                            <td><?php echo $msc_student->cnic; ?></td>
                                            <td><?php echo $msc_student->department; ?></td>
                                            <td><?php echo $msc_student->st_program; ?></td>
                                            <td><?php echo $msc_student->hafiz; ?></td>
                                            <td><?php echo $msc_student->cellno; ?></td>
                                            <td><?php echo $msc_student->dob; ?></td>
                                            <td><?php echo $msc_student->ep_name; ?></td>
                                            <td><?php echo $msc_student->g_cellno; ?></td>
                                            <td><?php echo $msc_student->bachelor_year; ?></td>
                                            <td><?php echo $msc_student->bachelor_omarks; ?></td>
                                            <td><?php echo round($msc_student->bachelor_percentage,2); ?></td>
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
                                            
                                        
                                    <!-- modals -->
                                             <div class="modal fade" id="statusModal<?php echo $msc_student->ID; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Change Status</h4>
                              </div>
                              <div class="modal-body">
                                    <form method="post" action="<?php echo base_url();?>admin/update_msc_student_status">
                                        <input type="text" name="id" hidden="" value="<?php echo $msc_student->ID; ?>">
                                         <label>Current Status : <?php if ($msc_student->status==NULL) {
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

                                         ?></label>
                                        <div class="form-group">

                                            <label>Select Status</label>
                                            <select class="form-control" name="status">
                                              <option selected="" hidden="">Select Status</option>
                                              <?php if ($this->session->userdata('active_admin_depart')=='admin') {?>
                                              <option value="2">File Recieved</option>
                                            <?php }?>
                                              <option value="3">Verified</option>
                                              <option value="4">Short listed</option>
                                            </select>
                                        </div>
                                        
                                        <div style="text-align: center;">
                                         <input type="submit" class="btn btn-primary" value="Save changes" name="update">
                                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                     </div>
                                    </form>
                               
                              </div>
                              <div class="modal-footer">
                               
                              </div>
                            </div>
                          </div>
                        </div>  
                                    <!-- modals -->
                                             <!-- <div class="modal fade" id="editModal<?php echo $department->ID; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Edit Program</h4>
                              </div>
                              <div class="modal-body">
                                    <form method="post" action="<?php echo base_url();?>admin/update_depart">
                                        <input type="text" name="id" hidden="" value="<?php echo $department->ID; ?>">
                                        <div class="form-group">
                                            <label>Department Name</label>
                                            <input type="text" name="department" class="form-control" value="<?php echo $department->Department_name; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Program Name</label>
                                            <input type="text" name="program" class="form-control" value="<?php echo $department->Program_name; ?>" required>
                                        </div>
                                        <div style="text-align: center;">
                                         <input type="submit" class="btn btn-primary" value="Save changes" name="update">
                                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                     </div>
                                    </form>
                               
                              </div>
                              <div class="modal-footer">
                               
                              </div>
                            </div>
                          </div>
                        </div>  

                             <div class="modal fade" id="deleteModal<?php echo $department->ID; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Delete Program</h4>
                              </div>
                              <div class="modal-body">
                                Do you want to delete <strong><?php echo $department->Program_name; ?> </strong>program from <strong><?php echo $department->Department_name; ?></strong>.
                                <br>
                             <p style="color: red;"> Are you sure?</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <a href="<?php echo base_url();?>admin/delete_depart?id=<?php echo $department->ID; ?>">
                                <button type="button" class="btn btn-primary">Delete</button>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div> -->


                                        </tr>
                                    <?php } ?>
                                        <thead>
                                        <tr>
                                             <th>UPDATE/DELETE</th>
                                           <th>ID</th>

                                            <th>Student Name</th>
                                            <th>Father Name</th>
                                            <th>CNIC</th>
                                            <th>Department</th>
                                            <th>Program</th>
                                            <th>Hafiz</th>
                                            <th>Cell No</th>
                                            <th>Date of birth</th>
                                            <th>Emergency Person Name</th>
                                            <th>Cell No (Father / Guardian)</th>
                                             <th>Passing Year</th>
                                             <th>Obtained Marks</th>
                                             <th>Percentage</th>
                                            <th>Status</th>
                                     
                                        </tr>

                                    </thead>
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
         <?php
$this->load->view('admin/footer');


?> 