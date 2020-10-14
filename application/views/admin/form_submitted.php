<?php
$this->load->view('admin/header');

?>  
   <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          	 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line text-center"> Form submitted applications</h1>

                    </div>
                </div>

              <div class="row">
              	 <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          Form submitted applications
                        </div>
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
                                            <th>Hafiz</th>
                                            <th>Cell No</th>
                                            <th>Email Address</th>
                                            <th>Emergency Person Name</th>
                                            <th>Cell No (Father / Guardian)</th>
                                            <th>Percentage</th>
                                            <!-- <th>UPDATE/DELETE</th> -->
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
                                            <td><?php echo $bs_student->hafiz; ?></td>
                                            <td><?php echo $bs_student->cellno; ?></td>
                                            <td><?php echo $bs_student->email; ?></td>
                                            <td><?php echo $bs_student->ep_name; ?></td>
                                            <td><?php echo $bs_student->g_cellno; ?></td>
                                            <th><?php 
                                            $c_date=date('Y')-1;
                                            $c1_date=date('Y');
                                            $ded_years=$bs_student->inter_year;
                                            $dm=$c1_date-$ded_years;
                                            
                                            if ($bs_student->hafiz=='Yes' & $bs_student->inter_year=='$c_date') {
                                             $percentage=(($bs_student->inter_omarks+10)/$bs_student->inter_tmarks)*100;
                                            }
                                            elseif($bs_student->hafiz=='Yes' & $bs_student->inter_year!='$c_date'){
                                              
                                                    $percentage=(($bs_student->inter_omarks+10-$dm)/$bs_student->inter_tmarks)*100;

                                                  }
                                                  elseif($bs_student->hafiz!='Yes' & $bs_student->inter_year=='$c_date'){
                                                    $percentage=(($bs_student->inter_omarks)/$bs_student->inter_tmarks)*100;
                                                  }
                                                  elseif ($bs_student->hafiz!='Yes' & $bs_student->inter_year!='$c_date') {
                                                    $percentage=(($bs_student->inter_omarks-$dm)/$bs_student->inter_tmarks)*100;
                                                  }
                                                  else{
                                                    $percentage=(($bs_student->inter_omarks)/$bs_student->inter_tmarks)*100;
                                                  }
                                                  echo  round($percentage,2);
                                             ?></th>
                                            
                                            
                                       <!--      <td>
                                                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil" title="Update"></i></button>
                                      <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal" title="Delete"><i class="fa fa-trash-o "></i></button>
                                       <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editModal" title="view"><i class="fa fa-eye">
                                       </i>
                                     </button>
                                         <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#statusModal<?php echo $bs_student->ID; ?>" title="Status"><i class="fa fa-tasks">
                                       </i></button>
                                            </td>---->
                                    
                                           <!--  <div class="modal fade" id="statusModal<?php echo $bs_student->ID; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                              <option value="2">File Recieved</option>
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
 -->
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
                                            <td><?php echo $msc_student->hafiz; ?></td>
                                            <td><?php echo $msc_student->cellno; ?></td>
                                            <td><?php echo $msc_student->email; ?></td>
                                            <td><?php echo $msc_student->ep_name; ?></td>
                                            <td><?php echo $msc_student->g_cellno; ?></td>
                                            <th><?php echo round($msc_student->bachelor_percentage);
                                            // $c_date=date('Y')-1;
                                            // $c1_date=date('Y');
                                            // $ded_years=$msc_student->bachelor_year;
                                            // $dm=$c1_date-$ded_years;
                                            
                                            // if ($msc_student->hafiz=='Yes' & $msc_student->bachelor_year=='$c_date') {
                                            //  $percentage=(($msc_student->bachelor_omarks+10)/$msc_student->bachelor_tmarks)*100;
                                            // }
                                            // elseif($msc_student->hafiz=='Yes' & $msc_student->bachelor_year!='$c_date'){
                                              
                                            //         $percentage=(($msc_student->bachelor_omarks+10-$dm)/$msc_student->bachelor_tmarks)*100;

                                            //       }
                                            //       elseif($msc_student->hafiz!='Yes' & $msc_student->bachelor_year=='$c_date'){
                                            //         $percentage=(($msc_student->bachelor_omarks)/$msc_student->bachelor_tmarks)*100;
                                            //       }
                                            //       elseif ($msc_student->hafiz!='Yes' & $msc_student->bachelor_year!='$c_date') {
                                            //         $percentage=(($msc_student->bachelor_omarks-$dm)/$msc_student->bachelor_tmarks)*100;
                                            //       }
                                            //       else{
                                            //         $percentage=(($msc_student->bachelor_omarks)/$msc_student->bachelor_tmarks)*100;
                                            //       }
                                            //       echo  round($percentage,2);
                                             ?></th>
                                            
                                            
                                          <!--   <td>
                                                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil" title="Update"></i></button>
                                      <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal" title="Delete"><i class="fa fa-trash-o "></i></button>
                                       <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editModal" title="view"><i class="fa fa-eye">
                                       </i>
                                     </button>
                                         <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#statusModal<?php echo $bs_student->ID; ?>" title="Status"><i class="fa fa-tasks">
                                       </i></button>
                                            </td> -->
                                    <!-- modals -->
                                            <!--  <div class="modal fade" id="statusModal<?php echo $bs_student->ID; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                              <option value="2">File Recieved</option>
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
                        </div>   -->

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
                                            <td><?php echo $ms_student->hafiz; ?></td>
                                            <td><?php echo $ms_student->cellno; ?></td>
                                            <td><?php echo $ms_student->email; ?></td>
                                            <td><?php echo $ms_student->ep_name; ?></td>
                                            <td><?php echo $ms_student->g_cellno; ?></td>
                                            <td><?php echo round($ms_student->master_percentage); ?></td>
                                            
                                          <!--   <td>
                                                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil" title="Update"></i></button>
                                      <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal" title="Delete"><i class="fa fa-trash-o "></i></button>
                                       <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editModal" title="view"><i class="fa fa-eye"></i></button>
                                            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#statusModal<?php echo $ms_student->ID; ?>" title="Status"><i class="fa fa-tasks">
                                       </i></button>
                                            </td> -->
                                    <!-- modals -->
                                           <!--   <div class="modal fade" id="statusModal<?php echo $ms_student->ID; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Change Status</h4>
                              </div>
                              <div class="modal-body">
                                    <form method="post" action="<?php echo base_url();?>admin/update_ms_student_status">
                                        <input type="text" name="id" hidden="" value="<?php echo $ms_student->ID; ?>">
                                         <label>Current Status : <?php if ($ms_student->status==NULL) {
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

                                         ?></label>
                                        <div class="form-group">

                                            <label>Select Status</label>
                                            <select class="form-control" name="status">
                                              <option selected="" hidden="">Select Status</option>
                                              <option value="2">File Recieved</option>
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
                        </div>  --> 
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
                                    <?php } }?>
                                        <thead>
                                        <tr>
                                           <th>ID</th>

                                            <th>Student Name</th>
                                            <th>Father Name</th>
                                            <th>CNIC</th>
                                            <th>Department</th>
                                            <th>Program</th>
                                            <th>Hafiz</th>
                                            <th>Cell No</th>
                                            <th>Email Address</th>
                                            <th>Emergency Person Name</th>
                                            <th>Cell No (Father / Guardian)</th>
                                            <th>Percentage</th>

                                             <!-- <th>UPDATE/DELETE</th> -->
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