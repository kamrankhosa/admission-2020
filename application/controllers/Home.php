<?php

/**
 * 
 */
class Home extends CI_Controller
{
  
  function __construct()
  {
    parent::__construct();
    $this->load->library('smtp_email');
    $this->load->library('Pdf');
    $this->load->model('Form_model');
  }
  public function index()

  {
    $data['departments']=$this->Form_model->departments();
    $this->load->view('form/form.php',$data);
  }

  function registered(){
    if ($this->input->post('register')) {

      // Bank details
      $Challan=$this->input->post('Challan');
      $bank=$this->input->post('bank');
      $branch=$this->input->post('branch');
      $chalan_date=$this->input->post('cdate');
      // Form portion 1
      $applyforcourse=$this->input->post('applyforcourse');
      $psession=$this->input->post('psession');
      $applyon1=$this->input->post('applyon');
      $applyon2=$this->input->post('applyingon');
       $check_challan=$this->Form_model->check_challan($Challan);
       if (!$check_challan) {
         redirect('already_applied');
         exit();
       }
      if (!empty($applyon1)) {
        $applyon=$applyon1;
      }
      else{
        $applyon=$applyon2;
      }
      $category1=$this->input->post('category');
      $category2=$this->input->post('category1');
      if (!empty($category1)) {
       $category=$category1;
      }
      else{
        $category=$category2;
      }
      
      // form portion 2
      $department=str_replace('_', ' ', $this->input->post('department'));
      $st_program=str_replace('_', ' ', $this->input->post('st_program'));
      $sname=$this->input->post('sname');
      $gender=$this->input->post('gender');
      $fname=$this->input->post('fname');
      $profession=$this->input->post('profession');
      $m_income=$this->input->post('m-income');
      $cnic=$this->input->post('cnic');
      $nation=$this->input->post('nation');
      $domile=$this->input->post('domile');
      $religion=$this->input->post('Religion');
      $hafiz=$this->input->post('hafiz');
      $blood_group=$this->input->post('Blood');
      $dob=$this->input->post('dob');
      $email=$this->input->post('email');
      $cellno=$this->input->post('cellno');
      // Person to be informed in emergency
      $ep_name=$this->input->post('ep-name');
      $ep_relation=$this->input->post('ep-relation');
      $g_cellno=$this->input->post('g-cellno');
      $address=$this->input->post('address');
      $stay=$this->input->post('stay');
      $check_app=$this->Form_model->check_already_exists($applyforcourse,$psession,$department,$st_program,$cnic,$sname,$gender);

      // if (!$check_app) {
      //   redirect('already_applied');
      //   exit();
      // }
       $c_date=date('Y-m-d');
        $_age = floor((time() - strtotime($dob)) / 31556926);


      if ($st_program =='BS' || $st_program =='BSc (Hons) Agriculture' || $st_program =='BS Environmental Science' || $st_program =='BS English' || $st_program =='BS Islam Studies' || $st_program =='BS-IT' || $st_program =='BS Urdu' || $st_program =='BS History' || $st_program =='BS Political Science' || $st_program =='BS Pakistan Studies' || $st_program =='BBA (Hons) 4 years' || $st_program =='BS Economics' || $st_program =='BS Education' || $st_program =='BS Sociology' || $st_program =='BS Botany' || $st_program =='BS Chemistry' || $st_program =='BS Mathematics' || $st_program =='BS Physics' || $st_program =='BS Statistics' || $st_program =='BS Zoology') {
        // Academic Record
        // Matric
      $matric_board=$this->input->post('matric_board');
      $matric_year=$this->input->post('matric_year');
      $matric_rollno=$this->input->post('matric_rollno');
      $matric_omarks=$this->input->post('omarks');
      $matric_tmarks=$this->input->post('tmarks');
      $matric_percentage=($matric_omarks/$matric_tmarks)*100;
      if ($matric_percentage>=60) {
        $matric_div='1st';
      }
      elseif ($matric_percentage>=45) {
        $matric_div='2nd';
      }

      $matric_subjects=$this->input->post('matric_subjects'); 

      // Inter record
      $inter_board=$this->input->post('inter_board');
      $inter_year=$this->input->post('inter_year');
      $inter_rollno=$this->input->post('inter_rollno');
      $inter_omarks=$this->input->post('inter_omarks');
      $inter_tmarks=$this->input->post('inter_tmarks');
      $inter_percentage=($inter_omarks/$inter_tmarks)*100;
      if ($inter_percentage>=60) {
        $inter_div='1st';
      }
      elseif ($inter_percentage>=45) {
        $inter_div='2nd';
      }
      // $inter_div=$this->input->post('inter_div');
      $inter_subjects=$this->input->post('inter_subjects');
      if ($matric_percentage<45 || $inter_percentage <45) {
        redirect('percenterror');
        exit();
      }
      $path ='./assets/profiles/';
      $this->load->library('upload');
      $check=array(
        "upload_path"       =>  $path,
        "allowed_types"     =>  'jpeg|jpg|png',
        "encrypt_name"      =>  true
      );
      
      if($this->upload->initialize($check) != true){
        echo "error please check";
        exit();
      }

      else{
if ($this->upload->do_upload('profileImage')!='') {
      if($this->upload->do_upload('profileImage'))
      {
        $upload_data = $this->upload->data();
         $profile =$upload_data['file_name'];
        
      $registered_bs_student_success=$this->Form_model->registered_bs_student($chalan_date,$Challan,$bank,$branch,$applyforcourse,$psession,$applyon,$category,$department,$st_program,$sname,$gender,$fname,$profession,$m_income,$cnic,$nation,$domile,$religion,$hafiz,$blood_group,$dob,$email,$cellno,$ep_name,$ep_relation,$g_cellno,$address,$stay,$matric_board,$matric_year,$matric_rollno,$matric_omarks,$matric_tmarks,$matric_percentage,$matric_div,$matric_subjects,$inter_board,$inter_year,$inter_rollno,$inter_omarks,$inter_tmarks,$inter_percentage,$inter_div,$inter_subjects,$profile);
      if ($registered_bs_student_success) {
        $get_data=$this->db->query("SELECT * FROM tbl_bs_students WHERE department='$department' AND st_program='$st_program' AND sname='$sname' AND cnic='$cnic' AND challan='$Challan'")->row();
       
          if ($_age > 24 & $_age < 26) {
           $bs_overage="Over Age";         
            }
            else{
              $bs_overage='';
            }

         $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

         // set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('GUDGK Registration 2020');
$pdf->SetSubject('Application form 2020');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data;
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Challan No: ', $Challan.'                                                                                                Dated: '.$chalan_date);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // Define the path to the image that you want to use as watermark.
        // $img_file = 'assets/profiles/'.$profile;

        // // Render the image
        // $pdf->Image($img_file, 0, 0, 223, 280, '', '', '', false, 300, '', false, false, 0);

        // Restore the auto-page-break status
// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();
$style = array(
    'border' => 2,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);





// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content
$subtable = '<table border="1" cellspacing="6" cellpadding="4"><tr><td>a</td><td>b</td></tr><tr><td>c</td><td>d</td></tr></table>';
$html = '<h3 style="padding-left: 30px;">
    Application No:  &nbsp;<span style="text-decoration: underline;">BS'.$get_data->ID.'</span>
  </h3>
  <h1 style="text-transform: uppercase; text-align: center; font-family: helvetia;">Ghazi University, Dera Ghazi khan</h1>
  <h2 style="text-align: center;">Application for Admission 2020</h2>
  <div>
  <table style="text-align:center;">
  <tr>
  <td>
  <h1>'.$department.'</h1>
  <h1>'.$st_program.'</h1>
  <h1>'.$bs_overage.'</h1>
  </td>
    <td>
    <img src="assets/profiles/'.$profile.'" alt="profile" width="100" height="100" border="0" style="float:right;"/>
    </td>
  </tr>
  </table>


</div>
<table style="border: 1px solid black; border-collapse: collapse; width:100%; font-weight: bold;">
                                <tr style="border: 1px solid black; border-collapse: collapse;">
                                  <th style="border: 1px solid black; border-collapse: collapse;">Applying For</th>
                                  <td style="border: 1px solid black; border-collapse: collapse;"><input type="checkbox" name="applyforcourse" value="Udergraduate" required="" checked="true"> Udergraduate</td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"><input type="checkbox" name="applyforcourse" value="Postgraduate"> Postgraduate</td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"><input type="checkbox" name="applyforcourse" value="M.Phill"> M.Phill</td>
                                 
                                </tr>
                                <tr style="border: 1px solid black; border-collapse: collapse;">
                                  <th style="border: 1px solid black; border-collapse: collapse;">Program</th>
                                  <td style="border: 1px solid black; border-collapse: collapse;">'.$psession.'</td>
                                </tr>
                                <tr style="border: 1px solid black; border-collapse: collapse;">
                                  <th style="border: 1px solid black; border-collapse: collapse;">Nominees of</th>
                                  <td style="border: 1px solid black; border-collapse: collapse;">'.$applyon.'</td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"></td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"></td>

                                </tr>
                                <tr style="border: 1px solid black; border-collapse: collapse;">
                                  <th style="border: 1px solid black; border-collapse: collapse;">Category</th>
                                  <td style="border: 1px solid black; border-collapse: collapse;">'.$category.'</td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"></td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"></td>
                                </tr>
                                
                              </table>
                              
<div style="text-align:center;">
<h1>Student Personal details</h1>
<table>
<tr>
<td><h4 style="text-align:justify-all"> Student Name :'.$sname.'</h4></td>
<td><h4 style="text-align:justify-all"> Gender :'.$gender.'</h4></td>
</tr>
<tr>
<td><h4 style="text-align:justify-all"> Father Name :'.$fname.'</h4></td>
<td><h4 style="text-align:justify-all"> Profession :'.$profession.'</h4></td>
</tr>
<tr>
<td><h4 style="text-align:justify-all"> CNIC / B-Form :'.$cnic.'</h4></td>
<td><h4 style="text-align:justify-all"> Hafiz-e-Quran :'.$hafiz.'</h4></td>
</tr>
<tr>
<td><h4 style="text-align:justify-all"> Email address :'.$email.'</h4></td>
<td><h4 style="text-align:justify-all"> Cell No :'.$cellno.'</h4></td>
</tr>
<tr>
<td><h4 style="text-align:justify-all"> Date of birth :'.$dob.'</h4></td>
</tr>
</table>
                                  </div>

                                  <h2 style="text-align:center;text-decoration: underline;">Academic Record</h2>
<table border="1" cellspacing="3" cellpadding="4" style="border-collapse: collapse;">
    <tr>
        <th>Examination</th>
        <th>Year</th>
        <th>Board / University</th>
        <th>Roll No</th>
        <th>Marks Obtained</th>
        <th>Marks Total</th>
        <th>%age</th>
        <th>Div / Grade / CGPA</th>
        <th>Major Subjects</th>

    </tr>
    <tr>
        <th>Matriculation</th>
        <td>'.$matric_year.'</td>
        <td>'.$matric_board.'</td>
        <td>'.$matric_rollno.'</td>
        <td>'.$matric_omarks.'</td>
        <td>'.$matric_tmarks.'</td>
        <td>'.round((($matric_omarks/$matric_tmarks)*100)).' %</td>
        <td>'.$matric_div.'</td>
        <td>'.$matric_subjects.'</td>
       
        
    </tr>
    <tr>
        <th>FA / F.Sc / Equivalent</th>
        
        <td>'.$inter_year.'</td>
        <td>'.$inter_board.'</td>
        <td>'.$inter_rollno.'</td>
        <td>'.$inter_omarks.'</td>
        <td>'.$inter_tmarks.'</td>
        <td>'.round((($inter_omarks/$inter_tmarks)*100)).' %</td>
        <td>'.$inter_div.'</td>
        <td>'.$inter_subjects.'</td>
    </tr>

   
</table>
   <h2 style="text-align:center;text-decoration: underline;"> UNDERTAKING</h2>                           

 <ol>
                                <li>I declare that I am not a member of any political party and that I shall not indulge in politics as long as I remain a student of the University. I further undertake that I will not challenge the finding/decision of Head of the Institution regarding my rustication/Expulsion from the University or cancellation of my admission at any stage whatsoever in any Court. Tribunal, Authority or Forum other than the Supreme Court of Pakistan.</li>
                                <li>I further undertake that I shall not claim hostel accommodation as a matter pf right.</li>
                                <li>I hereby certify that I have myself filled in this Form and the statements made herein are correct.</li>
                                <li>I hereby declare on oath that I have not been in the rolls of any teaching department of the University or Constituent college or an affiliated college of postgraduate studies (Master`s level of Law) for more than six months.</li>
                                <li>I hereby declare that I have not obtained B.A/BS/BBA/BCS/BFA in case of admission of Bachelor Degree program. MA/M.Sc./M. Com./MBA in case of admission of Master Degree or equivalent degree from any University.</li>
                                <li style="color:red;"><b>Note:</b> Items 4 & 5 are not applicable to MS/M.Phil. and Ph.D. candidates.</li>
                                <h2 style="text-align:center;">Requirements</h2>
                                <li>Copy of Student CNIC/B-form and Domicile</li>
                                <li>Copy of Father CNIC</li>
                                <li>One Copy of Academic Documents (Matric, FSc etc.)</li>
                                <li>Original Bank challan</li>
                                 <li style="color:red;"><b>Important Note: </b> After printing your form you must submit your hard copy along with attached documents to Admission Desk of Ghazi University, City Campus (College Chowk). Only hard copy will be entertained for Admission. </li>
                              </ol>

                              <div style="text-align:center">
                              <pre>
       -----------------------      ---------------------------
       Student Signature            Signature of Father/Guardian


       -----------------------      ---------------------------
        Dated                           Dated

        Father / Guardian CNIC -------------------------------
                              </pre>
                              </div>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
  // QRCODE,L : QR-CODE Low error correction
$pdf->Text(160, 165, 'QRCODE - GUDGK');

$pdf->write2DBarcode(base_url().'/admin/bs_student_profile?id='.base64_encode($get_data->ID), 'QRCODE,H', 170, 170, 30, 30, $style, 'N');


$html1='<br><hr /><div>
<h2 style="text-align:center;">Student slip</h2>
<p style="color:red;text-align:center;">For office use only</p> 

<table>
<tr>
<th><b>Application No </b></th>
<td>BS'.$get_data->ID.'</td>
<th><b>Student Name </b></th>
<td>'.$get_data->sname.'</td>
<th><b>Program </b></th>
<td>'.$get_data->st_program.'</td>
</tr><tr><td>.</td></tr>

</table> </div><br>';
$pdf->writeHTML($html1, true, false, true, false, '');
$pdf->Text(170, 200, 'QRCODE-GUDGK');

$pdf->write2DBarcode(base_url().'/admin/bs_student_profile?id='.base64_encode($get_data->ID), 'QRCODE,H', 180, 205, 20, 20, $style, 'N');


$html2='<br><br><br><br><hr><div>
<h4 style="text-align:center; padding-top:10px;">Student slip</h4>
<table>
<br>
<tr>
<th><b>Application No </b></th>
<td>BS'.$get_data->ID.'</td>
<th><b>Student Name </b></th>
<td>'.$get_data->sname.'</td>
</tr>
<tr>
<th><b>Program </b></th>
<td colspan="2">'.$get_data->st_program.'</td>
</tr>
<tr>
<th><b>CNIC </b></th>
<td colspan="2">'.$get_data->cnic.'</td>
</tr></table> </div><br>';
$pdf->writeHTML($html2, true, false, true, false, '');
$pdf->Text(170, 240, 'QRCODE-GUDGK');

$pdf->write2DBarcode(base_url().'/admin/bs_student_profile?id='.base64_encode($get_data->ID), 'QRCODE,H', 180, 245, 20, 20, $style, 'N');
// output the HTML content

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('registrationform.pdf', 'I');
$from="admission@gudgk.edu.pk";
$name="Ghazi University Dera Ghazi Khan";
$toEmail=$email;
$subject="Congratulations Message";
$msg='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Ghazi University, Dera Ghazi Khan</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <style type="text/css">

        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: none;
            -webkit-text-resize: 100%;
            text-resize: 100%;
        }

        a {
            outline: none;
            color: #40aceb;
            text-decoration: underline;
        }

        a:hover {
            text-decoration: none !important;
        }

        .nav a:hover {
            text-decoration: underline !important;
        }

        .title a:hover {
            text-decoration: underline !important;
        }

        .title-2 a:hover {
            text-decoration: underline !important;
        }

        .btn:hover {
            opacity: 0.8;
        }

        .btn
        a:hover {
            text-decoration: none !important;
        }

        .btn {
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }

        table td {
            border-collapse: collapse !important;
        }

        .ExternalClass, .ExternalClass a, .ExternalClass span,
        .ExternalClass b, .ExternalClass br, .ExternalClass p, .ExternalClass div {
            line-height: inherit;
        }

        @media only screen and
        (max-width: 500px) {
            table[class="flexible"] {
                width: 100% !important;
            }

            table[class="center"] {
                float: none !important;
                margin: 0 auto !important;
            }

            *[class="hide"] {
                display: none !important;
                width: 0 !important;
                height: 0 !important;
                padding: 0 !important;
                font-size: 0 !important;
                line-height: 0 !important;
            }

            td[class="img-flex"] img {
                width: 100% !important;
                height: auto !important;
            }

            td[class="aligncenter"] {
                text-align: center !important;
            }

            th[class="flex"] {
                display: block !important;
                width: 100% !important;
            }

            td[class="wrapper"] {
                padding: 0 !important;
            }

            td[class="holder"] {
                padding: 30px 15px 20px !important;
            }

            td[class="nav"] {
                padding: 20px 0 0 !important;
                text-align: center !important;
            }

            td[class="h-auto"] {
                height: auto !important;
            }

            td[class="description"] {
                padding: 30px 20px !important;
            }

            td[class="i-120"] img {
                width: 120px !important;
                height: auto !important;
            }

            td[class="footer"] {
                padding: 5px 20px 20px !important;
            }

            td[class="footer"] td[class="aligncenter"] {
                line-height: 25px !important;
                padding: 20px 0 0 !important;
            }

            tr[class="table-holder"] {
                display: table !important;
                width: 100% !important;
            }

            th[class="thead"] {
                display: table-header-group !important;
                width: 100% !important;
            }

            th[class="tfoot"] {
                display: table-footer-group !important;
                width: 100% !important;
            }
        }
     
  .row {justify-content: space-between;}    

.row {
  display: flex;
  flex-direction: row;
}
.row-vertical {
  display: flex;
  height: 100%;
  flex-direction: column;
  justify-content: space-between;
}
.row-vertical > .col {
  flex: 0;
}
.row > .col {
  flex: 1;
}
.row > .col.half {
  flex-basis: 50%;
}
.rTableRow{
 display: table-row;
}
.table-header{
    background: #fbad18;
    padding: 10px;
    color: #000;
    width: 100%;
    font-size: 14px
    
}
.table-row{
    padding: 10px;
    border-bottom: #d7d7d7 solid 1px;

    width: 100%;
}
.rTableCell{
    display: table-cell;
    padding: 10px 10px;
    color: #000000;
        }
.rTableHead{
        padding: 0px 6px;
        }
        .rTable{
            width: 100%;
            display: table;
        }
    </style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
    
<body style="margin:0; padding:0;" bgcolor="#eaeced">

<table style="min-width:320px;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#eaeced">
    <!-- fix for gmail -->
    <tr>
        <td class="hide">
            <table width="600" cellpadding="0" cellspacing="0" style="width:600px !important;">
                <tr>
                    <td style="min-width:600px; font-size:0; line-height:0;">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td class="wrapper" style="padding:0 10px;">
            <table data-module="module-6" data-thumb="thumbnails/06.png" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td data-bgcolor="bg-module" bgcolor="#eaeced">
                        <table class="flexible" width="600" align="center" style="margin:30px auto 0; border-radius: 10px; overflow: hidden;" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="border-radius: 10px; overflow: hidden;" align="center" class="holder" bgcolor="#f9f9f9">
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            
                                            <td data-color="title" data-size="size title" data-min="20" data-max="40" data-link-color="link title color" data-link-style="text-decoration:none; color:#292c34;" class="title" align="center" style="font:20px/23px Arial, Helvetica, sans-serif; color:#292c34; padding:10px; background: #fff;font-weight: bold;color: #fff; text-align: center">
                                                  <div><img src="<?php echo base_url();?>assets/theme/img/GHAZIKHANUNIVERSITY171.png" style="width: 20%;"></div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:16px/29px Arial, Helvetica, sans-serif; color:#888; padding:20px;">
                                                <h3 style="color: #59b2e6;">Congratulations '.$sname.'! </h3>
                                                <h4 style="color: black">Your application has been submitted successfully with id <b>'.$get_data->ID.'</b> at <a href="https://www.gudgk.edu.pk/">GUDGK</a>.</h4>

                                                <p class="text-center" style="color: black"> Please submit your form with the documents listed below at GUDGK .</p>
                                                <ol style="text-align: left;">
                                                    <li>Copy of Student CNIC/B-form and Domicile
</li>
                                                    <li>Copy of Father CNIC</li>
                                                    <li>One Copy of Academic Documents (Matric, FSc etc.)</li>
                                                </ol>

                                            </td>
                                        </tr>
                                        <tr>
                                            
                                            <td data-color="title" data-size="size title" data-min="20" data-max="40" data-link-color="link title color" data-link-style="text-decoration:none; color:#292c34;" class="title" align="center" style="font:12px/23px Arial, Helvetica, sans-serif; color:#292c34; padding:10px; background: #fff;;font-weight: bold;color: #59b2e6; text-align: center">
                                                  <div> GUDGK © 2020  &nbsp; All Rights Reserved.</div>
                                                <!--<a href="#" style="color: #59b2e6;  ">Unsubscribe</a>-->
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td height="28"></td>
                            </tr>
                        </table>
                    </td>

                </tr>
            </table>

            <!-- module 7 -->
            
           
        </td>
    </tr>

    <!-- fix for gmail -->

    <tr>
        <td style="line-height:0;">
            <div style="display:none; white-space:nowrap; font:15px/1px courier;">
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp;
            </div>
        </td>
    </tr>

</table>
    
</body>
</html>';
$this->smtp_email->send($from,$name,$toEmail,$subject,$msg);


      }
    }
    }
    
  }

      }
      elseif ($st_program=='MSc. (Hons.) Plant Breeding & Genetics' || $st_program=='MSc. (Hons.) Agronomy' || $st_program=='MSc. (Hons.) Horticulture' || $st_program=='MSc. (Hons.) Plant Breeding & Genetics' || $st_program=='MSc. (Hons.) Soil Science' || $st_program=='MS/MPhill English (Linguistics)' || $st_program=='MS Business Administration 2 Years' || $st_program=='MS/MPhil Economics' || $st_program=='MS/MPhil Zoology' || $st_program=='MSc. (Hons.) Agri Entomology' || $st_program=='B.Ed') {

      // Academic Record
        // Matric
      $matric_board=$this->input->post('matric_board');
      $matric_year=$this->input->post('matric_year');
      $matric_rollno=$this->input->post('matric_rollno');
      $matric_omarks=$this->input->post('omarks');
      $matric_tmarks=$this->input->post('tmarks');
      $matric_percentage=($matric_omarks/$matric_tmarks)*100;
      if ($matric_percentage >= 60) {
        $matric_div='1st';
      }
      elseif ($matric_percentage >= 45) {
        $matric_div='2nd';
      }
      $matric_subjects=$this->input->post('matric_subjects'); 


      // Inter record
      $inter_board=$this->input->post('inter_board');
      $inter_year=$this->input->post('inter_year');
      $inter_rollno=$this->input->post('inter_rollno');
      $inter_omarks=$this->input->post('inter_omarks');
      $inter_tmarks=$this->input->post('inter_tmarks');
      $inter_percentage=($inter_omarks/$inter_tmarks)*100;
      if ($inter_percentage>=60) {
        $inter_div='1st';
      }
      elseif ($inter_percentage>=45) {
        $inter_div='2nd';
      }
      $inter_subjects=$this->input->post('inter_subjects');

      // Bachelor record
      $bachelor_board=$this->input->post('bachelor_board');
      $bachelor_year=$this->input->post('bachelor_year');
      $bachelor_rollno=$this->input->post('bachelor_rollno');
      $bachelor_omarks=$this->input->post('bachelor_omarks');
      $bachelor_tmarks=$this->input->post('bachelor_tmarks');
      $bachelor_percentage=($bachelor_omarks/$bachelor_tmarks)*100;
      if ($bachelor_percentage>=60) {
        $bachelor_div='1st';
      }
      elseif ($bachelor_percentage>=45) {
        $bachelor_div='2nd';
      }
      // $bachelor_div=$this->input->post('bachelor_div');
      $bachelor_subjects=implode(',',$this->input->post('bachelor_subjects'));
      // print_r($bachelor_subjects);
      // exit();

    //   if ($matric_percentage<45 || $inter_percentage <45 || $bachelor_percentage <45) {
    //     redirect('percenterror');
    //     exit();
    //   }
      // Master record
      $master_board=$this->input->post('master_board');
      $master_year=$this->input->post('master_year');
      $master_rollno=$this->input->post('master_rollno');
      $master_omarks=$this->input->post('master_omarks');
      $master_tmarks=$this->input->post('master_tmarks');
      if(!empty($master_tmarks) & !empty($master_omarks)){
          
      $master_percentage=($master_omarks/$master_tmarks)*100;
      
      if ($master_percentage <45) {
        redirect('percenterror');
        exit();
      }
      if ($master_percentage>=60) {
        $master_div='1st';
      }
      elseif ($master_percentage>=45) {
        $master_div='2nd';
      }
      }
      else{
        $master_percentage='';
       $master_div='';   
      }
      // $master_div=$this->input->post('master_div');
      $master_subjects=$this->input->post('master_subjects');


      // GAT test information
      $attempted=$this->input->post('gat');
      $gat_validity=$this->input->post('validity');
      $gat_gatrollno=$this->input->post('gatrollno');
      $gatmarks=$this->input->post('gatmarks');

      // Apply for department test

      $gat_Challan=$this->input->post('gat_Challan');
      $gat_bank=$this->input->post('gat_bank');
      $gat_branch=$this->input->post('gat_branch');
      $gat_cdate=$this->input->post('gat_cdate');

      $path ='./assets/profiles/';
      $this->load->library('upload');
      $check=array(
        "upload_path"       =>  $path,
        "allowed_types"     =>  'jpeg|jpg|png',
        "encrypt_name"      =>  true
      );
      
      if($this->upload->initialize($check) != true){
        echo "error please check";
        exit();
      }

      else{
if ($this->upload->do_upload('profileImage')!='') {
      if($this->upload->do_upload('profileImage'))
      {
        $upload_data = $this->upload->data();
         $profile =$upload_data['file_name'];
        
      $registered_ms_student_success=$this->Form_model->registered_ms_student($chalan_date,$Challan,$bank,$branch,$applyforcourse,$psession,$applyon,$category,$department,$st_program,$sname,$gender,$fname,$profession,$m_income,$cnic,$nation,$domile,$religion,$hafiz,$blood_group,$dob,$email,$cellno,$ep_name,$ep_relation,$g_cellno,$address,$stay,$matric_board,$matric_year,$matric_rollno,$matric_omarks,$matric_tmarks,$matric_percentage,$matric_div,$matric_subjects,$inter_board,$inter_year,$inter_rollno,$inter_omarks,$inter_tmarks,$inter_percentage,$inter_div,$inter_subjects,$bachelor_board,$bachelor_year,$bachelor_rollno,$bachelor_omarks,$bachelor_tmarks,$bachelor_percentage,$bachelor_div,$bachelor_subjects,$master_board,$master_year,$master_rollno,$master_omarks,$master_tmarks,$master_percentage,$master_div,$master_subjects,$profile);
      if ($registered_ms_student_success) {

        $get_data1=$this->db->query("SELECT * FROM tbl_ms_students WHERE department='$department' AND st_program='$st_program' AND sname='$sname' AND cnic='$cnic' AND challan='$Challan'")->row();
        $this->db->query("INSERT INTO `tbl_gat_data`(student_id,attempted,validity_date,gat_marks,gat_roll_no,gat_Challan,gat_bank,gat_branch,gat_cdate) VALUES ('$get_data1->ID','$attempted','$gat_validity','$gatmarks','$gat_gatrollno','$gat_Challan','$gat_bank','$gat_branch','$gat_cdate')");


         $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

         // set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('GUDGK Registration 2020');
$pdf->SetSubject('Application form 2020');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Challan No: ', $Challan.'                                                                                                   Dated: '.$chalan_date);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();
$style = array(
    'border' => 2,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);





// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content
$subtable = '<table border="1" cellspacing="6" cellpadding="4"><tr><td>a</td><td>b</td></tr><tr><td>c</td><td>d</td></tr></table>';
$html = '<h3 style="padding-left: 30px;">
    Application No: MS'.$get_data1->ID.'&nbsp;<span style="text-decoration: underline;"></span>
  </h3>';

  $html.='<h1 style="text-transform: uppercase; text-align: center; font-family: helvetia;">Ghazi University, Dera Ghazi khan</h1>
  <h2 style="text-align: center;">Application for Admission 2020</h2>
   <table style="text-align:center;">
  <tr>
  <td>
  <h1>'.$department.'</h1>
  <h1>'.$st_program.'</h1>
  </td>
    <td>
    <img src="assets/profiles/'.$profile.'" alt="profile" width="100" height="100" border="0" style="float:right;"/>
    </td>
  </tr>
  </table>
</div>
<table style="border: 1px solid black; border-collapse: collapse; width:100%; font-weight: bold;">
                                <tr style="border: 1px solid black; border-collapse: collapse;">
                                  <th style="border: 1px solid black; border-collapse: collapse;">Applying For</th>
                                  <td style="border: 1px solid black; border-collapse: collapse;"><input type="checkbox" name="applyforcourse" value="Udergraduate" required=""> Udergraduate</td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"><input type="checkbox" name="applyforcourse" value="Postgraduate"> Postgraduate</td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"><input type="checkbox" name="applyforcourse" value="M.Phill" checked="true"> M.Phill</td>
                                 
                                </tr>
                                <tr style="border: 1px solid black; border-collapse: collapse;">
                                  <th style="border: 1px solid black; border-collapse: collapse;">Program</th>
                                  <td style="border: 1px solid black; border-collapse: collapse;">'.$psession.'</td>
                                </tr>
                                <tr style="border: 1px solid black; border-collapse: collapse;">
                                  <th style="border: 1px solid black; border-collapse: collapse;">Nominees of</th>
                                  <td style="border: 1px solid black; border-collapse: collapse;">'.$applyon.'</td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"></td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"></td>

                                </tr>
                                <tr style="border: 1px solid black; border-collapse: collapse;">
                                  <th style="border: 1px solid black; border-collapse: collapse;">Category</th>
                                  <td style="border: 1px solid black; border-collapse: collapse;">'.$category.'</td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"></td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"></td>
                                </tr>
                                
                              </table>
                            <div style="text-align:center;">
<h1>Student Personal details</h1>
<table>
<tr>
<td><h4 style="text-align:justify-all"> Student Name :'.$sname.'</h4></td>
<td><h4 style="text-align:justify-all"> Gender :'.$gender.'</h4></td>
</tr>
<tr>
<td><h4 style="text-align:justify-all"> Father Name :'.$fname.'</h4></td>
<td><h4 style="text-align:justify-all"> Profession :'.$profession.'</h4></td>
</tr>
<tr>
<td><h4 style="text-align:justify-all"> CNIC / B-Form :'.$cnic.'</h4></td>
<td><h4 style="text-align:justify-all"> Hafiz-e-Quran :'.$hafiz.'</h4></td>
</tr>
<tr>
<td><h4 style="text-align:justify-all"> Email address :'.$email.'</h4></td>
<td><h4 style="text-align:justify-all"> Cell No :'.$cellno.'</h4></td>
</tr>
<tr>
<td><h4 style="text-align:justify-all"> Date of birth :'.$dob.'</h4></td>
</tr>
</table>
                                  </div>

                                  <h2 style="text-align:center;text-decoration: underline;">Academic Record</h2>
<table border="1" cellspacing="3" cellpadding="4" style="border-collapse: collapse;">
    <tr>
        <th>Examination</th>
        <th>Year</th>
        <th>Board / University</th>
        <th>Roll No</th>
        <th>Marks Obtained</th>
        <th>Marks Total</th>
        <th>%age</th>
        <th>Div / Grade / CGPA</th>
        <th>Major Subjects</th>

    </tr>
    <tr>
        <th>Matriculation</th>
        <td>'.$matric_year.'</td>
        <td>'.$matric_board.'</td>
        <td>'.$matric_rollno.'</td>
        <td>'.$matric_omarks.'</td>
        <td>'.$matric_tmarks.'</td>
        <td>'.round((($matric_omarks/$matric_tmarks)*100)).' %</td>
        <td>'.$matric_div.'</td>
        <td>'.$matric_subjects.'</td>
       
        
    </tr>
    <tr>
        <th>FA / F.Sc / Equivalent</th>
        
        <td>'.$inter_year.'</td>
        <td>'.$inter_board.'</td>
        <td>'.$inter_rollno.'</td>
        <td>'.$inter_omarks.'</td>
        <td>'.$inter_tmarks.'</td>
        <td>'.round((($inter_omarks/$inter_tmarks)*100)).' %</td>
        <td>'.$inter_div.'</td>
        <td>'.$inter_subjects.'</td>
    </tr>
    <tr>
       <th>BA/B.Sc/BBA/BS/B.Sc(Hons)</th>
        <td>'.$bachelor_year.'</td>
        <td>'.$bachelor_board.'</td>
        <td>'.$bachelor_rollno.'</td>
        <td>'.$bachelor_omarks.'</td>
        <td>'.$bachelor_tmarks.'</td>
        <td>'.round((($bachelor_omarks/$bachelor_tmarks)*100)).' %</td>
        <td>'.$bachelor_div.'</td>
        <td>'.$bachelor_subjects.'</td>

    </tr>
    <tr>
         <th>MA / M.Sc</th>
        <td>'.$master_year.'</td>
        <td>'.$master_board.'</td>
        <td>'.$master_rollno.'</td>
        <td>'.$master_omarks.'</td>
        <td>'.$master_tmarks.'</td>
        <td>'.round((($master_omarks/$master_tmarks)*100)).' %</td>
        <td>'.$master_div.'</td>
        <td>'.$master_subjects.'</td>
    </tr>

   
</table>
  <h2 style="text-align:center;text-decoration: underline;"> UNDERTAKING</h2>                            

 <ol>
                                <li>I declare that I am not a member of any political party and that I shall not indulge in politics as long as I remain a student of the University. I further undertake that I will not challenge the finding/decision of Head of the Institution regarding my rustication/Expulsion from the University or cancellation of my admission at any stage whatsoever in any Court. Tribunal, Authority or Forum other than the Supreme Court of Pakistan.</li>
                                <li>I further undertake that I shall not claim hostel accommodation as a matter pf right.</li>
                                <li>I hereby certify that I have myself filled in this Form and the statements made herein are correct.</li>
                                <li>I hereby declare on oath that I have not been in the rolls of any teaching department of the University or Constituent college or an affiliated college of postgraduate studies (Master`s level of Law) for more than six months.</li>
                                <li>I hereby declare that I have not obtained B.A/BS/BBA/BCS/BFA in case of admission of Bachelor Degree program. MA/M.Sc./M. Com./MBA in case of admission of Master Degree or equivalent degree from any University.</li>
                                <li style="color:red;"><b>Note:</b> Items 4 & 5 are not applicable to MS/M.Phil. and Ph.D. candidates.</li>
                                <h2 style="text-align:center;">Requirements</h2>
                                <li>Copy of Student CNIC/B-form and Domicile</li>
                                <li>Copy of Father CNIC</li>
                                <li>One Copy of Academic Documents (Matric, FSc etc.)</li>
                                 <li style="color:red;"><b>Important Note: </b> After printing your form you must submit your hard copy along with attached documents to Admission Desk of Ghazi University, City Campus (College Chowk). Only hard copy will be entertained for Admission. </li>
                              </ol>

                              <div style="text-align:center">

                              <pre>
   -----------------------      ---------------------------
     Student Signature            Signature of Father/Guardian

 -----------------------      ---------------------------
   Dated                           Dated

   Father / Guardian CNIC -------------------------------
                              </pre>
                              </div>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
  // QRCODE,L : QR-CODE Low error correction
$pdf->Text(160, 165, 'QRCODE - GUDGK');

$pdf->write2DBarcode(base_url().'/admin/ms_student_profile?id='.base64_encode($get_data1->ID), 'QRCODE,H', 170, 170, 30, 30, $style, 'N');


$html1='<br><hr /><div>
<h2 style="text-align:center;">Student slip</h2>
<p style="color:red;text-align:center;">For office use only</p> 

<table>
<tr>
<th><b>Application No </b></th>
<td>MS'.$get_data1->ID.'</td>
<th><b>Student Name </b></th>
<td>'.$get_data1->sname.'</td>
<th><b>Program </b></th>
<td>'.$get_data1->st_program.'</td>
</tr><tr><td>.</td></tr>

</table> </div><br>';
$pdf->writeHTML($html1, true, false, true, false, '');
$pdf->Text(170, 200, 'QRCODE-GUDGK');

$pdf->write2DBarcode(base_url().'/admin/ms_student_profile?id='.base64_encode($get_data1->ID), 'QRCODE,H', 180, 205, 20, 20, $style, 'N');


$html2='<br><br><br><br><hr><div>
<h4 style="text-align:center; padding-top:10px;">Student slip</h4>
<table>
<br>
<tr>
<th><b>Application No </b></th>
<td>MS'.$get_data1->ID.'</td>
<th><b>Student Name </b></th>
<td>'.$get_data1->sname.'</td>
</tr>
<tr>
<th><b>Program </b></th>
<td colspan="2">'.$get_data1->st_program.'</td>
</tr>
<tr>
<th><b>CNIC </b></th>
<td colspan="2">'.$get_data1->cnic.'</td>
</tr></table> </div><br>';
$pdf->writeHTML($html2, true, false, true, false, '');
$pdf->Text(170, 240, 'QRCODE-GUDGK');

$pdf->write2DBarcode(base_url().'/admin/ms_student_profile?id='.base64_encode($get_data1->ID), 'QRCODE,H', 180, 245, 20, 20, $style, 'N');

// output the HTML content

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('registrationform.pdf', 'I');
$from="admission@gudgk.edu.pk";
$name="Ghazi University Dera Ghazi Khan";
$toEmail=$email;
$subject="Congratulations Message";
$msg="Hi ".$sname." your application at Ghazi university DGK has been submittedd successfully with id number".$get_data1->ID ;
$this->smtp_email->send($from,$name,$toEmail,$subject,$msg);


      }
    }
    }
    
  }

      }
      else{
        // Academic Record
        // Matric
      $matric_board=$this->input->post('matric_board');
      $matric_year=$this->input->post('matric_year');
      $matric_rollno=$this->input->post('matric_rollno');
      $matric_omarks=$this->input->post('omarks');
      $matric_tmarks=$this->input->post('tmarks');
      $matric_percentage=($matric_omarks/$matric_tmarks)*100;
      // $matric_div=$this->input->post('div');
      if ($matric_percentage>=60) {
        $matric_div='1st';
      }
      elseif ($matric_percentage>=45) {
        $matric_div='2nd';
      }
      $matric_subjects=$this->input->post('matric_subjects'); 

      // Inter record
      $inter_board=$this->input->post('inter_board');
      $inter_year=$this->input->post('inter_year');
      $inter_rollno=$this->input->post('inter_rollno');
      $inter_omarks=$this->input->post('inter_omarks');
      $inter_tmarks=$this->input->post('inter_tmarks');
      $inter_percentage=($inter_omarks/$inter_tmarks)*100;
      // $inter_div=$this->input->post('inter_div');
      if ($inter_percentage>=60) {
        $inter_div='1st';
      }
      elseif ($inter_percentage>=45) {
        $inter_div='2nd';
      }
      $inter_subjects=$this->input->post('inter_subjects');

      // Bachelor record
      $bachelor_board=$this->input->post('bachelor_board');
      $bachelor_year=$this->input->post('bachelor_year');
      $bachelor_rollno=$this->input->post('bachelor_rollno');
      $bachelor_omarks=$this->input->post('bachelor_omarks');
      $bachelor_tmarks=$this->input->post('bachelor_tmarks');
      $bachelor_percentage=($bachelor_omarks/$bachelor_tmarks)*100;
      // $bachelor_div=$this->input->post('bachelor_div');
       if ($bachelor_percentage>=60) {
        $bachelor_div='1st';
      }
      elseif ($bachelor_percentage>=45) {
        $bachelor_div='2nd';
      }
      $bachelor_subjects=implode(',',$this->input->post('bachelor_subjects'));
      if ($matric_percentage<45 || $inter_percentage <45 || $bachelor_percentage <45) {
        redirect('percenterror');
        exit();
      }
      // print_r($bachelor_subjects);
      // exit();
      $path ='./assets/profiles/';
      $this->load->library('upload');
      $check=array(
        "upload_path"       =>  $path,
        "allowed_types"     =>  'jpeg|jpg|png',
        "encrypt_name"      =>  true
      );
      
      if($this->upload->initialize($check) != true){
        echo "error please check";
        exit();
      }

      else{
if ($this->upload->do_upload('profileImage')!='') {
      if($this->upload->do_upload('profileImage'))
      {
        $upload_data = $this->upload->data();
         $profile =$upload_data['file_name'];
        
      $registered_msc_student_success=$this->Form_model->registered_msc_student($chalan_date,$Challan,$bank,$branch,$applyforcourse,$psession,$applyon,$category,$department,$st_program,$sname,$gender,$fname,$profession,$m_income,$cnic,$nation,$domile,$religion,$hafiz,$blood_group,$dob,$email,$cellno,$ep_name,$ep_relation,$g_cellno,$address,$stay,$matric_board,$matric_year,$matric_rollno,$matric_omarks,$matric_tmarks,$matric_percentage,$matric_div,$matric_subjects,$inter_board,$inter_year,$inter_rollno,$inter_omarks,$inter_tmarks,$inter_percentage,$inter_div,$inter_subjects,$bachelor_board,$bachelor_year,$bachelor_rollno,$bachelor_omarks,$bachelor_tmarks,$bachelor_percentage,$bachelor_div,$bachelor_subjects,$profile);
      if ($registered_msc_student_success) {

        $get_data2=$this->db->query("SELECT * FROM tbl_msc_students WHERE department='$department' AND st_program='$st_program' AND sname='$sname' AND cnic='$cnic' AND challan='$Challan'")->row();
        if ($_age > 28 & $_age < 30) {
           $msc_overage="Over Age";         
            }
            else{
              $msc_overage='';
            }
        
         $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

         // set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('GUDGK Registration 2020');
$pdf->SetSubject('Application form 2020');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Challan No: ', $Challan.'                                                                                                          Dated: '.$chalan_date);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();
$style = array(
    'border' => 2,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);





// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content
$subtable = '<table border="1" cellspacing="6" cellpadding="4"><tr><td>a</td><td>b</td></tr><tr><td>c</td><td>d</td></tr></table>';
$html = '<h3 style="padding-left: 30px;">
    Application No: MSC'.$get_data2->ID.'&nbsp;<span style="text-decoration: underline;"></span>
  </h3>
  <h1 style="text-transform: uppercase; text-align: center; font-family: helvetia;">Ghazi University, Dera Ghazi khan</h1>
  <h2 style="text-align: center;">Application for Admission 2020</h2>
  <div>
  <table style="text-align:center;">
  <tr>
  <td>
  <h1>'.$department.'</h1>
  <h1>'.$st_program.'</h1>
  <h1>'.$msc_overage.'</h1>
  </td>
    <td>
    <img src="assets/profiles/'.$profile.'" alt="profile" width="100" height="100" border="0" style="float:right;"/>
    </td>
  </tr>
  </table>


</div>
<table style="border: 1px solid black; border-collapse: collapse; width:100%; font-weight: bold;">
                                <tr style="border: 1px solid black; border-collapse: collapse;">
                                  <th style="border: 1px solid black; border-collapse: collapse;">Applying For</th>
                                  <td style="border: 1px solid black; border-collapse: collapse;"><input type="checkbox" name="applyforcourse" value="Udergraduate" required=""> Udergraduate</td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"><input type="checkbox" name="applyforcourse" value="Postgraduate" checked="true"> Postgraduate</td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"><input type="checkbox" name="applyforcourse" value="M.Phill"> M.Phill</td>
                                 
                                </tr>
                                <tr style="border: 1px solid black; border-collapse: collapse;">
                                  <th style="border: 1px solid black; border-collapse: collapse;">Program</th>
                                  <td style="border: 1px solid black; border-collapse: collapse;">'.$psession.'</td>
                                  
                                </tr>
                                <tr style="border: 1px solid black; border-collapse: collapse;">
                                  <th style="border: 1px solid black; border-collapse: collapse;">Nominees of</th>
                                  <td style="border: 1px solid black; border-collapse: collapse;">'.$applyon.'</td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"></td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"></td>

                                </tr>
                                <tr style="border: 1px solid black; border-collapse: collapse;">
                                  <th style="border: 1px solid black; border-collapse: collapse;">Category</th>
                                  <td style="border: 1px solid black; border-collapse: collapse;">'.$category.'</td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"></td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"></td>
                                </tr>
                                
                              </table>
      <div style="text-align:center;">
<h1>Student Personal details</h1>
<table>
<tr>
<td><h4 style="text-align:justify-all"> Student Name :'.$sname.'</h4></td>
<td><h4 style="text-align:justify-all"> Gender :'.$gender.'</h4></td>
</tr>
<tr>
<td><h4 style="text-align:justify-all"> Father Name :'.$fname.'</h4></td>
<td><h4 style="text-align:justify-all"> Profession :'.$profession.'</h4></td>
</tr>
<tr>
<td><h4 style="text-align:justify-all"> CNIC / B-Form :'.$cnic.'</h4></td>
<td><h4 style="text-align:justify-all"> Hafiz-e-Quran :'.$hafiz.'</h4></td>
</tr>
<tr>
<td><h4 style="text-align:justify-all"> Email address :'.$email.'</h4></td>
<td><h4 style="text-align:justify-all"> Cell No :'.$cellno.'</h4></td>
</tr>
<tr>
<td><h4 style="text-align:justify-all"> Date of birth :'.$dob.'</h4></td>
</tr>
</table>
                                  </div>

                                  <h2 style="text-align:center;text-decoration: underline;">Academic Record</h2>
<table border="1" cellspacing="3" cellpadding="4" style="border-collapse: collapse;">
    <tr>
        <th>Examination</th>
        <th>Year</th>
        <th>Board / University</th>
        <th>Roll No</th>
        <th>Marks Obtained</th>
        <th>Marks Total</th>
        <th>%age</th>
        <th>Div / Grade / CGPA</th>
        <th>Major Subjects</th>

    </tr>
    <tr>
        <th>Matriculation</th>
        <td>'.$matric_year.'</td>
        <td>'.$matric_board.'</td>
        <td>'.$matric_rollno.'</td>
        <td>'.$matric_omarks.'</td>
        <td>'.$matric_tmarks.'</td>
        <td>'.round((($matric_omarks/$matric_tmarks)*100)).' %</td>
        <td>'.$matric_div.'</td>
        <td>'.$matric_subjects.'</td>
       
        
    </tr>
    <tr>
        <th>FA / F.Sc / Equivalent</th>
        
        <td>'.$inter_year.'</td>
        <td>'.$inter_board.'</td>
        <td>'.$inter_rollno.'</td>
        <td>'.$inter_omarks.'</td>
        <td>'.$inter_tmarks.'</td>
        <td>'.round((($inter_omarks/$inter_tmarks)*100)).' %</td>
        <td>'.$inter_div.'</td>
        <td>'.$inter_subjects.'</td>
    </tr>
    <tr>
       <th>BA/B.Sc/BBA/BS/B.Sc(Hons)</th>
        <td>'.$bachelor_year.'</td>
        <td>'.$bachelor_board.'</td>
        <td>'.$bachelor_rollno.'</td>
        <td>'.$bachelor_omarks.'</td>
        <td>'.$bachelor_tmarks.'</td>
        <td>'.round((($bachelor_omarks/$bachelor_tmarks)*100)).' %</td>
        <td>'.$bachelor_div.'</td>
        <td>'.$bachelor_subjects.'</td>

    </tr>
 

   
</table>
    <h2 style="text-align:center;text-decoration: underline;"> UNDERTAKING</h2>                           

 <ol>
                                <li>I declare that I am not a member of any political party and that I shall not indulge in politics as long as I remain a student of the University. I further undertake that I will not challenge the finding/decision of Head of the Institution regarding my rustication/Expulsion from the University or cancellation of my admission at any stage whatsoever in any Court. Tribunal, Authority or Forum other than the Supreme Court of Pakistan.</li>
                                <li>I further undertake that I shall not claim hostel accommodation as a matter pf right.</li>
                                <li>I hereby certify that I have myself filled in this Form and the statements made herein are correct.</li>
                                <li>I hereby declare on oath that I have not been in the rolls of any teaching department of the University or Constituent college or an affiliated college of postgraduate studies (Master`s level of Law) for more than six months.</li>
                                <li>I hereby declare that I have not obtained B.A/BS/BBA/BCS/BFA in case of admission of Bachelor Degree program. MA/M.Sc./M. Com./MBA in case of admission of Master Degree or equivalent degree from any University.</li>
                                <li style="color:red;"><b>Note:</b> Items 4 & 5 are not applicable to MS/M.Phil. and Ph.D. candidates.</li>
                                <h2 style="text-align:center;">Requirements</h2>
                                <li>Copy of Student CNIC/B-form and Domicile</li>
                                <li>Copy of Father CNIC</li>
                                <li>One Copy of Academic Documents (Matric, FSc etc.)</li>
                                 <li style="color:red;"><b>Important Note: </b> After printing your form you must submit your hard copy along with attached documents to Admission Desk of Ghazi University, City Campus (College Chowk). Only hard copy will be entertained for Admission. </li>
                              </ol>

                              <div style="text-align:center">
                              <pre>
       -----------------------      ---------------------------
       Student Signature            Signature of Father/Guardian


       -----------------------      ---------------------------
        Dated                           Dated

        Father / Guardian CNIC -------------------------------
                              </pre>
                              </div>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
  // QRCODE,L : QR-CODE Low error correction
$pdf->Text(160, 165, 'QRCODE - GUDGK');

$pdf->Text(160, 165, 'QRCODE - GUDGK');

$pdf->write2DBarcode(base_url().'/admin/msc_student_profile?id='.base64_encode($get_data2->ID), 'QRCODE,H', 170, 170, 30, 30, $style, 'N');


$html1='<br><hr /><div>
<h2 style="text-align:center;">Student slip</h2>
<p style="color:red;text-align:center;">For office use only</p> 

<table>
<tr>
<th><b>Application No </b></th>
<td>MSC'.$get_data2->ID.'</td>
<th><b>Student Name </b></th>
<td>'.$get_data2->sname.'</td>
<th><b>Program </b></th>
<td>'.$get_data2->st_program.'</td>
</tr><tr><td>.</td></tr>

</table> </div><br>';
$pdf->writeHTML($html1, true, false, true, false, '');
$pdf->Text(170, 200, 'QRCODE-GUDGK');

$pdf->write2DBarcode(base_url().'/admin/msc_student_profile?id='.base64_encode($get_data2->ID), 'QRCODE,H', 180, 205, 20, 20, $style, 'N');


$html2='<br><br><br><br><hr><div>
<h4 style="text-align:center; padding-top:10px;">Student slip</h4>
<table>
<br>
<tr>
<th><b>Application No </b></th>
<td>MSC'.$get_data2->ID.'</td>
<th><b>Student Name </b></th>
<td>'.$get_data2->sname.'</td>
</tr>
<tr>
<th><b>Program </b></th>
<td colspan="2">'.$get_data2->st_program.'</td>
</tr>
<tr>
<th><b>CNIC </b></th>
<td colspan="2">'.$get_data2->cnic.'</td>
</tr></table> </div><br>';
$pdf->writeHTML($html2, true, false, true, false, '');
$pdf->Text(170, 240, 'QRCODE-GUDGK');

$pdf->write2DBarcode(base_url().'/admin/msc_student_profile?id='.base64_encode($get_data2->ID), 'QRCODE,H', 180, 245, 20, 20, $style, 'N');
// output the HTML content

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// reset pointer to the last page
$pdf->lastPage();
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('registrationform.pdf', 'I');
$from="admission@gudgk.edu.pk";
$name="Ghazi University Dera Ghazi Khan";
$toEmail=$email;
$subject="Congratulations Message";
$msg="Hi ".$sname."Your application at Ghazi university DGK has been submittedd successfully with id number ".$get_data2->ID;
$this->smtp_email->send($from,$name,$toEmail,$subject,$msg);

      }
    }
    }
    
  }

      }

      
}

  }

    function check_overage(){

    if(isset($_POST['user_active'])){

      
          $dob = $_POST['dob'];
          $program = str_replace('_', ' ', $_POST['program']);
          $c_date=date('Y-m-d');
          $_age = floor((time() - strtotime($dob)) / 31556926);
          if ($program =='BS' || $program =='BSc (Hons) Agriculture' || $program =='BS Environmental Science' || $program =='BS English' || $program =='BS Islam Studies' || $program =='BS-IT' || $program =='BS Urdu' || $program =='BS History' || $program =='BS Political Science' || $program =='BS Pakistan Studies' || $program =='BBA (Hons) 4 years' || $program =='BS Economics' || $program =='BS Education' || $program =='BS Sociology' || $program =='BS Botany' || $program =='BS Chemistry' || $program =='BS Mathematics' || $program =='BS Physics' || $program =='BS Statistics' || $program =='BS Zoology' AND $_age > 26) {
            echo $_age;
          }
          elseif ($program =='MA English' || $program =='MA Islamic Studies' || $program =='MA Urdu' || $program =='MA History' || $program =='MA Political Science' || $program =='MA Pakistan Studies' || $program =='MSc Economics' || $program =='BBA (2 Year)' || $program =='MA Education' || $program =='MSc Sociology' || $program =='M.Sc. Botany' || $program =='M.Sc. Chemistry' || $program =='MCS' || $program =='M.Sc. Mathematics' || $program =='M.Sc. Physics' || $program =='M.Sc. Statistics' || $program =='M.Sc. Zoology' AND $_age > 30) {
            echo $_age;
          }
          else{
            echo 0;
          }
          
          




          }    
  }
    function validate_challan(){

    if(isset($_POST['user_active'])){

      
          $challan = $_POST['challan'];
          $check_bs=$this->db->query("SELECT * FROM `tbl_bs_students` WHERE challan='$challan'")->num_rows();
          $check_msc=$this->db->query("SELECT * FROM `tbl_msc_students` WHERE challan='$challan'")->num_rows();
          $check_ms=$this->db->query("SELECT * FROM `tbl_ms_students` WHERE challan='$challan'")->num_rows();
          if ($check_bs >0 || $check_msc>0 || $check_ms>0) {
            echo 0;
          }
          else{
            echo 1;
          }
          




          }    
  }


  function get_programs(){
      if(isset($_POST['post_active'])){

      
          $depart = str_replace('_',' ',$_POST['depart']);
          $appfor = $this->session->userdata("active_program");

          $get_pininfo = $this->db->query("SELECT * FROM tbl_department_programs WHERE Program_name LIKE '%$depart%'")->row();

          $html = '
            <option value="" selected hidden>Select Department</option>';

         
           // if($get_pininfo->num_rows() > 0){
     
           $html .= '<option value='.str_replace(' ','_',$get_pininfo->Department_name).'>'.$get_pininfo->Department_name.'</option>';
         // }
          
         

          // $a=str_replace('_', ' ', $depart);

          // $get_pininfo = $this->db->query("SELECT * FROM tbl_department_programs WHERE Department_name = '$a'");
            if ($depart=='B.Ed') {
             
           $html .= '<option value='.str_replace(' ','_','Department of Education').'>Department of Education</option>';
                        
                        

         }
          


          // if($get_pininfo->num_rows() > 0){

          //  $get_pininfo = $get_pininfo->result();

            

                    // foreach($get_pininfo as $row){

                        
                        

                    // }



                   echo  $html;

          // }
          // else{
          //  echo 0;
          // }

            


          }
  }


    function get_departments(){
      if(isset($_POST['post_active'])){

      
          $depart = $_POST['progs'];
         $this->session->set_userdata("active_program",$depart);
          // echo 0;
          // exit();
       

          $get_pininfo = $this->db->query("SELECT * FROM tbl_department_programs WHERE Program_name LIKE '%$depart%'");


          if($get_pininfo->num_rows() > 0){

            $get_pininfo = $get_pininfo->result();

            $html = '
            <option value="" selected hidden>Select Program</option>';

                    foreach($get_pininfo as $row){

                        $html .= '<option value='.str_replace(' ','_',$row->Program_name).'>'.$row->Program_name.'</option>';

                        
                        

                    }
          if ($depart=='BS') {
             $html .= '<option value='.str_replace(' ','_','BBA (Hons) 4 years').'>BBA (Hons) 4 years</option>';

           }

             

           
                      if ($depart=='M.Sc') {
             $html .= '<option value="MCS">MCS</option>';
              $get_pininfo1 = $this->db->query("SELECT * FROM tbl_department_programs WHERE Program_name LIKE '%MA %'");
             if($get_pininfo1->num_rows() > 0){

                 $get_pininfo1 = $get_pininfo1->result();
                  foreach($get_pininfo1 as $row1){
                  $html .= '<option value='.str_replace(' ','_',$row1->Program_name).'>'.$row1->Program_name.'</option>';

         }
       }
        $html .= '<option value='.str_replace(' ','_','BBA (2 years)').'>BBA(2 years)</option>';
           }

                   
                   echo  $html;
                    
                       }

                                   if ($depart=='B.Ed') {
           $html=' <option value="" selected hidden>Select Program</option>';

             $html .= '<option value="B.Ed">B.Ed</option>';
                   echo  $html;


           }

              

                    //     if ($depart =='M.Sc') {
                    //    $html .= '<option value='.str_replace(' ','_','Department of CS & IT').'>'.'Department of CS & IT'.'</option>';
                    //    $get_pininfo1 = $this->db->query("SELECT * FROM tbl_department_programs WHERE Program_name LIKE '%M.A%'");
                    //     if($get_pininfo1->num_rows() > 0){

                    //     $get_pininfo1 = $get_pininfo1->result();
                    //     foreach($get_pininfo1 as $row1){

                    //     $html .= '<option value='.str_replace(' ','_',$row1->Department_name).'>'.$row1->Department_name.'</option>';

                        
                        

                    // }

                    // }




          // }
          else{
            echo 0;
          }

            


          }
  }
  public function check_stat()
  {
    $this->load->view('form/check_status');
  }
  public function check_status()
  {
    if ($this->input->post('search')) {
     $cnic=$this->input->post('cnic');
     $data['bs']=$this->Form_model->check_status_bs($cnic);
     $data['msc']=$this->Form_model->check_status_msc($cnic);
     $data['ms']=$this->Form_model->check_status_ms($cnic);
     $this->load->view('form/status',$data);
    }
   
  }
   public function exportCSV(){
        // get data
        $myData = $this->db->query("SELECT * FROM `tbl_active_members` INNER JOIN tbl_admin ON tbl_active_members.admin_id=tbl_admin.ID LIMIT 5")->result();
 
        // file name
        $filename = 'mydata_'.date('Ymd').'.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
 
        // file creation
        $file = fopen('php://output', 'w');
 
        $header = array("Column 1","Column 2","Column 3");
        fputcsv($file, $header);
 
        foreach ($myData as $line){
            fputcsv($file,array($line->admin_id,$line->activit_details,$line->activit_time));
        }
 
        fclose($file);
        exit;
    }


}


?>