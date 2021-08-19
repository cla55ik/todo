<?php 

require_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/crud.php");
$post = $_POST;

switch ($post['type']) {
    case 'create':
        $res = createTodo($post);
        echo json_encode($res);
        break;
    case 'done':
        $res = todoDone($post);
        echo json_encode($res);
        break;
    case 'rework':
        $res = todoRework($post);
        echo json_encode($res);
        break;
    case 'delete':
        $res = todoDelete($post);
        echo json_encode($res);
        break;
    default:
        $res = [
            'status'=>'error',
            'message'=>'Не верый запрос'
        ];
        echo json_encode($res);
        break;
}


function createTodo($array){
    if($array['name'] == ''){
        $res = [
            'status' => 'error',
            'message'=> 'Название не должно быть пустым'
        ];
    
        return $res;
    }
    $crud = new Crud();
    $crud->createTodo($array);
    $res = [
        'status' => 'ok',
        'message'=> 'create Done'
    ];

    return $res;

}

function todoDone($array){
    $crud = new Crud();
    $todo = $crud->getTodoById($array['id']);

    $todo['status'] = 0;

    $crud->updateTodo($todo);

    $res=[
        'status' => 'ok',
        'message'=> 'update Done'
    ];
    return $res;
}

function todoRework($array){
    $crud = new Crud();
    $todo = $crud->getTodoById($array['id']);

    $todo['status'] = 1;

    $crud->updateTodo($todo);

    $res=[
        'status' => 'ok',
        'message'=> 'update Done'
    ];
    return $res;
}

function todoDelete($array){
    $crud = new Crud();
    $todo = $crud->deleteTodo($array['id']);

    $res=[
        'status' => 'ok',
        'message'=> 'Delete done'
    ];
    return $res;
}