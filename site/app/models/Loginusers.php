<?php

namespace App\Models;

use App\System\DB\DB;
use App\System\Route;
use App\Helpers\Helpers;

class Loginusers extends DB
{
    private $table_name = 'accounts';
    public function __construct()
    {
        parent::__construct('accounts', 'user_id');
    }
    public function getUsers($parent_id = 0)
    {
        $results  = $this->select()
            ->from("accounts")
            ->where('user_role_id != 1 and user_role_id != 2')
            ->get_list();
        return $results;
    }
    public function getUserlist($id = 0, $type = null)
    {
        if ($id == 0) {
            return $this->getEmptyUserlist($type);
        } else {
            return $this->select()->from($this->table_name)->where(['user_id' => $id])->get_one($type);
        }
    }

    public function getEmptyUserlist($type = null)
    {
        $empty_menu  = [
            'user_id' => 0,
            'username' => '',
            'password' => '',
            'email' => '',
            'phone_number' => '',
            'created_on' => '',
            'last_login' => '',
            'user_role_id' => '',
            'status' => '',
        ];
        if ($type == DB_OBJECT) {
            $empty_menu = (object) $empty_menu;
        }
        return $empty_menu;
    }
    public function addUserlist($data = array())
    {

        return $this->insert($data);
    }
    public function updateUserlist($data = array(), $id = 0)
    {
        return $this->update($data, ['user_id' => $id]);
    }
    public function usernameAlreadyExists($username)
    {
        $username = Helpers::cleanData($username);
        $sql  = $this->select('count(*) as cntUser')
            ->from("accounts")
            ->where(['username' => $username])
            ->get_one(DB_ASSOC);
        $user = $sql;

        $user = (array)$user;
        $count = $user['cntuser'];
        $response = "";

        if ($count > 0) {
            $response = "<span style='color: red;'>Already Exists.</span>";
        }
        echo $response;
        die;
    }
    public function emailAlreadyExists($email)
    {

        $email = Helpers::cleanData($email);
        $sql  = $this->select('count(*) as cntUser')
            ->from("accounts")
            ->where(['email' => $email])
            ->get_one(DB_ASSOC);
        $user = $sql;
        $user = (array)$user;
        $count = $user['cntuser'];
        $response = "";

        if ($count > 0) {
            $response = "<span style='color: red;'>Already Exists.</span>";
        }
        echo $response;
        die;
    }
    public function phonenumberAlreadyExists($phone_number)
    {
        $phone_number = Helpers::cleanData($phone_number);
        $sql  = $this->select('count(*) as cntUser')
            ->from("accounts")
            ->where(['phone_number' => $phone_number])
            ->get_one(DB_ASSOC);
        $user = $sql;
        $user = (array)$user;
        $count = $user['cntuser'];
        $response = "";

        if ($count > 0) {
            $response = "<span style='color: red;'>Already Exists.</span>";
        }
        echo $response;
        die;
    }
}
