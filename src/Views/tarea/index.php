<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Mis tareas</h2>

    <a href="<?= BASE_URL ?>tarea/create" class="btn btn-primary">
        + Nueva tarea
    </a>
</div>

<?php if (empty($tareas)): ?>

    <div class="alert alert-info text-center">
        No hay tareas registradas.
    </div>

<?php else: ?>

<table class="table table-hover align-middle">
    <thead>
        <tr>
            <th>Título</th>
            <th>Proyecto</th>
            <th>Asignada a</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($tareas as $tarea): ?>
            <tr>
                <td><?= htmlspecialchars($tarea->titulo) ?></td>
                <td><?= htmlspecialchars($tarea->proyecto->titulo ?? 'Sin proyecto') ?></td>
                <td><?= htmlspecialchars($tarea->usuario->nombre ?? 'Sin asignar') ?></td>

                <td>
                    <?php
                        $estado = $tarea->estado->nombre ?? 'Desconocido';
                        $badge = 'secondary';

                        if ($estado === 'Pendiente') $badge = 'warning';
                        if ($estado === 'En progreso') $badge = 'primary';
                        if ($estado === 'Completada') $badge = 'success';
                    ?>
                    <span class="badge bg-<?= $badge ?>"><?= $estado ?></span>
                </td>

                <td class="text-end">
                    <a href="<?= BASE_URL ?>tarea/edit?id=<?= $tarea->tarea_id ?>" 
                       class="btn btn-sm btn-outline-secondary">Editar</a>

                    <a href="<?= BASE_URL ?>tarea/delete?id=<?= $tarea->tarea_id ?>" 
                       class="btn btn-sm btn-outline-danger"
                       onclick="return confirm('¿Seguro que deseas eliminar esta tarea?')">
                        Eliminar
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php endif; ?>
