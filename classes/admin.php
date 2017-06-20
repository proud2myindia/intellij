<?php
/**
 * Created by PhpStorm.
 * User: Anandam
 * Date: 3/26/2017
 * Time: 6:32 PM
 */
//include ('config/connect.php');
class Admin {

    public $pdo;

    public function __construct($db)
    {
        $this->pdo = $db;
    }


   public function adminLogin($username, $pass)
    {
        $ori_pass = md5($pass);
        $sql = "select * from  admin where username = :username AND password = :password ";

        $stmt =  $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $ori_pass);
       // echo $sql;
        $stmt->execute();
        if($stmt->rowCount() == 1)
        {
           return true;
        }
        else
        {
            return false;
        }

    }


    public function userLogin($username, $pass)
    {
        $ori_pass = md5($pass);
        $sql = "select * from  user where user_name = :user_name AND user_password = :user_password ";

        $stmt =  $this->pdo->prepare($sql);
        $stmt->bindParam(':user_name', $username);
        $stmt->bindParam(':user_password', $ori_pass);
        // echo $sql;
        $stmt->execute();
        if($stmt->rowCount() == 1)
        {
            $rows = $stmt->fetch();
            return $rows;
        }
        else
        {
            return false;
        }

    }

    public function addUser($data)
    {
        $sql = "insert into  USER (user_fname,user_lname) VALUES (:user_fname,:user_lname)";
        $stmt =  $this->pdo->prepare($sql);

        if($stmt->execute($data))
        {
            return $this->pdo->lastInsertId();
        }

    }

    public function getUserById($user_id)
    {
        $sql = "select * from  USER  where user_id = $user_id";
        $stmt =  $this->pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function updateUser($data,$uid)
    {
        $sql = "update  user set 
                                  user_fname = :user_fname, 
                                  user_lname = :user_lname
                                  
                                  WHERE 
                                  user_id = $uid";
        $stmt =  $this->pdo->prepare($sql);

        if($stmt->execute($data))
        {
          return $stmt->rowCount();

        }

    }

    public function changePassword($data)
    {
        $new_pass = md5($data['password']);
        $uid = 1;
        $sql = "update  admin set 
                                  password = '$new_pass'
                                  
                                  WHERE 
                                  id = $uid";
        $stmt =  $this->pdo->prepare($sql);

        if($stmt->execute())
        {
            return TRUE;

        }

    }
}