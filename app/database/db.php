<?php

session_start();

require ("connection.php");

function showSelected($value){
    echo "<pre>";
    print_r($value);
    echo "</pre>";
    exit();
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

    $query = $pdo->prepare($sql);
    $query->execute();
    checkErrors($query);
}

//$params = [
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


//Выборка постов с автором в админку

function selectAuthor($table1, $table2)
{
    global $pdo;

    $sql = "SELECT t1.id, t1.title, t1.img, t1.content, t1.status, t1.categories_id, t1.create_date, t2.username FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.user_id = t2.id";

    $query = $pdo->prepare($sql);
    $query->execute();
    checkErrors($query);
    return $query->fetchAll();

}

//выборка постов с автором на главную

function selectAuthorForMain($table1, $table2, $limit, $offset)
{
    global $pdo;

    $sql = "SELECT p.*, u.username FROM $table1 AS p JOIN $table2 AS u ON p.user_id = u.id WHERE p.status = 1 LIMIT $limit OFFSET $offset";

    $query = $pdo->prepare($sql);
    $query->execute();
    checkErrors($query);
    return $query->fetchAll();

}

//поиск по заголовкам и контенту
function searchInTitleAndContent($text, $table1, $table2)
{
    global $pdo;
    $text = trim(strip_tags(stripcslashes(htmlspecialchars($text))));

    $sql = "SELECT p.*, u.username 
            FROM $table1 AS p JOIN $table2 
            AS u ON p.user_id = u.id 
            WHERE p.status = 1 
            AND p.title  
            LIKE '%$text%' OR p.content LIKE '%$text%'";

    $query = $pdo->prepare($sql);
    $query->execute();
    checkErrors($query);
    return $query->fetchAll();

}

// выборка поста с автором для single-post
function selectPostForSingle($table1, $table2, $id)
{
    global $pdo;

    $sql = "SELECT p.*, u.username FROM $table1 AS p JOIN $table2 AS u ON p.user_id = u.id WHERE p.id = $id";

    $query = $pdo->prepare($sql);
    $query->execute();
    checkErrors($query);
    return $query->fetch();

}

//подсчет количества строк в таблице (для пагинации)
function countRow($table){

    global $pdo;

    $sql = "SELECT COUNT(*) FROM $table WHERE status = 1";

    $query = $pdo->prepare($sql);
    $query->execute();
    checkErrors($query);
    return $query->fetchColumn();

}