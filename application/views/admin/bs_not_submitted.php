<?php
$this->load->view('admin/header');

?>  
   <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          	 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line text-center">BS Registered Students</h1>

                    </div>
                </div>

              <div class="row">
              	 <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          All BS Applications &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <?php if ($this->session->userdata('active_admin_depart') != 'admin' || $this->session->userdata('active_admin_depart') != 'all') {?>
                          <span><a href="<?php echo base_url(); ?>admin/exportCSV" class="btn btn-success">Download File</a></span>
                          <?php }?>
                        </div>
                        
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>UPDATE/DELETE</th>
                                            <th>ID</th>
    <th>Challan</th>
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
                                    <tbody>
                                        <?php foreach ($bs as $bs_student) {
                                          ?>
                                        <tr class="odd gradeX">
  <td> <?php if ($this->session->userdata('active_admin_depart')=='admin') {?>
                                                <a href="<?php echo base_url();?>admin/bs_edit_form?id=<?php echo base64_encode($bs_student->ID) ?>"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil" title="Update"></i></button></a>
                                     <?php }?>
                                      <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal" title="Delete"><i class="fa fa-trash-o "></i></button>
                                       <?php if ($this->session->userdata('active_admin_depart')=='admin') {?>
                                      <a href="<?php echo base_url();?>admin/print_bs_file?id=<?php echo base64_encode($bs_student->ID) ?>">
                                       <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editModal" title="view PDF"><i class="fa fa-eye"></i></button></a>
                                     <?php }?>
                                         <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#statusModal<?php echo $bs_student->ID; ?>" title="Status"><i class="fa fa-tasks">
                                       </i></button>
                                            </td>
                                            <td><?php echo $bs_student->ID; ?></td>
                                            
                                            <td><?php echo $bs_student->challan; ?>
                                            </td><td><?php echo $bs_student->sname; ?></td>
                                            <td><?php echo $bs_student->fname; ?></td>
                                            <td><?php echo $bs_student->cnic; ?></td>
                                            <td><?php echo $bs_student->department; ?></td>
                                            <td><?php echo $bs_student->st_program; ?></td>
                                            <td><?php echo $bs_student->hafiz; ?></td>
                                            <td><?php echo $bs_student->cellno; ?></td>
                                            <td><?php echo $bs_student->dob; ?></td>
                                            <td><?php echo $bs_student->ep_name; ?></td>
                                            <td><?php echo $bs_student->g_cellno; ?></td>
                                            <td><?php echo $bs_student->inter_year; ?></td>
                                            <td <?php if(($bs_student->inter_omarks)>550){
                                                echo "style='background-color:red; color:white;'";
                                            } ?>
                                            ><?php if($bs_student->hafiz=='No'){
                                            echo $bs_student->inter_omarks; 
                                            }
                                            else{
                                               echo $bs_student->inter_omarks+20;  
                                            }
                                            ?></td>
                                            <td><?php echo round($bs_student->inter_percentage,2); ?></td>
                                            <?php 
                                            // $c_date=date('Y')-1;
                                            // $c1_date=date('Y');
                                            // $ded_years=$bs_student->inter_year;
                                            // $dm=$c1_date-$ded_years;
                                            
                                            // if ($bs_student->hafiz=='Yes' & $bs_student->inter_year=='$c_date') {
                                            //  $percentage=(($bs_student->inter_omarks+10)/$bs_student->inter_tmarks)*100;
                                            // }
                                            // elseif($bs_student->hafiz=='Yes' & $bs_student->inter_year!='$c_date'){
                                              
                                            //         $percentage=(($bs_student->inter_omarks+10-$dm)/$bs_student->inter_tmarks)*100;

                                            //       }
                                            //       elseif($bs_student->hafiz!='Yes' & $bs_student->inter_year=='$c_date'){
                                            //         $percentage=(($bs_student->inter_omarks)/$bs_student->inter_tmarks)*100;
                                            //       }
                                            //       elseif ($bs_student->hafiz!='Yes' & $bs_student->inter_year!='$c_date') {
                                            //         $percentage=(($bs_student->inter_omarks-$dm)/$bs_student->inter_tmarks)*100;
                                            //       }
                                            //       else{
                                            //         $percentage=(($bs_student->inter_omarks)/$bs_student->inter_tmarks)*100;
                                            //       }
                                                //   echo  round($percentage,2);
                                             ?>
                                             <td><?php if ($bs_student->status==NULL) {
                                          echo "Registered";
                                         }
                                         elseif ($bs_student->status==2) {
                                          echo "File submitted";
                                         }
                                         elseif ($bs_student->status==3) {
                                          echo "Verified";
                                         }
                                         else{
                                          echo "Short listed";
                                         }

                                         ?></td>
                                            
                                            
                                          
                                    <!-- modals -->
                                             <div class="modal fade" id="statusModal<?php echo $bs_student->ID; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Change Status</h4>
                              </div>
                              <div class="modal-body">
                                    <form method="post" action="<?php echo base_url();?>admin/update_bs_student_status">
                                        <input type="text" name="id" hidden="" value="<?php echo $bs_student->ID; ?>">
                                         <label>Current Status : <?php if ($bs_student->status==NULL) {
                                          echo "Registered";
                                         }
                                         elseif ($bs_student->status==2) {
                                          echo "File submitted";
                                         }
                                         elseif ($bs_student->status==3) {
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

                            <!--- <div class="modal fade" id="deleteModal<?php echo $department->ID; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
 <th>Challan</th>
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