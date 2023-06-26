<?php

namespace App\Models;

use App\System\DB\DB;

class Candidate extends DB
{
    private $table_name = 'candidate';
    public function __construct()
    {
        parent::__construct('candidate', 'id');
    }
    function createUser($uploadfile)
    {
        $sql = "INSERT INTO PUBLIC." . $this->table_name . "(name,email,mobile_no,address,attachment) " . "VALUES('" . $this->cleanData($_POST['name']) . "','" . $this->cleanData($_POST['email']) . "','" . $this->cleanData($_POST['mobileno']) . "','" . $this->cleanData($_POST['address']) . "','" . $this->cleanData($uploadfile) . "')";
        return pg_affected_rows(pg_query($sql));
    }

    public function getCandidates($parent_id = 0)
    {
        $candidates = $this->select()
            ->from($this->table_name)
            ->where(['state' => 0])
            ->order_by("id")
            ->get_list();
        return $candidates;
    }


    public function getCandidate($id = 0, $type = null)
    {
        if ($id == 0) {
            return $this->getEmptyMenu($type);
        } else {
            return $this->select()->from($this->table_name)->where(['id' => $id])->get_one($type);
        }
    }
    public function getEmptyMenu($type = null)
    {
        $empty_menu  = ['id' => 0, 'fname' => '', 'email' => '', 'mobile_no' => '', 'address' => '', 'state' => 0, 'attachment' => ''];
        if ($type == DB_OBJECT) {
            $empty_menu = (object) $empty_menu;
        }
        return $empty_menu;
    }
    public function addCandidate($data = array())
    {
        return $this->insert($data);
    }
    public function updateCandidate($data = array(), $id = 0)
    {
        return $this->update($data, ['id' => $id]);
    }
    public function updateState($data = array(), $id = 0)
    {
        return $this->update($data, ['id' => $id]);
    }
    public function deleteCandidate($id = 0)
    {
        if ($id == 1) { // Home or Root menu cannot be deleted
            return false;
        }
        // delete the children menu too
        return $this->where("WHERE id = $id OR m_parent_id = $id")->delete();
    }

    function getUserById()
    {

        $sql = "select *from public." . $this->table_name . "  where id='" . $this->cleanData($_POST['id']) . "'";
        return pg_query($sql);
    }
    function getMenuById($menu_id)
    {

        $sql = "SELECT main_menu.*, sub_menu.*
        FROM main_menu
        INNER JOIN sub_menu ON main_menu.m_menu_id = sub_menu.m_menu_id where main_menu.m_menu_id =$menu_id";
        return pg_query($sql);
    }

    function deleteuser()
    {

        $sql = "delete from public." . $this->table_name . "  where id='" . $this->cleanData($_POST['id']) . "'";
        // echo $sql;
        // exit;
        return pg_query($sql);
    }

    function updateUser($data = array(), $final_file)
    {
        //print_r($final_file);

        $sql = "update public.candidate set attachment = '" . $this->cleanData($final_file) . "' ,state = 0,name='" . $this->cleanData($_POST['name']) . "',email='" . $this->cleanData($_POST['email']) . "', mobile_no='" . $this->cleanData($_POST['mobileno']) . "',address='" . $this->cleanData($_POST['address']) . "' where id = '" . $this->cleanData($_POST['id']) . "' ";
        return pg_affected_rows(pg_query($sql));
    }
    function updateMenu($data = array(), $final_file)
    {
        echo '<pre>';
        print_r($final_file);
        exit;

        $sql = "update public.candidate set attachment = '" . $this->cleanData($final_file) . "' ,state = 0,name='" . $this->cleanData($_POST['name']) . "',email='" . $this->cleanData($_POST['email']) . "', mobile_no='" . $this->cleanData($_POST['mobileno']) . "',address='" . $this->cleanData($_POST['address']) . "' where id = '" . $this->cleanData($_POST['id']) . "' ";
        return pg_affected_rows(pg_query($sql));
    }
    function cleanData($val)
    {
        return pg_escape_string($val);
    }

    public function getCandidatesrole($parent_id = 0)
    {
        $candidates = $this->select()
            ->from($this->table_name)
            ->where(['state' => 1])
            ->order_by("id")
            ->get_list();
        return $candidates;
    }
}
