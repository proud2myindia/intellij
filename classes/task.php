<?php
/**
 * Created by PhpStorm.
 * User: Anandam
 * Date: 3/26/2017
 * Time: 6:32 PM
 */
//include ('config/connect.php');
class Task {

    public $pdo;

    public function __construct($db)
    {
        $this->pdo = $db;
    }


    public function getAllTask()
    {
        $sql = "select * from  task where is_delete='0' ORDER BY dateCreated DESC ";
        $stmt =  $this->pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }



    public function addTask($data)
    {
        $sql = "insert into  task (name,description,task_create_user_id,dateCreated) VALUES (:name,:description,:task_create_user_id,:dateCreated)";
        $stmt =  $this->pdo->prepare($sql);

        if($stmt->execute($data))
        {
            $last_id =  $this->pdo->lastInsertId();

            return $last_id;
        }

    }

    public function getTaskById($task_id)
    {
        $sql = "select * from  task  where id = $task_id";
      
        $stmt =  $this->pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetch();
        return $rows;
    }

    public function updateTask($data,$task_id)
    {
        $sql = "update  task set 
                                  name = :name, 
                                  description = :description, 
                                  task_create_user_id = :task_create_user_id, 
                                  dateUpdated = :dateUpdated
                                  
                                  WHERE 
                                  id = $task_id";
        $stmt =  $this->pdo->prepare($sql);

        if($stmt->execute($data))
        {
            return TRUE;

        }


    }

    public function getTotalNoTask()
    {
        $sql = "select * from task where is_delete='0'";
        $stmt =  $this->pdo->prepare($sql);

        if($stmt->execute())
        {
            return $stmt->rowCount();

        }


    }

    public function getTotalNoTaskByUserId($user_id)
    {
        $sql = "select * from task where is_delete='0' AND task_create_user_id = $user_id";
        $stmt =  $this->pdo->prepare($sql);

        if($stmt->execute())
        {
            return $stmt->rowCount();

        }


    }

    public function searchTask($key)
    {
        $sql = "select * from  task  where is_delete ='0' AND (name LIKE '%$key%')";

        $stmt =  $this->pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function searchTaskByUserId($key,$user_id)
    {
        $sql = "select * from  task  where is_delete ='0' AND task_create_user_id = $user_id AND (name LIKE '%$key%')";

        $stmt =  $this->pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }



    public function deleteTask($task_id)
    {

        $sql = "update  task 
                set
         is_delete = '1'
         WHERE 
         id = $task_id
         ";



        $stmt =  $this->pdo->prepare($sql);

        if($stmt->execute())
        {
            return TRUE;
        }

    }

    public function getTaskByUserId($user_id)
    {
        $sql = "select * from  task  where task_create_user_id = $user_id AND is_delete='0'";

        $stmt =  $this->pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
}