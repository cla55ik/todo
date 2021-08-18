<?php 

class Crud{
    private $conn = null;

    public function __construct()
    {
        $dbh = new PDO('mysql:dbname=u193192659_todo;host=localhost', 'u193192659_todo_user', ']BB8&30n7P');
        $this->conn = $dbh;
    }


    public function createTodo($array){
        $query = "INSERT INTO `todo` (`name`, `description`, `status`, `category`) 
                        VALUES (:name,:description,:status,:category)";
        $props=[
            'name'=>$array['name'],
            'description'=>$array['description'],
            'status'=>$array['status'],
            'category'=>$array['category'],
        ];
        $stmt = $this->conn->prepare($query);
        $stmt->execute($props);

    }

    public function readAllTodo()
    {
        $query = "SELECT * FROM `todo`";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    public function getTodoById($id){
        $query = "SELECT * FROM `todo` WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function deleteTodo($id){
        $query = "DELETE FROM `todo` WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);

    }

    public function updateTodo($array){
        $query = "UPDATE `todo` SET `name`=:name,`description`=:description,`status`=:status,`category`=:category 
                    WHERE `id` = :id";
        $props = [
            'name'=>$array['name'],
            'description'=>$array['description'],
            'status'=>$array['status'],
            'category'=>$array['category'],
            'id'=>$array['id'],
        ];
        $stmt = $this->conn->prepare($query);
        $stmt->execute($props);

    }


    public function getAllCategory(){
        $query = "SELECT * FROM `category`";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }
    
}