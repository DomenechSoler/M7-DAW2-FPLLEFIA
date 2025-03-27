<header class="navigation fixed-top">
    <nav class="navbar navbar-expand-lg navbar-dark ">
        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="partidos.php">Partidos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="estadisticaIndividual.php">Estadísticas Individual</a>
                </li>
            </ul>
            <nav class="d-flex align-items-center ms-auto">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <img src="<?= $_SESSION['user_avatar'] ?>" alt="Avatar" class="rounded-circle me-2" width="40" height="40">
                    <p class=" mb-0 me-3 ms-3"><?= $_SESSION['user_name'] ?></p>
                    <a href="logout.php" class="btn btn-gold text-white me-2">Cerrar Sesión</a>
                    <?php if ($_SESSION['user_rol'] === 'admin'): ?>
                        <a href="admin/adminPanel.php" class="text-white ms-3 me-3"><img src="./assets/admin.png" alt="" style="width: 40px; height: 40px;"></a>
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