<?php

//session_start();
include "../../cfg.php";
include "../../app/controllers/categories.php";

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&display=swap"
          rel="stylesheet">

    <!-- Styling CSS -->
    <link rel="stylesheet" href="..\..\front\style.css">

    <title>TechnoBlog</title>
</head>
<!-- HEADER -->
<?php include("..\..\app\include\header-admin.php") ?>
<br>

<div class="container">
    <div class="row">
        <?php include("..\..\app\include\sidebar-admin.php"); ?>
        <div class="posts col-9">
            <h3 style="margin-left: 270px">Categories Management</h3>
            <div class="button-row" style="min-height: 30px">
                <i><b><a href="create.php" class="col-2">Add</a></b></i> |
                <i><b><a href="index.php" class="col-2">Manage</a></b></i>
            </div>
            <div class="row title-table">
                <div class="col-1">ID</div>
                <div class="col-5">Title</div>
                <div class="col-2">Edit</div>
                <div class="col-2">Delete</div>
            </div>
            <br>
            <?php foreach ($categories as $key => $category): ?>
            <div class="row post">
                <div class="id col-1"><?= ++$key ?></div>
                <div class="title col-5"><?= $category['name'] ?></div>
                <div class="edit col-2"><a href="edit.php?id=<?= $category['id']?>">Edit</a></div>
                <div class="delete col-2"><a href="edit.php?del_id=<?= $category['id']?>">Delete</a></div>
            </div>
            <hr>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- FOOTER -->
<?php include("..\..\app\include\\footer.php") ?>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
</body>
</html>