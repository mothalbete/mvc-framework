<h2 class="fw-bold mb-4">Crear tarea</h2>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST" action="<?= BASE_URL ?>tarea/create">

    <div class="mb-3">
        <label class="form-label">Título</label>
        <input type="text" name="titulo" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea name="descripcion" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Proyecto</label>
        <select name="proyecto_id" class="form-select" required>
            <?php foreach ($proyectos as $p): ?>
                <option value="<?= $p->proyecto_id ?>"><?= htmlspecialchars($p->nombre) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Estado</label>
        <select name="estado_id" class="form-select" required>
            <?php foreach ($estados as $e): ?>
                <option value="<?= $e->estado_id ?>"><?= htmlspecialchars($e->nombre) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Asignar a</label>
        <select name="usuario_id" class="form-select" required>
            <option value="">Selecciona un usuario</option>
            <?php foreach ($usuarios as $u): ?>
                <option value="<?= $u->usuario_id ?>"><?= htmlspecialchars($u->nombre) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Fecha límite</label>
        <input type="date" name="fecha_limite" class="form-control">
    </div>

    <button class="btn btn-primary">Crear tarea</button>

</form>
