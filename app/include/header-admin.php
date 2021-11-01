<header class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h1>
                    <a href="../../index.php">TechnoBlog</a>
                </h1>
            </div>
            <nav class="col-8">
                <ul>
                    <li><a href="index.php">Main page</a></li>
                    <li><a href="index.php">About us</a></li>
                    <li><b><a href="..\..\logout.php">Log out</a></b></li>
                    <li>
                        <p><b>Profile</b></p>
                        <?php echo $_SESSION['login']; ?>
                    </li>

                </ul>
                </ul>
            </nav>
        </div>
    </div>
</header>