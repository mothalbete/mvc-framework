<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'ProyectGest' ?></title>

    <!-- Bootstrap CSS -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >

    <!-- Bootstrap JS -->
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

    <link rel="stylesheet" href="<?= BASE_URL ?>public/style.css">
</head>

<body class="bg-light">

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= BASE_URL ?>">ProyectGest</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto">

                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>proyecto">Proyectos</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>tarea">Tareas</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>usuario">Mi perfil</a></li>
                        <li class="nav-item"><a class="nav-link text-danger" href="<?= BASE_URL ?>auth/logout">Salir</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>auth/login">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>auth/register">Registro</a></li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="container py-4">

    <!-- Mensajes flash -->
    <?php if (!empty($_SESSION['flash'])): ?>
        <div class="alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible fade show">
            <?= $_SESSION['flash']['message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <?php require $viewFile; ?>
</main>

<footer class="text-center py-3 text-muted small">
    ProyectGest © <?= date('Y') ?>
</footer>

</body>
</html>
