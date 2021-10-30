<?php

include SITE_ROOT . "/app/database/db.php";
if (!$_SESSION){
    header ("location: ../../log-in.php");
}

$errorMessage = [];
$id = '';
$title = '';
$content = '';
$img = '';
$category = '';
$publish = '';

$categories = selectAll('categories');
$posts = selectAll('posts');
$postsAdm = selectAuthor('posts', 'user');

// скрипт для формы создания поста
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])) {

    if (!empty($_FILES['img']['name'])){
        $imgName = time() . "_" . $_FILES['img']['name']; //тайм использован для уникальности названий
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];
        $destination = ROOT_PATH . "\\front\images\posts\\" . $imgName;

        if (!strpos($fileType, 'jpg')){
            array_push($errorMessage, 'Only images can be used');
        }

        $result = move_uploaded_file($fileTmpName, $destination);

        if($result){
            $_POST['img'] = $imgName;
        }else{
            array_push($errorMessage, "The image was not chosen or such format cannot be uploaded");
        }
    } else{
        array_push($errorMessage, "The image was not chosen or such format cannot be uploaded");
    }

    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $category = trim($_POST['category']);
    $allowed_symbols = "/^[a-zA-Z0-9\-_]+$/";

    $publish = isset($_POST['publish']) ? 1 : 0;

    if($title === '' || $content === '' || $category === ''){   //проверка полей
        array_push($errorMessage,"Fill in all the fields!");
    } elseif(mb_strlen($title, 'UTF8') < 3){
        array_push($errorMessage,"Title name must have at least 3 symbols");
    } elseif (!(preg_match($allowed_symbols, $title) || !(preg_match($allowed_symbols, $content)))){
        array_push($errorMessage, "Fields have inappropriate symbols");
    }
    else{
        $post = [
            'title' => $title,
            'content' => $content,
            'img' => $_POST['img'],
            'status' => $publish,
            'categories_id' => $category,
            'user_id' => $_SESSION['id']
        ];

        $post = insertData('posts', $post);
        $post = selectOne('posts', ['id' => $id]);
        header("location: index.php");
    }
} else{
    $title = '';
    $content = '';
}


// редактирование поста
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {

    $post = selectOne('posts', ['id' => $_GET['id']]);

    $id = $post['id'];
    $title = $post['title'];
    $content = $post['content'];
    $category = $post['categories_id'];
    $publish = $post['status'];

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_post'])) {

    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $category = trim($_POST['category']);
    $publish = isset($_POST['publish']) ? 1 : 0;
    $allowed_symbols = "/^[a-zA-Z0-9\-_]+$/";

    if (!empty($_FILES['img']['name'])){
        $imgName = time() . "_" . $_FILES['img']['name']; //тайм использован для уникальности названий
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];
        $destination = ROOT_PATH . "\\front\images\posts\\" . $imgName;

        if (!strpos($fileType, 'jpg')){
            array_push($errorMessage, 'Only images can be used');
        }

        $result = move_uploaded_file($fileTmpName, $destination);

        if($result){
            $_POST['img'] = $imgName;
        }else{
            array_push($errorMessage, "The image was not chosen or such format cannot be uploaded");
        }
    } else{
        array_push($errorMessage, "The image was not chosen or such format cannot be uploaded");
    }

    if($title === '' || $content === '' || $category === ''){   //проверка полей
        array_push($errorMessage,"Fill in all the fields!");
    } elseif(mb_strlen($title, 'UTF8') < 3){
        array_push($errorMessage,"Title name must have at least 3 symbols");
    } elseif (!(preg_match($allowed_symbols, $title) || !(preg_match($allowed_symbols, $content)))){
        array_push($errorMessage, "Fields have inappropriate symbols");
    }
    else{
        $post = [
            'user_id' => $_SESSION['id'],
            'title' => $title,
            'img' => $img,
            'content' => $content,
            'status' => $publish,
            'categories_id' => $category
        ];

        $post = updateData('posts', $id, $post);
        header("location: index.php");
    }
}


//удаление статьи
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {

    $id = $_GET['delete_id'];
    deleteData('posts', $id);
    header("location: index.php");

}

// отправить в черновик или опубликовать пост (изменение статуса)
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])){
    $id = $_GET['pub_id'];
    $publish = $_GET['publish'];

    $postId = updateData('posts', $id, ['status' => $publish]);

    header("location: index.php");
    exit();
}