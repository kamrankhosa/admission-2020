<?php
include 'header.php';

?>  
   <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          	 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line text-center">Users</h1>

                    </div>
                </div>

              <div class="row">
              	 <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          All Users accounts
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>UserName/Email</th>
                                            <th>Department Name</th>
                                            <th>Activity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $user) {
                                          ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $user->username; ?></td>
                                            <td><?php echo $user->Department; ?></td>
                                          <td>
                                      <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal<?php echo $user->ID; ?>"><i class="fa fa-trash-o "></i></button>
                                  </td>
                                    <!-- modals -->
                                             

                             <div class="modal fade" id="deleteModal<?php echo $user->ID; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Delete User</h4>
                              </div>
                              <div class="modal-body">
                                Do you want to delete <strong><?php echo $user->username; ?> </strong>user.
                                <br>
                             <p style="color: red;"> Are you sure?</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <a href="<?php echo base_url();?>admin/delete_user?id=<?php echo $user->ID; ?>">
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
                                            <th>UserName/Email</th>
                                            <th>Department Name</th>
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