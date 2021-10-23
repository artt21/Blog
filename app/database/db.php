<?php

session_start();

require ("connection.php");

function showSelected($value){
    echo "<pre>";
    print_r($value);
    echo "</pre>";
}

// Проверка наличия ошибок при выполнении запроса к БД
function checkErrors($query){
    $errInfo = $query->errorInfo();
    if ($errInfo[0] !== PDO::ERR_NONE){
        echo $errInfo[2];
        exit();
    }
    return true;
}

// Запрос на получение всех данных из одной таблицы
function selectAll($table, $params = []){

    global $pdo;
    $sql = "SELECT * FROM $table";

    if(!empty($params)){
        $i = 0;
        foreach ($params as $key => $value){
            if (!is_numeric($value)){
                $value = "'" . $value . "'";
            }
            if ($i === 0){
                $sql = $sql . " WHERE $key=$value";
            } else{
                $sql = $sql . " AND $key=$value";
            }
            $i++;
        }
    }

    $query = $pdo->prepare($sql);
    $query->execute();
    checkErrors($query);
    return $query-> fetchAll();
}

// Запрос на получение данных из одной строки в БД
function selectOne($table, $params = []){

    global $pdo;
    $sql = "SELECT * FROM $table";

    if(!empty($params)){
        $i = 0;
        foreach ($params as $key => $value){
            if (!is_numeric($value)){
                $value = "'" . $value . "'";
            }
            if ($i === 0){
                $sql = $sql . " WHERE $key=$value";
            } else{
                $sql = $sql . " AND $key=$value";
            }
            $i++;
        }
    }

//    $sql = $sql . "LIMIT 1";

    $query = $pdo->prepare($sql);
    $query->execute();
    checkErrors($query);
    return $query-> fetch();
}


// Запись значений в таблицу базы данных
function insertData($table, $params){

    global $pdo;
    $i = 0;
    $col = '';
    $data = '';

    foreach($params as $key => $value){
        if ($i === 0){
            $col = $col . "$key";
            $data = $data . "'" ."$value" . "'";
        } else {
            $col = $col . ", $key";
            $data = $data .", '" . "$value" . "'";
        }
        $i++;
    }

    $sql = "INSERT INTO $table ($col) VALUES ($data)";

//    showSelected($sql);
//    exit();

    $query = $pdo->prepare($sql);
    $query->execute();
    checkErrors($query);
    return $pdo->lastInsertId();
}

// Обновление данных в таблице
function updateData($table, $id, $params){

    global $pdo;
    $i = 0;
    $str = '';

    foreach($params as $key => $value){
        if ($i === 0){
            $str = $str . $key . " = '" . $value . "'";
        } else {
            $str = $str . ", " . $key . " = '" . $value . "'";
        }
        $i++;
    }

    $sql = "UPDATE $table SET $str WHERE id = $id";

//    showSelected($sql);
//    exit();

    $query = $pdo->prepare($sql);
    $query->execute();
    checkErrors($query);
}

//$parameter = [
//    'admin' => '1',
//    'password' => '1337',
//    'email' => 'anonimous@anon.net'
//];
//
//updateData('user', 1, $parameter);


// Удаление строки из таблицы в БД
function deleteData($table, $id){

    global $pdo;

    $sql = "DELETE FROM $table WHERE id = $id";

    $query = $pdo->prepare($sql);
    $query->execute();
    checkErrors($query);
}

//deleteData('user', 8);