<?php
include 'header.php';

?>  
   <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          	 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line text-center">Departments</h1>

                    </div>
                </div>

              <div class="row">
              	 <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Departments and programes
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Department Name</th>
                                            <th>Program Name</th>
                                            <th>Activity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($departments as $department) {
                                          ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $department->Department_name; ?></td>
                                            <td><?php echo $department->Program_name; ?></td>
                                          <td>
                                     <!--  <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button> -->
                                      <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editModal<?php echo $department->ID; ?>"><i class="fa fa-pencil"></i></button>
                                      <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal<?php echo $department->ID; ?>"><i class="fa fa-trash-o "></i></button>
                                  </td>
                                    <!-- modals -->
                                             <div class="modal fade" id="editModal<?php echo $department->ID; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        </div>


                                        </tr>
                                    <?php } ?>
                                        <thead>
                                        <tr>
                                            <th>Department Name</th>
                                            <th>Program Name</th>
                                            <th>Activity</th>
                                            
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
include 'footer.php';

?> 