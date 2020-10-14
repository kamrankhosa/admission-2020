<!--main content end-->
      <!--footer start-->
      <footer class="site-footer bg-primary">
          <div class="text-center">
              &copy; &nbsp; GUDGK &nbsp; 2020
              <a href="#top" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

<!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url();?>assets/theme/js/jquery.js"></script>
    <script src="<?php echo base_url();?>assets/theme/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo base_url();?>assets/theme/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo base_url();?>assets/theme/js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo base_url();?>assets/theme/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="<?php echo base_url();?>assets/theme/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="<?php echo base_url();?>assets/theme/js/jquery-ui-1.9.2.custom.min.js"></script>

	<!--custom switch-->
	<script src="<?php echo base_url();?>assets/theme/js/bootstrap-switch.js"></script>
	
	<!--custom tagsinput-->
	<script src="<?php echo base_url();?>assets/theme/js/jquery.tagsinput.js"></script>
	
	<!--custom checkbox & radio-->
	
	
<!-- 	<script type="text/javascript" src="<?php echo base_url();?>assets/theme/js/bootstrap-daterangepicker/daterangepicker.js"></script> -->
	
	<script type="text/javascript" src="<?php echo base_url();?>assets/theme/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	
	<script src="<?php echo base_url();?>assets/theme/js/form-component.js"></script>  

  <script type="text/javascript" src="<?php echo base_url();?>assets/theme/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/theme/js/gritter-conf.js"></script>  

    
    
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });
     


  
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000);


 function Check_overage(dob){
 var program = $('#prog').val();
       var dob = dob.value;
    // alert(dob);
    
          $.ajax({
                    url: '<?php echo base_url(); ?>home/check_overage',
                    type: 'POST',
                    data: {
                      'user_active':1,
                      'dob':dob,
                      'program':program,
                    
                    },

                    success : function(response){


                      if(response != 0){ 
                        
            $("#user1").html('You are '+response+' years old.')
        $.gritter.add({
            title: 'This is an alert Notice!',
            text: 'You are overaged at this time for admission please contact with <a href="#" style="color:#FFD777">GUDGK</a>.',
            image: '<?php echo base_url();?>assets/theme/img/ui-sam.jpg',
            sticky: false,
            time: ''
        });

                      }

                      else{
                        $("#user1").html('<div></div>');
                      }





                    }   
               });


   }


    document.querySelector('#profileDisplay').setAttribute('src', '<?php echo base_url();?>assets/theme/img/profile.jpg');

function triggerClick(e) {
  document.querySelector('#profileImage').click();
}
function displayImage(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}

 function validate_challan(challan){
       var challan = challan.value;
    
          $.ajax({
                    url: '<?php echo base_url(); ?>home/validate_challan',
                    type: 'POST',
                    data: {
                      'user_active':1,
                      'challan':challan
                    
                    },

                    success : function(response){


                      if(response == 0){ 
                        

        $.gritter.add({
            title: 'This is an alert Notice!',
            text: 'Sorry ! this challan number already exists with another application<a href="#" style="color:#FFD777">GUDGK</a>.',
            image: '<?php echo base_url();?>assets/theme/img/ui-sam.jpg',
            sticky: false,
            time: ''
        });

                      }

                      else{
                        $("#user").fadeOut(20000).html('<div></div>').fadeIn(20000);
                      }

                    }   
               });


   }

    function get_programs(depart){
  var depart = depart.value;
  var appfor=$('#applyforcourse').val();

          $.ajax({
                    url: '<?php echo base_url(); ?>home/get_programs',
                    type: 'post',
                    data: {
                      'post_active':1,
                      'depart':depart,
                      'appfor':appfor,
                      
                    },

                    success: function(response){

                      if(response == 0){ 
                        
                           $("#departments").fadeOut(100).html('options Not found').fadeIn(500);

                      }
                      else{

              $('#departments').html(response);

                    }



                    }   
               });


   }
    function get_departments(progs){
  var progs = progs.value;
          $.ajax({
                    url: '<?php echo base_url(); ?>home/get_departments',
                    type: 'post',
                    data: {
                      'post_active':1,
                      'progs':progs
                    
                    },

                    success: function(response){

                      if(response == 0){ 
                        
                           $("#prog").html('options Not found');



                      }
                      else{

               $('#prog').html(response);
                    
                    }

                    }   
               });


   }

   function hide_show(degree){
    var degree=degree.value;
    if (degree=='BS') {
      $('#bachelor').hide();
      $('#master').hide();
      $('#gat').hide();

      $('#bachelor_board').removeAttr('required');
      $('#bachelor_year').removeAttr('required');
      $('#bachelor_rollno').removeAttr('required');
      $('#bachelor_tmarks').removeAttr('required');
      $('#bachelor_omarks').removeAttr('required');
      $('#bachelor_percentage').removeAttr('required');
      $('#bachelor_div').removeAttr('required');
      $('#bachelor_subjects').removeAttr('required');

      $('#master_board').removeAttr('required');
      $('#master_year').removeAttr('required');
      $('#master_rollno').removeAttr('required');
      $('#master_omarks').removeAttr('required');
      $('#master_tmarks').removeAttr('required');
      $('#master_percentage').removeAttr('required');
      $('#master_div').removeAttr('required');
      $('#master_subjects').removeAttr('required');

    }
    if (degree =='BBA 2-years' || degree =='M.A' || degree =='M.Sc' || degree =='MCS') {
       $('#bachelor').show();
       document.getElementById('batch').innerHTML='BA/B.Sc/BBA';
      $('#master').hide();
      $('#gat').hide();

      $('#master_board').removeAttr('required');
      $('#master_year').removeAttr('required');
      $('#master_rollno').removeAttr('required');
      $('#master_omarks').removeAttr('required');
      $('#master_tmarks').removeAttr('required');
      $('#master_percentage').removeAttr('required');
      $('#master_div').removeAttr('required');
      $('#master_subjects').removeAttr('required');


    }
    if (degree=='MS' || degree=='MS BBA') {
      $('#bachelor').show();
      $('#master').show();
      $('#gat').show();

       document.getElementById('batch').innerHTML='BA/B.Sc/BBA/BS/B.Sc(Hons)';

       $('#master_board').removeAttr('required');
      $('#master_year').removeAttr('required');
      $('#master_rollno').removeAttr('required');
      $('#master_omarks').removeAttr('required');
      $('#master_tmarks').removeAttr('required');
      $('#master_percentage').removeAttr('required');
      $('#master_div').removeAttr('required');
      $('#master_subjects').removeAttr('required');

    }
     if (degree=='B.Ed') {
      $('#bachelor').show();
      $('#master').show();
      $('#gat').hide();

       document.getElementById('batch').innerHTML='BA/B.Sc/BBA/BS/B.Sc(Hons)';

       $('#master_board').removeAttr('required');
      $('#master_year').removeAttr('required');
      $('#master_rollno').removeAttr('required');
      $('#master_omarks').removeAttr('required');
      $('#master_tmarks').removeAttr('required');
      $('#master_percentage').removeAttr('required');
      $('#master_div').removeAttr('required');
      $('#master_subjects').removeAttr('required');

    }

   }

                                      function matric_percantage(mt_marks){
                                        var mt_marks=mt_marks.value;
                                       var mo_marks=$('#omarks').val();
                                       var per=(mo_marks/mt_marks)*100;
                                         $('#mt_percent').val(per);

                                         if (per >= 60) {
                                          $('#m_div').val('1st');
                                         }
                                         if (per >= 45 & per < 60) {
                                          $('#m_div').val('2nd');
                                         }
                                         if (per < 45) {
                                          $('#m_div').val('3rd');
                                            $.gritter.add({
                            title: 'This is an alert Notice!',
                            text: 'Sorry ! you are not eligible for the admission please contact.<a href="#" style="color:#FFD777">GUDGK</a>.',
                            image: '<?php echo base_url();?>assets/theme/img/ui-sam.jpg',
                            sticky: false,
                            time: ''
                        });
                                         }
                        //                    if (mo_marks > mt_marks) {
                        //                  $('#tmarks').val('');
                        //                 $('#omarks').val('');
                        //                   $('#m_div').val('');
                        //                   $('#mt_percent').val('');
                        //                     $.gritter.add({
                        //     title: 'This is an alert Notice!',
                        //     text: 'Sorry ! You have entered wrong marks.<a href="#" style="color:#FFD777">GUDGK</a>.',
                        //     image: '<?php echo base_url();?>assets/theme/img/ui-sam.jpg',
                        //     sticky: false,
                        //     time: ''
                        // });
                        //                  }
                                       
                                      }

                      function matric_percantage1(mo_marks){
                                        var mo_marks=mo_marks.value;
                                       var mt_marks=$('#tmarks').val();
                                      
                                       
                                       if (mt_marks!='') {
                                       
                                        var per=(mo_marks/mt_marks)*100;
                                         $('#mt_percent').val(per);

                                         if (per >= 60) {
                                          $('#m_div').val('1st');
                                         }
                                         if (per >= 45) {
                                          $('#m_div').val('2nd');
                                         }
                                         if (per < 45) {
                                          $('#m_div').val('3rd');
                                            $.gritter.add({
                            title: 'This is an alert Notice!',
                            text: 'Sorry ! you are not eligible for the admission please contact.<a href="#" style="color:#FFD777">GUDGK</a>.',
                            image: '<?php echo base_url();?>assets/theme/img/ui-sam.jpg',
                            sticky: false,
                            time: ''
                        });
                                         }

                                       }
                        //                  if (mt_marks!='' && mo_marks > mt_marks) {
                        //                 $('#tmarks').val('');
                        //                 $('#omarks').val('');
                        //                   $('#m_div').val('');
                        //                   $('#mt_percent').val('');
                        //                     $.gritter.add({
                        //     title: 'This is an alert Notice!',
                        //     text: 'Sorry ! You have entered wrong marks.<a href="#" style="color:#FFD777">GUDGK</a>.',
                        //     image: '<?php echo base_url();?>assets/theme/img/ui-sam.jpg',
                        //     sticky: false,
                        //     time: ''
                        // });
                        //                  }
                                                                              
                                      }
                                       function inter_percantage_cal(inter_tmarks){
                                         var inter_tmarks=inter_tmarks.value;
                                       var inter_omarks=$('#inter_omarks').val();
                                       var per=(inter_omarks/inter_tmarks)*100;
                                         $('#inter_percentage').val(per);

                                         if (per >= 60) {
                                          $('#inter_div').val('1st');
                                         }
                                         if (per >= 45 & per < 60) {
                                          $('#inter_div').val('2nd');
                                         }
                                         if (per < 45) {
                                          $('#inter_div').val('3rd');
                                            $.gritter.add({
                            title: 'This is an alert Notice!',
                            text: 'Sorry ! you are not eligible for the admission please contact.<a href="#" style="color:#FFD777">GUDGK</a>.',
                            image: '<?php echo base_url();?>assets/theme/img/ui-sam.jpg',
                            sticky: false,
                            time: ''
                        });
                                         }

                        //                   if (inter_omarks>inter_tmarks) {
                        //                 $('#inter_tmarks').val('');
                        //                 $('#inter_omarks').val('');
                        //                 $('#inter_percentage').val('');
                        //                 $('#inter_div').val('');
                        //                     $.gritter.add({
                        //     title: 'This is an alert Notice!',
                        //     text: 'Sorry ! You have entered wrong marks.<a href="#" style="color:#FFD777">GUDGK</a>.',
                        //     image: '<?php echo base_url();?>assets/theme/img/ui-sam.jpg',
                        //     sticky: false,
                        //     time: ''
                        // });
                        //                  }
                                       
                                    
                                      }
                                       function inter_percantage_cal1(inter_omarks){
                                         var inter_omarks=inter_omarks.value;
                                       var inter_tmarks=$('#inter_tmarks').val();
                                       if (inter_tmarks!='') {
                                         var per=(inter_omarks/inter_tmarks)*100;
                                         $('#inter_percentage').val(per);

                                         if (per >= 60) {
                                          $('#inter_div').val('1st');
                                         }
                                         if (per >= 45) {
                                          $('#inter_div').val('2nd');
                                         }
                                         if (per < 45) {
                                            $.gritter.add({
                            title: 'This is an alert Notice!',
                            text: 'Sorry ! you are not eligible for the admission please contact.<a href="#" style="color:#FFD777">GUDGK</a>.',
                            image: '<?php echo base_url();?>assets/theme/img/ui-sam.jpg',
                            sticky: false,
                            time: ''
                        });
                                         }
                                       
                                       }
                        //          if (inter_tmarks!='' & inter_omarks > inter_tmarks) {
                        //                 $('#inter_tmarks').val('');
                        //                 $('#inter_omarks').val('');
                        //                 $('#inter_percentage').val('');
                        //                 $('#inter_div').val('');
                        //                     $.gritter.add({
                        //     title: 'This is an alert Notice!',
                        //     text: 'Sorry ! You have entered wrong marks.<a href="#" style="color:#FFD777">GUDGK</a>.',
                        //     image: '<?php echo base_url();?>assets/theme/img/ui-sam.jpg',
                        //     sticky: false,
                        //     time: ''
                        // });
                        //                  }
                                      
                                    
                                      }
                                      function check_year(inter_year){
                                        var inter_year=inter_year.value;
                                        var matric_year=$('#matric_year').val();
                                        if (matric_year!='' & inter_year<matric_year) {
                                          $('#inter_year').val('')
                                            $.gritter.add({
                            title: 'This is an alert Notice!',
                            text: 'Sorry ! you have selectd a wrong year. Please select again.<a href="#" style="color:#FFD777">GUDGK</a>.',
                            image: '<?php echo base_url();?>assets/theme/img/ui-sam.jpg',
                            sticky: false,
                            time: ''
                        });
                                        }

                                      }
                                      
                                       function bachelor_percentage_cal(bachelor_tmarks){
                                        var bachelor_tmarks=bachelor_tmarks.value;
                                       var bachelor_omarks=$('#bachelor_omarks').val();
                                       var per=(bachelor_omarks/bachelor_tmarks)*100;
                                         $('#bachelor_percentage').val(per);

                                         // if (per >= 60) {
                                         //  $('#m_div').val('1st');
                                         // }
                                         // if (per >= 45) {
                                         //  $('#m_div').val('2nd');
                                         // }
                                         if (per < 45) {
                                          // $('#m_div').val('3rd');
                                            $.gritter.add({
                            title: 'This is an alert Notice!',
                            text: 'Sorry ! you are not eligible for the admission please contact.<a href="#" style="color:#FFD777">GUDGK</a>.',
                            image: '<?php echo base_url();?>assets/theme/img/ui-sam.jpg',
                            sticky: false,
                            time: ''
                        });
                                         }
                                       
                                    
                                      }
                                      function master_percentage_cal(master_tmarks){
                                        var master_tmarks=master_tmarks.value;
                                       var master_omarks=$('#master_omarks').val();
                                       var per=(master_omarks/master_tmarks)*100;
                                         $('#master_percentage').val(per);

                                         // if (per >= 60) {
                                         //  $('#m_div').val('1st');
                                         // }
                                         // if (per >= 45) {
                                         //  $('#m_div').val('2nd');
                                         // }
                                         if (per < 45) {
                                          // $('#m_div').val('3rd');
                                            $.gritter.add({
                            title: 'This is an alert Notice!',
                            text: 'Sorry ! you are not eligible for the admission please contact.<a href="#" style="color:#FFD777">GUDGK</a>.',
                            image: '<?php echo base_url();?>assets/theme/img/ui-sam.jpg',
                            sticky: false,
                            time: ''
                        });
                                         }
                                       
                                    
                                      }
                                      function check_image(){
                                        if ($('#profileImage').val() == '') {
                                                         $.gritter.add({
            // (string | mandatory) the heading of the notification
                            title: 'This is an alert Notice!',
                            // (string | mandatory) the text inside the notification
                            text: 'Please select an image.<a href="#" style="color:#FFD777">GUDGK</a>.',
                            // (string | optional) the image to display on the left
                            image: '<?php echo base_url();?>assets/theme/img/ui-sam.jpg',
                            // (bool | optional) if you want it to fade out on its own or just sit there
                            sticky: false,
                            // (int | optional) the time you want it to be alive for before fading out
                            time: ''
                        });
                                        }
                                      }
function check_cat(){
  $('#Disabled').removeAttr('checked');
  $('#Sports').removeAttr('checked');
 
}
function check_cat1(){
  $('#category').val('');
  // $('#Sports').removeAttr('checked');
 
}

function reserved(){
  $('#merit').removeAttr('checked');
  $('#quota').removeAttr('checked');
//   $('#self').removeAttr('checked');
 
}
function reserved1(){
  $('#applyon').val('');
  // $('#Sports').removeAttr('checked');
 
}
function show_yes_gat(){
  $('#gat_yes').show();
  $('#gat_no').hide();
  $('#validity').setAttr('required');
  $('#gatrollno').setAttr('required');
    $('#gatmarks').setAttr('required');
}
function show_no_gat(){
  $('#gat_yes').hide();
  $('#gat_no').show();

  $('#gat_Challan').setAttr('required');
  $('#gat_bank').setAttr('required');
  $('#gat_branch').setAttr('required');
  $('#gat_cdate').setAttr('required');
  
}
                                       
 </script>

  </body>
</html>
