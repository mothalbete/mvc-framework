<h2 class="fw-bold mb-4">Editar proyecto</h2>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST" action="<?= BASE_URL ?>proyecto/edit?id=<?= $proyecto->proyecto_id ?>">

    <div class="mb-3">
        <label class="form-label">Título</label>
        <input type="text" name="titulo" class="form-control" 
               value="<?= htmlspecialchars($proyecto->titulo) ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <!-- antes: name="descrion" y $proyecto->descrion -->
        <textarea name="descripcion" class="form-control"><?= htmlspecialchars($proyecto->descripcion ?? '') ?></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Comentarios</label>
        <textarea name="comentarios" class="form-control"><?= htmlspecialchars($proyecto->comentarios ?? '') ?></textarea>
    </div>

    <button class="btn btn-primary">Guardar cambios</button>

</form>
