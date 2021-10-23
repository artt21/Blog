<?php

include "app/database/db.php";

$errorMessage = '';

// проверка на статус админа
function userAuth($user){
    $_SESSION['id'] = $user['id'];
    $_SESSION['login'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];

    if($_SESSION['admin']){
        header("location: http://localhost/blog/admin/admin.php");
    } else{
        header("location: http://localhost/blog/index.php");
    }
}

//скрипт для формы регистрации
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])) {

    $admin = 0;
    $login = trim($_POST['login']);
    $email = trim($_POST['email']);
    $passFirst = trim($_POST['pass-first']);
    $passSecond = trim($_POST['pass-second']);
    $allowed_symbols = "/^[a-zA-Z0-9\-_]+$/";

    if($login === '' || $email === '' || $passFirst === ''){   //проверка полей
        $errorMessage = "Fill in all the fields!";
    } elseif(mb_strlen($login, 'UTF8') < 3){
        $errorMessage = "Login must have at least 3 symbols";
    } elseif($passFirst !== $passSecond){
        $errorMessage = "Passwords does not match!";
    } elseif (!(preg_match($allowed_symbols, $login) || !(preg_match($allowed_symbols, $passFirst)))){
        $errorMessage = "Fields have inappropriate symbols";
    }
    else{
        $existence = selectOne('user',['email' => $email]);
        if(!empty($existence['email']) && $existence['email'] === $email){   //проверка на уже существующего юзера
            $errorMessage = "This email has been registered already";
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
        $errorMessage = "Fill in all the fields!";
    } else{
        $existence = selectOne('user',['email' => $email]);
        if($existence && password_verify($pass, $existence['password'])){
            userAuth($existence);
        } else{
            $errorMessage = 'Email or Password is incorrect';
        }
    }
}
