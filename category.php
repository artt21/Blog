<?php

include 'cfg.php';
include 'app/controllers/categories.php';
$posts = selectAll('posts', ['categories_id' => $_GET['id']]);
$category = selectOne('categories', ['id' => $_GET['id']]);
//showSelected($posts);
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
    <link rel="stylesheet" href="front/style.css">

    <title>TechnoBlog</title>
</head>
<!-- HEADER -->
<?php include("app/include/header.php") ?>
<br>
<!-- MAIN BLOCK -->
<div class="container">
    <div class="content row">
        <div class="main-content col-md-9 col-12">
            <h2 align="center">Posts about <?=$category['name']?> </h2> <br>
            <?php foreach ($posts as $post): ?>
                <div class="post row">
                    <div class="img col-12 col-md-4">
                        <img src="<?= BASE_URL . 'front/images/posts/' . $post['img'] ?>" width="300" height="300" alt=""
                         class="img-thumbnail" align="right">
                    </div>

                    <div class="post_text col-12 col-md-8">
                        <h4>
                            <a href="<?= BASE_URL . 'single-post.php?post=' . $post['id']; ?>"><?= substr($post['title'], 0, 75) ?></a>
                        </h4>
                        <b><i>art</i></b>,
                        <i><?= $post['create_date'] ?></i>
                        <p class="preview-text">
                            <?= substr($post['content'], 0, 160) . "..." ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- SIDEBAR -->
        <div class="sidebar col-md-3 col-12">

            <div class="section search">
                <h4>Search</h4>
                <form action="search.php" method="post">
                    <input type="text" name="search-term" class="text-input" placeholder="Search...">
                </form>
            </div>

            <div class="section topics" >
                <h4>Categories</h4>
                <ul>
                    <?php foreach ($categories as $key => $category): ?>
                    <li>
                        <a href="<?= BASE_URL . 'category.php?id=' . $category['id'] ?>"><?= $category['name'] ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>

    </div>

</div>

<!-- FOOTER -->
<?php include("app/include/footer.php") ?>

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

