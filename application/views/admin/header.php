<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>GUDGK - Dashboard </title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/theme/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo base_url();?>assets/theme/font-awesome/css/font-awesome.csres" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/theme/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/theme/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/theme/lineicons/style.css">    
      <script src="<?php echo base_url();?>assets/theme/js/chart-master/Chart.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/theme/js/gritter/css/jquery.gritter.css')?>" />
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>assets/theme/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/theme/css/style-responsive.css" rel="stylesheet">

    <script src="<?php echo base_url();?>assets/theme/js/chart-master/Chart.js"></script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
    
      <header class="header bg-primary bg-black">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="<?php echo base_url(); ?>admin" class="logo"><b>GUDGK </b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown pull-right">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-user"></i>
                            <!-- <span class="badge bg-theme">4</span> -->
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
          <section class="wrapper">
            <div class="row">
              <div class="col-lg-12">
              <!-- WHITE PANEL - TOP USER -->
              <div class="white-panel">
                <div class="white-header">
                  <h5><?php echo $this->session->userdata('active_admin_depart');?></h5>
                </div>
                <p><img src="<?php echo base_url();?>assets/profiles/<?php if(!empty($this->session->userdata('active_admin_profile'))){
                  echo $this->session->userdata('active_admin_profile');
                }else{
                  echo 'avatar_male.png';
                } ?>" class="img-circle" width="50"></p>
                <p><b><?php echo $this->session->userdata('active_admin_username');?></b></p>
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
            </div><!-- /col-md-4 -->
          </div>
        </section>
                        </ul>
                    </li>
                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#" style="color: red;">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-theme"><i class="fa fa-bell"></i></span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">Your activity is here</p>
                            </li>
                            <?php foreach ($activity as $active) {?>
                             
                            <li>
                                <a href="index.html#">
                                    <span class="photo"><img alt="avatar" src="<?php echo base_url();?>assets/theme/img/ui-zac.jpg"></span>
                                    <span class="subject">
                                    <span class="from"><?php echo $active->username; ?></span>
                                    <span class="time"><?php echo date('Y M d',strtotime($active->activity_time)); ?></span>
                                    </span>
                                    <span class="message">
                                       <?php echo 
                                       substr($active->activity_details, 0,30); ?>
                                    </span>
                                </a>
                            </li>
                            .
                            <?php } ?>
                           
                    <!-- inbox dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="<?php echo base_url();?>admin/logout">Logout</a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->
  
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="profile.html"><img src="<?php echo base_url();?>assets/profiles/<?php if(!empty($this->session->userdata('active_admin_profile'))){
                  echo $this->session->userdata('active_admin_profile');
                }else{
                  echo 'avatar_male.png';
                } ?>" class="img-circle" width="60"></a></p>
              	  <h5 class="centered"><?php echo $this->session->userdata("active_admin_username")?></h5>
              	  	
                  <li class="mt">
                      <a class="<?php if($this->router->class=='admin' && $this->router->method=='dashboard'){ echo 'active';} ?>" href="<?php echo base_url();?>/admin/dashboard">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <!--<li class="sub-menu <?php if($this->router->class=='admin' && $this->router->method=='department'){ echo 'active';} ?>">-->
                  <!--    <a href="javascript:;" >-->
                  <!--        <i class="fa fa-desktop"></i>-->
                  <!--        <span>Departments</span>-->
                  <!--    </a>-->
                  <!--    <ul class="sub">-->
                  <!--        <li><a class="<?php if($this->router->class=='admin' && $this->router->method=='department'){ echo 'active';} ?>" href="<?php echo base_url();?>/admin/department">Department and Programes</a></li>-->
                  <!--        <li><a class="<?php if($this->router->class=='admin' && $this->router->method=='add_department'){ echo 'active';} ?>" href="<?php echo base_url();?>/admin/add_department">Add Depratment Program</a></li>-->
                          <!-- <li><a  href="panels.html">Panels</a></li> -->
                  <!--    </ul>-->
                  <!--</li>-->
                  <?php if ($this->session->userdata('active_admin_depart')=='admin') {?>
                  <li class="sub-menu <?php if($this->router->class=='admin' && $this->router->method=='department'){ echo 'active';} ?>">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>User Accounts</span>
                      </a>
                      <ul class="sub">
                          <li><a class="<?php if($this->router->class=='admin' && $this->router->method=='department'){ echo 'active';} ?>" href="<?php echo base_url();?>/admin/all_users">All user Accounts</a></li>
                          <li><a class="<?php if($this->router->class=='admin' && $this->router->method=='add_user'){ echo 'active';} ?>" href="<?php echo base_url();?>/admin/add_user">Add User Account</a></li>
                          <!-- <li><a  href="panels.html">Panels</a></li> -->
                      </ul>
                  </li>
                <?php  } ?>
                 

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-list"></i>
                          <span>Registerd Applications</span>
                      </a>
                      <ul class="sub">
                          <li><a class="<?php if($this->router->class=='admin' && $this->router->method=='bs_students'){ echo 'active';} ?>" href="<?php echo base_url();?>/admin/bs_students">BS</a></li>
                          <li><a class="<?php if($this->router->class=='admin' && $this->router->method=='bs_students'){ echo 'active';} ?>" href="<?php echo base_url();?>/admin/msc_students">MSC</a></li>
                          <li><a class="<?php if($this->router->class=='admin' && $this->router->method=='adp_ads_submitted'){ echo 'active';} ?>" href="<?php echo base_url();?>/admin/adp_ads_submitted">ADP & ADS Students</a></li>
                          <li><a class="<?php if($this->router->class=='admin' && $this->router->method=='ms_students'){ echo 'active';} ?>" href="<?php echo base_url();?>/admin/ms_students">MS</a></li>
                           <?php if ($this->session->userdata('active_admin_depart')=='admin') {?>
                           <li><a class="<?php if($this->router->class=='admin' && $this->router->method=='form_submitted'){ echo 'active';} ?>" href="<?php echo base_url();?>/admin/form_submitted">Form Submitted</a></li>
                            <li><a class="<?php if($this->router->class=='admin' && $this->router->method=='form_not_submitted'){ echo 'active';} ?>" href="<?php echo base_url();?>/admin/form_not_submitted">Form not Submitted</a></li>
                         
                           
                          <?php }?>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-list"></i>
                          <span>Not Submitted Applications</span>
                      </a>
                      <ul class="sub">
                          <li><a class="<?php if($this->router->class=='admin' && $this->router->method=='unsub_apps_bs'){ echo 'active';} ?>" href="<?php echo base_url();?>/admin/unsub_apps_bs">BS</a></li>
                          <li><a class="<?php if($this->router->class=='admin' && $this->router->method=='unsub_apps_msc'){ echo 'active';} ?>" href="<?php echo base_url();?>/admin/unsub_apps_msc">MSC</a></li>
                          <li><a class="<?php if($this->router->class=='admin' && $this->router->method=='unsub_apps_ms'){ echo 'active';} ?>" href="<?php echo base_url();?>/admin/unsub_apps_ms">MS</a></li>
                      </ul>
                  </li>
                 <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Nominees of (BS)</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="<?php echo base_url();?>admin/hafiz_quran_bs">Hafiz-e-Quran</a></li>
                          <li><a  href="<?php echo base_url();?>admin/sports_bs">Sports</a></li>
                          <li><a  href="<?php echo base_url();?>admin/disabled_bs">Disabled</a></li>
                          <li><a  href="<?php echo base_url();?>admin/quota_bs">Quota</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Nominees of (M.Sc)</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="<?php echo base_url();?>admin/hafiz_quran_msc">Hafiz-e-Quran</a></li>
                          <li><a  href="<?php echo base_url();?>admin/sports_msc">Sports</a></li>
                          <li><a  href="<?php echo base_url();?>admin/disabled_msc">Disabled</a></li>
                          <li><a  href="<?php echo base_url();?>admin/quota_msc">Quota</a></li>
                      </ul>
                  </li>
                   <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Nominees of (MS)</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="<?php echo base_url();?>admin/hafiz_quran_ms">Hafiz-e-Quran</a></li>
                          <li><a  href="<?php echo base_url();?>admin/sports_ms">Sports</a></li>
                          <li><a  href="<?php echo base_url();?>admin/disabled_ms">Disabled</a></li>
                          <li><a  href="<?php echo base_url();?>admin/quota_ms">Quota</a></li>
                      </ul>
                  </li>
                     <?php if ($this->session->userdata('active_admin_depart')=='admin') {?>
                <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-tasks"></i>
                          <span>Change Status</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="<?php echo base_url();?>admin/change_status_for_bs">BS</a></li>
                          <li><a  href="<?php echo base_url();?>admin/change_status_for_msc">M.Sc</a></li>
                          <li><a  href="<?php echo base_url();?>admin/change_status_for_ms">MS</a></li>
                      </ul>
                  </li>
                  <?php }?>
                     <?php if ($this->session->userdata('active_admin_depart')=='admin') {?>
                <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-tasks"></i>
                          <span>Update Record</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="<?php echo base_url();?>admin/update_record_for_bs">BS</a></li>
                          <li><a  href="<?php echo base_url();?>admin/update_record_for_msc">M.Sc</a></li>
                          <li><a  href="<?php echo base_url();?>admin/update_record_for_ms">MS</a></li>
                      </ul>
                  </li>
                  <?php }?>

                   <?php if ($this->session->userdata('active_admin_depart')=='admin') {?>
                <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-tasks"></i>
                          <span>Get PDF</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="<?php echo base_url();?>admin/get_pdf_for_bs" target="_blank">BS</a></li>
                          <li><a  href="<?php echo base_url();?>admin/get_pdf_for_msc" target="_blank">M.Sc</a></li>
                          <li><a  href="<?php echo base_url();?>admin/get_pdf_for_ms" target="_blank">MS</a></li>
                      </ul>
                  </li>
                  <?php }?>

                    <?php if ($this->session->userdata('active_admin_depart')=='admin') {?>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>Merit Lists</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="blank.html">All Department Lists</a></li>
                          <li><a  href="<?php echo base_url();?>/admin/genrate_list">Genrate List</a></li>
                          <!-- <li><a  href="lock_screen.html">Lock Screen</a></li> -->
                      </ul>
                  </li>
               
                  <?php } ?>
                  <!--<li class="sub-menu">-->
                  <!--    <a href="javascript:;" >-->
                  <!--        <i class="fa fa-cogs"></i>-->
                  <!--        <span>Settings</span>-->
                  <!--    </a>-->
                  <!--    <ul class="sub">-->
                  <!--        <li><a  href="<?php echo base_url();?>admin/account">Account Setting</a></li>-->
                  <!--    </ul>-->
                  <!--</li>-->
                  <?php if ($this->session->userdata('active_admin_depart')=='admin') {?>
                  <li>
                      <a class="<?php if($this->router->class=='admin' && $this->router->method=='today_list'){ echo 'active';} ?>" href="<?php echo base_url();?>admin/today_list">
                          <i class="fa fa-tasks"></i>
                          <span>Today Forms</span>
                      </a>
                  </li>
                <?php }?>
                 <?php if ($this->session->userdata('active_admin_depart')=='admin') {?>
                <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-tasks"></i>
                          <span>Challan Forms</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="<?php echo base_url();?>admin/today_challans" target="_blank">Today challans</a></li>
                          <li><a  href="<?php echo base_url();?>admin/all_challans" target="_blank">ALL challans</a></li>
                      </ul>
                  </li>
                  <?php }?>
                  <!-- <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-th"></i>
                          <span>Data Tables</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="basic_table.html">Basic Table</a></li>
                          <li><a  href="responsive_table.html">Responsive Table</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class=" fa fa-bar-chart-o"></i>
                          <span>Charts</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="morris.html">Morris</a></li>
                          <li><a  href="chartjs.html">Chartjs</a></li>
                      </ul>
                  </li> -->

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->