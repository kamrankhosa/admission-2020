<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>GUDGK ADMIN LOGIN</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/theme/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo base_url();?>assets/theme/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>assets/theme/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/theme/css/style-responsive.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/theme/js/gritter/css/jquery.gritter.css')?>" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  

	  <div id="login-page">
	  	<div class="container">
	  	
		      <form class="form-login" action="<?php echo base_url();?>admin/login" method="post">
		        <h2 class="form-login-heading">sign in now</h2>
		        <div class="login-wrap">
		            <input type="text" class="form-control" placeholder="User ID / Email" autofocus name="username" required="">
		            <br>
		            <input type="password" class="form-control" placeholder="Password" name="password" required="">
		            <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="login.html#myModal"> Forgot Password?</a>
		
		                </span>
		            </label>
		            <input class="btn btn-theme btn-block" name="login" type="submit" value="SIGN IN">
		            <hr>
		            
		          <!--   <div class="login-social-link centered">
		            <p>or you can sign in via your social network</p>
		                <button class="btn btn-facebook" type="submit"><i class="fa fa-facebook"></i> Facebook</button>
		                <button class="btn btn-twitter" type="submit"><i class="fa fa-twitter"></i> Twitter</button>
		            </div> -->
		            <!-- <div class="registration">
		                Don't have an account yet?<br/>
		                <a class="" href="#">
		                    Create an account
		                </a>
		            </div> -->
		
		        </div>
		
		       
		          <!-- modal -->
		
		      </form>	  	
	  	   <!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Forgot Password ?</h4>
		                      </div>
		                      <form method="post" action="<?php echo base_url(); ?>admin/forget_password">
		                      <div class="modal-body">
		                          <p>Enter your e-mail address below to reset your password.</p>
		                          <input type="email" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix" required="">
		
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <input class="btn btn-theme" type="submit" value="Submit" name="forget">
		                      </div>
		                  </form>
		                  </div>
		              </div>
		          </div>
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url();?>assets/theme/js/jquery.js"></script>
    <script src="<?php echo base_url();?>assets/theme/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="<?php echo base_url();?>assets/theme/js/jquery.backstretch.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/theme/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/theme/js/gritter-conf.js"></script>  
    <script>
        $.backstretch("<?php echo base_url();?>assets/theme/img/login-bg.jpg", {speed: 500});
    </script>
<?php if(!empty($this->session->flashdata('error'))){
	?>
<script>
	
	    $.gritter.add({
            // (string | mandatory) the heading of the notification
                            title: 'This is an alert Notice!',
                            // (string | mandatory) the text inside the notification
                            text: '<?php echo $this->session->flashdata('error'); ?><a href="#" style="color:#FFD777">GUDGK</a>.',
                            // (string | optional) the image to display on the left
                            image: '<?php echo base_url();?>assets/theme/img/ui-sam.jpg',
                            // (bool | optional) if you want it to fade out on its own or just sit there
                            sticky: false,
                            // (int | optional) the time you want it to be alive for before fading out
                            time: ''
                        });
</script>

	<?php
} ?>

  </body>
</html>
