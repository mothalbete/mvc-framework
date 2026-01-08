<div class="container">
    <h1 class="mb-4">Mis tareas asignadas</h1>

    <?php if (count($tareas) === 0): ?>
        <div class="alert alert-info">No tienes tareas asignadas.</div>
    <?php endif; ?>

    <div class="list-group">
        <?php foreach ($tareas as $t): ?>
            <div class="list-group-item">
                <h5><?= $t->titulo ?></h5>

                <p class="mb-1">
                    <strong>Estado:</strong> <?= $t->estado->nombre ?><br>
                    <strong>Proyecto:</strong> <?= $t->proyecto->titulo ?>
                </p>

                <a href="<?= BASE_URL ?>tarea/editar/<?= $t->tarea_id ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="<?= BASE_URL ?>tarea/eliminar/<?= $t->tarea_id ?>" class="btn btn-sm btn-danger">Eliminar</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

