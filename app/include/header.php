<div>
    <header class="container-fluid">
        <div class="container">
            <div class ="row">
                <div class="col-4">
                    <h1>
                        <a href="index.php">TechnoBlog</a>
                    </h1>
                </div>
                <nav class="col-8">
                    <ul>
                        <li><a href="#">Main page</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Services</a></li>
                        <li>
                            <?php if (isset($_SESSION['id'])): ?>
                                <p><b>Profile</b></p>
                            <?php echo $_SESSION['login']; ?>
                                <ul>
                                    <?php if ($_SESSION['admin']): ?>
                                    <li><a href = "admin\posts\index.php">Admin panel</a></li>
                                    <?php endif; ?>
                                    <li><a href = "logout.php">Log out</a></li>
                                </ul>
                            <?php else: ?>
                                <a href="log-in.php"><b>Log In</b></a>
                            <ul>
                                <li><a href = "register.php">Register</a></li>
                            </ul>
                            <?php endif; ?>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>