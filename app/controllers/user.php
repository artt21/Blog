<?php

//include "cfg.php";
include SITE_ROOT . "/app/database/db.php";

$errorMessage = [];

// проверка на статус админа
function userAuth($user){
    $_SESSION['id'] = $user['id'];
    $_SESSION['login'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];

    if($_SESSION['admin']){
        header("location: http://localhost/blog/admin/posts/index.php");
    } else{
        header("location: http://localhost/blog/index.php");
    }
}

$users = selectAll('user');


//скрипт для формы регистрации
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])) {

    $admin = 0;
    $login = trim($_POST['login']);
    $email = trim($_POST['email']);
    $passFirst = trim($_POST['pass-first']);
    $passSecond = trim($_POST['pass-second']);
    $allowed_symbols = "/^[a-zA-Z0-9\-_]+$/";

    if($login === '' || $email === '' || $passFirst === ''){   //проверка полей
        array_push($errorMessage, "Fill in all the fields!");
    } elseif(mb_strlen($login, 'UTF8') < 3){
        array_push($errorMessage, "Login must have at least 3 symbols");
    } elseif($passFirst !== $passSecond){
        array_push($errorMessage,"Passwords does not match!");
    } elseif (!(preg_match($allowed_symbols, $login) || !(preg_match($allowed_symbols, $passFirst)))){
        array_push($errorMessage,"Fields have inappropriate symbols");
    }
    else{
        $existence = selectOne('user',['email' => $email]);
        if(!empty($existence['email']) && $existence['email'] === $email){   //проверка на уже существующего юзера
            array_push($errorMessage,"This email has been registered already");
        } else{
            $pass = password_hash($passFirst, PASSWORD_DEFAULT);
            $post = [
                'admin' => $admin,
                'username' => $login,
                'email' => $email,
                'password' => $pass
            ];
            $id = insertData('user',$post);
            $user = selectOne('user', ['id' => $id]);
            userAuth($user);
        }
    }
}

//скрипт для формы авторизации

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])) {

    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);

    if($email === '' || $pass === ''){
        array_push($errorMessage,"Fill in all the fields!");
    } else{
        $existence = selectOne('user',['email' => $email]);
        if($existence && password_verify($pass, $existence['password'])){
            userAuth($existence);
        } else{
            array_push($errorMessage, 'Email or Password is incorrect');
        }
    }
}

// скрипт для создания юзера

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-user'])) {

    $admin = 0;
    $login = trim($_POST['login']);
    $email = trim($_POST['email']);
    $passFirst = trim($_POST['pass-first']);
    $passSecond = trim($_POST['pass-second']);
    $allowed_symbols = "/^[a-zA-Z0-9\-_]+$/";

    if($login === '' || $email === '' || $passFirst === ''){   //проверка полей
        array_push($errorMessage,"Fill in all the fields!");
    } elseif(mb_strlen($login, 'UTF8') < 3){
        array_push($errorMessage,"Login must have at least 3 symbols");
    } elseif($passFirst !== $passSecond){
        array_push($errorMessage,"Passwords does not match!");
    } elseif (!(preg_match($allowed_symbols, $login) || !(preg_match($allowed_symbols, $passFirst)))){
        array_push($errorMessage,"Fields have inappropriate symbols");
    }
    else{
        $existence = selectOne('user',['email' => $email]);
        if(!empty($existence['email']) && $existence['email'] === $email){   //проверка на уже существующего юзера
            array_push($errorMessage,"This email has been registered already");
        } else{
            $pass = password_hash($passFirst, PASSWORD_DEFAULT);
            if (isset($_POST['admin'])){
                $admin = 1;
            }
            $user = [
                'admin' => $admin,
                'username' => $login,
                'email' => $email,
                'password' => $pass
            ];
            $id = insertData('user',$user);
            $user = selectOne('user', ['id' => $id]);
            userAuth($user);
        }
    }
}

// удаление пользователя
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {

    $id = $_GET['delete_id'];
    deleteData('user', $id);
    header("location: index.php");

}

// редактирование информации юзера
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit_id'])) {

    $user = selectOne('user', ['id' => $_GET['edit_id']]);


    $id = $user['id'];
    $status = $user['admin'];
    $username = $user['username'];
    $email = $user['email'];

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-user'])) {


    $id = $_POST['id'];
    $email = trim($_POST['email']);
    $login = trim($_POST['login']);
    $passFirst = trim($_POST['pass-first']);
    $passSecond = trim($_POST['pass-second']);
    $admin = isset($_POST['admin']) ? 1 : 0;
    $allowed_symbols = "/^[a-zA-Z0-9\-_]+$/";


    if($login === ''){   //проверка полей
        array_push($errorMessage,"Fill in all the fields!");
    } elseif(mb_strlen($login, 'UTF8') < 3){
        array_push($errorMessage,"Login name must have at least 3 symbols");
    } elseif (!(preg_match($allowed_symbols, $login) )){
        array_push($errorMessage, "Login has inappropriate symbols");
    }
    elseif($passFirst !== $passSecond){
        array_push($errorMessage,"Passwords does not match!");
    }
    else{
        $pass = password_hash($passFirst, PASSWORD_DEFAULT);
        if (isset($_POST['admin'])){
            $admin = 1;
        }
        $user = [
            'admin' => $admin,
            'username' => $login,
//            'email' => $email,
            'password' => $pass
        ];

        $post = updateData('user', $id, $user);
        header("location: index.php");
    }
}