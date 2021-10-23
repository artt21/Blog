<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&display=swap" rel="stylesheet">

    <!-- Styling CSS -->
    <link rel="stylesheet" href="front/style.css">

    <title>TechnoBlog</title>
</head>
<!-- HEADER -->
<?php include ("app/include/header.php") ?>
<br>
<!-- MAIN BLOCK -->
<div class="container>"
<div class ="content row">
        <!-- MAIN CONTENT-->
        <div class="main-content col-md-9 col-12">
            <h2 align="center">How to install a new Windows for your PC</h2> <br>
            <div class="single_post row">
                <div class="img col-12">
                    <img src="front/images/image_3.jpg" width="100" height="400" alt= "" class="img-thumbnail" align="middle">
                    <br>
                    <p align="center"><i>Author</i>
                    <i>(October 12, 2021)</i></p>
                </div>
                <div class="single_post_text col-12">
                    <p>The following steps will walk you through the process of installing Windows 7 on a fresh computer.</p>
                    <p>Installing Windows 7 is straightforward—if you’re doing a clean install, simply boot up your computer with the Windows 7 installation DVD inside the DVD drive and instruct your computer to boot from the DVD (you may need to press a key, such as F11 or F12, while the computer is starting to enter the boot selection screen).</p>
                    <p>If you’re upgrading, simply boot into Windows Vista, insert the disc, and run the installer (if you are using Windows XP, see the previous sidebar ).</p>
                    <p>When the installer has booted up, you will be greeted with the screen shown in Figure 1-2 (the upgrade screen is slightly different; you will have an option to check the compatibility of your system or start the installation).</p>
                    <p>You will be asked to select the language to install, the time and currency format, and your keyboard type.</p>
                </div>
            </div>

        </div>
        <!-- SIDEBAR -->
        <div class="sidebar col-md-3 col-12">

            <div class="section search">
                <h4>Search</h4>
                <form action="/" method="post">
                    <input type="text" name="search" class="text-input" placeholder="Search...">
                </form>
            </div>

            <div class="section topics">
                <h4>Categories</h4>
                <ul>
                    <li><a href="#">Windows XP</a></li>
                    <li><a href="#">Windows Vista</a></li>
                    <li><a href="#">Windows 7</a></li>
                    <li><a href="#">Windows 8</a></li>
                    <li><a href="#">Windows 10</a></li>
                    <li><a href="#">Windows 11</a></li>
                </ul>
            </div>

        </div>
    </div>
    <br>
</div>

<!-- FOOTER -->
<?php include ("app/include/footer.php") ?>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
</body>
</html>

