<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Mis proyectos</h2>

    <a href="<?= BASE_URL ?>proyecto/create" class="btn btn-primary">
        + Nuevo proyecto
    </a>
</div>

<?php if (empty($proyectos)): ?>

    <div class="alert alert-info text-center">
        Aún no tienes proyectos creados.
        <br>
        <a href="<?= BASE_URL ?>proyecto/create" class="btn btn-sm btn-primary mt-2">
            Crear mi primer proyecto
        </a>
    </div>

<?php else: ?>

    <?php foreach ($proyectos as $proyecto): ?>

        <div class="card shadow-sm mb-4">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="fw-bold mb-0"><?= htmlspecialchars($proyecto->titulo) ?></h4>

                    <div>
                        <a href="<?= BASE_URL ?>proyecto/edit?id=<?= $proyecto->proyecto_id ?>" 
                           class="btn btn-sm btn-outline-secondary">
                            Editar
                        </a>

                        <a href="<?= BASE_URL ?>proyecto/delete?id=<?= $proyecto->proyecto_id ?>" 
                           class="btn btn-sm btn-outline-danger"
                           onclick="return confirm('¿Seguro que deseas eliminar este proyecto?')">
                            Eliminar
                        </a>
                    </div>
                </div>

                <p class="text-muted mt-2 mb-3">
                    <?= htmlspecialchars($proyecto->descrion ?: 'Sin descripción') ?>
                </p>

                <!-- Acordeón de tareas -->
                <div class="accordion" id="accordion<?= $proyecto->proyecto_id ?>">

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" 
                                    type="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#collapse<?= $proyecto->proyecto_id ?>">
                                Tareas asignadas
                            </button>
                        </h2>

                        <div id="collapse<?= $proyecto->proyecto_id ?>" 
                             class="accordion-collapse collapse" 
                             data-bs-parent="#accordion<?= $proyecto->proyecto_id ?>">

                            <div class="accordion-body">

                                <?php if ($proyecto->tareas->isEmpty()): ?>

                                    <p class="text-muted mb-0">No hay tareas asignadas a este proyecto.</p>

                                <?php else: ?>

                                    <table class="table table-sm table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th>Tarea</th>
                                                <th>Asignada a</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach ($proyecto->tareas as $tarea): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($tarea->titulo) ?></td>

                                                    <td>
                                                        <?= htmlspecialchars($tarea->usuario->nombre ?? 'Sin asignar') ?>
                                                    </td>

                                                    <td>
                                                        <?php
                                                            $estado = $tarea->estado->nombre ?? 'Desconocido';
                                                            $badge = 'secondary';

                                                            if ($estado === 'Pendiente') $badge = 'warning';
                                                            if ($estado === 'En progreso') $badge = 'primary';
                                                            if ($estado === 'Completada') $badge = 'success';
                                                        ?>
                                                        <span class="badge bg-<?= $badge ?>">
                                                            <?= $estado ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>

                                    </table>

                                <?php endif; ?>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    <?php endforeach; ?>

<?php endif; ?>
