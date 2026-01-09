<h2 class="fw-bold mb-4">Editar tarea</h2>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST" action="<?= BASE_URL ?>tarea/edit?id=<?= $tarea->tarea_id ?>">

    <div class="mb-3">
        <label class="form-label">Título</label>
        <input type="text" name="titulo" class="form-control" 
               value="<?= htmlspecialchars($tarea->titulo) ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea name="descripcion" class="form-control"><?= htmlspecialchars($tarea->descripcion ?? '') ?></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Proyecto</label>
        <select name="proyecto_id" class="form-select" required>
            <?php foreach ($proyectos as $p): ?>
                <option value="<?= $p->proyecto_id ?>" 
                    <?= $p->proyecto_id == $tarea->proyecto_id ? 'selected' : '' ?>>
                    <?= htmlspecialchars($p->titulo) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Estado</label>
        <select name="estado_id" class="form-select" required>
            <?php foreach ($estados as $e): ?>
                <option value="<?= $e->estado_id ?>" 
                    <?= $e->estado_id == $tarea->estado_id ? 'selected' : '' ?>>
                    <?= htmlspecialchars($e->nombre) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Asignar a</label>
        <select name="usuario_id" class="form-select" required>
            <?php foreach ($usuarios as $u): ?>
                <option value="<?= $u->usuario_id ?>" 
                    <?= $u->usuario_id == $tarea->usuario_id ? 'selected' : '' ?>>
                    <?= htmlspecialchars($u->nombre) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button class="btn btn-primary">Guardar cambios</button>

</form>
