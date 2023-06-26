<?php

namespace App\Models;

use App\System\DB\DB;
use App\System\Route;

class Nomination extends DB
{
    private $table_name = 'mstnominationtbl';
    public function __construct()
    {
        parent::__construct('mstnominationtbl', 'nomination_id');
    }
    public function getNominations($parent_id = 0)
    {
        $nominations = $this->select()
            ->from($this->table_name)
            ->get_list();
        return $nominations;
    }
    public function getNomination($id = 0, $type = null)
    {
        if ($id == 0) {
            return $this->getEmptyNomination($type);
        } else {
            return $this->select()->from($this->table_name)->where(['nomination_id' => $id])->get_one($type);
        }
    }
    public function getEmptyNomination($type = null)
    {
        $empty_menu  = [
            'nomination_id' => 0,
            'exam_name' => '',
            'category_id' => '',
            'effect_from_date' => '',
            'effect_to_date' => ''
        ];
        if ($type == DB_OBJECT) {
            $empty_menu = (object) $empty_menu;
        }
        return $empty_menu;
    }
    public function addNomination($data = array())
    {

        return $this->insert($data);
    }
    public function updateNomination($data = array(), $id = 0)
    {
        return $this->update($data, ['nomination_id' => $id]);
    }
    public function lastInsertedId($parent_id = 0)
    {
        $fetch_row  = $this->select('max(nomination_id)')
            ->from("mstnominationtbl")
            ->get_one(DB_ASSOC);
        $lastinsertid = (array)$fetch_row;
        return $lastinsertid;
    }
    public function getNominationsList($parent_id = 0)
    {



        $fetch_all =  $this->select('P.*,category.category_name')
            ->from("mstnominationtbl P ")
            ->join("mstcategory category ", "P.category_id = category.category_id ", "JOIN")
            ->order_by('P.nomination_id desc')
            ->get_list();
        $lastinsertid = (object)$fetch_all;
        return $lastinsertid;
    }
    public function getHomeNominationsList($parent_id = 0)
    {
        $fetch_all =  $this->select('P.*,category.category_name')
            ->from("mstnominationtbl P ")
            ->join("mstcategory category ", "P.category_id = category.category_id ", "JOIN")
            ->where(['p_status' => '1'])
            ->order_by('P.effect_from_date desc')
            ->get_list();
        $lastinsertid = (object)$fetch_all;
        return $lastinsertid;
    }

    /******
     * 
     * Nomination List Home For Latest News
     * 
     * 
     * 
     */

    public function getHomeNominationsListLatestNews($parent_id = 0)
    {
        $fetch_all =  $this->select('P.*,category.category_name')
            ->from("mstnominationtbl P ")
            ->join("mstcategory category ", "P.category_id = category.category_id ", "JOIN")
            ->where(['p_status' => '1'])
            // ->wherecondition("P.effort_from_date > current_date - interval '2 days'")
            ->order_by('P.effect_from_date desc')
            ->fetchtwo('fetch first 2 rows only')
            ->get_list();
        $lastinsertid = (object)$fetch_all;
        return $lastinsertid;
    }



    // Publish and Unpublished

    public function updateNominationState($data = array(), $id = 0)
    {
        return $this->update($data, ['nomination_id' => $id]);
    }
    public function deleteNomination($nomination_id = 0)
    {
        $delete_row = $this->delete($nomination_id);
        return $delete_row;
    }




    public function getNominationsArchievesList()
    {
        $fetch_all =  $this->select('P.*,category.category_name')
            ->from("mstnominationtbl P ")
            ->join("mstcategory category ", "P.category_id = category.category_id ", "JOIN")
            ->order_by('P.nomination_id desc')
            ->get_list();
        $lastinsertid = (object)$fetch_all;
        return $lastinsertid;
    }


    public function getNominationDetails($year, $month, $effect_from_date, $effect_to_date, $searchQuery)
    {
        if ($month == 'All') {

            if ($searchQuery == " ") {
                $str = <<<TEXT
                to_char("effect_to_date", 'YYYY')='$year' 
TEXT;
            } else {
                $str = <<<TEXT
                to_char("effect_to_date", 'YYYY')='$year' and  $searchQuery
TEXT;
            }

            





            $getlist =  $this->select('P.*,category.category_name')
                ->from("mstnominationtbl P ")
                ->join("mstcategory category ", "P.category_id = category.category_id ", "JOIN")
                ->whereconditionarchieves($str)
                ->order_by('P.effect_to_date desc')
                ->get_list();
        } else {

            if ($searchQuery == " ") {
                $str = <<<TEXT
                to_char("effect_to_date", 'MM')='$month' and 
                to_char("effect_to_date", 'YYYY')='$year' and
                effect_from_date >='$effect_from_date' and
                effect_to_date <= '$effect_to_date' 
TEXT;
            }
            else{
                $str = <<<TEXT
                to_char("effect_to_date", 'MM')='$month' and 
                to_char("effect_to_date", 'YYYY')='$year' and
                effect_from_date >='$effect_from_date' and
                effect_to_date <= '$effect_to_date'  $searchQuery
TEXT;

            }






         



            $getlist =  $this->select('P.*,category.category_name')
                ->from("mstnominationtbl P ")
                ->join("mstcategory category ", "P.category_id = category.category_id ", "JOIN")
                ->whereconditionarchieves($str)
                ->order_by('P.effect_to_date desc')
                ->get_list();
        }


        //                         $query = <<<TEXT


        //                 select * from mstnominationtbl  where 
        //                 to_char("effect_to_date", 'MM')='$month' and 
        //                             to_char("effect_to_date", 'YYYY')='$year' and
        //                             effect_from_date >='$effect_from_date' and
        //                             effect_to_date <= '$effect_to_date'
        // TEXT;
        // echo  $query;


        // echo '<pre>';
        // print_R( $getlist);
        //exit;

        return  $getlist;
    }




    public function archiveNominationStatus($nomination_id = 0)
    {
        if (is_array($nomination_id)) {
            $nomination_id = implode(",", $nomination_id);
        }


        $sql = "INSERT INTO archives.mstnominationarchivestbl (nomination_id, exam_name,effect_from_date, effect_to_date, p_status, date_archived ) 
        SELECT nomination_id, exam_name, effect_from_date, effect_to_date, '0', NOW()
       FROM public.mstnominationtbl WHERE nomination_id IN ($nomination_id)";


        $delete_row = $this->execute($sql);




        $sql1 = "INSERT INTO archives.mstnominationarchiveschildtbl(
         nomination_id, pdf_name, attachment, status)
         SELECT nomination_id, pdf_name, attachment, '0'
       FROM public.mstnominationchildtbl WHERE nomination_id IN ($nomination_id)";

        $childtable_insert =  $this->execute($sql1);





        $delId = explode(",", $nomination_id);
        foreach ($delId as $val) {
            $this->delete($val);
        }





        //echo  $sql;
        //exit;




        return $childtable_insert;
    }


    public function totalRecordsWithOutFiltering()
    {

        $fetch_all =  $this->select('count(*) as allcount')
            ->from("mstnominationtbl P ")
            ->join("mstcategory category ", "P.category_id = category.category_id ", "JOIN")
            ->get_one();
        $count = $fetch_all;
        return $count;
    }



    public function totalRecordWithFiltering($searchQuery)
    {

        $finalquery = <<<HTML
  
         '1' $searchQuery
        HTML;

        //  echo   $finalquery;
        // exit;

        $fetch_all =  $this->select('*')
            ->from("mstnominationtbl P ")
            ->join("mstcategory category ", "P.category_id = category.category_id ", "JOIN")
            ->whereconditiondatatable($finalquery)
            ->get_one();



       // echo "select * as allcount from  mstnominationtbl where '1' $searchQuery";


        //echo '<pre>';






        //print_r($fetch_all );
        $count = $fetch_all;
        return $count;
    }


    public function totalRecordsWithFiltering($searchQuery)
    {


        if ($searchQuery == " ") {
            $finalquery = <<<HTML

      '1'
HTML;

        }
        else{

            $finalquery = <<<HTML

            '1' and $searchQuery
 HTML;

        }

     

        //  echo   $finalquery;
        // exit;

        $fetch_all =  $this->select('count(*) as allcount')
            ->from("mstnominationtbl P ")
            ->join("mstcategory category ", "P.category_id = category.category_id ", "JOIN")
            ->whereconditiondatatable($finalquery)
            ->get_one();



        // echo "select count(*) as allcount from  mstnominationtbl where '1' $searchQuery";


        //echo '<pre>';






        //print_r($fetch_all );
        $count = $fetch_all;
        return $count;
    }

    public function checkNominationId($id)
    {


        $fetch_all =  $this->select('count(*) as checkid')
            ->from("mstnominationtbl P ")
            //->join("mstcategory category ", "P.category_id = category.category_id ", "JOIN")
            ->where(['nomination_id' => $id])
            ->get_one();
        $count = $fetch_all;
        return $count;
    }
}
