<?php

include SITE_ROOT . "/app/database/db.php";

$errorMessage = [];
$categories = selectAll('categories');
$id = '';
$name = '';
$description = '';

// скрипт для формы создания категории
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-create'])) {

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $allowed_symbols = "/^[a-zA-Z0-9\-_]+$/";

    if($name === '' || $description === ''){   //проверка полей
        array_push($errorMessage, "Fill in all the fields!");
    } elseif(mb_strlen($name, 'UTF8') < 2){
        array_push($errorMessage,"Category name must have at least 2 symbols");
    } elseif (!(preg_match($allowed_symbols, $name) || !(preg_match($allowed_symbols, $description)))){
        array_push($errorMessage, "Fields have inappropriate symbols");
    }
    else{
        $existence = selectOne('categories',['name' => $name]);
            $category = [
                'name' => $name,
                'description' => $description,
            ];
            $id = insertData('categories', $category);
            $category = selectOne('categories', ['id' => $id]);
            header("location: index.php");
        }
}

//скрипт для формы редактирования категорий

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {

    $id = $_GET['id'];
    $category = selectOne('categories', ['id' => $id]);
    $id = $category['id'];
    $name = $category['name'];
    $description = $category['description'];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-edit'])) {

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $allowed_symbols = "/^[a-zA-Z0-9\-_]+$/";

    if($name === '' || $description === ''){   //проверка полей
        array_push($errorMessage,"Fill in all the fields!");
    } elseif(mb_strlen($name, 'UTF8') < 2){
        array_push($errorMessage,"Category name must have at least 2 symbols");
    } elseif (!(preg_match($allowed_symbols, $name) || !(preg_match($allowed_symbols, $description)))){
        array_push($errorMessage, "Fields have inappropriate symbols");
    }
    else{
        $existence = selectOne('categories',['name' => $name]);
        $category = [
            'name' => $name,
            'description' => $description,
        ];
        $id = $_POST['id'];
        $category_id = updateData('categories', $id, $category);
        header("location: index.php");
    }
}


//удаление категории

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {

    $id = $_GET['del_id'];
    deleteData('categories', $id);
    header("location: index.php");

}