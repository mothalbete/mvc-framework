<h2 class="fw-bold mb-4">Crear proyecto</h2>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST" action="<?= BASE_URL ?>proyecto/create">

    <div class="mb-3">
        <label class="form-label">Título</label>
        <input type="text" name="titulo" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <!-- antes: name="descrion" -->
        <textarea name="descripcion" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Comentarios</label>
        <textarea name="comentarios" class="form-control"></textarea>
    </div>

    <button class="btn btn-primary">Crear proyecto</button>

</form>
