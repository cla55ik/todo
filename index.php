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
    <link rel="icon" type="image/png" href="favicon.png" />
    <title>Список задач</title>
</head>
<body>
    <main class="todo">
        <div class="todo__title">
            <h1>Список задач</h1>
            <button class="btn button__add" id="view_create_form">+Добавить</button>
        </div>
        <div class="todo__create">
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
        <div class="todo__filter">
            <span>Фильтры: </span>
            <?php foreach($category as $cat):?>
                <span class="todo__filter-label" id = "filter_cat_id_<?=$cat['id'];?>" onclick="filter('cat_id_<?=$cat['id'];?>')"><?=$cat['name'] ?></span>
            <?php endforeach;?>
        </div>
        <div class="todo__list">
        <?php foreach($all_todo as $todo):?>
            <?php if ($todo['status'] == 1) :?>
            <div class="todo__item cat_id_<?=$todo['category'];?>">
                <div class="todo__item-text">
                    <div class="todo__item-title">
                        <?=$todo['name']?>
                    </div>
                    <div class="todo__item-description">
                        <?=$todo['description']?>
                    </div>
                </div>
                <div class="todo__item-category">
                    <span class="todo__item-category-label" onclick="filter('cat_id_<?=$todo['category'];?>')">
                        <?=$cat_array[$todo['category']]?>
                    </span>
                </div>
                <div class="todo__item-action" onclick="todoDone('<?=$todo['id'];?>')">
                    &#10004;
                </div>
                
            </div>
            <?php endif;?>
        <?php endforeach;?>
        </div>
        <div class="todo__list-done">
        <?php foreach($all_todo as $todo):?>
            <?php if ($todo['status'] != 1) :?>
            <div class="todo__item">
                <div class="todo__item-text">
                    <div class="todo__item-title">
                        <?=$todo['name']?>
                    </div>
                    <div class="todo__item-description">
                        <?=$todo['description']?>
                    </div>
                </div>
                <div class="todo__item-category">
                    <span class="todo__item-category-label">
                        <?=$cat_array[$todo['category']]?>
                    </span>
                </div>
                <div class="todo__item-action" onclick="reWork(<?=$todo['id'];?>)">
                    &#10004;
                </div>
                <div class="todo__item-action-delete" onclick="deleteTodo(<?=$todo['id'];?>)">
                    &#10006;
                </div>
                
            </div>
            <?php endif;?>
        <?php endforeach;?>
        </div>

    </main>
</body>
</html>