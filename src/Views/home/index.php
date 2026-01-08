<div class="container">

    <h2 class="fw-bold mb-4">Bienvenido, <?= htmlspecialchars($usuario->nombre) ?></h2>

    <div class="row g-4">

        <!-- Tarjeta: Proyectos -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center py-4">
                    <h3 class="fw-bold"><?= $totalProyectos ?></h3>
                    <p class="text-muted mb-3">Proyectos creados</p>
                    <a href="<?= BASE_URL ?>proyecto" class="btn btn-primary btn-sm">Ver proyectos</a>
                </div>
            </div>
        </div>

        <!-- Tarjeta: Tareas -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center py-4">
                    <h3 class="fw-bold"><?= $totalTareas ?></h3>
                    <p class="text-muted mb-3">Tareas totales</p>
                    <a href="<?= BASE_URL ?>tarea" class="btn btn-primary btn-sm">Ver tareas</a>
                </div>
            </div>
        </div>

        <!-- Tarjeta: Tareas pendientes -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center py-4">
                    <h3 class="fw-bold"><?= $tareasPendientes ?></h3>
                    <p class="text-muted mb-3">Tareas pendientes</p>
                    <a href="<?= BASE_URL ?>tarea" class="btn btn-warning btn-sm">Revisar pendientes</a>
                </div>
            </div>
        </div>

    </div>

    <!-- Accesos rápidos -->
    <div class="mt-5">
        <h4 class="fw-bold mb-3">Accesos rápidos</h4>

        <div class="d-flex gap-3">
            <a href="<?= BASE_URL ?>proyecto/create" class="btn btn-outline-primary">
                + Nuevo proyecto
            </a>

            <a href="<?= BASE_URL ?>tarea/create" class="btn btn-outline-primary">
                + Nueva tarea
            </a>
        </div>
    </div>

</div>
