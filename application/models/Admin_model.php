<?php
/**
 * 
 */
class Admin_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function login($username,$password){
	$check=$this->db->query("SELECT * FROM `tbl_admin` WHERE username='$username' AND Password='$password'");

	if ($check->num_rows() > 0) {
		$sess_data=$check->row();
		$token=base64_encode($sess_data->ID);
		$done=$this->session->set_userdata("active_admin",$sess_data->ID);
		$this->session->set_userdata("active_admin_depart",$sess_data->Department);
		$this->session->set_userdata("active_admin_username",$sess_data->username);
		$this->session->set_userdata("active_admin_role",$sess_data->Role);
		$this->session->set_userdata("active_admin_profile",$sess_data->profile);
		$this->session->set_userdata("active_admin_name",$sess_data->Fullname);
		$this->db->query("INSERT INTO `tbl_active_members`(admin_id,session_token) VALUES ('$sess_data->ID','$token')");
		if ($done) {
			return false;
		}
		else{
			return true;
		}
		
	}
	else{
		$this->session->set_flashdata('error','Username or password is incorrect.');
		redirect('admin/index');
	}

}
public function active_members()
{
	return $this->db->query("SELECT * FROM `tbl_active_members` INNER JOIN tbl_admin ON tbl_active_members.admin_id=tbl_admin.ID LIMIT 5")->result();
}
public function activity_details()
{
	return $this->db->query("SELECT * FROM `tbl_admins_activity` INNER JOIN tbl_admin ON tbl_admins_activity.admin_id=tbl_admin.ID LIMIT 5")->result();
}
function bs_students(){
	$dpt=$this->session->userdata("active_admin_depart");
	if ($dpt=='admin' || $dpt=='all') {
		return $this->db->query("SELECT * FROM `tbl_bs_students` ORDER BY inter_percentage DESC")->result();
	}
	else{
		return $this->db->query("SELECT * FROM `tbl_bs_students` WHERE department='$dpt' ORDER BY inter_percentage DESC")->result();
	}
	
}
function msc_students(){
	$dpt=$this->session->userdata("active_admin_depart");
	if ($dpt=='admin' || $dpt=='all') {
		return $this->db->query("SELECT * FROM `tbl_msc_students` ORDER BY bachelor_percentage DESC")->result();
	}
	else{
		return $this->db->query("SELECT * FROM `tbl_msc_students` WHERE department='$dpt' ORDER BY bachelor_percentage DESC")->result();
	}
}
function ms_students(){
	$dpt=$this->session->userdata("active_admin_depart");
	if ($dpt=='admin' || $dpt=='all') {
		return $this->db->query("SELECT * FROM `tbl_ms_students` ORDER BY ID DESC")->result();
	}
	else{
		return $this->db->query("SELECT * FROM `tbl_ms_students` WHERE department='$dpt' ORDER BY ID DESC")->result();
	}
}
public function departments()
{
	return $this->db->query("SELECT * FROM `tbl_department_programs`")->result();
}
public function unique_departments()
{
	return $this->db->query("SELECT DISTINCT(Department_name) FROM `tbl_department_programs`")->result();
}
public function bs_student_profile_change_status($id){
	$admin_id=$this->session->userdata("active_admin");
	$cdate=date('Y-m-d');
	$details='Admin '.$this->session->userdata("active_admin_username").' changed the status of the BS student with id '.$id.' to FORM_SUBMITTED';
	$activity=$this->db->query("INSERT INTO `tbl_admins_activity`(admin_id,activity_details) VALUES ('$admin_id','$details')");
	if ($activity) {
		$this->session->set_flashdata('success','Status Updated Successfully');
		$done=$this->db->query("UPDATE tbl_bs_students SET status='2',status_updated_on ='$cdate' WHERE ID='$id'");
		
		if ($done) {
			return true;
		}
	}
	
}
public function msc_student_profile_change_status($id){
	$admin_id=$this->session->userdata("active_admin");
	$cdate=date('Y-m-d');
	$activity=$this->db->query("INSERT INTO `tbl_admins_activity`(admin_id,activity_details) VALUES ('$admin_id','Admin changed the status of the M.Sc student with id $id to FORM_SUBMITTED')");
	if ($activity) {
		$this->session->set_flashdata('success','Status Updated Successfully');
	return $this->db->query("UPDATE tbl_msc_students SET status='2',status_updated_on ='$cdate' WHERE ID='$id'");
}
}
public function ms_student_profile_change_status($id){
	$admin_id=$this->session->userdata("active_admin");
	$cdate=date('Y-m-d');
	$activity=$this->db->query("INSERT INTO `tbl_admins_activity`(admin_id,activity_details) VALUES ('$admin_id','Admin changed the status of the MS student with id $id to FORM_SUBMITTED')");
	if ($activity) {
		$this->session->set_flashdata('success','Status Updated Successfully');
	return $this->db->query("UPDATE tbl_ms_students SET status='2',status_updated_on ='$cdate' WHERE ID='$id'");
}
}
function update_bs_student_status($id,$status){
	$admin_id=$this->session->userdata("active_admin");
	$details='Admin '.$this->session->userdata("active_admin_username").' changed the status of the BS student with id '.$id.' to '.$status;
	$activity=$this->db->query("INSERT INTO tbl_admins_activity(admin_id,activity_details) VALUES ('$admin_id','$details')");
	if ($activity) {
		$this->session->set_flashdata('success','Status Updated Successfully');
		return $this->db->query("UPDATE tbl_bs_students SET status='$status' WHERE ID='$id'");
	}
}

function update_msc_student_status($id,$status){
	$admin_id=$this->session->userdata("active_admin");
	$details='Admin '.$this->session->userdata("active_admin_username").' changed the status of the M.Sc student with id '.$id.' to '.$status;
	$activity=$this->db->query("INSERT INTO tbl_admins_activity(admin_id,activity_details) VALUES ('$admin_id','$details')");
	if ($activity) {
		$this->session->set_flashdata('success','Status Updated Successfully');
		return $this->db->query("UPDATE tbl_msc_students SET status='$status' WHERE ID='$id'");
	}
}

function update_ms_student_status($id,$status){
	$admin_id=$this->session->userdata("active_admin");
	$details='Admin '.$this->session->userdata("active_admin_username").' changed the status of the MS student with id '.$id.' to '.$status;
	$activity=$this->db->query("INSERT INTO tbl_admins_activity(admin_id,activity_details) VALUES ('$admin_id','$details')");
	if ($activity) {
		$this->session->set_flashdata('success','Status Updated Successfully');
		return $this->db->query("UPDATE tbl_ms_students SET status='$status' WHERE ID='$id'");
	}
}
public function forget_password($email)
{
	$check=$this->db->query("SELECT * FROM `tbl_admin` WHERE username='$email'");
	if ($check->num_rows() > 0) {
		$length = 8; //how long string as you want
   		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    	$charactersLength = strlen($characters);
    	$randomString = '';
		    for ($i = 0; $i < $length; $i++) {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }
		    $pass=base64_encode($randomString);
			$changed=$this->db->query("UPDATE tbl_admin SET Password ='$pass' WHERE username='$email'");
			$msg='Your new password is <quote><b>'.$randomString.'</b></quote>';
			if ($changed) {
				$this->load->library('smtp_email');
				$sent=$this->smtp_email->send('GUDGK','GUDGK-Admin',$email,'Password reset',$msg);
				if ($sent) {
					$this->session->set_flashdata('success','Kindly check your email.');
			redirect('admin');
				}
			}
		}	
		else{
			$this->session->set_flashdata('error','You have entered an email that does not exist in our record.');
			redirect('admin');
		}
}
function form_not_submitted_bs(){
		$dpt=$this->session->userdata("active_admin_depart");
	if ($dpt=='admin' || $dpt=='all') {
		return $this->db->query("SELECT * FROM `tbl_bs_students` WHERE status is NULL ORDER BY ID DESC")->result();
	}
	else{
		return $this->db->query("SELECT * FROM `tbl_bs_students` WHERE department='$dpt' AND status is NULL ORDER BY ID DESC")->result();
	}
}
function form_not_submitted_msc(){
		$dpt=$this->session->userdata("active_admin_depart");
	if ($dpt=='admin' || $dpt=='all') {
		return $this->db->query("SELECT * FROM `tbl_msc_students` WHERE status is NULL ORDER BY ID DESC")->result();
	}
	else{
		return $this->db->query("SELECT * FROM `tbl_msc_students` WHERE department='$dpt' AND  status is NULL ORDER BY ID DESC")->result();
	}
}
function form_not_submitted_ms(){
		$dpt=$this->session->userdata("active_admin_depart");
	if ($dpt=='admin' || $dpt=='all') {
		return $this->db->query("SELECT * FROM `tbl_ms_students` WHERE status is NULL ORDER BY ID DESC")->result();
	}
	else{
		return $this->db->query("SELECT * FROM `tbl_ms_students` WHERE department='$dpt' AND status is NULL ORDER BY ID DESC")->result();
	}
}
function form_submitted_bs(){
		$dpt=$this->session->userdata("active_admin_depart");
	if ($dpt=='admin' || $dpt=='all') {
		return $this->db->query("SELECT * FROM `tbl_bs_students` WHERE status ='2' ORDER BY ID DESC")->result();
	}
	else{
		return $this->db->query("SELECT * FROM `tbl_bs_students` WHERE department='$dpt' AND status ='2' ORDER BY ID DESC")->result();
	}
}
function form_submitted_msc(){
		$dpt=$this->session->userdata("active_admin_depart");
	if ($dpt=='admin' || $dpt=='all') {
		return $this->db->query("SELECT * FROM `tbl_msc_students` WHERE status = 2 ORDER BY ID DESC")->result();
	}
	else{
		return $this->db->query("SELECT * FROM `tbl_msc_students` WHERE department='$dpt' AND  status = 2 ORDER BY ID DESC")->result();
	}
}
function form_submitted_ms(){
		$dpt=$this->session->userdata("active_admin_depart");
	if ($dpt=='admin' || $dpt=='all') {
		return $this->db->query("SELECT * FROM `tbl_ms_students` WHERE status = 2 ORDER BY ID DESC")->result();
	}
	else{
		return $this->db->query("SELECT * FROM `tbl_ms_students` WHERE department='$dpt' AND  status = 2 ORDER BY ID DESC")->result();
	}
}
function today_record($dpt,$dep_program){
	$cdate=date('Y-m-d');
	if ($dep_program=='BS') {
		return $this->db->query("SELECT * FROM `tbl_bs_students` WHERE status = 2 AND department='$dpt' AND status_updated_on
LIKE '%$cdate%' ORDER BY ID DESC")->result();
	}
	elseif ($dep_program=='MSc') {
		return $this->db->query("SELECT * FROM `tbl_msc_students` WHERE status = 2 AND department='$dpt' AND status_updated_on
LIKE '%$cdate%' ORDER BY ID DESC")->result();
	}
	else{
	return $this->db->query("SELECT * FROM `tbl_ms_students` WHERE status = 2 AND department='$dpt' AND status_updated_on
LIKE '%$cdate%' ORDER BY ID DESC")->result();
	}
	
}
function today_challans_bs(){
		$cdate=date('Y-m-d');
		return $this->db->query("SELECT * FROM `tbl_bs_students` WHERE registered_date
LIKE '%$cdate%' ORDER BY ID DESC")->result();
}
function today_challans_msc(){
		$cdate=date('Y-m-d');
		return $this->db->query("SELECT * FROM `tbl_msc_students` WHERE registered_date
LIKE '%$cdate%' ORDER BY ID DESC")->result();
}function today_challans_ms(){
		$cdate=date('Y-m-d');
		return $this->db->query("SELECT * FROM `tbl_ms_students` WHERE registered_date
LIKE '%$cdate%' ORDER BY ID DESC")->result();
}
function all_challans_bs(){
		return $this->db->query("SELECT * FROM `tbl_bs_students` ORDER BY ID DESC")->result();
}
function all_challans_msc(){
		return $this->db->query("SELECT * FROM `tbl_msc_students` ORDER BY ID DESC")->result();
}
function all_challans_ms(){
		return $this->db->query("SELECT * FROM `tbl_ms_students` ORDER BY ID DESC")->result();
}

// updated on 28-8-2020

function add_remarks($id,$remarks,$applyforcourse){
	$admin_id=$this->session->userdata("active_admin");
	return $this->db->query("INSERT INTO `tbl_update_remarks`( `admin_id`, `student_id`, `program`, `Remarks`) VALUES ('$admin_id','$id','$applyforcourse','$remarks')");

}
function get_bs_student_details($id){
return $this->db->query("SELECT * FROM `tbl_bs_students` WHERE ID='$id'")->result();
}
function updated_bs_student_success($chalan_date,$Challan,$bank,$branch,$applyforcourse,$psession,$applyon,$category,$department,$st_program,$sname,$gender,$fname,$profession,$m_income,$cnic,$nation,$domile,$religion,$hafiz,$blood_group,$dob,$email,$cellno,$ep_name,$ep_relation,$g_cellno,$address,$stay,$matric_board,$matric_year,$matric_rollno,$matric_omarks,$matric_tmarks,$matric_percentage,$matric_div,$matric_subjects,$inter_board,$inter_year,$inter_rollno,$inter_omarks,$inter_tmarks,$inter_percentage,$inter_div,$inter_subjects,$id){
	return $this->db->query("UPDATE `tbl_bs_students` SET applyforcourse='$applyforcourse',psession='$psession',`applyon`='$applyon',`category`='$category',`department`='$department',`st_program`='$st_program',`sname`='$sname',`gender`='$gender',`fname`='$fname',`profession`='$profession',`m_income`='$m_income',`cnic`='$cnic',`nation`='$nation',`domile`='$domile',`religion`='$religion',`hafiz`='$hafiz',`blood_group`='$blood_group',`dob`='$dob',`email`='$email',`cellno`='$cellno',`ep_name`='$ep_name',`ep_relation`='$ep_relation',`g_cellno`='$g_cellno',`address`='$address',`stay`='$stay',`matric_board`='$matric_board',`matric_year`='$matric_year',`matric_rollno`='$matric_rollno',`matric_omarks`='$matric_omarks',`matric_tmarks`='$matric_tmarks',`matric_percentage`='$matric_percentage',`matric_div`='$matric_div',`matric_subjects`='$matric_subjects',`inter_board`='$inter_board',`inter_year`='$inter_year',`inter_rollno`='$inter_rollno',`inter_omarks`='$inter_omarks',`inter_tmarks`='$inter_tmarks',`inter_percentage`='$inter_percentage',`inter_div`='$inter_div',`inter_subjects`='$inter_subjects',`challan`='$Challan',`bank`='$bank',`bank_branch`='$branch',`challan_date`='$chalan_date' WHERE ID='$id'");
}
function get_msc_student_details($id){
return $this->db->query("SELECT * FROM `tbl_msc_students` WHERE ID='$id'")->result();
}
function updated_msc_student_success($chalan_date,$Challan,$bank,$branch,$applyforcourse,$psession,$applyon,$category,$department,$st_program,$sname,$gender,$fname,$profession,$m_income,$cnic,$nation,$domile,$religion,$hafiz,$blood_group,$dob,$email,$cellno,$ep_name,$ep_relation,$g_cellno,$address,$stay,$matric_board,$matric_year,$matric_rollno,$matric_omarks,$matric_tmarks,$matric_percentage,$matric_div,$matric_subjects,$inter_board,$inter_year,$inter_rollno,$inter_omarks,$inter_tmarks,$inter_percentage,$inter_div,$inter_subjects,$id,$bachelor_board,$bachelor_year,$bachelor_rollno,$bachelor_omarks,$bachelor_tmarks,$bachelor_percentage,$bachelor_div,$bachelor_subjects){
	return $this->db->query("UPDATE `tbl_msc_students` SET applyforcourse='$applyforcourse',psession='$psession',`applyon`='$applyon',`category`='$category',`department`='$department',`st_program`='$st_program',`sname`='$sname',`gender`='$gender',`fname`='$fname',`profession`='$profession',`m_income`='$m_income',`cnic`='$cnic',`nation`='$nation',`domile`='$domile',`religion`='$religion',`hafiz`='$hafiz',`blood_group`='$blood_group',`dob`='$dob',`email`='$email',`cellno`='$cellno',`ep_name`='$ep_name',`ep_relation`='$ep_relation',`g_cellno`='$g_cellno',`address`='$address',`stay`='$stay',`matric_board`='$matric_board',`matric_year`='$matric_year',`matric_rollno`='$matric_rollno',`matric_omarks`='$matric_omarks',`matric_tmarks`='$matric_tmarks',`matric_percentage`='$matric_percentage',`matric_div`='$matric_div',`matric_subjects`='$matric_subjects',`inter_board`='$inter_board',`inter_year`='$inter_year',`inter_rollno`='$inter_rollno',`inter_omarks`='$inter_omarks',`inter_tmarks`='$inter_tmarks',`inter_percentage`='$inter_percentage',`inter_div`='$inter_div',`inter_subjects`='$inter_subjects',`challan`='$Challan',`bank`='$bank',`bank_branch`='$branch',`challan_date`='$chalan_date',`bachelor_board`='$bachelor_board',`bachelor_year`='$bachelor_year',`bachelor_rollno`='$bachelor_rollno',`bachelor_omarks`='$bachelor_omarks',`bachelor_tmarks`='$bachelor_tmarks',`bachelor_percentage`='$bachelor_percentage',`bachelor_div`='$bachelor_div',`bachelor_subjects`='$bachelor_subjects' WHERE ID='$id'");
}
function get_ms_student_details($id){
 return $this->db->query("SELECT * FROM `tbl_ms_students` WHERE ID='$id'")->result();

}
function updated_ms_student_success($chalan_date,$Challan,$bank,$branch,$applyforcourse,$psession,$applyon,$category,$department,$st_program,$sname,$gender,$fname,$profession,$m_income,$cnic,$nation,$domile,$religion,$hafiz,$blood_group,$dob,$email,$cellno,$ep_name,$ep_relation,$g_cellno,$address,$stay,$matric_board,$matric_year,$matric_rollno,$matric_omarks,$matric_tmarks,$matric_percentage,$matric_div,$matric_subjects,$inter_board,$inter_year,$inter_rollno,$inter_omarks,$inter_tmarks,$inter_percentage,$inter_div,$inter_subjects,$id,$bachelor_board,$bachelor_year,$bachelor_rollno,$bachelor_omarks,$bachelor_tmarks,$bachelor_percentage,$bachelor_div,$bachelor_subjects,$master_board,$master_year,$master_rollno,$master_omarks,$master_tmarks,$master_percentage,$master_div,$master_subjects){
	return $this->db->query("UPDATE `tbl_ms_students` SET applyforcourse='$applyforcourse',psession='$psession',`applyon`='$applyon',`category`='$category',`department`='$department',`st_program`='$st_program',`sname`='$sname',`gender`='$gender',`fname`='$fname',`profession`='$profession',`m_income`='$m_income',`cnic`='$cnic',`nation`='$nation',`domile`='$domile',`religion`='$religion',`hafiz`='$hafiz',`blood_group`='$blood_group',`dob`='$dob',`email`='$email',`cellno`='$cellno',`ep_name`='$ep_name',`ep_relation`='$ep_relation',`g_cellno`='$g_cellno',`address`='$address',`stay`='$stay',`matric_board`='$matric_board',`matric_year`='$matric_year',`matric_rollno`='$matric_rollno',`matric_omarks`='$matric_omarks',`matric_tmarks`='$matric_tmarks',`matric_percentage`='$matric_percentage',`matric_div`='$matric_div',`matric_subjects`='$matric_subjects',`inter_board`='$inter_board',`inter_year`='$inter_year',`inter_rollno`='$inter_rollno',`inter_omarks`='$inter_omarks',`inter_tmarks`='$inter_tmarks',`inter_percentage`='$inter_percentage',`inter_div`='$inter_div',`inter_subjects`='$inter_subjects',`challan`='$Challan',`bank`='$bank',`bank_branch`='$branch',`challan_date`='$chalan_date',`bachelor_board`='$bachelor_board',`bachelor_year`='$bachelor_year',`bachelor_rollno`='$bachelor_rollno',`bachelor_omarks`='$bachelor_omarks',`bachelor_tmarks`='$bachelor_tmarks',`bachelor_percentage`='$bachelor_percentage',`bachelor_div`='$bachelor_div',`bachelor_subjects`='$bachelor_subjects',`master_year`='$master_year',`master_rollno`='$master_rollno',`master_omarks`='$master_omarks',`master_tmarks`='$master_tmarks',`master_percentage`='$master_percentage',`master_div`='$master_div',`master_subjects`='$master_subjects' WHERE ID='$id'");
}

// New upadtes for merit list
function generating_list($program,$department,$session,$posts){
	if ($program=="BS") {
		return $this->db->query("UPDATE `tbl_bs_students` SET status='4' WHERE department='$department' AND psession='$session' AND status!='4' ORDER BY inter_percentage DESC LIMIT $posts ");
	}
	elseif ($program=="M.Sc") {
		return $this->db->query("UPDATE `tbl_msc_students` SET status='4' WHERE department='$department' AND psession='$session' AND status!='4' ORDER BY bachelor_percentage DESC LIMIT $posts ");
	}
	elseif ($program=="MS") {
		return $this->db->query("UPDATE `tbl_ms_students` SET status='4' WHERE department='$department' AND psession='$session' AND status!='4' AND st_program !='B.Ed' ORDER BY master_percentage DESC LIMIT $posts ");
	}
	elseif ($program=="B.Ed") {
		return $this->db->query("UPDATE `tbl_ms_students` SET status='4' WHERE department='$department' AND psession='$session' AND status!='4' AND st_program='B.Ed' ORDER BY master_percentage DESC LIMIT $posts ");
	}
	else{
		$this->session->set_flashdata('success','Error in generating list.');
		redirect('admin');
	}

}
function all_users(){
	return $this->db->query("SELECT * FROM tbl_admin")->result();
}
function profile(){
	$admin_id=$this->session->userdata("active_admin");
	return $this->db->query("SELECT * FROM tbl_admin WHERE ID='$admin_id'")->result();
}
function getlist(){
	$dpt=$this->session->userdata("active_admin_depart");
	if ($dpt=='admin' || $dpt=='all') {
		return $this->db->query("SELECT * FROM `tbl_bs_students` ORDER BY ID DESC")->result();
	}
	else{
		return $this->db->query("SELECT * FROM `tbl_bs_students` WHERE department='$dpt' ORDER BY ID DESC")->result();
	}
}
function bs_programs(){
	return $this->db->query("SELECT * FROM tbl_department_programs WHERE Program_name LIKE '%BS%' OR Program_name LIKE '%BBA (Hons) 4 years%'")->result();
}
function msc_programs(){
	return $this->db->query("SELECT * FROM tbl_department_programs WHERE Program_name LIKE '%M.Sc%' OR Program_name LIKE '%MA%' OR Program_name LIKE '%MCS%'")->result();
}
function ms_programs(){
	return $this->db->query("SELECT * FROM tbl_department_programs WHERE Program_name LIKE '%MSc%' OR Program_name LIKE '%Mphill%'  OR Program_name LIKE '%B.Ed%'")->result();
}
function adp_ads_submitted(){
	$dpt=$this->session->userdata("active_admin_depart");
	if ($dpt=='admin' || $dpt=='all') {
		return $this->db->query("SELECT * FROM `tbl_msc_students` WHERE bachelor_subjects IN('ADS','ADP') ORDER BY ID DESC")->result();
	}
	else{
		return $this->db->query("SELECT * FROM `tbl_msc_students` WHERE department='$dpt' AND bachelor_subjects IN('ADS','ADP') ORDER BY ID DESC")->result();
	}
}
// updated on 24-9-2020

function hafiz_quran_bs(){
		$dpt=$this->session->userdata("active_admin_depart");
	if ($dpt=='admin' || $dpt=='all') {
		return $this->db->query("SELECT * FROM `tbl_bs_students` WHERE hafiz ='Yes' ORDER BY ID DESC")->result();
	}
	else{
		return $this->db->query("SELECT * FROM `tbl_bs_students` WHERE department='$dpt' AND  hafiz = 'Yes' ORDER BY ID DESC")->result();
	}
}
function hafiz_quran_msc(){
	$dpt=$this->session->userdata("active_admin_depart");
	if ($dpt=='admin' || $dpt=='all') {
		return $this->db->query("SELECT * FROM `tbl_msc_students` WHERE hafiz ='Yes' ORDER BY ID DESC")->result();
	}
	else{
		return $this->db->query("SELECT * FROM `tbl_msc_students` WHERE department='$dpt' AND  hafiz = 'Yes' ORDER BY ID DESC")->result();
	}
}
function hafiz_quran_ms(){
	$dpt=$this->session->userdata("active_admin_depart");
	if ($dpt=='admin' || $dpt=='all') {
		return $this->db->query("SELECT * FROM `tbl_ms_students` WHERE hafiz ='Yes' ORDER BY ID DESC")->result();
	}
	else{
		return $this->db->query("SELECT * FROM `tbl_ms_students` WHERE department='$dpt' AND  hafiz = 'Yes' ORDER BY ID DESC")->result();
	}
}
// Sports

function sports_bs(){
		$dpt=$this->session->userdata("active_admin_depart");
	if ($dpt=='admin' || $dpt=='all') {
		return $this->db->query("SELECT * FROM `tbl_bs_students` WHERE category ='Sports' ORDER BY ID DESC")->result();
	}
	else{
		return $this->db->query("SELECT * FROM `tbl_bs_students` WHERE department='$dpt' AND  category ='Sports' ORDER BY ID DESC")->result();
	}
}
function sports_msc(){
	$dpt=$this->session->userdata("active_admin_depart");
	if ($dpt=='admin' || $dpt=='all') {
		return $this->db->query("SELECT * FROM `tbl_msc_students` WHERE category ='Sports' ORDER BY ID DESC")->result();
	}
	else{
		return $this->db->query("SELECT * FROM `tbl_msc_students` WHERE department='$dpt' AND  category ='Sports' ORDER BY ID DESC")->result();
	}
}
function sports_ms(){
	$dpt=$this->session->userdata("active_admin_depart");
	if ($dpt=='admin' || $dpt=='all') {
		return $this->db->query("SELECT * FROM `tbl_ms_students` WHERE category ='Sports' ORDER BY ID DESC")->result();
	}
	else{
		return $this->db->query("SELECT * FROM `tbl_ms_students` WHERE department='$dpt' AND  category ='Sports' ORDER BY ID DESC")->result();
	}
}
// Disabled

function disabled_bs(){
		$dpt=$this->session->userdata("active_admin_depart");
	if ($dpt=='admin' || $dpt=='all') {
		return $this->db->query("SELECT * FROM `tbl_bs_students` WHERE category ='Disabled' ORDER BY ID DESC")->result();
	}
	else{
		return $this->db->query("SELECT * FROM `tbl_bs_students` WHERE department='$dpt' AND  category ='Disabled' ORDER BY ID DESC")->result();
	}
}
function disabled_msc(){
	$dpt=$this->session->userdata("active_admin_depart");
	if ($dpt=='admin' || $dpt=='all') {
		return $this->db->query("SELECT * FROM `tbl_msc_students` WHERE category ='Disabled' ORDER BY ID DESC")->result();
	}
	else{
		return $this->db->query("SELECT * FROM `tbl_msc_students` WHERE department='$dpt' AND  category ='Disabled' ORDER BY ID DESC")->result();
	}
}
function disabled_ms(){
	$dpt=$this->session->userdata("active_admin_depart");
	if ($dpt=='admin' || $dpt=='all') {
		return $this->db->query("SELECT * FROM `tbl_ms_students` WHERE category ='Disabled' ORDER BY ID DESC")->result();
	}
	else{
		return $this->db->query("SELECT * FROM `tbl_ms_students` WHERE department='$dpt' AND  category ='Disabled' ORDER BY ID DESC")->result();
	}
}
// Tribal Area

function quota_bs(){
		$dpt=$this->session->userdata("active_admin_depart");
	if ($dpt=='admin' || $dpt=='all') {
		return $this->db->query("SELECT * FROM `tbl_bs_students` WHERE category IN('Balochistan','Tribal area of DGK','FATA','AJK') ORDER BY ID DESC")->result();
	}
	else{
		return $this->db->query("SELECT * FROM `tbl_bs_students` WHERE department='$dpt' AND  category IN('Balochistan','Tribal area of DGK','FATA','AJK') ORDER BY ID DESC")->result();
	}
}
function quota_msc(){
	$dpt=$this->session->userdata("active_admin_depart");
	if ($dpt=='admin' || $dpt=='all') {
		return $this->db->query("SELECT * FROM `tbl_msc_students` WHERE category IN('Balochistan','Tribal area of DGK','FATA','AJK') ORDER BY ID DESC")->result();
	}
	else{
		return $this->db->query("SELECT * FROM `tbl_msc_students` WHERE department='$dpt' AND  category IN('Balochistan','Tribal area of DGK','FATA','AJK') ORDER BY ID DESC")->result();
	}
}
function quota_ms(){
	$dpt=$this->session->userdata("active_admin_depart");
	if ($dpt=='admin' || $dpt=='all') {
		return $this->db->query("SELECT * FROM `tbl_ms_students` WHERE category IN('Balochistan','Tribal area of DGK','FATA','AJK') ORDER BY ID DESC")->result();
	}
	else{
		return $this->db->query("SELECT * FROM `tbl_ms_students` WHERE department='$dpt' AND  category IN('Balochistan','Tribal area of DGK','FATA','AJK') ORDER BY ID DESC")->result();
	}
}
function getlist_msc(){
		$dpt=$this->session->userdata("active_admin_depart");
	if ($dpt=='admin' || $dpt=='all') {
		return $this->db->query("SELECT * FROM `tbl_msc_students` ORDER BY ID DESC")->result();
	}
	else{
		return $this->db->query("SELECT * FROM `tbl_msc_students` WHERE department='$dpt' ORDER BY ID DESC")->result();
	}
}

function getlist_ms(){
		$dpt=$this->session->userdata("active_admin_depart");
	if ($dpt=='admin' || $dpt=='all') {
		return $this->db->query("SELECT * FROM `tbl_ms_students` ORDER BY ID DESC")->result();
	}
	else{
		return $this->db->query("SELECT * FROM `tbl_ms_students` WHERE department='$dpt' ORDER BY ID DESC")->result();
	}
}

// updated on 30-9-2020
function merit_generator_bs(){
	$getting_data=$this->db->query("SELECT * FROM `tbl_bs_students` WHERE status!='5'")->result();
	$obtained_marks=0;
	foreach ($getting_data as $value) {
		$obtained_marks=$value->inter_omarks;
		if ($value->hafiz=='Yes') {
			$obtained_marks=$value->inter_omarks+20;
		}
		if ($value->inter_year<2019) {
			for ($i=0; $i < (2019 - $value->inter_year); $i++) { 
				$obtained_marks=$obtained_marks-2;
			}
		}
		$percentage=round(($obtained_marks/$value->inter_tmarks)*100,2);
		// echo $percentage.' / ';
		$this->db->query("INSERT INTO `tbl_bs_merit_lists`(`student_id`, `total_marks`, `obtained_marks`, `percentage`) VALUES ('$value->ID','$value->inter_tmarks','$obtained_marks','$percentage')");
	}
}
function genrate_merit_list_bs($department,$session,$posts){
		$data=$this->db->query("SELECT * FROM `tbl_bs_merit_lists` INNER JOIN `tbl_bs_students` ON tbl_bs_merit_lists.student_id = tbl_bs_students.ID WHERE tbl_bs_students.department = '$department' ORDER BY tbl_bs_merit_lists.percentage DESC LIMIT $posts")->result();
			$n=0;
	$filename = $department.'('.$session.')'.date('d-m-Y').'.csv'; 
   header("Content-Description: File Transfer"); 
   header("Content-Disposition: attachment; filename=$filename"); 
   header("Content-Type: application/csv; ");
   $file = fopen('php://output', 'w');
   $header = array("#","Application ID", "Student Name", "Father Name","CNIC", "Obtained marks","Total marks","Hafiz", "Percentage"); 
   fputcsv($file, $header);
		foreach ($data as $record) {
			$id=$record->ID;
			$this->db->query("UPDATE tbl_bs_students SET status='4' WHERE ID='$id'");
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
	


	function genrate_merit_list_msc($department,$session,$posts){
		$data=$this->db->query("SELECT * FROM `tbl_msc_merit_lists` INNER JOIN `tbl_msc_students` ON tbl_msc_merit_lists.student_id = tbl_msc_students.ID WHERE tbl_msc_students.department = '$department' AND tbl_msc_students.psession = '$session' ORDER BY tbl_msc_merit_lists.percentage DESC LIMIT $posts")->result();
		print_r($data);
	}
	function genrate_merit_list_ms($department,$session,$posts){
		$data=$this->db->query("SELECT * FROM `tbl_ms_merit_lists` INNER JOIN `tbl_ms_students` ON tbl_ms_merit_lists.student_id = tbl_ms_students.ID WHERE tbl_ms_students.department = '$department' AND tbl_ms_students.psession = '$session' ORDER BY tbl_ms_merit_lists.percentage DESC LIMIT $posts")->result();
		print_r($data);
	}

}



?>