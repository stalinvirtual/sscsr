<?php

namespace App\Models;

use App\System\DB\DB;
use App\System\Route;

class Admitcard extends DB
{
    private $table_name = 'admitcard';
    public function __construct()
    {
        parent::__construct('admitcard', 'appno');
    }
    //written exam
    public function getAdmitcard($data_array)
    {

        //echo $this->last_query;

        //$this->printr($data_array);
        $originalDate = $data_array['dob'];


        $table_name = $data_array['table_name'];
        $tier_id = $data_array['tier_id'];
        $register_number = $data_array['register_number'];
        $newDate = date("dmY", strtotime($originalDate));
        $value = explode("_", $table_name);
        $value[2] = "kyas";
        $kyas_tbl_name = implode("_", $value);
        $exam_code = $value[0] . $value[1];

        $tier_id = $this->cleanData($tier_id);
        $exam_code = $this->cleanData($exam_code);



        $instructions_sql  = $this->select("count(*)")
            ->from("admitcard_important_instructions")
            ->where(['exam_tier' => $tier_id, 'exam_code' => $exam_code])
            ->get_one();


        $instructions_count = $instructions_sql;


        $kyas_tbl_name = $this->cleanData($kyas_tbl_name);

        $table_name = $this->cleanData($table_name);

        $newDate = $this->cleanData($newDate);

        $register_number = $this->cleanData($register_number);
        $tier_id = $this->cleanData($tier_id);






        if ($instructions_count->count == 0) {

            $sql  = $this->select("
            kd.reg_no,kd.exam_code,kd.cand_name,kd.dob,kd.photo_id,kd.sign_id, kd.gender,kd.category,
            CONCAT(kd.present_address,', ',kd.present_district,', ',kd.present_state,', ',kd.present_pincode) as candidate_address,
               ted.scribe_opted_medium,ted.roll_no,ted.ticket_no,ted.repotime,ted.gateclose,

               ted.paper1 as paper1,ted.subject1 as subject1,
               ted.date1 as date1,ted.time1 as time1,
               ted.shift1 as shift1,ted.mark1 as mark1,

               ted.paper2 as paper2,ted.subject2 as subject2,
               ted.date2 as date2,ted.time2 as time2,
               ted.shift2 as shift2,ted.mark2 as mark2,

               ted.paper3 as paper3,ted.subject3 as subject3,
               ted.date3 as date3,ted.time3 as time3,
               ted.shift3 as shift3,ted.mark3 as mark3,

               ted.paper4 as paper4,ted.subject4 as subject4,
               ted.date4 as date4,ted.time4 as time4,
               ted.shift4 as shift4,ted.mark1 as mark4,
               
               t.tier_name, t.tier_id")
                ->from("$kyas_tbl_name  kd ")
                ->join("$table_name ted  ", "kd.reg_no = ted.reg_no and kd.exam_code = ted.exam_code", "JOIN")
                ->join("tier_master t", "ted.tier_id = cast(t.tier_id as char(255))", "JOIN")
                ->where(['kd.dob' => $newDate, 'kd.reg_no' => $register_number, 'ted.tier_id' => $tier_id])
                ->get_one();
        } else {

            $sql  = $this->select("
            kd.reg_no,kd.exam_code,kd.cand_name,kd.dob,kd.photo_id,kd.sign_id, kd.gender,kd.category,
            CONCAT(kd.present_address,', ',kd.present_district,', ',kd.present_state,', ',kd.present_pincode) as candidate_address,
               ted.scribe_opted_medium,ted.roll_no,ted.ticket_no,ted.repotime,ted.gateclose,
               ii.pdf_attachment,

               ted.paper1 as paper1,ted.subject1 as subject1,
               ted.date1 as date1,ted.time1 as time1,
               ted.shift1 as shift1,ted.mark1 as mark1,

               ted.paper2 as paper2,ted.subject2 as subject2,
               ted.date2 as date2,ted.time2 as time2,
               ted.shift2 as shift2,ted.mark2 as mark2,

               ted.paper3 as paper3,ted.subject3 as subject3,
               ted.date3 as date3,ted.time3 as time3,
               ted.shift3 as shift3,ted.mark3 as mark3,

               ted.paper4 as paper4,ted.subject4 as subject4,
               ted.date4 as date4,ted.time4 as time4,
               ted.shift4 as shift4,ted.mark1 as mark4,

               t.tier_name, t.tier_id")
                ->from("$kyas_tbl_name  kd ")
                ->join("$table_name ted  ", "kd.reg_no = ted.reg_no and kd.exam_code = ted.exam_code", "JOIN")
                ->join("admitcard_important_instructions ii  ", "ted.exam_code = ii.exam_code and ted.tier_id = ii.exam_tier", "JOIN")
                ->join("tier_master t", "ted.tier_id = cast(t.tier_id as char(255))", "JOIN")
                ->where(['kd.dob' => $newDate, 'kd.reg_no' => $register_number, 'ted.tier_id' => $tier_id])
                ->get_one();
        }
        $getcandidaterecord = $sql;
        return $getcandidaterecord;
    }
    // Get DV Admit card 
    public function getAdmitcardforDV($data_array)
    {

        $originalDate = $data_array['dob'];
        $table_name = $data_array['table_name'];
        $tier_id = $data_array['tier_id'];
        $register_number = $data_array['register_number'];
        $newDate = $this->getDobFormat($originalDate);
        $value = explode("_", $table_name);
        $value[2] = "kyas";
        $kyas_tbl_name = implode("_", $value);
        $exam_code = $value[0] . $value[1];


        $tier_id = $this->cleanData($tier_id);
        $exam_code = $this->cleanData($exam_code);

        $instructions_sql  = $this->select("count(*)")
            ->from("admitcard_important_instructions")
            ->where(['exam_tier' => $tier_id, 'exam_code' => $exam_code])
            ->get_one();

        $instructions_count = $instructions_sql;


        $kyas_tbl_name = $this->cleanData($kyas_tbl_name);

        $table_name = $this->cleanData($table_name);

        $newDate = $this->cleanData($newDate);

        $register_number = $this->cleanData($register_number);
        $tier_id = $this->cleanData($tier_id);

        if($data_array['roll_no'] != "" && $data_array['post_preference'] ==""){

            $whereArray = array(
                'kd.dob' => $newDate, 
                'kd.reg_no' => $register_number,
                 'ted.tier_id' => $tier_id,
                 'ted.roll_no' => $data_array['roll_no']
            );

        }
        elseif($data_array['roll_no'] != "" && $data_array['post_preference'] !=""){

            $whereArray = array(
                'kd.dob' => $newDate, 
                'kd.reg_no' => $register_number,
                 'ted.tier_id' => $tier_id,
                 'ted.roll_no' => $data_array['roll_no'],
                 'ted.post_preference' => $data_array['post_preference']
            );

        }
        else{

           

          
        $str = "ted.dv_date::date - (SELECT tm.no_of_days FROM sscsr_db_table_tier_master tm
        LEFT JOIN $kyas_tbl_name k ON k.exam_code = tm.exam_code where tm.table_name = '$table_name' and tm.tier_id = '$tier_id' LIMIT 1)  <= current_date
        AND current_date <= ted.dv_date::date ";
        $whereArray = array(
            'kd.dob'      => $newDate, 
            'kd.reg_no'   => $register_number,
            'ted.tier_id' => $tier_id,
             $str         => date('Y-m-d')
            
        );

           

        }
        if ($instructions_count->count == 0) {
            $sql  = $this->select("kd.*,ted.*,t.tier_name, t.tier_id")
                ->from("$kyas_tbl_name kd ")
                ->join("$table_name ted ", "kd.reg_no = ted.reg_no and trim(kd.exam_code) = trim(ted.exam_code) ", "JOIN")

                ->join("tier_master t", "ted.tier_id = cast(t.tier_id as char(255))", "JOIN")
                ->where($whereArray)
                ->get_one();
        } else {

            $sql  = $this->select("kd.*,ted.*,t.tier_name, t.tier_id, ted.*,t.tier_name, t.tier_id , ii.pdf_attachment")
                ->from("$kyas_tbl_name kd ")
                ->join("$table_name ted ", "kd.reg_no = ted.reg_no and trim(kd.exam_code) = trim(ted.exam_code) ", "JOIN")
                ->join("admitcard_important_instructions ii ", "trim(ted.exam_code) = trim(ii.exam_code)and ted.tier_id = ii.exam_tier ", "JOIN")
                ->join("tier_master t", "ted.tier_id = cast(t.tier_id as char(255))", "JOIN")
                ->where($whereArray)
                ->get_one();
        }



        // echo $this->last_query;
        // echo $sql;
       //  exit;


        $getcandidaterecord = $sql;

        return $getcandidaterecord;
    }


    //Get DV Admit card


    // Get PET Admit Card


    public function getAdmitcardforPET($data_array)
    {

        $originalDate = $data_array['dob'];
        $newDate = $this->getDobFormat($originalDate);


        $table_name = $data_array['table_name'];
        $tier_id = $data_array['tier_id'];
        $register_number = $data_array['register_number'];

        $value = explode("_", $table_name);
        $value[2] = "kyas";
        $kyas_tbl_name = implode("_", $value);
        $exam_code = $value[0] . $value[1];

        $tier_id = $this->cleanData($tier_id);
        $exam_code = $this->cleanData($exam_code);

        $exam_code = trim($exam_code);

        //9962016104 sheela loan

        $instructions_sql  = $this->select("count(*)")
            ->from("admitcard_important_instructions")
            ->where(['exam_tier' => $tier_id, 'exam_code' => $exam_code])
            ->get_one();

        $instructions_count = $instructions_sql;



        $kyas_tbl_name = $this->cleanData($kyas_tbl_name);

        $table_name = $this->cleanData($table_name);

        $newDate = $this->cleanData($newDate);

        $register_number = $this->cleanData($register_number);
        $tier_id = $this->cleanData($tier_id);

        



        $str = "ted.pet_date::date - (SELECT tm.no_of_days FROM sscsr_db_table_tier_master tm
        LEFT JOIN $kyas_tbl_name k ON k.exam_code = tm.exam_code where tm.table_name = '$table_name' and tm.tier_id = '$tier_id' LIMIT 1)  <= current_date
        AND current_date <= ted.pet_date::date ";





        // echo $str;
        // exit;

        if ($instructions_count->count == 0) {

            $sql  = $this->select("kd.*,ted.*,t.tier_name, t.tier_id ,
            CONCAT(kd.present_address,', ',kd.present_district,', ',kd.present_state,', ',substring(kd.present_pincode,1,6)) as candidate_address")
                ->from("$kyas_tbl_name kd ")
                ->join("$table_name ted ", "kd.reg_no = ted.reg_no and trim(kd.exam_code) = trim(ted.exam_code) ", "JOIN")
                ->join("tier_master t", "ted.tier_id = cast(t.tier_id as char(255))", "JOIN")
                ->where(['kd.dob' => $newDate, 'kd.reg_no' => $register_number, 'ted.tier_id' => $tier_id])
                ->wherecondition($str)
                ->get_one();
        } else {

            $sql  = $this->select("kd.*,ted.*,t.tier_name, t.tier_id, ted.*,t.tier_name, t.tier_id , ii.pdf_attachment,
            CONCAT(kd.present_address,', ',kd.present_district,', ',kd.present_state,', ',substring(kd.present_pincode,1,6)) as candidate_address")
                ->from("$kyas_tbl_name kd ")
                ->join("$table_name ted ", "kd.reg_no = ted.reg_no and trim(kd.exam_code) = trim(ted.exam_code) ", "JOIN")

                ->join("admitcard_important_instructions ii ", "trim(ted.exam_code) = trim(ii.exam_code) and ted.tier_id = ii.exam_tier ", "JOIN")

                ->join("tier_master t", "ted.tier_id = cast(t.tier_id as char(255))", "JOIN")
                ->where(['kd.dob' => $newDate, 'kd.reg_no' => $register_number, 'ted.tier_id' => $tier_id])
                ->wherecondition($str)
                ->get_one();
        }


        $getcandidaterecord = $sql;

        return $getcandidaterecord;
    }
    // Get PET Admit Card




    // Get Tier Admit Card



    public function getAdmitcardforTierCount($data_array){
        $originalDate    = $data_array['dob'];
        $newDate         = $this->getDobFormat($originalDate);
        $table_name      = $data_array['table_name'];
        $tier_id         = $data_array['tier_id'];
        $register_number = $data_array['register_number'];
        $value           = explode("_", $table_name);
        $value[2]        = "kyas";
        $kyas_tbl_name   = implode("_", $value);
        $exam_code       = $value[0] . $value[1];
        $tier_id         = $this->cleanData($tier_id);
        $exam_code       = $this->cleanData($exam_code);
        $candidate_count = $this->select("count(*)")
                ->from("$kyas_tbl_name kd ")
                ->join("$table_name ted ", "kd.reg_no = ted.reg_no and trim(kd.exam_code) = trim(ted.exam_code) ", "JOIN")
                ->join("tier_master t", "ted.tier_id = cast(t.tier_id as char(255))", "JOIN")
                ->where(['kd.dob' => $newDate, 'kd.reg_no' => $register_number, 'ted.tier_id' => $tier_id])
                ->get_one();
        $count          = $candidate_count->count;
               // echo $this->last_query;
                //exit;
        return $count;

    }

    public function getAdmitcardforTierPreview($data_array)
    {

        $originalDate = $data_array['dob'];
        $newDate = $this->getDobFormat($originalDate);
        $table_name = $data_array['table_name'];
        $tier_id = $data_array['tier_id'];
        $register_number = $data_array['register_number'];

        $value = explode("_", $table_name);
        $value[2] = "kyas";
        $kyas_tbl_name = implode("_", $value);
        $exam_code = $value[0] . $value[1];



        $tier_id = $this->cleanData($tier_id);
        $exam_code = $this->cleanData($exam_code);

        $instructions_sql  = $this->select("count(*)")
            ->from("admitcard_important_instructions")
            ->where(['exam_tier' => $tier_id, 'exam_code' => $exam_code])
            ->get_one();

      





        $kyas_tbl_name = $this->cleanData($kyas_tbl_name);

        $table_name = $this->cleanData($table_name);

        $newDate = $this->cleanData($newDate);

        $register_number = $this->cleanData($register_number);
        $tier_id = $this->cleanData($tier_id);

        

        $instructions_count = $instructions_sql;
        if ($instructions_count->count == 0) {
            if($data_array['roll_no'] != "" && $data_array['post_preference'] ==""){

                $whereArray = array(
                    'kd.dob' => $newDate, 
                    'kd.reg_no' => $register_number,
                     'ted.tier_id' => $tier_id,
                     'ted.roll_no' => $data_array['roll_no']
                );

            }
            elseif($data_array['roll_no'] != "" && $data_array['post_preference'] !=""){

                $whereArray = array(
                    'kd.dob' => $newDate, 
                    'kd.reg_no' => $register_number,
                     'ted.tier_id' => $tier_id,
                     'ted.roll_no' => $data_array['roll_no'],
                     'ted.post_preference' => $data_array['post_preference']
                );

            }
            else{

                

                $whereArray = array(
                    'kd.dob'      => $newDate, 
                    'kd.reg_no'   => $register_number,
                    'ted.tier_id' => $tier_id,
                    
                );

            }

           



            $sql  = $this->select("kd.*,ted.*,t.tier_name, t.tier_id ,
            CONCAT(kd.present_address,', ',kd.present_district,', ',kd.present_state,', ',substring(kd.present_pincode,1,6)) as candidate_address")
                ->from("$kyas_tbl_name kd ")
                ->join("$table_name ted ", "kd.reg_no = ted.reg_no and trim(kd.exam_code) = trim(ted.exam_code) ", "JOIN")
                ->join("tier_master t", "ted.tier_id = cast(t.tier_id as char(255))", "JOIN")
                ->where($whereArray)
                ->get_one();
              
        } else {

            $sql  = $this->select("kd.*,ted.*,t.tier_name, t.tier_id, ted.*,t.tier_name, t.tier_id , ii.pdf_attachment,
            CONCAT(kd.present_address,', ',kd.present_district,', ',kd.present_state,', ',substring(kd.present_pincode,1,6)) as candidate_address")
                ->from("$kyas_tbl_name kd ")
                ->join("$table_name ted ", "kd.reg_no = ted.reg_no and trim(kd.exam_code) = trim(ted.exam_code) ", "JOIN")

                ->join("admitcard_important_instructions ii ", "trim(ted.exam_code) = trim(ii.exam_code) and ted.tier_id = ii.exam_tier ", "JOIN")

                ->join("tier_master t", "ted.tier_id = cast(t.tier_id as char(255))", "JOIN")
                ->where(['kd.dob' => $newDate, 'kd.reg_no' => $register_number, 'ted.tier_id' => $tier_id])
                ->get_one();
               
        }
        $getcandidaterecord = $sql;
        //  echo $this->last_query;
        //         exit;

        return $getcandidaterecord;
    }






    public function getAdmitcardforTier($data_array)
    {

      

        $originalDate = $data_array['dob'];
        $newDate = $this->getDobFormat($originalDate);
        $table_name = $data_array['table_name'];
        $tier_id = $data_array['tier_id'];
        $register_number = $data_array['register_number'];

        $value = explode("_", $table_name);
        $value[2] = "kyas";
        $kyas_tbl_name = implode("_", $value);
        $exam_code = $value[0] . $value[1];



        $tier_id = $this->cleanData($tier_id);
        $exam_code = $this->cleanData($exam_code);

        $instructions_sql  = $this->select("count(*)")
            ->from("admitcard_important_instructions")
            ->where(['exam_tier' => $tier_id, 'exam_code' => $exam_code])
            ->get_one();

        $kyas_tbl_name = $this->cleanData($kyas_tbl_name);

        $table_name = $this->cleanData($table_name);

        $newDate = $this->cleanData($newDate);

        $register_number = $this->cleanData($register_number);
        $tier_id = $this->cleanData($tier_id);

        $instructions_count = $instructions_sql;
        if ($instructions_count->count == 0) {
            if($data_array['roll_no'] != "" && $data_array['post_preference'] ==""){

                $whereArray = array(
                    'kd.dob' => $newDate, 
                    'kd.reg_no' => $register_number,
                     'ted.tier_id' => $tier_id,
                     'ted.roll_no' => $data_array['roll_no']
                );

            }
            elseif($data_array['roll_no'] != "" && $data_array['post_preference'] !=""){

                $whereArray = array(
                    'kd.dob' => $newDate, 
                    'kd.reg_no' => $register_number,
                     'ted.tier_id' => $tier_id,
                     'ted.roll_no' => $data_array['roll_no'],
                     'ted.post_preference' => $data_array['post_preference']
                );

            }
            else{

               

                if($tier_id == "1"){
                    $str = "ted.date1::date - (SELECT tm.no_of_days FROM sscsr_db_table_tier_master tm
                    LEFT JOIN $kyas_tbl_name k ON k.exam_code = tm.exam_code where tm.table_name = '$table_name' and tm.tier_id = '$tier_id' LIMIT 1)  <= current_date
                    AND current_date <= ted.date1::date ";

                    
                }
                else{


                 
                    $str = "COALESCE(
                        LEAST(
                          CASE WHEN date1 = 'NA' THEN NULL ELSE TO_DATE(date1, 'DD-MM-YYYY') END,
                          CASE WHEN date2 = 'NA' THEN NULL ELSE TO_DATE(date2, 'DD-MM-YYYY') END,
                          CASE WHEN date3 = 'NA' THEN NULL ELSE TO_DATE(date3, 'DD-MM-YYYY') END,
                          CASE WHEN date4 = 'NA' THEN NULL ELSE TO_DATE(date4, 'DD-MM-YYYY') END,
                          CASE WHEN date5 = 'NA' THEN NULL ELSE TO_DATE(date5, 'DD-MM-YYYY') END,
                          CASE WHEN date6 = 'NA' THEN NULL ELSE TO_DATE(date6, 'DD-MM-YYYY') END
                        ),
                        '9999-12-31'::DATE
                      )- (SELECT tm.no_of_days FROM sscsr_db_table_tier_master tm
                                     LEFT JOIN $kyas_tbl_name k ON k.exam_code = tm.exam_code  where tm.table_name = '$table_name' and tm.tier_id = '$tier_id' LIMIT 1)  <= current_date
                                     AND current_date <= COALESCE(
                        LEAST(
                          CASE WHEN date1 = 'NA' THEN NULL ELSE TO_DATE(date1, 'DD-MM-YYYY') END,
                          CASE WHEN date2 = 'NA' THEN NULL ELSE TO_DATE(date2, 'DD-MM-YYYY') END,
                          CASE WHEN date3 = 'NA' THEN NULL ELSE TO_DATE(date3, 'DD-MM-YYYY') END,
                          CASE WHEN date4 = 'NA' THEN NULL ELSE TO_DATE(date4, 'DD-MM-YYYY') END,
                          CASE WHEN date5 = 'NA' THEN NULL ELSE TO_DATE(date5, 'DD-MM-YYYY') END,
                          CASE WHEN date6 = 'NA' THEN NULL ELSE TO_DATE(date6, 'DD-MM-YYYY') END
                        ),
                        '9999-12-31'::DATE
                      )";

                }

                // $str = "ted.date1::date - (SELECT tm.no_of_days FROM sscsr_db_table_tier_master tm
                // LEFT JOIN $kyas_tbl_name k ON k.exam_code = tm.exam_code LIMIT 1)  <= current_date
                // AND current_date <= ted.date1::date";
                

                date_default_timezone_set('Asia/Kolkata'); 
                $whereArray = array(
                    'kd.dob' => $newDate, 
                    'kd.reg_no' => $register_number,
                     'ted.tier_id' => $tier_id,
                    
                    
                );

            }

           



            $sql  = $this->select("kd.*,ted.*,t.tier_name, t.tier_id ,
            CONCAT(kd.present_address,', ',kd.present_district,', ',kd.present_state,', ',substring(kd.present_pincode,1,6)) as candidate_address")
                ->from("$kyas_tbl_name kd ")
                ->join("$table_name ted ", "kd.reg_no = ted.reg_no and trim(kd.exam_code) = trim(ted.exam_code) ", "JOIN")
                ->join("tier_master t", "ted.tier_id = cast(t.tier_id as char(255))", "JOIN")
                ->where($whereArray)
                ->wherecondition($str)
                ->get_one();


                // echo '<pre>';
                // print_r($instructions_sql);
               
              
        } else {

            if($tier_id == "1"){
                $str = "ted.date1::date - (SELECT tm.no_of_days FROM sscsr_db_table_tier_master tm
                LEFT JOIN $kyas_tbl_name k ON k.exam_code = tm.exam_code where tm.table_name = '$table_name' and tm.tier_id = '$tier_id' LIMIT 1)  <= current_date
                AND current_date <= ted.date1::date";
            }
            else{
               

                
                $str = "COALESCE(
                    LEAST(
                      CASE WHEN date1 = 'NA' THEN NULL ELSE TO_DATE(date1, 'DD-MM-YYYY') END,
                      CASE WHEN date2 = 'NA' THEN NULL ELSE TO_DATE(date2, 'DD-MM-YYYY') END,
                      CASE WHEN date3 = 'NA' THEN NULL ELSE TO_DATE(date3, 'DD-MM-YYYY') END,
                      CASE WHEN date4 = 'NA' THEN NULL ELSE TO_DATE(date4, 'DD-MM-YYYY') END,
                      CASE WHEN date5 = 'NA' THEN NULL ELSE TO_DATE(date5, 'DD-MM-YYYY') END,
                      CASE WHEN date6 = 'NA' THEN NULL ELSE TO_DATE(date6, 'DD-MM-YYYY') END
                    ),
                    '9999-12-31'::DATE
                  )- (SELECT tm.no_of_days FROM sscsr_db_table_tier_master tm
                                 LEFT JOIN $kyas_tbl_name k ON k.exam_code = tm.exam_code  
                                 where tm.table_name = '$table_name' and tm.tier_id = '$tier_id' LIMIT 1)  <= current_date
                                 AND current_date <= COALESCE(
                    LEAST(
                      CASE WHEN date1 = 'NA' THEN NULL ELSE TO_DATE(date1, 'DD-MM-YYYY') END,
                      CASE WHEN date2 = 'NA' THEN NULL ELSE TO_DATE(date2, 'DD-MM-YYYY') END,
                      CASE WHEN date3 = 'NA' THEN NULL ELSE TO_DATE(date3, 'DD-MM-YYYY') END,
                      CASE WHEN date4 = 'NA' THEN NULL ELSE TO_DATE(date4, 'DD-MM-YYYY') END,
                      CASE WHEN date5 = 'NA' THEN NULL ELSE TO_DATE(date5, 'DD-MM-YYYY') END,
                      CASE WHEN date6 = 'NA' THEN NULL ELSE TO_DATE(date6, 'DD-MM-YYYY') END
                    ),
                    '9999-12-31'::DATE
                  )";

            }

            // $str = "ted.date1::date - (SELECT tm.no_of_days FROM sscsr_db_table_tier_master tm
            // LEFT JOIN $kyas_tbl_name k ON k.exam_code = tm.exam_code LIMIT 1)  <= current_date
            // AND current_date <= ted.date1::date";
            date_default_timezone_set('Asia/Kolkata'); 

            $whereArray = array(
                'kd.dob' => $newDate, 
                'kd.reg_no' => $register_number,
                 'ted.tier_id' => $tier_id 
                // $str         => date('Y-m-d')
                
            );

            $sql  = $this->select("kd.*,ted.*,t.tier_name, t.tier_id, ted.*,t.tier_name, t.tier_id , ii.pdf_attachment,
            CONCAT(kd.present_address,', ',kd.present_district,', ',kd.present_state,', ',substring(kd.present_pincode,1,6)) as candidate_address")
                ->from("$kyas_tbl_name kd ")
                ->join("$table_name ted ", "kd.reg_no = ted.reg_no and trim(kd.exam_code) = trim(ted.exam_code) ", "JOIN")

                ->join("admitcard_important_instructions ii ", "trim(ted.exam_code) = trim(ii.exam_code) and ted.tier_id = ii.exam_tier ", "JOIN")

                ->join("tier_master t", "ted.tier_id = cast(t.tier_id as char(255))", "JOIN")
                ->where($whereArray)
                ->wherecondition($str)
                ->get_one();
               
        }
            //echo $this->last_query;
            //  exit;
      

        $getcandidaterecord = $sql;

        return $getcandidaterecord;
    }
    // Get Tier Admit Card

    // Get Skill Test Admit Card
    public function getAdmitcardforSkillTest($data_array)
    {
        $originalDate = $data_array['dob'];
        $newDate = $this->getDobFormat($originalDate);
        $table_name = $data_array['table_name'];
        $tier_id = $data_array['tier_id'];
        $register_number = $data_array['register_number'];

        $value = explode("_", $table_name);
        $value[2] = "kyas";
        $kyas_tbl_name = implode("_", $value);
        $exam_code = $value[0] . $value[1];


        $tier_id = $this->cleanData($tier_id);
        $exam_code = $this->cleanData($exam_code);

        $instructions_sql  = $this->select("count(*)")
            ->from("admitcard_important_instructions")
            ->where(['exam_tier' => $tier_id, 'exam_code' => $exam_code])
            ->get_one();

        $instructions_count = $instructions_sql;

        $kyas_tbl_name = $this->cleanData($kyas_tbl_name);

        $table_name = $this->cleanData($table_name);

        $newDate = $this->cleanData($newDate);

        $register_number = $this->cleanData($register_number);
        $tier_id = $this->cleanData($tier_id);
        
       

        $str = "ted.skill_test_date::date - (SELECT tm.no_of_days FROM sscsr_db_table_tier_master tm
        LEFT JOIN $kyas_tbl_name k ON k.exam_code = tm.exam_code where tm.table_name = '$table_name' and tm.tier_id = '$tier_id' LIMIT 1)  <= current_date
        AND current_date <= ted.skill_test_date::date ";
        $whereArray = array(
            'kd.dob'      => $newDate, 
            'kd.reg_no'   => $register_number,
            'ted.tier_id' => $tier_id,
           
            
        );

        if ($instructions_count->count == 0) {

            $sql  = $this->select("kd.*,ted.*,t.tier_name, t.tier_id ,
            CONCAT(kd.present_address,', ',kd.present_district,', ',kd.present_state,', ',substring(kd.present_pincode,1,6)) as candidate_address")
                ->from("$kyas_tbl_name kd ")
                ->join("$table_name ted ", "kd.reg_no = ted.reg_no and trim(kd.exam_code) = trim(ted.exam_code) ", "JOIN")

                ->join("tier_master t", "ted.tier_id = cast(t.tier_id as char(255))", "JOIN")
                ->where($whereArray)
                ->wherecondition($str)
                ->get_one();
        } else {

            $sql  = $this->select("kd.*,ted.*,t.tier_name, t.tier_id, ted.*,t.tier_name, t.tier_id , ii.pdf_attachment,
					CONCAT(kd.present_address,', ',kd.present_district,', ',kd.present_state,', ',substring(kd.present_pincode,1,6)) as candidate_address")
                ->from("$kyas_tbl_name kd ")
                ->join("$table_name ted ", "kd.reg_no = ted.reg_no and trim(kd.exam_code) = trim(ted.exam_code) ", "JOIN")

                ->join("admitcard_important_instructions ii ", "trim(ted.exam_code) = trim(ii.exam_code)
                 and ted.tier_id = ii.exam_tier ", "JOIN")

                ->join("tier_master t", "ted.tier_id = cast(t.tier_id as char(255))", "JOIN")
                ->where($whereArray)
                ->wherecondition($str)
                ->get_one();
        }

       


        $getcandidaterecord = $sql;
        return $getcandidaterecord;
    }
    // Get Skill Test Admit Card 

    // Get DME Admit Card


    public function getAdmitcardforDME($data_array)
    {

        $originalDate = $data_array['dob'];
        $table_name = $data_array['table_name'];
        $tier_id = $data_array['tier_id'];
        $register_number = $data_array['register_number'];
        $newDate = $this->getDobFormat($originalDate);
        $value = explode("_", $table_name);
        $value[2] = "kyas";
        $kyas_tbl_name = implode("_", $value);
        $exam_code = $value[0] . $value[1];

        $tier_id = $this->cleanData($tier_id);
        $exam_code = $this->cleanData($exam_code);

        $instructions_sql  = $this->select("count(*)")
            ->from("admitcard_important_instructions")
            ->where(['exam_tier' => $tier_id, 'exam_code' => $exam_code])
            ->get_one();

        $instructions_count = $instructions_sql;


        $kyas_tbl_name = $this->cleanData($kyas_tbl_name);

        $table_name = $this->cleanData($table_name);

        $newDate = $this->cleanData($newDate);

        $register_number = $this->cleanData($register_number);
        $tier_id = $this->cleanData($tier_id);
        
        $str = "ted.date_of_dme::date - (SELECT tm.no_of_days FROM sscsr_db_table_tier_master tm
        LEFT JOIN $kyas_tbl_name k ON k.exam_code = tm.exam_code where tm.table_name = '$table_name' and tm.tier_id = '$tier_id' LIMIT 1)  <= current_date
        AND current_date <= ted.date_of_dme::date ";

        if ($instructions_count->count == 0) {

            $sql  = $this->select("kd.*,ted.*,t.tier_name, t.tier_id,
            CONCAT(kd.present_address,', ',kd.present_district,', ',kd.present_state,', ',substring(kd.present_pincode,1,6)) as candidate_address")
                ->from("$kyas_tbl_name kd ")
                ->join("$table_name ted ", "kd.reg_no = ted.reg_no and trim(kd.exam_code) = trim(ted.exam_code) ", "JOIN")



                ->join("tier_master t", "ted.tier_id = cast(t.tier_id as char(255))", "JOIN")
                ->where(['kd.dob' => $newDate, 'kd.reg_no' => $register_number, 'ted.tier_id' => $tier_id])
                ->wherecondition($str)
                ->get_one();
        } else {

            $sql  = $this->select("kd.*,ted.*,t.tier_name, t.tier_id, ted.*,t.tier_name, t.tier_id , ii.pdf_attachment,
            CONCAT(kd.present_address,kd.present_district,kd.present_state,substring(kd.present_pincode,1,6)) as candidate_address")
                ->from("$kyas_tbl_name kd ")
                ->join("$table_name ted ", "kd.reg_no = ted.reg_no and trim(kd.exam_code) = trim(ted.exam_code) ", "JOIN")
                ->join("admitcard_important_instructions ii ", "trim(ted.exam_code) = trim(ii.exam_code)  and ted.tier_id = ii.exam_tier ", "JOIN")
                ->join("tier_master t", "ted.tier_id = cast(t.tier_id as char(255))", "JOIN")
                ->where(['kd.dob' => $newDate, 'kd.reg_no' => $register_number, 'ted.tier_id' => $tier_id])
                ->wherecondition($str)
                ->get_one();
        }
        //echo $sql;

        $getcandidaterecord = $sql;

        return $getcandidaterecord;
    }
    // Get DME Admit Card

    public function getCountAdmitcard($app_no, $dob, $examname)
    {
        $getDetails = array(
            "register_number" => $app_no,
            "dob" => $dob,
            "examname" => $examname
        );
        $value = explode("_", $examname);

        $dob = date("dmY", strtotime($dob));
        $dob = $this->cleanData($dob);
        $app_no = $this->cleanData($app_no);

        $value[1] = $this->cleanData($value[1]);
        $value[0] = $this->cleanData($value[0]);

        $sql  = $this->select("count(*)")
            ->from("public.kyas_details kd ")
            ->join("tier_exam_details ted", "kd.reg_no = ted.reg_no and kd.exam_code = ted.exam_code ", "JOIN")
            ->join("tier_master t", "ted.tier_id = cast(t.tier_id as char(255))", "JOIN")
            ->join("exam_details ed ", "ted.exam_code = ed.exam_code", "JOIN")
            ->where(['kd.dob' => $dob, 'kd.reg_no' => $app_no, 'ted.tier_id' => $value[1], 'ted.exam_code' => $value[0]])
            ->get_one();



        $getcandidaterecord = $sql;

        return $getcandidaterecord;
    }
    public function getTimeTableDetails($examname)
    {
        $value = explode("_", $examname);


        $value[0] = $this->cleanData($value[0]);


        $sql  = $this->select()
            ->from("exam_timetable_details")
            ->where(['exam_code' => $value[0]])
            ->get_list();
        $getcandidaterecord = $sql;

        return $getcandidaterecord;
    }
    public function getImportantInstructions($examname)
    {
        $value = explode("_", $examname);


        $value[0] = $this->cleanData($value[0]);
        $value[1] = $this->cleanData($value[1]);

        $sql  = $this->select()
            ->from("admitcard_important_instructions")
            ->where(['exam_code' => $value[0], 'exam_tier' => $value[1]])
            ->get_list();

        $getcandidaterecord = $sql;

        return $getcandidaterecord;
    }

    public function getExamName($examname)
    {

        $value = explode("_", $examname);
        $table_exam_short_name = $value[0];
        $table_exam_short_name = $this->cleanData($table_exam_short_name);
        $sql  = $this->select("distinct(tm.table_exam_short_name),tm.table_exam_year ,em.exam_name")
            ->from("public.sscsr_db_table_master tm ")
            ->join("exam_master em", "tm.table_exam_short_name = em.exam_short_name", "JOIN")
            ->where(['tm.table_exam_short_name' => $table_exam_short_name])
            ->get_one();

        $getcandidaterecord = $sql;

        return $getcandidaterecord;
    }

    public function printr($data)
    {
        echo '<pre>';
        print_r($data);
        exit;
    }
    public function getQueryListTIER()
    {

        $sql  = $this->select("col_name,col_description ,is_tier,is_tier_order")
            ->from("column_master")
            ->where(['is_tier' => '1'])
            ->orwhere('or is_tier_order is not null ')
            ->order_by("is_tier_order asc")
            ->get_list();

        $getcandidaterecord = $sql;
        return $getcandidaterecord;
    }


    public function getQueryListSKILLTEST()
    {

        $sql  = $this->select("col_name,col_description ,is_skill,is_skill_order")
            ->from("column_master")
            ->where(['is_skill' => '1'])
            ->orwhere('or is_skill_order is not null ')
            ->order_by("is_skill_order asc")
            ->get_list();
        $getcandidaterecord = $sql;
        return $getcandidaterecord;
    }




    public function getQueryListPET()
    {
        $sql  = $this->select("col_name,col_description ,is_pet,is_pet_order")
            ->from("column_master")
            ->where(['is_pet' => '1'])
            ->orwhere('or is_pet_order is not null ')
            ->order_by("is_pet_order asc")
            ->get_list();
        $getcandidaterecord = $sql;
        return $getcandidaterecord;
    }

    public function getQueryListDV()
    {
        $getcandidaterecord  = $this->select("col_name,col_description ,is_dv,is_dv_order")
            ->from("column_master")
            ->where(['is_dv' => '1'])
            ->orwhere('or is_dv_order is not null ')
            ->order_by("is_dv_order asc")
            ->get_list();
        return $getcandidaterecord;
    }

    public function getQueryListDME()
    {
        $getcandidaterecord  = $this->select("col_name,col_description ,is_dme,is_dme_order")
            ->from("column_master")
            ->where(['is_dme' => '1'])
            ->orwhere('or is_dme_order is not null ')
            ->order_by("is_dme_order asc")
            ->get_list();
        return $getcandidaterecord;
    }
    public function getDobFormat($originalDate)
    {
        $newDate = date("d-m-Y", strtotime($originalDate));
        return $newDate;
    }
    function cleanData($val)
    {
        return pg_escape_string($val);
    }



    // Get Tier Admit Card


    public function getAdmitcardforTierEmailIntetgration($data_array)
    {
        $table_name = $data_array['table_name'];
        $tier_id = $data_array['tier_id'];
        $value = explode("_", $table_name);
        $value[2] = "kyas";
        $kyas_tbl_name = implode("_", $value);
        $exam_code = $value[0] . $value[1];
        $instructions_sql  = $this->select("count(*)")
            ->from("admitcard_important_instructions")
            ->where(['exam_tier' => $tier_id, 'exam_code' => $exam_code])
            ->get_one();

        $instructions_count = $instructions_sql;
        if ($instructions_count->count == 0) {

            $categories = array('10003199941', '91000199334', '81000099928', '10002299277', '81000099443', '10001198854', '10002998490', '71000199413', '10001299745');

            // $categories =array('10003299781','10001199415');

            $sql  = $this->select("kd.*,ted.*,t.tier_name, t.tier_id ,
        CONCAT(kd.present_address,', ',kd.present_district,', ',kd.present_state,', ',kd.present_pincode) as candidate_address")
                ->from("$kyas_tbl_name kd ")
                ->join("$table_name ted ", "kd.reg_no = ted.reg_no and kd.exam_code = ted.exam_code ", "JOIN")
                ->join("tier_master t", "ted.tier_id = cast(t.tier_id as char(255))", "JOIN")
                ->where(['ted.tier_id' => $tier_id])
                // ->limitEmail(6,0)
                ->where_in("kd.reg_no", $categories)
                ->get_list();
        } else {

            $sql  = $this->select("kd.*,ted.*,t.tier_name, t.tier_id, ted.*,t.tier_name, t.tier_id , ii.pdf_attachment,
            CONCAT(kd.present_address,', ',kd.present_district,', ',kd.present_state,', ',kd.present_pincode) as candidate_address")
                ->from("$kyas_tbl_name kd ")
                ->join("$table_name ted ", "kd.reg_no = ted.reg_no and kd.exam_code = ted.exam_code ", "JOIN")

                ->join("admitcard_important_instructions ii ", "ted.exam_code = ii.exam_code and ted.tier_id = ii.exam_tier ", "JOIN")

                ->join("tier_master t", "ted.tier_id = cast(t.tier_id as char(255))", "JOIN")
                ->where(['ted.tier_id' => $tier_id])
                ->limitEmail(2, 0)
                ->get_list();
        }

        $getcandidaterecord = $sql;


        return $getcandidaterecord;
    }

    public function getAdmitcardforTierSendEmail($data_array)
    {
        $table_name = $data_array['table_name'];
        $tier_id = $data_array['tier_id'];
        $value = explode("_", $table_name);
        $value[2] = "kyas";
        $kyas_tbl_name = implode("_", $value);
        $exam_code = $value[0] . $value[1];
        $instructions_sql  = $this->select("count(*)")
            ->from("admitcard_important_instructions")
            ->where(['exam_tier' => $tier_id, 'exam_code' => $exam_code])
            ->get_one();

        $instructions_count = $instructions_sql;
        if ($instructions_count->count == 0) {
            // only for google email
            $categories = array('10003199941', '91000199334', '81000099928', '10002299277', '81000099443', '10001198854', '10002998490', '71000199413', '10001299745');
            // only for nic email
            // $categories =array('10003299781','10001199415');

            $sql  = $this->select("kd.*,ted.*,t.tier_name, t.tier_id ,
        CONCAT(kd.present_address,', ',kd.present_district,', ',kd.present_state,', ',kd.present_pincode) as candidate_address")
                ->from("$kyas_tbl_name kd ")
                ->join("$table_name ted ", "kd.reg_no = ted.reg_no and kd.exam_code = ted.exam_code ", "JOIN")
                ->join("tier_master t", "ted.tier_id = cast(t.tier_id as char(255))", "JOIN")
                ->where(['ted.tier_id' => $tier_id])
                // ->limitEmail(6,0)
                ->where_in("kd.reg_no", $categories)
                ->get_list();
        } else {

            $sql  = $this->select("kd.*,ted.*,t.tier_name, t.tier_id, ted.*,t.tier_name, t.tier_id , ii.pdf_attachment,
            CONCAT(kd.present_address,', ',kd.present_district,', ',kd.present_state,', ',kd.present_pincode) as candidate_address")
                ->from("$kyas_tbl_name kd ")
                ->join("$table_name ted ", "kd.reg_no = ted.reg_no and kd.exam_code = ted.exam_code ", "JOIN")

                ->join("admitcard_important_instructions ii ", "ted.exam_code = ii.exam_code and ted.tier_id = ii.exam_tier ", "JOIN")

                ->join("tier_master t", "ted.tier_id = cast(t.tier_id as char(255))", "JOIN")
                ->where(['ted.tier_id' => $tier_id])
                ->limitEmail(2, 0)
                ->get_list();
        }

        $getcandidaterecord = $sql;


        return $getcandidaterecord;
    }


    public function updateAcPrint($tablename, $data = array(), $id = 0)
    {
       // echo "<pre>";

       // $b = array("tablename"=>$tablename, "data"=>$data, "id"=>$id);
      //  print_r($b);





        return $this->updateRawQuery($tablename, $data, ['id' => $id]);
    }
    public function getPostPreference($table_name , $roll_no)
    {
        $sql  = $this->select('post_preference')
            ->from($table_name)
            ->where(['roll_no' => $roll_no])
            ->get_list();
        $getcandidaterecord = $sql;

        return $getcandidaterecord;
    }

    public function getNo($tier_id,$tableName){

        $instructions_sql  = $this->select("no_of_days")
            ->from("sscsr_db_table_tier_master")
            ->where(['tier_id' => $tier_id, 'table_name' =>$tableName])
            ->get_one();

            return  $instructions_sql ;

    }
}
