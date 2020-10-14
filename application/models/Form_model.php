<?php
/**
 * 
 */
class Form_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	function departments(){
		return $this->db->query("SELECT DISTINCT(Department_name) FROM tbl_department_programs")->result();
	}

	function registered_bs_student($cdate,$Challan,$bank,$branch,$applyforcourse,$psession,$applyon,$category,$department,$st_program,$sname,$gender,$fname,$profession,$m_income,$cnic,$nation,$domile,$religion,$hafiz,$blood_group,$dob,$email,$cellno,$ep_name,$ep_relation,$g_cellno,$address,$stay,$matric_board,$matric_year,$matric_rollno,$matric_omarks,$matric_tmarks,$matric_percentage,$matric_div,$matric_subjects,$inter_board,$inter_year,$inter_rollno,$inter_omarks,$inter_tmarks,$inter_percentage,$inter_div,$inter_subjects,$profile){
		$current_date=date('Y-m-d');

		return $this->db->query("INSERT INTO tbl_bs_students(applyforcourse, psession, applyon, category, department, st_program, sname, gender, fname, profession, m_income, cnic, nation, domile, religion, hafiz, blood_group, dob, email, cellno, ep_name, ep_relation, g_cellno, address, stay, matric_board, matric_year, matric_rollno, matric_omarks, matric_tmarks, matric_percentage, matric_div, matric_subjects, inter_board, inter_year, inter_rollno, inter_omarks, inter_tmarks, inter_percentage, inter_div, inter_subjects, registered_date,profile,challan,bank,bank_branch,challan_date) VALUES ('$applyforcourse','$psession','$applyon','$category','$department','$st_program','$sname','$gender','$fname','$profession','$m_income','$cnic','$nation','$domile','$religion','$hafiz','$blood_group','$dob','$email','$cellno','$ep_name','$ep_relation','$g_cellno','$address','$stay','$matric_board','$matric_year','$matric_rollno','$matric_omarks','$matric_tmarks','$matric_percentage','$matric_div','$matric_subjects','$inter_board','$inter_year','$inter_rollno','$inter_omarks','$inter_tmarks','$inter_percentage','$inter_div','$inter_subjects','$current_date','$profile','$Challan','$bank','$branch','$cdate')");
	}


	function registered_ms_student($cdate,$Challan,$bank,$branch,$applyforcourse,$psession,$applyon,$category,$department,$st_program,$sname,$gender,$fname,$profession,$m_income,$cnic,$nation,$domile,$religion,$hafiz,$blood_group,$dob,$email,$cellno,$ep_name,$ep_relation,$g_cellno,$address,$stay,$matric_board,$matric_year,$matric_rollno,$matric_omarks,$matric_tmarks,$matric_percentage,$matric_div,$matric_subjects,$inter_board,$inter_year,$inter_rollno,$inter_omarks,$inter_tmarks,$inter_percentage,$inter_div,$inter_subjects,$bachelor_board,$bachelor_year,$bachelor_rollno,$bachelor_omarks,$bachelor_tmarks,$bachelor_percentage,$bachelor_div,$bachelor_subjects,$master_board,$master_year,$master_rollno,$master_omarks,$master_tmarks,$master_percentage,$master_div,$master_subjects,$profile){
			$current_date=date('Y-m-d');
			return $this->db->query("INSERT INTO tbl_ms_students(applyforcourse, psession, applyon, category, department, st_program, sname, gender, fname, profession, m_income, cnic, nation, domile, religion, hafiz, blood_group, dob, email, cellno, ep_name, ep_relation, g_cellno, address, stay, matric_board, matric_year, matric_rollno, matric_omarks, matric_tmarks, matric_percentage, matric_div, matric_subjects, inter_board, inter_year, inter_rollno, inter_omarks, inter_tmarks, inter_percentage, inter_div, inter_subjects, bachelor_board, bachelor_year, bachelor_rollno, bachelor_omarks, bachelor_tmarks, bachelor_percentage, bachelor_div, bachelor_subjects, master_board, master_year, master_rollno, master_omarks, master_tmarks, master_percentage, master_div, master_subjects, registered_date,profile,challan,bank,bank_branch,challan_date) VALUES ('$applyforcourse','$psession','$applyon','$category','$department','$st_program','$sname','$gender','$fname','$profession','$m_income','$cnic','$nation','$domile','$religion','$hafiz','$blood_group','$dob','$email','$cellno','$ep_name','$ep_relation','$g_cellno','$address','$stay','$matric_board','$matric_year','$matric_rollno','$matric_omarks','$matric_tmarks','$matric_percentage','$matric_div','$matric_subjects','$inter_board','$inter_year','$inter_rollno','$inter_omarks','$inter_tmarks','$inter_percentage','$inter_div','$inter_subjects','$bachelor_board','$bachelor_year','$bachelor_rollno','$bachelor_omarks','$bachelor_tmarks','$bachelor_percentage','$bachelor_div','$bachelor_subjects','$master_board','$master_year','$master_rollno','$master_omarks','$master_tmarks','$master_percentage','$master_div','$master_subjects','$current_date','$profile','$Challan','$bank','$branch','$cdate')");

	}

	function registered_msc_student($cdate,$Challan,$bank,$branch,$applyforcourse,$psession,$applyon,$category,$department,$st_program,$sname,$gender,$fname,$profession,$m_income,$cnic,$nation,$domile,$religion,$hafiz,$blood_group,$dob,$email,$cellno,$ep_name,$ep_relation,$g_cellno,$address,$stay,$matric_board,$matric_year,$matric_rollno,$matric_omarks,$matric_tmarks,$matric_percentage,$matric_div,$matric_subjects,$inter_board,$inter_year,$inter_rollno,$inter_omarks,$inter_tmarks,$inter_percentage,$inter_div,$inter_subjects,$bachelor_board,$bachelor_year,$bachelor_rollno,$bachelor_omarks,$bachelor_tmarks,$bachelor_percentage,$bachelor_div,$bachelor_subjects,$profile){
		$current_date=date('Y-m-d');


			return $this->db->query("INSERT INTO tbl_msc_students(applyforcourse, psession, applyon, category, department, st_program, sname, gender, fname, profession, m_income, cnic, nation, domile, religion, hafiz, blood_group, dob, email, cellno, ep_name, ep_relation, g_cellno, address, stay, matric_board, matric_year, matric_rollno, matric_omarks, matric_tmarks, matric_percentage, matric_div, matric_subjects, inter_board, inter_year, inter_rollno, inter_omarks, inter_tmarks, inter_percentage, inter_div, inter_subjects, bachelor_board, bachelor_year, bachelor_rollno, bachelor_omarks, bachelor_tmarks, bachelor_percentage, bachelor_div, bachelor_subjects,registered_date,profile,challan,bank,bank_branch,challan_date) VALUES ('$applyforcourse','$psession','$applyon','$category','$department','$st_program','$sname','$gender','$fname','$profession','$m_income','$cnic','$nation','$domile','$religion','$hafiz','$blood_group','$dob','$email','$cellno','$ep_name','$ep_relation','$g_cellno','$address','$stay','$matric_board','$matric_year','$matric_rollno','$matric_omarks','$matric_tmarks','$matric_percentage','$matric_div','$matric_subjects','$inter_board','$inter_year','$inter_rollno','$inter_omarks','$inter_tmarks','$inter_percentage','$inter_div','$inter_subjects','$bachelor_board','$bachelor_year','$bachelor_rollno','$bachelor_omarks','$bachelor_tmarks','$bachelor_percentage','$bachelor_div','$bachelor_subjects','$current_date','$profile','$Challan','$bank','$branch','$cdate')");

		



	}
	function check_already_exists($applyforcourse,$psession,$department,$st_program,$cnic,$sname,$gender){
		$check_bs=$this->db->query("SELECT * FROM tbl_bs_students WHERE psession='$psession' AND department='$department' AND st_program='$st_program' AND cnic='$cnic' AND sname='$sname' AND gender='$gender'")->num_rows();

		$check_msc=$this->db->query("SELECT * FROM tbl_msc_students WHERE psession='$psession' AND department='$department' AND st_program='$st_program' AND cnic='$cnic' AND sname='$sname' AND gender='$gender'")->num_rows();

		$check_ms=$this->db->query("SELECT * FROM tbl_ms_students WHERE psession='$psession' AND department='$department' AND st_program='$st_program' AND cnic='$cnic' AND sname='$sname' AND gender='$gender'")->num_rows();
		if ($check_bs>0 || $check_msc>0 || $check_ms>0) {
			return false;
		}
		else{
			return true;
		}

	}
	function check_challan($Challan){
		$check_bs=$this->db->query("SELECT * FROM tbl_bs_students WHERE challan='$Challan'")->num_rows();

		$check_msc=$this->db->query("SELECT * FROM tbl_msc_students WHERE challan='$Challan'")->num_rows();

		$check_ms=$this->db->query("SELECT * FROM tbl_ms_students WHERE challan='$Challan'")->num_rows();
		if ($check_bs>0 || $check_msc>0 || $check_ms>0) {
			return false;
		}
		else{
			return true;
		}
	}
	function check_status_bs($cnic){
		return $this->db->query("SELECT * FROM tbl_bs_students WHERE cnic='$cnic'")->result();
	}
	function check_status_ms($cnic){
		return $this->db->query("SELECT * FROM tbl_ms_students WHERE cnic='$cnic'")->result();
	}
	function check_status_msc($cnic){
		return $this->db->query("SELECT * FROM tbl_msc_students WHERE cnic='$cnic'")->result();
	}
}

?>