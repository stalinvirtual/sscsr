<?php

namespace App\Models;

use App\System\DB\DB;
use App\System\Route;
use App\Helpers\Helpers;

class Gallery extends DB
{
    private $table_name = 'mstgallerytbl';
    public function __construct()
    {
        parent::__construct('mstgallerytbl', 'gallery_id');
    }
    public function getGalleries($parent_id = 0)
    {
        $nominations = $this->select()
            ->from($this->table_name)
            ->get_list();
        return $nominations;
    }
    public function getGalleryList($parent_id = 0)
    {

        // $sql = " select g.gallery_id,g.event_id,g.year,g.p_status,ec.event_name from mstgallerytbl g JOIN msteventcategory ec  on g.event_id = ec.event_id order by g.gallery_id desc";


        $sql = $this->select("g.gallery_id,g.event_id,g.year,g.p_status,ec.event_name")
            ->from('mstgallerytbl g')
            ->join("msteventcategory ec", "g.event_id = ec.event_id ", "JOIN")
            ->order_by("g.gallery_id desc")
            ->get_list();
        $lastinsertid = $sql;
        $lastinsertid = (object)$lastinsertid;
        return $lastinsertid;
    }

    public function getGallery($id = 0, $type = null)
    {
        if ($id == 0) {
            return $this->getEmptyGallery($type);
        } else {
            return $this->select()->from($this->table_name)->where(['gallery_id' => $id])->get_one($type);
        }
    }


    public function getEmptyGallery($type = null)
    {
        $empty_menu  = [
            'gallery_id' => 0,
            'event_id' => '',
            'category_id' => '',
            'effect_from_date' => '',
            'effect_to_date' => '',
            'creation_date' => '',
            'p_status' => '',
            'year' => '',

        ];
        if ($type == DB_OBJECT) {
            $empty_menu = (object) $empty_menu;
        }
        return $empty_menu;
    }
    public function addGallery($data = array())
    {

        return $this->insert($data);
    }
    public function updateGallery($data = array(), $id = 0)
    {
        return $this->update($data, ['gallery_id' => $id]);
    }
    public function lastInsertedId($parent_id = 0)
    {

        $sql  = $this->select("max(gallery_id)")
            ->from('mstgallerytbl')
            ->get_one(DB_ASSOC);
        $lastinsertid = $sql;
        $lastinsertid = (array)$lastinsertid;
        return $lastinsertid;
    }
    public function getEventCategoryList($parent_id = 0)
    {


        $sql  = $this->select("P.*,category.event_name")
            ->from("mstgallerytbl P")
            ->join("msteventcategory category", "P.event_id = category.event_id  ", "JOIN")
            ->order_by("P.effect_from_date desc")
            ->get_list();
        $lastinsertid = $sql;
        $lastinsertid = (object)$lastinsertid;
        return $lastinsertid;
    }
    public function getHomePhotoGalleryList($parent_id = 0)
    {
        $sql = $this->select("g.gallery_id,
         g.event_id,
         g.year,
         gc.image_id,
         gc.image_path,
         ec.event_name")
            ->from("mstgallerytbl g")
            ->join(" mstgallerychildtbl gc ", "g.gallery_id = gc.gallery_id ", "JOIN")
            ->join(" msteventcategory ec ", "g.event_id = ec.event_id ", "JOIN")
          //  ->order_by("g.effect_from_date desc")
            ->get_list();
        $lastinsertid = $sql;
        $lastinsertid = (object)$lastinsertid;
        return $lastinsertid;
    }
    // Publish and Unpublished

    public function updateNominationState($data = array(), $id = 0)
    {
        return $this->update($data, ['nomination_id' => $id]);
    }


    public function getGalleryDistinctedYears($q)
    {

        //$sql = "SELECT distinct(year) from mstgallerytbl";

        $sql  = $this->select("distinct(year)")
            ->from("mstgallerytbl")
            ->get_list();
        $lastinsertid = $sql;
        $lastinsertid = (object)$lastinsertid;
        return $lastinsertid;
    }


    public function DistinctedYears()
    {

        //$sql = "SELECT distinct(year) from mstgallerytbl";

        $sql  = $this->select("distinct(year)")
            ->from("mstgallerytbl")
            ->get_list();
        // echo $this->last_query;
        $lastinsertid = $sql;
        $lastinsertid = (object)$lastinsertid;
        return $lastinsertid;
    }


    public function getGallerychild($parent_id = 0)
    {
        $nominationchildtbllist = $this->select('*')
            ->from('mstgallerychildtbl')
            ->get_list();
        return $nominationchildtbllist;
    }


    public function getGalleryEventsByYears($year)
    {




        $sql =  $this->select("ec.event_name,g.gallery_id")
            ->from("mstgallerytbl g ")
            ->join("msteventcategory ec ", "g.event_id = ec.event_id and g.year ='$year'", "JOIN")
            ->where(['g.p_status' => '1'])
            ->order_by("g.gallery_id desc")
            ->get_list();
        //echo $this->last_query;
        $lastinsertid = $sql;
        $lastinsertid = (object)$lastinsertid;

        return $lastinsertid;
    }

    public function getGalleryidBasedImagesModel($q)
    {



        if ($q == 'on') {


            $sql =  $this->select("g.gallery_id,
 g.event_id,
 g.year,
 gc.image_id,
 gc.image_path,
 ec.event_name")
                ->from("mstgallerytbl g ")
                ->join("mstgallerychildtbl gc ", "g.gallery_id = gc.gallery_id ", "JOIN")
                ->join("msteventcategory ec ", "g.event_id = ec.event_id ", "JOIN")
                ->where(['g.p_status' => '1'])
                ->order_by("g.gallery_id desc")
                ->get_list();

            //echo $this->last_query;

        } else {
            $sql =  $this->select("g.gallery_id,
         g.event_id,
         g.year,
         gc.image_id,
         gc.image_path,
         ec.event_name")
                ->from("mstgallerytbl g ")
                ->join("mstgallerychildtbl gc ", "g.gallery_id = gc.gallery_id ", "JOIN")
                ->join("msteventcategory ec ", "g.event_id = ec.event_id ", "JOIN")
                ->where(['g.p_status' => '1', 'g.gallery_id' => $q])
                ->order_by("g.gallery_id desc")
                ->get_list();
        }
       // echo $this->last_query;
        $lastinsertid = $sql;
        $lastinsertid = (object)$lastinsertid;
        return $lastinsertid;
    }

    public function deleteGallery($gallery_id = 0)
    {
       

        $delId = explode(",", $gallery_id);
        foreach ($delId as $val) {
            $delete_row = $this->delete($val);
        }

        return $delete_row;
    }


    // Publish and Unpublished

    public function updateGalleryState($data = array(), $id = 0)
    {
        return $this->update($data, ['gallery_id' => $id]);
    }



    public function totalRecordsWithOutFiltering($year)
    {

        $fetch_all =  $this->select('count(*) as allcount')
            ->from("mstgallerytbl")
            ->where(['year' => $year])
            ->get_one();
           // echo $this->last_query;


        $count = $fetch_all;
        return $count;
    }
    public function totalRecordsWithFiltering($searchQuery,$year)
    {


        if ($searchQuery == " ") {
            $finalquery = "'1' and year = '$year'";
        } else {

            $finalquery = " '1' $year  and $searchQuery";
        }
        $fetch_all =  $this->select('count(*) as allcount')
            ->from("mstgallerytbl g")
           // ->join("mstgallerychildtbl gc ", "g.gallery_id = gc.gallery_id ", "JOIN")
            ->join("msteventcategory ec ", "g.event_id = ec.event_id ", "JOIN")
            ->whereconditiondatatable($finalquery)
            ->get_one();

           // echo $this->last_query;


        $count = $fetch_all;
        return $count;
    }

    public function getGalleryDetails($year, $searchQuery)
    {
      //  if ($month == 'All') {

            if ($searchQuery == " ") {
                $str = <<<TEXT
                year = '$year'
TEXT;                
              

            } else {
                $str = <<<TEXT
                year = '$year' and $searchQuery
TEXT;                
                
                
                
               // $year ." and " . $searchQuery;
            }
            $getlist =  $this->select('g.*,
           ec.event_name')
                ->from("mstgallerytbl g ")
                ->join("msteventcategory ec ", "g.event_id = ec.event_id ", "JOIN")
                ->whereconditionarchieves($str)
                ->get_list();
           return  $getlist ;


//         } else {

//             if ($searchQuery == " ") {
//                 $str = <<<TEXT
//                to_char("effect_to_date", 'MM')='$month' and
//                to_char("effect_to_date", 'YYYY')='$year' and
//                effect_from_date >='$effect_from_date' and
//                effect_to_date <= '$effect_to_date'
// TEXT;
//             } else {
//                 $str = <<<TEXT
//                to_char("effect_to_date", 'MM')='$month' and
//                to_char("effect_to_date", 'YYYY')='$year' and
//                effect_from_date >='$effect_from_date' and
//                effect_to_date <= '$effect_to_date'  $searchQuery
// TEXT;
//             }
//             $getlist =  $this->select('g.*,
//            ec.event_name')
//                 ->from("mstgallerytbl g ")
//                 ->join("msteventcategory ec ", "g.event_id = ec.event_id ", "JOIN")
//                 ->whereconditionarchieves($str)
//                 ->order_by('g.effect_to_date desc')
//                 ->get_list();
//             // echo $this->last_query;
//         }
//echo $this->last_query;
        return  $getlist;
    }


    public function checkGalleryId($id)
    {
        $fetch_all =  $this->select('count(*) as checkid')
            ->from("mstgallerytbl")
            ->where(['gallery_id' => $id])
            ->get_one();
        $count = $fetch_all;
        return $count;
    }
    public function archiveGalleryStatus($gallery_id = 0)
    {
        if (is_array($gallery_id)) {
            $gallery_id = implode(",", $gallery_id);
        }
        $sql = "INSERT INTO archives.mstgalleryarchivestbl (gallery_id, event_id,year, p_status, date_archived ) 
       SELECT gallery_id, event_id, year,  '0', NOW()
      FROM public.mstgallerytbl WHERE gallery_id IN ($gallery_id)";


        $delete_row = $this->execute($sql);




        $sql1 = "INSERT INTO archives.mstgalleryarchiveschildtbl(
        gallery_id, image_path,  status)
        SELECT gallery_id, image_path,  '0'
      FROM public.mstgallerychildtbl WHERE gallery_id IN ($gallery_id)";

        $childtable_insert =  $this->execute($sql1);





        $delId = explode(",", $gallery_id);
        foreach ($delId as $val) {
            $this->delete($val);
        }





        //echo  $sql;
        //exit;




        return $childtable_insert;
    }



    public function photoGalleryGroup($year)
    {

        if ($year == 'All') {

            $getlist = $this->select("g.event_id,ec.event_name,g.year")
                             ->from("mstgallerytbl g ")
                             ->join("mstgallerychildtbl gc ", "g.gallery_id = gc.gallery_id ", "JOIN")
                             ->join("msteventcategory ec ", "g.event_id = ec.event_id ", "JOIN")
                             ->group_by("g.event_id,ec.event_name,g.year ")
                             ->get_list();

                            // echo $this->last_query;
              
        } else {

//             $str = <<<TEXT
//         to_char("effect_to_date", 'YYYY')='$year'
// TEXT;

           
              //  echo $this->last_query;

              $getlist = $this->select("g.event_id,ec.event_name,g.year")
                             ->from("mstgallerytbl g ")
                             ->join("mstgallerychildtbl gc ", "g.gallery_id = gc.gallery_id ", "JOIN")
                             ->join("msteventcategory ec ", "g.event_id = ec.event_id ", "JOIN")  
                             ->where(['g.year' => $year])
                             ->group_by("g.event_id,ec.event_name,g.year ")
                             ->get_list();

        }

        return $getlist;
    }


    public function photoGallery($year)
    {

        if ($year == 'All') {

            $getlist = $this->select("g.gallery_id,
              g.event_id,
              g.year,
              gc.image_id,
              gc.image_path,
              ec.event_name")
                             ->from("mstgallerytbl g ")
                             ->join("mstgallerychildtbl gc ", "g.gallery_id = gc.gallery_id ", "JOIN")
                             ->join("msteventcategory ec ", "g.event_id = ec.event_id ", "JOIN")
                             ->order_by("g.gallery_id desc")
                             ->get_list();

                             echo $this->last_query;
              
        } else {

            $str = <<<TEXT
        to_char("effect_to_date", 'YYYY')='$year'
TEXT;

           
              //  echo $this->last_query;

              $getlist = $this->select("g.gallery_id,
              g.event_id,
              g.year,
              gc.image_id,
              gc.image_path,
              ec.event_name")
                             ->from("mstgallerytbl g ")
                             ->join("mstgallerychildtbl gc ", "g.gallery_id = gc.gallery_id ", "JOIN")
                             ->join("msteventcategory ec ", "g.event_id = ec.event_id ", "JOIN")  
                             ->whereconditionarchieves($str)
                             ->order_by("g.gallery_id desc")
                             ->get_list();











        }

        return $getlist;
    }
    public function EventBasedLightBox($id){
        $getlist = $this->select("g.gallery_id, g.event_id, g.year, gc.image_id, gc.image_path, ec.event_name")
                             ->from("mstgallerytbl g ")
                             ->join("mstgallerychildtbl gc ", "g.gallery_id = gc.gallery_id ", "JOIN")
                             ->join("msteventcategory ec ", "g.event_id = ec.event_id ", "JOIN")
                             ->where(['g.event_id' => $id])
                             ->order_by("g.gallery_id desc ")
                             ->get_list();
                            // echo $this->last_query;
                             return    $getlist ;

    }


    public function photoGalleryGroupforOneRecord($evenid){
        $getlist = $this->select("g.gallery_id, g.event_id, g.year, gc.image_id, gc.image_path, ec.event_name")
                             ->from("mstgallerytbl g ")
                             ->join("mstgallerychildtbl gc ", "g.gallery_id = gc.gallery_id ", "JOIN")
                             ->join("msteventcategory ec ", "g.event_id = ec.event_id ", "JOIN")
                             ->where(['g.event_id' => $evenid])
                             ->order_by("g.gallery_id desc ")
                             ->limitpostgres('1')
                             ->get_one();
                            // echo $this->last_query;
                             return    $getlist ;

    }


    public function GalleryidBasedEvents($year)
    {

        if ($year == 'All') {

            $getlist = $this->select("ec.event_name")
                             ->from("mstgallerytbl g ")
                             ->join("mstgallerychildtbl gc ", "g.gallery_id = gc.gallery_id ", "JOIN")
                             ->join("msteventcategory ec ", "g.event_id = ec.event_id ", "JOIN")
                             ->group_by("ec.event_name ")
                             ->get_list();
              
        } else {

            $str = <<<TEXT
        to_char("effect_to_date", 'YYYY')='$year'
TEXT;

           
              //  echo $this->last_query;

              $getlist = $this->select("
              g.gallery_id,ec.event_name,g.year ")
                             ->from("mstgallerytbl g ")
                             ->join("mstgallerychildtbl gc ", "g.gallery_id = gc.gallery_id ", "JOIN")
                             ->join("msteventcategory ec ", "g.event_id = ec.event_id ", "JOIN")  
                             ->whereconditionarchieves($str)
                             ->group_by("g.gallery_id,ec.event_name,g.year")
                             ->get_list();

                           //  echo $this->last_query;
                           //  exit;











        }

        return $getlist;
    }
}
