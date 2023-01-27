<header class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h1>SPA-PHP</h1>
            </div>
            <nav class="col-8">
                <ul>
                    <li><a href="<?php echo BASE_URL ?>">Главная</a></li>
                    <li>
                        <?php if (isset($_SESSION['id'])): ?>
                        <a href="#"><?php echo $_SESSION['login']; ?></a>
                        <li><a href="<?php echo BASE_URL . "logout.php" ?>">Выход</a></li>
                        <?php else: ?>
                        <li><a href="<?php echo BASE_URL . "login.php" ?>">Войти</a></li>
                        <?php endif; ?>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>