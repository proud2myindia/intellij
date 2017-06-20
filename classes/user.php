<?php
/**
 * Created by PhpStorm.
 * User: Anandam
 * Date: 3/26/2017
 * Time: 6:32 PM
 */
//include ('config/connect.php');
class User {

    public $pdo;

    public function __construct($db)
    {
        $this->pdo = $db;
    }


    public function getAllUser()
    {
        $sql = "select * from  user WHERE is_delete ='0' ORDER BY user_create_date DESC ";
        $stmt =  $this->pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getTotalNoUser()
    {
        $sql = "select * from user WHERE is_delete ='0'";
        $stmt =  $this->pdo->prepare($sql);

        if($stmt->execute())
        {
            return $stmt->rowCount();

        }


    }

    public function checkDupUserName($user_name)
    {
        $sql = "select * from user WHERE is_delete ='0' AND user_name = '$user_name'";
        $stmt =  $this->pdo->prepare($sql);

        if($stmt->execute())
        {
            return $stmt->rowCount();

        }


    }


    public function addUser($data)
    {
        $sql = "insert into  user (user_fname,user_lname,user_email,user_password,user_contact,user_name,user_create_date) VALUES (:user_fname,:user_lname,:user_email,:user_password,:user_contact,:user_name,:user_create_date)";
        $stmt =  $this->pdo->prepare($sql);

        if($stmt->execute($data))
        {
            $last_id =  $this->pdo->lastInsertId();

            return $last_id;
        }

    }

    public function editUser($data,$user_id)
    {
        if(empty($data['user_password']))
        {
            $sql = "update  user 
                set
         user_fname = :user_fname,
         user_lname = :user_lname,
         user_email = :user_email,
         user_contact = :user_contact,
         user_name = :user_name,
         user_mod_date = :user_mod_date
         WHERE 
         user_id = $user_id
         ";
        }
        else
        {
            $sql = "update  user 
                set
         user_fname = :user_fname,
         user_lname = :user_lname,
         user_email = :user_email,
         user_password = :user_password,
         user_contact = :user_contact,
         user_name = :user_name,
         user_mod_date = :user_mod_date
         WHERE 
         user_id = $user_id
         ";
        }

        $stmt =  $this->pdo->prepare($sql);

        if($stmt->execute($data))
        {
           return TRUE;
        }

    }

    public function getUserById($user_id)
    {
        $sql = "select * from  user  where user_id = $user_id";
      
        $stmt =  $this->pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetch();
        return $rows;
    }

    public function searchUser($key)
    {
        $sql = "select * from  user  where is_delete ='0' AND (user_name LIKE '%$key%' OR user_fname LIKE '%$key%' OR user_lname LIKE '%$key%')";

        $stmt =  $this->pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function editUserStatus($data,$user_id)
    {

            $sql = "update  user 
                set
         user_status = :user_status
         WHERE 
         user_id = $user_id
         ";



        $stmt =  $this->pdo->prepare($sql);

        if($stmt->execute($data))
        {
            return TRUE;
        }

    }

    public function deleteUser($user_id)
    {

        $sql = "update  user 
                set
         is_delete = '1'
         WHERE 
         user_id = $user_id
         ";



        $stmt =  $this->pdo->prepare($sql);

        if($stmt->execute())
        {
            return TRUE;
        }

    }

    public function changePassword($data,$uid)
    {
        $new_pass = md5($data['user_password']);
        $sql = "update  user set 
                                  user_password = '$new_pass'
                                  
                                  WHERE 
                                  user_id = $uid";
        $stmt =  $this->pdo->prepare($sql);

        if($stmt->execute())
        {
            return TRUE;

        }

    }

}