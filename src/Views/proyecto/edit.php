<div class="row justify-content-center">
    <div class="col-md-7">

        <div class="card shadow-sm">
            <div class="card-body p-4">

                <h2 class="fw-bold mb-4">Editar proyecto</h2>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?= BASE_URL ?>proyecto/edit/<?= $proyecto->proyecto_id ?>">

                    <div class="mb-3">
                        <label class="form-label">Título del proyecto</label>
                        <input 
                            type="text" 
                            name="titulo" 
                            class="form-control" 
                            value="<?= htmlspecialchars($proyecto->titulo) ?>"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea 
                            name="descripcion" 
                            class="form-control" 
                            rows="4"
                        ><?= htmlspecialchars($proyecto->descripcion) ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha de inicio</label>
                            <input 
                                type="date" 
                                name="fecha_inicio" 
                                class="form-control"
                                value="<?= $proyecto->fecha_inicio ?>"
                            >
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha de fin</label>
                            <input 
                                type="date" 
                                name="fecha_fin" 
                                class="form-control"
                                value="<?= $proyecto->fecha_fin ?>"
                            >
                        </div>
                    </div>

                    <button class="btn btn-primary w-100 mt-3">
                        Guardar cambios
                    </button>

                </form>

                <a href="<?= BASE_URL ?>proyecto" class="btn btn-link mt-3">
                    ← Volver al listado
                </a>

            </div>
        </div>

    </div>
</div>
