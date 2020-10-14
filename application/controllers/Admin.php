<?php
/**
 * 
 */
class Admin extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
    $this->load->library('Pdf');

	}

	public function index()
	{
		if (!empty($this->session->userdata('active_admin'))) {
			redirect('admin/dashboard');
		}
		else{
		$this->load->view('admin/login');
	}

		
	}
	function dashboard(){
		if (!empty($this->session->userdata('active_admin'))) {
			if ($this->session->userdata('active_admin_username')=='mrehmani@gudgk.edu.pk' || $this->session->userdata('active_admin_username')=='dr.rehmani.mia@hotmail.com' || $this->session->userdata('active_admin_username')=='hod.ses@gudgk.edu.pk') {
		redirect('admin/test1');
	}
			if ($this->session->userdata('active_admin_depart')=='admin') {
	$data['bs_apps']=$this->db->query("SELECT * FROM `tbl_bs_students`")->num_rows();
	$data['ms_apps']=$this->db->query("SELECT * FROM `tbl_ms_students`")->num_rows();
	$data['msc_apps']=$this->db->query("SELECT * FROM `tbl_msc_students`")->num_rows();
	
	$data['bs_apps1']=$this->db->query("SELECT DISTINCT(cnic) FROM `tbl_bs_students`")->num_rows();
	$data['ms_apps1']=$this->db->query("SELECT DISTINCT(cnic) FROM `tbl_ms_students`")->num_rows();
	$data['msc_apps1']=$this->db->query("SELECT DISTINCT(cnic) FROM `tbl_msc_students`")->num_rows();
// 	print_r($data['bs_apps1']+$data['ms_apps1']+$data['msc_apps1']);
// 	exit();
}
else{
	$dpt=$this->session->userdata('active_admin_depart');
	$data['bs_apps']=$this->db->query("SELECT * FROM `tbl_bs_students` WHERE department='$dpt'")->num_rows();
	$data['ms_apps']=$this->db->query("SELECT * FROM `tbl_ms_students` WHERE department='$dpt'")->num_rows();
	$data['msc_apps']=$this->db->query("SELECT * FROM `tbl_msc_students` WHERE department='$dpt'")->num_rows();
	
		$data['bs_apps1']=$this->db->query("SELECT DISTINCT(cnic) FROM `tbl_bs_students` WHERE department='$dpt'")->num_rows();
	$data['ms_apps1']=$this->db->query("SELECT DISTINCT(cnic) FROM `tbl_ms_students` WHERE department='$dpt'")->num_rows();
	$data['msc_apps1']=$this->db->query("SELECT DISTINCT(cnic) FROM `tbl_msc_students` WHERE department='$dpt'")->num_rows();

}
	if ($this->session->userdata('active_admin_depart')=='admin') {
		
		$bs=$this->db->query("SELECT * FROM `tbl_bs_students` WHERE status IN (1,2,3,4)")->num_rows();
		$msc=$this->db->query("SELECT * FROM `tbl_msc_students` WHERE status IN (1,2,3,4)")->num_rows();
		$ms=$this->db->query("SELECT * FROM `tbl_ms_students` WHERE status IN (1,2,3,4)")->num_rows();

		$data['total_apps_submitted']=$bs+$msc+$ms;
		$data['total_apps_not_submitted']=($data['bs_apps']+$data['ms_apps']+$data['msc_apps'])-$data['total_apps_submitted'];
		
	}
	else{
		$dpt=$this->session->userdata('active_admin_depart');
		
		$bs=$this->db->query("SELECT * FROM `tbl_bs_students` WHERE department='$dpt' AND status IN (1,2,3,4)")->num_rows();
		$msc=$this->db->query("SELECT * FROM `tbl_msc_students` WHERE department='$dpt' AND status IN (1,2,3,4)")->num_rows();
		$ms=$this->db->query("SELECT * FROM `tbl_ms_students` WHERE department='$dpt' AND status IN (1,2,3,4)")->num_rows();

		$data['total_apps_submitted']=$bs+$msc+$ms;
		$data['total_apps_not_submitted']=($data['bs_apps']+$data['ms_apps']+$data['msc_apps'])-$data['total_apps_submitted'];
	}
	$data['active_members']=$this->admin_model->active_members();
	$data['activity']=$this->admin_model->activity_details();


			
			$this->load->view('admin/dashboard',$data);
		
		}
		else{
			redirect('admin');
		}
	}
	public function login()
	{
		if ($this->input->post('login')) {
			$username=$this->input->post('username');
			$password=base64_encode($this->input->post('password'));
			
			$a=$this->admin_model->login($username,$password);
			if ($a) {
				
				redirect('admin/dashboard');			}
		}
	}
	public function department()
	{
		if (!empty($this->session->userdata('active_admin'))) {
		$data['departments']=$this->admin_model->departments();
		$this->load->view('admin/department',$data);
		}
		else{
			redirect('admin');
		}
	}
	public function add_department()
	{
		if (!empty($this->session->userdata('active_admin'))) {
		$this->load->view('admin/add_department');
		}
		else{
			redirect('admin');
		}
	}
	function add_depart(){
		if (isset($_POST['sub'])) {
		$department_Name=$_POST['dep_name'];
		$program_Name=$_POST['prg_name'];

		$added=$this->db->query("INSERT INTO `tbl_department_programs`(`Department_name`, `Program_name`) VALUES ('$department_Name','$program_Name')");
		if ($added) {
			echo 'added';
		}
		
	}
	}
	function delete_depart(){
			if (!empty($this->session->userdata('active_admin'))) {
		$id=$_GET['id'];

		$deleted=$this->db->query("DELETE FROM `tbl_department_programs` WHERE ID='$id'");
		if ($deleted) {
				$this->session->set_flashdata('success','Department deleted Successfully');
		}
		}
		else{
			redirect('admin');
		}
		
	}
	function update_depart(){
		if (isset($_POST['update'])) {
		$id=$_POST['id'];
		$department_Name=$_POST['department'];
		$program_Name=$_POST['program'];

		$updated=$this->db->query("UPDATE `tbl_department_programs`SET Department_name='$department_Name',Program_name='$program_Name' WHERE ID='$id'");
		if ($updated) {
				$this->session->set_flashdata('success','Department Updated Successfully');
		}
		
	}
	}
	public function bs_student_profile()
	{
		if (!empty($this->session->userdata('active_admin')) & $this->session->userdata('active_admin_depart')=='admin') {
		$id=base64_decode($this->input->get('id'));
		$changed['get_data']=$this->admin_model->bs_student_profile_change_status($id);
		if ($changed['get_data']) {
		
			$get_data=$this->db->query("SELECT * FROM tbl_bs_students  WHERE ID='$id'")->row();
			
		$this->load->library('Pdf');

	$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

			   // set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Kamran Hyder');
$pdf->SetTitle('GUDGK Registration 2020');
$pdf->SetSubject('Application form 2020');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data;
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Ghazi University, Dera Ghazi Khan                                                                                             2020');

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

// $html='<h3>Kami khan</h3>';

$html = '<h3 style="padding-left: 30px;">
		Application No:  &nbsp;<span style="text-decoration: underline;">BS'.$get_data->ID.'</span>
	</h3>
	<h1 style="text-transform: uppercase; text-align: center; font-family: helvetia;">Ghazi University, Dera Ghazi khan</h1>
	<h2 style="text-align: center;">Application for Admission 2020</h2>
	<div>
  <table style="text-align:center;">
  <tr>
  <td>
  <h1>'.$get_data->department.'</h1>
  <h1>'.$get_data->st_program.'</h1>
  </td>
    <td>
    <img src="assets/profiles/'.$get_data->profile.'" alt="profile" width="100" height="100" border="0" style="float:right;"/>
    </td>
  </tr>
  </table>

  

<div>
   <table style="text-align:center; padding-top:30px;">
<tr>
<th><h3>Student name :</h3></th> 
<td><h3>'.$get_data->sname.'</h3></td>
</tr>
<tr>
<th><h3>Father name :</h3></th> 
<td><h3>'.$get_data->fname.'</h3></td>
</tr>
<tr>
<th><h3>CNIC :</h3></th> 
<td><h3>'.$get_data->cnic.'</h3></td>
</tr>
   </table>
   </div>
   <div style="color:red; text-align:center;">
<h2> Status : Application form recieved</h2>
</div>
</div>
';
$pdf->writeHTML($html, true, false, true, false, '');
// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('registrationform.pdf', 'I');
			redirect('admin');
		}
		}
		else{
			$this->session->set_flashdata('success','Sorry! You do not have permission to change status');
			redirect('admin');
		}
	}
	public function msc_student_profile()
	{
		if (!empty($this->session->userdata('active_admin')) & $this->session->userdata('active_admin_depart')=='admin') {
		$id=base64_decode($this->input->get('id'));
		$changed=$this->admin_model->msc_student_profile_change_status($id);
		if ($changed) {
			$get_data=$this->db->query("SELECT * FROM tbl_msc_students  WHERE ID='$id'")->row();
			
		$this->load->library('Pdf');

	$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

			   // set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Kamran Hyder');
$pdf->SetTitle('GUDGK Registration 2020');
$pdf->SetSubject('Application form 2020');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data;
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Ghazi University, Dera Ghazi Khan                                                                                             2020');

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

// $html='<h3>Kami khan</h3>';

$html = '<h3 style="padding-left: 30px;">
		Application No:  &nbsp;<span style="text-decoration: underline;">M.Sc'.$get_data->ID.'</span>
	</h3>
	<h1 style="text-transform: uppercase; text-align: center; font-family: helvetia;">Ghazi University, Dera Ghazi khan</h1>
	<h2 style="text-align: center;">Application for Admission 2020</h2>
	<div>
  <table style="text-align:center;">
  <tr>
  <td>
  <h1>'.$get_data->department.'</h1>
  <h1>'.$get_data->st_program.'</h1>
  </td>
    <td>
    <img src="assets/profiles/'.$get_data->profile.'" alt="profile" width="100" height="100" border="0" style="float:right;"/>
    </td>
  </tr>
  </table>
  <div>
   <table style="text-align:center; padding-top:30px;">
<tr>
<th><h3>Student name :</h3></th> 
<td><h3>'.$get_data->sname.'</h3></td>
</tr>
<tr>
<th><h3>Father name :</h3></th> 
<td><h3>'.$get_data->fname.'</h3></td>
</tr>
<tr>
<th><h3>CNIC :</h3></th> 
<td><h3>'.$get_data->cnic.'</h3></td>
</tr>
   </table>
   </div>
   <div style="color:red; text-align:center;">
<h2> Status : Application form recieved</h2>
</div>
</div>';
$pdf->writeHTML($html, true, false, true, false, '');
// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('registrationform.pdf', 'I');
			
			redirect('admin');
		}
		}
		else{
			$this->session->set_flashdata('success','Sorry! You do not have permission to change status');
			redirect('admin');
		}
	}
	public function ms_student_profile()
	{
		if (!empty($this->session->userdata('active_admin')) & $this->session->userdata('active_admin_depart')=='admin') {
		$id=base64_decode($this->input->get('id'));
		$changed=$this->admin_model->ms_student_profile_change_status($id);
		if ($changed) {
			$get_data=$this->db->query("SELECT * FROM tbl_ms_students  WHERE ID='$id'")->row();
			
		$this->load->library('Pdf');

	$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

			   // set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Kamran Hyder');
$pdf->SetTitle('GUDGK Registration 2020');
$pdf->SetSubject('Application form 2020');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data;
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Ghazi University, Dera Ghazi Khan                                                                                             2020');

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

// $html='<h3>Kami khan</h3>';

$html = '<h3 style="padding-left: 30px;">
		Application No:  &nbsp;<span style="text-decoration: underline;">MS'.$get_data->ID.'</span>
	</h3>
	<h1 style="text-transform: uppercase; text-align: center; font-family: helvetia;">Ghazi University, Dera Ghazi khan</h1>
	<h2 style="text-align: center;">Application for Admission 2020</h2>
	<div>
  <table style="text-align:center;">
  <tr>
  <td>
  <h1>'.$get_data->department.'</h1>
  <h1>'.$get_data->st_program.'</h1>
  </td>
    <td>
    <img src="assets/profiles/'.$get_data->profile.'" alt="profile" width="100" height="100" border="0" style="float:right;"/>
    </td>
  </tr>
  </table>
  <div>
   <table style="text-align:center; padding-top:30px;">
<tr>
<th><h3>Student name :</h3></th> 
<td><h3>'.$get_data->sname.'</h3></td>
</tr>
<tr>
<th><h3>Father name :</h3></th> 
<td><h3>'.$get_data->fname.'</h3></td>
</tr>
<tr>
<th><h3>CNIC :</h3></th> 
<td><h3>'.$get_data->cnic.'</h3></td>
</tr>
   </table>
   </div>
   <div style="color:red; text-align:center;">
<h2> Status : Application form recieved</h2>
</div>
</div>';
$pdf->writeHTML($html, true, false, true, false, '');
// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('registrationform.pdf', 'I');
			
			redirect('admin');
			
		}
		}
		else{
			$this->session->set_flashdata('success','Sorry! You do not have permission to change status');
			redirect('admin');
		}
	}
	function bs_students(){
		if (!empty($this->session->userdata('active_admin'))) {
		$result['bs']=$this->admin_model->bs_students();
		$this->load->view('admin/applications/bs',$result);
		}
		else{
			redirect('admin');
		}
	}
	function msc_students(){
		if (!empty($this->session->userdata('active_admin'))) {
		$result['msc']=$this->admin_model->msc_students();
		$this->load->view('admin/applications/msc',$result);
		}
		else{
			redirect('admin');
		}
	}
	function ms_students(){
		if (!empty($this->session->userdata('active_admin'))) {
		$result['ms']=$this->admin_model->ms_students();
		$this->load->view('admin/applications/ms',$result);
		}
		else{
			redirect('admin');
		}
	}
	function genrate_list(){
		if (!empty($this->session->userdata('active_admin'))) {
		$data['departments']=$this->admin_model->unique_departments();
		$this->load->view('admin/generate-list',$data);
		}
		else{
			redirect('admin');
		}
	}
	function update_bs_student_status(){
		if($this->input->post()){
			$id=$this->input->post('id');
			$status=$this->input->post('status');
			$changed=$this->admin_model->update_bs_student_status($id,$status);
			if ($changed) {
				redirect('admin');
			}

		}
	}
	function update_msc_student_status(){
		if($this->input->post()){
			$id=$this->input->post('id');
			$status=$this->input->post('status');
			$changed=$this->admin_model->update_msc_student_status($id,$status);
			if ($changed) {
				redirect('admin/msc_students');
			}

		}
	}
	function update_ms_student_status(){
		if($this->input->post()){
			$id=$this->input->post('id');
			$status=$this->input->post('status');
			$changed=$this->admin_model->update_ms_student_status($id,$status);
			if ($changed) {
				redirect('admin/ms_students');
			}

		}
	}
public function test()
{
$from="admission@gudgk.edu.pk";
$name="Ghazi University Dera Ghazi Khan";
$toEmail='kamrankhosa40@gmail.com';
$subject="Congratulations Message";
$msg='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Tuition Tutee</title>
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
                                                <h3 style="color: #59b2e6;">Congratulations Kamran Hyder! </h3>
                                                <h4 style="color: black">Your application has been submitted successfully with id <b>542</b> at <a href="https://www.gudgk.edu.pk/">GUDGK</a>.</h4>
                                                
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
$this->load->library('smtp_email');
$this->smtp_email->send($from,$name,$toEmail,$subject,$msg);
}
function add_user(){
	if (!empty($this->session->userdata('active_admin'))) {
	$data['departments']=$this->admin_model->departments();
	$this->load->view('admin/add_staff',$data);
}
else{
	redirect('admin');
}
}
function adding_user(){
	if (isset($_POST['sub'])) {
		$department_Name=$_POST['dep_name'];
		$userName=$_POST['Name'];
		$Password=base64_encode($_POST['Password']);

		$added=$this->db->query("INSERT INTO `tbl_admin`(`username`, `Password`, `Department`, `Role`) VALUES ('$userName','$Password','$department_Name','2')");
		if ($added) {
			$this->session->set_flashdata('success','User added successfully.');
		redirect('admin/add_user');

		}
		
	}

}
public function forget_password()
{
	if ($this->input->post('forget')) {
		$email=$this->input->post('email');
		$this->admin_model->forget_password($email);
	}
}
public function form_not_submitted()
{
		if (!empty($this->session->userdata('active_admin'))) {
	$data['bs']=$this->admin_model->form_not_submitted_bs();
	$data['ms']=$this->admin_model->form_not_submitted_ms();
	$data['msc']=$this->admin_model->form_not_submitted_msc();
	$this->load->view('admin/form_not_submitted',$data);
}
else{
	redirect('admin');
}
}
public function form_submitted()
{
		if (!empty($this->session->userdata('active_admin'))) {
	$data['bs']=$this->admin_model->form_submitted_bs();
	$data['ms']=$this->admin_model->form_submitted_ms();
	$data['msc']=$this->admin_model->form_submitted_msc();
	$this->load->view('admin/form_submitted',$data);
}
else{
	redirect('admin');
}
}
function print_msc_file(){
	$id=base64_decode($_GET['id']);
	$get_data2=$this->db->query("SELECT * FROM tbl_msc_students WHERE ID='$id'")->row();
	$dob=$get_data2->dob;
	 $c_date=date('Y-m-d');
          $_age = floor((time() - strtotime($dob)) / 31556926);
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
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Challan No: ', $get_data2->challan.'                                                                                                          Dated: '.$get_data2->challan_date);

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
  <h1>'.$get_data2->department.'</h1>
  <h1>'.$get_data2->st_program.'</h1>
  <h1>'.$msc_overage.'</h1>
  </td>
    <td>
    <img src="assets/profiles/'.$get_data2->profile.'" alt="profile" width="100" height="100" border="0" style="float:right;"/>
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
                                  <td style="border: 1px solid black; border-collapse: collapse;">'.$get_data2->psession.'</td>
                                  
                                </tr>
                                <tr style="border: 1px solid black; border-collapse: collapse;">
                                  <th style="border: 1px solid black; border-collapse: collapse;">Nominees of</th>
                                  <td style="border: 1px solid black; border-collapse: collapse;">'.$get_data2->applyon.'</td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"></td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"></td>

                                </tr>
                                <tr style="border: 1px solid black; border-collapse: collapse;">
                                  <th style="border: 1px solid black; border-collapse: collapse;">Category</th>
                                  <td style="border: 1px solid black; border-collapse: collapse;">'.$get_data2->category.'</td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"></td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"></td>
                                </tr>
                                
                              </table>
      <div style="text-align:center;">
<h1>Student Personal details</h1>
<table>
<tr>
<td><h4 style="text-align:justify-all"> Student Name :'.$get_data2->sname.'</h4></td>
<td><h4 style="text-align:justify-all"> Gender :'.$get_data2->gender.'</h4></td>
</tr>
<tr>
<td><h4 style="text-align:justify-all"> Father Name :'.$get_data2->fname.'</h4></td>
<td><h4 style="text-align:justify-all"> Profession :'.$get_data2->profession.'</h4></td>
</tr>
<tr>
<td><h4 style="text-align:justify-all"> CNIC / B-Form :'.$get_data2->cnic.'</h4></td>
<td><h4 style="text-align:justify-all"> Hafiz-e-Quran :'.$get_data2->hafiz.'</h4></td>
</tr>
<tr>
<td><h4 style="text-align:justify-all"> Email address :'.$get_data2->email.'</h4></td>
<td><h4 style="text-align:justify-all"> Cell No :'.$get_data2->cellno.'</h4></td>
</tr>
<tr>
<td><h4 style="text-align:justify-all"> Date of Birth :'.$get_data2->dob.'</h4></td>
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
        <td>'.$get_data2->matric_year.'</td>
        <td>'.$get_data2->matric_board.'</td>
        <td>'.$get_data2->matric_rollno.'</td>
        <td>'.$get_data2->matric_omarks.'</td>
        <td>'.$get_data2->matric_tmarks.'</td>
        <td>'.round($get_data2->matric_percentage).' %</td>
        <td>'.$get_data2->matric_div.'</td>
        <td>'.$get_data2->matric_subjects.'</td>
       
        
    </tr>
    <tr>
        <th>FA / F.Sc / Equivalent</th>
        
        <td>'.$get_data2->inter_year.'</td>
        <td>'.$get_data2->inter_board.'</td>
        <td>'.$get_data2->inter_rollno.'</td>
        <td>'.$get_data2->inter_omarks.'</td>
        <td>'.$get_data2->inter_tmarks.'</td>
        <td>'.round($get_data2->inter_percentage).' %</td>
        <td>'.$get_data2->inter_div.'</td>
        <td>'.$get_data2->inter_subjects.'</td>
    </tr>
    <tr>
       <th>BA/B.Sc/BBA/BS/B.Sc(Hons)</th>
        <td>'.$get_data2->bachelor_year.'</td>
        <td>'.$get_data2->bachelor_board.'</td>
        <td>'.$get_data2->bachelor_rollno.'</td>
        <td>'.$get_data2->bachelor_omarks.'</td>
        <td>'.$get_data2->bachelor_tmarks.'</td>
        <td>'.round($get_data2->bachelor_percentage).' %</td>
        <td>'.$get_data2->bachelor_div.'</td>
        <td>'.$get_data2->bachelor_subjects.'</td>

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
function print_bs_file(){
	$id=base64_decode($_GET['id']);
	$get_data2=$this->db->query("SELECT * FROM tbl_bs_students WHERE ID='$id'")->row();
	$dob=$get_data2->dob;
	 $c_date=date('Y-m-d');
          $_age = floor((time() - strtotime($dob)) / 31556926);
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
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Challan No: ', $get_data2->challan.'                                                                                                          Dated: '.$get_data2->challan_date);

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
    Application No: BS'.$get_data2->ID.'&nbsp;<span style="text-decoration: underline;"></span>
  </h3>
  <h1 style="text-transform: uppercase; text-align: center; font-family: helvetia;">Ghazi University, Dera Ghazi khan</h1>
  <h2 style="text-align: center;">Application for Admission 2020</h2>
  <div>
  <table style="text-align:center;">
  <tr>
  <td>
  <h1>'.$get_data2->department.'</h1>
  <h1>'.$get_data2->st_program.'</h1>
  <h1>'.$msc_overage.'</h1>
  </td>
    <td>
    <img src="assets/profiles/'.$get_data2->profile.'" alt="profile" width="100" height="100" border="0" style="float:right;"/>
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
                                  <td style="border: 1px solid black; border-collapse: collapse;">'.$get_data2->psession.'</td>
                                  
                                </tr>
                                <tr style="border: 1px solid black; border-collapse: collapse;">
                                  <th style="border: 1px solid black; border-collapse: collapse;">Nominees of</th>
                                  <td style="border: 1px solid black; border-collapse: collapse;">'.$get_data2->applyon.'</td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"></td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"></td>

                                </tr>
                                <tr style="border: 1px solid black; border-collapse: collapse;">
                                  <th style="border: 1px solid black; border-collapse: collapse;">Category</th>
                                  <td style="border: 1px solid black; border-collapse: collapse;">'.$get_data2->category.'</td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"></td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"></td>
                                </tr>
                                
                              </table>
      <div style="text-align:center;">
<h1>Student Personal details</h1>
<table>
<tr>
<td><h4 style="text-align:justify-all"> Student Name :'.$get_data2->sname.'</h4></td>
<td><h4 style="text-align:justify-all"> Gender :'.$get_data2->gender.'</h4></td>
</tr>
<tr>
<td><h4 style="text-align:justify-all"> Father Name :'.$get_data2->fname.'</h4></td>
<td><h4 style="text-align:justify-all"> Profession :'.$get_data2->profession.'</h4></td>
</tr>
<tr>
<td><h4 style="text-align:justify-all"> CNIC / B-Form :'.$get_data2->cnic.'</h4></td>
<td><h4 style="text-align:justify-all"> Hafiz-e-Quran :'.$get_data2->hafiz.'</h4></td>
</tr>
<tr>
<td><h4 style="text-align:justify-all"> Email address :'.$get_data2->email.'</h4></td>
<td><h4 style="text-align:justify-all"> Cell No :'.$get_data2->cellno.'</h4></td>
</tr>
<tr>
<td><h4 style="text-align:justify-all"> Date of Birth :'.$get_data2->dob.'</h4></td>
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
        <td>'.$get_data2->matric_year.'</td>
        <td>'.$get_data2->matric_board.'</td>
        <td>'.$get_data2->matric_rollno.'</td>
        <td>'.$get_data2->matric_omarks.'</td>
        <td>'.$get_data2->matric_tmarks.'</td>
        <td>'.round($get_data2->matric_percentage).' %</td>
        <td>'.$get_data2->matric_div.'</td>
        <td>'.$get_data2->matric_subjects.'</td>
       
        
    </tr>
    <tr>
        <th>FA / F.Sc / Equivalent</th>
        
        <td>'.$get_data2->inter_year.'</td>
        <td>'.$get_data2->inter_board.'</td>
        <td>'.$get_data2->inter_rollno.'</td>
        <td>'.$get_data2->inter_omarks.'</td>
        <td>'.$get_data2->inter_tmarks.'</td>
        <td>'.round($get_data2->inter_percentage).' %</td>
        <td>'.$get_data2->inter_div.'</td>
        <td>'.$get_data2->inter_subjects.'</td>
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
<td>BS'.$get_data2->ID.'</td>
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
<td>BS'.$get_data2->ID.'</td>
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
function print_ms_file(){
	$id=base64_decode($_GET['id']);
	$get_data2=$this->db->query("SELECT * FROM tbl_ms_students WHERE ID='$id'")->row();
	$gat_data=$this->db->query("SELECT * FROM tbl_gat_data WHERE student_id='$id'")->row();

	$dob=$get_data2->dob;
	 $c_date=date('Y-m-d');
          $_age = floor((time() - strtotime($dob)) / 31556926);
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
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Challan No: ', $get_data2->challan.'                                                                                                          Dated: '.$get_data2->challan_date);
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
    Application No: MS'.$get_data2->ID.'&nbsp;<span style="text-decoration: underline;"></span>
  </h3>
  <h1 style="text-transform: uppercase; text-align: center; font-family: helvetia;">Ghazi University, Dera Ghazi khan</h1>
  <h2 style="text-align: center;">Application for Admission 2020</h2>
  <div>
  <table style="text-align:center;">
  <tr>
  <td>
  <h1>'.$get_data2->department.'</h1>
  <h1>'.$get_data2->st_program.'</h1>
  <h1>'.$msc_overage.'</h1>
  </td>
    <td>
    <img src="assets/profiles/'.$get_data2->profile.'" alt="profile" width="100" height="100" border="0" style="float:right;"/>
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
                                  <td style="border: 1px solid black; border-collapse: collapse;">'.$get_data2->psession.'</td>
                                  
                                </tr>
                                <tr style="border: 1px solid black; border-collapse: collapse;">
                                  <th style="border: 1px solid black; border-collapse: collapse;">Nominees of</th>
                                  <td style="border: 1px solid black; border-collapse: collapse;">'.$get_data2->applyon.'</td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"></td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"></td>

                                </tr>
                                <tr style="border: 1px solid black; border-collapse: collapse;">
                                  <th style="border: 1px solid black; border-collapse: collapse;">Category</th>
                                  <td style="border: 1px solid black; border-collapse: collapse;">'.$get_data2->category.'</td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"></td>
                                  <td style="border: 1px solid black; border-collapse: collapse;"></td>
                                </tr>
                                
                              </table>
      <div style="text-align:center;">
<h1>Student Personal details</h1>
<table>
<tr>
<td><h4 style="text-align:justify-all"> Student Name :'.$get_data2->sname.'</h4></td>
<td><h4 style="text-align:justify-all"> Gender :'.$get_data2->gender.'</h4></td>
</tr>
<tr>
<td><h4 style="text-align:justify-all"> Father Name :'.$get_data2->fname.'</h4></td>
<td><h4 style="text-align:justify-all"> Profession :'.$get_data2->profession.'</h4></td>
</tr>
<tr>
<td><h4 style="text-align:justify-all"> CNIC / B-Form :'.$get_data2->cnic.'</h4></td>
<td><h4 style="text-align:justify-all"> Hafiz-e-Quran :'.$get_data2->hafiz.'</h4></td>
</tr>
<tr>
<td><h4 style="text-align:justify-all"> Email address :'.$get_data2->email.'</h4></td>
<td><h4 style="text-align:justify-all"> Cell No :'.$get_data2->cellno.'</h4></td>
</tr>
<tr>
<td><h4 style="text-align:justify-all"> Date of Birth :'.$get_data2->dob.'</h4></td>
<td><h4 style="text-align:justify-all"> GAT Attempted :'.$gat_data->attempted.'</h4></td>
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
        <td>'.$get_data2->matric_year.'</td>
        <td>'.$get_data2->matric_board.'</td>
        <td>'.$get_data2->matric_rollno.'</td>
        <td>'.$get_data2->matric_omarks.'</td>
        <td>'.$get_data2->matric_tmarks.'</td>
        <td>'.round($get_data2->matric_percentage).' %</td>
        <td>'.$get_data2->matric_div.'</td>
        <td>'.$get_data2->matric_subjects.'</td>
       
        
    </tr>
    <tr>
        <th>FA / F.Sc / Equivalent</th>
        
        <td>'.$get_data2->inter_year.'</td>
        <td>'.$get_data2->inter_board.'</td>
        <td>'.$get_data2->inter_rollno.'</td>
        <td>'.$get_data2->inter_omarks.'</td>
        <td>'.$get_data2->inter_tmarks.'</td>
        <td>'.round($get_data2->inter_percentage).' %</td>
        <td>'.$get_data2->inter_div.'</td>
        <td>'.$get_data2->inter_subjects.'</td>
    </tr>
    <tr>
       <th>BA/B.Sc/BBA/BS/B.Sc(Hons)</th>
        <td>'.$get_data2->bachelor_year.'</td>
        <td>'.$get_data2->bachelor_board.'</td>
        <td>'.$get_data2->bachelor_rollno.'</td>
        <td>'.$get_data2->bachelor_omarks.'</td>
        <td>'.$get_data2->bachelor_tmarks.'</td>
        <td>'.round($get_data2->bachelor_percentage).' %</td>
        <td>'.$get_data2->bachelor_div.'</td>
        <td>'.$get_data2->bachelor_subjects.'</td>

    </tr>
     <tr>
       <th>MA/M.Sc</th>
        <td>'.$get_data2->master_year.'</td>
        <td>'.$get_data2->master_board.'</td>
        <td>'.$get_data2->master_rollno.'</td>
        <td>'.$get_data2->master_omarks.'</td>
        <td>'.$get_data2->master_tmarks.'</td>
        <td>'.round($get_data2->master_percentage).' %</td>
        <td>'.$get_data2->master_div.'</td>
        <td>'.$get_data2->master_subjects.'</td>

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
<td>MS'.$get_data2->ID.'</td>
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
<td>MS'.$get_data2->ID.'</td>
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
function today_list(){
	$data['departments']=$this->admin_model->unique_departments();
	$this->load->view('admin/today_list',$data);
}
function today_record(){
	if ($this->input->post('sub')) {
		$dpt=$this->input->post('dep_name');
		$dep_program=$this->input->post('dep_program');
		$n=0;
		$data=$this->admin_model->today_record($dpt,$dep_program);


			$this->load->library('Pdf');

	$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

			   // set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Kamran Hyder');
$pdf->SetTitle('GUDGK Registration 2020');
$pdf->SetSubject('Application form 2020');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data;
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Ghazi University, Dera Ghazi Khan                                                                                             2020');

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

// $html='<h3>Kami khan</h3>';

$html = '
	<h1 style="text-transform: uppercase; text-align: center; font-family: helvetia;">Ghazi University, Dera Ghazi khan</h1>
	<h2 style="text-align: center;">'.$dpt.'</h2>
	<div>
 
  <div>
   <table style="text-align:center;border:1px solid black; border-collapse: collapse;">
<tr style="border:1px solid black;">
<th style="border:1px solid black;"><h3>Sr.No</h3></th> 
<th style="border:1px solid black;"><h3>Reg. id </h3></th> 
<th style="border:1px solid black;"><h3>Student name </h3></th> 
<th style="border:1px solid black;"><h3>Father name </h3></th> 
<th style="border:1px solid black;"><h3>CNIC </h3></th> 
<th style="border:1px solid black;"><h3>Program </h3></th> 

</tr>';


foreach ($data as $value) {
	
	$html.='<tr style="border:1px solid black;">
<td style="border:1px solid black;">'.++$n.'</td> 
<td style="border:1px solid black;">'.$value->ID.'</td> 
<td style="border:1px solid black;">'.$value->sname.'</td> 
<td style="border:1px solid black;">'.$value->fname.'</td> 
<td style="border:1px solid black;">'.$value->cnic. '</td> 
<td style="border:1px solid black;">'.$value->st_program. '</td> 

</tr>';
}

$html.='</table>
   </div>
</div>
<div style="text-align:right;">
<h5>Signatue :-----------------------------------</h4>
<h5>Date :'.date('d-m-Y').' </h4>
<h5>Total forms : '.$n.'</h4>

</div>
';

	$pdf->writeHTML($html, true, false, true, false, '');
// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('registrationform.pdf', 'I');
		
		}
	
}
function today_challans(){

		$n=0;
		$data=$this->admin_model->today_challans_bs();
		$data1=$this->admin_model->today_challans_msc();
		$data2=$this->admin_model->today_challans_ms();


			$this->load->library('Pdf');

	$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

			   // set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Kamran Hyder');
$pdf->SetTitle('GUDGK Registration 2020');
$pdf->SetSubject('Application form 2020');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data;
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Ghazi University, Dera Ghazi Khan                                                                                             2020');

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

// $html='<h3>Kami khan</h3>';

$html = '
	<h1 style="text-transform: uppercase; text-align: center; font-family: helvetia;">Ghazi University, Dera Ghazi khan</h1>
	
	<div>
 
  <div>
   <table style="text-align:center;border:1px solid black; border-collapse: collapse;">
<tr style="border:1px solid black;">
<th style="border:1px solid black;"><h3>Sr.No</h3></th> 
<th style="border:1px solid black;"><h3>Reg. id </h3></th> 
<th style="border:1px solid black;"><h3>Student name </h3></th> 
<th style="border:1px solid black;"><h3>Challan No </h3></th> 
<th style="border:1px solid black;"><h3>Branch Code </h3></th> 
<th style="border:1px solid black;"><h3>CNIC </h3></th> 
<th style="border:1px solid black;"><h3>Challan date </h3></th> 

</tr>';


foreach ($data as $value) {
	
	$html.='<tr style="border:1px solid black;">
<td style="border:1px solid black;">'.++$n.'</td> 
<td style="border:1px solid black;">BS'.$value->ID.'</td> 
<td style="border:1px solid black;">'.$value->sname.'</td> 
<td style="border:1px solid black;">'.$value->challan.'</td> 
<td style="border:1px solid black;">'.$value->bank_branch.'</td> 
<td style="border:1px solid black;">'.$value->cnic. '</td> 
<td style="border:1px solid black;">'.$value->challan_date. '</td> 

</tr>';
}
foreach ($data1 as $value1) {
	
	$html.='<tr style="border:1px solid black;">
<td style="border:1px solid black;">'.++$n.'</td> 
<td style="border:1px solid black;">M.Sc'.$value1->ID.'</td> 
<td style="border:1px solid black;">'.$value1->sname.'</td> 
<td style="border:1px solid black;">'.$value1->challan.'</td> 
<td style="border:1px solid black;">'.$value1->bank_branch.'</td> 
<td style="border:1px solid black;">'.$value1->cnic. '</td> 
<td style="border:1px solid black;">'.$value1->challan_date. '</td> 

</tr>';
}
foreach ($data2 as $value2) {
	
	$html.='<tr style="border:1px solid black;">
<td style="border:1px solid black;">'.++$n.'</td> 
<td style="border:1px solid black;">MS'.$value2->ID.'</td> 
<td style="border:1px solid black;">'.$value2->sname.'</td> 
<td style="border:1px solid black;">'.$value2->challan.'</td>
<td style="border:1px solid black;">'.$value2->bank_branch.'</td>  
<td style="border:1px solid black;">'.$value2->cnic. '</td> 
<td style="border:1px solid black;">'.$value2->challan_date. '</td> 

</tr>';
}

$html.='</table>
   </div>
</div>
<div style="text-align:right;">
<h5>Signatue :-----------------------------------</h4>
<h5>Date :'.date('d-m-Y').' </h4>
<h5>Total forms : '.$n.'</h4>

</div>
';

	$pdf->writeHTML($html, true, false, true, false, '');
// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('registrationform.pdf', 'I');
		
		
}
function all_challans(){
	
		$n=0;
		$data=$this->admin_model->all_challans_bs();
		$data1=$this->admin_model->all_challans_msc();
		$data2=$this->admin_model->all_challans_ms();


			$this->load->library('Pdf');

	$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

			   // set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Kamran Hyder');
$pdf->SetTitle('GUDGK Registration 2020');
$pdf->SetSubject('Application form 2020');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data;
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Ghazi University, Dera Ghazi Khan                                                                                             2020');

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

// $html='<h3>Kami khan</h3>';

$html = '
	<h1 style="text-transform: uppercase; text-align: center; font-family: helvetia;">Ghazi University, Dera Ghazi khan</h1>
	
	<div>
 
  <div>
   <table style="text-align:center;border:1px solid black; border-collapse: collapse;">
<tr style="border:1px solid black;">
<th style="border:1px solid black;"><h3>Sr.No</h3></th> 
<th style="border:1px solid black;"><h3>Reg. id </h3></th> 
<th style="border:1px solid black;"><h3>Student name </h3></th> 
<th style="border:1px solid black;"><h3>Challan No </h3></th> 
<th style="border:1px solid black;"><h3>Branch Code </h3></th> 
<th style="border:1px solid black;"><h3>CNIC </h3></th> 
<th style="border:1px solid black;"><h3>Challan date </h3></th> 

</tr>';


foreach ($data as $value) {
	
	$html.='<tr style="border:1px solid black;">
<td style="border:1px solid black;">'.++$n.'</td> 
<td style="border:1px solid black;">BS'.$value->ID.'</td> 
<td style="border:1px solid black;">'.$value->sname.'</td> 
<td style="border:1px solid black;">'.$value->challan.'</td> 
<td style="border:1px solid black;">'.$value->bank_branch.'</td> 
<td style="border:1px solid black;">'.$value->cnic. '</td> 
<td style="border:1px solid black;">'.$value->challan_date. '</td> 

</tr>';
}
foreach ($data1 as $value1) {
	
	$html.='<tr style="border:1px solid black;">
<td style="border:1px solid black;">'.++$n.'</td> 
<td style="border:1px solid black;">M.Sc'.$value1->ID.'</td> 
<td style="border:1px solid black;">'.$value1->sname.'</td> 
<td style="border:1px solid black;">'.$value1->challan.'</td> 
<td style="border:1px solid black;">'.$value1->bank_branch.'</td> 
<td style="border:1px solid black;">'.$value1->cnic. '</td> 
<td style="border:1px solid black;">'.$value1->challan_date. '</td> 

</tr>';
}
foreach ($data2 as $value2) {
	
	$html.='<tr style="border:1px solid black;">
<td style="border:1px solid black;">'.++$n.'</td> 
<td style="border:1px solid black;">MS'.$value2->ID.'</td> 
<td style="border:1px solid black;">'.$value2->sname.'</td> 
<td style="border:1px solid black;">'.$value2->challan.'</td>
<td style="border:1px solid black;">'.$value2->bank_branch.'</td>  
<td style="border:1px solid black;">'.$value2->cnic. '</td> 
<td style="border:1px solid black;">'.$value2->challan_date. '</td> 

</tr>';
}
$html.='</table>
   </div>
</div>
<div style="text-align:right;">
<h5>Signatue :-----------------------------------</h4>
<h5>Date :'.date('d-m-Y').' </h4>
<h5>Total forms : '.$n.'</h4>

</div>
';

	$pdf->writeHTML($html, true, false, true, false, '');
// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('registrationform.pdf', 'I');
		
}

// updated 29-8-2020
function bs_edit_form(){
	if (!empty($this->session->userdata('active_admin'))) {
	$st_id=base64_decode($this->input->get('id'));
	$data['bs_students']=$this->admin_model->get_bs_student_details($st_id);
	$data['departments']=$this->admin_model->unique_departments();
	$data['bs_programs']=$this->admin_model->bs_programs();
	$this->load->view('admin/bs_edit_form',$data);
}
else{
	redirect('admin');
}

}
function msc_edit_form(){
		if (!empty($this->session->userdata('active_admin'))) {
	$st_id=base64_decode($this->input->get('id'));
	$data['mcs_students']=$this->admin_model->get_msc_student_details($st_id);
	$data['departments']=$this->admin_model->unique_departments();
	$data['msc_programs']=$this->admin_model->msc_programs();
	$this->load->view('admin/msc_edit_form',$data);
	}
else{
	redirect('admin');
}

}
function ms_edit_form(){
		if (!empty($this->session->userdata('active_admin'))) {
	$st_id=base64_decode($this->input->get('id'));
	$data['ms_students']=$this->admin_model->get_ms_student_details($st_id);
	$data['departments']=$this->admin_model->unique_departments();
	$data['ms_programs']=$this->admin_model->ms_programs();
	$this->load->view('admin/ms_edit_form',$data);
	}
else{
	redirect('admin');
}

}
function updated_bs_student_details(){
	if ($this->input->post('update')) {

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
      if (!empty($applyon1)) {
        $applyon=$applyon1;
      }
      else{
        $applyon=$applyon2;
      }
      $category1=$this->input->post('category');
      $category2=$this->input->post('category');
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
      $remarks=$this->input->post('remarks');

      // Person to be informed in emergency
      $ep_name=$this->input->post('ep-name');
      $ep_relation=$this->input->post('ep-relation');
      $g_cellno=$this->input->post('g-cellno');
      $address=$this->input->post('address');
      $stay=$this->input->post('stay');
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
      $id=$this->input->post('id');
      if ($inter_percentage <45) {
        redirect('percenterror');
        exit();
      }
      $remarks_added=$this->admin_model->add_remarks($id,$remarks,$applyforcourse);
      if ($remarks_added) {
      	
     $updated_bs_student_success=$this->admin_model->updated_bs_student_success($chalan_date,$Challan,$bank,$branch,$applyforcourse,$psession,$applyon,$category,$department,$st_program,$sname,$gender,$fname,$profession,$m_income,$cnic,$nation,$domile,$religion,$hafiz,$blood_group,$dob,$email,$cellno,$ep_name,$ep_relation,$g_cellno,$address,$stay,$matric_board,$matric_year,$matric_rollno,$matric_omarks,$matric_tmarks,$matric_percentage,$matric_div,$matric_subjects,$inter_board,$inter_year,$inter_rollno,$inter_omarks,$inter_tmarks,$inter_percentage,$inter_div,$inter_subjects,$id);
     if ($updated_bs_student_success) {
     		$this->session->set_flashdata('success','Stusent record updated successfully');
     		redirect('admin');
     }
 }
}
}
function updated_msc_student_details(){
	if ($this->input->post('update')) {

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
      if (!empty($applyon1)) {
        $applyon=$applyon1;
      }
      else{
        $applyon=$applyon2;
      }
      $category1=$this->input->post('category');
      $category2=$this->input->post('category');
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
      $id=$this->input->post('id');
      if ($inter_percentage <45) {
        redirect('percenterror');
        exit();
      }
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
            $remarks=$this->input->post('remarks');
      $bachelor_subjects=implode(',',$this->input->post('bachelor_subjects'));
      $this->admin_model->add_remarks($id,$remarks,$applyforcourse);
     $updated_msc_student_success=$this->admin_model->updated_msc_student_success($chalan_date,$Challan,$bank,$branch,$applyforcourse,$psession,$applyon,$category,$department,$st_program,$sname,$gender,$fname,$profession,$m_income,$cnic,$nation,$domile,$religion,$hafiz,$blood_group,$dob,$email,$cellno,$ep_name,$ep_relation,$g_cellno,$address,$stay,$matric_board,$matric_year,$matric_rollno,$matric_omarks,$matric_tmarks,$matric_percentage,$matric_div,$matric_subjects,$inter_board,$inter_year,$inter_rollno,$inter_omarks,$inter_tmarks,$inter_percentage,$inter_div,$inter_subjects,$id,$bachelor_board,$bachelor_year,$bachelor_rollno,$bachelor_omarks,$bachelor_tmarks,$bachelor_percentage,$bachelor_div,$bachelor_subjects);
     if ($updated_msc_student_success) {
     		$this->session->set_flashdata('success','Stusent record updated successfully');
     		redirect('admin/msc_students');
     }
}
}

function updated_ms_student_details(){
	if ($this->input->post('update')) {

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
      if (!empty($applyon1)) {
        $applyon=$applyon1;
      }
      else{
        $applyon=$applyon2;
      }
      $category1=$this->input->post('category');
      $category2=$this->input->post('category');
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
      $id=$this->input->post('id');
      if ($inter_percentage <45) {
        redirect('percenterror');
        exit();
      }
      // Bachelor record
      $bachelor_board=$this->input->post('bachelor_board');
      $bachelor_year=$this->input->post('bachelor_year');
      $bachelor_rollno=$this->input->post('bachelor_rollno');
      $bachelor_omarks=$this->input->post('bachelor_omarks');
      $bachelor_tmarks=$this->input->post('bachelor_tmarks');
      $bachelor_percentage=($bachelor_omarks/$bachelor_tmarks)*100;
      $bachelor_div=$this->input->post('bachelor_div');

      // if ($bachelor_percentage>=60) {
      //   $bachelor_div='1st';
      // }
      // elseif ($bachelor_percentage>=45) {
      //   $bachelor_div='2nd';
      // }
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
  }else{
      $master_percentage=0;
  }
      // if ($master_percentage>=60) {
      //   $master_div='1st';
      // }
      // elseif ($master_percentage>=45) {
      //   $master_div='2nd';
      // }
      // }
      // else{
      //   $master_percentage='';
      //  $master_div='';   
      // }
      $master_div=$this->input->post('master_div');
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
      $this->db->query("UPDATE `tbl_gat_data` SET attempted='$attempted',validity_date='$gat_validity',gat_marks='$gatmarks',gat_roll_no=' $gat_gatrollno',gat_Challan='$gat_Challan',gat_bank=' $gat_bank',gat_branch='$gat_branch',gat_cdate='$gat_cdate' WHERE student_id='$id'");
      // $bachelor_div=$this->input->post('bachelor_div');
            $remarks=$this->input->post('remarks');
      $bachelor_subjects=implode(',',$this->input->post('bachelor_subjects'));
      $this->admin_model->add_remarks($id,$remarks,$applyforcourse);
     $updated_ms_student_success=$this->admin_model->updated_ms_student_success($chalan_date,$Challan,$bank,$branch,$applyforcourse,$psession,$applyon,$category,$department,$st_program,$sname,$gender,$fname,$profession,$m_income,$cnic,$nation,$domile,$religion,$hafiz,$blood_group,$dob,$email,$cellno,$ep_name,$ep_relation,$g_cellno,$address,$stay,$matric_board,$matric_year,$matric_rollno,$matric_omarks,$matric_tmarks,$matric_percentage,$matric_div,$matric_subjects,$inter_board,$inter_year,$inter_rollno,$inter_omarks,$inter_tmarks,$inter_percentage,$inter_div,$inter_subjects,$id,$bachelor_board,$bachelor_year,$bachelor_rollno,$bachelor_omarks,$bachelor_tmarks,$bachelor_percentage,$bachelor_div,$bachelor_subjects,$master_board,$master_year,$master_rollno,$master_omarks,$master_tmarks,$master_percentage,$master_div,$master_subjects);
     if ($updated_ms_student_success) {
     		$this->session->set_flashdata('success','Stusent record updated successfully');
     		redirect('admin/ms_students');
     }
}
}
	public function logout()
	{
		$id=$this->session->userdata('active_admin');
		$out=$this->db->query("DELETE FROM `tbl_active_members` WHERE admin_id='$id'");
		if($out){
		$this->session->unset_userdata('active_admin');
		redirect('admin');
	}
	}

// New upadtes for merit list

function generating_list(){
	if ($this->input->post('sub')) {
		$program =$this->input->post('Program');
		$department =$this->input->post('department');
		$session =$this->input->post('session');
		$posts =$this->input->post('posts');
		$this->admin_model->generating_list($program,$department,$session,$posts);

	}
}

function all_users(){
	$data['users']=$this->admin_model->all_users();
	$this->load->view('admin/all_users',$data);
}
function delete_user(){
			if (!empty($this->session->userdata('active_admin'))) {
		$id=$_GET['id'];

		$deleted=$this->db->query("DELETE FROM `tbl_admin` WHERE ID='$id'");
		if ($deleted) {
				$this->session->set_flashdata('success','User deleted Successfully');
				redirect('admin/all_users');
		}
		}
		else{
			redirect('admin');
		}
		
	}
	function account(){
		if (!empty($this->session->userdata('active_admin'))) {
			$data['profile']=$this->admin_model->profile();
		$this->load->view('admin/account_setting',$data);
		}
		else{
			redirect('admin');
		}
	}
	function profile_update(){
		if (!empty($this->session->userdata('active_admin'))) {
			$id=$this->session->userdata('active_admin');
		if ($this->input->post('sub')) {
			$fullname=$this->input->post('fname');
			$username=$this->input->post('Username');
			$gender=$this->input->post('gender');
		
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
         $done=$this->db->query("UPDATE tbl_admin SET Fullname='$fullname',username='$username',gender='$gender',profile='$profile' WHERE ID='$id'");
         if ($done) {
         	$this->session->set_flashdata('success','Profile updated Successfully');
				redirect('admin/account');
         }
      
	}
}
else{
$done=$this->db->query("UPDATE tbl_admin SET Fullname='$fullname',username='$username',gender='$gender' WHERE ID='$id'");
         if ($done) {
         	$this->session->set_flashdata('success','Profile updated Successfully');
				redirect('admin/account');
         }
}
}
}
}
		else{
			redirect('admin');
		}
	}
	 public function exportCSV(){ 
 	if (!empty($this->session->userdata('active_admin'))) {
   // file name 
   $filename = 'users_'.date('d-m-Y').'.csv'; 
   header("Content-Description: File Transfer"); 
   header("Content-Disposition: attachment; filename=$filename"); 
   header("Content-Type: application/csv; ");
   // get data 
   $studentsData = $this->admin_model->getlist();
   // file creation 
   $file = fopen('php://output', 'w');
   $header = array("ID", "applyforcourse", "psession", "applyon", "category", "department", "st_program", "sname", "gender", "fname", "profession", "m_income", "cnic", "nationality", "domicile", "religion", "hafiz", "blood_group", "dob", "email", "cellno", "emergency person name", "ep_relation", "g_cellno", "address", "stay", "matric_board", "matric_year", "matric_rollno", "matric_omarks", "matric_tmarks", "matric_percentage", "matric_div", "matric_subjects", "inter_board", "inter_year", "inter_rollno", "inter_omarks", "inter_tmarks", "inter_percentage", "inter_div", "inter_subjects","challan", "bank", "bank_branch", "challan_date", "status"); 
   fputcsv($file, $header);
   foreach ($studentsData as $record){ 
   	$singleRecord=array(
   		'ID' => $record->ID, 
   		'applyforcourse' => $record->applyforcourse, 
   		'psession' => $record->psession, 
   		'applyon' => $record->applyon, 
   		'category' => $record->category, 
   		'department' => $record->department, 
   		'st_program' => $record->st_program, 
   		'sname' => $record->sname, 
   		'gender' => $record->gender, 
   		'fname' => $record->fname, 
   		'profession' => $record->profession, 
   		'm_income' => $record->m_income, 
   		'cnic' => $record->cnic, 
   		'nationality' => $record->nation, 
   		'domicile' => $record->domile, 
   		'religion' => $record->religion, 
   		'hafiz' => $record->hafiz, 
   		'blood_group' => $record->blood_group, 
   		'dob' => $record->dob, 
   		'email' => $record->email, 
   		'cellno' => $record->cellno, 
   		'emergency person name' => $record->ep_name, 
   		'emergency person relation' => $record->ep_relation, 
   		'guardian cellno' => $record->g_cellno, 
   		'address' => $record->address, 
   		'stay' => $record->stay, 
   		'matric_board' => $record->matric_board, 
   		'matric_year' => $record->matric_year, 
   		'matric_rollno' => $record->matric_rollno, 
   		'matric_omarks' => $record->matric_omarks,
   		'matric_tmarks' => $record->matric_tmarks, 
   		'matric_percentage' => $record->matric_percentage, 
   		'matric_div' => $record->matric_div, 
   		'matric_subjects' => $record->matric_subjects, 
   		'inter_board' => $record->inter_board, 
   		'inter_year' => $record->inter_year, 
   		'inter_rollno' => $record->inter_rollno, 
   		'inter_omarks' => $record->inter_omarks, 
   		'inter_tmarks' => $record->inter_tmarks, 
   		'inter_percentage' => $record->inter_percentage, 
   		'inter_div' => $record->inter_div, 
   		'inter_subjects' => $record->inter_subjects, 
   		'challan' => $record->challan, 
   		'bank' => $record->bank, 
   		'bank_branch' => $record->bank_branch, 
   		'challan_date' => $record->challan_date, 
   		'status' => $record->status, 
   );
     fputcsv($file,$singleRecord); 
   }
   fclose($file); 
   exit; 
  
  }
		else{
			redirect('admin');
		}
	}
function unsub_apps_bs(){
		if (!empty($this->session->userdata('active_admin'))) {
		$result['bs']=$this->admin_model->form_not_submitted_bs();
		$this->load->view('admin/bs_not_submitted',$result);
		 }
		else{
			redirect('admin');
		}
	}
	function unsub_apps_msc(){
		if (!empty($this->session->userdata('active_admin'))) {
		$result['msc']=$this->admin_model->form_not_submitted_msc();
		$this->load->view('admin/msc_not_submitted',$result);
		 }
		else{
			redirect('admin');
		}
	}
	function unsub_apps_ms(){
		if (!empty($this->session->userdata('active_admin'))) {
		$result['ms']=$this->admin_model->form_not_submitted_ms();
		$this->load->view('admin/ms_not_submitted',$result);
		 }
		else{
			redirect('admin');
		}
	}
	function adp_ads_submitted(){
	  	if (!empty($this->session->userdata('active_admin'))) {
		$result['msc']=$this->admin_model->adp_ads_submitted();
		$this->load->view('admin/applications/msc',$result);
		}
		else{
			redirect('admin');
		}  
	}
	// updated on 24-9-2020

	function hafiz_quran_bs(){
		if (!empty($this->session->userdata('active_admin'))) {
		$result['title']="Nominee of (BS) Hafiz-e-Quran";
		$result['bs']=$this->admin_model->hafiz_quran_bs();
		$this->load->view('admin/nominee',$result);
		 }
		else{
			redirect('admin');
		}
	}
	function hafiz_quran_msc(){
		if (!empty($this->session->userdata('active_admin'))) {
		$result['title']="Nominee of (M.Sc) Hafiz-e-Quran";
		$result['bs']=$this->admin_model->hafiz_quran_msc();
		$this->load->view('admin/nominee',$result);
		 }
		else{
			redirect('admin');
		}
	}
	function hafiz_quran_ms(){
		if (!empty($this->session->userdata('active_admin'))) {
		$result['title']="Nominee of (MS) Hafiz-e-Quran";
		$result['bs']=$this->admin_model->hafiz_quran_ms();
		$this->load->view('admin/nominee',$result);
		 }
		else{
			redirect('admin');
		}
	}
 function sports_bs(){
		if (!empty($this->session->userdata('active_admin'))) {
		$result['title']="Nominee of (BS) Sports";
		$result['bs']=$this->admin_model->sports_bs();
		$this->load->view('admin/nominee',$result);
		 }
		else{
			redirect('admin');
		}
	}
	function sports_msc(){
		if (!empty($this->session->userdata('active_admin'))) {
		$result['title']="Nominee of (M.Sc) Sports";
		$result['bs']=$this->admin_model->sports_msc();
		$this->load->view('admin/nominee',$result);
		 }
		else{
			redirect('admin');
		}
	}
	function sports_ms(){
		if (!empty($this->session->userdata('active_admin'))) {
		$result['title']="Nominee of (MS) Sports";
		$result['bs']=$this->admin_model->sports_ms();
		$this->load->view('admin/nominee',$result);
		 }
		else{
			redirect('admin');
		}
	}
	// Disabled
function disabled_bs(){
		if (!empty($this->session->userdata('active_admin'))) {
		$result['title']="Nominee of (BS) Disabled";
		$result['bs']=$this->admin_model->disabled_bs();
		$this->load->view('admin/nominee',$result);
		 }
		else{
			redirect('admin');
		}
	}
	function disabled_msc(){
		if (!empty($this->session->userdata('active_admin'))) {
		$result['title']="Nominee of (M.Sc) Disabled";
		$result['bs']=$this->admin_model->disabled_msc();
		$this->load->view('admin/nominee',$result);
		 }
		else{
			redirect('admin');
		}
	}
	function disabled_ms(){
		if (!empty($this->session->userdata('active_admin'))) {
		$result['title']="Nominee of (MS) Disabled";
		$result['bs']=$this->admin_model->disabled_ms();
		$this->load->view('admin/nominee',$result);
		 }
		else{
			redirect('admin');
		}
	}
	
	// Tribal area
function quota_bs(){
		if (!empty($this->session->userdata('active_admin'))) {
		$result['title']="Nominee of (BS) Tribal area";
		$result['bs']=$this->admin_model->quota_bs();
		$this->load->view('admin/nominee',$result);
		 }
		else{
			redirect('admin');
		}
	}
	function quota_msc(){
		if (!empty($this->session->userdata('active_admin'))) {
		$result['title']="Nominee of (M.Sc) Tribal area";
		$result['bs']=$this->admin_model->quota_msc();
		$this->load->view('admin/nominee',$result);
		 }
		else{
			redirect('admin');
		}
	}
	function quota_ms(){
		if (!empty($this->session->userdata('active_admin'))) {
		$result['title']="Nominee of (MS) Tribal area";
		$result['bs']=$this->admin_model->quota_ms();
		$this->load->view('admin/nominee',$result);
		 }
		else{
			redirect('admin');
		}
	}
	function bs_edit_form1(){
	// if (!empty($this->session->userdata('active_admin'))) {
	$st_id=$this->input->get('id');
	$data['bs_students']=$this->admin_model->get_bs_student_details($st_id);
	$data['departments']=$this->admin_model->unique_departments();
	$data['bs_programs']=$this->admin_model->bs_programs();
	$this->load->view('admin/bs_edit_form',$data);
// }
// else{
// 	redirect('admin');
// }

}
function msc_edit_form1(){
		if (!empty($this->session->userdata('active_admin'))) {
	$st_id=$this->input->get('id');
	$data['mcs_students']=$this->admin_model->get_msc_student_details($st_id);
	$data['departments']=$this->admin_model->unique_departments();
	$data['msc_programs']=$this->admin_model->msc_programs();
	$this->load->view('admin/msc_edit_form',$data);
	}
else{
	redirect('admin');
}

}
function ms_edit_form1(){
		if (!empty($this->session->userdata('active_admin'))) {
	$st_id=$this->input->get('id');
	$data['ms_students']=$this->admin_model->get_ms_student_details($st_id);
	$data['departments']=$this->admin_model->unique_departments();
	$data['ms_programs']=$this->admin_model->ms_programs();
	$this->load->view('admin/ms_edit_form',$data);
	}
else{
	redirect('admin');
}

}
function change_status_for_bs(){
  if (!empty($this->session->userdata('active_admin'))) {
	$this->load->view('admin/approve_bs');
	}
else{
	redirect('admin');
}  
}
function change_status_for_msc(){
  if (!empty($this->session->userdata('active_admin'))) {
	$this->load->view('admin/approve_msc');
	}
else{
	redirect('admin');
}  
}
function change_status_for_ms(){
  if (!empty($this->session->userdata('active_admin'))) {
	$this->load->view('admin/approve_ms');
	}
else{
	redirect('admin');
}  
}

function update_record_for_bs(){
  if (!empty($this->session->userdata('active_admin'))) {
	$this->load->view('admin/update_bs');
	}
else{
	redirect('admin');
}  
}
function update_record_for_msc(){
  if (!empty($this->session->userdata('active_admin'))) {
	$this->load->view('admin/update_msc');
	}
else{
	redirect('admin');
}  
}
function update_record_for_ms(){
  if (!empty($this->session->userdata('active_admin'))) {
	$this->load->view('admin/update_ms');
	}
else{
	redirect('admin');
}  
}

	public function exportCSV_msc(){ 
 	if (!empty($this->session->userdata('active_admin'))) {
   // file name 
   $filename = 'msc_list_'.date('d-m-Y').'.csv'; 
   header("Content-Description: File Transfer"); 
   header("Content-Disposition: attachment; filename=$filename"); 
   header("Content-Type: application/csv; ");
   // get data 
   $studentsData = $this->admin_model->getlist_msc();
   // file creation 
   $file = fopen('php://output', 'w');
   $header = array("ID", "applyforcourse", "psession", "applyon", "category", "department", "st_program", "sname", "gender", "fname", "profession", "m_income", "cnic", "nationality", "domicile", "religion", "hafiz", "blood_group", "dob", "email", "cellno", "emergency person name", "ep_relation", "g_cellno", "address", "stay", "matric_board", "matric_year", "matric_rollno", "matric_omarks", "matric_tmarks", "matric_percentage", "matric_div", "matric_subjects", "inter_board", "inter_year", "inter_rollno", "inter_omarks", "inter_tmarks", "inter_percentage", "inter_div", "inter_subjects","bachelor_board", "bachelor_year", "bachelor_rollno", "bachelor_omarks", "bachelor_tmarks", "bachelor_percentage", "bachelor_div", "bachelor_subjects","challan", "bank", "bank_branch", "challan_date", "status"); 
   fputcsv($file, $header);
   foreach ($studentsData as $record){ 
   	$singleRecord=array(
   		'ID' => $record->ID, 
   		'applyforcourse' => $record->applyforcourse, 
   		'psession' => $record->psession, 
   		'applyon' => $record->applyon, 
   		'category' => $record->category, 
   		'department' => $record->department, 
   		'st_program' => $record->st_program, 
   		'sname' => $record->sname, 
   		'gender' => $record->gender, 
   		'fname' => $record->fname, 
   		'profession' => $record->profession, 
   		'm_income' => $record->m_income, 
   		'cnic' => $record->cnic, 
   		'nationality' => $record->nation, 
   		'domicile' => $record->domile, 
   		'religion' => $record->religion, 
   		'hafiz' => $record->hafiz, 
   		'blood_group' => $record->blood_group, 
   		'dob' => $record->dob, 
   		'email' => $record->email, 
   		'cellno' => $record->cellno, 
   		'emergency person name' => $record->ep_name, 
   		'emergency person relation' => $record->ep_relation, 
   		'guardian cellno' => $record->g_cellno, 
   		'address' => $record->address, 
   		'stay' => $record->stay, 
   		'matric_board' => $record->matric_board, 
   		'matric_year' => $record->matric_year, 
   		'matric_rollno' => $record->matric_rollno, 
   		'matric_omarks' => $record->matric_omarks,
   		'matric_tmarks' => $record->matric_tmarks, 
   		'matric_percentage' => $record->matric_percentage, 
   		'matric_div' => $record->matric_div, 
   		'matric_subjects' => $record->matric_subjects, 
   		'inter_board' => $record->inter_board, 
   		'inter_year' => $record->inter_year, 
   		'inter_rollno' => $record->inter_rollno, 
   		'inter_omarks' => $record->inter_omarks, 
   		'inter_tmarks' => $record->inter_tmarks, 
   		'inter_percentage' => $record->inter_percentage, 
   		'inter_div' => $record->inter_div, 
   		'inter_subjects' => $record->inter_subjects,
   		'bachelor_board' => $record->bachelor_board, 
   		'bachelor_year' => $record->bachelor_year, 
   		'bachelor_rollno' => $record->bachelor_rollno, 
   		'bachelor_omarks' => $record->bachelor_omarks, 
   		'bachelor_tmarks' => $record->bachelor_tmarks, 
   		'bachelor_percentage' => $record->bachelor_percentage, 
   		'bachelor_div' => $record->bachelor_div, 
   		'bachelor_subjects' => $record->bachelor_subjects, 
   		'challan' => $record->challan, 
   		'bank' => $record->bank, 
   		'bank_branch' => $record->bank_branch, 
   		'challan_date' => $record->challan_date, 
   		'status' => $record->status, 
   );
     fputcsv($file,$singleRecord); 
   }
   fclose($file); 
   exit; 
  
  }
		else{
			redirect('admin');
		}
	}


	public function exportCSV_ms(){ 
 	if (!empty($this->session->userdata('active_admin'))) {
   // file name 
   $filename = 'ms_list_'.date('d-m-Y').'.csv'; 
   header("Content-Description: File Transfer"); 
   header("Content-Disposition: attachment; filename=$filename"); 
   header("Content-Type: application/csv; ");
   // get data 
   $studentsData = $this->admin_model->getlist_ms();
   // file creation 
   $file = fopen('php://output', 'w');
   $header = array("ID", "applyforcourse", "psession", "applyon", "category", "department", "st_program", "sname", "gender", "fname", "profession", "m_income", "cnic", "nationality", "domicile", "religion", "hafiz", "blood_group", "dob", "email", "cellno", "emergency person name", "ep_relation", "g_cellno", "address", "stay", "matric_board", "matric_year", "matric_rollno", "matric_omarks", "matric_tmarks", "matric_percentage", "matric_div", "matric_subjects", "inter_board", "inter_year", "inter_rollno", "inter_omarks", "inter_tmarks", "inter_percentage", "inter_div", "inter_subjects","bachelor_board", "bachelor_year", "bachelor_rollno", "bachelor_omarks", "bachelor_tmarks", "bachelor_percentage", "bachelor_div", "bachelor_subjects","master_board", "master_year", "master_rollno", "master_omarks", "master_tmarks", "master_percentage", "master_div", "master_subjects","challan", "bank", "bank_branch", "challan_date", "status"); 
   fputcsv($file, $header);
   foreach ($studentsData as $record){ 
   	$singleRecord=array(
   		'ID' => $record->ID, 
   		'applyforcourse' => $record->applyforcourse, 
   		'psession' => $record->psession, 
   		'applyon' => $record->applyon, 
   		'category' => $record->category, 
   		'department' => $record->department, 
   		'st_program' => $record->st_program, 
   		'sname' => $record->sname, 
   		'gender' => $record->gender, 
   		'fname' => $record->fname, 
   		'profession' => $record->profession, 
   		'm_income' => $record->m_income, 
   		'cnic' => $record->cnic, 
   		'nationality' => $record->nation, 
   		'domicile' => $record->domile, 
   		'religion' => $record->religion, 
   		'hafiz' => $record->hafiz, 
   		'blood_group' => $record->blood_group, 
   		'dob' => $record->dob, 
   		'email' => $record->email, 
   		'cellno' => $record->cellno, 
   		'emergency person name' => $record->ep_name, 
   		'emergency person relation' => $record->ep_relation, 
   		'guardian cellno' => $record->g_cellno, 
   		'address' => $record->address, 
   		'stay' => $record->stay, 
   		'matric_board' => $record->matric_board, 
   		'matric_year' => $record->matric_year, 
   		'matric_rollno' => $record->matric_rollno, 
   		'matric_omarks' => $record->matric_omarks,
   		'matric_tmarks' => $record->matric_tmarks, 
   		'matric_percentage' => $record->matric_percentage, 
   		'matric_div' => $record->matric_div, 
   		'matric_subjects' => $record->matric_subjects, 
   		'inter_board' => $record->inter_board, 
   		'inter_year' => $record->inter_year, 
   		'inter_rollno' => $record->inter_rollno, 
   		'inter_omarks' => $record->inter_omarks, 
   		'inter_tmarks' => $record->inter_tmarks, 
   		'inter_percentage' => $record->inter_percentage, 
   		'inter_div' => $record->inter_div, 
   		'inter_subjects' => $record->inter_subjects,
   		'bachelor_board' => $record->bachelor_board, 
   		'bachelor_year' => $record->bachelor_year, 
   		'bachelor_rollno' => $record->bachelor_rollno, 
   		'bachelor_omarks' => $record->bachelor_omarks, 
   		'bachelor_tmarks' => $record->bachelor_tmarks, 
   		'bachelor_percentage' => $record->bachelor_percentage, 
   		'bachelor_div' => $record->bachelor_div, 
   		'bachelor_subjects' => $record->bachelor_subjects, 
   		'master_board' => $record->master_board, 
   		'master_year' => $record->master_year, 
   		'master_rollno' => $record->master_rollno, 
   		'master_omarks' => $record->master_omarks, 
   		'master_tmarks' => $record->master_tmarks, 
   		'master_percentage' => $record->master_percentage, 
   		'master_div' => $record->master_div, 
   		'master_subjects' => $record->master_subjects, 
   		'challan' => $record->challan, 
   		'bank' => $record->bank, 
   		'bank_branch' => $record->bank_branch, 
   		'challan_date' => $record->challan_date, 
   		'status' => $record->status, 
   );
     fputcsv($file,$singleRecord); 
   }
   fclose($file); 
   exit; 
  
  }
		else{
			redirect('admin');
		}
	}

// updated on 1-10-2020

	function merit_generator_bs(){
	if (!empty($this->session->userdata('active_admin'))) {
		$generated=$this->admin_model->merit_generator_bs();
		if ($generated) {
			echo "You are great and done with it.";
		}
		}
		else{
			redirect('admin');
		}
		
	}
	function genrate_merit_list(){
		if (!empty($this->session->userdata('active_admin'))) {
		if ($this->input->post('sub')) {
			$program=$this->input->post('program');
			$department=$this->input->post('department');
			$session=$this->input->post('session');
			$posts=$this->input->post('posts');
			if ($program=='BS') {
				$this->admin_model->genrate_merit_list_bs($department,$session,$posts);
			}
			else if ($program=='M.Sc') {
				$this->admin_model->genrate_merit_list_msc($department,$session,$posts);
			}
			else if ($program=='MS') {
				$this->admin_model->genrate_merit_list_ms($department,$session,$posts);
			}
			else {
				echo "1";
			}

		}
		}
		else{
			redirect('admin');
		}
	}

	function get_pdf_for_bs(){
		if (!empty($this->session->userdata('active_admin'))) {
		$this->load->view('admin/pdf_creator_bs');
		if ($this->input->post('search')) {
			$id=base64_encode($this->input->post('app_no'));
			redirect('admin/print_bs_file?id='.$id);
		}
		}
		else{
			redirect('admin');
		}
	}
	function get_pdf_for_msc(){
		if (!empty($this->session->userdata('active_admin'))) {
		$this->load->view('admin/pdf_creator_msc');
		if ($this->input->post('search')) {
			$id=base64_encode($this->input->post('app_no'));
			redirect('admin/print_msc_file?id='.$id);
		}
		}
		else{
			redirect('admin');
		}
	}
	function get_pdf_for_ms(){
		if (!empty($this->session->userdata('active_admin'))) {
		$this->load->view('admin/pdf_creator_ms');
		if ($this->input->post('search')) {
			$id=base64_encode($this->input->post('app_no'));
			redirect('admin/print_ms_file?id='.$id);
		}
		}
		else{
			redirect('admin');
		}
	}
	function pass(){
		echo base64_decode('Z2hhemkxMjM=');
	}

	function auto_logout(){
		$id=$this->session->userdata('active_admin');
		$out=$this->db->query("DELETE FROM `tbl_active_members` WHERE admin_id='$id'");
		if($out){
		$this->session->unset_userdata('active_admin');
		redirect('admin');
	}
}
function test1(){
	$this->load->view('admin/test');
}


function genrate_merit_list_msc(){
		$data=$this->db->query("SELECT * FROM `tbl_msc_students` WHERE department='Department of Physics' AND bachelor_subjects IN ('ADS','ADP')")->result();
			$n=0;
	$filename = 'physics'.date('d-m-Y').'.csv'; 
   header("Content-Description: File Transfer"); 
   header("Content-Disposition: attachment; filename=$filename"); 
   header("Content-Type: application/csv; ");
   $file = fopen('php://output', 'w');
   $header = array("#","Application ID", "Student Name", "Father Name","CNIC", "Obtained marks","Total marks","Hafiz", "Percentage"); 
   fputcsv($file, $header);
		foreach ($data as $record) {
			$id=$record->ID;
			$singleRecord=array(
		'#'=>$n++,
   		'Application ID' => $record->ID, 
   		'Student Name' => $record->sname, 
   		'Father Name' => $record->fname, 
   		'CNIC' => $record->cnic, 
   		'Obtained marks' => $record->inter_omarks, 
   		'Total marks' => $record->inter_tmarks, 
   		'Hafiz' => $record->hafiz, 
   		'Percentage' => round($record->inter_percentage,2), 
   		 
   );
     fputcsv($file,$singleRecord); 
   }
   fclose($file); 
   exit; 
  
  }


}


?>