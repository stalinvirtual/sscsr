<?php
namespace App\Models;
use App\System\DB\DB;
use App\System\Route;

class Knowyourstatus extends DB
{
    private $table_name = 'kyas_details';
    public function __construct()
    {
        parent::__construct('kyas_details', 'kyas_id');
    }
	public function getKyas($data_array){
		
	//	$this->printr($data_array);
		
		
	}
	
	
	
	
	
	
	
	
	
   /*  public function getAdmitcard($app_no, $dob,$examname)
    {
		$getDetails = array(
			"register_number" =>$app_no,
			"dob" =>$dob,
			"examname" =>$examname
		);
		$value = explode("_",$examname);

        $dob = date("dmY", strtotime($dob));
		
		
		
		
		
		$sql = "SELECT kd.reg_no,kd.exam_code,kd.cand_name,kd.dob,kd.photo_id,kd.sign_id, kd.gender,kd.category,
CONCAT(kd.present_address,kd.present_district,kd.present_state,kd.present_pincode) as candidate_address, 
CONCAT(ted.venue_name,ted.venue_address) as examvenue1, 
CONCAT(ted.venue_district,ted.venue_state) as examvenue2, 
ted.scribe_opted_medium,ted.roll_no,ted.ticket_no,ted.repotime,ted.gateclose,
t.tier_name, ed.exam_name,ed.exam_month_year FROM public.kyas_details kd 
JOIN tier_exam_details ted ON kd.reg_no = ted.reg_no and kd.exam_code = ted.exam_code
JOIN tier_master t ON ted.tier_id = cast(t.tier_id as char(255)) 
JOIN exam_details ed ON ted.exam_code = ed.exam_code
		where kd.dob = '$dob' and kd.reg_no = '$app_no' and ted.tier_id = '$value[1]' and ted.exam_code ='$value[0]'";
		
		
	
echo $sql;
exit;

        $getcandidaterecord = $this->set_query($sql)->get_one();

        return $getcandidaterecord;
    }
    public function getCountAdmitcard($app_no, $dob,$examname)
    {
		$getDetails = array(
			"register_number" =>$app_no,
			"dob" =>$dob,
			"examname" =>$examname
		);
		$value = explode("_",$examname);

        $dob = date("dmY", strtotime($dob));
        $sql = "SELECT count(*)
		FROM public.kyas_details kd  
		JOIN tier_exam_details ted ON kd.reg_no = ted.reg_no and kd.exam_code = ted.exam_code 
		JOIN tier_master t ON ted.tier_id = cast(t.tier_id  as char(255))
		JOIN exam_details ed ON ted.exam_code = ed.exam_code
		where kd.dob = '$dob' and kd.reg_no = '$app_no' and ted.tier_id = '$value[1]' and ted.exam_code ='$value[0]'";
		
        $getcandidaterecord = $this->set_query($sql)->get_one();

        return $getcandidaterecord;
    }
	 public function getTimeTableDetails($examname)
    {
		$value = explode("_",$examname);
		
		$sql = "select *
from exam_timetable_details where exam_code = '$value[0]' 
and tier_id = '$value[1]'";




        $getcandidaterecord = $this->set_query($sql)->get_list();

        return $getcandidaterecord;
	}
	 public function getImportantInstructions($examname)
    {
		$value = explode("_",$examname);
		
		$sql = "select *
from admitcard_important_instructions where exam_code = '$value[0]' 
and exam_tier = '$value[1]'";


        $getcandidaterecord = $this->set_query($sql)->get_list();

        return $getcandidaterecord;
	} */
	

}
