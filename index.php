<?php 

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/crud.php");

$crud = new Crud;
$all_todo = $crud->readAllTodo();
$category = $crud->getAllCategory();

foreach ($category as $cat) {
    $cat_array[$cat['id']] = $cat['name']; 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/assets/js/script.js"></script>
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css" />
    <title>Document</title>
</head>
<body>
    <main class="todo">
        <div class="todo__title">
            <h1>Список задач</h1>
        </div>
        <div class="todo__create">
            <button id="view_create_form">Добавить</button>
            <form id="todo_create_form" class="hidden todo_create_form">
                <input type="text" name="name" placeholder="Название">
                <input type="text" name="description" placeholder="Описание">
                <p><input type="radio" name="status" value="1" checked>В работе</p>
                <p><input type="radio" name="status" value="0">Выполнено</p>
                <select name="category" id="">
                    <?php foreach ($category as $cat):?>
                        <option value="<?=$cat['id'] ?>"><?=$cat['name'] ?></option>
                    <?php endforeach;?>
                </select>
                <button class="btn" type="submit">Создать</button>
            </form>
        </div>
        <div class="todo__list">
            <table class="todo__table">
                <tr class="todo__table-th">
                    <td>ID</td>
                    <td>Название</td>
                    <td class="only_desctop">Описание</td>
                    <td>Статус</td>
                    <td class="only_desctop">Категория</td>
                    <td></td>
                </tr>
                <?php foreach($all_todo as $todo):?>
                <?php if ($todo['status'] == 1) :?>
                <tr class="todo__table-tr">
                    <td><?=$todo['id']?></td>
                    <td><?=$todo['name']?></td>
                    <td class="only_desctop"><?=$todo['description']?></td>
                    <td><?=$todo['status']?></td>
                    <td class="only_desctop"><?=$cat_array[$todo['category']]?></td>
                    <td><button id='todo_done' onclick="todoDone(<?=$todo['id']?>)">Готово</button></td>
                </tr>
                <?php endif;?>
                <?php endforeach;?>
            </table>
        </div>

    </main>
</body>
</html>