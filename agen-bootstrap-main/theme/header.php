<header class="navigation fixed-top">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
            aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="portfolio.php">Proyectos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="blog.php">Noticias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">Conócenos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="services.php">Servicios</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Páginas</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="team.php">Herramientas</a>
                        <a class="dropdown-item" href="pricing.php">Precio</a>
                        <a class="dropdown-item" href="faqs.php">Preguntas recientes</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contacto</a>
                </li>
            </ul>
            <nav class="d-flex align-items-center">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <img src="<?= $_SESSION['user_avatar'] ?>" alt="Avatar" class="rounded-circle me-3" width="40" height="40">
                    <p class="text-white mb-0 me-3 ms-3"><?= $_SESSION['user_name'] ?></p>
                    <p class="text-white mb-0 me-3"><?= $_SESSION['user_surname'] ?></p>
                    <a href="logout.php" class="btn btn-outline-light me-2 ms-5">Cerrar Sesión</a>
                    <?php if ($_SESSION['user_rol'] === 'admin'): ?>
                        <a href="admin/adminPanel.php" class="text-white ml-4"><img src="./assets/admin.png" alt="" style="width: 40px; height: 40px;"></a>
                    <?php endif; ?>
                <?php else: ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Iniciar Sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Registrarse</a>
                        </li>
                    </ul>
                <?php endif; ?>
            </nav>
        </div>
    </nav>
</header>