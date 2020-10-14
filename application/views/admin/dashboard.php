<?php
include 'header.php';

?>  
   <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-9 main-chart">
                  
                  	<div class="row mtbox">
                      <div class="col-md-2 col-sm-2 box0 col-md-offset-1 ">
                        <div class="box1">
                  <span class="li_news"></span>
                  <h3> BS <?php echo $bs_apps;?></h3>
                        </div>
                  <p>Total unique <?php echo $bs_apps1;?> applications are submitted till now for BS program</p>
                      </div>

                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_news"></span>
					  			<h3>MSC <?php echo $msc_apps;?></h3>
                  			</div>
					  			<p>Total unique <?php echo $msc_apps1;?> applications are submitted till now for M.sc program</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_news"></span>
					  			<h3>MS <?php echo $ms_apps;?></h3>
                  			</div>
					  			<p>Total unique <?php echo $ms_apps1;?> applications are submitted till now for MS program</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_stack"></span>
					  			<h3>Submitted <?php echo $total_apps_submitted;?></h3>
                  			</div>
					  			<p>Total <?php echo $total_apps_submitted;?> form submitted yet.</p>
                  		</div>
                  		
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_data"></span>
					  			<h3>Not Submitted <?php echo $total_apps_not_submitted;?></h3>
                  			</div>
					  			<p>Total <?php echo $total_apps_not_submitted;?> form not submitted yet.</p>
                  		</div>
                  	
                  	</div><!-- /row mt -->	
                  
                      
                      <div class="row mt">
                      <!-- SERVER STATUS PANELS -->
                      	<div class="col-md-8 col-sm-10 mb col-md-offset-2">
                      		<div class="white-panel pn donut-chart" style="height: 400px;">
                      			<div class="white-header">
						  			<h5>Applications </h5>
                      			</div>
								<div class="row">
									<div class="col-sm-6 col-xs-6 goleft">
										<p>
                     <span style="color: red;"> BS Applications</span>
                     <br>
                     <span style="color: gray;"> M.Sc Applications</span>
                     <br>

                     <span style="color: #68dff0;">MS Applications</span>
                      
                    </p>
									</div>
	                      		</div>
								<canvas id="serverstatus01" height="200" width="200"></canvas>
								<script>
									var doughnutData = [
											{
												value: <?php echo $ms_apps;?>,
												color:"#68dff0"
                        
											},
											{
												value : <?php echo $msc_apps;?>,
												color : "gray"
											},
                      {
                        value : <?php echo $bs_apps;?>,
                        color : "red"
                      }
										];
										var myDoughnut = new Chart(document.getElementById("serverstatus01").getContext("2d")).Doughnut(doughnutData);
								</script>
	                      	</div>
                      	</div><!-- /col-md-4-->
                      	

                      	<!-- <div class="col-md-4 col-sm-4 mb">
                      		<div class="white-panel pn">
                      			<div class="white-header">
						  			<h5>TOP PRODUCT</h5>
                      			</div>
								<div class="row">
									<div class="col-sm-6 col-xs-6 goleft">
										<p><i class="fa fa-heart"></i> 122</p>
									</div>
									<div class="col-sm-6 col-xs-6"></div>
	                      		</div>
	                      		<div class="centered">
										<img src="<?php echo base_url();?>assets/theme/img/product.png" width="120">
	                      		</div>
                      		</div>
                      	</div> --><!-- /col-md-4 -->
                      	
						<!-- <div class="col-md-4 mb">
							<div class="white-panel pn">
								<div class="white-header">
									<h5>TOP USER</h5>
								</div>
								<p><img src="<?php echo base_url();?>assets/theme/img/ui-zac.jpg" class="img-circle" width="80"></p>
								<p><b>Zac Snider</b></p>
								<div class="row">
									<div class="col-md-6">
										<p class="small mt">MEMBER SINCE</p>
										<p>2012</p>
									</div>
									<div class="col-md-6">
										<p class="small mt">TOTAL SPEND</p>
										<p>$ 47,60</p>
									</div>
								</div>
							</div>
						</div> --><!-- /col-md-4 -->
                      	

                    </div><!-- /row -->
                    
                    				
					
					
					
					
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                   
                  
                  <div class="col-lg-3 ds">
                    <!--COMPLETED ACTIONS DONUTS CHART-->
						

                       <!-- USERS ONLINE SECTION -->
						<h3>TEAM MEMBERS <sub style="color: green;">(online)</sub></h3>
                      <!-- First Member -->
                      <?php foreach ($active_members as $active_member) {
                       ?>
                      <div class="desc">
                      	<div class="thumb">
                      		<img class="img-circle" src="<?php echo base_url();?>assets/theme/img/ui-divya.jpg" width="35px" height="35px" align="">
                      	</div>
                      	<div class="details">
                      		<p><a href="#"><?php echo $active_member->username;?></a><br/>
                      		   <muted><?php echo $active_member->Department;?></muted>
                      		</p>
                      	</div>
                      </div>

                    <?php } ?>
                      
                        <!-- CALENDAR-->
                        <div id="calendar" class="mb">
                            <div class="panel green-panel no-margin">
                                <div class="panel-body">
                                    <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                                        <div class="arrow"></div>
                                        <h3 class="popover-title" style="disadding: none;"></h3>
                                        <div id="date-popover-content" class="popover-content"></div>
                                    </div>
                                    <div id="my-calendar"></div>
                                </div>
                            </div>
                        </div><!-- / calendar -->
                      
                  </div><!-- /col-lg-3 -->
              </div>
          </section>
      </section>

      <!--main content end-->
      <?php
include 'footer.php';

?>  

