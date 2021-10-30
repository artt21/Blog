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
                    <li>
                        <p><b>Profile</b></p>
                        <?php echo $_SESSION['login']; ?>
                    </li>
                    <li><a href="..\..\logout.php">Log out</a></li>
                </ul>
                </ul>
            </nav>
        </div>
    </div>
</header>